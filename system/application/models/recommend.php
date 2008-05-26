<?php

class Recommend extends Model {
	
	function Recommend()
	{
		parent::Model();
		$this->load->database();
	}
	
	function Build()
	{
		$loged_on_user = $this->userauthorization->get_loged_on_user_id();
		

		return $this->userauthorization->get_loged_on_user_id();
	}
	
}
?>