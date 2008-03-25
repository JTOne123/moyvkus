<?php

class Main extends Controller {
	
	function Main()
	{
		parent::Controller();	
	}
	
	function index()
	{
    $data['title'] = $this->lang->line('title');
    $data['keywords'] = $this->lang->line('keywords');
    $data['description'] = $this->lang->line('description');
    $data['header'] = $this->load->view('header', $data, true);
	
	
    
    $this->parser->parse('main_tpl', $data);
	
	}
}
?>