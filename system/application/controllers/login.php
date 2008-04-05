<?php

class Login extends Controller {
	
	function Login()
	{
		parent::Controller();
		$this->load->library('validation');
		$this->load->library('usermanagment');
		
	}
	
	function index()
	{
		$data['title'] = $this->lang->line('title').' - ����';
		$data['keywords'] = $this->lang->line('keywords');
		$data['description'] = $this->lang->line('description');
		$data['baseurl'] = base_url();
		$data['header'] = $this->load->view('header', $data, true);
	    $data['menu']=$this->Menu->buildmenu();
		
	    $var=$this->usermanagment->GetUserInfoByEmail('milo@milo.com');
    
		$data['body'] = $var['last_name'];
		$this->parser->parse('main_tpl', $data);
	}
	
	//CALLBACK: ��������� ���� �� ��� ���� email, ������� ����� �������� END
	
}
?>