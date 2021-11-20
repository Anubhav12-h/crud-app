<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	public function index()
	{
		$this->load->model('Usermodel');
		$rows = $this->Usermodel->all();
		$data['rows']= $rows;
		$this->load->view('user/list',$data);
	}
	
	public function showCreateForm(){
		
		$htmldata= $this->load->view('user/create','',true);
		$response['htmldata'] = $htmldata;
		echo json_encode($response);
	}
	
	public function saveModal(){
		
		$this->load->model('Usermodel');
		$this->load->library('form_validation');
		$this->form_validation->set_rules('name','Name','required');
		$this->form_validation->set_rules('email','Email','required|valid_email');
		$this->form_validation->set_rules('designation','Designation','required');
		$this->form_validation->set_rules('salary','Salary','required');
		$this->form_validation->set_rules('date','Date','required');
		
		if($this->form_validation->run()==true){
			
			$data = $this->input->post();
			
			$id = $this->Usermodel->create($data);
			
			$row = $this->Usermodel->getRow($id);
			
			$vData['row'] = $row;
			
			$rowhtml = $this->load->view('user/user_row',$vData,true);
			
			$response['row'] = $rowhtml;
			$response['status'] = 1;
			
			$response['message'] = "<div class=\"alert alert-success\">Record added successfuly.</div>";
			
		}else{
			
			$response['status'] = 0;
			$response['name'] = strip_tags(form_error('name'));
			$response['email'] = strip_tags(form_error('email'));
			$response['designation'] = strip_tags(form_error('designation'));
			$response['salary'] = strip_tags(form_error('salary'));
			$response['date'] = strip_tags(form_error('date'));
		}
		echo json_encode($response);
		
	}
	
	
	public function getuserdata($id){
		
		$this->load->model('Usermodel');
		$row = $this->Usermodel->getRow($id);
		$data['row'] = $row;
		
		$htmldata= $this->load->view('user/edit',$data,true);
		$response['htmldata'] = $htmldata;
		echo json_encode($response);
	}
	
	public function updateUser(){
		
		$this->load->model('Usermodel');
		$id = $this->input->post('id');
		$row = $this->Usermodel->getRow($id);
		//echo'<pre>';print_r($row);die;
		
		if(empty($row)){
			
			$response['msg'] = "Either record deleted or not found";
			$response['status'] = 100;
			json_encode($response);
			exit;
		}
		
		$this->load->model('Usermodel');
		$this->load->library('form_validation');
		$this->form_validation->set_rules('name','Name','required');
		$this->form_validation->set_rules('email','Email','required|valid_email');
		$this->form_validation->set_rules('designation','Designation','required');
		$this->form_validation->set_rules('salary','Salary','required');
		$this->form_validation->set_rules('date','Date','required');
		
		
		if($this->form_validation->run() == true){
			
			$data = $this->input->post();
			//echo'<pre>';print_r($id);die;
			$id = $this->Usermodel->update($data,$id);
			$row = $this->Usermodel->getRow($id);
			$response['row'] = $row;
			$response['status'] = 1;
			$response['message'] = "<div class=\"alert alert-success\">Record Updated successfuly.</div>";
			
		}else{
			
			$response['status'] = 0;
			$response['name'] = strip_tags(form_error('name'));
			$response['email'] = strip_tags(form_error('email'));
			$response['designation'] = strip_tags(form_error('designation'));
			$response['salary'] = strip_tags(form_error('salary'));
			$response['date'] = strip_tags(form_error('date'));
		}
		echo json_encode($response);
	}
	
	public function deleteModal(){
		
		 $id = $this->input->get('id');
		$this->load->model('Usermodel');
		$row = $this->Usermodel->getRow($id);
		
		if(empty($row)){
			
			$response['msg1'] = "<div class=\"alert alert-warning\">Either record deleted already or not found.</div>";
			$response['status'] = 0;
			json_encode($response);
			exit;
		}else{
			
			$this->Usermodel->delete($id);
			$response['msg2'] = "<div class=\"alert alert-success\">Record has been deleted.</div>";
			$response['status'] = 1;
			 json_encode($response);
		}
		
		echo json_encode($response);
	}
	
	
}

?>