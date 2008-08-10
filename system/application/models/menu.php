<?php

class Menu extends Model {
	
	function Menu()
	{
		parent::Model();
		$this->load->database();
		$this->load->library('my_friends_lib');
		$this->load->library('message');
	}
	
	function buildmenu()
	{
		$menu_html = '';
		
		if($this->user_authorization->is_logged_in())
		{
			$query = $this->get_menu_data();
			
			$user_id = $this->user_authorization->get_loged_on_user_id();
			
			$menu_html = '<table cellpadding="0" cellspacing="0" class="MainMenuTable"><tr>';
			
			foreach ($query->result() as $row)
			{
				$url = str_replace("~/", base_url(),$row->url);
				$img_url = str_replace("~/", base_url(),$row->img_url);
				
				$menu_html = $menu_html . '<td>' .  $this->get_menu($url, $row->text, $img_url, $row->tooltip, $row->id, $user_id) . '</td>';
			}
			
			$menu_html = $menu_html . '</tr></table>';
		}
		
		return $menu_html;
	}
	
	function get_menu($url, $text, $img_url, $tooltip, $menu_id, $user_id)
	{	
		if($menu_id == 4)
		{
			$message_count = $this->message->MessageCount($user_id);
			
			if($message_count>0)
			{
				$text = $text . "<b>($message_count)</b>";
			}
		}
		
		if($menu_id == 8)
		{
			$friend_count = $this->my_friends_lib->NewFriendCount($user_id);
			
			if($friend_count>0)
			{
				$text = $text . "<b>($friend_count)</b>";
			}
		}
		
		if($img_url!="")
			return "<a href=\"$url\" class=\"Menu\" title=\"$tooltip\" onclick = \"window.location.href = '$url'\">
					<table class=\"MenuTable\" cellpadding=\"2\" cellspacing=\"0\">
					<tr><td><img src=\"$img_url\"/ class=\"MenuImage\"></td>
					<td>$text</td></tr>
					</table></a>";
		else
			return "<a href=\"$url\" class=\"Menu\" title=\"$tooltip\" onclick = \"window.location.href = '$url'\">
					<table class=\"MenuTable\" cellpadding=\"2\" cellspacing=\"0\">
					<tr><td>$text</td></tr>
					</table></a>";	
		
	}
	
	function get_menu_data()
	{
		return $this->db->query("SELECT id, text, url, img_url, tooltip FROM menu ORDER BY sort ASC");
	}
	
}
?>
