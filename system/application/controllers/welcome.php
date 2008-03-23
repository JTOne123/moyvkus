<?php

class Welcome extends Controller {
	
	function Welcome()
	{
		parent::Controller();	
	}
	
	function index()
	{
		$this->load->view('welcome_message');
		
		$this->load->library('Usermanagment'); 
		
		/*$answer = $this->usermanagment->IsUserExits("aaa@aaa.com");
				
		if($answer)
			echo "<br/> Answer - true";
		else
			echo "<br/> Answer - false";*/
		
		echo $this->usermanagment->AddUser("aaa@aaa123.com","password","fn","ln",1,2,1986);
		
	}
}
?>