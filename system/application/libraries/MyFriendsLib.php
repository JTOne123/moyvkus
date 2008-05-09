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
		if(!$this->IsTheyFriends($user_id, $friend_id) && !$this->IsTheyNotConfirmedFriends($user_id, $friend_id))
			$this->ci->db->query("INSERT INTO myfriends(user_id, friend_id, is_confirmed) VALUES($user_id, $friend_id, 0)");	
	}
	
	/*
	Подтверждение дружбы
	*/
	function ConfirmFriend($user_id, $friend_id)
	{
		$this->ci->db->query("UPDATE myfriends SET is_confirmed = 1 WHERE user_id = $user_id AND friend_id = $friend_id");	
	}
	
	/*
	Проверяем на дружбу
	*/
	function IsTheyFriends($user_id, $friend_id)
	{
		$query = $this->ci->db->query("SELECT count(1) AS c FROM myfriends 
					WHERE (user_id = $user_id AND friend_id = $friend_id AND is_confirmed = 1) 
					OR (user_id = $friend_id AND friend_id = $user_id AND is_confirmed = 1)");
		$row = $query->row();
		
		if($row->c == 0)
			return false;
		else
			return true;
	}
	
	/*
	Проверяем на дружбу
	*/
	function IsTheyNotConfirmedFriends($user_id, $friend_id)
	{
		$query = $this->ci->db->query("SELECT count(1) AS c FROM myfriends 
					WHERE (user_id = $user_id AND friend_id = $friend_id AND is_confirmed = 0) 
					OR (user_id = $friend_id AND friend_id = $user_id AND is_confirmed = 0)");
		$row = $query->row();
		
		if($row->c == 0)
			return false;
		else
			return true;
	}
	
	/*
	Удаляем из спика друзей
	*/
	function DeleteFriend($user_id, $friend_id)
	{
		$this->ci->db->query("DELETE FROM myfriends WHERE user_id = $user_id AND friend_id = $friend_id");
		$this->ci->db->query("DELETE FROM myfriends WHERE user_id = $friend_id AND friend_id = $user_id");
	}
	
	/*
	Получаем список друзей
	*/
	function GetFriends($user_id, $filter)
	{
		if($filter == "")
			$query = $this->ci->db->query("SELECT friend_id FROM myfriends WHERE user_id = $user_id AND is_confirmed = 1
						UNION SELECT user_id AS friend_id FROM myfriends WHERE friend_id = $user_id AND is_confirmed = 1");
		else
			$query = $this->ci->db->query("SELECT friend_id FROM myfriends AS mf LEFT JOIN users as u ON mf.friend_id = u.ID 
						WHERE mf.user_id = $user_id and (u.first_name LIKE '%$filter%' or u.last_name LIKE '%$filter%') AND is_confirmed = 1
						UNION SELECT user_id FROM myfriends AS mf LEFT JOIN users as u ON mf.user_id = u.ID 
						WHERE mf.friend_id = $user_id and (u.first_name LIKE '%$filter%' or u.last_name LIKE '%$filter%') AND is_confirmed = 1");
		
		
		return $query;
	}
	
	/*
	Получаем список новых друзей
	*/
	function GetNewFriends($user_id, $filter)
	{
		if($filter == "")
			$query = $this->ci->db->query("SELECT friend_id FROM myfriends WHERE user_id = $user_id AND is_confirmed = 0
						UNION SELECT user_id AS friend_id FROM myfriends WHERE friend_id = $user_id AND is_confirmed = 0");
		else
			$query = $this->ci->db->query("SELECT friend_id FROM myfriends AS mf LEFT JOIN users as u ON mf.friend_id = u.ID 
						WHERE mf.user_id = $user_id and (u.first_name LIKE '%$filter%' or u.last_name LIKE '%$filter%') AND is_confirmed = 0
						UNION SELECT user_id FROM myfriends AS mf LEFT JOIN users as u ON mf.user_id = u.ID 
						WHERE mf.friend_id = $user_id and (u.first_name LIKE '%$filter%' or u.last_name LIKE '%$filter%') AND is_confirmed = 0");
		
		
		return $query;
	}
	
	function GetFriendsBuilderHTML()
	{
		return "<div id=\"FriendsItem\" class=\"FriendsItem\">
				<table cellpadding=\"0\" cellspacing=\"0\" class=\"FriendsItemTable\">
				<tr>
				<td valign=\"top\" class=\"FriendAvatarTD\">
				<a href=\"{FriendUrl}\">
				<img src=\"{FriendAvatarUrl}\" title=\"{FriendFullName}\" class=\"FriendAvatar\"/></a>
				</td>
				<td valign=\"top\">
				<table>
				<tr>
				<td class=\"LabelTextFriends\">
				{FullNameText}
				</td>
				<td class=\"LableValueFriends\">
				<a href=\"{FriendUrl}\">{FriendFullName}</a>
				</td>
				</tr>
				<tr>
				<td class=\"LabelTextFriends\">
				{FriendRatingLevelText}
				</td>
				<td class=\"LableValueFriends\">
				{FriendRatingLevel}
				</td>
				</tr>
				<tr>
				<td class=\"LabelTextFriends\">
				{FriendBestRecipeText}
				</td>
				<td class=\"LableValueFriends\">
				<a href=\"{FriendBestRecipesUrl}\">{FriendBestRecipe}</a>
				</td>
				</tr>
				</table>
				</td>
				<td valign=\"top\">
				<table class=\"GetMessageButtonsTable\">
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
	
	function GetNotConfirmedFriendsBuilderHTML()
	{
		return "<div id=\"FriendsItemNotConfirmed\" class=\"FriendsItemNotConfirmed\">
				<table cellpadding=\"0\" cellspacing=\"0\" class=\"FriendsItemTable\">
				<tr>
				<td valign=\"top\" class=\"FriendAvatarTD\">
				<a href=\"{FriendUrl}\">
				<img src=\"{FriendAvatarUrl}\" title=\"{FriendFullName}\" class=\"FriendAvatar\"/></a>
				</td>
				<td valign=\"top\">
				<table>
				<tr>
				<td class=\"LabelTextFriends\">
				{FullNameText}
				</td>
				<td class=\"LableValueFriends\">
				<a href=\"{FriendUrl}\">{FriendFullName}</a>
				</td>
				</tr>
				<tr>
				<td class=\"LabelTextFriends\">
				{FriendRatingLevelText}
				</td>
				<td class=\"LableValueFriends\">
				{FriendRatingLevel}
				</td>
				</tr>
				<tr>
				<td class=\"LabelTextFriends\">
				{FriendBestRecipeText}
				</td>
				<td class=\"LableValueFriends\">
				<a href=\"{FriendBestRecipesUrl}\">{FriendBestRecipe}</a>
				</td>
				</tr>
				</table>
				</td>
				<td valign=\"top\">
				<table class=\"GetMessageButtonsTable\">
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
				<a href=\"{ConfirmFriendUrl}\" id=\"ConfirmFriend\" name=\"ConfirmFriend\">
				<div class=\"Login_submit\">
				{ConfirmFriend}
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