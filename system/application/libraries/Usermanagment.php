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
		    $password=md5($password); //md5 �������� ������ � ������� 
			$query = $this->ci->db->query("INSERT INTO users(email, first_name, last_name, password) VALUES('$email', '$first_name', '$last_name', '$password')");
	}
	
	/*
	�������� ���������� �� ���� � ������� email'��
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
	�������� ���������� ������ �� email
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
	��������� Info ����� �� email
	������ �������������:
	
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
	��������� ����� �� ID
	*/
	function GetUser($ID)
	{
		
	}
	
	/*
	���������� �������������� �����
	*/
	function EditUser()
	{
		
	}
}
?>