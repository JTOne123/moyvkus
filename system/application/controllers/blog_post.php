<?php

class Blog_post extends Controller {

	function Blog_post()
	{
		parent::Controller();
		$this->load->library('blog_lib');
		$this->load->helper('typography');
	}


	function index()
	{
		$data = $this->_load_headers();

		if($this->uri->segment(2)==false)
		redirect('/blogs', 'refresh');
		
		$user_id = $this->blog_lib->GetUserIdByPostId($this->uri->segment(2));
		$user_arr = $this->user_managment->GetUser($user_id);

		$data['MyBlog'] = $this->lang->line('MyBlog');
		$data['NameOfAuthor'] = '<a href="/profile/id/'.$user_arr->id.'">'.$user_arr->first_name.' '.$user_arr->last_name.'</a>';

		$query = $this->db->get_where('blog', array('user_id' => $user_id));

		$data['PostCount'] = $this->lang->line('TotalPosts').': '.$this->db->count_all_results('blog');

		$data = $this->_data_bind($data);


		$data['body']= $this->parser->parse('blog_post', $data);

		$this->parser->parse('main_tpl', $data);
	}

	function _load_headers()
	{
		$data['menu']=$this->Menu->buildmenu();
		//$data['title'] = $this->lang->line('title');
		$data['keywords'] = $this->lang->line('keywords');
		$data['description'] = $this->lang->line('description');
		$data['baseurl'] = base_url();
		$data['header'] = $this->load->view('header', $data, true);

		return $data;
	}

	function _data_bind($data)
	{
		
		$user_id = $this->user_authorization->get_loged_on_user_id();
		$post_id = $this->uri->segment(2);
		$get_post=$this->blog_lib->GetPostByPostId($post_id);

		$data['PostTitle'] = $get_post->title;
		$data['PostText'] = auto_typography($get_post->text);
		
		$data['title'] = $get_post->title.' - '.$this->lang->line('title');

		$post_list_current = '';
		if($this->user_authorization->get_loged_on_user_id() == $get_post->user_id)
		{
			$data['EditPostBut'] = $this->blog_lib->ButtonEdit();
			$data['EditPost'] = $this->lang->line('Edit');
			$data['EditPostUrl'] = '/edit_blog_post/id/'.$get_post->id;
		}
		else
		{
			$data['EditPostBut'] = '';
		}

		//$data['EditPost'] = $post_list_current;
		return $data;
	}
}
?>