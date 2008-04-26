<?php

class Send_Message extends Controller {
	
	function Send_Message()
	{
		parent::Controller();
		
		$this->load->library('usermanagment');
		$this->load->library('message');
		
		$this->load->library('validation');
		
		$this->load->helper('date');
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
		
		$data['body']= $this->parser->parse('send_message', $data);
		
		$this->parser->parse('main_tpl', $data);
	}
	
	function _load_headers()
	{
		$data['title'] = $this->lang->line('title') . ' - ' . $this->lang->line('send_message');
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
		
		$data['NewMessage'] = $this->lang->line('send_message');
		$data['From'] = $this->lang->line('From');
		$data['To'] = $this->lang->line('To');
		$data['Subject'] = $this->lang->line('Subject');
		$data['Text'] = $this->lang->line('Text');
		$data['Send'] = $this->lang->line('SendMessage');
		$data['Previous'] = $this->lang->line('Previous');
		$data['Cancel'] = $this->lang->line('Cancel');
		
		return $data;
	}
	
	function _data_bind($data)
	{
		$send_to_id = $this->uri->segment(4);	
		$user_id = $this->userauthorization->get_loged_on_user_id();
		
		$btnSend = $this->input->post('btnSend');
		if($btnSend == false)
		{	
			if($send_to_id != false)
			{
				$user = $this->usermanagment->GetUser($user_id);
				$friend = $this->usermanagment->GetUser($send_to_id);
				$friend_data = $this->usermanagment->GetUserData($send_to_id);
				
				if($friend != null)
				{
					$data['sended_to_id'] = $send_to_id;
					
					$data['UserFullName'] = $user->first_name . ' ' . $user->last_name;
					$data['FriendFullName'] = $friend->first_name . ' ' . $friend->last_name;
					$data['UserUrl'] = 'http://' . $_SERVER['HTTP_HOST'] . '/profile/id/' . $user->id;
					$data['FriendUrl'] = 'http://' . $_SERVER['HTTP_HOST'] . '/profile/id/' . $friend->id;
					
					if($friend_data->avatar_name != null)
						$data['AvatarUrl'] = '/uploads/user_avatars/' . $friend_data->avatar_name;
					else
						$data['AvatarUrl'] = "../../../images/noavatar.gif";
				}
				else
					redirect('', 'refresh');
			}
			else
				redirect('', 'refresh');
		}
		else
		{
			$txtSubject = $this->input->post('txtSubject');
			$txtText = $this->input->post('txtText');
			
			$this->message->SendMessage($user_id, $send_to_id, $txtSubject, $txtText);
			
			redirect('', 'refresh');
		}
		
		return $data;
	}
}
?>