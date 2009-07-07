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

		//$this->ci->session->sess_destroy(); //������� ����� �� ������� ������
		$this->logout();

		$this->ci->session->sess_create();  //������� ������

		$id_of_user_by_email=$this->ci->user_managment->GetUserInfoByEmail($email)->id;
		$password_of_user_by_email = $this->ci->user_managment->GetUserInfoByEmail($email)->password;

		//������������� ���������� ��� ������� ������������� ������, ������� � ���� ��������� ������
		$password_of_user_by_email_md5=md5($password_of_user_by_email.'alexJTcrew');

		$new_sess_data = array(
		'user_id'     => $id_of_user_by_email,
		'logged_in' => TRUE,
		'password' => $password_of_user_by_email_md5
		);

		$expire_time_for_cookies_on=0;
		$expire_time_for_cookies_off=3600;


		$new_cookie_data_ID_off = array(
		'name'   => 'userid',
		'value'  => $id_of_user_by_email,
		'expire' => $expire_time_for_cookies_off,
		'domain' => base_url(),
		);

		$new_cookie_data_ID = array(
		'name'   => 'userid',
		'value'  => $id_of_user_by_email,
		'expire' => $expire_time_for_cookies_on,
		'domain' => base_url(),
		);

		$new_cookie_data_PASSWORD_off = array(
		'name'   => 'userpassword',
		'value'  => $password_of_user_by_email_md5,
		'expire' => $expire_time_for_cookies_off,
		'domain' => base_url(),
		);

		$new_cookie_data_PASSWORD = array(
		'name'   => 'userpassword',
		'value'  => $password_of_user_by_email_md5,
		'expire' => $expire_time_for_cookies_on,
		'domain' => base_url(),
		);


		//���� ���� �� �������� ������� "��������� ����"
		//������ ������� ������
		$this->ci->session->set_userdata($new_sess_data); //���������� � ������ ������ $new_sess_data
		set_cookie($new_cookie_data_ID_off);
		set_cookie($new_cookie_data_PASSWORD_off);


		//���� ���� �������� ������� "��������� ����"
		//������� ��� � cookie's
		if($remember_me==='on')
		{
			set_cookie($new_cookie_data_ID);
			set_cookie($new_cookie_data_PASSWORD);
		}

	}


	//ID ���������������� �����
	function get_loged_on_user_id()
	{
		//return get_cookie('userid');
		return $this->ci->session->userdata('user_id');
	}


	//LogOff
	function logout()
	{
		//������� ����
		delete_cookie('userid', base_url());
		delete_cookie('userpassword', base_url());

		//delete_cookie('ci_session');

		//������� ������
		$this->ci->session->sess_destroy();
	}



	function is_logged_in()
	{
		if ($this->ci->session->userdata('logged_in'))
		{
			//������ � �������
			$reencoded_password = $this->ci->session->userdata('password'); //������ � �������
			// ������ � ����
			$password_of_user_by_email = $this->ci->user_managment->GetUser($this->ci->session->userdata('user_id'))->password;
			// ������ � ���� + ��������� md5 � ��������� �������
			$password_of_user_by_email_reencoded=md5($password_of_user_by_email.'alexJTcrew');
			//���� ��������� - ������ ���������
			if($reencoded_password == $password_of_user_by_email_reencoded)
			{
				return true;
			}
		}
		else
		{
			
			if(get_cookie('userid') && get_cookie('userpassword'))
			{
				// ������ � ����
				$password_of_user_by_email = $this->ci->user_managment->GetUser(get_cookie('userid'))->password;
				// ������ � ���� + ��������� md5 � ��������� �������
				$password_of_user_by_email_reencoded=md5($password_of_user_by_email.'alexJTcrew');
				//���� ��������� - ������ ���������
				if(get_cookie('userpassword') == $password_of_user_by_email_reencoded)
				{
					//������� �� ����� ������
					$this->ci->session->sess_destroy(); //������� ����� �� ������� ������
					$this->ci->session->sess_create();  //������� ������

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