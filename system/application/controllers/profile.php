<?php

class Profile extends Controller {
	
	function Profile()
	{
		parent::Controller();
		$this->load->library('validation');
		$this->load->library('usermanagment');
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
		
		// Локализация надписей
		$data['Edit'] = $this->lang->line('Edit');
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
		
		//Получение данных юзера и заполнение их
		$users = $this->usermanagment->GetUser(1);
		$user_data = $this->usermanagment->GetUserData(1);
		
		if($users != null)
		{
			$data['UserStatus'] = $users->first_name . ' ' . $users->last_name;
			
			$data['FirstName'] = $users->first_name;
			$data['LastName'] = $users->last_name;
			$data['Sex'] = $this->GetSex($users->sex);
			
			$datestring = "%d/%m/%Y";
			$data['Birthday'] = mdate($datestring, mysql_to_unix($users->birthday));
			
			$separator = "";
			if($users->city != null && $users->country != null)
				$separator = ", ";
			
			$data['Loction'] = $users->city . $separator . $users->country;
		}
		
		if($user_data != null)
		{
			$data['WebSite'] = $user_data->website;
			$data['InstantMessager'] = $user_data->phone;
			$data['Activities'] = $user_data->activities;
			$data['Interests'] = $user_data->interests;
			$data['About'] = $user_data->about;
			
			if($user_data->avatar_url != null)
				$data['AvatarUrl'] = $user_data->avatar_url;
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