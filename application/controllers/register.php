<?php session_start();?>
<?php
/*
 * Created on 2014-9-18
 * 提供注册的控制器
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */

?>
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Register extends CI_Controller {
	
	
	//读取头部
	private function loadHeader(){
	
		$this->load->helper("url");
		$this->load->view("header");
		
	}
	
	//读取尾部
    private function loadFooter(){

	    $this->load->view("footer");
		
	}
	
	//读取注册的表单
	private function loadRegForm(){
	
		$this->load->view("register/register");
		
	}
	
	//读取注册界面
	public function loadRegister(){
	
		$this->loadHeader();
		$this->loadRegForm();
		$this->loadFooter();
		
	}
	
	//处理表单提交的数据
	public function reg(){
		
		//获取四个内容
		$name = $this->input->post("name");
		$email = $this->input->post("email");
		$phone = $this->input->post("phone");
		$password = $this->input->post("password");
		//赋值到一个数组中
		$data['name'] = $name;
		$data['email'] = $email;
		$data['phone'] = $phone;
		$data['password'] = $password;
		//加载设计师模型
		$this->load->model("des_model","des");
		$email_chk= $this->des->checkEmail($email);
		$phone_chk = $this->des->checkPhone($phone);
		//读取头部
		$this->loadHeader();
		if((!$email_chk)&&(!$phone_chk)){
			$bool = $this->des->register($data);
			//判断是否注册成功
			if($bool){
			//注册成功
				$id = $this->des->getIdByEmail($email);
				$b = $this->send_email($email,$id,md5($password));
				if(b){
					$data['success'] = 1;
				}else{
					$data['success'] = 7;
				}
			}else{
			//注册失败
				$data['success'] = 0;
			}
			$this->load->view("register/message",$data);
		}else{
			//重复表单提交
			$data['success'] = 2;
			$this->load->view("register/message",$data);
		}
		//读取尾部
		$this->loadFooter();
		
	}
	
	//检验Email是否合法
	public function email_check(){
	
		$email = $_POST['email'];
		$this->load->model("des_model","des");
		$result = $this->des->checkEmail($email);
		if(!(preg_match("/\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*/",$email))){//正则表达式匹配邮箱格式是否正确
			echo "1";//邮箱格式不正确
		}else if($result){
			echo "2";//邮箱已经注册
		}
		
	}
	
	private function isActive($email){
		$this->load->model("des_model","des");
		$info = $this->des->getInfoByEmail($email);
		$active = $info['active'];
		if($active){
			return 1;
		}else{
			return 0;
		}
	}
	
	//再次发送激活邮件
	public function reactivate(){
	
		$this->loadHeader();
		if(isset($_SESSION['email'])){
			
			$email = $_SESSION['email'];
			$this->load->model("des_model","des");
			$info = $this->des->getInfoByEmail($email);
			$active = $this->isActive($email);
			if(!$active){
				$bool = $this->send_email($email,$info['id'],$info['password']);
				if($bool){
					//再次发送激活邮件成功
					$data['success'] = 15;
				}else{
					//发送邮件失败
					$data['success'] = 16;
				}
				$this->load->view("designer/message",$data);
			}else{
				$data['success'] = 17;
				$this->load->view("designer/message",$data);
			}
		}else{
			$data['success'] = 0;
			$this->load->view("designer/message",$data);
		}
		$this->loadFooter();
	}
	
	//检测号码是否合法
	public function phone_check(){
	
		$phone = $_POST['phone'];
		$this->load->model("des_model","des");
		$result = $this->des->checkPhone($phone);
		if((strlen($phone) != 11) || !(preg_match("/13[0123456789]{1}\d{8}|15[012356789]\d{8}|18[0123456789]\d{8}|17[678]\d{8}|14[57]\d{8}/",$phone))){
			//手机号码格式不正确
			echo "1";
		}else if($result){
			//手机号被注册
			echo "2";
		}
		
	}
	
	//邮箱激活
	public function activate($id,$password){
		
		//加载设计师模型
		$this->load->model("des_model","des");
		$pass = $this->des->getPassById($id);
		//读取头部
		$this->loadHeader();
		if($pass == $password){
			//链接用户名和密码匹配
			$res = $this->des->activateByIdAndPass($id,$password);
			if($res == 1){
				//激活成功
				$data['success'] = 3;
			}else if($res == 2){
				//重复激活
				$data['success'] = 4;
			}else{
				//激活失败
				$data['success'] = 5;	
			}
			$this->load->view('register/message',$data);
		}else{
			//无效的链接
			$data['success'] = 6; 
			$this->load->view('register/message',$data);
		}
		//读取尾部
		$this->loadFooter();
		
	}
	
	//发送激活邮件
	public function send_email($email,$id,$password){
		
	    //配置信息
		$config=Array(
				'crlf'          => "\r\n",
				'newline'       => "\r\n",
				'charset'       => 'utf-8',
				'protocol' =>  'smtp',
                'smtp_host'=>  "smtp.163.com",                	 // SMTP Server.  Example: mail.earthlink.net
                'smtp_user'=>  "19940629cqc@163.com",         	 // SMTP Username
                'smtp_pass'=>  "940629CQC",           	 		 // SMTP Password
                'smtp_port'=>  "25",                        	 // SMTP Port,default
				'mailtype'=> "HTML"
                );
		$this->load->library('email',$config);
		$this->email->from('19940629cqc@163.com');
		$this->email->to($email); 
		$this->email->subject('账户激活');
		$site = site_url();
		$content = "您好,感谢您加入设计合伙人，请点此链接激活您的账号".site_url()."/register/activate/".$id."/".$password;
		$this->email->message($content); 
		if($this->email->send()){
			return true;
		}
		else{
			return false;
		}
		
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

}