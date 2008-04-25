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
		$password=md5($password.'secret_message'); //md5 �������� ������ � ������� 
		$query = $this->ci->db->query("INSERT INTO users(email, first_name, last_name, password) VALUES('$email', '$first_name', '$last_name', '$password')");
		
		$UserID = $this->GetUserInfoByEmail($email)->id;
		
		$query = $this->ci->db->query("INSERT INTO user_data(user_id) VALUES('$UserID')");
		
		return $UserID;
	}
	
	/*
	�������� ���������� �� ���� � ������� email'��
	*/
	function IsUserExits($email)
	{	
		$query = $this->ci->db->query("SELECT id FROM users WHERE email = '$email'");
		
		if($query->num_rows()==0)
			return false;
		else 
			return true;
	}
	
	
	/*
	�������� ���������� ������ �� email
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
	�������� ���������� ������ �� email
	*/
	function IsPasswordValidByID($ID, $password)
	{
		$query = $this->ci->db->query("SELECT password FROM users WHERE ID='$ID'");
		
		$row = $query->row();
		
		$password=md5($password.'secret_message');
		if($password == $row->password)
		{
			return true;
		}
		else 
			return false;
	}
	
	
	//��������� Info ����� �� email
	function GetUserInfoByEmail($email)
	{
		$query = $this->ci->db->query("SELECT id, first_name, last_name, password, birthday FROM users WHERE email = '$email'");
		$row = $query->row();
		
		return $row;
	}
	
	/*
	��������� ����� �� ID
	*/
	function GetUser($UserID)
	{
		$query = $this->ci->db->query("SELECT email, first_name, last_name, password, birthday, sex, city, country FROM users WHERE ID = $UserID");
		$row = $query->row();
		
		return $row;
	}
	
	/*
	��������� �������������� ������  ��� ����� �� ID
	*/
	function GetUserData($UserID)
	{
		$query = $this->ci->db->query("SELECT phone, website, activities, interests, about, avatar_name FROM user_data WHERE user_id = $UserID");
		$row = $query->row();
		
		return $row;
	}
	
	/*
	���������� ������ �����
	*/
	function UpdateUser($UserID, $first_name, $last_name, $birthday, $sex, $city, $region, $country, $phone, $website, $activities, $interests, $about)
	{
		$query = $this->ci->db->query("UPDATE users SET first_name = '$first_name', last_name = '$last_name', birthday = '$birthday', sex = '$sex', city = '$city', region = '$region', country = '$country'  WHERE ID = '$UserID'");
		$query = $this->ci->db->query("UPDATE user_data SET phone = '$phone', website = '$website', activities = '$activities', interests = '$interests', about = '$about' WHERE user_id = '$UserID'");
	}
	
	/*
	��������� ������
	*/
	function NewPassword($UserID, $NewPassword)
	{
		$NewPassword=md5($NewPassword.'secret_message'); //md5 �������� ������ � ������� 
		$query = $this->ci->db->query("UPDATE users SET password = '$NewPassword' WHERE ID = '$UserID'");
	}
	
	/*
	�������������� �������
	*/
	function UpdateAvatar($user_id, $file_ext)
	{
		$this->ci->db->query("UPDATE user_data set avatar_name='a_$user_id$file_ext' WHERE user_id=$user_id");
	}
}
?>