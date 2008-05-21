<?php

class Search extends Controller {
	
	function Search()
	{
		parent::Controller();
		
		$this->load->library('validation');
		
		$this->load->library('usermanagment');
		$this->load->library('message');
		
		$this->load->helper('date');
	}
	
	function index()
	{
		$data = $this->_load_headers();
		
		$data = $this->_load_resource($data);
		
		$data = $this->_data_bind($data);
		
		$data['body']= $this->parser->parse('search', $data);
		
		$this->parser->parse('main_tpl', $data);
	}
	
	function _load_headers()
	{
		$data['title'] = $this->lang->line('title').' - '.$this->lang->line('MyMessages');
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
		$data['MyMessages'] = $this->lang->line('MyMessages');
		$data['MessagesFilter'] = $this->lang->line('MessagesFilter');
		$data['Search'] = $this->lang->line('Search');
		
		return $data;
	}
	
	function _data_bind($data)
	{
		$user_id = $this->userauthorization->get_loged_on_user_id();
		
		$delete_message_id = $this->uri->segment(4);
		
		if($delete_message_id != false)
			$this->message->DeleteMessage($delete_message_id, $user_id);
		
		$query =  $this->message->GetMessages($user_id, $this->input->post('InputFriendsFilter'));
		
		$friends_counts = str_replace("{Number}", $query->num_rows(), $this->lang->line('MyMessagesCount'));
		$data['MessagesCount'] = $friends_counts;
		
		$data['MessageListBuilder'] = $this->messages_list_builder($query);
		
		return $data;
	}
	
	function messages_list_builder($query)
	{
		$message_item = $this->message->GetMessageListBuilderHTML();
		$message_item = str_replace("{Sender}", $this->lang->line('Sender'), $message_item);
		$message_item = str_replace("{Subject}", $this->lang->line('MessageSubject'), $message_item);
		$message_item = str_replace("{Action}", $this->lang->line('Action'), $message_item);
		$message_item = str_replace("{Answer}", $this->lang->line('Answer'), $message_item);
		$message_item = str_replace("{Delete}", $this->lang->line('Delete'), $message_item);
		
		$messages_list = "";
		
		foreach ($query->result() as $row)
		{	
			$friend = $this->usermanagment->GetUser($row->from_id);
			$friend_data = $this->usermanagment->GetUserData($row->from_id);
			
			$message_current = str_replace("{AuthorFullName}", $friend->first_name . ' ' . $friend->last_name, $message_item);
			$message_current = str_replace("{AuthorUrl}", 'http://' . $_SERVER['HTTP_HOST'] . '/profile/id/' . $row->from_id, $message_current);
			$message_current = str_replace("{MessageSubject}", substr($row->subject, 0, 30), $message_current);
			$message_current = str_replace("{MessageShortText}", substr($row->text, 0, 30), $message_current);
			$message_current = str_replace("{MessageDate}", $row->date, $message_current);
			$message_current = str_replace("{AnswerUrl}", 'http://' . $_SERVER['HTTP_HOST'] . '/send_message/send_to/id/' . $row->from_id . '/answer/id/' . $row->id , $message_current);
			$message_current = str_replace("{MessageDeleteUrl}", 'http://' . $_SERVER['HTTP_HOST'] . '/mymessages/delete/id/' . $row->id , $message_current);
			$message_current = str_replace("{MessageUrl}", 'http://' . $_SERVER['HTTP_HOST'] . '/get_message/message/id/' . $row->id , $message_current);
			
			if($friend_data->avatar_name != null)
				$avatar_url = '/uploads/user_avatars/'.$friend_data->avatar_name;
			else
				$avatar_url = "../../images/noavatar.gif";
			
			$message_current = str_replace("{AuthorAvatarUrl}", $avatar_url, $message_current);
			
			$messages_list = $messages_list . $message_current;
		}
		return $messages_list;
	}
}
?>