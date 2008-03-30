<?php

class Menu extends Controller {
	
	function Menu()
	{
		parent::Controller();
		$this->load->helper('form');
		$this->load->database();
	}
	
	function index()
	{
		$data['title'] = $this->lang->line('title').' - Регистрация';
		$data['keywords'] = $this->lang->line('keywords');
		$data['description'] = $this->lang->line('description');
		$data['header'] = $this->load->view('header', $data, true);
		
		$query = $this->get_menu_data();
		
		$menu_html = '<table cellpadding="0" cellspacing="0"><tr>';
		
		foreach ($query->result() as $row)
		{
			$menu_html = $menu_html . '<td>' .  $this->get_menu($row->url, $row->text, $row->img_url, $row->tooltip) . '</td>';
		}
		
		$menu_html = $menu_html . '</tr></table>';
		
		echo $menu_html;
    
		$this->parser->parse('main_tpl', $data);
	}
	
	function get_menu($url, $text, $img_url, $tooltip)
	{
		if($img_url!="")
			return "<a href=\"$url\" class=\"Menu\" title=\"$tooltip\">
					<table class=\"MenuTable\" cellpadding=\"2\" cellspacing=\"0\">
					<tr><td><img src=\"$img_url\"/ class=\"MenuImage\"></td>
					<td>$text</td></tr>
					</table></a>";
		else
			return "<a href=\"$url\" class=\"Menu\" title=\"$tooltip\">
					<table class=\"MenuTable\" cellpadding=\"2\" cellspacing=\"0\">
					<tr><td>$text</td></tr>
					</table></a>";	
			
	}
	
	function get_menu_data()
	{
		return $this->db->query("SELECT text, url, img_url, tooltip FROM menu");
	}
	
}
?>