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
}
?>