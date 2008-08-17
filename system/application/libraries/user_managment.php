<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class User_managment {
	
	var $ci;
	
	function User_managment()
	{
		$this->ci =& get_instance();
		$this->ci->load->database();
		$this->ci->load->helper('string');
	}
	
	
	
	function AddUser($email, $first_name, $last_name, $password)
	{
		$password=md5($password.'secret_message'); //md5 кодирует строку с паролем 
		$query = $this->ci->db->query("INSERT INTO users(email, first_name, last_name, password) VALUES('$email', '$first_name', '$last_name', '$password')");
		
		$UserID = $this->GetUserInfoByEmail($email)->id;
		
		$query = $this->ci->db->query("INSERT INTO user_data(user_id) VALUES('$UserID')");
		
		return $UserID;
	}
	
	/*
	Проверка существует ли юзер
	*/
	function IsUserExits($email)
	{	
		$query = $this->ci->db->query("SELECT id FROM users WHERE email = '$email'");
		
		if($query->num_rows()==0)
			return false;
		else 
			return true;
	}
	
	function IsUserExists_by_id($id)
	{	
		$query = $this->ci->db->query("SELECT id FROM users WHERE id = '$id'");
		
		if($query->num_rows()==0)
			return false;
		else 
			return true;
	}
	
	
	/*
	Проверка валидности пароля по email
	*/
	function IsPasswordValid($email, $password)
	{
		$query = $this->ci->db->query("SELECT password FROM users WHERE email='$email'");
		
		$row = $query->row();
		
		$password=md5($password.'secret_message');
		
		if($password==$row->password)
		{
			return true;
		}
		else 
			return false;
	}
	
	/*
	Проверка валидности пароля по email
	*/
	function IsPasswordValidByID($ID, $password)
	{
		$query = $this->ci->db->query("SELECT password FROM users WHERE ID='$ID'");
		
		$row = $query->row();
		
		$password=md5($password.'secret_message');
		if($password == $row->password)
		{
			return true;
		}
		else 
			return false;
	}
	
	
	//Получение Info юзера по email
	function GetUserInfoByEmail($email)
	{
		$query = $this->ci->db->query("SELECT id, first_name, last_name, password, birthday FROM users WHERE email = '$email'");
		$row = $query->row();
		
		return $row;
	}
	
	/*
	Получение юзера по ID
	*/
	function GetUser($UserID)
	{
		$query = $this->ci->db->query("SELECT id, email, first_name, last_name, password, birthday, sex, city, country FROM users WHERE ID = $UserID");
		$row = $query->row();
		
		return $row;
	}
	
	/*
	Получение дополнительных данных  про юзера по ID
	*/
	function GetUserData($UserID)
	{
		$query = $this->ci->db->query("SELECT phone, website, activities, interests, about, avatar_name FROM user_data WHERE user_id = $UserID");
		$row = $query->row();
		return $row;
	}
	
	/*
	Обновление данных юзера
	*/
	function UpdateUser($UserID, $first_name, $last_name, $birthday, $sex, $city, $region, $country, $phone, $website, $activities, $interests, $about)
	{
		if($country!='' && $region!='' && $city!='')
		{
			$query = $this->ci->db->query("UPDATE users SET first_name = '$first_name', last_name = '$last_name', birthday = '$birthday', sex = '$sex', city = '$city', region = '$region', country = '$country'  WHERE ID = '$UserID'");
		}
		else 
			$query = $this->ci->db->query("UPDATE users SET first_name = '$first_name', last_name = '$last_name', birthday = '$birthday', sex = '$sex'  WHERE ID = '$UserID'");
		
		$query = $this->ci->db->query("UPDATE user_data SET phone = '$phone', website = '$website', activities = '$activities', interests = '$interests', about = '$about' WHERE user_id = '$UserID'");
	}
	
	/*
	Изменение пароля
	*/
	function NewPassword($UserID, $NewPassword)
	{
		$NewPassword=md5($NewPassword.'secret_message'); //md5 кодирует строку с паролем 
		$query = $this->ci->db->query("UPDATE users SET password = '$NewPassword' WHERE ID = $UserID");
	}
	
	/*
	Редактирование аватара
	*/
	function UpdateAvatar($user_id, $file_ext)
	{
		$this->ci->db->query("UPDATE user_data set avatar_name='a_$user_id$file_ext' WHERE user_id=$user_id");
	}
	
	function GetUserRating($user_id)
	{
		$query = $this->ci->db->query("SELECT rating FROM user_data WHERE user_id=$user_id");
		$row = $query->row();
		return $row->rating;
	}
	
	function new_password_request($user_id)
	{
		$this->ci->db->query("DELETE FROM forget_password WHERE user_id = $user_id");
		
		$user_code = random_string('alnum', 20);
		
		$this->ci->db->query("INSERT INTO forget_password (user_id, user_code) VALUES ($user_id, '$user_code')");
		
		return $user_code;
	}
	
	function CheckUserCode($user_code)
	{
		$return_value['id'] = -1;
		$return_value['password'] = -1;
		
		
		$query = $this->ci->db->query("SELECT user_id FROM forget_password WHERE user_code = '$user_code'");
		
		$row = $query->row();
		if($row != null)
		{
			$user_id = $row->user_id;
			
			$new_password = random_string('alnum', 7);
			
			$this->NewPassword($user_id, $new_password);
			$return_value['id'] = $user_id;
			$return_value['password'] = $new_password;
			
			$this->ci->db->query("DELETE FROM forget_password WHERE user_id = $user_id");
		}
		return $return_value;
	}
	
	function GetNumberOfUsers()
	{
		$query = $this->ci->db->query("SELECT id FROM users");
		return $query->num_rows();
	}
	
	function GetUsersByRate()
	{
		$query = $this->ci->db->query("SELECT user_id FROM user_data WHERE rating>0 ORDER BY rating DESC LIMIT 10");
		return $query->result();
	}
	
	function GetUsersByActive()
	{
		//$query = $this->ci->db->query("SELECT user_id FROM user_data WHERE rating>0 ORDER BY rating DESC LIMIT 10");
		//return $query->result();
		$UsersByRate = $this->GetUsersByRate();
		foreach ($UsersByRate as $var):
		//сколько раз юзер голосовал
		$query = $this->ci->db->query("SELECT COUNT(*) FROM rating_act_desk WHERE user_id=$var->user_id");
		$row = $query->row_array();
		$rating[$var->user_id]=$row['COUNT(*)'];
		
		//сколько комментов
		$query = $this->ci->db->query("SELECT COUNT(*) FROM comments WHERE user_id=$var->user_id");
		$row = $query->row_array();
		$comments[$var->user_id]=$row['COUNT(*)'];
		
		//сколько рецептов
		$query = $this->ci->db->query("SELECT COUNT(*) FROM recipes WHERE user_id=$var->user_id");
		$row = $query->row_array();
		$recipes[$var->user_id]=$row['COUNT(*)'];
		endforeach;
		
		foreach ($rating as $key => $value):
		
		$active_users[$key] = 0.3*$rating[$key] + 0.5*$comments[$key] + 0.5*$recipes[$key]; 
		endforeach;
		
		arsort($active_users);
		return $active_users;
	}
	
	function GetNewbeUsers()
	{
		$query = $this->ci->db->query("SELECT id FROM users ORDER BY id DESC LIMIT 10");
		return $query->result();
	}
	
	
	function GetUsersBuilderHTML()
	{
		return "<div id=\"FriendsItem\" class=\"FriendsItem\">
				<table cellpadding=\"0\" cellspacing=\"0\" class=\"FriendsItemTable\">
				<tr>
				<td valign=\"top\" class=\"FriendAvatarTD\">
				<a href=\"{UserUrl}\">
				<img src=\"{AvatarUrl}\" title=\"{UserFullName}\" class=\"FriendAvatar\"/></a>
				</td>
				<td valign=\"top\">
				<table>
				<tr>
				<td class=\"LabelTextFriends\">
				{FullNameText}
				</td>
				<td class=\"LableValueFriends\">
				<a href=\"{UserUrl}\">{UserFullName}</a>
				</td>
				</tr>
				<tr>
				<td class=\"LabelTextFriends\">
				{FriendRatingLevelText}
				</td>
				<td class=\"LableValueFriends\">
				{UserRating}
				</td>
				</tr>
				<tr>
				<td class=\"LabelTextFriends\">
				{BestRecipeText}
				</td>
				<td class=\"LableValueFriends\">
				<a href=\"/view_recipe/id/{BestRecipeId}\">{BestRecipe}</a>
				</td>
				</tr>
				</table>
				</td>
				<td valign=\"top\">
				<table class=\"GetMessageButtonsTable\">
				<tr>
				{SendMessageBtn}
				</tr>
				<tr>
				{FriendsBtn}
				</tr>
				<tr>
				{FriendBtn}
				</tr>
				</table>
				</td>
				</tr>
				</table>
				</div>";
	}
	
	function GetFriendBtn()
	{
		return "<td>
				<a href=\"{AddFriendUrl}\" id=\"AddFriend\" name=\"AddFriend\"\">
				<div class=\"Login_submit\">
				{AddFriend}
				</div>
				</a>
				</td>";
	}
	
	function SendMessageBtn()
	{
		return "<td>
				<a href=\"{SendMessageUrl}\" id=\"SendMessage\" name=\"SendMessage\">
				<div class=\"Login_submit\">
				{SendMessage}
				</div>
				</a>
				</td>";
	}
	
	function FriendsBtn()
	{
		return "<td>
				<a href=\"{FriendFriendsUrl}\" id=\"FriendFriends\" name=\"FriendFriends\">
				<div class=\"Login_submit\">
				{FriendFriends}
				</div>
				</a>
				</td>";
	}
}
?>