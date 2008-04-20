<?php

class Logout extends Controller {
	
	function Logout()
	{
		parent::Controller();
	}
	
	function index()
	{
      $this->userauthorization->logout();
      redirect('/main/', 'refresh'); // редирект на главную страницу
	}
}
?>