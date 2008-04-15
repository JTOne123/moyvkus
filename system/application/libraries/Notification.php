<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Notification {
	
	var $ci;
	
	function Notification()
	{
		$this->ci =& get_instance();
		$this->ci->load->library('email');
		$this->ci->load->library('usermanagment');
	}
	
	function AfterRegistration($email, $password)
	{
		$returned_value = $this->ci->usermanagment->GetUserInfoByEmail($email);
		
		$this->ci->email->from($this->ci->lang->line('AfterRegistraionEmailFrom'), $this->ci->lang->line('AfterRegistraionEmailFromName'));
		$this->ci->email->to($email);
		
		$this->ci->email->subject($this->ci->lang->line('AfterRegistraionEmailSubject'));
		
		$message_text = $this->ci->lang->line('AfterRegistraionEmailMessage');
		
		$message_text = str_replace("{first_name}", $returned_value->first_name, $message_text);
		$message_text = str_replace("{last_name}", $returned_value->last_name, $message_text);
		$message_text = str_replace("{password}", $password, $message_text);

		$this->ci->email->message($message_text);
		
		$this->ci->email->send();
	}
}
?>