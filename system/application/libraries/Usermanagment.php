<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Usermanagment {
	
	var $ci;
	
	function Usermanagment()
	{
		$this->ci =& get_instance();
		$this->ci->load->database();
	}
	
	
	
	function AddUser($email, $first_name, $last_name, $password)
	{
		$password=md5($password.'secret_message'); //md5 кодирует строку с паролем 
		$query = $this->ci->db->query("INSERT INTO users(email, first_name, last_name, password) VALUES('$email', '$first_name', '$last_name', '$password')");
		
		$UserID = GetUserInfoByEmail($email)->id;
		
		$query = $this->ci->db->query("INSERT INTO user_data(user_id) VALUES('$UserID')");
	}
	
	/*
	Проверка существует ли юзер с заданым email'ом
	*/
	function IsUserExits($email)
	{	
		$query = $this->ci->db->query("SELECT id FROM users WHERE email = '$email'");
		
		if($query->num_rows()==0)
			return true;
		else 
			return false;
	}
	
	
	/*
	Проверка валидности пароля по email
	*/
	function IsPasswordValid($email, $password)
	{
		$query = $this->ci->db->query("SELECT password FROM users WHERE email='$email'");
		
		$row = $query->row();
		
		$password=md5($password.'secret_message');
		
		if($password==$row->password)
		{
			return true;
		}
		else 
			return false;
	}
	
	
	/*
	Получение Info юзера по email
	Пример использования:
		
	$var=$this->usermanagment->GetUserInfoByEmail('mail@mail.org');
	echo $var['last_name'];
	*/
	function GetUserInfoByEmail($email)
	{
		$query = $this->ci->db->query("SELECT id, first_name, last_name, birthday FROM users WHERE email = '$email'");
		$row = $query->row();
		
		$user_data['first_name'] = $row->first_name;
		$user_data['last_name'] = $row->last_name;
		$user_data['birthday'] = $row->birthday;
		
		return $user_data;
	}
	
	/*
	Получение юзера по ID
	*/
	function GetUser($UserID)
	{
		$query = $this->ci->db->query("SELECT email, first_name, last_name, birthday, sex, city, country FROM users WHERE ID = $UserID");
		$row = $query->row();
		
		return $row;
	}
	
	/*
	Получение дополнительных данных  про юзера по ID
	*/
	function GetUserData($UserID)
	{
		$query = $this->ci->db->query("SELECT phone, website, activities, interests, about, avatar_url FROM user_data WHERE user_id = $UserID");
		$row = $query->row();
		
		return $row;
	}
	
	/*
	Обновление данных юзера
	*/
	function UpdateUser($UserID, $first_name, $last_name, $birthday, $sex, $city, $region, $country, $phone, $website, $activities, $interests, $about)
	{
		$query = $this->ci->db->query("UPDATE users SET first_name = '$first_name', last_name = '$last_name', birthday = '$birthday', sex = '$sex', city = '$city', region = '$region', country = '$country'  WHERE ID = '$UserID'");
		$query = $this->ci->db->query("UPDATE user_data SET phone = '$phone', website = '$website', activities = '$activities', interests = '$interests', about = '$about' WHERE user_id = '$UserID'");
	}
	
	/*
	Изменение пароля
	*/
	function NewPassword($UserID, $NewPassword)
	{
		$NewPassword=md5($NewPassword.'secret_message'); //md5 кодирует строку с паролем 
		$query = $this->ci->db->query("UPDATE users SET password = '$NewPassword' WHERE user_id = '$UserID");
	}
	
	/*
	Редактирование аватара
	*/
	function UpdateAvatar($UserID, $AvatarImagePath)
	{
		$query = $this->ci->db->query("UPDATE user_data SET avatar_url = '$AvatarImagePath' WHERE user_id = '$UserID");
	}
}
?>