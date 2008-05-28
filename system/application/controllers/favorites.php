<?php

class Favorites extends Controller {

	function Favorites()
	{
		parent::Controller();

		$this->load->library('receipes_management');
		$this->load->library('comments_management');
		$this->load->library('user_managment');
		$this->load->library('favorites_management');
		$this->load->library('pagination');

		$this->load->helper('form');
		$this->load->helper('typography');
		$this->load->helper('date');
		$this->load->helper('smiley');
	}

	function _remap($method) {
		//страницы, доступные без авторизации
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
		$data = $this->_load_headers();

		$data = $this->_load_resource($data);

		$data = $this->_data_bind($data);

		$data['body']= $this->parser->parse('favorites', $data);

		$this->parser->parse('main_tpl', $data);
	}

	function _load_headers()
	{
		$data['title'] = $this->lang->line('title').' - '.$this->lang->line('Favorites');
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
		// Локализация надписей

		$data['NameOfRecipe'] = $this->lang->line('NameOfRecipe');
		$data['YourComment'] = $this->lang->line('YourComment');
		$data['SubmitCommentForm'] = $this->lang->line('SubmitCommentForm');
		$data['RecipePhoto'] = $this->lang->line('RecipePhoto');
		$data['MainData'] = $this->lang->line('MainData');
		$data['FullSizePhotoDivTitle'] = $this->lang->line('FullSizePhotoDivTitle');
		$data['errorDivComment'] = $this->lang->line('errorDivComment');
		$data['RecipesFilter'] = $this->lang->line('RecipesFilter');
		$data['Search'] = $this->lang->line('Search');
		$data['Favorites'] = $this->lang->line('Favorites');


		return $data;
	}


	function _data_bind($data)
	{
		$user_id_from_uri = $this->uri->segment(3);
		$user_id = $this->user_authorization->get_loged_on_user_id(); //22

		if($user_id_from_uri == false)
		$user_id_from_uri = $user_id;

		$user_id_to_view = $user_id;
		if($user_id_from_uri != $user_id_to_view)
		{
			if($this->user_managment->IsUserExists_by_id($user_id_from_uri) === true)
			{
				$user_id_to_view = $user_id_from_uri;
			}
			else
			{
				if(is_numeric($user_id_from_uri))
				redirect('favorites', 'refresh');
			}
		}

		$user_data = $this->user_managment->getuser($user_id_to_view);

		$config['base_url'] = base_url().'/favorites/view/page/';
		$config['total_rows'] = $this->favorites_management->RecipeCount($user_id_to_view);
		$config['per_page'] = '10';
		$config['uri_segment'] = 4;
		$config['first_link'] = 'Начало';
		$config['last_link'] = 'Конец';
		$this->pagination->initialize($config);
		$data['paginator']=$this->pagination->create_links();
		$cur_page = $this->uri->segment(4);


		$recipe_item = $this->favorites_management->RecipesBuilder();
		$returned_ids = $this->favorites_management->GetRecipesIDs($user_id_to_view);

		if($cur_page==null)
		{
			$from_limit=0;
			$to_limit=$config['per_page'];

		}
		else
		{
			$from_limit=$cur_page;
			$to_limit=$config['per_page'];
		}

		$returned_ids = array_slice($returned_ids, $from_limit,$to_limit);

		$recipe_list = '';
		foreach ($returned_ids as $returned_item):
		$returned_recipe = $this->receipes_management->GetOneRecipeByRecipeId($returned_item->recipe_id);

		$recipe_current = str_replace("{RecipeName}", $returned_recipe->name, $recipe_item);

		$recipe_text_from_db=$returned_recipe->recipe_text;
		$recipe_text_from_db=substr($recipe_text_from_db, 0,100).'...';
		$return_str = '';
		for($i = 0; $i < strlen($recipe_text_from_db); $i++)
		$return_str = $return_str.$recipe_text_from_db[$i] . '<wbr>';
		$recipe_current = str_replace("{RecipeText}", $return_str, $recipe_current);

		if($returned_recipe->photo_name !=='' and $returned_recipe->photo_name !== NULL)
		{
			$photo_url = '/uploads/recipe_photos/'.$returned_recipe->photo_name;
		}
		else
		{
			$photo_url = '../../../images/nophoto.gif';
		}

		$recipe_current = str_replace("{FriendAvatarUrl}", $photo_url, $recipe_current);
		$recipe_current = str_replace("{ViewRecipeUrl}", '/view_recipe/id/'.$returned_recipe->id, $recipe_current);

		$number_of_comments = $this->comments_management->GetNumberOfComments($returned_recipe->id);
		$recipe_current = str_replace("{number_of_comments}", $number_of_comments, $recipe_current);
		$recipe_current = str_replace("{Comments}", $this->lang->line('Comments'), $recipe_current);

		if($returned_recipe->id == $this->user_authorization->get_loged_on_user_id()) //просматривает хозяин
		{
			$recipe_current = str_replace("{ButtonEdit}", $this->receipes_management->buttonedit(), $recipe_current);
			$recipe_current = str_replace("{EditRecipe}", $this->lang->line('Edit'), $recipe_current);
			$EditRecipeUrl = '/edit_recipe/id/'.$returned_recipe->id;
			$recipe_current = str_replace("{EditRecipeUrl}", $EditRecipeUrl, $recipe_current);

			$recipe_current = str_replace("{ButtonFavorites}", '', $recipe_current);
			$recipe_current = str_replace("{AddToFavorites}", '', $recipe_current);
			$recipe_current = str_replace("{AddToFavoritesUrl}", '', $recipe_current);
		}
		else //просматривает НЕ хозяин рецепта
		{
			$logened_user_id = $this->user_authorization->get_loged_on_user_id();
			if($this->favorites_management->IsExist($returned_recipe->id, $logened_user_id) == FALSE and $this->receipes_management->IsUserIsAuthorOfRecipe($returned_recipe->id, $logened_user_id) == FALSE)
			{
				$recipe_current = str_replace("{ButtonFavorites}", $this->receipes_management->buttonfavorites(), $recipe_current);
				$recipe_current = str_replace("{AddToFavorites}", $this->lang->line('AddToFavorites'), $recipe_current);
				$AddToFavoritesUrl = '/favorites/add/id/'.$returned_recipe->id;
				$recipe_current = str_replace("{AddToFavoritesUrl}", $AddToFavoritesUrl, $recipe_current);
			}

			$recipe_current = str_replace("{ButtonFavorites}", '', $recipe_current);
			$recipe_current = str_replace("{AddToFavorites}", '', $recipe_current);
			$recipe_current = str_replace("{AddToFavoritesUrl}", '', $recipe_current);

			if($this->receipes_management->IsUserIsAuthorOfRecipe($returned_recipe->id, $logened_user_id) == TRUE)
			{
				$recipe_current = str_replace("{ButtonEdit}", $this->receipes_management->buttonedit(), $recipe_current);
				$recipe_current = str_replace("{EditRecipe}", $this->lang->line('Edit'), $recipe_current);
				$EditRecipeUrl = '/edit_recipe/id/'.$returned_recipe->id;
				$recipe_current = str_replace("{EditRecipeUrl}", $EditRecipeUrl, $recipe_current);
			}

			$recipe_current = str_replace("{ButtonEdit}", '', $recipe_current);
			$recipe_current = str_replace("{EditRecipe}", '', $recipe_current);
			$recipe_current = str_replace("{EditRecipeUrl}", '', $recipe_current);
		}

		if($logened_user_id == $user_id_from_uri) //Если это хозяин странички
		{
			$recipe_current = str_replace("{ButtonDelete}", $this->favorites_management->ButtonDelete(), $recipe_current);
			$recipe_current = str_replace("{Delete}", $this->lang->line('Delete'), $recipe_current);
			$DeleteRecipeUrl = '/favorites/delete/id/'.$returned_recipe->id;
			$recipe_current = str_replace("{DeleteUrl}", $DeleteRecipeUrl, $recipe_current);
		}
		else 
		{
			$recipe_current = str_replace("{ButtonDelete}", '', $recipe_current);
			$recipe_current = str_replace("{Delete}", '', $recipe_current);
			$recipe_current = str_replace("{DeleteUrl}", '', $recipe_current);
		}

		$recipe_list=$recipe_list.$recipe_current;
		endforeach;

		$data['RecipesBuilder'] = $recipe_list;
		$data['NameOfAuthor'] = $user_data->first_name.' '.$user_data->last_name;
		$data['RecipesCount'] = $this->lang->line('Total').' '.$this->favorites_management->RecipeCount($user_id_to_view).' '.$this->lang->line('Recipes');


		return $data;
	}

	//Добавление в избранное
	function add()
	{
		$recipe_id_from_uri = $this->uri->segment(4);
		$loged_on_user = $this->user_authorization->get_loged_on_user_id();
		$is_user_is_author = $this->receipes_management->IsUserIsAuthorOfRecipe($recipe_id_from_uri, $loged_on_user);
		$is_exist = $this->favorites_management->IsExist($recipe_id_from_uri, $loged_on_user);
		if($is_user_is_author !== TRUE and $is_exist !==TRUE)
		{
			$this->favorites_management->Add($recipe_id_from_uri, $loged_on_user);
			redirect('favorites', 'refresh');
		}
		else
		redirect('favorites', 'refresh');
	}

	function delete()
	{
		$recipe_id_from_uri = $this->uri->segment(4);
		$loged_on_user = $this->user_authorization->get_loged_on_user_id();
		$is_exist = $this->favorites_management->IsExist($recipe_id_from_uri, $loged_on_user);

		if($is_exist == TRUE and $this->favorites_management->IsUserHaveRecipeInFavorites($loged_on_user, $recipe_id_from_uri) == TRUE)
		{
			$this->favorites_management->Delete($recipe_id_from_uri, $loged_on_user);
			redirect('favorites', 'refresh');
		}
		else
		redirect('favorites', 'refresh');
	}


}
?>