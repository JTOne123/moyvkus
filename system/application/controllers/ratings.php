<?php

class Ratings extends Controller {

	function Ratings()
	{
		parent::Controller();

		$this->load->library('usermanagment');
		$this->load->library('userauthorization');
		$this->load->library('receipesmanagement');
		$this->load->library('rating');
	}

	function _remap($method) {
		//страницы, доступные без авторизации
		$allowedPages = array();
		$pars = $this->uri->segment_array();
		unset($pars[1]);
		unset($pars[2]);


		if (($method != null) &&
		(($this->userauthorization->is_logged_in() !== false) ||  in_array($method, $allowedPages))) {
			call_user_func_array(array($this, $method), $pars);
		}
		else
		redirect('/login/', 'refresh');
	}

	function index()
	{

	}

	function act()
	{
		$marker = $this->input->post('marker');
		$recipe_id = $this->input->post('recipe_id');
		$user_id = $this->userauthorization->get_loged_on_user_id();
		
		$IsUserIsAuthorOfRecipe = $this->receipesmanagement->IsUserIsAuthorOfRecipe($recipe_id, $user_id);
		
		if($this->rating->is_user_voted_before($user_id, $recipe_id) !== true and $IsUserIsAuthorOfRecipe !==true)
		{
		$this->rating->vote($marker, $recipe_id, $user_id);
		}
		
		echo $this->rating->get_recipe_rating($recipe_id);
	}


}
?>