<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model
{
	
	public function __construct()
	{
		parent::__construct();
		//alternative load library from config
		$this->load->database();
	}

	public function get_all()
	{
		return $this->db->get('tbl_person')->result();
	}

	public function get($id)
	{
		$query =  $this->db->select('*')->from('tbl_person')->where('id', $id)->get();
		return $query->result();
	}

	public function insert($arr_data)
	{
		$this->db->insert('tbl_person',$arr_data);
		return $this->db->insert_id();
	}

	public function update($id, $arr_data)
	{
		$this->db->where('id', $id);
		$this->db->update('tbl_person', $arr_data);
		return $this->db->affected_rows();
	}

	public function delete($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('tbl_person');
	}
}

