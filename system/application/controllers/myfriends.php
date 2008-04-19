<?php

class MyFriends extends Controller {
	
	function MyFriends()
	{
		parent::Controller();
		
		$this->load->library('validation');
		
		$this->load->library('usermanagment');
		
		$this->load->helper('date');
	}
	
	function index()
	{
		$data = $this->load_headrs();
		
		$data = $this->load_resource($data);
		
		$data = $this->data_bind($data);
		
		
		$data['body']= $this->parser->parse('myfriends', $data);
		
		$this->parser->parse('main_tpl', $data);
	}
	
	function load_headrs()
	{
		$data['title'] = $this->lang->line('MyFriends');
		$data['keywords'] = $this->lang->line('keywords');
		$data['description'] = $this->lang->line('description');
		$data['baseurl'] = base_url();
		$data['header'] = $this->load->view('header', $data, true);
		$data['menu']=$this->Menu->buildmenu();
		$data['login']='';
		
		return $data;
	}
	
	function load_resource($data)
	{
		// Локализация надписей
		$data['MyFriends'] = $this->lang->line('MyFriends');
		$data['FriendsFilter'] = $this->lang->line('FriendsFilter');
		$data['Search'] = $this->lang->line('Search');
		
		return $data;
	}
	
	function data_bind($data)
	{
		$data['FriendsCount'] = $this->lang->line('MyFriendsHeader');
		
		return $data;
	}
}
?>