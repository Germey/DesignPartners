<?php
/*
 * Created on 2014-9-18
 * 
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
?>
<?php

	class Proj_model extends CI_Model{

		public function preProj(){
			$sql = "select * from project limit 0,4";
			$result = $this->db->query($sql);
			return $result->result_array();
		}
		public function getAllProjects(){
			$sql = "select * from project";
			$result = $this->db->query($sql);
			return $result->result();
		}
		public function getLimitProjects($start,$pageNum){
			$sql = "select * from project limit ".$start.",".$pageNum;
			$result = $this->db->query($sql);
			return $result->result_array();
			//var_dump($resut);
		}
		public function getProjDetails($id){
			$sql = "select * from project where id = ?";
			$result = $this->db->query($sql,$id);
			return $result->result_array();
			
		}
		public function joinProject($projId,$desId){
			//获得已经加入的人数
			$countSql = "select count(*) count from proj_designer where project_id = ".$projId;
			$count = $this->db->query($countSql)->result_array();
			$con = $count[0]['count'];
			//获得最大值
			$maxSql = "select * from project where id = ".$projId;
			$max = $this->db->query($maxSql)->result_array();
			$m = $max[0]['max'];
			$result = 0;
			if($con>=$m){
				$result = 3;
				return $result;
			}else{
				//检查是否已经存在了该数据
				$sql = "select * from proj_designer where project_id = ? and designer_id = ?";
				$datas[0] = $projId;
				$datas[1] = $desId;
				$r = $this->db->query($sql,$datas)->result_array();
				$result = 0;
				if($r){
					//存在了该数据
					$result = 2;
				}else{
					//不存在该数据，插入
					$sql = "insert into proj_designer (project_id,designer_id) values(?,?)";
					$data[0] = $projId;
					$data[1] = $desId;
					$bool = $this->db->query($sql,$data);
					if($bool){
						//插入成功
						$result = 1;
					}else{
						//插入失败
						$result = 0;
					}
				}
				return $result;
			}
		}
		public function getInfoById($id){
			$sql = "select * from project where id = '".$id."'";
			$result = $this->db->query($sql);
			return $result->result();
		}
		//传入项目id，返回加入的设计师列表
		public function getDesByProjId($projId){
			$sql = "select * from proj_designer a,designer b where a.designer_id = b.id and a.project_id = ?";
			$result = $this->db->query($sql,$projId);
			return $result->result_array();
		}
		//传入设计师id和项目id判断设计师是否加入
		public function isJoined($projId,$desId){
			$join = 0;
			$sql = "select * from proj_designer where project_id = ? and designer_id = ?";
			$datas[0] = $projId;
			$datas[1] = $desId;
			$r = $this->db->query($sql,$datas)->result_array();
			$result = 0;
			if($r){
				//已经加入了该项目
				$join = 1;
			}else{
				//未加入该项目
				$join = 0;
			}
			return $join;
		}
		
	}