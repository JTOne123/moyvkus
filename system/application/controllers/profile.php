<?php

class Profile extends Controller {
	
	function Profile()
	{
		parent::Controller();
		
		$this->load->library('validation');
		
		$this->load->library('usermanagment');
		$this->load->library('location');
		$this->load->library('myfriendslib');
		$this->load->library('receipesmanagement');
		
		$this->load->helper('date');
		$this->load->helper('typography');
		
		$this->load->model('Recommend');
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
		
		$data['body']= $this->parser->parse('profile', $data);
		
		$this->parser->parse('main_tpl', $data);
	}
	
	
	function _load_headers()
	{
		$data['title'] = $this->lang->line('Prifile');
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
		$data['Avatar'] = $this->lang->line('Avatar');
		$data['MyFriendsHeader'] = $this->lang->line('MyFriendsHeader');
		$data['MyData'] = $this->lang->line('MyData');
		$data['FirstNameText'] = $this->lang->line('FirstNameText');
		$data['LastNameText'] = $this->lang->line('LastNameText');
		$data['SexText'] = $this->lang->line('SexText');
		$data['BirthdayText'] = $this->lang->line('BirthdayText');
		$data['LoctionText'] = $this->lang->line('LoctionText');
		$data['WebSiteText'] = $this->lang->line('WebSiteText');
		$data['InstantMessagerText'] = $this->lang->line('InstantMessagerText');
		$data['ActivitiesText'] = $this->lang->line('ActivitiesText');
		$data['InterestsText'] = $this->lang->line('InterestsText');
		$data['AboutText'] = $this->lang->line('AboutText');
		$data['MyRatingText'] = $this->lang->line('MyRatingText');
		$data['MyRatingLevelText'] = $this->lang->line('MyRatingLevelText');
		$data['MyBestRecipesText'] = $this->lang->line('MyBestRecipesText');
		$data['MyInfo'] = $this->lang->line('MyInfo');
		$data['RecomendedRecipes'] = $this->lang->line('RecomendedRecipes');
		$data['Contacts'] = $this->lang->line('Contacts');
		$data['MyRatingTextHeader'] = $this->lang->line('MyRatingTextHeader');
		$data['Friends'] = $this->lang->line('Friends');
		$data['SendMessage'] = $this->lang->line('SendMessage');
		$data['AddToFriends'] = $this->lang->line('AddToFriends');
		$data['DeleteFromFriends'] = $this->lang->line('DeleteFromFriends');
		
		return $data;
	}
	
	function _data_bind($data)
	{
		$user_id_from_uri = $this->uri->segment(3);
		$user_id = $this->userauthorization->get_loged_on_user_id();
		
		if($user_id_from_uri == false) 
			$user_id_from_uri = $user_id;
		
		$user_id_to_view = $user_id;
		
		if($user_id_from_uri != $user_id_to_view)
		{
			if($this->usermanagment->IsUserExists_by_id($user_id_from_uri) === true)
				$user_id_to_view = $user_id_from_uri; 
			else 
				redirect('profile', 'refresh');
		}
		
		//Показывать ли ссылки
		if($user_id_to_view === $user_id)
		{
			$data['EditProfileUrl'] = 'http://' . $_SERVER['HTTP_HOST'] . '/edit_profile';
			$data['Edit'] = $this->lang->line('Edit');
			
			$data['SendMessageUrl'] = '';
			$data['AddToFriendsUrl'] = '';
			$data['DeleteFromFriendsUrl'] = '';
			
			$data['SendMessageShow'] = 'none';
			$data['AddToFriendsShow'] = 'none';
			$data['DeleteFromFriendsShow'] = 'none';
			
			$data['AddRecipeShow'] = '';
			$data['AddRecipe'] = $this->lang->line('AddRecipe');
			$data['AddRecipeUrl'] = 'http://' . $_SERVER['HTTP_HOST'] . '/add_new_recipe';
			
			$data['MyRecipes'] = $this->lang->line('MyRecipes');
			$data['MyRecipesUrl'] = 'http://' . $_SERVER['HTTP_HOST'] . '/my_recipes';
			
			$data['Favorites'] = $this->lang->line('Favorites');
			$data['FavoritesUrl'] = 'http://' . $_SERVER['HTTP_HOST'] . '/favorites/id/' . $user_id_to_view;
		}
		else 
		{
			$data['AddRecipeShow'] = 'none';
			
			$data['MyRecipes'] = $this->lang->line('HisRecipes');
			$data['MyRecipesUrl'] = 'http://' . $_SERVER['HTTP_HOST'] . '/my_recipes/id/' . $user_id_to_view;
			
			$data['SendMessageShow'] = '';
			$data['SendMessageUrl'] = 'http://' . $_SERVER['HTTP_HOST'] . '/send_message/send_to/id/' . $user_id_to_view;
			
			$data['Favorites'] = $this->lang->line('HisFavorites');
			$data['FavoritesUrl'] = 'http://' . $_SERVER['HTTP_HOST'] . '/favorites/id/' . $user_id_to_view;
			
			//Проверка или просматриветься профиль друга
			if($this->myfriendslib->IsTheyFriends($user_id, $user_id_to_view))
			{
				$data['DeleteFromFriendsShow'] = '';
				$data['DeleteFromFriendsUrl'] = 'http://' . $_SERVER['HTTP_HOST'] . '/messagebox/type/delete_friend/friend_id/' . $user_id_to_view;
				
				$data['AddToFriendsShow'] = 'none';
			}
			else
			{
				$data['AddToFriendsShow'] = '';
				$data['AddToFriendsUrl'] = 'http://' . $_SERVER['HTTP_HOST'] . '/messagebox/type/add_friend/friend_id/' . $user_id_to_view;
				
				$data['DeleteFromFriendsShow'] = 'none';
			}
			
			$data['EditProfileUrl']='';
			$data['Edit'] = '';
		}
		
		$month = array(
				'01'  => 'Январь',
				'02'  => 'Февраль',
				'03'  => 'Март',
				'04'  => 'Апрель',
				'05'  => 'Май',
				'06'  => 'Июнь',
				'07'  => 'Июль',
				'08'  => 'Август',
				'09'  => 'Сентябрь',
				'10' => 'Октябрь',
				'11' => 'Ноябрь',
				'12' => 'Декабрь',
				);
		
		//Получение данных юзера и заполнение их
		$users = $this->usermanagment->GetUser($user_id_to_view);
		$user_data = $this->usermanagment->GetUserData($user_id_to_view);
		//var_dump($user_data);
		if($users != null)
		{
			$data['UserStatus'] = $users->first_name . ' ' . $users->last_name;
			
			$data['FirstName'] = $users->first_name;
			$data['LastName'] = $users->last_name;
			$data['Sex'] = $this->GetSex($users->sex);
			
			$data['FriendsUrl'] = 'http://' . $_SERVER['HTTP_HOST'] . '/myfriends/id/' . $user_id_to_view;
			
			$day_string =  mdate("%d", mysql_to_unix($users->birthday));
			$month_string =  mdate("%m", mysql_to_unix($users->birthday));
			$year_string =  mdate("%Y", mysql_to_unix($users->birthday));
			
			$data['Birthday'] = $day_string .  ' ' . $month[$month_string] . ' ' . $year_string;
			
			if($users->city != null)
			{
				$city = $this->location->GetCity($users->city);
				$city_name = $city->name;
			}
			else
			{
				$city_name = "";
			}
			if($users->country != null)	
			{		
				$country = $this->location->GetCountry($users->country);
				$country_name = ', ' . $country->name;
			}
			else
			{
				$country_name = "";
			}
			
			$data['Loction'] =  $city_name . $country_name;
		}
		
		if($user_data != null)
		{
			$data['WebSite'] = $user_data->website;
			$data['InstantMessager'] = $user_data->phone;
			$data['Activities'] = auto_typography($user_data->activities);
			$data['Interests'] = auto_typography($user_data->interests);
			$data['About'] = auto_typography($user_data->about);
			
			$arr=$this->receipesmanagement->getbestrecipe($user_id_to_view);
			$data['MyBestRecipe'] = $arr[0]['name'];
			
			$arr=$this->usermanagment->GetUserRating($user_id_to_view);
			$data['MyRating'] = $arr;
			
			$arr=$this->receipesmanagement->getuserrecipes($user_id_to_view, 0,5);
			
			$data['Recommend_recipes'] = $this->Recommend->Build($user_id_to_view);
			
			if($user_data->avatar_name != null)
				$data['AvatarUrl'] = '/uploads/user_avatars/'.$user_data->avatar_name;
			else
				$data['AvatarUrl'] = "../../images/noavatar.gif";
			
			
		}
		else
		{
			$data['WebSite'] = "";
			$data['InstantMessager'] = "";
			$data['Activities'] = "";
			$data['Interests'] = "";
			$data['About'] = "";
			$data['AvatarUrl'] = "../../images/noavatar.gif";
			
		}
		
		
		return $data;
	}
	
	
	function GetSex($SexID)
	{
		if($SexID == null)
			return "";
		
		switch($SexID)
		{
			case 0:
				return $this->lang->line('Man');
				break;
			case 1: 
				return $this->lang->line('Woman');
				break;
			default:
				return "";
				break;
		}
	}
	
}
?>