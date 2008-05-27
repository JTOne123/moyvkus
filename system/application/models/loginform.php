<?php
/*

Пример ввызова формы: $data['login']=$this->Loginform->build_login_form();

библиотека загружается автоматически

*/



class Loginform extends Model {
	
	function Loginform()
	{
		parent::Model();
	}
	
	function build_login_form()
	{
		$layot['password'] = $this->lang->line('password');
	    $layot['log_in'] = $this->lang->line('log_in');
	    $layot['forgot_password'] = $this->lang->line('forgot_password');
		$layot['ForgetPasswordUrl'] = base_url() . 'forget_password/';
	    $layot['checkbox_remember'] = $this->lang->line('checkbox_remember');
		
		$layot = $this->parser->parse('login_model', $layot);
		
		return $layot;
	}
	
}
?>