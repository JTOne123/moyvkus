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
		$data = $this->load_headrs();
		
		$data = $this->load_resource($data);
		
		$data = $this->data_bind($data);
		
		
		$data['body']= $this->parser->parse('myfriends', $data);
		
		$this->parser->parse('main_tpl', $data);
	}
	
	function load_headrs()
	{
		$data['title'] = $this->lang->line('MyFriends');
		$data['keywords'] = $this->lang->line('keywords');
		$data['description'] = $this->lang->line('description');
		$data['baseurl'] = base_url();
		$data['header'] = $this->load->view('header', $data, true);
		$data['menu']=$this->Menu->buildmenu();
		$data['login']='';
		
		return $data;
	}
	
	function load_resource($data)
	{
		// Локализация надписей
		$data['MyFriends'] = $this->lang->line('MyFriends');
		$data['FriendsFilter'] = $this->lang->line('FriendsFilter');
		$data['Search'] = $this->lang->line('Search');
		
		return $data;
	}
	
	function data_bind($data)
	{
		$query =  $this->myfriendslib->GetFriends(1, $this->input->post('InputFriendsFilter'));
		
		$friends_counts = str_replace("{Number}", $query->num_rows(), $this->lang->line('MyFriendsCount'));
		$data['FriendsCount'] = $friends_counts;
		
		$data['FriendsBuilder'] = $this->friends_builder($query);
		
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