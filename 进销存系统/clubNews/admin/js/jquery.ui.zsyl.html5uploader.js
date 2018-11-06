
(function($){
	var ZXXFILE=[];
	var all_files=[];//所有文件数组
	var uploaded_file_count=[];//已上传完成的文件数
	$.fn.html5uploader = function(control_index,opts){
		//alert(control_index);
		all_files[control_index]=[];
		uploaded_file_count[control_index]=0;
		var defaults = {
			definedTitle:false,//自定义文件名，可在单个文件上传成功时返回 ture为显示标题输入栏，false不显示
			fileTypeExts:'',//允许上传的文件类型，填写mime类型,逗号分隔
			url:'',//文件提交的地址
			auto:false,//自动上传
			limitFiles:0,//限制一次上传文件个数
			multi:true,//默认允许选择多个文件
			buttonText:'选择文件',//上传按钮上的文字
			removeTimeout: 1000,//上传完成后进度条的消失时间
			itemTemplate:"<li id='${fileID}file'><table width='100%' border='0' cellspacing='0' cellpadding='0'"
			+" class='progress_item'><tr><td height='24' colspan='2'><div class='progress'><div class='progressbar'>"
			+" </div></div></td><td width='40' style='width:40px; overflow:hidden; text-align:center;'>"
			+" <a class='delfilebtn' id='${fileID}a'><img src='images/delete.png' /></a></td></tr>"
			+" <tr><td width='550' height='20'><span class='filename'>文件名：${fileName}</span>"
			+" <span id='${fileID}title_container'>&nbsp;&nbsp;&nbsp;/图片标题："
			+" <input name='pic_title' type='text' id='${fileID}title' style='border:1px solid #CCCCCC;"
			+" background-color:#FAFAFA; border-radius:2px; color:#666'></span></td><td rowspan='2'>"
			+" <span id='${fileID}description_container'>图介绍：<textarea id='${fileID}description'"
			+" name='description' style=' border:1px solid #CCCCCC; background-color:#FAFAFA; border-radius:3px;"
			+" width:150px; max-width:200px; min-width:150px; height:50px; margin-top:5px; margin-bottom:5px;"
			+" padding:3px;font-family:'微软雅黑';color:#333;'></textarea></span></td><td>&nbsp;</td></tr>"
			+" <tr><td height='20'><span class='progressnum'>百分比：0/${fileSize}</span></td><td>&nbsp;</td></tr>"
			+"</table></li>",//上传队列显示的模板,最外层标签使用<li>		
			onSelectting:function(){},//正在选择文件时
			onSelected:function(){},//文件选择完成时
			onUploadStart:function(){},//上传开始时的动作
			onSingleUploadSuccess:function(){},//单个文件上传成功的动作
			onUploadComplete:function(){},//上传完成的动作
			onUploadError:function(){}, //上传失败的动作
			onInit:function(){},//初始化时的动作
			onDeleted:function(){}//删除完成时
			}
		
			var option = $.extend(defaults,opts);
	
			//将文件的单位由bytes转换为KB或MB
			var formatFileSize = function(size){
				if (size> 1024 * 1024){
					size = (Math.round(size * 100 / (1024 * 1024)) / 100).toString() + 'MB';
					}
				else{
					size = (Math.round(size * 100 / 1024) / 100).toString() + 'KB';
					}
				return size;
				}
			//根据文件序号获取文件
			var getFile = function(index,files){
				for(var i=0;i<files.length;i++){	   
				  if(files[i].index == index){ return files[i];}
				}
				return false;
			}
			//将文件类型格式化为数组
			var formatFileType = function(str){
				if(str){ return str.split(",");	}
				return false;
				}
			
			this.each( function(){
							  // alert(control_index);
				var _this = $(this);
				//先添加上file按钮和上传列表
				var inputstr = '<input class="uploadfile" id="uploadfile_'+control_index+'" style="visibility:hidden;" type="file" name="fileselect[]"';
				if(option.multi){inputstr += 'multiple';}
				inputstr += '/>';
				inputstr += '<a href="javascript:void(0)" class="uploadfilebtn">';
				inputstr += option.buttonText;
				inputstr += '</a>';
				var fileInputButton = $(inputstr);
				var uploadFileList = $('<ul class="filelist"></ul>');
				_this.append(fileInputButton,uploadFileList);
				//创建文件对象
				ZXXFILE[control_index] = {
					  fileInput: fileInputButton.get(0),				//html file控件
					  upButton: null,					//提交按钮
					  url: option.url,						//ajax地址
					  //fileFilter: [],					//过滤后的文件数组
					  filter: function(files) {		//选择文件组的过滤方法
						  var arr = [];
						  var typeArray = formatFileType(option.fileTypeExts);
						  if(!typeArray){
							  for(var i in files){
									  if(files[i].constructor==File){arr.push(files[i]);}
								  }
							  }
						  else{
							  for(var i in files){
								  if(files[i].constructor==File){
								  	arr.push(files[i]);
									//if($.inArray(files[i].type,typeArray)>=0){arr.push(files[i]);	}
								//	else{
									//	alert('文件类型不允许！');
									//	fileInputButton.val('');
									//	}  	
									} 
								}	
							  }
							  ///////////////过滤一下已经存在的文件
						
							  //alert(control_index);
							  $.each(all_files[control_index],function(index){
									var i=0;
									var splice_index=0;
									while(i<arr.length){
										if(arr[i].name==all_files[control_index][index].name){
												alert('存在相同文件，请重新检查');
												arr.length=0;
												break;
											}
										i++;
										}
							   });
						  return arr;  	
					  },
					  //文件选择后
					  onSelect: option.onSelect||function(files){

						 for(var i=0;i<files.length;i++){
							
							var file = files[i];
							
							var html = option.itemTemplate;
							//处理模板中使用的变量
							var replace_fileID=control_index+"_"+file.index;
							//alert(replace_deleteID);
							html = html.replace(/\${fileID}/g,replace_fileID).replace(/\${fileName}/g,file.name).replace(/\${fileSize}/g,formatFileSize(file.size));
							uploadFileList.append(html);
							
							if(!option.definedTitle){
								$("#"+replace_fileID+"title_container").hide();
								$("#"+replace_fileID+"description_container").hide();
								}
							//判断是否是自动上传
							 if(option.auto){
								 ZXXFILE[control_index].funUploadFile(file,"",control_index);
								 }
								 
								 
								 //如果配置非自动上传，绑定上传事件
						 /*if(!option.auto){
							_this.find('.uploadbtn').die().live('click',function(){
								var index = parseInt($(this).parents('li').attr('id'));
								ZXXFILE.funUploadFile(getFile(index,files),"");
								});
						 }*/
						 //为删除文件按钮绑定删除文件事件
						 _this.find('.delfilebtn').last().bind('click',function(){
							 //var index = parseInt($(this).parents('li').attr('id'));
							 var href_id=$(this).attr("id");
							 var index=href_id.replace("a","");
							 //alert(index);
							 ZXXFILE[control_index].funDeleteFile(index);
							 });
								 
						 }
						 option.onSelected();
						 
						 
						},		
					  //文件删除后
					  onDelete: function(index) {
						  //_this.find('#'+index+'file').fadeOut();
						 // alert(index);
						  _this.find('#'+index+'file').remove();
						},	
						  //文件进度处理时
					  onProgress: function(file, loaded, total) {
					  var eleProgress = _this.find('#'+control_index+'_'+file.index+'file .progress'), percent = (loaded / total * 100).toFixed(2) + '%';
					  eleProgress.find('.progressbar').css('width',percent);
					  if(total-loaded<500000){loaded = total;}//解决四舍五入误差
					  eleProgress.parents('li').find('.progressnum').html(formatFileSize(loaded)+'/'+formatFileSize(total));
				  		},		//文件上传进度
					  onSingleUploadSuccess: option.onSingleUploadSuccess,		//文件上传成功时
					  onUploadError: option.onUploadError,		//文件上传失败时,
					  onUploadComplete: option.onUploadComplete,		//文件全部上传完毕时
					  
					  /* 开发参数和内置方法分界线 */
					  
					  //获取选择文件，file控件或拖放
					  funGetFiles: function(e) {//选择文件时第一步
								  
						  // 获取文件列表对象
						  var files = e.target.files || e.dataTransfer.files;
						  //继续添加文件
						  files = this.filter(files)//过滤一下所选文件，通过后缀控制
						 // alert(files.length);
						  //this.fileFilter.push(files);//把数组推进队列
						  if(files.length>0) this.funDealFiles(files);//选中文件的处理与回调
						  return this;
					  },
					  
					  //选中文件的处理与回调
					  funDealFiles: function(files) {
						  var fileCount = _this.find('.filelist li').length;//队列中已经有的文件个数
						  //alert(fileCount+":"+option.limitFiles);
						  if(fileCount+files.length>option.limitFiles && option.limitFiles>0){
								alert("上传文件数超过限制");
								return;
							}
						  if(!option.onSelectting(files)) return;
						
							for(var i=0;i<files.length;i++){
								
								//增加唯一索引值,有最后一个li的id,xxxfile分解掉file后的数字id+
								var file=files[i];
								all_files[control_index].push(file);
								
								if(fileCount==0){
									file.index=0+parseInt(i);
								}else{
									var li_id=_this.find('.filelist li').last().attr("id");
									var id=li_id.replace("file","").replace(control_index+"_","");
									//alert(parseInt(id)+1+i);
									file.index = parseInt(id)+1+i;
								}
							}
						 
						  //执行选择回调
						  this.onSelect(files);
						  
						  return this;
					  },
					  
					  //删除对应的文件
					  funDeleteFile: function(index) {
				
						  $.each(all_files[control_index],function(files_index){
												  //alert($(this).attr("index")+":"+index);
								var file_id=control_index+"_"+$(this).attr("index");
								if(file_id==index){				 
									all_files[control_index].splice(files_index,1);  
									ZXXFILE[control_index].onDelete(index);				   
									option.onDeleted(index);				   
									return this;
							        }
							});
						  return this;
					  },
					  
					  //文件上传 def_code/*自定义参数，为上传文件名使用*/,
	funUploadFile: function(file,def_code,control_index,path_code,img_name) {
		var self = this;	
		(function(file) {
			var xhr = new XMLHttpRequest();
			if (xhr.upload) {// 上传中
				xhr.upload.addEventListener("progress", function(e) {self.onProgress(file, e.loaded, e.total);
				}, false);
		// 文件上传成功或是失败
			xhr.onreadystatechange = function(e) {
			if (xhr.readyState == 4) {
				if (xhr.status == 200) {
					var li_obj="#"+control_index+"_"+file.index+"a";
					$(li_obj+" img").attr("src","images/ok.png");
					$(li_obj).unbind("click");
					self.onSingleUploadSuccess(xhr.responseText,
						$("#"+control_index+"_"+file.index+"title").val(),
						$("#"+control_index+"_"+file.index+"description").val(),
						file.index);
			 //self.onSingleUploadSuccess(xhr.responseText,"aa","bb","cc");
					setTimeout(function(){
										ZXXFILE[control_index].onDelete(control_index+"_"+file.index);
						},option.removeTimeout);
					uploaded_file_count[control_index]++;//完成一个加一个
					if(uploaded_file_count[control_index]==all_files[control_index].length) 
						self.onUploadComplete();//完成
					} 
					else
					{ self.onUploadError(file['name'], xhr.responseText);}
			    }
		    };
		option.onUploadStart();	 // 开始上传
	    xhr.open("POST", self.url, true);
								//  xhr.setRequestHeader("X_FILENAME", "zsyl_file_upload");
					  //          //如果这里不组装，直接发送file对象的话，好像超过1M多后在服务端file_get_contents('php://input')会无效，
					  //          //莫名奇妙,只能包装form来post
			//	alert("path_code"+path_code+file+'='+self.url);
						var fd = new FormData();
		       			fd.append("file", file);
						fd.append("action", "gf_upload_file");
					    fd.append("def_code",def_code);
						fd.append("path_code",path_code);
						fd.append("img_name",img_name);
						xhr.send(fd);
					}	
	})(file);	
	},
	init: function() {
						  //alert(control_index);
		var self = this;
						  //文件选择控件选择
		if (this.fileInput) {
			this.fileInput.addEventListener("change", function(e) { self.funGetFiles(e); }, false);	//为file控件绑定选择事件funGetFiles
		}
						  //点击上传按钮时触发file的click事件
		_this.find('.uploadfilebtn').live('click',function(){
			_this.find("#uploadfile_"+control_index+"").trigger('click');
		});			  
	    option.onInit();
	}
};
				  //初始化文件对象
				  ZXXFILE[control_index].init();
			
				}); 
	   }
		////////////////////////luchec add 2014-8-14
$.fn.html5uploader.uploads = function(control_index,def_code,path_code,img_name){
	//if (count(all_files)==0) return 0;
	if (typeof(all_files[control_index])=='undefined') return 0;
	if(all_files[control_index].length==0){	return 0;}	
	$.each(all_files[control_index],function(index){
					//$("#"+control_index+"_"+index+"a").css("display","none");
			});
	uploaded_file_count[control_index]=0;
    var i=0;
	while(i<all_files[control_index].length){
		ZXXFILE[control_index].funUploadFile(all_files[control_index][i],def_code,control_index,path_code,img_name);
		i++;
	 }
	 return 1;	
  }	
})(jQuery)