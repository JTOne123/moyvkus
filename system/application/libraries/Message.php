<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Message {
	
	var $ci;
	
	function Message()
	{
		$this->ci =& get_instance();
		
		$this->ci->load->database();
		
		$this->ci->load->helper('date');
	}
	
	function SendMessage($from_id, $to_id, $subject, $text)
	{
		$now = mdate("%Y-%m-%d %h:%i:%a", time());
		
		$this->ci->db->query("INSERT INTO message(from_id, to_id, subject, text, date) VALUES('$from_id', '$to_id', '$subject', '$text', '$now')");
	}
	
	function GetCountOfMessage($user_id)
	{
		$query = $this->ci->db->query("SELECT COUNT(1) AS c FROM message WHERE to_id = $user_id");
		$row = $query->row();
		
		return $row->c;
	}
	
	function GetMessage($message_id)
	{
		
	}
	
	function DeleteMessage($message_id)
	{
		
	}
	
	function CanSend($user_id)
	{		
		$return_value = false;
		
		$now = mdate("%Y-%m-%d", time());
		
		$query = $this->ci->db->query("SELECT id, message_count FROM message_spam_filter WHERE user_id = $user_id and date = '$now'");
		
		$row = $query->row();
		
		$message_id = $row->id;
		$message_count = $row->message_count;
		
		if($message_count == false)
		{
			$return_value = true;
			$this->ci->db->query("INSERT INTO message_spam_filter (user_id, message_count, date) VALUES ($user_id, 1, '$now')");
		}
		else	
		{
			if($message_count > 20 )
				$return_value = false;
			else
			{
				$message_count++;
				
				$return_value = true;
				$this->ci->db->query("UPDATE message_spam_filter SET message_count = $message_count WHERE id = $message_id");
			}
		}
		
		return $return_value;
	}
	
	function DeleteFromSpamFilterTable($now)
	{
		$this->ci->db->query("DELETE FROM message_spam_filter WHERE date < '$now'");
	}
	
	}