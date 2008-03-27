<?php

class Register extends Controller {
	
	function Register()
	{
		parent::Controller();
		$this->load->helper('form');
	}
	
	function index()
	{
    $data['title'] = $this->lang->line('title').' - �����������';
    $data['keywords'] = $this->lang->line('keywords');
    $data['description'] = $this->lang->line('description');
    $data['header'] = $this->load->view('header', $data, true);
	
    //�������� ���� � ����� START
    $send=$this->input->post('send');
    $first_name=$this->input->post('first_name');
    $last_name=$this->input->post('last_name');
    $email=$this->input->post('email');
    $pass=$this->input->post('pass');
    //�������� ���� � ����� END
    
    
    //���� �� ������ ������ POST, �� ���������� ����� �����������
    if($send==false && $first_name==false && $last_name==false && $email==false && $pass==false)
    {
    //����� START
    $data['sign_up_message'] = $this->lang->line('sign_up_message');
    $data['sign_up_slogan_message'] = $this->lang->line('sign_up_slogan_message');
    $data['first_name'] = $this->lang->line('first_name');
    $data['last_name'] = $this->lang->line('last_name');
    $data['password'] = $this->lang->line('password');
    $data['sing_up'] = $this->lang->line('sing_up');
    $data['body']= $this->parser->parse('register', $data);
    //����� END
    }
   else
    //��������� ����� � �� START
    $data['body'] = 'TODO: ��������� ���������� � ����� ����';
    //��������� ����� � �� END
    
    
    $this->parser->parse('main_tpl', $data);	
	}
}
?>