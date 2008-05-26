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
	
	function InviteFriend($user_id, $friend_id, $friend_email, $friend_first_name, $friend_last_name)
	{	
		$user = $this->ci->usermanagment->GetUser($user_id);
	
		$this->ci->email->from($this->ci->lang->line('AfterRegistraionEmailFrom'), $this->ci->lang->line('AfterRegistraionEmailFromName'));
		$this->ci->email->to($friend_email);
		
		$this->ci->email->subject($this->ci->lang->line('InviteEmailSubject'));
		
		$message_text = $this->ci->lang->line('InviteEmailMessage');
		
		$message_text = str_replace("{InvetedUserFullName}", $friend_first_name . ' ' . $friend_last_name, $message_text);
		$message_text = str_replace("{UserFullName}", $user->first_name . ' ' . $user->last_name, $message_text);
		$message_text = str_replace("{UrlForRegister}", 'http://' . $_SERVER['HTTP_HOST'] . '/register/invite/id/' . $friend_id, $message_text);
		
		$this->ci->email->message($message_text);
		
		$this->ci->email->send();
	}
	
	function Forget_password($user_id, $user_code)
	{	
		$user = $this->ci->usermanagment->GetUser($user_id);
		
		$this->ci->email->from($this->ci->lang->line('AfterRegistraionEmailFrom'), $this->ci->lang->line('AfterRegistraionEmailFromName'));
		$this->ci->email->to($user->email);
		
		$this->ci->email->subject($this->ci->lang->line('ForgetPasswordRequestSubject'));
		
		$message_text = $this->ci->lang->line('ForgetPasswordRequestMessage');
		
		$message_text = str_replace("{UserFullName}", $user->first_name . ' ' . $user->last_name, $message_text);
		$message_text = str_replace("{NewPasswordRequestUrl}", 'http://' . $_SERVER['HTTP_HOST'] . '/messagebox/new_password_request/' . $user_code, $message_text);
		
		$this->ci->email->message($message_text);
		
		$this->ci->email->send();
	}
}
?>