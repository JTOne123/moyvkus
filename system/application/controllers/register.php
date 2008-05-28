<?php

class Register extends Controller {
	
	function Register()
	{
		parent::Controller();
		
		$this->load->helper('form');
		
		$this->load->library('captcha');
		$this->load->library('validation');
		$this->load->library('session');
		
		$this->load->library('user_managment');
		$this->load->library('notification');
		$this->load->library('my_friends_lib');
	}
	
	function index()
	{
		$data = $this->_load_headers();
		
		$data = $this->_load_resource($data);
		
		$data = $this->_data_bind($data);
		
		$data['body']= $this->parser->parse('register', $data);
		
		$data['menu']=$this->Menu->buildmenu();
		
		$this->parser->parse('main_tpl', $data);	
	}
	
	function _load_headers()
	{
		$data['title'] = $this->lang->line('title').' - Регистрация';
		$data['keywords'] = $this->lang->line('keywords');
		$data['description'] = $this->lang->line('description');
		$data['baseurl'] = base_url();
		$data['header'] = $this->load->view('header', $data, true);
		
		return $data;
	}
	function _load_resource($data)
	{
		//Форма START
		$data['sign_up_message'] = $this->lang->line('sign_up_message');
		$data['sign_up_slogan_message'] = $this->lang->line('sign_up_slogan_message');
		$data['first_name'] = $this->lang->line('first_name');
		$data['last_name'] = $this->lang->line('last_name');
		$data['password'] = $this->lang->line('password');
		$data['repassword'] = $this->lang->line('repassword');
		$data['sign_up'] = $this->lang->line('sign_up');
		//Сообщения от JavaScript-валидатора
		$data['Error_email'] = $this->lang->line('Error_email');
		$data['Error_firstname'] = $this->lang->line('Error_firstname');
		$data['Error_lastname'] = $this->lang->line('Error_lastname');
		$data['Error_password'] = $this->lang->line('Error_password');
		$data['Error_repassword'] = $this->lang->line('Error_repassword');
		$data['Error_captcha'] = $this->lang->line('Error_captcha');
		
		//Форма END
		
		return $data;
	}
	function _data_bind($data)
	{	
		//Получаем поля с формы START
		$send=$this->input->post('send');
		$first_name=$this->input->post('first_name');
		$last_name=$this->input->post('last_name');
		$email=$this->input->post('email');
		$password=$this->input->post('password');
		$captcha=$this->input->post('captcha');
		//Получаем поля с формы END
		
		$rules['captcha']    = "required|exact_length[4]|callback_captcha_check";
		$rules['first_name'] = "required|min_length[4]|max_length[100]";
		$rules['last_name'] = "required|min_length[4]|max_length[100]";
		$rules['email'] = "required|min_length[6]|max_length[100]|valid_email|callback_email_check";
		$rules['password'] = "required|min_length[6]|max_length[21]|alpha_numeric";
		$this->validation->set_rules($rules);
		
		$fields['captcha']    = $this->lang->line('captcha');
		$fields['first_name'] = $this->lang->line('first_name');
		$fields['last_name'] = $this->lang->line('last_name');
		$fields['email'] = $this->lang->line('email');
		$fields['password'] = $this->lang->line('password');
		$this->validation->set_fields($fields);
		
		$invite_id = $this->uri->segment(4);		
		if($invite_id != false)
		{
			$user = $this->get_invited_user($invite_id);
			if($user != null)
			{
				if($user->friend_first_name != null)
					$this->validation->first_name = $user->friend_first_name;
				
				if($user->friend_last_name != null)
					$this->validation->last_name = $user->friend_last_name;
				
				if($user->friend_email != null)
					$this->validation->email = $user->friend_email;	
				
				//Создание сессия для инвайта START

				$this->session->set_userdata('invite_id', $invite_id);
				$this->session->set_userdata('user_id', $user->user_id);
				
				//Создание сессия для инвайта END		
				
			}
			else
				redirect('', 'refresh');
		}

		$FormBuild=1;  //Показывать форму. Если включится валидатор, он поставит FormBuild=0 и форма не покажется. :)
		
		//Прошли валидацию - записываем данные из полей в БД START
		if ($this->validation->run() == TRUE) 
		{
			$FormBuild=0;
			$new_user_id = $this->user_managment->AddUser($email, $first_name, $last_name, $password);
			$this->notification->AfterRegistration($email, $password);
			
			$invite_id = $this->session->flashdata('invite_id');
			$user_id = $this->session->flashdata('user_id');

			//Вроде исправил, но не могу понять почему этот код здесь. Он должен быть по идее ниже, если это для постбеков. Эта функция выполняется если валидация прошла успешно...
			if($invite_id != '' && $invite_id != false)
			{
				$invite_id = $this->session->userdata('invite_id');
				$user_id = $this->session->userdata('user_id');
				$this->my_friends_lib->AddFriend($user_id, $new_user_id);
				$this->delete_from_invite($invite_id);
				
				$this->session->set_userdata('invite_id', '');
				$this->session->set_userdata('user_id', '');
			}
			//$data['body'] = 'РЕДИРЕКТ НА ГЛАВНУЮ ПРОФАЙЛА!';
			
			redirect('main', 'refresh');
		}
		//Прошли валидацию - записываем данные из полей в БД END
		
		
		
		
		if ($FormBuild == 1)
		{
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
			$data['image']= $cap['image'];
			//Записываем в базу инфу о сгенереной картинке
			$query_string = array(
					'captcha_time'    => $cap['time'],
					'ip_address'    => $this->input->ip_address(),
					'word'            => $cap['word']
					);
			$query = $this->db->insert_string('captcha', $query_string);
			$this->db->query($query);	
			
			
		}
		return $data;
	}
	
	//CALLBACK: Проверяем есть ли такая картинка для капчи в базе START
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
	//CALLBACK: Проверяем есть ли такая картинка для капчи в базе END
	
	//CALLBACK: Проверяем есть ли уже базе email, который хотят зарегать START
	function email_check($mail)
	{
		$returned_value = $this->user_managment->IsUserExits($mail);
		if($returned_value)
		{
			$this->validation->set_message('email_check', $this->lang->line('email_check'));
			return false;
		}
		else 
			return true;
	}
	
	//CALLBACK: Проверяем есть ли уже базе email, который хотят зарегать END
	
	function get_invited_user($invited_id)
	{
		$query = $this->db->query("SELECT user_id, friend_email, friend_first_name, friend_last_name FROM invite WHERE id = " . $invited_id);
		$row = $query->row();
		
		return $row;
	}
	
	function delete_from_invite($invited_id)
	{
		$this->db->query("DELETE FROM invite WHERE id = " . $invited_id);
	}
}
?>