<?php

class Login extends Controller {
	
	function Login()
	{
		parent::Controller();
		$this->load->library('validation');
		$this->load->library('usermanagment');
		
	}
	
	function index()
	{
		$data['title'] = $this->lang->line('title').' - ¬ход';
		$data['keywords'] = $this->lang->line('keywords');
		$data['description'] = $this->lang->line('description');
		$data['baseurl'] = base_url();
		$data['header'] = $this->load->view('header', $data, true);
	    $data['menu']=$this->Menu->buildmenu();
		
	    $data['password'] = $this->lang->line('password');
	    $data['log_in'] = $this->lang->line('log_in');
	    $data['body']= $this->parser->parse('login', $data);
 
		$this->parser->parse('main_tpl', $data);
	}
	
	
	function try_login()
	{
	    
		$email=$this->input->post('email');
	    $password=$this->input->post('password');
        if($email!==false && $password!==false)
        {
        
	    $returned_bool = $this->usermanagment->IsPasswordValid($email, $password);
	    
	    if($returned_bool==true)
	    {
	    	echo '—оздаем сессию и т.д.';
	    }
	    else 
	    {
	    	redirect('/login/', 'refresh');
	    }
		
        }
        else redirect('/login/', 'refresh');
        
	}
	
}
?>