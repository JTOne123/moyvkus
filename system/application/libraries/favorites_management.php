<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Favorites_management {

	var $ci;

	function Favorites_management()
	{
		$this->ci =& get_instance();
		$this->ci->load->database();
	}


	function RecipeCount($who_add_user_id)
	{
		$query = $this->ci->db->query("SELECT id FROM favorites WHERE who_add_user_id='$who_add_user_id'");

		return $query->num_rows();
	}
	
	function Add($recipe_id, $who_add_user_id)
	{
		$this->ci->db->query("INSERT INTO favorites (recipe_id, who_add_user_id) VALUES('$recipe_id', '$who_add_user_id')");
	}
	
	function Delete($recipe_id, $who_add_user_id)
	{
		$this->ci->db->query("DELETE FROM favorites WHERE recipe_id='$recipe_id' and who_add_user_id='$who_add_user_id'");
	}
	
	function IsUserHaveRecipeInFavorites($user_id, $recipe_id)
	{
		$query = $this->ci->db->query("SELECT id FROM favorites WHERE who_add_user_id='$user_id' and recipe_id=$recipe_id");
		
		if($query->num_rows()!==0)
		{
			return true;
		}
		else 
		return false;
	}

	function IsExist($recipe_id, $who_add_user_id)
	{
		$query = $this->ci->db->query("SELECT id FROM favorites WHERE who_add_user_id='$who_add_user_id' and recipe_id=$recipe_id");
		
		if($query->num_rows() !== 0)
		{
			return TRUE;
		}
		else 
		return FALSE;
	}
	
	function GetRecipesIDs($who_add_user_id)
	{
		$query = $this->ci->db->query("SELECT recipe_id FROM favorites WHERE who_add_user_id='$who_add_user_id'");
		return $query->result();
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
				{ButtonDelete}
				
				<tr>
				<td>
				<a href=\"{ViewRecipeUrl}#comments\" id=\"Comments\" name=\"Comments\">
				<div class=\"Login_submit\">
				{Comments}({number_of_comments})
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
	
		function ButtonDelete()
	{
		return "
				<tr>
				<td>
				<a href=\"{DeleteUrl}\" id=\"Delete\" name=\"Delete\">
				<div class=\"Login_submit\">
				{Delete}
				</div>
				</a>
				</td>
				</tr>";
	}
	
}
?>