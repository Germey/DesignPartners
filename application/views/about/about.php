<div class = "about">
<!--
<div class = "video">
	<object id="MediaPlayer" classid="clsid:22D6F312-B0F6-11D0-94AB-0080C74C7E95" width="500" height="400" standby="Loading Windows Media Player components…" type="application/x-oleobject" codebase="http://activex.microsoft.com/activex/controls/mplayer/en/nsmp2inf.cab#Version=6,4,7,1112">
	<param name="FileName" value="视频地址">
	<param name="AutoStart" value="true">
	<param name="ShowControls" value="true">
	<param name="BufferingTime" value="2">
	<param name="ShowStatusBar" value="true">
	<param name="AutoSize" value="true">
	<param name="InvokeURLs" value="false">
	<param name="AnimationatStart" value="1">
	<param name="TransparentatStart" value="1">
	<param name="Loop" value="1">
	<embed type="application/x-mplayer2" src="../../video/1.mov" name="MediaPlayer" autostart="1" showstatusbar="1" showdisplay="1" showcontrols="1" loop="0" videoborder3d="0" pluginspage="http://www.microsoft.com/Windows/MediaPlayer/" width="800" height="600"></embed>
	</object>
</div>
-->
<div class = "intro">
	<div class = "title"><b>设计合伙人</b></div>
	<?php 
	$detail = $about['value'];
	$detail = str_replace("\n", "<br>", $detail);
	$detail = str_replace(" ", "&nbsp;&nbsp;", $detail);
	echo $detail;
	?>
</div>
</div>