<?php

class Blog extends Controller {

	function Blog()
	{
		parent::Controller();
		$this->load->library('blog_lib');
		$this->load->library('pagination');
	}


	function index()
	{


		$data = $this->_load_headers();

		if($this->uri->segment(2)==false and $this->user_authorization->is_logged_in()==false)
		redirect('/blog/user/1', 'refresh');
		
		if($this->uri->segment(3)!='')
		{
			$user_id = $this->uri->segment(3);
		}
		else
		$user_id = $this->user_authorization->get_loged_on_user_id();
		
		$user_arr = $this->user_managment->GetUser($user_id);

		$data['MyBlog'] = $this->lang->line('MyBlog');
		$data['NameOfAuthor'] = $user_arr->first_name.' '.$user_arr->last_name;
		$query = $this->db->get_where('blog', array('user_id' => $user_id));
		$data['PostCount'] = $this->lang->line('TotalPosts').': '.$query->num_rows();

		$data = $this->_data_bind($data);


		$data['body']= $this->parser->parse('blog', $data);

		$this->parser->parse('main_tpl', $data);
	}

	function _load_headers()
	{
		$data['menu']=$this->Menu->buildmenu();
		$data['title'] = $this->lang->line('title');
		$data['keywords'] = $this->lang->line('keywords');
		$data['description'] = $this->lang->line('description');
		$data['baseurl'] = base_url();
		$data['header'] = $this->load->view('header', $data, true);

		return $data;
	}

	function _data_bind($data)
	{
		if($this->uri->segment(3)!='')
		{
			$user_id = $this->uri->segment(3);
		}
		else
		$user_id = $this->user_authorization->get_loged_on_user_id();

		$config['base_url'] = base_url().'blog/user/1/';
		$query = $this->db->get_where('blog', array('user_id' => $user_id));
		$config['total_rows'] = $query->num_rows();
		$config['per_page'] = '5';
		$config['uri_segment'] = 4;
		$config['first_link'] = 'Начало';
		$config['last_link'] = 'Конец';
		$this->pagination->initialize($config);
		$data['paginator'] = $this->pagination->create_links();
		$cur_page = $this->uri->segment(4);
		if(!isset($cur_page)) $cur_page=0;
		$posts = $this->blog_lib->GetPostsByUserId($user_id, $config['per_page'], $cur_page);






		$post_list = '';
		foreach ($posts as $row):
		$post_list_current = $this->blog_lib->BlogBuilder();

		$post_list_current = str_replace("{PostTitle}", $row->title, $post_list_current);
		$post_list_current = str_replace("{ViewPostUrl}", '/blog_post/'.$row->id, $post_list_current);

		if($this->user_authorization->get_loged_on_user_id() == $this->blog_lib->GetBlogPostUserId($row->id))
		{
			$post_list_current = str_replace("{ButtonEdit}", $this->blog_lib->ButtonEdit(), $post_list_current);
			$post_list_current = str_replace("{EditPost}", $this->lang->line('Edit'), $post_list_current);
			$post_list_current = str_replace("{EditPostUrl}", '/edit_blog_post/id/'.$row->id, $post_list_current);
		}
		else
		{
			$post_list_current = str_replace("{ButtonEdit}", '', $post_list_current);
			$post_list_current = str_replace("{EditPost}", '', $post_list_current);
			$post_list_current = str_replace("{EditPostUrl}", ''.$row->id, $post_list_current);
		}


		$post_list_current = str_replace("{Comments}", $this->lang->line('Comments'), $post_list_current);
		$post_list_current = str_replace("{number_of_comments}", '0', $post_list_current);

		$post_list = $post_list.$post_list_current;
		endforeach;

		$data['BlogBuilder'] = $post_list;
		return $data;
	}
}
?>