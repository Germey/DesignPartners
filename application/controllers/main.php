<?php session_start();?>
<?php
/*
 * Created on 2014-9-18
 * 主页控制器
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
?>
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main extends CI_Controller {

	
	//加载头部
	protected function loadHeader(){
	
		$this->load->helper("url");
		$this->load->view("header");
		
	}
	
	//加载尾部
	protected function loadFooter(){

		$this->load->view("footer");
		
	}
	
	//加载轮播
	protected function loadCarousel(){
	
		$this->load->view("main/carousel");
		
	}
	
	//加载项目概览
	protected function loadPreProj(){
	
		//加载项目模型
		$this->load->model("Proj_model","proj");
		$result = $this->proj->preProj();
		for($i=0;$i<count($result);$i++){
			$result[$i]['image'] = $this->getUrlByKey($result[$i]['image']);
		}
		$vars['pre_proj'] = $result;
		//加载项目概览视图
		$this->load->view("main/project",$vars);
		
	}
	
	//加载工作坊训练营预览
	protected function loadWkshop(){
	
		//加载工作坊训练营模型
		$this->load->model("wkshop_model","wkshop");
		$result = $this->wkshop->getLimitTrainAndWorkShops(0,3);
		for($i=0;$i<count($result);$i++){
			$result[$i]['image'] = $this->getUrlByKey($result[$i]['image']);
		}
		$data['wkshops'] = $result;
		$this->load->view("main/workshop",$data);
		
	}
	
	//加载本周推荐设计师
	protected function loadWeekDes(){
	
		//加载设计师模型
		$this->load->model("Des_model",des);
		$result = $this->des->getThisWeekDesigners();
		for($i=0;$i<count($result);$i++){
			$result[$i]['image'] = $this->getUrlByKey($result[$i]['image']);
		}
		$data['week_des'] = $result;
		$this->load->view("main/designer",$data);
		
	}
	
	//加载主页
	public function index(){
		
		//依次加载各个视图
		$this->loadHeader();
		$this->loadCarousel();
		$this->loadPreProj();
		$this->loadWkshop();
		$this->loadWeekDes();
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
	public function about(){
		$this->loadHeader();
		$this->load->model("other_model","other");
		$result = $this->other->getAbout();
		$data['about'] = $result[0];
		$this->load->view("about/about",$data);
		$this->loadFooter();
	}

}