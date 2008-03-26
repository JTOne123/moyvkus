<?php

class Register extends Controller {
	
	function Register()
	{
		parent::Controller();
		$this->load->helper('form');
	}
	
	function index()
	{
    $data['title'] = $this->lang->line('title').' - Регистрация';
    $data['keywords'] = $this->lang->line('keywords');
    $data['description'] = $this->lang->line('description');
    $data['header'] = $this->load->view('header', $data, true);
	
    //Форма START
    
    $data['sign_up_message'] = $this->lang->line('sign_up_message');
    $data['sign_up_slogan_message'] = $this->lang->line('sign_up_slogan_message');
    $data['first_name'] = $this->lang->line('first_name');
    $data['last_name'] = $this->lang->line('last_name');
    $data['password'] = $this->lang->line('password');
    $data['sing_up'] = $this->lang->line('sing_up');
    
	$data['body']= $this->parser->parse('register', $data);
	    
    //Форма END
    
    $this->parser->parse('main_tpl', $data);	
	}
}
?>