<div class = "login_msg">
	<div class = "message">
		<?php if($success ==0){?>
			对不起，密码错误，请再次登录。
			<script language="javascript" type="text/javascript"> 
			setTimeout("javascript:location.href='<?php echo site_url();?>'+'/login/loadLogin'",1000); 
			</script>
		<?php 
		}else if($success==1){
		?>
			恭喜您登录成功。
			<script language="javascript" type="text/javascript"> 
			// 以下方式定时跳转
			setTimeout("javascript:location.href='<?php echo site_url();?>'",100); 
			</script>
		<?php
		}else if($success==2){
		?>
			<script language="javascript" type="text/javascript"> 
			// 以下方式定时跳转
			setTimeout("javascript:location.href='<?php echo site_url();?>'",100); 
			</script>
		<?php
		}else if($success==3){
		?>
			用户不存在。
		<?php
		}else if($success==4){
		?>
			用户已退出。
			<script language="javascript" type="text/javascript"> 
			history.go(-1);
			</script>
		<?php 
		}else if($success==5){
		?>
			对不起，退出失败。
		<?php
		}else{
		?>
			对不起，系统繁忙，请稍后再试。
		<?php
		}
		?>
	</div>
</div>