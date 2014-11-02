<?php session_start();?>
<?php
/*
 * Created on 2014-9-18
 * 设计师控制器
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
?>

<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class Designer extends CI_Controller {

	
	//读取头部
	private function loadHeader(){

		$this->load->helper("url");
		$this->load->view("header");
		
	}
	
	//读取尾部
    private function loadFooter(){

	    $this->load->view("footer");

	}
	
	//显示设计师列表
	public function pagelist($id = 0){
	
		$this->load->model("des_model",des);
		$designers = $this->des->getAllDesigners();
	    $pageAll = count($designers);
		$pagenum = 6;
		$config['total_rows'] = $pageAll;
		$config['per_page'] = $pagenum;
		$config['num_links'] = 3;
		$config['first_link'] = '首页';
        $config['last_link'] = '尾页';
        $config['next_link'] = '下页';
        $config['prev_link'] = '上页';
		$this->load->helper("url");
		$config['base_url'] = site_url()."/designer/pagelist";
		$this->load->library('pagination');
		$this->pagination->initialize($config);
		$start = $id;
		$result = $this->des->getLimitDesigners($start,$pagenum);
		for($i=0;$i<count($result);$i++){
			$result[$i]['image'] = $this->getUrlByKey($result[$i]['image']);
		}
		$data['designers'] = $result;
		$this->loadHeader();
		$this->load->view("designer/designer",$data);
		$data['paginations'] = $this->pagination->create_links();
		$this->loadPagination($data);
		$this->loadFooter();
		
	}
	
	//读取分页条
	public function loadPagination($data){
	
		$this->load->view("designer/pagination",$data);
		
	}
	
	
	//查看个人信息
	public function loadInfo($id = 0){
	
		if($id == 0){
			$data['success'] = 5;
			$this->load->view("designer/message",$data);
		}
		$this->loadHeader();
		$this->load->model("des_model","des");
		$result = $this->des->getInfoById($id);
		$result['image'] = $this->getUrlByKey($result['image']);
		$data['info'] = $result;
		$this->load->view("designer/detail",$data);
		$this->loadFooter();
		
	}
	
	
	//修改资料处理函数
	public function updateInfo(){
		
		//获取表单提交的数据
		$id = $this->input->post('form_id');
		$name = $this->input->post('form_name');
		$brief = $this->input->post('form_brief');
		$sex = $this->input->post('form_sex');
		$details = $this->input->post('form_details');
		$college = $this->input->post('form_college');
		$this->loadHeader();
		if(!isset($_SESSION['email'])){
			//没有登录
			$data['success'] = 0;
			$this->load->view("designer/message",$data);
		}else{
			//已经登录
			$this->load->model('des_model',"des");
			$query_id = $this->des->getIdByEmail($_SESSION['email']);
			if($id != $query_id){
				//判断修改的是否是自己的信息，防止恶意表单提交
				$data['success'] = 1;
				$this->load->view("designer/message",$data);
			}else{
				//修改的是自己的信息,合法
				$this->load->model("des_model","des");
				$bool = $this->des->updateInfo($name,$brief,$details,$sex,$college,$_SESSION['email']);
				$data['success'] = 4;
				$data['complete'] = $this->infoCompleted($_SESSION['email']);
				$this->load->view("designer/message",$data);
			}
			
		}
		$this->loadFooter();
		
	}
	
	
	//查看资料完整度
	protected function infoCompleted($email){
		
		//完整度初始化
		$complete = 0;
		$this->load->model("des_model","des");
		$infos = $this->des->getInfoByEmail($email);
		if(strlen($infos['name'])>0){
			$complete+=1;
		}
		if(strlen($infos['image'])>0){
			$complete+=2;
		}
		if(strlen($infos['brief'])>0){
			$complete+=2;
		}
		if(strlen($infos['phone'])>0){
			$complete+=1;
		}
		if(strlen($infos['college'])>0){
			$complete+=2;
		}
		if($infos['sex']!=0){
			$complete+=1;
		}
		if(strlen($infos['details'])>0){
			$complete+=3;
		}
		//返回资料完整度
		return round($complete*100/12,0);
		
	}
	
	//修改信息
	public function changeInfo($id = 0){
	
		$this->loadHeader();
		$this->load->model("des_model","des");
		$email = $this->des->getEmailById($id);
		if(!(isset($_SESSION['email']))){
			//未登录
			$data['success'] = 0;
			$this->load->view('designer/message',$data);
		}else if($_SESSION['email']!=$email){
			//登录了但是用户不匹配
			$data['success'] = 10;
			$this->load->view('designer/message',$data);
		}else{
			$info = $this->des->getInfoById($id);
			$info['image'] = $this->getUrlByKey($info['image']);
			$data['info'] = $info;
			$this->load->view("designer/change",$data);
		}
		$this->loadFooter();
		
	}
	
	//获得随机验证码
	function getRandom($num = 4){
	
		$code = "";
		for ($i = 0; $i < $num; $i++) {
			$code .= rand(0, 9);
		}
		//将生成的验证码写入session，备验证页面使用
		$this->session->set_userdata('passcode',$code);
		
	}
	
	//生成验证码
	function getCode($num=4,$w=60,$h=31) {
	
		$this->getRandom(4);
		$code = $this->session->userdata('passcode');
		//创建图片，定义颜色值
		Header("Content-type: image/PNG");
		$im = imagecreate($w, $h);
		$black = imagecolorallocate($im, 0, 0, 0);
		$gray = imagecolorallocate($im, 200, 200, 200);
		$bgcolor = imagecolorallocate($im, 255, 255, 255);

		imagefill($im, 0, 0, $gray);

		//画边框
		imagerectangle($im, 0, 0, $w-1, $h-1, $black);

		//随机绘制两条虚线，起干扰作用
		$style = array (
			$black,
			$black,
			$black,
			$black,
			$black,
			$gray,
			$gray,
			$gray,
			$gray,
			$gray
		);
		imagesetstyle($im, $style);
		$y1 = rand(0, $h);
		$y2 = rand(0, $h);
		$y3 = rand(0, $h);
		$y4 = rand(0, $h);
		imageline($im, 0, $y1, $w, $y3, IMG_COLOR_STYLED);
		imageline($im, 0, $y2, $w, $y4, IMG_COLOR_STYLED);

		//在画布上随机生成大量黑点，起干扰作用;
		for ($i = 0; $i < 80; $i++) {
			imagesetpixel($im, rand(0, $w), rand(0, $h), $black);
		}
		//将数字随机显示在画布上,字符的水平间距和位置都按一定波动范围随机生成
		$strx = rand(3, 8);
		for ($i = 0; $i < $num; $i++) {
			$strpos = rand(1, 6);
			imagestring($im, 5, $strx, $strpos, substr($code, $i, 1), $black);
			$strx += rand(8, 12);
		}
		imagepng($im);
		imagedestroy($im);
		
	}
	public function saveImage($id,$key){
		$this->loadHeader();
		$this->load->model("des_model","des");
		$bool = $this->des->changeImage($id,$key);
		if($bool){
			$data['success'] = 13;
		}else{
			$data['success'] = 14;
		}
		$this->load->view("designer/message",$data);
		$this->loadFooter();
	}
	
	//修改头像
	public function changeImage($id = 0){
		$this->loadHeader();
		$this->load->model("des_model","des");
		$email = $this->des->getEmailById($id);
		if(!(isset($_SESSION['email']))){
			//未登录
			$data['success'] = 0;
			$this->load->view('designer/message',$data);
		}else if($_SESSION['email']!=$email){
			//登录了但是用户不匹配
			$data['success'] = 10;
			$this->load->view('designer/message',$data);
		}else{
			
			//登录且用户匹配
			$nowImage = $this->getNowImage($id);
			$data['nowImage'] = $nowImage;
			$data['id'] = $id;
			$data['upToken'] = $this->getUptoken($id);
			//如果收到七牛返回的信息
			if($_GET['upload_ret']){
				$upload_ret = $_GET['upload_ret'];
				$json_ret = base64_decode($upload_ret);
				$result=json_decode($json_ret);
				$key = $result->key;
				$data['key'] = $key;
				$data['nowImage'] = $this->getUrlByKey($key);
			}
			$this->load->view("designer/changeImage",$data);
		}
		$this->loadFooter();
		
	}
	
	//获取AccsssKey
	private function getAccessKey(){
	
		$accessKey = 'IOImn35KC5pRX7Ov3scxbYkvNk6oIxB7zWsBRp16';
		return $accessKey;
		
	}
	
	//获取secretKey
	private function getSecretKey(){
		
		$secretKey = 's29vc9tlCvs23wRh7QScYTuzCDmIbUSi4EroKj1z';
		return $secretKey;
		
	}
	
	//传入资源名称，返回资源URL
	private function getUrlByKey($key,$bucket = "designpartners"){
	
		//从七牛云存储获取URL
		require_once(dirname(__FILE__)."/../../qiniu/rs.php");
		$domain = $bucket.".qiniudn.com";
		$accessKey = $this->getAccessKey();
		$secretKey = $this->getSecretKey();
		Qiniu_SetKeys($accessKey, $secretKey);  
		$baseUrl = Qiniu_RS_MakeBaseUrl($domain, $key);
		$getPolicy = new Qiniu_RS_GetPolicy();
		$privateUrl = $getPolicy->MakeRequest($baseUrl, null);
		return $privateUrl;
		
	}
	
	//获取上传凭证
	private function getUptoken($id){
	
		require_once(dirname(__FILE__)."/../../qiniu/rs.php");
		//远程存储空间名称
		$bucket = 'designpartners';
		$accessKey = $this->getAccessKey();
		$secretKey = $this->getSecretKey();
		Qiniu_SetKeys($accessKey, $secretKey);
		$putPolicy = new Qiniu_RS_PutPolicy($bucket);
		$putPolicy->ReturnUrl = site_url()."/designer/changeImage/".$id;
		$putPolicy->ReturnBody='{"key": $(key)}';
		$upToken = $putPolicy->Token(null);
		return $upToken;
		
	}
	
	//获得当前头像URL
	protected function getNowImage($id){
	
		$bucket = "designpartners";
		$this->load->model("des_model","des");
		$result = $this->des->getNowImage($id);
		$image = $result[0]['image'];
		$key = $image;
		$imageUrl = $this->getUrlByKey($key,$bucket);
		return $imageUrl;
		
	}
	
	
}