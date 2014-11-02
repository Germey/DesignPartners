<div class = "change_info">
	<form  action = "<?php echo site_url()?>/designer/updateInfo" method="post">
		<div class = "top">
			<div class = "img">
				<img src = "<?php echo $info['image'];?>" class = "image">
				<div class = "change_image"><a href = "<?php echo site_url();?>/designer/changeImage/<?php echo $info['id'];?>">修改头像</a></div>
			</div>
			<div class = "info">
				<div class = "name">
					姓名<input type="text" id="form_name" name="form_name" value="<?php echo $info['name'];?>" size="40" maxlength="40"/>
				</div>
				<div class = "brief">
					<p class = "des">个人简介</p>
					<textarea rows="3" cols="20" id = "form_brief" name = "form_brief" ><?php 
					$brief =  $info['brief'];
					$brief = str_replace("\n", "<br>", $brief);
					$brief = str_replace(" ", "&nbsp;&nbsp;", $brief);
					echo $brief;
				?></textarea>
				</div>
			</div>
		</div>
		<div class = "container">
			<div class = "details">
				<div class = "item"><p class = "des">性别</p>
					<select id = "form_sex" name = "form_sex">  
					  <option value ="0" <?php echo $info['sex']==0?"selected":"";?>>未知</option>  
					  <option value ="1" <?php echo $info['sex']==1?"selected":"";?>>男</option>  
					  <option value ="2" <?php echo $info['sex']==2?"selected":"";?>>女</option>  
					</select>  
				</div>
				<div class = "item" ><p class = "des">在读或毕业院校</p>
					<textarea rows="5" cols="20" id = "form_college" name = "form_college"><?php echo trim($info['college']);?></textarea>
				</div>
				<div class = "item" ><p class = "des">详细介绍</p>
				<textarea rows="5" cols="20" id = "form_details" name = "form_details"><?php 
					$detail = $info['details'];
					$detail = str_replace("\n", "<br>", $detail);
					$detail = str_replace(" ", "&nbsp;", $detail);
					echo $detail;
				?></textarea>
				</div>
				
			</div>
		</div>
		<div>
			<input type="hidden" id="form_email" name="form_email" value="<?php echo $info['email'];?>" />
			<input type="hidden" id="form_id" name="form_id" value="<?php echo $info['id'];?>" />
			<input type = "submit" name = "form_sub" id = "form_sub" value = "提交" />
		</div>
	</form>
</div>