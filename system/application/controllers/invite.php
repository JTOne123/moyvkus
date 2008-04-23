<?php

class Invite extends Controller {
	
	function Invite()
	{
		parent::Controller();
		
		$this->load->library('usermanagment');
		$this->load->library('notification');
		
		$this->load->library('validation');
	}
	
	function _remap($method) {
		//страницы, доступные без авторизации
		$allowedPages = array();
		$pars = $this->uri->segment_array();
		unset($pars[1]);
		unset($pars[2]);
		
		
		if (($method != null) &&
				(($this->userauthorization->is_logged_in() !== false) ||  in_array($method, $allowedPages))) {
			call_user_func_array(array($this, $method), $pars);
		}
		else
			redirect('/login/', 'refresh');
	}
	
	function index()
	{
		$data = $this->_load_headers();
		
		$data = $this->_load_resource($data);
		
		$data = $this->_data_bind($data);
		
		$data['body']= $this->parser->parse('invite', $data);
		
		$this->parser->parse('main_tpl', $data);
	}
	
	function _load_headers()
	{
		$data['title'] = $this->lang->line('title').' - '.$this->lang->line('Invite');
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
		// Локализация надписей
		
		$data['Invite'] = $this->lang->line('Invite');
		$data['Information'] = $this->lang->line('Information');
		$data['Note'] = $this->lang->line('Note');
		$data['NoteAnswer'] = $this->lang->line('NoteAnswer');
		$data['Email'] = $this->lang->line('Email');
		$data['FirstName'] = $this->lang->line('FirstName');
		$data['LastName'] = $this->lang->line('LastName');
		$data['Send'] = $this->lang->line('Send');
		$data['Cancel'] = $this->lang->line('Cancel');
		
		return $data;
	}
	
	function _data_bind($data)
	{
		$rules['txtFirstName'] = "min_length[4]|max_length[100]";
		$rules['txtLastName'] = "min_length[4]|max_length[100]";
		$rules['txtEmail'] = "required|min_length[6]|max_length[100]|valid_email|callback_email_check";
		$this->validation->set_rules($rules);
		
		$fields['txtFirstName'] = $this->lang->line('Error_email');
		$fields['txtLastName'] = $this->lang->line('Error_firstname');
		$fields['txtEmail'] = $this->lang->line('Error_lastname');
		$this->validation->set_fields($fields);
		
		if($this->input->post('btnSend') != false)
		{
			$user_id = $this->userauthorization->get_loged_on_user_id();
			
			$friend_email = $this->input->post('txtEmail');
			$friend_first_name = $this->input->post('txtFirstName');
			$friend_last_name = $this->input->post('txtLastName');
			
			if($this->validation->run())
				if($this->usermanagment->IsUserExits($friend_email) == false)
				{
					if($this->is_allready_sended($friend_email) == false)
					{
						$this->add_to_invite_table($user_id, $friend_email, $friend_first_name, $friend_last_name);
						$this->notification->InviteFriend($user_id, $friend_email, $friend_first_name, $friend_last_name);
					}
				}
				else
				{
					$friend = $this->usermanagment->GetUserInfoByEmail($friend_email);
					redirect('/profile/id/' . $friend->id, 'refresh');	
				}
		}
		
		return $data;
	}
	
	function is_allready_sended($email)
	{
		$query = $this->db->query("SELECT COUNT(1) AS c FROM invite WHERE friend_email = '$email'");
		$row = $query->row();
		
		if($row->c == 0)
			return false;
		else
			return true;
	}
	
	function add_to_invite_table($user_id, $friend_email, $friend_first_name, $friend_last_name)
	{
		$this->db->query("INSERT INTO invite VALUES ($user_id, '$friend_email', '$friend_first_name', '$friend_last_name')");
	}
}
?>