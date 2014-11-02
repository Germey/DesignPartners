<?php
/*
 * Created on 2014-9-18
 * 设计师模型，与设计师有关的所有数据库操作
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
?>
<?php

	class Des_model extends CI_Model{
		
		//接受数据并插入数据
		public function register($data){
			//插入数据
			$sql = "insert into designer(name,email,phone,password) values(?,?,?,md5(?))";
			$bool = $this->db->query($sql,$data);
			return $bool;
		}
		public function login($email){
			$sql = "select * from designer where email = '".$email."'";
			$result = $this->db->query($sql);
			return $result->result();
		}
		public function checkEmail($email){
			$sql = "select * from designer where email = '".$email."'";
			$result = $this->db->query($sql);
			return $result->result();
		}
		public function checkPhone($phone){
			$sql = "select * from designer where phone = '".$phone."'";
			$result = $this->db->query($sql);
			return $result->result();
		}
		public function getAllDesigners(){
			$sql = "select * from designer";
			$result = $this->db->query($sql);
			return $result->result();
		}
		public function getLimitDesigners($start,$pageNum){
			$sql = "select * from designer limit ".$start.",".$pageNum;
			$result = $this->db->query($sql);
			return $result->result_array();
			//var_dump($resut);
		}
		public function getThisWeekDesigners(){
			$sql = "select * from designer limit ?,?";
			$data[0] = 0;
			$data[1] = 4;
			$result = $this->db->query($sql,$data);
			return $result->result_array();
		}
		public function getIdByEmail($email){
			$sql = "select * from designer where email = ?";
			$result = $this->db->query($sql,$email)->result_array();
			$r = $result[0];
			return  $r['id'];
			
		}
		public function getEmailById($id){
			$sql = "select * from designer where id = ?";
			$result = $this->db->query($sql,$id)->result_array();
			$r = $result[0];
			return  $r['email'];
			
		}
		public function isActive($email){
			$sql = "select * from designer where email = ?";
			$result = $this->db->query($sql,$email)->result_array();
			$res = $result[0];
			return  $res['active'];
		}
		
		public function getPassById($id){
			$sql = "select * from designer where id = ?";
			$result = $this->db->query($sql,$id)->result_array();
			$r = $result[0];
			return  $r['password'];
			
		}
		public function activateByIdAndPass($id,$password){
			$sql = "update designer set active = 1 where id = ? and password = ?";
			$data[0]=$id;
			$data[1]=$password;
			//操作数据库结果
			$result = 0;
			$bool = $this->db->query($sql,$data);
			$num = $this->db->affected_rows();
			if($bool&&($num!=0)){
				$result = 1;
			}else if($bool&&($num==0)){
				$result = 2;
			}
			return $result;
		}
		public function getInfoById($id){
			$sql = "select * from designer where id = ?";
			$infos = $this->db->query($sql,$id)->result_array();
			$info = $infos[0];
			return $info;
		}
		
		public function getInfoByEmail($email){
			$sql = "select * from designer where email = ?";
			$infos = $this->db->query($sql,$email)->result_array();
			$info = $infos[0];
			return $info;
		}
		public function updateInfo($name = "",$brief = "",$details = "",$sex = 0,$college = "",$email = ""){
			$data[0] = $name; $data[1] = $brief; $data[2] = $details; $data[3] = $sex; $data[4] = $college; $data[5] = $email;
			$sql = "update designer set name = ?,brief = ?,details = ?,sex = ?,college = ? where email = ?";
			$bool = $this->db->query($sql,$data);
			return $bool;
		}
		public function getNowImage($id){
			$sql = "select image from designer where id = '".$id."'";
			$result = $this->db->query($sql);
			return $result->result_array();
		}
		public function changeImage($id,$image){
			$sql = "update designer set image = '".$image."' where id = '".$id."'";
			$bool = $this->db->query($sql);
			return $bool;
		}
		
	}