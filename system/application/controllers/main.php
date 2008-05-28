<?php

class Main extends Controller {
	
	function Main()
	{
		parent::Controller();
		$this->load->model('register_form');
	}

	function _remap($method) {
		//страницы, доступные без авторизации
		$allowedPages = array('index');
		$pars = $this->uri->segment_array();
		unset($pars[1]);
		unset($pars[2]);


		if (($method != null) &&
		(($this->user_authorization->is_logged_in() !== false) ||  in_array($method, $allowedPages))) {
			call_user_func_array(array($this, $method), $pars);
		}
		else 
		    redirect('/login/', 'refresh');	
	}
	
	
	function index()
	{
    $data['title'] = $this->lang->line('title');
    $data['keywords'] = $this->lang->line('keywords');
    $data['description'] = $this->lang->line('description');
    $data['baseurl'] = base_url();
    $data['header'] = $this->load->view('header', $data, true);

	$data['menu']=$this->Menu->buildmenu();
	$data['login']=$this->Loginform->build_login_form();
	
	$data['register'] = $this->register_form->build_register_form();
	
	$data['search_recipe'] = $this->load->view('search_recipe_form', $data, true);
	
	$data['Search'] = $this->lang->line('Search');
	$data['SearchDescriptionMain'] = $this->lang->line('SearchDescriptionMain');
	
	//var_dump($this->user_authorization->is_logged_in());
	$data['body'] = $this->parser->parse('main', $data);
    $this->parser->parse('main_tpl', $data);
	
	}
}
?>