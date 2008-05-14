<?php

class Menu extends Model {
	
	function Menu()
	{
		parent::Model();
		$this->load->database();
	}
	
	function buildmenu()
	{
		$menu_html = '';
		
		if($this->userauthorization->is_logged_in())
		{
			$query = $this->get_menu_data();
			
			$menu_html = '<table cellpadding="0" cellspacing="0"><tr>';
			
			foreach ($query->result() as $row)
			{
				$url = str_replace("~/", base_url(),$row->url);
				$img_url = str_replace("~/", base_url(),$row->img_url);
				
				$menu_html = $menu_html . '<td>' .  $this->get_menu($url, $row->text, $img_url, $row->tooltip) . '</td>';
			}
			
			$menu_html = $menu_html . '</tr></table>';
		}
		
		return $menu_html;
	}
	
	function get_menu($url, $text, $img_url, $tooltip)
	{
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
		return $this->db->query("SELECT text, url, img_url, tooltip FROM menu ORDER BY sort ASC");
	}
	
}
?>