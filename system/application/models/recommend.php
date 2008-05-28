<?php

class Recommend extends Model {

	function Recommend()
	{
		parent::Model();
		$this->load->database();
	}

	function Build($user_id_to_view)
	{
		$quantity = 10; 
		$quantity_rec = 2;

		$ids_of_relevant_users = $this->get_ids_of_relevant_users($quantity, $user_id_to_view);
		$html_stack = '';
		foreach ($ids_of_relevant_users as $row):
		$returned_recipes_arr = $this->get_ids_of_relevant_recipes($row->user_id, $quantity_rec, $user_id_to_view);

		foreach ($returned_recipes_arr as $recipe_obj):
		if($this->receipes_management->IsExistRecipeId($recipe_obj->recipe_id))
		{
		$html_stack =  $html_stack.$this->GetHtml($recipe_obj->recipe_id);
		}
		endforeach;

		endforeach;

		return $html_stack;
	}

	//передаем хтмл для одного рецепта
	function GetHtml($recipe_id)
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

	//получаем id юзеров, с похожими вкусами - т.е. тех, кто голосал за те же рецепты, что и Я(логиненый юзер)
	function get_ids_of_relevant_users($quantity, $user_id_to_view)
	{
		$query = $this->db->query("select user_id from rating_act_desk where recipe_id in (select recipe_id from rating_act_desk where user_id=$user_id_to_view) and user_id<>$user_id_to_view group by user_id order by count(recipe_id) desc limit $quantity");
		return $row = $query->result();
	}
	//получаем id рецептов по релевантному юзеру
	function get_ids_of_relevant_recipes($user_id, $quantity, $user_id_to_view)
	{
		$query = $this->db->query("SELECT recipe_id FROM rating_act_desk WHERE recipe_id not in (select recipe_id from rating_act_desk where user_id=$user_id_to_view) and user_id=$user_id limit $quantity");
		return $row = $query->result();
	}
}
?>