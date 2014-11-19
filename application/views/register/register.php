<?php
/*
 * Created on 2014-9-18
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
?>


<div class = "register">
	<div class = "title"><b>注&nbsp;&nbsp;&nbsp;册</b></div>
	<div class = "container">
		<form  action="<?php echo site_url()?>/register/reg" method="post">
			<div class = "des"></div><input class = "input" placeholder="真实姓名" type="text" id="name" name="name" value="" size="40" maxlength="40"/><div class = "illegal" id="name_illegal" hidden="true"><img class = "wrong" src="../../images/wrong.png"/>请填写姓名</div><div class = "legal" id="name_legal" hidden="true"><img class = "right" src="../../images/right.png"/></div ><div class = "clear"></div>
			<div class = "des"></div><input class = "input" placeholder="邮箱地址"type="text" id="email" name="email" value="" size="40" maxlength="40"/><div class = "illegal" id="email_illegal" hidden="true"><img class = "wrong" src="../../images/wrong.png"/>邮箱不合法</div><div class = "legal" id="email_legal" hidden="true"><img class = "right" src="../../images/right.png"/></div ><div class = "illegal" id="email_exist" hidden="true"><img class = "wrong" src="../../images/wrong.png"/>邮箱被注册</div ><div class = "clear"></div>
			<div class = "des"></div><input class = "input" placeholder="手机号码"type="text" id="phone" name="phone" value="" size="40" maxlength="40"/><div class = "illegal" id="phone_illegal" hidden="true"><img class = "wrong" src="../../images/wrong.png"/>号码不合法</div><div class = "legal" id="phone_legal" hidden="true"><img class = "right" src="../../images/right.png"/></div><div class = "illegal" id="phone_exist" hidden="true"><img class = "wrong" src="../../images/wrong.png"/>手机号码被注册</div><div class = "clear"></div>
			<div class = "des"></div><input class = "input" placeholder="密码"type="password" id="password" name="password" value="" size="40" maxlength="40"/><div class = "illegal" id="password_illegal"hidden="true"><img class = "wrong" src="../../images/wrong.png"/>密码不足六位</div><div class = "legal" id="password_legal"hidden="true"><img class = "right" src="../../images/right.png"/></div><div class = "clear"></div>
			<div class = "des"></div><input class = "input" placeholder="确认密码"type="password" id="confirm" name="confirm" value="" size="40" maxlength="40"/><div class = "illegal" id="confirm_illegal"hidden="true"><img class = "wrong" src="../../images/wrong.png"/>两次密码不一致</div><div class = "legal" id="confirm_legal"hidden="true"><img class = "right" src="../../images/right.png"/></div><div class = "illegal" id="confirm_none" hidden="true"><img class = "wrong" src="../../images/wrong.png"/>密码不能为空</div><div class = "clear"></div>
			<input type='checkbox' name='check' id = "check" value=1 /><div class = "tt">我已阅读并接受<a href = "">版权声明</a>和<a href = "">隐私保护</a>条款</div><div class = "clear"></div>
			<input type="button" name="sub" id="sub" value="注册"/>
			<div class = "log_link">已有账号？<a  href = "<?php echo site_url();?>/login/loadLogin">登录</a></div><div class = "clear"></div>
		</form>
	</div>
</div> 
	<script type="text/javascript">
			
			//光标移开判断Email是否合法
			$("#email").blur(function(){
				var email = $("#email").val();
				$.post("<?php echo site_url();?>/register/email_check",{email:email},function(msg){
					if(msg==1){
						$('#email_illegal').show();
						$('#email_legal').hide();
						$('#email_exist').hide();
					}else if(msg == 2){
						$('#email_illegal').hide();
						$('#email_exist').show();
						$('#email_legal').hide();
					}else{
						$('#email_illegal').hide();
						$('#email_exist').hide();
						$('#email_legal').show();
					}
				});
			});	
			//光标移开判断phone是否合法
			$("#phone").blur(function(){
				var phone = $("#phone").val();
				$.post("<?php echo site_url();?>/register/phone_check",{phone:phone},function(msg){
					if(msg==1){
						$('#phone_illegal').show();
						$('#phone_legal').hide();
						$('#phone_exist').hide();
					}else if(msg==2){
						$('#phone_illegal').hide();
						$('#phone_exist').show();
						$('#phone_legal').hide();
					}else{
						$('#phone_illegal').hide();
						$('#phone_exist').hide();
						$('#phone_legal').show();
					}
				});
			});	
			//光标移开判断name是否合法
			$("#name").blur(function(){
				var name = $("#name").val();
				if(name==""){
					$('#name_illegal').show();
					$('#name_legal').hide();
				}else{
					$('#name_illegal').hide();
					$('#name_legal').show();
				}
			});	
			//光标移开判断password是否合法
			$("#password").blur(function(){
				var password = $("#password").val();
				if(password.length<6){
					$('#password_illegal').show();
					$('#password_legal').hide();
				}else{
					$('#password_illegal').hide();
					$('#password_legal').show();
				}
			});	
			//光标移开判断confirm是否合法
			$("#confirm").blur(function(){
				var password = $("#password").val();
				var confirm = $("#confirm").val();
				if(confirm ==""){
					$('#confirm_none').show();
					$('#confirm_illegal').hide();
					$('#confirm_legal').hide();
				}else if(confirm!=password){
					$('#confirm_none').hide();
					$('#confirm_illegal').show();
					$('#confirm_legal').hide();
				}else{
					$('#confirm_none').hide();
					$('#confirm_illegal').hide();
					$('#confirm_legal').show();
				}
			});
			
			$("#sub").click(function(){
				var email = $("#email").val();
				$.post("<?php echo site_url();?>/register/email_check",{email:email},function(msg){
					if(msg==1){
						$('#email_illegal').show();
						$('#email_legal').hide();
						$('#email_exist').hide();
					}else if(msg == 2){
						$('#email_illegal').hide();
						$('#email_exist').show();
						$('#email_legal').hide();
					}else{
						$('#email_illegal').hide();
						$('#email_exist').hide();
						$('#email_legal').show();
					}
				});
				var phone = $("#phone").val();
				$.post("<?php echo site_url();?>/register/phone_check",{phone:phone},function(msg){
					if(msg==1){
						$('#phone_illegal').show();
						$('#phone_legal').hide();
						$('#phone_exist').hide();
					}else if(msg==2){
						$('#phone_illegal').hide();
						$('#phone_exist').show();
						$('#phone_legal').hide();
					}else{
						$('#phone_illegal').hide();
						$('#phone_exist').hide();
						$('#phone_legal').show();
					}
				});
				var name = $("#name").val();
				if(name==""){
					$('#name_illegal').show();
					$('#name_legal').hide();
				}else{
					$('#name_illegal').hide();
					$('#name_legal').show();
				}
				var password = $("#password").val();
				if(password.length<6){
					$('#password_illegal').show();
					$('#password_legal').hide();
				}else{
					$('#password_illegal').hide();
					$('#password_legal').show();
				}
				var password = $("#password").val();
				var confirm = $("#confirm").val();
				if(confirm ==""){
					$('#confirm_none').show();
					$('#confirm_illegal').hide();
					$('#confirm_legal').hide();
				}else if(confirm!=password){
					$('#confirm_none').hide();
					$('#confirm_illegal').show();
					$('#confirm_legal').hide();
				}else{
					$('#confirm_none').hide();
					$('#confirm_illegal').hide();
					$('#confirm_legal').show();
				}
				if($("#name_legal").is(":visible")&&$("#email_legal").is(":visible")&&
				$("#phone_legal").is(":visible")&&$("#password_legal").is(":visible")&&
				$("#confirm_legal").is(":visible")&& document.getElementById('check').checked){
					
					$("form").submit();
				}
			});
	</script>

