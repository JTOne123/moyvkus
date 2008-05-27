<?php
/*

Пример ввызова формы: $data['login']=$this->Loginform->build_login_form();

библиотека загружается автоматически

*/



class Register_form extends Model {
	
	function Register_form()
	{
		parent::Model();
		$this->load->library('captcha');
	}
	
	function build_register_form()
	{
		$layot['password'] = $this->lang->line('password');
	    $layot['log_in'] = $this->lang->line('log_in');
	    $layot['forgot_password'] = $this->lang->line('forgot_password');
	    $layot['checkbox_remember'] = $this->lang->line('checkbox_remember');
	    $layot = $this->load_resource($layot);
		
		$layot = $this->parser->parse('register_model', $layot);
		
		return $layot;
	}
	
		function load_resource($layot)
	{
		//Форма START
		$layot['sign_up_message'] = $this->lang->line('sign_up_message');
		$layot['sign_up_slogan_message'] = $this->lang->line('sign_up_slogan_message');
		$layot['first_name'] = $this->lang->line('first_name');
		$layot['last_name'] = $this->lang->line('last_name');
		$layot['password'] = $this->lang->line('password');
		$layot['repassword'] = $this->lang->line('repassword');
		$layot['sign_up'] = $this->lang->line('sign_up');
		//Сообщения от JavaScript-валидатора
		$layot['Error_email'] = $this->lang->line('Error_email');
		$layot['Error_firstname'] = $this->lang->line('Error_firstname');
		$layot['Error_lastname'] = $this->lang->line('Error_lastname');
		$layot['Error_password'] = $this->lang->line('Error_password');
		$layot['Error_repassword'] = $this->lang->line('Error_repassword');
		$layot['Error_captcha'] = $this->lang->line('Error_captcha');
		
			$expiration = time()-300; // Two hour limit
			$this->db->query("DELETE FROM captcha WHERE captcha_time < ".$expiration);
			//Создаем слово для капчи START
			$pool = '0 1 2 3 4 5 6 7 8 9 A B C D E F G H I J K L M N O P Q R S T U V W X Y Z';
			$explode = explode(' ', $pool); 			  //разбиваем строку в массив
			shuffle($explode);                            //перемешиваем элементы массива
			$word = implode(array_slice($explode, 0, 4)); //берем только 4 элемента массива и складываем в строку
			//Создаем слово для капчи END
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
			$layot['image']= $cap['image'];
			//Записываем в базу инфу о сгенереной картинке
			$query_string = array(
					'captcha_time'    => $cap['time'],
					'ip_address'    => $this->input->ip_address(),
					'word'            => $cap['word']
					);
			$query = $this->db->insert_string('captcha', $query_string);
			$this->db->query($query);
		//Форма END
		
		return $layot;
	}
	
}
?>