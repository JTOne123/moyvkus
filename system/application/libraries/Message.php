<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Message {
	
	var $ci;
	
	function Message()
	{
		$this->ci =& get_instance();
		$this->ci->load->database();
	}
	
	function SendMessage($from_id, $to_id, $subject, $text)
	{
		$this->ci->db->query("INSERT INTO message(from_id, to_id, subject, text) VALUES('$from_id', '$to_id', '$subject', '$text')");
	}
	
	function GetCountOfMessage($user_id)
	{
		
	}
	
	function GetMessage($message_id)
	{
		
	}
	
	function DeleteMessage($message_id)
	{
		
	}
	
	}