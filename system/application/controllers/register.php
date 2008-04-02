<?php

class Register extends Controller {
	
	function Register()
	{
		parent::Controller();
		$this->load->helper('form');
		$this->load->library('captcha');
        $this->load->library('validation');
	}
	
	function index()
	{
    $data['title'] = $this->lang->line('title').' - Регистрация';
    $data['keywords'] = $this->lang->line('keywords');
    $data['description'] = $this->lang->line('description');
    $data['baseurl'] = base_url();
    $data['header'] = $this->load->view('header', $data, true);
	
    //Получаем поля с формы START
    $send=$this->input->post('send');
    $first_name=$this->input->post('first_name');
    $last_name=$this->input->post('last_name');
    $email=$this->input->post('email');
    $password=$this->input->post('password');
    $captcha=$this->input->post('captcha');
    //Получаем поля с формы END
    
     $rules['captcha']    = "required|exact_length[4]|callback_captcha_check";
     $rules['first_name'] = "required|min_length[4]|max_length[100]|alpha";
     $rules['last_name'] = "required|min_length[4]|max_length[100]|alpha";
     $rules['email'] = "required|min_length[6]|max_length[100]|valid_email";
     $rules['password'] = "required|min_length[6]|max_length[100]|alpha_numeric";
     $this->validation->set_rules($rules);
     
     $fields['captcha']    = $this->lang->line('captcha');
     $fields['first_name'] = $this->lang->line('first_name');
     $fields['last_name'] = $this->lang->line('last_name');
     $fields['email'] = $this->lang->line('email');
     $fields['password'] = $this->lang->line('password');
     $this->validation->set_fields($fields);
     
     
     //Прошли валидацию - записываем данные из полей в БД START
     if ($this->validation->run() === TRUE) 
     {
     	$data['body'] = 'run';
     }
     //Прошли валидацию - записываем данные из полей в БД END
     
     
     
    
    if ($this->validation->run() == FALSE)
    {
    	$expiration = time()-300; // Two hour limit
    	$this->db->query("DELETE FROM captcha WHERE captcha_time < ".$expiration);
    	$pool = '0 1 2 3 4 5 6 7 8 9 A B C D E F G H I J K L M N O P Q R S T U V W X Y Z';
    	$explode = explode(' ', $pool);
        shuffle($explode);
        $word = implode(array_slice($explode, 0, 4));
    	$vals = array(
    	'word'         => "$word",
    	'img_path'     => './uploads/',
    	'img_url'     => base_url().'/uploads/',
    	'font_path'     => './system/fonts/Arial-Black.ttf',
    	'img_width'     => '100',
    	'img_height' => '30',
    	'expiration' => '3600'
    	);

    	$cap = $this->captcha->create_captcha($vals);
    	$data['image']= $cap['image'];
    	//Записываем в базу инфу о сгенереной картинке
    	$query_string = array(
    	'captcha_id'    => '',
    	'captcha_time'    => $cap['time'],
    	'ip_address'    => $this->input->ip_address(),
    	'word'            => $cap['word']
    	);
    	$query = $this->db->insert_string('captcha', $query_string);
    	$this->db->query($query);	

/*    $this->load->helper('captcha');
    $aCaptchaCfg = array(
            //'word'          => 'myrandomword',    //default: random()
            'length'        => 4,                         //default: 5
            'img_path'   => './uploads/',   //no default !
            'img_url'       => base_url().'/uploads/',  // no default!
            'font_path'  => './www/system/fonts/', // default: ./system/fonts/
            'fonts'         => array('texb.ttf'), // default: texb.ttf
            'font_size'     => 25,      // default: 18
            'img_width'  => '100',  // default: 170
            'img_height' => '30',   // default: 60
            'expiration' => 7200 // default: 7200
            );
      
      
      $data['image'] = create_captcha($aCaptchaCfg);     
*/    	
    //Форма START
    $data['sign_up_message'] = $this->lang->line('sign_up_message');
    $data['sign_up_slogan_message'] = $this->lang->line('sign_up_slogan_message');
    $data['first_name'] = $this->lang->line('first_name');
    $data['last_name'] = $this->lang->line('last_name');
    $data['password'] = $this->lang->line('password');
    $data['sign_up'] = $this->lang->line('sign_up');
	//Сообщения от JavaScript-валидатора
	$data['Error_email'] = $this->lang->line('Error_email');
	$data['Error_firstname'] = $this->lang->line('Error_firstname');
	$data['Error_lastname'] = $this->lang->line('Error_lastname');
	$data['Error_password'] = $this->lang->line('Error_password');
	
    $data['body']= $this->parser->parse('register', $data);
    //Форма END
    }

    
    
    
	$data['menu']=$this->Menu->buildmenu();
    $this->parser->parse('main_tpl', $data);	
	}
	
	
	
	function captcha_check($str)
	{
		// Then see if a captcha exists:
		$exp=time()-600;
		$sql = "SELECT COUNT(*) AS count FROM captcha WHERE word = ? AND ip_address = ? AND captcha_time > ?";
		$binds = array($_POST['captcha'], $this->input->ip_address(), $exp);
		$query = $this->db->query($sql, $binds);
		$row = $query->row();
		if ($row->count == 0)
		{
			$this->validation->set_message('captcha_check', $this->lang->line('captcha_check'));
			return FALSE;
		}
		else{
			return TRUE;
		}
	}
	
	
	
	
}
?>