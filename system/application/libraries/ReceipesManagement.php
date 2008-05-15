<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Receipesmanagement {

	var $ci;

	function Receipesmanagement()
	{
		$this->ci =& get_instance();
		$this->ci->load->database();
	}


	function GetCategorys()
	{
		$query = $this->ci->db->query("SELECT id, name FROM categorys");
		foreach ($query->result_array() as $row)
		{
			$rows[$row['id']]=$row['name'];
		}
		return $rows;
	}

	function GetKitchens()
	{
		$query = $this->ci->db->query("SELECT id, name FROM kitchens");
		foreach ($query->result_array() as $row)
		{
			$rows[$row['id']]=$row['name'];
		}
		return $rows;
	}

	function SaveReceipe($name, $category_id, $kitchen_id, $portions, $ingredients, $recipe_text, $photo_name, $user_id, $rating, $update_or_insert, $id_of_recipe)
	{
		if($update_or_insert=='insert')
		{
			$query = $this->ci->db->query("INSERT INTO recipes (name, category_id, kitchen_id, portions, ingredients, recipe_text, user_id, timestamp) VALUES('$name', '$category_id', '$kitchen_id', '$portions', '$ingredients', '$recipe_text', '$user_id', null)");
		}

		if ($update_or_insert=='update' && $id_of_recipe!=='')
		{
			$query = $this->ci->db->query("UPDATE recipes set name='$name', category_id='$category_id', kitchen_id='$kitchen_id', portions='$portions', ingredients='$ingredients', recipe_text='$recipe_text', user_id='$user_id', timestamp=null WHERE id='$id_of_recipe'");
		}
	}

	function SavePhoto($id, $photo_name, $timestamp)
	{
		$query = $this->ci->db->query("UPDATE recipes set photo_name='$photo_name', timestamp='$timestamp' WHERE id=$id");
	}

	function GetDataForEdit($id)
	{
		$query = $this->ci->db->query("SELECT * FROM recipes WHERE id=$id");
		$arr = $query->result_array();
		return $arr;
	}

	function GetBestRecipe($id)
	{
		$query = $this->ci->db->query("SELECT id, name, rating FROM recipes WHERE user_id='$id' GROUP BY rating DESC");
		$arr = $query->result_array();
		if ($query->num_rows() > 0)
		{
			return $arr;
		}
		else
		return array(array(''=>'', 'name'=>''));
	}

	function GetUserRecipes($id, $limit_from, $limit_to)
	{
		if($limit_to!==0)
		{
			$query = $this->ci->db->query("SELECT * FROM recipes WHERE user_id='$id' GROUP BY timestamp DESC LIMIT $limit_from, $limit_to");
		}
		if($limit_to==0)
		{
			$query = $this->ci->db->query("SELECT * FROM recipes WHERE user_id='$id' GROUP BY timestamp DESC");
		}

		if ($query->num_rows() > 0)
		{
			return $query->result_array();
		}
		else
		return array(array('id'=>'', 'name'=>''));
	}


	function RecipeCount($user_id)
	{
		$query = $this->ci->db->query("SELECT id FROM recipes WHERE user_id='$user_id'");

		return $query->num_rows();
	}

	function RecipesBuilder()
	{
		return "<div id=\"FriendsItemNotConfirmed\" class=\"FriendsItem\">
				<table cellpadding=\"0\" cellspacing=\"0\" class=\"FriendsItemTable\">
				<tr>
				<td valign=\"top\" class=\"FriendAvatarTD\">
				<a href=\"{ViewRecipeUrl}\">
				<img src=\"{FriendAvatarUrl}\" title=\"{RecipeName}\" class=\"FriendAvatar\"/></a>
				</td>
				<td valign=\"top\">
				<table>
				<tr>
				<td class=\"LabelTextFriends\">
				<a href=\"{ViewRecipeUrl}\">{RecipeName}</a>
				</td>
				</tr>
				
				<tr>
				<td class=\"LabelTextFriends\">
				{RecipeText}
				</td>
				</tr>

				
				</table>
				</td>
				
				<td valign=\"top\">
				<table class=\"GetMessageButtonsTable\">
				
				{ButtonEdit}
				{ButtonFavorites}
				
				<tr>
				<td>
				<a href=\"{AddToFavoritesUrl}\" id=\"Comments\" name=\"Comments\">
				<div class=\"Login_submit\">
				{Comments}(0)
				</div>
				</a>
				</td>
				</tr>
				
				</table>
				</td>
				</tr>
				</table>
				</div>";
	}

	function ButtonEdit()
	{
		return  "
	    		<tr>
				<td>
				<a href=\"{EditRecipeUrl}\" id=\"EditRecipe\" name=\"EditRecipe\">
				<div class=\"Login_submit\">
				{EditRecipe}
				</div>
				</a>
				</td>
				</tr>";
	}

	function ButtonFavorites()
	{
		return "
				<tr>
				<td>
				<a href=\"{AddToFavoritesUrl}\" id=\"AddToFavorites\" name=\"AddToFavorites\">
				<div class=\"Login_submit\">
				{AddToFavorites}
				</div>
				</a>
				</td>
				</tr>";


	}
  
	function GetRecipeById($user_id)
	{
		$query = $this->ci->db->query("SELECT * FROM recipes WHERE user_id='$user_id'");
		return $query->result_array();
	}
	
	function GetOneRecipeByRecipeId($recipe_id)
	{
		$query = $this->ci->db->query("SELECT * FROM recipes WHERE id='$recipe_id'");
		return $query->row();
	}
	
	function IsExistRecipeId($id_of_recipe)
	{
		$query = $this->ci->db->query("SELECT name FROM recipes WHERE id='$id_of_recipe'");
		if($query->num_rows()!==0)
		{
			return TRUE;
		}
		else 
			return FALSE;
	}
	
	function IsUserIsAuthorOfRecipe($id_of_recipe, $logened_user_id)
	{
		$query = $this->ci->db->query("SELECT user_id FROM recipes WHERE id='$id_of_recipe'");
		$row = $query->row();
		if($row->user_id==$logened_user_id)
		{
			return true;
		}
		else 
			return false;
	}
	
	function GetNameOfCategory($category_id)
	{
		$query = $this->ci->db->query("SELECT name FROM categorys WHERE id='$category_id'");
		return $query->row();
	}
	
		function GetNameOfKitchen($kitchen_id)
	{
		$query = $this->ci->db->query("SELECT name FROM kitchens WHERE id='$kitchen_id'");
		return $query->row();
	}
	
}
?>