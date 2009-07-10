<?php

class About extends Controller {
	
	function About()
	{
		parent::Controller();
	}
	
	
	function index()
	{
	    
	    
		$data = $this->_load_headers();
		
		$data['AboutProject'] = $this->lang->line('AboutProject');
		$data['AboutProjectText'] = $this->lang->line('AboutProjectText');
		
		$data['body']= $this->parser->parse('about', $data);
		
		$this->parser->parse('main_tpl', $data);
	}
	
	function _load_headers()
	{
		$data['menu']=$this->Menu->buildmenu();
		$data['title'] = $this->lang->line('title');
		$data['keywords'] = $this->lang->line('keywords');
		$data['description'] = $this->lang->line('description');
		$data['baseurl'] = base_url();
		$data['header'] = $this->load->view('header', $data, true);
		
		return $data;
	}
}
?>