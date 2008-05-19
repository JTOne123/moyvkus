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

	function GetComments($id_of_recipe)
	{
		$query = $this->ci->db->query("SELECT * FROM comments WHERE recipe_id=$id_of_recipe ORDER BY id DESC");
		return $query->result_array();
	}

	function IsUserIsCommentAuthor($comment_id, $logened_user_id)
	{
		$query = $this->ci->db->query("SELECT user_id FROM comments WHERE id=$comment_id");
		$row = $query->row();

		if($row->user_id===$logened_user_id)
		{
			return true;
		}
		else
		return false;
	}
	
	function DeleteComment($id_of_comment)
	{
		$this->ci->db->query("DELETE FROM comments WHERE id=$id_of_comment");
	}

	function ViewCommentsBuilder()
	{
		return "<div id=\"FriendsItemNotConfirmed\" class=\"FriendsItem\">
				<table cellpadding=\"0\" cellspacing=\"0\" class=\"FriendsItemTable\">
				<tr>
				<td valign=\"top\" class=\"FriendAvatarTD\">
				<a href=\"{AuthorProfileUrl}\">
				<img src=\"{AvatarUrl}\" title=\"{AuthorFirstLastName}\" class=\"FriendAvatar\"/>
				</a>
				</td>
				<td valign=\"top\">
				<table>
				<tr>
				<td class=\"LabelTextFriends\">
				<a href=\"{AuthorProfileUrl}\">
				<b>{AuthorFirstLastName}</b>
				</a>
				{WriteOn}
				{DateOfPost}
				</td>
				</tr>
				
				<tr>
				<td class=\"LabelTextFriends\">
				{CommentText}
				<br>
				<a href=\"{DeleteRecipeLink}\">{DeleteRecipeLinkText}</a>
				<a href=\"{SendMessageToCommentAuthor}\">{SendMessageToCommentAuthorText}</a>
				</td>
				</tr>
				
				</table>
				</td>
				
				
				</tr>
				</table>
				</div>";
	}

}
?>