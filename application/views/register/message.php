<div class = "send_email">
	<div class = "message">
		<?php if($success ==1){?>
			恭喜您注册成功，一封邮件已经发送到到您的邮箱，请点击验证。
		<?php 
		}else if($success==2){
		?>
			请不要重复注册。
		<?php
		}else if($success == 3){
		?>
			恭喜您成功激活。
		<?php
		}else if($success == 4){
		?>
			您的账户已经激活，请不要重复激活。
		<?php
		}else if($success == 5){
		?>
			对不起，激活失败。
		<?php
		}else if($success == 6){
		?>
			链接已失效。
		<?php
		}else if($success == 7){
		?>
			对不起，邮件发送失败。
		<?php
		}else{
		?>
			对不起，系统繁忙，请稍后再试。
		<?php 
		}
		?>
	</div>
</div>