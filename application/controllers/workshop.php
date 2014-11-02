<?php session_start();?>
<?php
/*
 * Created on 2014-9-18
 * 工作坊/训练营控制器
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
?>
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Workshop extends CI_Controller {

	
	//读取头部
	protected  function loadHeader(){

		$this->load->helper("url");
		$this->load->view("header");
		
	}

	//读取尾部
    protected function loadFooter(){

	    $this->load->view("footer");

	}
	
	//读取分页表
	public function loadPagination($data){
	
		$this->load->view("workshop/pagination",$data);
		
	}
	
	//读取工作坊/训练营菜单
	public function loadWkMenu(){
	
		$this->load->view("workshop/menu");
		
	}
	
	//工作坊列表
	public function workshops($id = 0){
	
		$this->load->model("wkshop_model",wk);
		$workshops = $this->wk->getAllWorkShops();
	    $pageAll = count($workshops);
		$pagenum = 3;
		//配置分页文件
		$config['total_rows'] = $pageAll;
		//每页显示几个
		$config['per_page'] = $pagenum;
		$config['num_links'] = 3;
		$config['first_link'] = '首页';
        $config['last_link'] = '尾页';
        $config['next_link'] = '下页';
        $config['prev_link'] = '上页';
		$this->load->helper("url");
		//基地址
		$config['base_url'] = site_url()."/workshop/workshops";
		$this->load->library('pagination');
		$this->pagination->initialize($config);
		$start = $id;
		$result = $this->wk->getLimitWorkShops($start,$pagenum);
		for($i=0;$i<count($result);$i++){
			$result[$i]['image'] = $this->getUrlByKey($result[$i]['image']);
			$result[$i]['large_image'] = $this->getUrlByKey($result[$i]['large_image']);
		}
		$data['items'] = $result;
		$this->loadHeader();
		$this->loadWkMenu();
		$this->load->view("workshop/workshop",$data);
		$data['paginations'] = $this->pagination->create_links();
		$this->loadPagination($data);
		$this->loadFooter();
		
	}
	
	//训练营列表
	public function traincamps($id = 0){
	
		$this->load->model("wkshop_model",wk);
		$traincamps = $this->wk->getAllTrainCamps();
	    $pageAll = count($traincamps);
		$pagenum = 3;
		//配置分页文件
		$config['total_rows'] = $pageAll;
		//每页显示几个
		$config['per_page'] = $pagenum;
		$config['num_links'] = 3;
		$this->load->helper("url");
		//基地址
		$config['base_url'] = site_url()."/workshop/traincamps";
		$this->load->library('pagination');
		$this->pagination->initialize($config);
		$start = $id;
		$result = $this->wk->getLimitTrainCamps($start,$pagenum);
		for($i=0;$i<count($result);$i++){
			$result[$i]['image'] = $this->getUrlByKey($result[$i]['image']);
			$result[$i]['large_image'] = $this->getUrlByKey($result[$i]['large_image']);
		}
		$data['items'] = $result;
		$this->loadHeader();
		$this->loadWkMenu();
		$this->load->view("workshop/traincamp",$data);
		$data['paginations'] = $this->pagination->create_links();
		$this->loadPagination($data);
		$this->loadFooter();
		
	}
	
	//读取工作坊/训练营详情
	public function details($id = 0){
	
		$this->loadHeader();
		if($id==0){
			//默认值，说明未输入参数，提示无效链接
			$data['success'] = 5;
			$this->load->view("workshop/message",$data);
		}else{
			//加载工作坊模型
			$this->load->model("wkshop_model","wk");
			$desOfWkshop = $this->wk->getDesByWkshopId($id);
			for($i=0;$i<count($desOfWkshop);$i++){
				$desOfWkshop[$i]['image'] = $this->getUrlByKey($desOfWkshop[$i]['image']);
			}
			$joined = 0;
			//判断是否已经加入了该工作坊/训练营
			if(isset($_SESSION['id'])){
				$joined = $this->wk->isJoined($id,$_SESSION['id']);
			}
			$details = $this->wk->getWkshopDetails($id);
			$details[0]['image'] = $this->getUrlByKey($details[0]['image']);
			$data['details'] = $details;
			$data['designers'] = $desOfWkshop; 
			$data['joined'] = $joined;
			$this->load->view("workshop/detail",$data);
		}
		$this->loadFooter();
		
	}
	
	//查看资料完整度
	function infoCompleted($email){
	
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
	
	//判断工作坊/训练营是否存在
	protected function wkshopExist($id){
	
		$exist = 0;
		$this->load->model("wkshop_model","wk");
		$result = $this->wk->getInfoById($id);
		if($result){
			$exist = 1;
		}else{
			$exist = 0;
		}
		return $exist;
		
	}
	
	//加入工作坊/训练营
	public function join($workshop = 0){
	
		$this->loadHeader();
		//无效网址
		if($workshop == 0){
			$data['success'] = 5;
			$this->load->view("workshop/message",$data);
		}else if($this->wkshopExist($workshop)==0){
			$data['success'] = 6;
			$this->load->view("workshop/message",$data);
		}else if(!isset($_SESSION['email'])){
			//没有登录
			$data['success'] = 0;
			$this->load->view("workshop/message",$data);
		}else{
			//已经登录
			$email = $_SESSION['email'];
			$this->load->model("des_model","des");
			$infos = $this->des->getInfoByEmail($email);
			$active = $infos['active'];
			$data['wkshop_id'] = $workshop;
			if($active != 1){
				//登录了但是未激活
				$data['success'] = 2;
				$this->load->view("workshop/message",$data);
			}else{
				$complete = $this->infoCompleted($email);
				//资料完整度不够70%
				if($complete < 70){
					$data['success'] = 3;
					$this->load->view("workshop/message",$data);
				}else{
					//资料完整录入信息
					$this->load->model("wkshop_model","wk");
					$join_result = $this->wk->joinWkshop($workshop,$_SESSION['id']);
					if($join_result ==0){
						//插入失败
						$data['success'] = 7;
						$this->load->view("workshop/message",$data);
					}else if($join_result == 1){
						//插入数据成功
						$data['success'] = 8;
						$this->load->view("workshop/message",$data);
					}else if($join_result == 2){
						//已经加入该工作坊
						$data['success'] = 9;
						$this->load->view("workshop/message",$data);
					}else if($join_result == 3){
						//人数已满
						$data['success'] = 13;
						$this->load->view("workshop/message",$data);
					}
				}
			}
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
	
}