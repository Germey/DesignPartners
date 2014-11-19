<?php
/*
 * Created on 2014-9-18
 * 公司模型，处理与公司企业有关的信息
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
?>
<?php

	class Con_model extends CI_Model{
		
		//接受数据并插入数据
		public function sub($data){
			//插入数据
			$sql = "insert into scheme (con_name,name,email,phone,way,details) values ('".$data[0]."','".$data[1]."','".$data[2]."','".$data[3]."','".$data[4]."','".$data[5]."')";
			$bool = $this->db->query($sql);
			return $bool;
			
		}
		

	}