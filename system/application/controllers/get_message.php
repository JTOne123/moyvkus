<?php

class Get_Message extends Controller {
	
	function Get_Message()
	{
		parent::Controller();
		
		$this->load->library('validation');
		
		$this->load->library('usermanagment');
		$this->load->library('message');
		
		$this->load->helper('date');
		$this->load->helper('typography');
	}
	
	function _remap($method) {
		//��������, ��������� ��� �����������
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
		
		$data['body']= $this->parser->parse('get_message', $data);
		
		$this->parser->parse('main_tpl', $data);
	}
	
	function _load_headers()
	{
		$data['title'] = $this->lang->line('title').' - '.$this->lang->line('GetMessage');
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
		$data['GetMessage'] = $this->lang->line('GetMessage');
		$data['From'] = $this->lang->line('From');
		$data['To'] = $this->lang->line('To');
		$data['Subject'] = $this->lang->line('Subject');
		$data['Text'] = $this->lang->line('Text');
		$data['Answer'] = $this->lang->line('Answer');
		$data['Delete'] = $this->lang->line('Delete');
		
		return $data;
	}
	
	function _data_bind($data)
	{
		$user_id = $this->userauthorization->get_loged_on_user_id();
		
		$message_id = $this->uri->segment(4);
		
		if($message_id != false)
		{
			$delete_message_id = $this->uri->segment(5);
			
			if($delete_message_id != false)
				$this->message->DeleteMessage($delete_message_id, $user_id);
			
			$message =  $this->message->GetMessage($user_id, $message_id);
			
			if($message != false)
			{
				$user = $this->usermanagment->GetUser($user_id);
				$friend = $this->usermanagment->GetUser($message->from_id);
				$friend_data = $this->usermanagment->GetUserData($message->from_id);
				
				$data['UserFullName'] = $user->first_name . ' ' . $user->last_name;
				$data['FriendFullName'] = $friend->first_name . ' ' . $friend->last_name;
				$data['SubjectValue'] = $message->subject;
				$data['TextValue'] = auto_typography($message->text);
				
				if($friend_data->avatar_name != null)
					$avatar_url = '/uploads/user_avatars/'.$friend_data->avatar_name;
				else
					$avatar_url = "../../../images/noavatar.gif";
					
				$data['AvatarUrl'] = $avatar_url;
				
				$data['UserUrl'] = 'http://' . $_SERVER['HTTP_HOST'] . '/profile/id/' . $user_id;
				$data['FriendUrl'] = 'http://' . $_SERVER['HTTP_HOST'] . '/profile/id/' . $message->from_id;
				
				$data['AnswerUrl'] = 'http://' . $_SERVER['HTTP_HOST'] . '/send_message/send_to/id/' . $message->from_id . '/answer/id/' . $message->id;
				$data['MessageDeleteUrl'] = 'http://' . $_SERVER['HTTP_HOST'] . '/mymessages/delete/id/' . $message->id;
			}
			else
				redirect('/mymessages/', 'refresh');			
		}
		else
			redirect('/mymessages/', 'refresh');
		
		return $data;
	}
}
?>