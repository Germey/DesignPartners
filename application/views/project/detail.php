<?php 
	$result = $details[0];
?>
<div class = "proj_details">
	<div class = "title">
		<?php echo $result['name']?>
	</div>
	<div class = "container">
		<div class = "top"></div>
		<div class = "content">
			<div class = "left">
				<div><img class = "img" src = "<?php echo $result['large_image'];?>"></div>
				<div class = "brief">
					<div class = "h">项目简介</div>
					<?php 
					$brief =  $result['brief'];
					$brief = str_replace("\n", "<br>", $brief);
					$brief = str_replace(" ", "&nbsp;&nbsp;", $brief);
					echo $brief;
					?>
				</div>	
				<div class = "details">
					<div class = "h">项目详情</div>
					<?php 
					$detail = $result['details'];
					if(strlen($detail)==0){
						echo "暂无介绍";
					}else{
						$detail = str_replace("\n", "<br>", $detail);
						$detail = str_replace(" ", "&nbsp;&nbsp;", $detail);
						echo $detail;
					}
					?>
				</div>
			</div>
			<div class = "right">
				<?php if($result['max']>0){ ?>
					<div class = "isJoined">
						<?php if(!$joined){?>
						<a href ="<?php echo site_url();?>/project/join/<?php echo $result['id'];?>">加入项目</a>
						<?php }else{?>
						<a>您已加入</a>
						<?php }?>
					</div>
				<?php }else{ ?>
					<div class = "isJoined">
						<a>暂未开放加入</a>
					</div>
				<?php } ?>
				<div class = "designers">
					<div class = "des_title">已经加入的设计师</div>
					<?php 
					if(count($designers)>0){
					foreach($designers as $item):?>
						<div class = "designer">
							<div><a href = "<?php echo site_url();?>/designer/loadInfo/<?php echo $item['id'];?>"><img src = "<?php echo $item['image']?>" class = "des_img"></a></div>
							<div class = "des_name"><a href = "<?php echo site_url();?>/designer/loadInfo/<?php echo $item['id'];?>"><?php echo $item['name']?></a></div>
						</div>
					<?php endforeach;
					}else{ ?>
					  <div class = "none">暂无加入者</div>
					<?php
					}
					?> 
				</div>
			</div>
		</div>
	</div>
</div>