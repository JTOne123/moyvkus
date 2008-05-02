<?php

class Profile extends Controller {
	
	function Profile()
	{
		parent::Controller();
		
		$this->load->library('validation');
		
		$this->load->library('usermanagment');
		$this->load->library('location');
		
		$this->load->helper('date');
	}
	
	function index()
	{
		$data['title'] = $this->lang->line('Prifile');
		$data['keywords'] = $this->lang->line('keywords');
		$data['description'] = $this->lang->line('description');
		$data['baseurl'] = base_url();
		$data['header'] = $this->load->view('header', $data, true);
		$data['menu']=$this->Menu->buildmenu();
		$data['login']='';
		$user_id_from_uri = $this->uri->segment(3);
		if($user_id_from_uri==false) $user_id_from_uri=$this->userauthorization->get_loged_on_user_id();
		
	    //Показывать ли ссылку РЕДАКТИРОВАТЬ
		if($user_id_from_uri===$this->userauthorization->get_loged_on_user_id())
		{
		$data['EditProfileUrl'] = 'http://' . $_SERVER['HTTP_HOST'] . '/edit_profile';
		$data['Edit'] = $this->lang->line('Edit');
		}
		else 
		{
			$data['EditProfileUrl']='';
			$data['Edit'] = '';
		}
		
		// Локализация надписей
		//$data['Edit'] = $this->lang->line('Edit');
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
		$data['MyRecipes'] = $this->lang->line('MyRecipes');
		$data['Contacts'] = $this->lang->line('Contacts');
		$data['MyRatingTextHeader'] = $this->lang->line('MyRatingTextHeader');
		
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
		$user_id_from_session=$this->userauthorization->get_loged_on_user_id();
		
		if($user_id_from_uri==$user_id_from_session)
		{
			$user_id_to_view=$user_id_from_session;
		}
		else 
		{
			if($this->usermanagment->IsUserExists_by_id($user_id_from_uri)===true)
			{ $user_id_to_view=$user_id_from_uri; }
			else 
			redirect('profile', 'refresh');
		}
		
		
		$users = $this->usermanagment->GetUser($user_id_to_view);
		$user_data = $this->usermanagment->GetUserData($user_id_to_view);
		if($users != null)
		{
			$data['UserStatus'] = $users->first_name . ' ' . $users->last_name;
			
			$data['FirstName'] = $users->first_name;
			$data['LastName'] = $users->last_name;
			$data['Sex'] = $this->GetSex($users->sex);
			
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
			$data['Activities'] = $user_data->activities;
			$data['Interests'] = $user_data->interests;
			$data['About'] = $user_data->about;
			
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
		
		
		$data['body']= $this->parser->parse('profile', $data);
		
		$this->parser->parse('main_tpl', $data);
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