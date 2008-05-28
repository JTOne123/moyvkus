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
	
	function GetCitys($CityID)
	{
		 $query = $this->ci->db->query("SELECT * FROM city WHERE region_id = $CityID");
		 foreach ($query->result_array() as $row)
		 {
		 	$rows[$row['city_id']]=$row['name'];
		 }
		  return $rows;
	}
	/*
	Получение региона по его ID
	*/
	function GetRegions($CountryID)
	{
    	$query = $this->ci->db->query("SELECT * FROM region WHERE country_id = $CountryID");
		 foreach ($query->result_array() as $row)
		 {
		 	$rows[$row['region_id']]=$row['name'];
		 }
		 
		  return $rows;
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
		 $query = $this->ci->db->query("SELECT country_id, name FROM country");		
		 foreach ($query->result_array() as $row)
		 {
		 	$rows[$row['country_id']]=$row['name'];
		 }
		    $rows['']='';
		  return $rows;
	}
	
	
		function GetCountry($CountryID)
	{
		$query = $this->ci->db->query("SELECT * FROM country WHERE country_id = $CountryID");
		$row = $query->row();
		
		return $row;
	}
}
?>