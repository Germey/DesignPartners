<div class = "main_wkshop">
	<div class = "wk_title"><div class = "title">工作坊/训练营</div><div class = "more"><a href = "<?php echo site_url();?>/workshop/workshops/">更多</a></div></div>
	<div class = "container">
	<?php foreach($wkshops as $item):?>
		<div class = "single">
			<div class = "img"><a href = "<?php echo site_url();?>/workshop/details/<?php echo $item['id'];?>"><img src = <?php echo $item['image']?>></a></div>
			<div class = "name"><a href = "<?php echo site_url();?>/workshop/details/<?php echo $item['id'];?>"><?php echo $item['name']?></a></div>
		</div>
	<?php endforeach;?> 
	</div>
	
</div>