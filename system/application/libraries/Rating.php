<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Rating {

	var $ci;

	function Rating()
	{
		$this->ci =& get_instance();
		$this->ci->load->database();
	}


	function vote($marker, $recipe_id, $loged_user_id, $author_user_id)
	{
		//Регестрируем голос
		$this->ci->db->query("INSERT INTO rating_act_desk (user_id, recipe_id) VALUES($loged_user_id, $recipe_id)");
		
		//Отдаем голос рецепту
		$this->ci->db->query("UPDATE recipes SET rating=rating".$marker."1 WHERE id=$recipe_id");
		
		//Отдаем голос автору руцепта	
		$this->ci->db->query("UPDATE user_data SET rating=rating".$marker."1 WHERE user_id=$author_user_id");
	}
	
	function is_user_voted_before($loged_user_id, $recipe_id)
	{
		$query = $this->ci->db->query("SELECT id FROM rating_act_desk WHERE user_id=$loged_user_id and recipe_id=$recipe_id");
		if($query->num_rows()>0)
		{
			return true;
		}
		else 
			return false;
	}

	function get_recipe_rating($recipe_id)
	{
		//Возвращаем текущий рейтинг рецепта
		$query = $this->ci->db->query("SELECT rating FROM recipes WHERE id=$recipe_id");
		$row = $query->row();
		return $row->rating;
		var_dump($row->rating);
	}
}
?>