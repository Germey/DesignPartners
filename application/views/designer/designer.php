
<div class = "designers">
	<!--
	<div class = "title">
		检索&nbsp;
		<?php 
		$letters = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
		for($i=0;$i<26;$i++){
		?>
			<a href = "<?php echo site_url();?>/designer/search/<?php echo substr($letters,$i,1);?>"><?php echo substr($letters,$i,1);?></a>
		<?php
		}
		?>
	</div>	
	-->
	<div class = "container">
	<?php foreach($designers as $item):?>
		<div class = "single_wrap">
			<div class = "single">
				<div><a href = "<?php echo site_url();?>/designer/loadInfo/<?php echo $item['id'];?>"><img src = <?php echo $item['image']?> class = "img"></a></div>
				<div class = "name"><?php echo $item['name']?></div>
				<div class = "sex">
					<?php if($item['sex'] == 0){?>
						未知性别
					<?php }else if($item['sex']==1){?>
						男	
					<?php }else if($item['sex']==2){?>
						女
					<?php }?>
				</div>
				<div class= "information"><a href = "<?php echo site_url();?>/designer/loadInfo/<?php echo $item['id'];?>">个人中心</a></div>
			</div>
		</div>
	<?php endforeach;?> 
	</div>
</div>