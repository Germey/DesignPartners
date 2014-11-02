
<?php
/*
 * Created on 2014-9-18
 * 企业控制器
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
?>
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Company extends CI_Controller {

	
	//加载头部
	protected function loadHeader(){
	
		$this->load->helper("url");
		$this->load->view("header");
		
	} 
	//加载尾部
	protected function loadFooter(){

		$this->load->view("footer");
		
	}
	
	//读取设计需求表
	public function scheme(){
	
		$this->loadHeader();
		$this->load->view("company/submit");
		$this->loadFooter();
		
	}
	
	//提交设计需求表格处理函数
	public function subscheme(){
	
		//读取头部
		$this->loadHeader();
		//读取六个内容
		$con_name = $this->input->post("con_name");
		$name = $this->input->post("name");
		$email = $this->input->post("email");
		$phone = $this->input->post("phone");
		$way = $this->input->post("way");
		$details = $this->input->post("details");
		//赋值到一个数组中
		$data[0] = $con_name;
		$data[1] = $name;
		$data[2] = $email;
		$data[3] = $phone;
		$data[4] = $way;
		$data[5] = $details;
		//加载设计师模型
		$this->load->model("con_model","con");
		$bool = $this->con->sub($data);
		//判断是否注册成功
		if($bool){
		    //添加成功
			$d['success'] = 1;
		}else{
			//添加失败
			$d['success'] = 2;
		}	
		$this->load->view("company/message",$d);
		$this->loadFooter();
	
	}
	
	//检验Email是否合法
	public function email_check(){
	
		$email = $_POST['email'];
		if(!(preg_match("/\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*/",$email))){//正则表达式匹配邮箱格式是否正确
			//邮箱格式不正确
			echo "1";
		}
		
	}
	
	//检测号码是否合法
	public function phone_check(){
	
		$phone = $_POST['phone'];
		$this->load->model("des_model","des");
		$result = $this->des->checkPhone($phone);
		if((strlen($phone) != 11) || !(preg_match("/13[0123456789]{1}\d{8}|15[012356789]\d{8}|18[0123456789]\d{8}|17[678]\d{8}|14[57]\d{8}/",$phone))){
			//手机号码格式不正确
			echo "1";
		}
	}

}