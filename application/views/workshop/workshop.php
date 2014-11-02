<div class = "workshop">
	<div class = "container">
	<?php foreach($items as $item):?>
		<div class = "single_wrap">
			<div class = "single">
				<a href= "<?php echo site_url();?>/workshop/details/<?php echo $item['id'];?>">
					<div class = "left">
						<img src = "<?php echo $item['image']?>"/>
					</div>
					<div class = "right">
						<div class ="title">
							<?php echo $item['name'];?>
						</div>
						<div class = "content">
							<?php 
								   $str;
								   if(strlen($item['brief'])>400){
								 	  $str = substr($item['brief'],0,400)."...";
								   }else{
								 	  $str = $item['brief'];
								   }
								   echo $str;
								?>
						</div>
						<div class = "location">
							地点:<?php echo $item['location'];?>
						</div>
						<div class = "number">
							人数:<?php echo $item['max'];?>
						</div>
						<div class = "date">
							报名截止:<?php echo date('Y.m.d', strtotime($item['date']));?>
						</div>
					</div>
				</a>
			</div>
		</div>
	<?php endforeach;?> 
	</div>
</div>