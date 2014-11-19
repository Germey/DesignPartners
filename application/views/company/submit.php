<?php
/*
 * Created on 2014-9-18
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
?>


<div class = "company">
	<div class = "title"><b>企业提交设计需求</b></div>
	<div class = "container">
		<form  action="<?php echo site_url()?>/company/subscheme" method="post">
			<div class = "des"></div><input class = "input" placeholder="企业名" type="text" id="con_name" name="con_name" value="" size="40" maxlength="40"/><div class = "illegal" id="con_name_illegal" hidden="true">请填写企业名</div><div class = "legal" id="con_name_legal" hidden="true">填写合理</div ><div class = "clear"></div>
			<div class = "des"></div><input class = "input" placeholder="联系人" type="text" id="name" name="name" value="" size="40" maxlength="40"/><div class = "illegal" id="name_illegal" hidden="true">请填写联系人</div><div class = "legal" id="name_legal" hidden="true">填写合理</div ><div class = "clear"></div>
			<div class = "des"></div><input class = "input" placeholder="联系人号码"type="text" id="phone" name="phone" value="" size="40" maxlength="40"/><div class = "illegal" id="phone_illegal" hidden="true">号码不合法</div><div class = "legal" id="phone_legal" hidden="true">号码可用</div><div class = "clear"></div>
			<div class = "des"></div><input class = "input" placeholder="企业邮箱"type="text" id="email" name="email" value="" size="40" maxlength="40"/><div class = "illegal" id="email_illegal" hidden="true">邮箱不合法</div><div class = "legal" id="email_legal" hidden="true">邮箱可用</div ><div class = "clear"></div>
			<div class = "des"></div><input class = "input" placeholder="合作方式"type="text" id="way" name="way" value="" size="40" maxlength="40"/><div class = "illegal" id="way_illegal" hidden="true">请填写合作方式</div><div class = "legal" id="way_legal" hidden="true">填写合理</div ><div class = "clear"></div>
			<div class = "des"></div><textarea  placeholder="设计需求详情" type="text" id="details" name="details"></textarea><div></div><div class = "illegal" id="details_illegal" hidden="true">请填写至少20字</div><div class = "legal" id="details_legal" hidden="true">填写合理</div ><div class = "clear"></div>
			<input type="button" name="sub" id="sub" value="提交"/>
		</form>
	</div>
</div> 
	<script type="text/javascript">
			
			//光标移开判断Email是否合法
			$("#email").blur(function(){
				var email = $("#email").val();
				$.post("<?php echo site_url();?>/company/email_check",{email:email},function(msg){
					if(msg==1){
						$('#email_illegal').show();
						$('#email_legal').hide();
					}else{
						$('#email_illegal').hide();
						$('#email_legal').show();
					}
				});
			});	
			//光标移开判断phone是否合法
			$("#phone").blur(function(){
				var phone = $("#phone").val();
				$.post("<?php echo site_url();?>/company/phone_check",{phone:phone},function(msg){
					if(msg==1){
						$('#phone_illegal').show();
						$('#phone_legal').hide();
					}else{
						$('#phone_illegal').hide();
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
			//光标移开判断con_name是否合法
			$("#con_name").blur(function(){
				var con_name = $("#con_name").val();
				if(con_name==""){
					$('#con_name_illegal').show();
					$('#con_name_legal').hide();
				}else{
					$('#con_name_illegal').hide();
					$('#con_name_legal').show();
				}
			});	
			//光标移开判断details是否合法
			$("#details").blur(function(){
				var details = $("#details").val();
				if(details.length<20){
					$('#details_illegal').show();
					$('#details_legal').hide();
				}else{
					$('#details_illegal').hide();
					$('#details_legal').show();
				}
			});	
			//光标移开判断way是否合法
			$("#way").blur(function(){
				var way = $("#way").val();
				if(way==""){
					$('#way_illegal').show();
					$('#way_legal').hide();
				}else{
					$('#way_illegal').hide();
					$('#way_legal').show();
				}
			});
			$("#sub").click(function(){
				var email = $("#email").val();
				$.post("<?php echo site_url();?>/company/email_check",{email:email},function(msg){
					if(msg==1){
						$('#email_illegal').show();
						$('#email_legal').hide();
					}else{
						$('#email_illegal').hide();
						$('#email_legal').show();
					}
				});
				var phone = $("#phone").val();
				$.post("<?php echo site_url();?>/company/phone_check",{phone:phone},function(msg){
					if(msg==1){
						$('#phone_illegal').show();
						$('#phone_legal').hide();
					}else{
						$('#phone_illegal').hide();
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
				var con_name = $("#con_name").val();
				if(con_name==""){
					$('#con_name_illegal').show();
					$('#con_name_legal').hide();
				}else{
					$('#con_name_illegal').hide();
					$('#con_name_legal').show();
				}
				var details = $("#details").val();
				if(details.length<20){
					$('#details_illegal').show();
					$('#details_legal').hide();
				}else{
					$('#details_illegal').hide();
					$('#details_legal').show();
				}
				var way = $("#way").val();
				if(way==""){
					$('#way_illegal').show();
					$('#way_legal').hide();
				}else{
					$('#way_illegal').hide();
					$('#way_legal').show();
				}
				if($("#name_legal").is(":visible")&&$("#email_legal").is(":visible")&&
				$("#phone_legal").is(":visible")&&$("#con_name_legal").is(":visible")&&
				$("#details_legal").is(":visible")&&$("#way_legal").is(":visible") ){
					$("form").submit();
				}
			});
	</script>

