
<script>
	function isValidateFile(obj) {
		var extend = document.form.file.value.substring(document.form.file.value.lastIndexOf(".") + 1);
		if (extend == "") {
			alert("请选择头像");
			return false;
		}
		else {
			if (!(extend == "jpg" || extend == "png")) {
			alert("请上传后缀名为xls或doc的文件!");
			return false;
			}
		}
		return true;
	}
</script>
<form method="post" action="http://up.qiniu.com" name = "form" enctype="multipart/form-data" onsubmit="return isValidateFile('file');">
    <ul>
            <input type="hidden"  id="token" name="token"  value=<?php echo $upToken?>>
        <li>
            <label for="key">key:</label>
            <input name="key" value="">
        </li>
        <li>
            <label for="bucket">照片:</label>
            <input name="file"  type="file" />
        </li>
        <li>
            <input type="submit" value="提交" >
        </li>
    </ul>
</form>