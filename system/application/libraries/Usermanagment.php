<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Usermanagment {
	
	var $ci;
	
	function Usermanagment()
	{
		$this->ci =& get_instance();
		$this->ci->load->database();
	}
	
	/*
	������ ����������� ��������������� ����� ��������
	email, ������, ���, �������, ���� ��������, ����� ��������, � ��� ��������
	-1 - ���� � ����� email'�� ��� ����������
	 0 - ��
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
	�������� ���������� �� ���� � ������� email'��
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
	��������� ID ����� �� email
	*/
	function GetUserIDByEmail($email)
	{
		
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