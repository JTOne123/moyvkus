<?php

class Forget_password extends Controller {
	
	function Forget_password()
	{
		parent::Controller();
		
		$this->load->library('user_managment');
		$this->load->library('notification');
		
		$this->load->library('validation');
		
		$this->load->helper('string');
	}
	
	function index()
	{
		$data = $this->_load_headers();
		
		$data = $this->_load_resource($data);
		
		$data = $this->_data_bind($data);
		
		$data['body']= $this->parser->parse('forget_password', $data);
		
		$this->parser->parse('main_tpl', $data);
	}
	
	function _load_headers()
	{
		$data['title'] = $this->lang->line('title').' - '.$this->lang->line('ForgetPassword');
		$data['keywords'] = $this->lang->line('keywords');
		$data['description'] = $this->lang->line('description');
		$data['baseurl'] = base_url();
		$data['header'] = $this->load->view('header', $data, true);
		$data['menu']=$this->Menu->buildmenu();
		$data['login']='';
		
		return $data;
	}
	
	function _load_resource($data)
	{
		// ����������� ��������
		
		$data['ForgetPassword'] = $this->lang->line('ForgetPassword');
		$data['InformationForgetPassword'] = $this->lang->line('InformationForgetPassword');
		$data['NoteForgetPassword'] = $this->lang->line('NoteForgetPassword');
		$data['NoteAnswerForgetPassword'] = $this->lang->line('NoteAnswerForgetPassword');
		$data['Email'] = $this->lang->line('Email');
		$data['SendForgetPassword'] = $this->lang->line('SendForgetPassword');
		$data['Cancel'] = $this->lang->line('Cancel');
		
		return $data;
	}
	
	function _data_bind($data)
	{
		$rules['txtEmail'] = "required|min_length[6]|max_length[100]|valid_email";
		$this->validation->set_rules($rules);
		
		$fields['txtEmail'] = $this->lang->line('Error_email');
		$this->validation->set_fields($fields);
		
		if($this->validation->run())
		{
			$email = $this->input->post('txtEmail');
			
			if($this->user_managment->IsUserExits($email))
			{
				$user = $this->user_managment->GetUserInfoByEmail($email);
				
				$user_code = $this->user_managment->new_password_request($user->id);
				
				$this->notification->Forget_password($user->id, $user_code);
				
				redirect('', 'refresh');	
			}
		}
		
		return $data;
	}
	

}
?>