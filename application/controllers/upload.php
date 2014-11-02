<?php
/*
 * Created on 2014-9-18
 * 上传文件的方法
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
?>
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class Upload extends CI_Controller {

	function getUptoken(){
		require_once(dirname(__FILE__)."/../../qiniu/rs.php");
		//远程存储空间名称
		$bucket = 'designpartners';
		$accessKey = 'IOImn35KC5pRX7Ov3scxbYkvNk6oIxB7zWsBRp16';
		$secretKey = 's29vc9tlCvs23wRh7QScYTuzCDmIbUSi4EroKj1z';
		Qiniu_SetKeys($accessKey, $secretKey);
		$putPolicy = new Qiniu_RS_PutPolicy($bucket);
		echo site_url();
		$putPolicy->ReturnUrl = site_url()."/upload/receiveInfo";
		$putPolicy->ReturnBody='{"key": $(key)}';
		//$putPolicy->ReturnBody="name=$(fname)&hash=$(etag)&fsize=$(fsize)";
		$upToken = $putPolicy->Token(null);
		echo "<br>";
		//echo $putPolicy->CallbackUrl();
		return $upToken;
	}
	
	public function receiveInfo(){
		$this->loadHeader();
		$upload_ret = $_GET['upload_ret'];
		$json_ret = base64_decode($upload_ret);
		$result=json_decode($json_ret);
		echo "key".$result->key; 
		$this->loadFooter();
	}
	
	
	//读取头部
	public function loadHeader(){

		$this->load->helper("url");
		$this->load->view("header_view");
	}
	
	//读取尾部
    public function loadFooter(){

	    $this->load->view("footer_view");

	}
	
	public function uploadPic(){
		
		$this->loadHeader();
		$upToken = $this->getUptoken();
	    $data['upToken'] = $upToken;
		$this->load->view('upload',$data);
		$this->loadFooter();
		
	}
	public function downloadPic(){
		require_once(dirname(__FILE__)."/../../qiniu/rs.php");
		$key = '00000';
		$domain = 'designpartners.qiniudn.com';
		$accessKey = 'IOImn35KC5pRX7Ov3scxbYkvNk6oIxB7zWsBRp16';
		$secretKey = 's29vc9tlCvs23wRh7QScYTuzCDmIbUSi4EroKj1z';
		echo "$$$$$$";
		Qiniu_SetKeys($accessKey, $secretKey);  
		$baseUrl = Qiniu_RS_MakeBaseUrl($domain, $key);
		$getPolicy = new Qiniu_RS_GetPolicy();
		$privateUrl = $getPolicy->MakeRequest($baseUrl, null);
		echo "====> getPolicy result: \n";
		echo $privateUrl . "\n";
	}
	
	public function stat(){
	
		require_once("qiniu/rs.php");

		$bucket = "";
		$key = "pic.jpg";
		$accessKey = '<YOUR_APP_ACCESS_KEY>';
		$secretKey = '<YOUR_APP_SECRET_KEY>';

		Qiniu_SetKeys($accessKey, $secretKey);
		$client = new Qiniu_MacHttpClient(null);

		list($ret, $err) = Qiniu_RS_Stat($client, $bucket, $key);
		echo "Qiniu_RS_Stat result: \n";
		if ($err !== null) {
			var_dump($err);
		} else {
			var_dump($ret);
		}
	
	}

}