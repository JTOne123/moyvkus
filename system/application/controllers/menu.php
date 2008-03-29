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
			$menu_html = $menu_html . '<td>' .  $this->get_menu($row->url, $row->text) . '</td>';
		}
		
		$menu_html = $menu_html . '</tr></table>';
		
		echo $menu_html;
    
		$this->parser->parse('main_tpl', $data);
	}
	
	function get_menu($url, $text)
	{
		return "<a href=\"$url\"><div class=\"Menu\">$text</div></a>";
	}
	
	function get_menu_data()
	{
		return $this->db->query("SELECT text, url FROM menu");
	}
	
}
?>