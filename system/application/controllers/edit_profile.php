<?php

class Edit_Profile extends Controller {
	
	function Edit_Profile()
	{
		parent::Controller();
		
		$this->load->library('validation');
		
		$this->load->library('usermanagment');
		$this->load->library('location');
		
		$this->load->helper('date');
		$this->load->helper('form');
		$this->load->helper(array('form', 'url'));
		
		$this->load->view('edit_profile', array('error' => ' ' ));
	}
	
	function index()
	{
		$data = $this->load_headers();
		
		$data = $this->load_resource($data);
		
		$data = $this->data_bind($data);
		
		if($this->input->post('btnSave') == "true")
		{
			$this->update_user(1);
			if($this->updata_password(1))
				redirect('/profile/', 'refresh');
		}
		
		$data['body']= $this->parser->parse('edit_profile', $data);
		
		$this->parser->parse('main_tpl', $data);
	}
	
	function load_headers()
	{
		$data['title'] = $this->lang->line('EditProfile');
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
		$data['Region'] = $this->lang->line('Region');
		$data['City'] = $this->lang->line('City');
		$data['MySettings'] = $this->lang->line('MySettings');
		$data['Cancel'] = $this->lang->line('Cancel');
		
		return $data;
	}
	
	function data_bind($data)
	{
		$data['ProfileUrl'] = 'http://' . $_SERVER['HTTP_HOST'] . '/profile';
		$data['OldPasswordError'] = "none";
		
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
				$year[$current_year - $i] = $current_year - $i;
			
			$selectedDay = mdate("%d", mysql_to_unix($users->birthday));
			$selectedMonth = mdate("%m", mysql_to_unix($users->birthday));
			$selectedYear = mdate("%Y", mysql_to_unix($users->birthday));
			
			$data['SelectDay'] = form_dropdown('SelectDay', $day, $selectedDay);
			$data['SelectMonth'] = form_dropdown('SelectMonth', $month, $selectedMonth);
			$data['SelectYear'] = form_dropdown('SelectYear', $year, $selectedYear);
			
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
		
		return $data;
	}
	
	function do_upload()
	{
		$config['upload_path'] = './uploads/';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size']	= '100';
		$config['max_width']  = '1024';
		$config['max_height']  = '768';
		
		$this->load->library('upload', $config);
		
		if ( ! $this->upload->do_upload())
		{
			$error = array('error' => $this->upload->display_errors());
			
			$this->load->view('upload_form', $error);
		}	
		else
		{
			$data = array('upload_data' => $this->upload->data());
			
			$this->load->view('upload_success', $data);
		}
	}	
	
	function update_user($UserID)
	{
		$first_name = $this->input->post('txtFirstName');
		$last_name = $this->input->post('txtLastName');
		
		$SelectDay = $this->input->post('SelectDay');
		$SelectMonth = $this->input->post('SelectMonth');
		$SelectYear = $this->input->post('SelectYear');
		
		$sexValue = $this->input->post('txtSex');
		
		$city = 0;
		$region = 0;
		$country = 0;
		
		$phone = $this->input->post('txtPhone');
		$website = $this->input->post('txtWebSite');
		$activities = $this->input->post('txtActivities');
		$interests = $this->input->post('txtInterests');
		$about = $this->input->post('txtAbout');
		
		$birthday =  "$SelectYear-$SelectMonth-$SelectDay";
		
		if($sexValue == "txtSexMan")
			$sex = 0;
		else
			$sex = 1;
		
		$users = $this->usermanagment->UpdateUser($UserID, $first_name, $last_name, $birthday, $sex, $city, $region, $country, $phone, $website, $activities, $interests, $about);
	}
	
	function updata_password($UserID)
	{
		$rules['txtNewPassword'] = "min_length[6]|max_length[21]|alpha_numeric";
		$this->validation->set_rules($rules);
		
		$fields['txtNewPassword'] = $this->lang->line('txtNewPassword');
		$this->validation->set_fields($fields);
		
		$old_password = $this->input->post('txtOldPassword');
		$new_password=$this->input->post('txtNewPassword');
				
		if(strlen($old_password) != 0 && strlen($new_password) != 0)
		{
			if($this->usermanagment->IsPasswordValidByID($UserID, $old_password))
			{			
				if ($this->validation->run())
				{
					$this->usermanagment->NewPassword($UserID, $new_password);
					return true;
				}
			}
			else
			{
				return false;
			}
		}
		else
		{
			return true;
		}
		
	}
}
?>