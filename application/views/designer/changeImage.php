<script>
	function isValidateFile(obj) {
		var extend = document.form.file.value.substring(document.form.file.value.lastIndexOf(".") + 1);
		if (extend == "") {
			alert("请选择头像");
			return false;
		}
		else {
			if (!(extend == "jpg" || extend == "png")) {
			alert("请上传后缀名为jpg或png的文件!");
			return false;
			}
		}
		return true;
	}
</script>
<script type="text/javascript" src="../../../js/prototype.js"></script>
<script type="text/javascript" src="../../../js/cropper/scriptaculous.js?load=builder,dragdrop"></script>
<script type="text/javascript" src="../../../js/cropper/cropper.js"></script>
<script type="text/javascript">
var position=new Array();
function onEndCrop(opic){
	$('x1').value=position[0]=opic.x1;
	$('y1').value=position[1]=opic.y1;
	$('x2').value=position[2]=opic.x2;
	$('y2').value=position[3]=opic.y2;
}
Event.observe(window,'load',function(){
		new Cropper.ImgWithPreview('opic',{minWidth:120,minHeight:90,ratioDim:{x:10,y:10},displayOnInit:true,onEndCrop:onEndCrop,previewWrap:'preview'})
	});		
</script>
<div class = "changeImage">
	<div class = "left">
		<img src = "<?php echo $nowImage?>" class = "portrait" />
		<?php
		if($key){
		?>
			<div>
				<a href = "<?php echo site_url();?>/designer/saveImage/<?php echo $id."/".$key;?>"><input class = "save" type = "button" value = "保存"></a>
			</div>
		<?php 
		}
		?>
	</div>
	<div class = "right">
			<form method="post" action="http://up.qiniu.com" name = "form" enctype="multipart/form-data" onsubmit="return isValidateFile('file');">
				<input type="hidden"  id="token" name="token"  value=<?php echo $upToken?>>
				<input type = "hidden" name="key" value="<?php echo $id;?>_<?php echo time();?>">
				<label for="bucket">上传新头像</label><br>
				<input name="file"  type="file" id = "file"/><br>
				<input type="submit" id = "sub" value="提交" >
			</form>
	</div>
</div>