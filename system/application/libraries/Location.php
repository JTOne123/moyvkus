<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Location {
	
	var $ci;
	
	function Location()
	{
		$this->ci =& get_instance();
		$this->ci->load->database();
	}
	
	/*
		��������� ������ �� ��� ID
	*/
	function GetCity($CityID)
	{
		$query = $this->ci->db->query("SELECT * FROM city WHERE city_id = '$CityID'");
		$row = $query->row();
		
		return $row;
	}
	/*
	��������� ������� �� ��� ID
	*/
	function GetRegion($RegionID)
	{
		$query = $this->ci->db->query("SELECT * FROM region WHERE region_id = '$RegionID'");
		$row = $query->row();
		
		return $row;
	}
	/*
	��������� ������ �� ��� ID
	*/
	function GetCountry($CountryID)
	{
		$query = $this->ci->db->query("SELECT * FROM country WHERE country_id = '$CountryID'");
		$row = $query->row();
		
		return $row;
	}
}
?>