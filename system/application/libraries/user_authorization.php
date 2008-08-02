<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class User_authorization {
	
	var $ci;
	
	function User_authorization()
	{
		$this->ci =& get_instance();
		$this->ci->load->database();
		
		$this->ci->load->library('user_managment');
		$this->ci->load->helper('cookie');
	}
	
	function login($email, $remember_me)
	{
		//$this->ci->session->sess_destroy(); //очищаем юзера от текущих сессий
		$this->logout();
		
		$this->ci->session->sess_create();  //создаем сессию

		$id_of_user_by_email=$this->ci->user_managment->GetUserInfoByEmail($email)->id;
		$password_of_user_by_email = $this->ci->user_managment->GetUserInfoByEmail($email)->password;
		
		//дополнительно закодируем уже однажды закодированый пароль, добавив к нему секретную строку
		$password_of_user_by_email_md5=md5($password_of_user_by_email.'alexJTcrew');
		
		$new_sess_data = array(
		'user_id'     => $id_of_user_by_email,
		'logged_in' => TRUE,
		'password' => $password_of_user_by_email_md5
		);
		
		$expire_time_for_cookies=86500000;
		
		$new_cookie_data_ID = array(
		'name'   => 'userid',
		'value'  => $id_of_user_by_email,
		'expire' => $expire_time_for_cookies,
		);
		
		$new_cookie_data_PASSWORD = array(
		'name'   => 'userpassword',
		'value'  => $password_of_user_by_email_md5,
		'expire' => $expire_time_for_cookies,
		);
		
		
        //если юзер НЕ поставил галочку "Запомнить меня"
        //просто создаем сессию
		$this->ci->session->set_userdata($new_sess_data); //записываем в сессию массив $new_sess_data

		
		
		//если юзер поставил галочку "Запомнить меня"
		//создаем еще и cookie's
		if($remember_me==='on')
		{
			set_cookie($new_cookie_data_ID);
			set_cookie($new_cookie_data_PASSWORD);
		}
		
		
	}

	
	//ID авторизированого юзера
	function get_loged_on_user_id()
	{
		//return get_cookie('userid');
		return $this->ci->session->userdata('user_id');
	}
	
	
	//LogOff
	function logout()
	{
		//убиваем куки
		delete_cookie('userid');
		delete_cookie('userpassword');
		delete_cookie('ci_session');

		//убиваем сессию
		$this->ci->session->sess_destroy();
	}
	
	
	
	function is_logged_in()
	{
		if ($this->ci->session->userdata('logged_in'))
		{
			//пароль с сесссии
			$reencoded_password = $this->ci->session->userdata('password'); //пароль с сесссии
			// пароль с базы
			$password_of_user_by_email = $this->ci->user_managment->GetUser($this->ci->session->userdata('user_id'))->password;
			// пароль с базы + повторный md5 с секретной строкой
			$password_of_user_by_email_reencoded=md5($password_of_user_by_email.'alexJTcrew');
			//если совпадают - сессия корректна
			if($reencoded_password == $password_of_user_by_email_reencoded)
			{
			return true;
			}
		}
		else 
		{
			if(get_cookie('userid') && get_cookie('userpassword'))
			{
			// пароль с базы
			$password_of_user_by_email = $this->ci->user_managment->GetUser(get_cookie('userid'))->password;
			// пароль с базы + повторный md5 с секретной строкой
			$password_of_user_by_email_reencoded=md5($password_of_user_by_email.'alexJTcrew');
			//если совпадают - сессия корректна
			if(get_cookie('userpassword') == $password_of_user_by_email_reencoded)
			{
				//создаем по кукам сессию
				$this->ci->session->sess_destroy(); //очищаем юзера от текущих сессий
				$this->ci->session->sess_create();  //создаем сессию
				
				$new_sess_data = array(
				'user_id'     => get_cookie('userid'),
				'logged_in' => TRUE,
				'password' => md5($password_of_user_by_email.'alexJTcrew')
				);
				$this->ci->session->set_userdata($new_sess_data);
				return true;
			}
			}
			else 
			return false;
		}
	
	
	
	}
}
?>