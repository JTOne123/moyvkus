<?php

class MyFriends extends Controller {
	
	function MyFriends()
	{
		parent::Controller();
		
		$this->load->library('validation');
		
		$this->load->library('user_managment');
		$this->load->library('my_friends_lib');
		$this->load->library('receipes_management');
		
		$this->load->helper('date');
	}
	
	function _remap($method) {
		//��������, ��������� ��� �����������
		$allowedPages = array();
		$pars = $this->uri->segment_array();
		unset($pars[1]);
		unset($pars[2]);
		
		
		if (($method != null) &&
				(($this->user_authorization->is_logged_in() !== false) ||  in_array($method, $allowedPages))) {
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
		// ����������� ��������
		$data['MyFriends'] = $this->lang->line('MyFriends');
		$data['FriendsFilter'] = $this->lang->line('FriendsFilter');
		$data['Search'] = $this->lang->line('Search');
		
		return $data;
	}
	
	function _data_bind($data)
	{
		$current_user_id = $this->user_authorization->get_loged_on_user_id();
		$action_type = $this->uri->segment(2);
		$user_id = $this->uri->segment(3);
		
		if($action_type != null)
		{
			if($user_id != null)
			switch($action_type)
			{
				case 'id':
					$data = $this->show_friends($user_id, $data);
					break;
				
				case 'confirm_friend_id':
					$this->my_friends_lib->ConfirmFriend($user_id, $current_user_id);
					redirect('/myfriends/id/' . $current_user_id, 'refresh');
					break;
				
				case 'reject_friend_id':
					$this->my_friends_lib->DeleteFriend($current_user_id, $user_id);
					redirect('/myfriends/id/' . $current_user_id, 'refresh');
					break;
				
				default:
					redirect('/myfriends/id/' . $current_user_id, 'refresh');
					break;
			}
		}
		else
			redirect('/myfriends/id/' . $current_user_id, 'refresh');
		
		return $data;
	}
	
	function show_friends($user_id, $data)
	{
		$data['UserID'] = $user_id;
		
		$query_friends =  $this->my_friends_lib->GetFriends($user_id, $this->input->post('InputFriendsFilter'));
		
		$new_friends_count = 0;
		if($user_id == $this->user_authorization->get_loged_on_user_id())
		{
			$query_not_confirmed_friends =  $this->my_friends_lib->GetNewFriends($user_id, $this->input->post('InputFriendsFilter'));
			$new_friends_count = $query_not_confirmed_friends->num_rows();
		}
		
		if($new_friends_count == 0)
		{
			$friends_counts = str_replace("{Number}", $query_friends->num_rows(), $this->lang->line('MyFriendsCount'));
			
			$data['FriendsCount'] = $friends_counts;
			
			$data['FriendsBuilder'] = $this->friends_builder($query_friends, true); 
		}
		else
		{
			$friends_counts = str_replace("{Number}", $query_friends->num_rows(), $this->lang->line('MyFriendsCountNew'));
			$friends_counts = str_replace("{NewFriendsNumber}", $query_not_confirmed_friends->num_rows(), $friends_counts);
			
			$data['FriendsCount'] = $friends_counts;
			
			$data['FriendsBuilder'] = $this->friends_builder($query_not_confirmed_friends, false) . $this->friends_builder($query_friends, true); 
		}
		
		return $data;
	}
	
	function friends_builder($query, $is_confirmed)
	{
		
		$user_id = $this->user_authorization->get_loged_on_user_id();
		
		if($is_confirmed)
			$friend_item = $this->my_friends_lib->GetFriendsBuilderHTML();
		else
			$friend_item = $this->my_friends_lib->GetNotConfirmedFriendsBuilderHTML();
		
		$friend_item = str_replace("{FullNameText}", $this->lang->line('FirstNameText'), $friend_item);
		$friend_item = str_replace("{FriendRatingLevelText}", $this->lang->line('MyRatingLevelText'), $friend_item);
		
		
		$friend_item = str_replace("{FriendBestRecipeText}", $this->lang->line('MyBestRecipesText'), $friend_item);
		$friend_item = str_replace("{SendMessage}", $this->lang->line('SendMessage'), $friend_item);
		$friend_item = str_replace("{FriendFriends}", $this->lang->line('FriendFriends'), $friend_item);
		
		$friends_list = "";
		
		foreach ($query->result() as $row)
		{	
			$friend = $this->user_managment->GetUser($row->friend_id);
			$friend_data = $this->user_managment->GetUserData($row->friend_id);
			
			$friend_full_name = $friend->first_name . ' ' . $friend->last_name;
			if(strlen($friend_full_name) > 30)
				$friend_full_name =	substr($friend_full_name, 0, 30) . '...';
			
			$friend_current = str_replace("{FriendFullName}", $friend_full_name, $friend_item);
			$friend_current = str_replace("{FriendUrl}", 'http://' . $_SERVER['HTTP_HOST'] . '/profile/id/' . $row->friend_id, $friend_current);
			$friend_current = str_replace("{FriendFriendsUrl}", 'http://' . $_SERVER['HTTP_HOST'] . '/myfriends/id/' . $row->friend_id, $friend_current);
			$friend_current = str_replace("{SendMessageUrl}", 'http://' . $_SERVER['HTTP_HOST'] . '/send_message/send_to/id/' . $row->friend_id, $friend_current);
			
			if($is_confirmed)
				if($user_id != $row->friend_id)
					if($this->my_friends_lib->IsTheyFriends($user_id, $row->friend_id))
					{
						$friend_current = str_replace("{DeleteFriend}", $this->lang->line('DeleteFriend'), $friend_current);
						$friend_current = str_replace("{DeleteFriendUrl}", 'http://' . $_SERVER['HTTP_HOST'] . '/messagebox/type/delete_friend/friend_id/' . $row->friend_id, $friend_current);
					}
					else
					{
						$friend_current = str_replace("{DeleteFriend}", $this->lang->line('AddToFriends'), $friend_current);
						$friend_current = str_replace("{DeleteFriendUrl}", 'http://' . $_SERVER['HTTP_HOST'] . '/messagebox/type/add_friend/friend_id/' . $row->friend_id, $friend_current);				
					}
				else
				{
					$friend_current = str_replace("{DeleteFriend}", '', $friend_current);
					$friend_current = str_replace("{DeleteFriendUrl}", '', $friend_current);
					$friend_current = str_replace("{DeleteFriendShow}", 'none', $friend_current);				
				}
			else
			{
				$friend_current = str_replace("{ConfirmFriend}", $this->lang->line('AddToFriends'), $friend_current);
				$friend_current = str_replace("{ConfirmFriendUrl}", 'http://' . $_SERVER['HTTP_HOST'] . '/myfriends/confirm_friend_id/' . $row->friend_id, $friend_current);
				
				$friend_current = str_replace("{DeleteFriend}", $this->lang->line('DeleteFriend'), $friend_current);
				$friend_current = str_replace("{DeleteFriendUrl}", 'http://' . $_SERVER['HTTP_HOST'] . '/myfriends/reject_friend_id/' . $row->friend_id, $friend_current);
			}
			
			
			if($friend_data->avatar_name != null)
				$avatar_url = '/uploads/user_avatars/'.$friend_data->avatar_name;
			else
				$avatar_url = "../../../images/noavatar.gif";
			
			$friend_current = str_replace("{FriendAvatarUrl}", $avatar_url, $friend_current);
			
			$value = $this->user_managment->GetUserRating($row->friend_id);
			$friend_current = str_replace("{FriendRating}", $value, $friend_current);
			
			$arr=$this->receipes_management->GetBestRecipe($row->friend_id);
			if($arr[0]['name'] !=='')
			{
				$friend_current = str_replace("{FriendBestRecipe}", $arr[0]['name'], $friend_current);
				$friend_current = str_replace("{FriendBestRecipeId}", $arr[0]['id'], $friend_current);
			}
			else 
			{
				$friend_current = str_replace("{FriendBestRecipe}", '', $friend_current);
				$friend_current = str_replace("{FriendBestRecipeId}", '', $friend_current);	
			}
			
			$friends_list = $friends_list . $friend_current;
		}
		return $friends_list;
	}
}
?>