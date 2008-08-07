<?php

class My_recipes extends Controller {
	
	function My_recipes()
	{
		parent::Controller();
		
		$this->load->library('validation');
		$this->load->library('receipes_management');
		$this->load->library('comments_management');
		$this->load->library('user_managment');
		$this->load->library('pagination');
		
		$this->load->helper('form');
		$this->load->helper('typography');
		$this->load->helper('text');
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
		
		$data['body']= $this->parser->parse('my_recipes', $data);
		
		$this->parser->parse('main_tpl', $data);
	}
	
	function _load_headers()
	{
		$data['title'] = $this->lang->line('title').' - '.$this->lang->line('MyRecipes');
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
		
		$data['MyRecipes'] = $this->lang->line('MyRecipes');
		$data['RecipesFilter'] = $this->lang->line('RecipesFilter');
		$data['Search'] = $this->lang->line('Search');
		
		return $data;
	}
	
	function _data_bind($data)
	{
		$user_id_from_uri = $this->uri->segment(3); //23
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
					redirect('my_recipes', 'refresh'); 
			}
		}
		
		$RecipesCount = $this->receipes_management->recipecount($user_id_to_view);
		if($user_id_to_view==$this->user_authorization->get_loged_on_user_id())
		{
			$data['RecipesCount'] = $this->lang->line('YouHave').' '.$RecipesCount.' '.$this->lang->line('Recipes');
		}
		else
			$data['RecipesCount'] = $this->lang->line('Total').' '.$RecipesCount.' '.$this->lang->line('Recipes');
		
		$recipe_list='';
		$recipe_item = $this->receipes_management->recipesbuilder();
		
		$config['base_url'] = base_url().'/my_recipes/id/'.$user_id_to_view.'/view/page/';
		$config['total_rows'] = $RecipesCount;
		$config['per_page'] = '10';
		$config['uri_segment'] = 6;
		$config['first_link'] = 'Начало';
		$config['last_link'] = 'Конец';
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
		
		$get_user_recipes=$this->receipes_management->GetUserRecipes($user_id_to_view, $from_limit,$to_limit);
		if($get_user_recipes[0]['id']!=='')
			foreach ($get_user_recipes as $row):
				
				$recipe_current = str_replace("{AddToFavorites}", $this->lang->line('AddToFavorites'), $recipe_item);
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
					$photo_url = base_url().'uploads/recipe_photos/'.$row['photo_name'];
				}
				else
				{ 
					$photo_url = base_url().'images/nophoto.gif';
				}
				
				$recipe_current = str_replace("{FriendAvatarUrl}", $photo_url, $recipe_current);
				$recipe_current = str_replace("{ViewRecipeUrl}", '/view_recipe/id/'.$row['id'], $recipe_current);
				
				$number_of_comments = $this->comments_management->GetNumberOfComments($row['id']);
				$recipe_current = str_replace("{number_of_comments}", $number_of_comments, $recipe_current);
				
				if($user_id_to_view==$this->user_authorization->get_loged_on_user_id())
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
				
				
				$recipe_list=$recipe_list.$recipe_current;
				endforeach;
		
		$user_data = $this->user_managment->getuser($user_id_to_view);
		$data['NameOfAuthor'] = $user_data->first_name.' '.$user_data->last_name;
		
		$data['RecipesBuilder']=$recipe_list;
		return $data;
	}
	
}
?>