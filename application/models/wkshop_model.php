<?php
/*
 * Created on 2014-9-18
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
?>
<?php

	class Wkshop_model extends CI_Model{

		public function getAllWorkShops(){
			$sql = "select * from workshop where type = 0";
			$result = $this->db->query($sql);
			return $result->result();
		}
		public function getLimitWorkShops($start,$pageNum){
			$sql = "select * from workshop where type = 0 limit ".$start.",".$pageNum;
			$result = $this->db->query($sql);
			return $result->result_array();
			//var_dump($resut);
		}
		public function getAllTrainCamps(){
			$sql = "select * from workshop where type = 1";
			$result = $this->db->query($sql);
			return $result->result();
		}
		public function getLimitTrainCamps($start,$pageNum){
			$sql = "select * from workshop where type = 1 limit ".$start.",".$pageNum;
			$result = $this->db->query($sql,$data);
			return $result->result_array();
			//var_dump($resut);
		}
		public function getLimitTrainAndWorkShops($start,$pageNum){
			$sql = "select * from workshop  limit ?,?";
			$data[0] = $start;
			$data[1] = $pageNum;
			$result = $this->db->query($sql,$data);
			return $result->result_array();
			//var_dump($resut);
		}
		public function getWkshopDetails($id){
			$sql = "select * from workshop where id = ?";
			$result = $this->db->query($sql,$id);
			return $result->result_array();
		}
		//传入工作坊/训练营id，返回加入的设计师列表
		public function getDesByWkshopId($wkshopId){
			$sql = "select * from workshop_designer a,designer b where a.designer_id = b.id and a.workshop_id = ?";
			
			$result = $this->db->query($sql,$wkshopId);
			return $result->result_array();
		}
		public function getInfoById($id){
			$sql = "select * from workshop where id = '".$id."'";
			$result = $this->db->query($sql);
			return $result->result();
		}
		public function joinWkshop($wkshopId,$desId){
			$countSql = "select count(*) count from workshop_designer where workshop_id = ".$wkshopId;
			$count = $this->db->query($countSql)->result_array();
			$con = $count[0]['count'];
			$maxSql = "select * from workshop where id = ".$wkshopId;
			$max = $this->db->query($maxSql)->result_array();
			$m = $max[0]['max'];
			$result = 0;
			if($con>=$m){
				$result = 3;
				return $result;
			}else{
				//检查是否已经存在了该数据
				$sql = "select * from workshop_designer where workshop_id = ? and designer_id = ?";
				$datas[0] = $wkshopId;
				$datas[1] = $desId;
				$r = $this->db->query($sql,$datas)->result_array();
				
				if($r){
					//存在了该数据
					$result = 2;
				}else{
					//不存在该数据，插入
					$sql = "insert into workshop_designer (workshop_id,designer_id) values(?,?)";
					$data[0] = $wkshopId;
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
		//传入设计师id和训练营/工作坊id判断设计师是否加入
		public function isJoined($wkshopId,$desId){
			$join = 0;
			$sql = "select * from workshop_designer where workshop_id = ? and designer_id = ?";
			$datas[0] = $wkshopId;
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