<?php
/*
 * Created on 2014-9-18
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
?>


<div class = "login">
	<div class = "title"><b>登&nbsp;&nbsp;&nbsp;录</b></div>
	<div class = "container">
		<form  action="<?php echo site_url()?>/login/log" method="post">
			<div class = "des"></div><input type="text" id="email" name="email" value="" placeholder="邮箱"/><div class = "illegal" id="email_illegal" hidden="true">邮箱不合法</div><div class = "legal" id="email_legal" hidden="true">邮箱可登录</div ><div class = "illegal" id="email_not_exist" hidden="true">邮箱不存在</div ><div class = "clear"></div>
			<div class = "des"></div><input type="password" id="password" name="password" placeholder="密码" /><div class = "illegal" id="password_illegal"hidden="true">密码不足六位</div><div class = "illegal" id="password_wrong" <?php if($wrong!=1){ echo "hidden = 'true'";}?>>密码错误</div><div class = "legal" id="password_legal"hidden="true">密码长度合理</div><div class = "clear"></div>
			<input type="button" name="sub" id="sub" value="登录"/>
			<div class = "reg_link"><a href = "<?php echo site_url();?>/register/loadRegister">创建账号</a></div>
			
		</form>
	</div>
</div> 
	<script type="text/javascript">
			//光标移开判断Email是否合法
			$("#email").blur(function(){
				var email = $("#email").val();
				$.post("<?php echo site_url();?>/login/email_check",{email:email},function(msg){
					if(msg==1){
						$('#email_illegal').show();
						$('#email_legal').hide();
						$('#email_not_exist').hide();
					}else if(msg==2){
						$('#email_illegal').hide();
						$('#email_legal').hide();
						$('#email_not_exist').show();
					}else{
						$('#email_illegal').hide();
						$('#email_legal').show();
						$('#email_not_exist').hide();
					}
				});
			});	
			//光标移开判断password是否合法
			$("#password").blur(function(){
				var password = $("#password").val();
				if(password.length<6){
					$('#password_illegal').show();
					$('#password_legal').hide();
					$('#password_wrong').hide();
				}else{
					$('#password_illegal').hide();
					$('#password_legal').show();
					$('#password_wrong').hide();
				}
			});	
			$("#sub").click(function(){
				var email = $("#email").val();
				$.post("<?php echo site_url();?>/login/email_check",{email:email},function(msg){
					if(msg==1){
						$('#email_illegal').show();
						$('#email_legal').hide();
						$('#email_not_exist').hide();
					}else if(msg==2){
						$('#email_illegal').hide();
						$('#email_legal').hide();
						$('#email_not_exist').show();
					}else{
						$('#email_illegal').hide();
						$('#email_legal').show();
						$('#email_not_exist').hide();
					}
				});
				var password = $("#password").val();
				if(password.length<6){
					$('#password_illegal').show();
					$('#password_legal').hide();
					$('#password_wrong').hide();
				}else{
					$('#password_illegal').hide();
					$('#password_legal').show();
					$('#password_wrong').hide();
				}
				if($("#password_legal").is(":visible")&&$("#email_legal").is(":visible")){
					$("form").submit();
				}
			});
	</script>

