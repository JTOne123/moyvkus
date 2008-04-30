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
		$now = mdate("%Y-%m-%d %h:%i", time());
		
		$this->ci->db->query("INSERT INTO message(from_id, to_id, subject, text, date) VALUES('$from_id', '$to_id', '$subject', '$text', '$now')");
	}
	
	function GetMessages($user_id, $filter)
	{
		if($filter == "")
			$query = $this->ci->db->query("SELECT from_id, subject, text, id, date FROM message WHERE to_id = $user_id");
		else
			$query = $this->ci->db->query("SELECT from_id, subject, text, id, date FROM message WHERE to_id = $user_id AND (subject LIKE '$filter' OR text LIKE '$filter' OR date LIKE '$filter'))");
		
		
		return $query;
	}
	
	function DeleteMessage($message_id, $user_id)
	{
		$this->ci->db->query("DELETE FROM message WHERE id = $message_id AND to_id = $user_id");
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
	
	function GetMessageListBuilderHTML()
	{
		return '<div id="FriendsItem" class="FriendsItem">
				<table cellpadding="0" cellspacing="0" class="MessageItemTable">
				<tr>
				<td valign="top" class="MessageAvatarTd">
				<a href="{AuthorUrl}">
				<img src="{AuthorAvatarUrl}" title="{AuthorFullName}" class="FriendAvatar" /></a>
				</td>
				<td valign="top">
				<table>
				<tr>
				<td class="MessageCaption">
				{Sender}
				</td>
				<td class="MessageCaption">
				{Subject}
				</td>
				</tr>
				<tr>
				<td class="MessageLabelValue">
				<a href="{AuthorUrl}">{AuthorFullName}</a>
				</td>
				<td class="MessageLabelValue">
				<a href="{MessageUrl}">{MessageSubject}</a>
				</td>
				</tr>
				<tr>
				<td class="MessageLabelValue">
				{MessageDate}
				</td>
				<td class="MessageLabelValue">
				<a href="{MessageUrl}">{MessageShortText}</a>
				</td>
				</tr>
				</table>
				</td>
				<td valign="top">
				<table>
				<tr>
				<td class="MessageCaption">
				{Action}
				</td>
				</tr>
				<tr>
				<td>
				<a href="{AnswerUrl}" id="Answer" name="Answer">
				<div class="Login_submit">
				{Answer}
				</div>
				</a>
				</td>
				</tr>
				<tr>
				<td>
				<a href="{MessageDeleteUrl}" id="Delete" name="Delete">
				<div class="Login_submit">
				{Delete}
				</div>
				</a>
				</td>
				</tr>
				</table>
				</td>
				</tr>
				</table>
				</div>';
	}
	
	}