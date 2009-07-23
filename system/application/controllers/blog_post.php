<?php

class Blog_post extends Controller {

	function Blog_post()
	{
		parent::Controller();
		$this->load->library('blog_lib');
                $this->load->library('comments_management');

		$this->load->helper('typography');
                $this->load->helper('form');
		$this->load->helper('date');
		$this->load->helper('smiley');
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
		$data['YourComment'] = $this->lang->line('YourComment');
		$data['SubmitCommentForm'] = $this->lang->line('SubmitCommentForm');
		$data['MainData'] = $this->lang->line('MainData');
		$data['errorDivComment'] = $this->lang->line('errorDivComment');

		return $data;
	}

	function _data_bind($data)
	{
		
		$user_id = $this->user_authorization->get_loged_on_user_id();
		$post_id = $this->uri->segment(2);
		$get_post = $this->blog_lib->GetPostByPostId($post_id);

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

                //Êîììåíòàðèè START
                $data['blog_id'] = $post_id;

                $returned_html = $this->comments_management->ViewCommentsBuilder();
                $returned_comments_arr = $this->comments_management->GetComments($post_id, false);
                $comment_list = '';
                foreach ($returned_comments_arr as $row):

                $returned_str='';
                $text=$row['text'];
                //$text = parse_smileys($row['text'], "/images/smileys/");
                for($i = 0; $i < strlen($text); $i++)
                $returned_str = $returned_str . $text[$i] . '<wbr>';
                $text = $returned_str;
                $text = str_replace("\n", "<br>", $text);
                $text = parse_smileys($text, "/images/smileys/");
                $comment_current = str_replace("{CommentText}", $text, $returned_html);

                $user_info_obj=$this->user_managment->GetUser($row['user_id']);
                $user_data_info_obj=$this->user_managment->GetUserData($row['user_id']);

                $First_Last_Name = $user_info_obj->first_name.' '.$user_info_obj->last_name;
                $comment_current = str_replace("{AuthorFirstLastName}", $First_Last_Name, $comment_current);

                if($user_data_info_obj->avatar_name!=='' and $user_data_info_obj->avatar_name!==NULL)
                {
                        $avatar_name = base_url() . 'uploads/user_avatars/' . $user_data_info_obj->avatar_name;
                }
                else
                {
                        $avatar_name = base_url() . 'images/nophoto.gif';
                }

                $comment_current = str_replace("{AvatarUrl}", $avatar_name, $comment_current);

                $comment_current = str_replace("{DateOfPost}", $row['timestamp'], $comment_current);

                $comment_current = str_replace("{AuthorProfileUrl}", '/profile/id/' . $row['user_id'], $comment_current);

                //Ññûëêà ÓÄÀËÈÒÜ ÊÎÌÌÅÍÒ
                $is_user_is_comment_author=$this->comments_management->IsUserIsCommentAuthor($row['id'], $this->user_authorization->get_loged_on_user_id()); //True / False
                if($is_user_is_comment_author == TRUE)
                {
                        $comment_current = str_replace("{DeleteRecipeLink}", '/comments/delete_comment_blog/id/' . $row['id'] . '/blog/' . $post_id, $comment_current);
                        $comment_current = str_replace("{DeleteRecipeLinkText}", $this->lang->line('DeleteRecipeLinkText'), $comment_current);

                        $comment_current = str_replace("{SendMessageToCommentAuthor}", '', $comment_current);
                        $comment_current = str_replace("{SendMessageToCommentAuthorText}", '', $comment_current);
                }

                $comment_current = str_replace("{DeleteRecipeLinkText}", '', $comment_current);
                $comment_current = str_replace("{DeleteRecipeLink}", '', $comment_current);
                $comment_current = str_replace("{WriteOn}", $this->lang->line('WriteOn'), $comment_current);

                $comment_current = str_replace("{SendMessageToCommentAuthor}", '/send_message/send_to/id/' . $row['user_id'], $comment_current);
                $comment_current = str_replace("{SendMessageToCommentAuthorText}", $this->lang->line('SendMessageToCommentAuthorText'), $comment_current);


                //Ñêëàäûâàåì
                $comment_list = $comment_list . $comment_current;
                endforeach;
                $data['CommentsBuilder'] = $comment_list;
                //Êîììåíòàðèè END

		//$data['EditPost'] = $post_list_current;
		return $data;
	}
}
?>