<div class = "personal_details">
	<div class = "brief">
		<div class = "container">
			<div class = "img">
				<img src = "<?php echo $info['image'];?>" width="130" height="130"></img>
			</div>
			<div class = "name"><?php echo $info['name'];?></div>
			<div class = "status">0积分 0粉丝 0关注&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;个人标签：交互设计 工业设计 商业模式</div>
			<div class = "line"></div>
			<div class = "mess">
				<?php if(strlen($info['brief'])==0){
					echo "这个人很聪明，不留下一点痕迹。";
				}else{ 
					echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
					$brief =  $info['brief'];
					echo $brief;
				}
				?>
			</div>
			<div class = "attention">
				<div class = "add_attention">
					+关注
				</div>
				<div class = "leave_msg">
					&nbsp;留言&nbsp;
				</div>
			</div>
		</div>
	</div>
	<div class = "content">
		<div class = "list">
			<ul>
				<li><a href="javascript:showProject();">项目</a></li>
				<li><a href="javascript:showWorkshop();">工作坊</a></li>
				<li><a href="javascript:showTraincamp();">训练营</a></li>
			</ul>
		</div>
		<div id = "cont_details">
			<div  id = "d_projPreview">
				<div class = "projPreContent">
					<?php if(count($pre_proj)==0){ ?>
						<div id = "proj_no_join" class = "no_join">尚未加入项目</div>
					<?php }else{  
					foreach($pre_proj as $item):?>
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
					<?php endforeach;}?> 
				</div>
			</div><!-- 项目-->
			<div  id = "d_workshop"> 
				<div class = "container">
				<?php if(count($workshops)==0){ ?>
					<div  class = "no_join">尚未加入工作坊</div>
				<?php }else{ foreach($workshops as $workshop):?>
					<div class = "single_wrap">
						<div class = "single">
							<a href= "<?php echo site_url();?>/workshop/details/<?php echo $workshop['id'];?>">
								<div class = "left">
									<img src = "<?php echo $workshop['image']?>"/>
								</div>
								<div class = "right">
									<div class ="title">
										<?php echo $workshop['name'];?>
									</div>
									<div class = "content">
										<?php 
											   $str;
											   if(strlen($workshop['brief'])>400){
												  $str = substr($workshop['brief'],0,400)."...";
											   }else{
												  $str = $workshop['brief'];
											   }
											   echo $str;
											?>
									</div>
									<div class = "location">
										地点:<?php echo $workshop['location'];?>
									</div>
									<div class = "number">
										人数:<?php echo $workshop['max'];?>
									</div>
									<div class = "date">
										报名截止:<?php echo date('Y.m.d', strtotime($workshop['date']));?>
									</div>
								</div>
							</a>
						</div>
					</div>
				<?php endforeach;}?> 
				</div>
			</div><!--工作坊-->
			<div  id = "d_traincamp">
				<div class = "container">
				<?php if(count($traincamps)==0){ ?>
					<div class = "no_join">尚未加入训练营</div>
				<? }else{
					foreach($traincamps as $traincamp):?>
					<div class = "single_wrap">
						<div class = "single">
								<a href= "<?php echo site_url();?>/workshop/details/<?php echo $traincamp['id'];?>">
									<div class = "left">
										<img src = "<?php echo $traincamp['image']?>"/>
									</div>
									<div class = "right">
										<div class ="title">
											<?php echo $traincamp['name'];?>
										</div>
										<div class = "content">
											<?php 
											   $str;
											   if(strlen($traincamp['brief'])>400){
												  $str = substr($traincamp['brief'],0,400)."...";
											   }else{
												  $str = $traincamp['brief'];
											   }
											   echo $str;
											?>
										</div>
										<div class = "location">
											地点:<?php echo $traincamp['location'];?>
										</div>
										<div class = "number">
											人数:<?php echo $traincamp['max'];?>
										</div>
										<div class = "date">
											报名截止:<?php echo date('Y.m.d', strtotime($traincamp['date']));?>
										</div>
									</div>
								</a>
						</div>
					</div>
				<?php endforeach;}?> 
				</div>
			</div><!--训练营-->
		</div>
	</div>
	<div class = "comment">
	</div>
</div>
