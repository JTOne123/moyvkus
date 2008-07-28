<?php

class Main extends Controller {
	
	function Main()
	{
		parent::Controller();
		$this->load->model('register_form');
		$this->load->model('best_recipes');
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
		$data = $this->_load_headers();
		
		$data = $this->_load_resource($data);
		
		$data['body']= $this->parser->parse('main', $data);
		
		$this->parser->parse('main_tpl', $data);
	}
	
	function _load_headers()
	{
		$data['title'] = $this->lang->line('title');
		$data['keywords'] = $this->lang->line('keywords');
		$data['description'] = $this->lang->line('description');
		$data['baseurl'] = base_url();
		$data['header'] = $this->load->view('header', $data, true);
		
		return $data;
	}
	
	function _load_resource($data)
	{
		$data['menu']=$this->Menu->buildmenu();

		$data['login']=$this->Loginform->build_login_form();
		$data['register'] = $this->register_form->build_register_form();
		$data['best_recipe_builder'] = $this->best_recipes->build_best_recipes();
		
		$data['search_recipe'] = $this->load->view('search_recipe_form', $data, true);
		
		$data['Info1'] = $this->lang->line('Info1');
		$data['Info2'] = $this->lang->line('Info2');
		$data['Info3'] = $this->lang->line('Info3');
		$data['Info4'] = $this->lang->line('Info4');
		$data['Info5'] = $this->lang->line('Info5');
		
		
		$data['SimpleSearchRecipe'] = $this->lang->line('SimpleSearchRecipeMain');
		$data['SearchButton'] = $this->lang->line('SearchButton');
		$data['SimpleSearchDescriptionRecipies'] = $this->lang->line('SimpleSearchDescriptionRecipies');
		
		$data['LittleDescription'] = $this->lang->line('LittleDescription');

		return $data;
	}
}
?>