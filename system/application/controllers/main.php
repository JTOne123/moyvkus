<?php

class Main extends Controller {
	
	function Main()
	{
		parent::Controller();
		$this->load->model('register_form');
		$this->load->model('best_recipes');
		$this->load->library('user_managment');
		$this->load->library('receipes_management');
	}
	
	
	function index()
	{
	    
	    if($this->user_authorization->is_logged_in() == true)
	    {
		redirect('/profile/', 'refresh');
	    }
	    
	    
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
		$data['population'] = $this->lang->line('population').': '.$this->user_managment->GetNumberOfUsers();
		$data['number_of_recipes'] = $this->lang->line('number_of_recipes').': '.$this->receipes_management->GetNumberOfRecipes();
		
		

		return $data;
	}
}
?>