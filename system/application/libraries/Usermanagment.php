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
	
	function AddUser($email, $password, $first_name, $last_name, $day, $month, $year)
	{
		if($this->IsUserExits($email))
			return -1;
		else
		{	
			$birthday=time();
			
			$query = $this->ci->db->query("CALL AddUser($email, $password, $first_name, $last_name, $birthday)");
			return 0;
		}
	}
	
	/*
	�������� ���������� �� ���� � ������� email'��
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