<?php
/*
 * Created on 2014-9-18
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
?>
<?php

	class Other_model extends CI_Model{

		public function getAbout(){
			$sql = "select * from data";
			$result = $this->db->query($sql);
			return $result->result_array();
		}
		
		
	}