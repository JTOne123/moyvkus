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
		    $password=md5($password); //md5 кодирует строку с паролем 
			$query = $this->ci->db->query("INSERT INTO users(email, first_name, last_name, password) VALUES('$email', '$first_name', '$last_name', '$password')");
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
		$query = $this->ci->db->query("CALL IsPasswordValid('$email')");
		
		$result_password="";	
		
		foreach ($query->result() as $row)
		{	
			$result_password=$row->password;
		}
		
		if($result_password==$password)
			return true;
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
	function GetUser($ID)
	{
		
	}
	
	/*
	Расширение редоктирование юзера
	*/
	function EditUser()
	{
		
	}
}
?>