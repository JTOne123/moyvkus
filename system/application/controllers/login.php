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
		$data['title'] = $this->lang->line('title').' - Вход';
		$data['keywords'] = $this->lang->line('keywords');
		$data['description'] = $this->lang->line('description');
		$data['baseurl'] = base_url();
		$data['header'] = $this->load->view('header', $data, true);
	    $data['menu']=$this->Menu->buildmenu();
		
	    $data['password'] = $this->lang->line('password');
	    $data['log_in'] = $this->lang->line('log_in');
	    
	    ///валидатор
		$rules['email'] = "callback_check_mail";//required|min_length[6]|max_length[100]|valid_email|
		$rules['password'] = "required|min_length[6]|max_length[100]|alpha_numeric";
		$this->validation->set_rules($rules);

		$fields['email'] = $this->lang->line('email');
		$fields['password'] = $this->lang->line('password');
		$this->validation->set_fields($fields);
		
		
	    
		$FormBuild=1;
		
	   if ($this->validation->run() == TRUE) 
		{
			$FormBuild=0;
			$data['body'] = 'run';
		}
		
		
		
		
        if($FormBuild==1)
        {
		$data['body']= $this->parser->parse('login', $data);
        }
        
 		$this->parser->parse('main_tpl', $data);
	}

	//Проверка на наличие адреса email в БД START
	function check_mail($email) //есть ли в БД такой юзер. Если нет - значит нехер логинится.
	{
		$returned_value = $this->usermanagment->IsUserExits($email);
		if($returned_value==true)
		{
			$this->validation->set_message('check_mail', $this->lang->line('check_user_mail_exist'));
			return false;
		}
		else
			return true;
	}
	//Проверка на наличие адреса email в БД END

	function check_pasword()
	{
		$returned_bool = $this->usermanagment->IsPasswordValid($email, $password);

		if($returned_bool==true)
		{
			return true;
		}
		else 
		{
			$this->validation->set_message('check_mail', $this->lang->line('check_user_mail_exist'));
			return false;
		}
	}
	
}
?>