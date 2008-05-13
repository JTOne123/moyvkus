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
			$query = $this->ci->db->query("INSERT INTO recipes (name, category_id, kitchen_id, portions, ingredients, recipe_text, user_id, rating) VALUES('$name', '$category_id', '$kitchen_id', '$portions', '$ingredients', '$recipe_text', '$user_id', '$rating')");
		}

		if ($update_or_insert=='update' && $id_of_recipe!=='')
		{
			$query = $this->ci->db->query("UPDATE recipes set name='$name', category_id='$category_id', kitchen_id='$kitchen_id', portions='$portions', ingredients='$ingredients', recipe_text='$recipe_text', user_id='$user_id', rating='$rating' WHERE id='$id_of_recipe'");
		}
	}

	function SavePhoto($id, $photo_name)
	{
		$query = $this->ci->db->query("UPDATE recipes set photo_name='$photo_name' WHERE id=$id");
	}

	function GetDataForEdit($id)
	{
		$query = $this->ci->db->query("SELECT * FROM recipes WHERE id=$id");
		$arr = $query->result_array();
		return $arr;
	}

	function GetBestRecipe()
	{
		$query = $this->ci->db->query("SELECT id, name, rating FROM recipes GROUP BY rating DESC");
		$arr = $query->result_array();
		return $arr;
	}

	function GetUserRecipes($id, $limit_from, $limit_to)
	{
		if($limit_to!==0)
		{
			$query = $this->ci->db->query("SELECT * FROM recipes WHERE user_id='$id' LIMIT $limit_from, $limit_to");
		}
		else
		{
			$query = $this->ci->db->query("SELECT * FROM recipes WHERE user_id='$id'");
		}
		
		return $query->result_array();
	}
}
?>