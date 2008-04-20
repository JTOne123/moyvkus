<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class MyFriendsLib {
	
	var $ci;
	
	function MyFriendsLib()
	{
		$this->ci =& get_instance();
		$this->ci->load->database();
	}
	
	
	/*
	Добавляем друга
	*/
	function AddFriend($user_id, $friend_id)
	{
		$query = $this->ci->db->query("INSERT INTO myfriends(user_id, friend_id) VALUES($user_id, $friend_id)");	
	}
	
	/*
	Проверяем на дружбу
	*/
	function IsTheyFriends($user_id, $friend_id)
	{
		$query = $this->ci->db->query("SELECT count(1) FROM myfriends 
					WHERE user_id = $user_id AND friend_id = $friend_id 
					OR user_id = $friend_id AND friend_id = $user_id");
		$row = $query->row();
		
		if($row == 0)
			return false;
		else
			return true;
	}
	
	/*
	Удаляем из спика друзей
	*/
	function DeleteFriend($user_id, $friend_id)
	{
		$query = $this->ci->db->query("DELETE FROM myfriends WHERE user_id = $user_id AND friend_id = $friend_id");
		$query = $this->ci->db->query("DELETE FROM myfriends WHERE user_id = $friend_id AND friend_id = $user_id");
	}
	
	/*
	Получаем список друзей
	*/
	function GetFriends($user_id, $filter)
	{
		if($filter == "")
			$query = $this->ci->db->query("SELECT friend_id FROM myfriends WHERE user_id = $user_id 
						UNION SELECT user_id AS friend_id FROM myfriends WHERE friend_id = $user_id");
		else
			$query = $this->ci->db->query("SELECT friend_id FROM myfriends AS mf LEFT JOIN users as u ON mf.friend_id = u.ID 
						WHERE mf.user_id = $user_id and (u.first_name LIKE '%$filter%' or u.last_name LIKE '%$filter%')
						UNION SELECT user_id FROM myfriends AS mf LEFT JOIN users as u ON mf.user_id = u.ID 
						WHERE mf.friend_id = $user_id and (u.first_name LIKE '%$filter%' or u.last_name LIKE '%$filter%')");
		
		
		return $query;
	}
	
	function GetFriendsBuilderHTML()
	{
		return "<div id=\"FriendsItem\" class=\"FriendsItem\">
				<table cellpadding=\"0\" cellspacing=\"0\" class=\"FriendsItemTable\">
				<tr>
				<td valign=\"top\">
				<a href=\"{FriendUrl}\">
				<img src=\"{FriendAvatarUrl}\" title=\"{FriendFullName}\" class=\"FriendAvatar\"/></a>
				</td>
				<td valign=\"top\">
				<table>
				<tr>
				<td class=\"LabelText\">
				{FullNameText}
				</td>
				<td class=\"LableValue\">
				<a href=\"{FriendUrl}\">{FriendFullName}</a>
				</td>
				</tr>
				<tr>
				<td class=\"LabelText\">
				{FriendRatingLevelText}
				</td>
				<td class=\"LableValue\">
				{FriendRatingLevel}
				</td>
				</tr>
				<tr>
				<td class=\"LabelText\">
				{FriendBestRecipeText}
				</td>
				<td class=\"LableValue\">
				<a href=\"{FriendBestRecipesUrl}\">{FriendBestRecipe}</a>
				</td>
				</tr>
				</table>
				</td>
				<td valign=\"top\">
				<table>
				<tr>
				<td>
				<a href=\"{SendMessageUrl}\" id=\"SendMessage\" name=\"SendMessage\">
				<div class=\"Login_submit\">
				{SendMessage}
				</div>
				</a>
				</td>
				</tr>
				<tr>
				<td>
				<a href=\"{FriendFriendsUrl}\" id=\"FriendFriends\" name=\"FriendFriends\">
				<div class=\"Login_submit\">
				{FriendFriends}
				</div>
				</a>
				</td>
				</tr>
				<tr>
				<td>
				<a href=\"{DeleteFriendUrl}\" id=\"DeleteFriend\" name=\"DeleteFriend\">
				<div class=\"Login_submit\">
				{DeleteFriend}
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
}
?>