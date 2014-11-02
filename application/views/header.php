<?php session_start();?>
<?php 
require("hm.php");
$_hmt = new _HMT("ccec32faa4c5a15a95ac60c75235a4f6");
$_hmtPixel = $_hmt->trackPageView();
?>
<html>
<head>

  <link  type="text/css" href="<?=base_url().'css/style.css'?>" rel ="stylesheet"/>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
  <title><?php echo $title ?>设计合伙人 - 新锐设计师互联网平台</title>
  <script>
	var _hmt = _hmt || [];
	(function() {
	  var hm = document.createElement("script");
	  hm.src = "//hm.baidu.com/hm.js?ccec32faa4c5a15a95ac60c75235a4f6";
	  var s = document.getElementsByTagName("script")[0]; 
	  s.parentNode.insertBefore(hm, s);
	})();
	</script>

</head>
<script src="../../js/jquery-2.1.0.js"></script>

<body id = "body" onload = "load()">
<img src="<?php echo $_hmtPixel; ?>" width="0" height="0" />
<div class = "body_content">
  <div class ="header">
    <!--
  	<div class = "header_top">
		<?php if(isset($_SESSION['email'])){ ?>
			<a href="<?php echo site_url();?>/designer/loadInfo/<?php echo $_SESSION['id'];?>" class = "personal"><?php echo $_SESSION['name'];?></a>
		<?php 
		}else {
		?>
			<a href="<?php echo site_url();?>/login/loadLogin" class = "personal">未登录</a>
		<?php
		}
		?>
  		<a href="link" class = "app">手机App</a>
  		<a href="link" class = "eng">EN/中文</a>
  	</div>
	-->
  	<div class = "header_bottom">
		<div><a href = "<?php echo site_url();?>/main/index">
			<div class = "logo"></div>
			</a>
		</div>
		<div class = "menu">
		  <ul>
		    <li><a id="project" href="<?php echo site_url();?>/project/pagelist">项目</a></li>
		    <li><a id = "wkshop" href="<?php echo site_url();?>/workshop/workshops">工作坊/训练营</a></li>
		    <li><a id = "designer" href="<?php echo site_url();?>/designer/pagelist">设计师</a></li>
			<li><a id = "about" href="<?php echo site_url();?>/main/about">关于</a></li>
		  </ul>
  		</div>
		<div class = "logReg">
			<?php if(!isset($_SESSION['email'])){ ?>
				<div class = "login"><a href="<?php echo site_url();?>/login/loadLogin">登录</a></div>
				<div class = "register"><a href="<?php echo site_url();?>/register/loadRegister">注册</a></div>
				<div class = "scheme"><a href="<?php echo site_url();?>/company/scheme">设计需求提交</a></div>
			<?php }else{ ?>
				<div class = "login"><a href="<?php echo site_url();?>/designer/loadInfo/<?php echo $_SESSION['id'];?>"><?php echo $_SESSION['name']?></a></div>
				<div class = "register"><a href="<?php echo site_url();?>/login/logout">退出</a></div>
				<div class = "scheme"><a href="<?php echo site_url();?>/company/scheme">设计需求提交</a></div>
			<?php }?>
			
		</div>
  	</div>
  </div>