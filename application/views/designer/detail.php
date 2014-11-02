<div class = "personal_info">
	<div class = "top">
		<div class = "img">
			<div><img src = "<?php echo $info['image'];?>" class = "image"></div>
			<?php if((isset($_SESSION['id']))&&($_SESSION['id'])==$info['id']) { ?>
				<div class = "change_info"><a href = "<?php echo site_url();?>/designer/changeInfo/<?php echo $info['id']?>">修改资料</a></div>
			<?php } ?>
		</div>
		<div class = "info">
			<div class = "name">
				<?php echo $info['name'];?>
			</div>
			<div class = "brief">
				<p class = "des">个人简介:</p>
				<?php 
					$brief =  $info['brief'];
					$brief = str_replace("\n", "<br>", $brief);
					$brief = str_replace(" ", "&nbsp;&nbsp;", $brief);
					echo $brief;
				?>
			</div>
		</div>
	</div>
	<div class = "container">
		<div class = "details">
			<div class = "item"><p class = "des">性别:</p>
				<?php if($info['sex'] == 0){?>
					未知
				<?php }else if($info['sex']==1){?>
					男	
				<?php }else if($info['sex']==2){?>
					女
				<?php }?>
			</div>
			<div class = "item"><p class = "des">账户是否激活:</p>
			<?php if($info['active']=='1'){?>
				已成功激活
			<?php }else{ ?>
				没有激活
				<?php if((isset($_SESSION['id']))&&($_SESSION['id'])==$info['id']) { ?>
				<a href = "<?php echo site_url();?>/register/reactivate">,点此</a>再次激活
			<?php }
				} ?>			
			</div>
			<div class = "item"><p class = "des">在读或毕业院校:</p><?php echo $info['college'];?></div>
			<div class = "item"><p class = "des">电子邮件:</p><?php echo $info['email'];?></div>
			<div class = "item"><p class = "des">详细介绍:</p>
			<?php 
			$detail = $info['details'];
			if(strlen($detail)==0){
				echo "TA什么也没有留下";
			}else{
				$detail = str_replace("\n", "<br>", $detail);
				$detail = str_replace(" ", "&nbsp;", $detail);
				echo $detail;
			}
			?>
			</div>
		</div>
	</div>
</div>