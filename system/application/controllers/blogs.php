<?php

class Blogs extends Controller {

	function Blogs()
	{
		parent::Controller();
		$this->load->library('blog_lib');
		$this->load->library('pagination');

		$this->load->helper('text');
		$this->load->helper('typography');
	}


	function index()
	{


		$data = $this->_load_headers();

		//$user_id = $this->user_authorization->get_loged_on_user_id();
		//$user_arr = $this->user_managment->GetUser($user_id);

		$data['BlogsLenta'] = $this->lang->line('BlogsLenta');

		if($this->user_authorization->is_logged_in()==true)
		{
		$data['new_blog_post'] = '<a href="/new_blog_post">'.$this->lang->line('AddPost').'</a>';
		$data['main_page'] = '<a href="/" class="linkHome">'.$this->lang->line('main_page').'</a>';
		}
		else 
		{
		$data['new_blog_post'] = '';
		$data['main_page'] = '<a href="/" class="linkHome">'.$this->lang->line('main_page').'</a>';
		}

		$data = $this->_data_bind($data);

		$data['body']= $this->parser->parse('blogs', $data);

		$this->parser->parse('main_tpl', $data);
	}

	function _load_headers()
	{
		$data['menu']=$this->Menu->buildmenu();
		$data['title'] = $this->lang->line('BlogsLenta').' - '.$this->lang->line('title');
		$data['keywords'] = $this->lang->line('BlogsLenta');
		$data['description'] = $this->lang->line('description');
		$data['baseurl'] = base_url();
		$data['header'] = $this->load->view('header', $data, true);

		return $data;
	}

	function _data_bind($data)
	{
		//$user_id = $this->user_authorization->get_loged_on_user_id();

		$config['base_url'] = base_url().'blogs/page/';

		$this->db->order_by('id', 'desc');
		$query = $this->db->get('blog');

		$config['total_rows'] = $this->db->count_all_results('blog');
		$config['per_page'] = '10';
		$config['uri_segment'] = 3;
		$config['first_link'] = 'Начало';
		$config['last_link'] = 'Конец';
		$this->pagination->initialize($config);
		$data['paginator'] = $this->pagination->create_links();
		$cur_page = $this->uri->segment(3);

		if(!isset($cur_page)) $cur_page=0;

		$posts = $this->blog_lib->GetPosts($config['per_page'], $cur_page);





		$post_list = '';
		foreach ($posts as $row):
		$post_list_current = $this->blog_lib->BlogListBuilder();

		$post_list_current = str_replace("{PostTitle}", $row->title, $post_list_current);
		$post_list_current = str_replace("{ViewPostUrl}", '/blog_post/'.$row->id, $post_list_current);

		$text = word_limiter($row->text, 50).'<br><a href="/blog_post/'.$row->id.'">'.$this->lang->line('Read').'</a>';
		$text = auto_typography($text);
		$post_list_current = str_replace("{PostText}", $text, $post_list_current);

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


	function feed()
	{
		$this->load->helper('xml');
		$this->load->helper('text');

		$data['encoding'] = 'windows-1251';
		$data['feed_name'] = $this->lang->line('BlogsLenta').' - '.$this->lang->line('title');
		$data['feed_url'] = base_url().'blogs/feed/';
		$data['page_description'] = $this->lang->line('BlogsLenta');
		$data['page_language'] = 'ru';
		$data['creator_email'] = 'info at moyvkus.ru';
		
		$this->db->order_by('id', 'desc');
		$this->db->limit(10);
		$query = $this->db->get('blog');

		$data['posts'] = $query->result();
		header("Content-Type: application/rss+xml");
		$this->load->view('blog_feed', $data);
	}
}
?>