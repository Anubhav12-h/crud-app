<?php

class Usermodel extends CI_Model{

	public function __construct()

	{
		parent::__construct();
		
		$this->load->database();
	}
	
	public function getRow($id){
		
			$this->db->where('id', $id);
			$row = $this->db->get('user')->row_array();
			//echo'<pre>';print_r($row);die;
			return $row;
	}
	
	public function all(){
		
		$result= $this->db->order_by('id','asc')
						->get('user')
						->result_array();
						
						return $result;
	}
				
	public function create($data){
		
		     $query = array(
						'name' => $data['name'],
						'email' => $data['email'],
						'design' => $data['designation'],
						'salary' => $data['salary'],
						'date' => $data['date']
				  );
			$this->db->insert('user',$query);
			 $id = $this->db->insert_id('user',$query);
			return $id;
	}
		
	public function update($data,$id) 
	{
		     $query = array(
						'name' => $data['name'],
						'email' => $data['email'],
						'design' => $data['designation'],
						'salary' => $data['salary'],
						'date' => $data['date']
				    );
			$this->db->where('id',$id);
			$this->db->update('user',$query);
			return $id;
	}
	
	public function delete($id)
	{
			$qry = $this->db->delete('user',array('id' => $id));
			return $qry;
		}	
}
?>










