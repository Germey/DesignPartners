<div class = "week_des">
	<div class = "title">本周推荐设计师
		<div class = "more"><a href = "<?php echo site_url();?>/designer/pagelist/">更多</a></div>
	</div>
	<div class = "container">
	<?php foreach($week_des as $item):?>
		<div class = "single">
			<div><a href = "<?php echo site_url();?>/designer/loadInfo/<?php echo $item['id']?>"><img src = <?php echo $item['image']?> class = "img"></a></div>
			<div class = "name"><a href = "<?php echo site_url();?>/designer/loadInfo/<?php echo $item['id']?>"><?php echo $item['name']?></a></div>
			<div class = "brief"><?php echo $item['brief']?></div>
		</div>
	<?php endforeach;?> 
	</div>
	
</div>