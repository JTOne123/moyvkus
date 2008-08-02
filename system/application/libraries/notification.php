<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Notification {

	var $ci;

	function Notification()
	{
		$this->ci =& get_instance();
		$this->ci->load->library('email');
		$this->ci->load->library('user_managment');
	}

	function AfterRegistration($email, $password)
	{

		$config['mailtype'] = 'html';
		$this->ci->email->initialize($config);

		$returned_value = $this->ci->user_managment->GetUserInfoByEmail($email);

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

		$config['mailtype'] = 'html';
		$this->ci->email->initialize($config);

		$user = $this->ci->user_managment->GetUser($user_id);

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

		$config['mailtype'] = 'html';
		$this->ci->email->initialize($config);

		$user = $this->ci->user_managment->GetUser($user_id);

		$this->ci->email->from($this->ci->lang->line('AfterRegistraionEmailFrom'), $this->ci->lang->line('AfterRegistraionEmailFromName'));
		$this->ci->email->to($user->email);

		$this->ci->email->subject($this->ci->lang->line('ForgetPasswordRequestSubject'));

		$message_text = $this->ci->lang->line('ForgetPasswordRequestMessage');

		$message_text = str_replace("{UserFullName}", $user->first_name . ' ' . $user->last_name, $message_text);
		$message_text = str_replace("{NewPasswordRequestUrl}", 'http://' . $_SERVER['HTTP_HOST'] . '/messagebox/type/newpassword/' . $user_code, $message_text);

		$this->ci->email->message($message_text);

		$this->ci->email->send();
	}

	function New_password($user_id, $new_password)
	{
		$user = $this->ci->user_managment->GetUser($user_id);

		$this->ci->email->from($this->ci->lang->line('AfterRegistraionEmailFrom'), $this->ci->lang->line('AfterRegistraionEmailFromName'));
		$this->ci->email->to($user->email);

		$this->ci->email->subject($this->ci->lang->line('NewPasswordRequestSubject'));

		$message_text = $this->ci->lang->line('NewPasswordRequestMessage');

		$message_text = str_replace("{UserFullName}", $user->first_name . ' ' . $user->last_name, $message_text);
		$message_text = str_replace("{NewPassword}", $new_password, $message_text);

		$this->ci->email->message($message_text);

		$this->ci->email->send();
	}
	//****
	function new_massage($to_user_id, $from_user_id)
	{
		$to_user = $this->ci->user_managment->GetUser($to_user_id);
		$from_user = $this->ci->user_managment->GetUser($from_user_id);

		$this->ci->email->from($this->ci->lang->line('AfterRegistraionEmailFrom'), $this->ci->lang->line('AfterRegistraionEmailFromName'));
		$this->ci->email->to($to_user->email);

		$subject_text = $this->ci->lang->line('NewMessageSubject');
		$subject_text = str_replace("{UserFrom}", $from_user->first_name . ' ' . $from_user->last_name, $subject_text);
		$this->ci->email->subject($subject_text);

		$message_text = $this->ci->lang->line('NewMessageText');

		$message_text = str_replace("{ToUserFullName}", $to_user->first_name . ' ' . $to_user->last_name, $message_text);

		$this->ci->email->message($message_text);

		$this->ci->email->send();
	}



	function new_friend($to_user_id, $from_user_id)
	{
		$to_user = $this->ci->user_managment->GetUser($to_user_id);
		$from_user = $this->ci->user_managment->GetUser($from_user_id);

		$this->ci->email->from($this->ci->lang->line('AfterRegistraionEmailFrom'), $this->ci->lang->line('AfterRegistraionEmailFromName'));
		$this->ci->email->to($to_user->email);

		$subject_text = $this->ci->lang->line('NewFriendSubject');
		$subject_text = str_replace("{UserFrom}", $from_user->first_name . ' ' . $from_user->last_name, $subject_text);
		$this->ci->email->subject($subject_text);

		$message_text = $this->ci->lang->line('NewFriendText');

		$message_text = str_replace("{ToUserFullName}", $to_user->first_name . ' ' . $to_user->last_name, $message_text);

		$this->ci->email->message($message_text);

		$this->ci->email->send();
	}

	function new_comment($to_user_id, $from_user_id, $recipe_id)
	{
		$to_user = $this->ci->user_managment->GetUser($to_user_id);
		$from_user = $this->ci->user_managment->GetUser($from_user_id);

		$this->ci->email->from($this->ci->lang->line('AfterRegistraionEmailFrom'), $this->ci->lang->line('AfterRegistraionEmailFromName'));
		$this->ci->email->to($to_user->email);

		$subject_text = $this->ci->lang->line('NewCommentSubject');
		$subject_text = str_replace("{UserFrom}", $from_user->first_name . ' ' . $from_user->last_name, $subject_text);
		$this->ci->email->subject($subject_text);

		$message_text = $this->ci->lang->line('NewCommentText');

		$message_text = str_replace("{ToUserFullName}", $to_user->first_name . ' ' . $to_user->last_name, $message_text);
		$message_text = str_replace("{RecipeID}", $recipe_id, $message_text);

		$this->ci->email->message($message_text);

		$this->ci->email->send();
	}
}
?>