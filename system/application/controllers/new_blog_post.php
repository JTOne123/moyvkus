<?php

class New_blog_post extends Controller {

	function New_blog_post()
	{
		parent::Controller();

		$this->load->library('validation');
		$this->load->library('blog_lib');
		$this->load->library('receipes_management');
		$this->load->library('twitter');

		$this->load->helper('form');
		$this->load->helper('text');
	}

	function _remap($method) {
		//страницы, доступные без авторизации
		$allowedPages = array();
		$pars = $this->uri->segment_array();
		unset($pars[1]);
		unset($pars[2]);


		if (($method != null) &&
		(($this->user_authorization->is_logged_in() !== false) ||  in_array($method, $allowedPages))) {
			call_user_func_array(array($this, $method), $pars);
		}
		else
		redirect('/login/', 'refresh');
	}

	function index()
	{
				
		$data = $this->_load_headers();

		$data = $this->_load_resource($data);

		$data = $this->_data_bind($data);

		if($this->uri->segment(1)=='edit_blog_post'){
			$data = $this->_edit_post($data);
		}

		$data['body']= $this->parser->parse('new_blog_post', $data);

		$this->parser->parse('main_tpl', $data);
	}

	function _load_headers()
	{
		$data['title'] = $this->lang->line('title').' - '.$this->lang->line('AddRecipe');
		$data['keywords'] = $this->lang->line('keywords');
		$data['description'] = $this->lang->line('description');
		$data['baseurl'] = base_url();
		$data['header'] = $this->load->view('header', $data, true);
		$data['menu']=$this->Menu->buildmenu();
		$data['login']='';

		return $data;
	}

	function _load_resource($data)
	{
		// Локализация надписей

		$data['BlogPostTitle'] = $this->lang->line('BlogPostTitle');
		$data['NewBlogPost'] = $this->lang->line('NewBlogPost');
		$data['BlogText'] = $this->lang->line('BlogText');

		$data['Save'] = $this->lang->line('Save');
		return $data;
	}



	function _data_bind($data)
	{

		
					//	$this->twitter->auth('moyvkus','moyvkus1212');
				//$this->twitter->update('test');
				//var_dump($this->twitter->update('test'));
				
		if($this->uri->segment(1)=='new_blog_post' and $this->session->userdata('update_or_insert')!='update')
		{
			$options = array(
			'update_or_insert'  => 'insert'
			);
			$this->session->set_userdata($options);

			$data['post_title'] = '';
			$data['post_text'] = '';
		}


		$update_or_insert=$this->session->userdata('update_or_insert');
		//var_dump($update_or_insert);
		$post_id = $this->session->userdata('post_id');

		$title=$this->input->post('title');
		$text=$this->input->post('text');


		$rules['title'] = "required|min_length[5]|max_length[150]";
		$rules['text'] = "required|min_length[50]";
		$this->validation->set_rules($rules);


		$fields['title']	= $this->lang->line('BlogPostTitle');
		$fields['text']	= $this->lang->line('BlogText');

		$this->validation->set_fields($fields);


		if ($this->validation->run() == FALSE)
		{
			$data['post_title'] = '';
			$data['post_text'] = '';
		}
		else
		{
			$db_data = array(
			'title' => $title ,
			'text' => $text ,
			'user_id' => $this->user_authorization->get_loged_on_user_id() ,
			);

			//Save
			if($update_or_insert=='update')
			{
				$this->db->where('id', $this->session->userdata('post_id'));
				$this->db->update('blog', $db_data);
				//Убиваем сессию
				$this->session->unset_userdata('update_or_insert');
				$this->session->unset_userdata('post_id');
				redirect('blog');
			}

			if($update_or_insert = 'insert')
			{
				$this->db->insert('blog', $db_data);
				
				//Убиваем сессию
				$this->session->unset_userdata('update_or_insert');
				$this->session->unset_userdata('post_id');

				//Ping
				$this->load->library('xmlrpc');
				$this->xmlrpc->server('http://rpc.pingomatic.com/', 80);
				$this->xmlrpc->method('weblogUpdates.ping');
				$request = array($this->lang->line('BlogsLenta').' - '.$this->lang->line('title'), base_url().'blogs/');
				$this->xmlrpc->request($request);
				if ( ! $this->xmlrpc->send_request())
				{
					echo $this->xmlrpc->display_error();
				}
				//Twitter
				$this->db->order_by("id", "desc"); 
				$this->db->limit(1);
				$query =  $this->db->get('blog');
				$row = $query->row();
				
				$title = 'Блоги: '.$title;
				$title = character_limiter($title, 135);
				$text = iconv("windows-1251", "UTF-8", $title.' http://moyvkus.ru/blog_post/'.$row->id);
				$text = character_limiter($text, 160);
				$this->twitter->auth('moyvkus','moyvkus1212');
				$st=$this->twitter->update($text);
				redirect('blog');
			}
		}

		return $data;
	}





	function _edit_post($data)
	{

		//if($this->uri->segment(1)=='edit_blog_post'){

		$id_of_post_from_uri=$this->uri->segment(3);

		$post_user_id = $this->blog_lib->GetBlogPostUserId($id_of_post_from_uri);

		if($post_user_id == $this->user_authorization->get_loged_on_user_id())
		if($id_of_post_from_uri!=FALSE)
		{
			$post = $this->blog_lib->GetPostByPostId($id_of_post_from_uri);

			if($post->user_id!==$this->user_authorization->get_loged_on_user_id())
			{
				redirect('blog/user/'.$this->user_authorization->get_loged_on_user_id(), 'refresh');
			}
			$data['post_title'] = $post->title;
			$data['post_text'] = $post->text;

			//Создаем сессию для временного храниния между постбеками переменных
			$options = array(
			'update_or_insert'  => 'update',
			'post_id'     => $id_of_post_from_uri,
			);
			$this->session->set_userdata($options);
		}
		else
		{
			$data['post_title'] = '';
			$data['post_text'] = '';
		}

		return $data;
	}
}
?>