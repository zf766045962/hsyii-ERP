<?php
//include_once dirname(__FILE__).'/../../../../qmddpack/qmddpackinit.php';
/**
 * 字符串截取，支持中文和其他编码
 * @static
 * @access public
 * @param string $str 需要转换的字符串
 * @param string $start 开始位置
 * @param string $length 截取长度
 * @param string $charset 编码格式
 * @param string $suffix 截断显示字符
 * @return string
 */
function msubstr($str, $start = 0, $length, $charset = "utf-8", $suffix = true) {
    $str = trim(clear_html(str_replace('&nbsp;', '', strip_tags($str))));
    if (mb_strlen($str) > $length) {
        $isSuffix = true;
    } else {
        $isSuffix = false;
    }
    if (function_exists("mb_substr"))
        $slice = mb_substr($str, $start, $length, $charset);
    elseif (function_exists('iconv_substr')) {
        $slice = iconv_substr($str, $start, $length, $charset);
        if (false === $slice) {
            $slice = '';
        }
    } else {
        $re['utf-8'] = "/[\x01-\x7f]|[\xc2-\xdf][\x80-\xbf]|[\xe0-\xef][\x80-\xbf]{2}|[\xf0-\xff][\x80-\xbf]{3}/";
        $re['gb2312'] = "/[\x01-\x7f]|[\xb0-\xf7][\xa0-\xfe]/";
        $re['gbk'] = "/[\x01-\x7f]|[\x81-\xfe][\x40-\xfe]/";
        $re['big5'] = "/[\x01-\x7f]|[\x81-\xfe]([\x40-\x7e]|\xa1-\xfe])/";
        preg_match_all($re[$charset], $str, $match);
        $slice = join("", array_slice($match[0], $start, $length));
    }
    if ($str == $slice) {
        return $slice;
    } else {
        return $suffix && $isSuffix ? $slice . '…' : $slice;
    }
}

function substr_hz($str,$start,$len=0){
    if ($len==0){
        $len=strlen_hz($str)-$start;
    }
 return mb_substr($str,$start,$len,'UTF-8');
}
function subsstr_hz($str,$start,$len=0){
   if ($len==0){
        $len=strlen_hz($str)-$start;
    }
 return mb_substr($str,$start,$len,'UTF-8');   
}

function strlen_hz($str){
 return mb_strlen($str,'UTF-8');
}

//将内容进行UNICODE编码
function unicode_encode($name)
{
  $name = iconv('UTF-8', 'UCS-2', $name);
  $len = strlen($name);
  $str = '';
  for ($i = 0; $i < $len - 1; $i = $i + 2)
  {
    $c = $name[$i];
    $c2 = $name[$i + 1];
    if (ord($c) > 0)
    {  // 两个字节的文字
      $str .= '\u'.base_convert(ord($c), 10, 16).base_convert(ord($c2), 10, 16);
    }
    else
    {
      $str .= $c2;
    }
  }
  return $str;
}
function unicode_decode($name)
{
  // 转换编码，将Unicode编码转换成可以浏览的utf-8编码
  $pattern = '/([\w]+)|(\\\u([\w]{4}))/i';
  preg_match_all($pattern, $name, $matches);
  if (!empty($matches))
  {
    $name = '';
    for ($j = 0; $j < count($matches[0]); $j++)
    {
      $str = $matches[0][$j];
      if (strpos($str, '\\u') === 0)
      {
        $code = base_convert(substr($str, 2, 2), 16, 10);
        $code2 = base_convert(substr($str, 4), 16, 10);
        $c = chr($code).chr($code2);
        $c = iconv('UCS-2', 'UTF-8', $c);
        $name .= $c;
      }
      else
      {
        $name .= $str;
      }
    }
  }
  return $name;
}



/**
 * 获取客户端IP地址
 * @param integer $type 返回类型 0 返回IP地址 1 返回IPV4地址数字
 * @return mixed
 */


function show_status($status, $msg = '', $redirect = '',$msg2 = '', $redirect2 = '') {
     if ($status) { ajax_status(1, $msg, $redirect);  
        } else {
         ajax_status(0, $msg2, $redirect2);
       }
 }
 
function ajax_status($status = 0, $msg = '', $redirect = '') {
    ajax_exit(array('status' => $status, 'msg' => $msg, 'redirect' => $redirect));
}

function ajax_exit($arr) {
    header('Content-type:application/json');
    echo array_str($arr);
    exit;
}

function array_str($arr) {
    return CJSON::encode($arr);
}
/**
 * 设置cookie
 * @param string $name 名称
 * @param mixed $value 值
 * @param integer $day 有效天数
 * @return string
 */
function set_cookie($name, $value, $day = 1) {
    $cookie = new CHttpCookie($name, $value);
    $cookie->expire = time() + 60 * 60 * 24 * $day;
    Yii::app()->request->cookies[$name] = $cookie;
}

/**
 * 获取cookie
 * @param string $name 名称
 * @return mixed
 */
function get_cookie($name) {
    $cookie = Yii::app()->request->getCookies();
    if (null === $cookie[$name]) {
        return null;
    }
    return $cookie[$name]->value;
}

/**
 * 删除cookie
 * @param string $name 名称
 */
function del_cookie($name) {
    $cookie = Yii::app()->request->getCookies();
    unset($cookie[$name]);
}



/**
 * 把返回的数据集转换成Tree
 * @access public
 * @param array $list 要转换的数据集
 * @param string $pid parent标记字段
 * @return array
 */
function list_to_tree($list, $pk = 'id', $pid = 'pid', $child = '_child', $root = 0) {
    // 创建Tree
    $tree = array();
    if (is_array($list)) {
        // 创建基于主键的数组引用
        $refer = array();
        foreach ($list as $key => $data) {
            $refer[$data[$pk]] = & $list[$key];
        }
        foreach ($list as $key => $data) {
            // 判断是否存在parent
            $parentId = $data[$pid];
            if ($root == $parentId) {
                $tree[] = & $list[$key];
            } else {
                if (isset($refer[$parentId])) {
                    $parent = & $refer[$parentId];
                    $parent[$child][] = & $list[$key];
                }
            }
        }
    }
    return $tree;
}

/**
 * 快速文件数据读取和保存 针对简单类型数据 字符串、数组
 * @param string $name 缓存名称
 * @param mixed $value 缓存值
 * @param string $path 缓存路径
 * @return mixed
 */
function file_cache($name, $value = '', $path = ROOT_PATH) {
    static $_cache = array();
    $filename = $path . '/' . $name . '.php';
    if ('' !== $value) {
        if (is_null($value)) {
            // 删除缓存
            return false !== strpos($name, '*') ? array_map("unlink", glob($filename)) : unlink($filename);
        } else {
            // 缓存数据
            $dir = dirname($filename);
            // 目录不存在则创建
            if (!is_dir($dir))
                mkdir($dir, 0755, true);
            $_cache[$name] = $value;
            return file_put_contents($filename, strip_whitespace("<?php\treturn " . var_export($value, true) . ";?>"));
        }
    }
    if (isset($_cache[$name]))
        return $_cache[$name];
    // 获取缓存数据
    if (is_file($filename)) {
        $value = include $filename;
        $_cache[$name] = $value;
    } else {
        $value = false;
    }
    return $value;
}

/**
 * 浏览器友好的变量输出
 * @param mixed $var 变量
 * @param boolean $echo 是否输出 默认为True 如果为false 则返回输出字符串
 * @param string $label 标签 默认为空
 * @param boolean $strict 是否严谨 默认为true
 * @return void|string
 */
function dump($var, $echo = true, $label = null, $strict = true) {
    $label = ($label === null) ? '' : rtrim($label) . ' ';
    if (!$strict) {
        if (ini_get('html_errors')) {
            $output = print_r($var, true);
            $output = '<pre>' . $label . htmlspecialchars($output, ENT_QUOTES) . '</pre>';
        } else {
            $output = $label . print_r($var, true);
        }
    } else {
        ob_start();
        var_dump($var);
        $output = ob_get_clean();
        if (!extension_loaded('xdebug')) {
            $output = preg_replace('/\]\=\>\n(\s+)/m', '] => ', $output);
            $output = '<pre>' . $label . htmlspecialchars($output, ENT_QUOTES) . '</pre>';
        }
    }
    if ($echo) {
        echo($output);
        return null;
    } else
        return $output;
}

function mk_dir($path, $mode = 0755) {
    if (!file_exists($path)) {
        mk_dir(dirname($path), $mode);
        mkdir($path, $mode);
    }
}

function encrypt($str, $salt = '') {
    return md5($str . '!@#$%' . $salt . '^&*()');
}

function clear_html($content) {
    $content = preg_replace("/<a[^>]*>/i", "", $content);
    $content = preg_replace("/<\/a>/i", "", $content);
    $content = preg_replace("/<div[^>]*>/i", "", $content);
    $content = preg_replace("/<\/div>/i", "", $content);
    $content = preg_replace("/<!--[^>]*-->/i", "", $content); //注释内容
    $content = preg_replace("/style=.+?['|\"]/i", '', $content); //去除样式
    $content = preg_replace("/class=.+?['|\"]/i", '', $content); //去除样式
    $content = preg_replace("/id=.+?['|\"]/i", '', $content); //去除样式   
    $content = preg_replace("/lang=.+?['|\"]/i", '', $content); //去除样式    
    $content = preg_replace("/width=.+?['|\"]/i", '', $content); //去除样式 
    $content = preg_replace("/height=.+?['|\"]/i", '', $content); //去除样式 
    $content = preg_replace("/border=.+?['|\"]/i", '', $content); //去除样式 
    $content = preg_replace("/face=.+?['|\"]/i", '', $content); //去除样式 
    $content = preg_replace("/face=.+?['|\"]/", '', $content); //去除样式 只允许小写 正则匹配没有带 i 参数

    return $content;
}

// discuz 加密解密函数
function authcode($string, $operation = 'DECODE', $key = 'wzg', $expiry = 0) {
    $ckey_length = 4;
    $key = md5($key);
    $keya = md5(substr($key, 0, 16));
    $keyb = md5(substr($key, 16, 16));
    $keyc = $ckey_length ? ($operation == 'DECODE' ? substr($string, 0, $ckey_length) : substr(md5(microtime()), -$ckey_length)) : '';

    $cryptkey = $keya . md5($keya . $keyc);
    $key_length = strlen($cryptkey);

    $string = $operation == 'DECODE' ? base64_decode(substr($string, $ckey_length)) : sprintf('%010d', $expiry ? $expiry + time() : 0) . substr(md5($string . $keyb), 0, 16) . $string;
    $string_length = strlen($string);

    $result = '';
    $box = range(0, 255);

    $rndkey = array();
    for ($i = 0; $i <= 255; $i++) {
        $rndkey[$i] = ord($cryptkey[$i % $key_length]);
    }

    for ($j = $i = 0; $i < 256; $i++) {
        $j = ($j + $box[$i] + $rndkey[$i]) % 256;
        $tmp = $box[$i];
        $box[$i] = $box[$j];
        $box[$j] = $tmp;
    }

    for ($a = $j = $i = 0; $i < $string_length; $i++) {
        $a = ($a + 1) % 256;
        $j = ($j + $box[$a]) % 256;
        $tmp = $box[$a];
        $box[$a] = $box[$j];
        $box[$j] = $tmp;
        $result .= chr(ord($string[$i]) ^ ($box[($box[$a] + $box[$j]) % 256]));
    }

    if ($operation == 'DECODE') {
        if ((substr($result, 0, 10) == 0 || substr($result, 0, 10) - time() > 0) && substr($result, 10, 16) == substr(md5(substr($result, 26) . $keyb), 0, 16)) {
            return substr($result, 26);
        } else {
            return '';
        }
    } else {
        return $keyc . str_replace('=', '', base64_encode($result));
    }
}

function urlauthcode($string, $operation = 'DECODE', $key = 'zsylwzg888', $expiry = 0) {
    if ($operation == 'DECODE') {
        $string = base64_decode($string);
        return authcode($string, $operation, $key, $expiry);
    } else {
        return base64_encode(authcode($string, $operation, $key, $expiry));
    }
}

function https_request($url) {
    if (function_exists('curl_init')) {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $data = curl_exec($curl);
        if (curl_errno($curl)) {
            return null;
        }
        curl_close($curl);
        return $data;
    } else {
        if (file_exists($url)) {
            $data = file_get_contents($url);
            return $data;
        } else {
            return null;
        }
    }
  return null;
}

function getTime(){
 $time = explode ( " ", microtime () );  
 $time = "".($time [0] * 1000);  
 $time2 = explode ( ".", $time );  
 $time = $time2 [0]; 
 $s1=str_replace('-','',get_date());
 $s1=str_replace(':','',$s1);
 $s1=str_replace(' ','',$s1);
 return $s1.$time;
//2010-08-29 11:25:26
}



function get_date(){
    return date('Y-m-d h:i:s',time());
}
function get_file_name($key=""){
      return get_short_path().getTime();
}
//保存文件


// 返回多行. 每行都是列名和值的关联数组.
// 如果该查询没有结果则返回空数组
//$posts = Yii::$app->db->createCommand('SELECT * FROM post')->queryAll();

// 返回一行 (第一行)
// 如果该查询没有结果则返回 false
//$post = Yii::$app->db->createCommand('SELECT * FROM post WHERE id=1')
 //          ->queryOne();

// 返回一列 (第一列)
// 如果该查询没有结果则返回空数组
//$titles = Yii::$app->db->createCommand('SELECT title FROM post')
//             ->queryColumn();

// 返回一个标量值
// 如果该查询没有结果则返回 false
//$count = Yii::$app->db->createCommand('SELECT COUNT(*) FROM post')
//             ->queryScalar();



function getimages($str) {
    preg_match_all('/<img[^>]*src\s*=\s*([\'"]?)([^\'" >]*)\1/isu', $str, $src);
    return $src[2];
}

function round_dp($num, $dp) {
    $sh = pow(10, $dp);
    return (round($num * $sh) / $sh);
}

//size()  统计文件大小
function size($byte) {
    if ($byte < 1024) {
        $unit = "B";
    } else if ($byte < 1048576) {
        $byte = round_dp($byte / 1024, 2);
        $unit = "KB";
    } else if ($byte < 1073741824) {
        $byte = round_dp($byte / 1048576, 2);
        $unit = "MB";
    } else {
        $byte = round_dp($byte / 1073741824, 2);
        $unit = "GB";
    }

    $byte .= $unit;
    return $byte;
}

function pass_md5($ec_salt,$pass){  return empty( $ec_salt ) ? md5( $pass ) : md5( md5( $pass ) . $ec_salt );}


  function get_form_list(){
    return array(
            'id' => 'active-form',
            'enableClientValidation' => true,
            'clientOptions' => array(
                'validateOnSubmit' => true,
                'afterValidate' => 'js:function(form,data,hasError){
                    if(!hasError){
                        we.overlay("show");

                        $.ajax({
                            type:"post",
                            url:form.attr("action"),
                            data:form.serialize()+"&submitType="+submitType,
                            dataType:"json",
                            success:function(d){
                                if(d.status==1){
                                    we.success(d.msg, d.redirect);
                                }else{
                                    we.error(d.msg, d.redirect);
                                }
                            }
                        });
                    }else{
                        var html="";
                        var items = [];
                        for(item in data){
                            items.push(item);
                            html+="<p>"+data[item][0]+"</p>";
                        }
                        we.msg("minus", html);
                        var $item = $("#"+items[0]);
                        $item.focus();
                        $(window).scrollTop($item.offset().top-10);
                    }
                }',
            ),
        );
  }

function get_form_login(){
    return array(
            'id' => 'active-form',
            'enableClientValidation' => true,
            'clientOptions' => array(
                'validateOnSubmit' => true,
                'afterValidate' => 'js:function(form,data,hasError){
                    
                }',
            ),
        );
  }
