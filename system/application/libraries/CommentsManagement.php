<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Commentsmanagement {

	var $ci;

	function Commentsmanagement()
	{
		$this->ci =& get_instance();
		$this->ci->load->database();
	}


	function SaveComment($text, $recipe_id, $user_id)
	{
		$query = $this->ci->db->query("INSERT INTO comments (text, recipe_id, user_id) VALUES('$text', '$recipe_id', '$user_id')");
		if($query)
		{
			return true;
		}
		else
		return false;
	}

	function GetCensorWords()
	{
		$query = $this->ci->db->query("SELECT word FROM word_censor");

		foreach ($query->result_array() as $row)
		{
			$word[] = $row['word'];
		}

		return $word;
	}
	
	function GetNumberOfComments($id_of_recipe)
	{
		$query = $this->ci->db->query("SELECT id FROM comments WHERE recipe_id=$id_of_recipe");
		return $query->num_rows();
	}

}
?>