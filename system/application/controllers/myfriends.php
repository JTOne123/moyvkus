<?php

class MyFriends extends Controller {
	
	function MyFriends()
	{
		parent::Controller();
		
		$this->load->library('validation');
		
		$this->load->library('usermanagment');
		$this->load->library('myfriendslib');
		
		$this->load->helper('date');
	}
	
	function index()
	{
		$data = $this->_load_headers();
		
		$data = $this->_load_resource($data);
		
		$data = $this->_data_bind($data);

		$data['body']= $this->parser->parse('myfriends', $data);
		
		$this->parser->parse('main_tpl', $data);
	}
	
	function _load_headers()
	{
		$data['title'] = $this->lang->line('title').' - '.$this->lang->line('MyFriends');
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
		$data['MyFriends'] = $this->lang->line('MyFriends');
		$data['FriendsFilter'] = $this->lang->line('FriendsFilter');
		$data['Search'] = $this->lang->line('Search');
		
		return $data;
	}
	
	function _data_bind($data)
	{
		$user_id = $this->uri->segment(3);
		if($user_id != null)
		{
			$query =  $this->myfriendslib->GetFriends($user_id, $this->input->post('InputFriendsFilter'));
			
			$friends_counts = str_replace("{Number}", $query->num_rows(), $this->lang->line('MyFriendsCount'));
			$data['FriendsCount'] = $friends_counts;
			
			$data['FriendsBuilder'] = $this->friends_builder($query);
		}
		else
		{
			redirect('', 'refresh');
		}
		return $data;
	}
	
	function friends_builder($query)
	{
		$friend_item = $this->myfriendslib->GetFriendsBuilderHTML();
		$friend_item = str_replace("{FullNameText}", $this->lang->line('FirstNameText'), $friend_item);
		$friend_item = str_replace("{FriendRatingLevelText}", $this->lang->line('MyRatingLevelText'), $friend_item);
		$friend_item = str_replace("{FriendBestRecipeText}", $this->lang->line('MyBestRecipesText'), $friend_item);
		$friend_item = str_replace("{SendMessage}", $this->lang->line('SendMessage'), $friend_item);
		$friend_item = str_replace("{FriendFriends}", $this->lang->line('FriendFriends'), $friend_item);
		$friend_item = str_replace("{DeleteFriend}", $this->lang->line('DeleteFriend'), $friend_item);
		
		$friends_list = "";
		
		foreach ($query->result() as $row)
		{	
			$friend = $this->usermanagment->GetUser($row->friend_id);
			$friend_data = $this->usermanagment->GetUserData($row->friend_id);
			
			$friend_current = str_replace("{FriendFullName}", $friend->first_name . ' ' . $friend->last_name, $friend_item);
			$friend_current = str_replace("{FriendUrl}", 'http://' . $_SERVER['HTTP_HOST'] . '/profile/id/' . $row->friend_id, $friend_current);
			$friend_current = str_replace("{FriendFriendsUrl}", 'http://' . $_SERVER['HTTP_HOST'] . '/myfriends/id/' . $row->friend_id, $friend_current);
			$friend_current = str_replace("{DeleteFriendUrl}", 'http://' . $_SERVER['HTTP_HOST'] . '/messagebox/type/delete_friend/friend_id/' . $row->friend_id, $friend_current);
			
			if($friend_data->avatar_url != null)
				$avatar_url = $user_data->avatar_url;
			else
				$avatar_url = "../../images/noavatar.gif";
				
			$friend_current = str_replace("{FriendAvatarUrl}", $avatar_url, $friend_current);
			
			$friends_list = $friends_list . $friend_current;
		}
		return $friends_list;
	}
}
?>