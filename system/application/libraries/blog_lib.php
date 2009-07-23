<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Blog_lib {

	var $ci;

	function Blog_lib()
	{
		$this->ci =& get_instance();
		$this->ci->load->database();
		$this->ci->load->library('twitter');
	}


	function BlogBuilder()
	{
		return "<div id=\"FriendsItemNotConfirmed\" class=\"FriendsItem\">
				<table cellpadding=\"0\" cellspacing=\"0\" class=\"FriendsItemTable\">
				<tr>
				
				<td valign=\"top\">
				<table>
				<tr>
				<td class=\"LabelTextFriends\">
				<a href=\"{ViewPostUrl}\">{PostTitle}</a>
				</td>
				</tr>
				</table>
				</td>
				
				<td valign=\"top\">
				<table class=\"GetMessageButtonsTable\">
				<tr>
				<td>
				{ButtonEdit}
				</td>
				</tr>
				<tr>
				<td>
				<div class=\"MyRecipeButtonDiv\">
				<a href=\"{ViewRecipeUrl}#comments\" id=\"Comments\" name=\"Comments\">
				<div class=\"Login_submit\">
				{Comments}({number_of_comments})
				</div>
				</a>
				</div>
				</td>
				</tr>
				
				</table>
				</td>
				</tr>
				</table>
				</div>";
	}


	function BlogListBuilder()
	{
		return "<div id=\"FriendsItemNotConfirmed\" class=\"FriendsItem\">
				<table cellpadding=\"0\" cellspacing=\"0\" class=\"FriendsItemTable\">
				<tr>
				
				<td valign=\"top\">
				

				
				</td>
		<a href=\"{ViewPostUrl}\">{PostTitle}</a>
		<p>		
{PostText}
</p>

				
				</td>
				</tr>
				</table>
				</div>";
	}


	function ButtonEdit()
	{
		return  "<div class=\"MyRecipeButtonDiv\">
				<a href=\"{EditPostUrl}\" id=\"EditRecipe\" name=\"EditRecipe\">
				<div class=\"Login_submit\">
				{EditPost}
				</div>
				</a>
				</div>";
	}

	function GetPostsByUserId($user_id, $limit, $offset)
	{
		$this->ci->db->order_by("id", "desc");
		$query = $this->ci->db->get_where('blog', array('user_id' => $user_id), $limit, $offset);
		return $query->result();
	}

	function GetUserIdByPostId($id)
	{
		$query = $this->ci->db->get_where('blog', array('id' => $id));
		$ret = $query->row();
		return $ret->user_id;
	}
	
	function GetPostByPostId($post_id)
	{
		$query = $this->ci->db->get_where('blog', array('id' => $post_id));
		return $query->row();
	}

	function GetPosts($limit, $offset)
	{
		$this->ci->db->order_by('id', 'desc');
		$query = $this->ci->db->get('blog', $limit, $offset);
		return $query->result();
	}

	function GetBlogPostUserId($post_id)
	{
		$query = $this->ci->db->get_where('blog', array('id' => $post_id));
		$ret = $query->row();
		return $ret->user_id;
	}

}
?>