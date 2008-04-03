<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Notification {
	
	var $ci;
	
	function Notification()
	{
		$this->ci =& get_instance();
		$this->ci->email->initialize($config);
		$this->ci->load->library('email');
		$this->ci->load->database();
	}
	
	function AfterRegistration($email)
	{
		
		$this->email->from('your@your-site.com', 'Your Name');
		$this->email->to('someone@example.com');
		$this->email->cc('another@another-example.com');
		$this->email->bcc('them@their-example.com');
		
		$this->email->subject('Email Test');
		$this->email->message('Testing the email class.');
		
		$this->email->send();
	}
	
}
?>