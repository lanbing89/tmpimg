<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>临时贴图</title>
    <link href="http://cdn.staticfile.org/twitter-bootstrap/3.0.3/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
</head>
<body style='font-family: "WenQuanYi Micro Hei", "WenQuanYi Zen Hei", "Microsoft YaHei", arial, sans-serif; font-size: 16px;margin: 30px auto;'>
<div class="container">
    <div class="row">
        <div class="span12">
            <header class="box well">
                <header><h2><a href="http://img.hengtian.biz/">临时贴图</a></h2></header>
                <hr />
                <ul style="list-style-type: none;">
                    <li><i class="icon-ok"></i> 不必注册帐号，不必登录</li>
                    <li><i class="icon-ok"></i> 直链下载，无广告，无需等待</li>
                    <li><i class="icon-ok"></i> CDN全网加速</li>
                    <li><i class="icon-ok"></i> 清爽无图界面，无须Flash，同样适合手机访问</li>
					<li><i class="icon-ok"></i> 仅提供临时贴图/文件，7天后自动删除</li>
                </ul>
            </header>
			<?php
	if(is_uploaded_file($_FILES['upfile']['tmp_name']))
	{
		$upfile = $_FILES["upfile"];
		$name= substr(str_shuffle(abcdefghijkmnpqrstwxyz23456789),0,6).'.jpg'; //获取文件后缀比较麻烦，所以直接全用了jpg
		$type = $upfile["type"];
		$size = $upfile["size"];
		$tmp_name = $upfile["tmp_name"];
		$error = $upfile["error"];
		$max_file_size = 2000000;//限制文件大小
		if($max_file_size < $size)
		//检查文件大小
		{
			echo <<< HTML
<div class="alert alert-dismissable alert-danger">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>图片过大，请保持在2M内！</strong>
              </div>
HTML;
			exit;
		}
		switch($type)//判断上传文件类型，只能为图片
		{
			case 'image/pjepg' : $ok = 1;
			break;
			case 'image/jpeg' : $ok = 1;
			break;
			case 'image/gif' : $ok = 1;
			break;
			case 'image/png' : $ok = 1;
			break;
		}
		if($ok && $error == '0')
		{
			move_uploaded_file($tmp_name,'files/'.$name);
			echo <<< HTML
<div class="alert alert-dismissable alert-success">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>上传成功!</strong>
              </div>
HTML;
			$imgurl = 'http://imglink.qiniudn.com/files/'.$name; //使用七牛CDN加速
			//$imgurl = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'].'files/'.$name; //直接使用当前网址
			echo <<< HTML
			<section class='box well'>
  <table class="table table-striped table-bordered table-condensed">
                    <tr>
                    <td>文件名</td>
                    <td>类型</td>
                    <td>大小</td>
                    <td>链接</td>
                  </tr>
                  <tr>
                    <td>{$upfile["name"]}</td>
                    <td>{$upfile["type"]}</td>
                    <td>{$upfile["size"]}</td>
                    <td><a href = "$imgurl" target = "_blank">$imgurl</a></td>
                  </tr>
				    </table>
</section>
HTML;
			
		}
		else
		{
			echo <<< HTML
<div class="alert alert-dismissable alert-danger">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>上传失败，文件格式不支持!</strong>
              </div>
HTML;
			exit;
		}
	}
?>
            <section class='box well'>			
<form action = "" enctype = "multipart/form-data" method = "post" name = "upform" id="fileForm">
	<p>上传文件：<br /></p>
	<input type = "file" name = "upfile"><br />
	<input id='start' class='btn btn-success' type = "submit" value = "上传"><br />
</form>
            </section>
            <section class='box well'>
                <ul style="list-style-type:none;">
                    <li>参考 <a href="http://faceair.net/" target="_brank">faceair</a> 和 <a href="https://github.com/helloxz/up" target="_brank">helloxz/up</a></li>
                </ul>
            </section>
        </div>
    </div>
</div>
<script type='text/javascript' src='http://cdn.staticfile.org/jquery/2.0.3/jquery.min.js'></script>
<script type='text/javascript' src='http://cdn.staticfile.org/twitter-bootstrap/3.0.3/js/bootstrap.min.js'></script>
</body>
</html>