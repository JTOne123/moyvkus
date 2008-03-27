<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Usermanagment {
	
	var $ci;
	
	function Usermanagment()
	{
		$this->ci =& get_instance();
		$this->ci->load->database();
	}
	
	/*
	Полная соотвестиве регистрациионой форме файсбука
	email, пароль, имя, фамилия, день рождения, месяц рождения, и год рождения
	-1 - юзер с таким email'ом уже существует
	 0 - ок
	 */
	
	function AddUser($email, $first_name, $last_name, $password)
	{
	/*	if($this->IsUserExits($email))
			return -1;
		else
		{	*/
			
			$query = $this->ci->db->query("INSERT INTO users(email, first_name, last_name, pass) VALUES($email, $first_name, $last_name, $pass)");
			//return 0;
		//}
	}
	
	/*
	Проверка существует ли юзер с заданым email'ом
	*/
	function IsUserExits($email)
	{	
		$query = $this->ci->db->query("CALL IsUserExits('$email')");
		
		$count=0;	
		foreach ($query->result() as $row)
		{	
			$count=$row->c;
		}
		
		if($count==0)
			return false;
		else
			return true;
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
	Получение ID юзера по email
	*/
	function GetUserIDByEmail($email)
	{
		
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