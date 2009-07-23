<?php

class Comments extends Controller {

	function Comments()
	{
		parent::Controller();

		$this->load->library('validation');
		$this->load->library('comments_management');
		$this->load->library('receipes_management');
		$this->load->library('user_managment');
		$this->load->library('notification');
                $this->load->library('blog_lib');
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
                $data['blog_id'] = '';

		return $data;
	}

	function new_comment()
	{
		$comment = $this->input->post('comment');
		$recipe_id = $this->input->post('recipe_id');
		$user_id = $this->user_authorization->get_loged_on_user_id();

		$rules['comment']	= "trim|required|min_length[5]|max_length[1500]|xss_clean|callback_word_censor";
		$rules['recipe_id']	= "required|numeric";
		$this->validation->set_rules($rules);

		$fields['comment'] = $this->lang->line('YourComment');
		$fields['recipe_id'] = 'recipe_id';
		$this->validation->set_fields($fields);



		if ($this->validation->run() !== FALSE)
		{
			$this->comments_management->SaveComment($comment, $recipe_id, $user_id);
			$author_id = $this->receipes_management->GetAuthorIdByRecipeId($recipe_id);
			
			if($author_id!=$user_id)
			{
			$this->notification->new_comment($author_id, $user_id, $recipe_id);
			}
			
			redirect('view_recipe/id/'.$recipe_id.'#comments', 'refresh');
		}

		$data = $this->_load_headers();
		$data = $this->_load_resource($data);
		$data['body']= $this->parser->parse('new_comment', $data);
		$this->parser->parse('main_tpl', $data);
	}

	function new_comment_blog()
	{
		$comment = $this->input->post('comment');
		$blog_id = $this->input->post('blog_id');
		$user_id = $this->user_authorization->get_loged_on_user_id();

		$rules['comment']	= "trim|required|min_length[5]|max_length[1500]|xss_clean|callback_word_censor";
		$rules['blog_id']	= "required|numeric";
		$this->validation->set_rules($rules);

		$fields['comment'] = $this->lang->line('YourComment');
		$fields['blog_id'] = 'blog_id';
		$this->validation->set_fields($fields);


		if ($this->validation->run() !== FALSE)
		{
			$this->comments_management->SaveComment($comment, $blog_id, $user_id, false);

                        $author_id = $this->blog_lib->GetUserIdByPostId($blog_id);

			if($author_id != $user_id)
			{
                            $this->notification->new_comment($author_id, $user_id, $blog_id, false);
			}

			redirect('blog_post/' . $blog_id. '#comments', 'refresh');
		}


		$data = $this->_load_headers();
		$data = $this->_load_resource($data);
		$data['body']= $this->parser->parse('new_comment_blog', $data);
		$this->parser->parse('main_tpl', $data);
	}

	function word_censor($comment)
	{
		$disallowed = $this->comments_management->GetCensorWords();
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
		$id_of_logened_user = $this->user_authorization->get_loged_on_user_id();
		$IsUserIsCommentAuthor = $this->comments_management->IsUserIsCommentAuthor($id_of_comment, $id_of_logened_user);
		if($IsUserIsCommentAuthor==TRUE)
		{
			$this->comments_management->DeleteComment($id_of_comment);
			redirect('/view_recipe/id/'.$id_of_recipe, 'refresh');
		}
		else 
		redirect('/view_recipe/id/'.$id_of_recipe, 'refresh');
		
	}

        function delete_comment_blog()
	{
		$comment_id = $this->uri->segment(4);
		$blog_id = $this->uri->segment(6);
                
		$id_of_logened_user = $this->user_authorization->get_loged_on_user_id();

		$IsUserIsCommentAuthor = $this->comments_management->IsUserIsCommentAuthor($comment_id, $id_of_logened_user);

                if($IsUserIsCommentAuthor==TRUE)
		{
			$this->comments_management->DeleteComment($comment_id);
			redirect('/blog_post/' . $blog_id, 'refresh');
		}
		else
                    redirect('/blog_post/' . $blog_id, 'refresh');

	}

	function _data_bind($data)
	{


		return $data;
	}

}
?>