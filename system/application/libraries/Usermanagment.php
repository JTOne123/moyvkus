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
	
	function AddUser($email, $password, $first_name, $last_name, $day, $month, $year)
	{
		if($this->IsUserExits($email))
			return -1;
		else
		{	
		
			$this->ci->load->helper('date');
			
			$datestring = "$year-$month-$day";
			$time = time();
			
			$date_str = mdate($datestring, $time);
			
			$query = $this->ci->db->query("CALL AddUser('$email', '$password', '$first_name', '$last_name', '$date_str')");
			return 0;
		}
	}
	
	/*
	Проверка существует ли юзер с заданым email'ом
	*/
	function IsUserExits($email)
	{
		$count=0;
		
		$query = $this->ci->db->query("CALL IsUserExits('$email')");
		
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