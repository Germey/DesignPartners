<?php session_start();?>
<?php
/*
 * Created on 2014-9-18
 * 项目控制器
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
?>
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Project extends CI_Controller {

	
	//读取头部
	protected function loadHeader(){

		$this->load->helper("url");
		$this->load->view("header");
	}

	//读取尾部
    protected function loadFooter(){

	    $this->load->view("footer");

	}
	
	//读取分页内容
	public function loadPagination($data){
	
		$this->load->view("project/pagination",$data);
		
	}
	
	//读取项目页面
	public function pagelist($id = 0){
	
		$this->load->model("proj_model",proj);
		$projects = $this->proj->getAllProjects();
	    $pageAll = count($projects);
		$pagenum = 3;
		$config['total_rows'] = $pageAll;
		$config['per_page'] = $pagenum;
		$config['num_links'] = 3;
		$config['first_link'] = '首页';
        $config['last_link'] = '尾页';
        $config['next_link'] = '下页';
        $config['prev_link'] = '上页';
		$this->load->helper("url");
		$config['base_url'] = site_url()."/project/pagelist";
		$this->load->library('pagination');
		$this->pagination->initialize($config);
		$start = $id;
		$result = $this->proj->getLimitProjects($start,$pagenum);
		for($i=0;$i<count($result);$i++){
			$result[$i]['image'] = $this->getUrlByKey($result[$i]['image']);
			$result[$i]['large_image'] = $this->getUrlByKey($result[$i]['large_image']);
		}
		$data['projects'] = $result;
		$this->loadHeader();
		$this->load->view("project/project",$data);
		$data['paginations'] = $this->pagination->create_links();
		$this->loadPagination($data);
		$this->loadFooter();
		
	}
	
	
	//查看资料完整度
	protected function infoCompleted($email){
		
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
	
	//判断该项目是否存在
	protected function projExist($id){
	
		$exist = 0;
		$this->load->model("proj_model","proj");
		$result = $this->proj->getInfoById($id);
		if($result){
			$exist = 1;
		}else{
			$exist = 0;
		}
		return $exist;
		
	}
	
	//加入项目
	public function join($project = 0){
	
		$this->loadHeader();
		//无效网址
		if($project == 0){
			$data['success'] = 5;
			$this->load->view("project/message",$data);
		}else if($this->projExist($project)==0){
			$data['success'] = 6;
			$this->load->view("project/message",$data);
		}else if(!isset($_SESSION['email'])){
			//没有登录
			$data['success'] = 0;
			$this->load->view("project/message",$data);
		}else{
			//已经登录
			$email = $_SESSION['email'];
			$this->load->model("des_model","des");
			$infos = $this->des->getInfoByEmail($email);
			$active = $infos['active'];
			$data['proj_id'] = $project;
			if($active != 1){
				//登录了但是未激活
				$data['success'] = 2;
				$this->load->view("project/message",$data);
			}else{
				$complete = $this->infoCompleted($email);
				//资料完整度不够70%
				if($complete < 70){
					$data['success'] = 3;
					$this->load->view("project/message",$data);
				}else{
					//资料完整录入信息
					$this->load->model("proj_model","proj");
					$join_result = $this->proj->joinProject($project,$_SESSION['id']);
					if($join_result ==0){
						//插入失败
						$data['success'] = 7;
						$this->load->view("project/message",$data);
					}else if($join_result == 1){
						//插入数据成功
						$data['success'] = 8;
						$this->load->view("project/message",$data);
					}else if($join_result == 2){
						//已经加入该项目
						$data['success'] = 9;
						$this->load->view("project/message",$data);
					}else if($join_result == 3){
						//人数已满
						$data['success'] = 13;
						$this->load->view("project/message",$data);
					}
				}
			}
		}
		$this->loadFooter();
		
	}
	
	//查看项目详情
	public function details($id = 0){
	
		$this->loadHeader();
		if($id==0){
			$data['success'] = 5;
			$this->load->view("project/message",$data);
		}else{
			$this->load->model("proj_model","proj");
			$desOfProj = $this->proj->getDesByProjId($id);
			for($i=0;$i<count($desOfProj);$i++){
				$desOfProj[$i]['image'] = $this->getUrlByKey($desOfProj[$i]['image']);
			}
			$joined = 0;
			if(isset($_SESSION['id'])){
				$joined = $this->proj->isJoined($id,$_SESSION['id']);
			}
			$details = $this->proj->getProjDetails($id);
			$details[0]['large_image'] = $this->getUrlByKey($details[0]['large_image']);
			$data['details'] = $details;
			$data['designers'] = $desOfProj;
			$data['joined'] = $joined;
			$this->load->view("project/detail",$data);
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