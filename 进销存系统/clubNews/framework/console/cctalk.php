<?php
set([
            'daemonize' =>true, //守护进程
            'log_file' => '/usr/local/var/www/blog/logs/swoole_websocket_logs.log', //日志纪录
            'heartbeat_check_interval' => 60,//60秒轮询连接数

        ]);
        $server->on('open', function (\swoole_websocket_server $server, $request) {
            echo "server: handshake success with fd{$request->fd}\n";
            $fd[] = $request->fd;
            $GLOBALS['fd'][] = $fd;
            //array_push($this->fdArr,$request->fd);//$request->fd;

        });
        $server->on('message', function (\swoole_websocket_server $server, $frame) {

            $message_data = json_decode($frame->data, true);
            echo "receive from {$frame->fd}:{$frame->data},opcode:{$frame->opcode},fin:{$frame->finish}\n";

            if(!$message_data)
            {
                return ;
            }
            switch($message_data['type'])
            {
                case 'pong':
                    return;
                case 'login':
                    $client_name = htmlspecialchars($message_data['client_name']);
                    $new_message = array('type'=>$message_data['type'], 'client_id'=>$frame->fd, 'client_name'=>htmlspecialchars($client_name), 'time'=>date('Y-m-d H:i:s'));
                    if(!isset($message_data['admin_id']) || empty($message_data['admin_id']))
                    {
                        return ;
                    }
                    //绑定uid和fd
                    User::BindFd($message_data['admin_id'],$frame->fd);


                    //广播给所有在线用户
                    foreach($server->connection_list() as $fd) {
                        $server->push($fd, Json::encode($new_message));
                    }
                    return;
                case 'say': //单人发送信息
                    $client_name = htmlspecialchars($message_data['to_client_name']);

                    if(!isset($message_data['to_client_id']) || empty($message_data['to_client_id']))
                    {
                        return ;
                    }
                    //通过uid 获取fd
                    $fd = User::getFdByUid($message_data['to_client_id']);
                    $new_message = array(
                        'type'=>'say',
                        'from_client_id'=>isset($message_data['from_client_id']) ? $message_data['from_client_id'] : 0,
                        'from_client_name'=>isset($message_data['from_client_name']) ? $message_data['from_client_name'] : 0,
                        'to_client_name' =>$client_name,
                        'avatar' => 'http://tp2.sinaimg.cn/1783286485/180/5677568891/1',
                        'to_client_id'=>$message_data['to_client_id'],
                        'content'=>nl2br(htmlspecialchars($message_data['content'])),
                        'time'=>date('Y-m-d H:i:s'),
                    );
                    $server->push($fd, Json::encode($new_message));
                    return;
                case 'group'://群组发送
                    $client_name = htmlspecialchars($message_data['to_client_name']);

                    if(!isset($message_data['to_client_id']) || empty($message_data['to_client_id']))
                    {
                        return ;
                    }
                    $new_message = array(
                        'type'=>'group',
                        'from_client_id'=>isset($message_data['from_client_id']) ? $message_data['from_client_id'] : 0,
                        'from_client_name'=>isset($message_data['from_client_name']) ? $message_data['from_client_name'] : 0,
                        'to_client_name' =>$client_name,
                        'avatar' => 'http://tp2.sinaimg.cn/1783286485/180/5677568891/1',
                        'to_client_id'=>$message_data['to_client_id'],
                        'content'=>nl2br(htmlspecialchars($message_data['content'])),
                        'time'=>date('Y-m-d H:i:s'),
                    );
                    //暂时将所有信息都广播给除自己之外的所有用户 后期再做这部分的优化信息
                    foreach($server->connection_list() as $fd) {

                        if($fd == $frame->fd) continue;
                        $server->push($fd, Json::encode($new_message));
                    }
                    return;
                default:
                    return;
            }

        });

        $server->on('close', function ($server, $fd) {

            $userInfo = User::getUidByFd($fd);
            $new_message = [
                'type' =>'logout',
                'name' => $userInfo->username,
            ];
            foreach($server->connection_list() as $_fd) {

                if($fd == $_fd) continue;
                $server->push($_fd, Json::encode($new_message));
            }
            echo "client {$fd} closed\n";
        });

        $server->start();
    }
}

?>