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
	    $data['login']=$this->Loginform->build_login_form();
		
	    $data['password'] = $this->lang->line('password');
	    $data['log_in'] = $this->lang->line('log_in');
	    $data['forgot_password'] = $this->lang->line('forgot_password');
	    $data['checkbox_remember'] = $this->lang->line('checkbox_remember');
	    
	    ///валидатор
		$rules['email'] = "required|min_length[6]|max_length[100]|valid_email|callback_check_mail";
		$rules['password'] = "required|min_length[6]|max_length[100]|alpha_numeric";
		$this->validation->set_rules($rules);

		$fields['email'] = $this->lang->line('email');
		$fields['password'] = $this->lang->line('password');
		$this->validation->set_fields($fields);
		
		
	    
		$FormBuild=1;
		
	   if ($this->validation->run() == TRUE) 
		{
			$email=$this->input->post('email');
			$password=$this->input->post('password');
			
			$result_of_check = $this->usermanagment->IsPasswordValid($email, $password);
			if($result_of_check==false) //если пароль не правильный, - редирект на страницу login
			{
			 redirect('/login/', 'refresh');
			}
			
			
			
			$data['body'] = 'run';
			$FormBuild=0;
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
	
}
?>