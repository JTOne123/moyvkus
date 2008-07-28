<?php


class Best_recipes extends Model {
	
	function Best_recipes()
	{
		parent::Model();
		$this->load->database();
		$this->load->library('receipes_management');
	}
	
	function build_best_recipes()
	{
		$html_stack='';
		$layot['password'] = $this->lang->line('password');
	    //$layot = $this->load_resource($layot);
		
	    $best_rated_recipes = $this->best_rated_recipes();
	    //var_dump($best_rated_recipes->);
	    foreach ($best_rated_recipes as $row):
		
		$html_stack =  $html_stack.$this->GetHtml($row->id);
	    
	    endforeach;
	    
		return $html_stack;
	}
	
	function GetHTML($recipe_id)
	{

	    $returned_obj = $this->receipes_management->GetOneRecipeByRecipeId($recipe_id);

		//<wbr> START
		$return_str='';
		$recipe_text_from_db=$returned_obj->recipe_text;
		$recipe_text_from_db=substr($recipe_text_from_db, 0,100).'...';
		for($i = 0; $i < strlen($recipe_text_from_db); $i++)
		$return_str = $return_str.$recipe_text_from_db[$i] . '<wbr>';
		//<wbr> END
		$RecipeText = $return_str;

		if($returned_obj->photo_name!=='' and $returned_obj->photo_name!==NULL)
		{
			$photo_url = '/uploads/recipe_photos/'.$returned_obj->photo_name;
		}
		else
		{
			//$photo_url = '../../../images/nophoto.gif';
			$photo_url = base_url().'images/nophoto.gif';
		}

		$ViewRecipeUrl = '/view_recipe/id/'.$returned_obj->id;
		
		$RecipeName = $returned_obj->name;
		return "
        <div id=\"FriendsItemNotConfirmed\" class=\"FriendsItem\">
				<table cellpadding=\"0\" cellspacing=\"0\" class=\"FriendsItemTable\">
				<tr>
				<td valign=\"top\" class=\"FriendAvatarTD\">
				<a href=\"$ViewRecipeUrl\">
				<img src=\"$photo_url\" title=\"$RecipeName\" class=\"FriendAvatar\"/></a>
				</td>
				<td valign=\"top\">
				<table>
				<tr>
				<td class=\"LabelTextFriends\">
				<a href=\"$ViewRecipeUrl\">$RecipeName</a>
				</td>
				</tr>
				
				<tr>
				<td class=\"LabelTextFriends\">
				$RecipeText
				</td>
				</tr>

				
				</table>
				</td>
				
				</tr>
				</table>
				</div>";
	}
	
	function best_rated_recipes()
	{
		$query = $this->db->query("SELECT * FROM recipes ORDER BY rating DESC limit 7");
		return $row = $query->result();
	}
	
}
?>