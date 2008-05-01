<?php

class Edit_Profile extends Controller {
	
	function Edit_Profile()
	{
		parent::Controller();
		
		$this->load->library('validation');
		
		$this->load->library('usermanagment');
		$this->load->library('location');
		//$this->load->library('ajax');
		
		$this->load->helper('date');
		$this->load->helper('form');
		$this->load->helper('url');
		
	}
	
	function _remap($method) {
		//страницы, доступные без авторизации
		$allowedPages = array('do_upload');
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
		
		if($this->input->post('btnSave') == "true")
		{
			$this->update_user($this->userauthorization->get_loged_on_user_id());
			if($this->update_password($this->userauthorization->get_loged_on_user_id()))
			redirect('/profile/', 'refresh');
		}
		
		$data['Error'] = '';
		$data['body']= $this->parser->parse('edit_profile', $data);
		
		$this->parser->parse('main_tpl', $data);
	}
	
	function _load_headers()
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
	
	function _load_resource($data)
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
	
	
	
	function _data_bind($data)
	{
		$data['ProfileUrl'] = 'http://' . $_SERVER['HTTP_HOST'] . '/profile';
		$data['OldPasswordError'] = "none";
		
		//Получение данных юзера и заполнение их
		$users = $this->usermanagment->GetUser($this->userauthorization->get_loged_on_user_id());
		$user_data = $this->usermanagment->GetUserData($this->userauthorization->get_loged_on_user_id());
		
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

			$country=$this->location->GetCountryNames();
			$nulled=array();
			$data['SelectCountry'] = form_dropdown('SelectCountry',$country,'', "onChange='ajax_locator_country()'");
			$data['SelectRegion'] = form_dropdown('SelectRegion',$nulled,'',"onChange='ajax_locator_region()'");
			$data['SelectCity'] = form_dropdown('SelectCity');
			
			$data['Email'] = $users->email;
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
		
		return $data;
	}
	
	//Работа с Ajax-загрузчиком городов START
	function ajax_locator_country(){
		
		$countryID=$this->input->post('countryID');
		
		if(isset($countryID))
		{
		  	$region=$this->location->GetRegions($countryID);
		  	$data['regions']=$region;
		  	$this->load->view('locator_drop_down', $data);
		}
	}
	
	function ajax_locator_region(){
	
		$regionID=$this->input->post('regionID');
		
		if(isset($regionID))
		{
		  	$citys=$this->location->GetCitys($regionID);
		  	$data['citys']=$citys;
		  	$this->load->view('locator_drop_down', $data);
		}
		
	}
	//Работа с Ajax-загрузчиком городов END
	
	
	function do_upload()
	{
		$data = $this->_load_headers();
		$data = $this->_load_resource($data);
		$data = $this->_data_bind($data);
		
		$this->load->library('image_lib');
		
		$config['upload_path'] = './uploads/user_avatars/stack';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size']	= '2048';
		$this->load->library('upload', $config);
		
		if ( ! $this->upload->do_upload())
		{
			$data['Error'] = $this->upload->display_errors();
			$data['body']= $this->parser->parse('edit_profile', $data);
		    $this->parser->parse('main_tpl', $data);
		}	
		else //успешная загрузка
		{
			
			$upl_arr=$this->upload->data();
			
			$config['image_library'] = 'GD2';
			$config['new_image'] = './uploads/user_avatars/a_'.$this->userauthorization->get_loged_on_user_id().$upl_arr['file_ext'];
			$config['source_image'] = './uploads/user_avatars/stack/'.$upl_arr['raw_name'].$upl_arr['file_ext'];
			$config['quality'] = '90%';
			$config['width'] = 300;
			$config['height'] = 130;
			$this->image_lib->initialize($config);
			$this->image_lib->resize();
			
	        $this->write_avatar_name_to_db($upl_arr['file_ext']);
			unlink('./uploads/user_avatars/stack/'.$upl_arr['raw_name'].$upl_arr['file_ext']);
			redirect('/edit_profile/', 'refresh');
		}		
	}
	
	function write_avatar_name_to_db($file_ext) //запись названия аватарки в базу
	{
		$user_id=$this->userauthorization->get_loged_on_user_id();
		$this->usermanagment->UpdateAvatar($user_id, $file_ext);
	}
	
	
	
	function update_user($UserID)
	{
		$first_name = $this->input->post('txtFirstName');
		$last_name = $this->input->post('txtLastName');
		
		$SelectDay = $this->input->post('SelectDay');
		$SelectMonth = $this->input->post('SelectMonth');
		$SelectYear = $this->input->post('SelectYear');
		
		$SelectCountry = $this->input->post('SelectCountry');
		$SelectRegion = $this->input->post('SelectRegion');
		$SelectCity = $this->input->post('SelectCity');
		
		
		$sexValue = $this->input->post('txtSex');
		
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
		
		$users = $this->usermanagment->UpdateUser($UserID, $first_name, $last_name, $birthday, $sex, $SelectCity, $SelectRegion, $SelectCountry, $phone, $website, $activities, $interests, $about);
	}
	
	function update_password($UserID)
	{
		$rules['txtNewPassword'] = "min_length[6]|max_length[21]|alpha_numeric";
		$rules['txtOldPassword']="callback_check_old_password";
		$this->validation->set_rules($rules);
		
		$fields['txtNewPassword'] = $this->lang->line('txtNewPassword');
		$this->validation->set_fields($fields);
		
		$old_password = $this->input->post('txtOldPassword');
		$new_password=$this->input->post('txtNewPassword');
		$txtReNewPassword=$this->input->post('txtReNewPassword');
		
		if($old_password!='')
		{
		  if ($this->validation->run() == TRUE && $new_password==$txtReNewPassword) 
		  {
		  	$this->usermanagment->NewPassword($UserID, $new_password);
			return true;
		  }
		  else 
		   return false;
		}
		else 
		 return false;
	}
	
	function check_old_password($old_password)
	{
		$ID=$this->userauthorization->get_loged_on_user_id();
		$old_password_md5=md5($old_password.'secret_message');
		$returned=$this->usermanagment->IsPasswordValidByID($ID, $old_password_md5);
		if($returned==true)
		{
		return true;
		}
		else 
		return false;
		
	}
	
	
}
?>