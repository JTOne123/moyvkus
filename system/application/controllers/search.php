<?php

class Search extends Controller {
	
	function Search()
	{
		parent::Controller();
		
		$this->load->library('validation');
		$this->load->library('usermanagment');
		$this->load->library('location');
		$this->load->library('receipesmanagement');
		$this->load->library('pagination');
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index()
	{
		$data = $this->_load_headers();
		
		$data = $this->_load_resource($data);
		
		$data = $this->_data_bind($data);
		
		$data['body']= $this->parser->parse('search', $data);
		
		$this->parser->parse('main_tpl', $data);
	}
	
	function _load_headers()
	{
		$data['title'] = $this->lang->line('title').' - '.$this->lang->line('Search');
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
		$data['Search'] = $this->lang->line('Search');
		$data['SearchOption'] = $this->lang->line('SearchOption');
		$data['SearchUsers'] = $this->lang->line('SearchUsers');
		$data['SearchRecipies'] = $this->lang->line('SearchRecipies');
		$data['SimpleSearch'] = $this->lang->line('SimpleSearch');
		$data['SearchButton'] = $this->lang->line('SearchButton');
		$data['SimpleSearchDescriptionUser'] = $this->lang->line('SimpleSearchDescriptionUser');
		$data['AdvancedSearch'] = $this->lang->line('AdvancedSearch');
		$data['NoteSearch'] = $this->lang->line('NoteSearch');
		$data['NoteSearchAnswerUsers'] = $this->lang->line('NoteSearchAnswerUsers');
		$data['FirstName'] = $this->lang->line('FirstName');
		$data['LastName'] = $this->lang->line('LastName');
		$data['Sex'] = $this->lang->line('SexText');
		$data['LocationText'] = $this->lang->line('LoctionText');
		$data['Man'] = $this->lang->line('Man');
		$data['Woman'] = $this->lang->line('Woman');
		$data['Country'] = $this->lang->line('Country');
		$data['Region'] = $this->lang->line('Region');
		$data['Woman'] = $this->lang->line('Woman');
		$data['City'] = $this->lang->line('City');
		$data['NoteSearchAnswerUsers'] = $this->lang->line('NoteSearchAnswerUsers');
		$data['NoteSearchAnswerRecipies'] = $this->lang->line('NoteSearchAnswerRecipies');
		$data['RecipeName'] = $this->lang->line('NameOfRecipe');
		$data['Indigridients'] = $this->lang->line('Indigridients');
		$data['RecipeText'] = $this->lang->line('RecipeText');
		$data['SimpleSearchDescriptionRecipies'] = $this->lang->line('SimpleSearchDescriptionRecipies');
		
		return $data;
	}
	
	function _data_bind($data)
	{
		$country=$this->location->GetCountryNames();
		$nulled=array();
		$data['SelectCountry'] = form_dropdown('SelectCountry',$country,'', "onChange='ajax_locator_country()'");
		$data['SelectRegion'] = form_dropdown('SelectRegion',$nulled,'',"onChange='ajax_locator_region()'");
		$data['SelectCity'] = form_dropdown('SelectCity');
		
		return $data;
	}
	
	function users()
	{
		
	}
	
	function recipes()
	{
		
	}
	
	function search_users_simple($data, $limit_from, $limit_to)
	{
		$query = $this->db->query("SELECT id FROM users WHERE first_name LIKE %$data% OR last_name LIKE %$data% LIMIT $limit_from, $limit_to");
		
		return $query;
	}
	
	function search_users_advanced($first_name, $last_name, $sex, $country, $region, $city, $limit_from, $limit_to)
	{
		$query_string = "";
		
		if($first_name != '')
			$query_string = $query_string . "first_name LIKE %'$first_name'% ";
		
		if($last_name != '')
		{
			$query_string = check_querty_string_empty($query_string);
			
			$query_string = $query_string . "last_name LIKE %'$last_name'% ";
		}
		
		if($sex != '')
		{
			$query_string = check_querty_string_empty($query_string);
			
			$query_string = $query_string . "sex = $sex ";
		}
		
		if($country != '')
		{
			$query_string = check_querty_string_empty($query_string);
			
			$query_string = $query_string . "country = $country ";
		}
		
		if($region != '')
		{
			$query_string = check_querty_string_empty($query_string);
			
			$query_string = $query_string . "region = $region ";
		}
		
		if($city != '')
		{
			$query_string = check_querty_string_empty($query_string);
			
			$query_string = $query_string . "city = $city ";	
		}
		
		$query = null;
		
		if($query_string != '')
		{
			$main_query_string = "SELECT id FROM users WHERE " . $query_string . "LIMIT $limit_from, $limit_to";
			
			$query = $this->db->query($main_query_string);
		}
		
		return $query;
	}
	
	function search_recipes_simple($data, $limit_from, $limit_to)
	{
		$query = $this->db->query("SELECT id FROM recipes WHERE name LIKE %$data% OR ingredients LIKE %$data% LIMIT $limit_from, $limit_to");
		
		return $query;
	}
	
	function search_recipes_advanced($name, $ingredients, $recipe_text, $limit_from, $limit_to)
	{
		$query_string = "";
		
		if($name != '')
			$query_string = $name . "name LIKE %'$name'% ";
		
		if($ingredients != '')
		{
			$query_string = check_querty_string_empty($query_string);
			
			$query_string = $query_string . "ingredients LIKE %'$ingredients'% ";
		}
		
		if($recipe_text != '')
		{
			$query_string = check_querty_string_empty($query_string);
			
			$query_string = $query_string . "recipe_text LIKE %'$recipe_text'% ";
		}
		
		$query = null;
		
		if($query_string != '')
		{
			$main_query_string = "SELECT id, name, user_id, recipe_text, photo_name FROM recipes WHERE " . $query_string . "LIMIT $limit_from, $limit_to";
			
			$query = $this->db->query($main_query_string);
		}
		
		return $query;
	}
	
	function check_querty_string_empty($query_string)
	{
		if($query_string !='')
			$query_string = $query_string . "AND ";
		
		return $query_string;
	}
	
	//Работа с Ajax-загрузчиком городов START
	function ajax_locator_country(){
		
		$countryID=$this->input->post('countryID');
		
		if(isset($countryID))
		{
			$region=$this->location->GetRegions($countryID);
			$data['regions']=$region;
			$this->load->view('locator_drop_down', $data);
		}
	}
	
	function ajax_locator_region(){
		
		$regionID=$this->input->post('regionID');
		
		if(isset($regionID))
		{
			$citys=$this->location->GetCitys($regionID);
			$data['citys']=$citys;
			$this->load->view('locator_drop_down', $data);
		}
		
	}
	//Работа с Ajax-загрузчиком городов END
	
	function show_users($query_users, $data)
	{			
		$users_counts = str_replace("{SearchResultsCount}", $query_users->num_rows(), $this->lang->line('SearchUsersResultsText'));
		
		$data['SearchResultCount'] = $users_counts;
		
		$data['SearchItemsListBuilder'] = $this->users_builder($query_users); 
		
		return $data;
	}
	
	function friends_builder($query)
	{	
		$friend_item = $this->myfriendslib->GetFriendsBuilderHTML();
		
		$friend_item = str_replace("{FullNameText}", $this->lang->line('FirstNameText'), $friend_item);
		$friend_item = str_replace("{FriendRatingLevelText}", $this->lang->line('MyRatingLevelText'), $friend_item);
		$friend_item = str_replace("{FriendBestRecipeText}", $this->lang->line('MyBestRecipesText'), $friend_item);
		$friend_item = str_replace("{SendMessage}", $this->lang->line('SendMessage'), $friend_item);
		$friend_item = str_replace("{FriendFriends}", $this->lang->line('FriendFriends'), $friend_item);
		
		$friends_list = "";
		
		foreach ($query->result() as $row)
		{	
			$friend = $this->usermanagment->GetUser($row->id);
			$friend_data = $this->usermanagment->GetUserData($row->id);
			
			$friend_full_name = $friend->first_name . ' ' . $friend->last_name;
			if(strlen($friend_full_name) > 30)
				$friend_full_name =	substr($friend_full_name, 0, 30) . '...';
			
			$friend_current = str_replace("{FriendFullName}", $friend_full_name, $friend_item);
			$friend_current = str_replace("{FriendUrl}", 'http://' . $_SERVER['HTTP_HOST'] . '/profile/id/' . $row->id, $friend_current);
			$friend_current = str_replace("{FriendFriendsUrl}", 'http://' . $_SERVER['HTTP_HOST'] . '/myfriends/id/' . $row->id, $friend_current);
			$friend_current = str_replace("{SendMessageUrl}", 'http://' . $_SERVER['HTTP_HOST'] . '/send_message/send_to/id/' . $row->id, $friend_current);
			
			if($this->userauthorization->is_logged_in())
			{
				$user_id = $this->userauthorization->get_loged_on_user_id();
				
				if($user_id != $row->id)
					if($this->myfriendslib->IsTheyFriends($user_id, $row->friend_id))
					{
						$friend_current = str_replace("{DeleteFriend}", $this->lang->line('DeleteFriend'), $friend_current);
						$friend_current = str_replace("{DeleteFriendUrl}", 'http://' . $_SERVER['HTTP_HOST'] . '/messagebox/type/delete_friend/friend_id/' . $row->id, $friend_current);
					}
					else
					{
						$friend_current = str_replace("{DeleteFriend}", $this->lang->line('AddToFriends'), $friend_current);
						$friend_current = str_replace("{DeleteFriendUrl}", 'http://' . $_SERVER['HTTP_HOST'] . '/messagebox/type/add_friend/friend_id/' . $row->id, $friend_current);				
					}
				else
				{
					$friend_current = str_replace("{DeleteFriend}", '', $friend_current);
					$friend_current = str_replace("{DeleteFriendUrl}", '', $friend_current);
					$friend_current = str_replace("{DeleteFriendShow}", 'none', $friend_current);				
				}
			}
			else
			{
				$friend_current = str_replace("{DeleteFriend}", '', $friend_current);
				$friend_current = str_replace("{DeleteFriendUrl}", '', $friend_current);
				$friend_current = str_replace("{DeleteFriendShow}", 'none', $friend_current);	
			}
			
			
			if($friend_data->avatar_name != null)
				$avatar_url = '/uploads/user_avatars/'.$friend_data->avatar_name;
			else
				$avatar_url = "../../../images/noavatar.gif";
			
			$friend_current = str_replace("{FriendAvatarUrl}", $avatar_url, $friend_current);
			
			$friends_list = $friends_list . $friend_current;
		}
		
		return $friends_list;
	}
	
	function show_recipes($query_recipes, $data)
	{			
		$recipes_counts = str_replace("{SearchResultsCount}", $query_recipes->num_rows(), $this->lang->line('SearchRecipesResultsText'));
		
		$data['SearchResultCount'] = $recipes_counts;
		
		$data['SearchItemsListBuilder'] = $this->recipes_buider($query_recipes); 
		
		return $data;
	}
	
	function recipes_buider($query)
	{
		$recipe_item = $this->receipesmanagement->recipesbuilder();
		
		foreach ($query->result() as $row)
		{
			$recipe_current = str_replace("{AddToFavorites}", $this->lang->line('AddToFavorites'), $recipe_item);
			$recipe_current = str_replace("{Comments}", $this->lang->line('Comments'), $recipe_current);
			$recipe_current = str_replace("{RecipeName}", $row->name, $recipe_current);
			
			//<wbr> START
			$return_str='';
			$recipe_text_from_db = $row->recipe_text;
			$recipe_text_from_db = substr($recipe_text_from_db, 0,100).'...';
			
			for($i = 0; $i < strlen($recipe_text_from_db); $i++)
				$return_str = $return_str . $recipe_text_from_db[$i] . '<wbr>';
			//<wbr> END
			
			$recipe_current = str_replace("{RecipeText}", $return_str, $recipe_current);
			if($row->photo_name !== '' and $row->photo_name !== NULL)
			{
				$photo_url = '/uploads/recipe_photos/' . $row->photo_name;
			}
			else
			{ 
				$photo_url = '../../../images/nophoto.gif';
			}
			
			$recipe_current = str_replace("{FriendAvatarUrl}", $photo_url, $recipe_current);
			$recipe_current = str_replace("{ViewRecipeUrl}", '/view_recipe/id/' . $row->id, $recipe_current);
			
			$number_of_comments = $this->commentsmanagement->GetNumberOfComments($row->id);
			$recipe_current = str_replace("{number_of_comments}", $number_of_comments, $recipe_current);
			
			if($this->userauthorization->is_logged_in())
			{
				$user_id = $this->userauthorization->get_loged_on_user_id();
				
				if($user_id == $row->user_id)
				{   	
					$recipe_current = str_replace("{ButtonEdit}", $this->receipesmanagement->buttonedit(), $recipe_current);
					$recipe_current = str_replace("{EditRecipe}", $this->lang->line('Edit'), $recipe_current);
					$EditRecipeUrl = '/edit_recipe/id/' . $row->id;
					$recipe_current = str_replace("{EditRecipeUrl}", $EditRecipeUrl, $recipe_current);	
					
					$recipe_current = str_replace("{ButtonFavorites}", '', $recipe_current);
					$recipe_current = str_replace("{AddToFavorites}", '', $recipe_current);
					$recipe_current = str_replace("{AddToFavoritesUrl}", '', $recipe_current);
				}
				else
				{ 
					$recipe_current = str_replace("{ButtonEdit}", '', $recipe_current);
					
					$recipe_current = str_replace("{ButtonFavorites}", $this->receipesmanagement->buttonfavorites(), $recipe_current);
					$recipe_current = str_replace("{AddToFavorites}", $this->lang->line('AddToFavorites'), $recipe_current);
					$AddToFavoritesUrl = '/favorites/add/id/' . $row->id;
					$recipe_current = str_replace("{AddToFavoritesUrl}", $AddToFavoritesUrl, $recipe_current);
				}
			}
			else
			{
				$recipe_current = str_replace("{ButtonEdit}", '', $recipe_current);
				
				$recipe_current = str_replace("{ButtonFavorites}", $this->receipesmanagement->buttonfavorites(), $recipe_current);
				$recipe_current = str_replace("{AddToFavorites}", $this->lang->line('AddToFavorites'), $recipe_current);
				$AddToFavoritesUrl = '/favorites/add/id/' . $row->id;
				$recipe_current = str_replace("{AddToFavoritesUrl}", $AddToFavoritesUrl, $recipe_current);
			}
			
			$recipe_list = $recipe_list . $recipe_current;
		}
		
		return $recipe_list;
	}
}
?>