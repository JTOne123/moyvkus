<?php

class Comments extends Controller {

	function Comments()
	{
		parent::Controller();

		$this->load->library('validation');
		$this->load->library('commentsmanagement');
		$this->load->library('usermanagment');
	}

	function _remap($method) {
		//страницы, доступные без авторизации
		$allowedPages = array();
		$pars = $this->uri->segment_array();
		unset($pars[1]);
		unset($pars[2]);


		if (($method != null) &&
		(($this->userauthorization->is_logged_in() !== false) ||  in_array($method, $allowedPages))) {
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

		$data['body']= $this->parser->parse('new_comment', $data);

		$this->parser->parse('main_tpl', $data);
	}

	function _load_headers()
	{
		$data['title'] = $this->lang->line('title');
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

		$data['NameOfRecipe'] = $this->lang->line('NameOfRecipe');
		$data['YourComment'] = $this->lang->line('YourComment');
		$data['SubmitCommentForm'] = $this->lang->line('SubmitCommentForm');
		$data['recipe_id'] = '';

		return $data;
	}

	function new_comment()
	{
		$comment = $this->input->post('comment');
		$recipe_id = $this->input->post('recipe_id');
		$user_id = $this->userauthorization->get_loged_on_user_id();

		$rules['comment']	= "trim|required|min_length[5]|max_length[1500]|xss_clean|callback_word_censor";
		$rules['recipe_id']	= "required|numeric";
		$this->validation->set_rules($rules);

		$fields['comment'] = $this->lang->line('YourComment');
		$fields['recipe_id'] = 'recipe_id';
		$this->validation->set_fields($fields);



		if ($this->validation->run() !== FALSE)
		{
			$this->commentsmanagement->SaveComment($comment, $recipe_id, $user_id);
			
			redirect('view_recipe/id/'.$recipe_id.'#comments', 'refresh');
		}

		$data = $this->_load_headers();
		$data = $this->_load_resource($data);
		$data['body']= $this->parser->parse('new_comment', $data);
		$this->parser->parse('main_tpl', $data);
	}

	function word_censor($comment)
	{
		$disallowed = $this->commentsmanagement->GetCensorWords();
		foreach ($disallowed as $row):
		$beep = strstr($comment, $row);
		if($beep!==FALSE)
		{
			$this->validation->set_message('word_censor', $this->lang->line('WordCensorError'));
			return false;
			break;
		}
		endforeach;

	}

	function delete_comment()
	{
		$id_of_comment = $this->uri->segment(4);
		$id_of_recipe = $this->uri->segment(6);
		$id_of_logened_user = $this->userauthorization->get_loged_on_user_id();
		$IsUserIsCommentAuthor = $this->commentsmanagement->IsUserIsCommentAuthor($id_of_comment, $id_of_logened_user);
		if($IsUserIsCommentAuthor==TRUE)
		{
			$this->commentsmanagement->DeleteComment($id_of_comment);
			redirect('/view_recipe/id/'.$id_of_recipe, 'refresh');
		}
		else 
		redirect('/view_recipe/id/'.$id_of_recipe, 'refresh');
		
	}


	function _data_bind($data)
	{


		return $data;
	}

}
?>