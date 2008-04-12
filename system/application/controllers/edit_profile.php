<?php

class Edit_Profile extends Controller {
	
	function Edit_Profile()
	{
		parent::Controller();
		$this->load->library('validation');
		$this->load->library('usermanagment');
		$this->load->helper('date');
		$this->load->helper('form');
	}
	
	function index()
	{
		$data['title'] = $this->lang->line('EditPrifile');
		$data['keywords'] = $this->lang->line('keywords');
		$data['description'] = $this->lang->line('description');
		$data['baseurl'] = base_url();
		$data['header'] = $this->load->view('header', $data, true);
		$data['menu']=$this->Menu->buildmenu();
		$data['login']='';
		
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
		$data['LoginInformation'] = $this->lang->line('LoginInformation');
		$data['NewEmailText'] = $this->lang->line('NewEmailText');
		$data['OldPasswordText'] = $this->lang->line('OldPasswordText');
		$data['NewPassword'] = $this->lang->line('NewPassword');
		$data['ReNewPassword'] = $this->lang->line('ReNewPassword');
		$data['SaveAllChanges'] = $this->lang->line('SaveAllChanges');
		$data['Save'] = $this->lang->line('Save');
		$data['Upload'] = $this->lang->line('Upload');
		$data['Man'] = $this->lang->line('Man');
		$data['Woman'] = $this->lang->line('Woman');
		$data['Day'] = $this->lang->line('Day');
		$data['Month'] = $this->lang->line('Month');
		$data['Year'] = $this->lang->line('Year');
		$data['Country'] = $this->lang->line('Country');
		$data['City'] = $this->lang->line('City');
		$data['MySettings'] = $this->lang->line('MySettings');
		$data['Cancel'] = $this->lang->line('Cancel');
		
		//Получение данных юзера и заполнение их
		$users = $this->usermanagment->GetUser(1);
		$user_data = $this->usermanagment->GetUserData(1);
		
		if($users != null)
		{
			$data['UserStatus'] = $users->first_name . ' ' . $users->last_name;
			
			$data['FirstName'] = $users->first_name;
			$data['LastName'] = $users->last_name;
			
			if($users->sex == 0)
			{
				$data['txtSexManCHECKED'] = "checked";
				$data['txtSexWomanCHECKED'] = "";	
			}
			else
			{
				$data['txtSexManCHECKED'] = "";
				$data['txtSexWomanCHECKED'] = "checked";	
			}
			
			
			$day = array();
			for($i=1;$i<=31;$i++)
				$day[$i] = $i;
			
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
			
			$current_year = mdate("%Y", time());
			$year = array();
			for($i=0;$i<=100;$i++)
				$year[$i] = $current_year - $i;
			
			$selectedDay = mdate("%d", mysql_to_unix($users->birthday));
			$selectedMonth = mdate("%m", mysql_to_unix($users->birthday));
			$selectedYear = mdate("%Y", mysql_to_unix($users->birthday));

			$data['SelectDay'] = form_dropdown('SelectDay', $day, $selectedDay);
			$data['SelectMonth'] = form_dropdown('SelectMonth', $month, $selectedMonth);
			$data['SelectYear'] = form_dropdown('SelectYear', $year, $current_year - $selectedYear);
			
			$separator = "";
			if($users->city != null && $users->country != null)
				$separator = ", ";
			
			$data['Loction'] = $users->city . $separator . $users->country;
			
			$data['Email'] = $users->email;
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
		
		$data['body']= $this->parser->parse('edit_profile', $data);
		
		$this->parser->parse('main_tpl', $data);
	}
}
?>