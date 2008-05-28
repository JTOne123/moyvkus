<?php

class Ratings extends Controller {

	function Ratings()
	{
		parent::Controller();

		$this->load->library('user_managment');
		$this->load->library('user_authorization');
		$this->load->library('receipes_management');
		$this->load->library('rating');
	}

	function _remap($method) {
		//��������, ��������� ��� �����������
		$allowedPages = array();
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

	}

	function act()
	{
		$marker = $this->input->post('marker');
		$recipe_id = $this->input->post('recipe_id');
		$loged_user_id = $this->user_authorization->get_loged_on_user_id();
		$author_user_id = $this->receipes_management->GetAuthorIdByRecipeId($recipe_id);
		
		$IsUserIsAuthorOfRecipe = $this->receipes_management->IsUserIsAuthorOfRecipe($recipe_id, $loged_user_id);
		//var_dump($this->rating->is_user_voted_before($loged_user_id, $recipe_id));
		if($this->rating->is_user_voted_before($loged_user_id, $recipe_id) !== true and $IsUserIsAuthorOfRecipe !==true)
		{
		$this->rating->vote($marker, $recipe_id, $loged_user_id, $author_user_id);
		}
		
		echo $this->rating->get_recipe_rating($recipe_id);
	}


}
?>