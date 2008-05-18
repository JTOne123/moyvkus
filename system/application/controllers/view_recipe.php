<?php

class View_recipe extends Controller {

	function View_recipe()
	{
		parent::Controller();

		$this->load->library('validation');
		$this->load->library('receipesmanagement');
		$this->load->library('usermanagment');

		$this->load->helper('form');
		$this->load->helper('typography');
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
		$data = $this->_load_headers();

		$data = $this->_load_resource($data);

		$data = $this->_data_bind($data);
		$data = $this->_edit_recipe($data);

		$data['body']= $this->parser->parse('view_recipe', $data);

		$this->parser->parse('main_tpl', $data);
	}

	function _load_headers()
	{
		$data['title'] = $this->lang->line('title').' - '.$this->lang->line('SomeRecipe');
		$data['keywords'] = $this->lang->line('keywords');
		$data['description'] = $this->lang->line('description');
		$data['baseurl'] = base_url();
		$data['header'] = $this->load->view('header', $data, true);
		$data['menu']=$this->Menu->buildmenu();
		$data['login']='';

		return $data;
	}

	function _load_resource($data)
	{
		// Ћокализаци€ надписей

		$data['NameOfRecipe'] = $this->lang->line('NameOfRecipe');


		return $data;
	}

	function _edit_recipe($data)
	{


		return $data;
	}



	function _data_bind($data)
	{

		$recipe_id_from_uri=$this->uri->segment(3);
		if($this->receipesmanagement->isexistrecipeid($recipe_id_from_uri)==true)
		{
			//явл€етс€ ли просмаривающий страницу юзер, автором рецепта START  // TRUE / FALSE
			$is_user_is_author=$this->receipesmanagement->isuserisauthorofrecipe($recipe_id_from_uri, $this->userauthorization->get_loged_on_user_id());
			//явл€етс€ ли просмаривающий страницу юзер, автором рецепта END
			
		  $recipe_obj_from_db=$this->receipesmanagement->getonerecipebyrecipeid($recipe_id_from_uri);
		  
		  $data['RecipeImgUrl'] = '/uploads/recipe_photos/big_photos/'.$recipe_obj_from_db->photo_name;
		  $data['ViewRecipeTitle'] = $this->lang->line('SomeRecipe').': '.$recipe_obj_from_db->name;
		   
		  $returned_row_userdata=$this->usermanagment->getuserdata($recipe_obj_from_db->user_id);
		  $avatar_name=$returned_row_userdata->avatar_name;
		  $data['UserImgUrl']='/uploads/user_avatars/'.$avatar_name;
		  
		  $returned_row_user=$this->usermanagment->getuser($recipe_obj_from_db->user_id);
		  $data['LinkToUserProfile']='/profile/id/'.$recipe_obj_from_db->user_id;
		  $data['NameOfAuthor']=$returned_row_user->first_name.' '.$returned_row_user->last_name;
		  
		  $data['AddedDateLabel'] = $this->lang->line('AddedDateLabel');
		  $data['AddedDateValue'] = $recipe_obj_from_db->timestamp;
		  
		  $data['RatingLabel'] = $this->lang->line('RatingLabel');
		  $data['RatingValue'] = $recipe_obj_from_db->rating;
		  
		  $data['IngredientsText'] = $this->lang->line('IngredientsText');
		  //$return_str='';
		  //for($i = 0; $i < strlen($recipe_obj_from_db->ingredients); $i++)
		  //$return_str = $return_str.$recipe_obj_from_db->ingredients[$i] . '<wbr>';
		  $return_str = $recipe_obj_from_db->ingredients;
		  $data['IngredientsValue'] = auto_typography($return_str);
		  
		  $data['RecipeText'] = $this->lang->line('TextOfRecipe');
		  //$return_str='';
		  //for($i = 0; $i < strlen($recipe_obj_from_db->recipe_text); $i++)
		  //$return_str = $return_str.$recipe_obj_from_db->recipe_text[$i] . '<wbr>';
		  $return_str = $recipe_obj_from_db->recipe_text;
		  $data['RecipeValue'] = auto_typography($return_str);
		  
		  $data['CategoryNameLabel'] = $this->lang->line('CategoryOfRecipe');
		  $category_returned=$this->receipesmanagement->getnameofcategory($recipe_obj_from_db->category_id);
		  $data['CategoryNameValue'] = $category_returned->name;
		  
		  $data['KitchenNameLabel'] = $this->lang->line('KitchenOfRecipe');
		  $kitchen_returned=$this->receipesmanagement->getnameofkitchen($recipe_obj_from_db->kitchen_id);
		  $data['KitchenNameValue'] = $kitchen_returned->name;
		  
		  $data['UpArrowImgUrl'] = '/images/rate_plus.png';
		  $data['DownArrowImgUrl'] = '/images/rate_minus.png';
		}
		else //–ецепта с таким id не существует
		redirect('my_recipes', 'refresh');


		return $data;
	}


}
?>