<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Location {
	
	var $ci;
	
	function Location()
	{
		$this->ci =& get_instance();
		$this->ci->load->database();
	}
	
	/*
		Получение города по его ID
	*/
	function GetCity($CityID)
	{
		$query = $this->ci->db->query("SELECT * FROM city WHERE city_id = $CityID");
		$row = $query->row();
		return $row;
	}
	
	function GetCitys($RegionID)
	{
		$return_value = Array();
		
		$query = $this->ci->db->query("SELECT * FROM city WHERE region_id = $RegionID");
		
		foreach($query->result() as $row)
		{
			$city_id = $row->city_id;
			$name = $row->name;
			
			$return_value[$city_id] = $name;
		}
		
		return $return_value;
	}
	/*
	Получение региона по его ID
	*/
	function GetRegions($CountryID)
	{
		$return_value = Array();
		
		$query = $this->ci->db->query("SELECT * FROM region WHERE country_id = $CountryID");
		
		foreach($query->result() as $row)
		{
			$region_id = $row->region_id;
			$return_value[$region_id] = $row->name;
		}
		
		return $return_value;
	}
	
	
	function GetRegion($RegionID)
	{
		$query = $this->ci->db->query("SELECT * FROM region WHERE region_id = $RegionID");
		$row = $query->row();
		
		return $row;
	}
	
	/*
	Получение массива стран
	*/
	function GetCountryNames()
	{
		$return_value = Array();
		
		$query = $this->ci->db->query("SELECT country_id, name FROM country");	
		foreach($query->result() as $row)
		{
			$country_id = $row->country_id;
			$name = $row->name;
			
			$return_value[$country_id] = $name;
		}	
		
		$return_value['']='';
		
		return $return_value;
	}
	
	
	function GetCountry($CountryID)
	{
		$query = $this->ci->db->query("SELECT * FROM country WHERE country_id = $CountryID");
		$row = $query->row();
		
		return $row;
	}
}
?>