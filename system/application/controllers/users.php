<?php

class Users extends Controller {

	function Users()
	{
		parent::Controller();

		$this->load->library('receipes_management');
		$this->load->library('comments_management');
		$this->load->library('user_managment');
		$this->load->library('my_friends_lib');

		$this->load->helper('form');
		$this->load->helper('typography');
		$this->load->helper('text');
	}

	/*
	function _remap($method) {
	//страницы, доступные без авторизации
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
	*/

	function index()
	{
		$data = $this->_load_headers();

		$data = $this->_load_resource($data);

		$data = $this->_data_bind($data);

		$data['body']= $this->parser->parse('users', $data);

		$this->parser->parse('main_tpl', $data);
	}

	function _load_headers()
	{
		$data['title'] = $this->lang->line('title').' - '.$this->lang->line('MyRecipes');
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

		$data['Users'] = $this->lang->line('Users');
		$data['RecipesFilter'] = $this->lang->line('RecipesFilter');
		$data['Search'] = $this->lang->line('Search');
		$data['UsersPageDescrRate'] = $this->lang->line('UsersPageDescrRate');
		$data['UsersPageDescrActive'] = $this->lang->line('UsersPageDescrActive');
		$data['UsersPageDescrNewbes'] = $this->lang->line('UsersPageDescrNewbes');
		
		return $data;
	}

	function _data_bind($data)
	{

		$link_rate = '<a href="#" onclick="ajax_rate()">'.$this->lang->line('link_rate').'</a>';
		$link_active = '<a href="#" onclick="ajax_active()">'.$this->lang->line('link_active').'</a>';
		$link_newbes = '<a href="#" onclick="ajax_newbes()">'.$this->lang->line('link_newbes').'</a>';

		$data['UserListLinks'] = $link_rate.' '.$link_active.' '.$link_newbes;
		
		$data['rate'] = $this->rate();
		return $data;
	}

	function rate()
	{
		$html = $this->user_managment->GetUsersBuilderHTML();
		$top_users = $this->user_managment->GetUsersByRate();
		$html_item = str_replace("{FullNameText}", $this->lang->line('FirstNameText'), $html);
		$html_item = str_replace("{FriendRatingLevelText}", $this->lang->line('MyRatingLevelText'), $html_item);
		$html_item = str_replace("{BestRecipeText}", $this->lang->line('MyBestRecipesText'), $html_item);


		$users_list = "";
		foreach ($top_users as $item):
		$user = $this->user_managment->GetUser($item->user_id);
		$user_data = $this->user_managment->GetUserData($item->user_id);

		$friend_full_name = $user->first_name . ' ' . $user->last_name;
		if(strlen($friend_full_name) > 30)
		$friend_full_name =	substr($friend_full_name, 0, 30) . '...';

		$user_item = str_replace("{UserFullName}", $friend_full_name, $html_item);
		$user_item = str_replace("{UserUrl}", 'http://' . $_SERVER['HTTP_HOST'] . '/profile/id/' . $item->user_id, $user_item);
		

		if($user_data->avatar_name != null)
		$avatar_url = base_url().'uploads/user_avatars/'.$user_data->avatar_name;
		else
		$avatar_url = base_url()."images/noavatar.gif";

		$arr=$this->receipes_management->GetBestRecipe($item->user_id);
		if($arr[0]['name'] !=='')
		{
			$user_item = str_replace("{BestRecipe}", $arr[0]['name'], $user_item);
			$user_item = str_replace("{BestRecipeId}", $arr[0]['id'], $user_item);
		}
		else
		{
			$user_item = str_replace("{BestRecipe}", '', $user_item);
			$user_item = str_replace("{BestRecipeId}", '', $user_item);
		}

		$user_item = str_replace("{AvatarUrl}", $avatar_url, $user_item);

		$value = $this->user_managment->GetUserRating($item->user_id);
		$user_item = str_replace("{UserRating}", $value, $user_item);

		if($this->user_authorization->get_loged_on_user_id()==$item->user_id)
		{
		$user_item = str_replace("{FriendBtn}", '', $user_item);
		$user_item = str_replace("{AddFriendUrl}", '', $user_item);	
		$user_item = str_replace("{SendMessageBtn}", '', $user_item);	
		$user_item = str_replace("{FriendsBtn}", $this->user_managment->FriendsBtn(), $user_item);	
		$user_item = str_replace("{FriendFriends}", $this->lang->line('Friends'), $user_item);	
		$user_item = str_replace("{FriendFriendsUrl}", 'http://' . $_SERVER['HTTP_HOST'] . '/myfriends/id/' . $item->user_id, $user_item);
		}
		
		if($this->my_friends_lib->IsTheyFriends($this->user_authorization->get_loged_on_user_id(), $item->user_id)===true)
		{
		$user_item = str_replace("{FriendBtn}", $this->user_managment->GetFriendBtn(), $user_item);
		$user_item = str_replace("{AddFriend}", $this->lang->line('DeleteFromFriends'), $user_item);
		$user_item = str_replace("{AddFriendUrl}", base_url().'messagebox/type/delete_friend/friend_id/'.$item->user_id, $user_item);
		
		$user_item = str_replace("{SendMessageBtn}", $this->user_managment->SendMessageBtn(), $user_item);
		$user_item = str_replace("{SendMessage}", $this->lang->line('SendMessage'), $user_item);
		$user_item = str_replace("{SendMessageUrl}", 'http://' . $_SERVER['HTTP_HOST'] . '/send_message/send_to/id/' . $item->user_id, $user_item);
		
		$user_item = str_replace("{FriendsBtn}", $this->user_managment->FriendsBtn(), $user_item);	
		$user_item = str_replace("{FriendFriends}", $this->lang->line('FriendFriends'), $user_item);	
		$user_item = str_replace("{FriendFriendsUrl}", 'http://' . $_SERVER['HTTP_HOST'] . '/myfriends/id/' . $item->user_id, $user_item);
		}
		else 
		{
		$user_item = str_replace("{FriendBtn}", $this->user_managment->GetFriendBtn(), $user_item);
		$user_item = str_replace("{AddFriend}", $this->lang->line('AddToFriends'), $user_item);	
		$user_item = str_replace("{AddFriendUrl}", base_url().'messagebox/type/add_friend/friend_id/'.$item->user_id, $user_item);	
		
		$user_item = str_replace("{SendMessageBtn}", $this->user_managment->SendMessageBtn(), $user_item);
		$user_item = str_replace("{SendMessage}", $this->lang->line('SendMessage'), $user_item);
		$user_item = str_replace("{SendMessageUrl}", 'http://' . $_SERVER['HTTP_HOST'] . '/send_message/send_to/id/' . $item->user_id, $user_item);
		
		$user_item = str_replace("{FriendsBtn}", $this->user_managment->FriendsBtn(), $user_item);	
		$user_item = str_replace("{FriendFriends}", $this->lang->line('FriendFriends'), $user_item);
		$user_item = str_replace("{FriendFriendsUrl}", 'http://' . $_SERVER['HTTP_HOST'] . '/myfriends/id/' . $item->user_id, $user_item);
		}

		$users_list = $users_list . $user_item;
		endforeach;

		if($this->input->post('visible')!==false)
		{
		echo $users_list;
		}
		else
		return $users_list;
	}
	
	
	function newbes()
	{
		echo 'Уже скоро будет работать! ;)';
	}
	
	function active()
	{
		echo 'Уже скоро будет работать! ;)';
	}

}
?>