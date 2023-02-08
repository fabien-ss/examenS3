<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class utils_model extends CI_Model {

	public function findClient($res){
		$query = $this->db->query("select id, name, address, 'zip code', phone, city, country, notes, SID from customer_list where name like '%$res%'");
		$data = array();
		$i = 0;
		foreach($query->result_array() as $row){
			$data[$i]['id'] = $row['ID'];
			$data[$i]['name'] = $row['name'];
			$data[$i]['address'] = $row['address'];
			$data[$i]['phone'] = $row['phone'];
			$data[$i]['city'] = $row['city'];
			$data[$i]['country'] = $row['country'];
			$data[$i]['notes'] = $row['notes'];
			$data[$i]['SID'] = $row['SID'];
			$i++;
		}
		return $data;
	}
	public function findClientById($id){
		$query = $this->db->query("select customer_id, store_id, first_name, email, address_id, active, create_date, last_update from customer where customer_id='$id'");
		$row = $query->row_array();
		return $row;
	}
	public function getListeClient(){
		$query = $this->db->query("select id, name, address, 'zip code', phone, city, country, notes, SID from customer_list");
		$data = array();
		$i = 0;
		foreach($query->result_array() as $row){
			$data[$i]['id'] = $row['ID'];
			$data[$i]['name'] = $row['name'];
			$data[$i]['address'] = $row['address'];
			$data[$i]['phone'] = $row['phone'];
			$data[$i]['city'] = $row['city'];
			$data[$i]['country'] = $row['country'];
			$data[$i]['notes'] = $row['notes'];
			$data[$i]['SID'] = $row['SID'];
			$i++;
		}
		return $data;
	}
	public function checkUser($email, $password)
	{
		$query = $this->db->query("select * from utilisateur where email='$email' and motdepasse='$password'");
		$row = $query->row_array();
		if($row){
			$this->load->library('session');
			$this->session;
			$this->session->set_userdata('user', $row);
			return true;
		}
		return false;
	}		
}
