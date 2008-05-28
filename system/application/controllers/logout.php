<?php

class Logout extends Controller {
	
	function Logout()
	{
		parent::Controller();
	}
	
	function index()
	{
      $this->user_authorization->logout();
      redirect('/main/', 'refresh'); // редирект на главную страницу
	}
}
?>