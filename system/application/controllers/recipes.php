<?php

class Recipes extends Controller {

	function Recipes()
	{
		parent::Controller();

		$this->load->library('validation');
		$this->load->library('receipes_management');
		$this->load->library('comments_management');
		$this->load->library('pagination');

		$this->load->helper('form');
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

		$data = $this->_category($data);

		$data = $this->_build__category_list($data);

		$data['body']= $this->parser->parse('recipes', $data);

		$this->parser->parse('main_tpl', $data);
	}

	function _load_headers()
	{
		$data['title'] = $this->lang->line('title').' - '.$this->lang->line('Catalog');
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

		$data['Catalog'] = $this->lang->line('Catalog');
		$data['Search'] = $this->lang->line('Search');

		return $data;
	}

	function _build__category_list($data)
	{
		$returned_arr = $this->receipes_management->GetCategorys();
		$how_mach_elements_in_arr =  count($returned_arr);

		$floor =  floor($how_mach_elements_in_arr/2); //делим без остатка
		$stack='';
		$i=0;
		foreach ($returned_arr as $key => $row):
		$i++; //чтобы получить номер итерации
		$recipes_in_category = $this->receipes_management->GetNumberOfRecipesInCategory($key);
		if($this->receipes_management->IsCategoryIsEmpty($key) !== true)
		{
			$prep_link='<a href="/recipes/category/id/'.$key.'">'.$row.' ('.$recipes_in_category.')'.'</a><br>';
		}
		else
		$prep_link=$row.'<br>';

		$stack=$stack.$prep_link;
		if($i == $floor)
		{
			$data['Categorys_Names_2'] = $stack;
			$stack = '';
		}

		if($i == $how_mach_elements_in_arr)
		{
			$data['Categorys_Names_1'] = $stack;
		}
		endforeach;

		return $data;
	}

	function _category($data)
	{
		$category_id = $this->uri->segment(4);
		$html = $this->receipes_management->RecipesBuilder();
		$RecipesCount = $this->receipes_management->GetNumberOfRecipesInCategory($category_id);

		if($category_id == FALSE)
		{
			$data['RecipesBuilder'] = '';
			$data['paginator'] = '';
		}
		else
		{
			$config['base_url'] = base_url().'/recipes/category/id/'.$category_id.'/page/';
			$config['total_rows'] = $RecipesCount;
			$config['per_page'] = '10';
			$config['uri_segment'] = 6;
			$config['first_link'] = $this->lang->line('Start');
			$config['last_link'] = $this->lang->line('End');
			$this->pagination->initialize($config);
			$data['paginator']=$this->pagination->create_links();
			$cur_page = $this->uri->segment(6);
			//var_dump($cur_page);
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
			
			$get_recipes=$this->receipes_management->GetRecipesByCategoryId($category_id, $from_limit, $to_limit);
			$recipe_list = '';
			if($get_recipes[0]['id']!=='')
			foreach ($get_recipes as $row):
			$recipe_current = str_replace("{AddToFavorites}", $this->lang->line('AddToFavorites'), $html);
			$recipe_current = str_replace("{Comments}", $this->lang->line('Comments'), $recipe_current);
			$recipe_current = str_replace("{RecipeName}", $row['name'], $recipe_current);

			//<wbr> START
			$return_str='';
			$recipe_text_from_db=$row['recipe_text'];
			$recipe_text_from_db=substr($recipe_text_from_db, 0,100).'...';
			for($i = 0; $i < strlen($recipe_text_from_db); $i++)
			$return_str = $return_str.$recipe_text_from_db[$i] . '<wbr>';
			//<wbr> END
			$recipe_current = str_replace("{RecipeText}", $return_str, $recipe_current);

			if($row['photo_name']!=='' and $row['photo_name']!==NULL)
			{
				$photo_url = '/uploads/recipe_photos/'.$row['photo_name'];
			}
			else
			{
				//$photo_url = '../../../images/nophoto.gif';
				$photo_url = base_url().'images/nophoto.gif';
			}
			$recipe_current = str_replace("{FriendAvatarUrl}", $photo_url, $recipe_current);
			$recipe_current = str_replace("{ViewRecipeUrl}", '/view_recipe/id/'.$row['id'], $recipe_current);

			$number_of_comments = $this->comments_management->GetNumberOfComments($row['id']);
			$recipe_current = str_replace("{number_of_comments}", $number_of_comments, $recipe_current);

			$logened_user_id  = $this->user_authorization->get_loged_on_user_id();
			$IsUserIsAuthorOfRecipe = $this->receipes_management->IsUserIsAuthorOfRecipe($row['id'], $logened_user_id);

			if($IsUserIsAuthorOfRecipe == TRUE)
			{
				$recipe_current = str_replace("{ButtonEdit}", $this->receipes_management->buttonedit(), $recipe_current);
				$recipe_current = str_replace("{EditRecipe}", $this->lang->line('Edit'), $recipe_current);
				$EditRecipeUrl = '/edit_recipe/id/'.$row['id'];
				$recipe_current = str_replace("{EditRecipeUrl}", $EditRecipeUrl, $recipe_current);

				$recipe_current = str_replace("{ButtonFavorites}", '', $recipe_current);
				$recipe_current = str_replace("{AddToFavorites}", '', $recipe_current);
				$recipe_current = str_replace("{AddToFavoritesUrl}", '', $recipe_current);
			}
			else
			{
				$recipe_current = str_replace("{ButtonEdit}", '', $recipe_current);

				$recipe_current = str_replace("{ButtonFavorites}", $this->receipes_management->buttonfavorites(), $recipe_current);
				$recipe_current = str_replace("{AddToFavorites}", $this->lang->line('AddToFavorites'), $recipe_current);
				$AddToFavoritesUrl = '/favorites/add/id/'.$row['id'];
				$recipe_current = str_replace("{AddToFavoritesUrl}", $AddToFavoritesUrl, $recipe_current);
			}


			//сборка
			$recipe_list=$recipe_list.$recipe_current;
			endforeach;
			$data['RecipesBuilder']=$recipe_list;
		}

		return $data;

	}


}
?>