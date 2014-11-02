
<div class = "projPreview">
	<div class = "title">项目
		<div class = "more"><a href = "<?php echo site_url();?>/project/pagelist/">更多</a></div>
	</div>
	<div class = "projPreContent">
		<?php foreach($pre_proj as $item):?>
		<div class = "projSingle">
			<div class = "introduction">
				<div class = "name">
					<a href = "<?php echo site_url();?>/project/details/<?php echo $item['id']?>"><?php echo $item['name']?></a>
				</div>
				<div class ="location">
					地点:<?php echo $item['location']?>
				</div>
				<div class ="recruit">
					招募:<br><?php echo $item['recruit']?>
				</div>
				<div class ="enddate">
					报名截止:<?php echo date('Y.m.d', strtotime($item['end_date']));?>
				</div>
			</div>
			<div class = "img">
				<a href = "<?php echo site_url();?>/project/details/<?php echo $item['id']?>"><img src = <?php echo $item['image']?> /></a>
			</div>
		</div>
		<?php endforeach;?> 
	</div>
</div>