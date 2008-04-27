<?php

class MessageBox extends Controller {
	
	function MessageBox()
	{
		parent::Controller();
		
		$this->load->library('usermanagment');
		$this->load->library('validation');
		
		$this->load->library('myfriendslib');
		
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
		
		$data['body']= $this->parser->parse('messagebox', $data);
		
		$this->parser->parse('main_tpl', $data);
	}
	
	function _load_headers()
	{
		$data['title'] = $this->lang->line('title');
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
		
		return $data;
	}
	
	function _data_bind($data)
	{
		if($this->input->post('btnYes') == false)
		{
			$action_type = $this->uri->segment(3);
			switch($action_type)
			{
				case 'delete_friend':
					$friend_id = $this->uri->segment(5);
					
					$data['Type'] = $action_type;
					$data['Item'] = "friend_id";
					$data['ItemId'] = $friend_id;
					
					$data['MessageBoxTitle'] = $this->lang->line('MessageBoxTitle');
					
					$friend = $this->usermanagment->GetUser($friend_id);
					
					$message = $this->lang->line('MessageBoxText');
					$message = str_replace("{FriendFullName}", $friend->first_name . ' ' . $friend->last_name, $message);
					$message = str_replace("{FriendUrl}", 'http://' . $_SERVER['HTTP_HOST'] . '/profile/id/' . $friend_id, $message);
					
					$data['MessageBoxText'] = $message;
					
					$data['DisplayYes'] = 'block';
					$data['DisplayNo'] = 'block';
					
					$data['Yes'] = $this->lang->line('Yes');
					$data['No'] = $this->lang->line('No');
					
					break;
				
				case 'warning':
					$warning_type = $this->uri->segment(4);
					
					switch($warning_type)
					{
						case 'spam':
							
							$data['Type'] = $action_type;
							$data['Item'] = $warning_type;
							$data['ItemId'] = "";
							
							$data['MessageBoxTitle'] = $this->lang->line('MessageBoxTitleSpamWarrning');
							$data['MessageBoxText'] = $this->lang->line('SpamWarning');
							
							$data['DisplayYes'] = 'block';
							$data['DisplayNo'] = 'none';
							
							$data['Yes'] = $this->lang->line('Cancel');
							
							break;
						default:
							redirect('', 'refresh');
							break;	
					}
					
					break;
				
				default:
					redirect('', 'refresh');
					break;
			}
		}
		else
		{
			$action_type = $this->uri->segment(3);
			switch($action_type)
			{
				case 'delete_friend':
					$friend_id = $this->uri->segment(5);
					$user_id = $this->userauthorization->get_loged_on_user_id();
					$this->myfriendslib->DeleteFriend($user_id, $friend_id);
					redirect('/myfriends/id/' . $user_id, 'refresh');
					
					break;
				
				case 'warning':
					redirect('', 'refresh');
					
					break;
					
				default:
					redirect('', 'refresh');
					break;
			}
		}
		
		return $data;
	}
}
?>