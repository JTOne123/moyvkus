<?php

class View_recipe extends Controller {
	
	function View_recipe()
	{
		parent::Controller();
		
		$this->load->library('validation');
		$this->load->library('receipesmanagement');
		$this->load->library('commentsmanagement');
		$this->load->library('usermanagment');
		
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
		// Локализация надписей
		
		$data['NameOfRecipe'] = $this->lang->line('NameOfRecipe');
		$data['YourComment'] = $this->lang->line('YourComment');
		$data['SubmitCommentForm'] = $this->lang->line('SubmitCommentForm');
		$data['RecipePhoto'] = $this->lang->line('RecipePhoto');
		$data['MainData'] = $this->lang->line('MainData');
		$data['FullSizePhotoDivTitle'] = $this->lang->line('FullSizePhotoDivTitle');
		
		
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
			//Является ли просмаривающий страницу юзер, автором рецепта START  // TRUE / FALSE
			$is_user_is_author=$this->receipesmanagement->isuserisauthorofrecipe($recipe_id_from_uri, $this->userauthorization->get_loged_on_user_id());
			//Является ли просмаривающий страницу юзер, автором рецепта END
			
			$recipe_obj_from_db=$this->receipesmanagement->getonerecipebyrecipeid($recipe_id_from_uri);
			
			$data['recipe_id'] = $recipe_id_from_uri;
			
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
			
			if ($is_user_is_author == TRUE)
			{
				$data['ButtonEdit'] = $this->receipesmanagement->ButtonEdit();
				$data['EditRecipe'] = $this->lang->line('Edit');
				$data['EditRecipeUrl'] = '/edit_recipe/id/'.$recipe_id_from_uri;
			}
			else 
				$data['ButtonEdit'] = '';
			
			$data['UpArrowImgUrl'] = '/images/rate_plus.png';
			$data['DownArrowImgUrl'] = '/images/rate_minus.png';
			
			
			
			
			//Комментарии START
			$returned_html = $this->commentsmanagement->ViewCommentsBuilder();
			$returned_comments_arr = $this->commentsmanagement->GetComments($recipe_id_from_uri);
			$comment_list = '';
			foreach ($returned_comments_arr as $row):
				
				$text = parse_smileys($row['text'], "/images/smileys/");
				$text = auto_typography($text);
				$comment_current = str_replace("{CommentText}", $text, $returned_html);
				
				$user_info_obj=$this->usermanagment->GetUser($row['user_id']);
				$user_data_info_obj=$this->usermanagment->GetUserData($row['user_id']);
				
				$First_Last_Name = $user_info_obj->first_name.' '.$user_info_obj->last_name;
				$comment_current = str_replace("{AuthorFirstLastName}", $First_Last_Name, $comment_current);
				
				$comment_current = str_replace("{AvatarUrl}", '/uploads/user_avatars/'.$user_data_info_obj->avatar_name, $comment_current);
				
				$comment_current = str_replace("{DateOfPost}", $row['timestamp'], $comment_current);
				
				$comment_current = str_replace("{AuthorProfileUrl}", '/profile/id/'.$row['user_id'], $comment_current);
				
				//Ссылка УДАЛИТЬ КОММЕНТ
				$is_user_is_comment_author=$this->commentsmanagement->IsUserIsCommentAuthor($row['id'],$this->userauthorization->get_loged_on_user_id()); //True / False
				if($is_user_is_comment_author == TRUE)
				{
					$comment_current = str_replace("{DeleteRecipeLink}", '/comments/delete_comment/id/'.$row['id'].'/recipe/'.$recipe_id_from_uri, $comment_current);
					$comment_current = str_replace("{DeleteRecipeLinkText}", $this->lang->line('DeleteRecipeLinkText'), $comment_current);
					
					$comment_current = str_replace("{SendMessageToCommentAuthor}", '', $comment_current);
					$comment_current = str_replace("{SendMessageToCommentAuthorText}", '', $comment_current);
				}
				
				$comment_current = str_replace("{DeleteRecipeLinkText}", '', $comment_current);
				$comment_current = str_replace("{DeleteRecipeLink}", '', $comment_current);
				$comment_current = str_replace("{WriteOn}", $this->lang->line('WriteOn'), $comment_current);
				
				$comment_current = str_replace("{SendMessageToCommentAuthor}", '/send_message/send_to/id/'.$row['user_id'], $comment_current);
				$comment_current = str_replace("{SendMessageToCommentAuthorText}", $this->lang->line('SendMessageToCommentAuthorText'), $comment_current);
				
				
				//Складываем
				$comment_list=$comment_list.$comment_current;
				endforeach;
			$data['CommentsBuilder'] = $comment_list;
			//Комментарии END
			
			
		}
		else //Рецепта с таким id не существует
			redirect('my_recipes', 'refresh');
		
		
		return $data;
	}
	
	
}
?>