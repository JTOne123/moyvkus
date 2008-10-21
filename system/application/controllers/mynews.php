<?php

    class MyNews extends Controller {
        
        function MyNews()
        {
            parent::Controller();
                
            $this->load->library('validation');
                
            $this->load->library('comments_management');
            $this->load->library('user_managment');
                  
            $this->load->helper('date');
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
                
            $data['body']= $this->parser->parse('mynews', $data);
                
            $this->parser->parse('main_tpl', $data);
        }
        
        function _load_headers()
        {
            $data['title'] = $this->lang->line('title').' - '.$this->lang->line('MyNew');
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
            $data['MyNew'] = $this->lang->line('MyNews');
                
            return $data;
        }
        
        function _data_bind($data)
        {
            $user_id = $this->user_authorization->get_loged_on_user_id();	
                
            $data['NewsBuilder'] = $this->news_builder($user_id, $data);
            
            return $data;
        }
        
        function news_builder($user_id)
        {
            $return_value = '';
            
            $recipe_id_collection = $this->comments_management->GetCommentedRecipes($user_id);
            
            $comment_item = $this->comments_management->ViewMyNewsBuilder();
            
            foreach ($recipe_id_collection->result() as $row_ric)
            {
                $commented_recipe = $this->comments_management->GetCommentForRecipe($row_ric->recipe_id);
                
                $last_comment_text = $commented_recipe->text;
                $last_comment_timestamp = $commented_recipe->timestamp;
                $comment_auther_id = $commented_recipe->user_id;
                
                $comment_auther = $this->user_managment->GetUser($comment_auther_id);
                
                $recipe_name = $commented_recipe->name;
                $recipe_photo = $commented_recipe->photo_name;
                
                $current_comment_item = str_replace("{RecipeUrl}", 'http://' . $_SERVER['HTTP_HOST'] . '/view_recipe/id/' . $row_ric->recipe_id, $comment_item);
                $current_comment_item = str_replace("{RecipeName}", $recipe_name, $current_comment_item);
                
                $current_comment_item = str_replace("{AutherLink}", 'http://' . $_SERVER['HTTP_HOST'] . '/profile/id/' . $comment_auther->id, $current_comment_item);
                $current_comment_item = str_replace("{AutherAndTime}", "(" . $comment_auther->first_name . " " . $comment_auther->last_name . " " . $last_comment_timestamp . ")", $current_comment_item);
                
                $current_comment_item = str_replace("{CommentText}", $last_comment_text, $current_comment_item);
                $current_comment_item = str_replace("{AddCommentsText}", $this->lang->line('NewCommentForRecipe'), $current_comment_item);
                
                if($recipe_photo != NULL and $recipe_photo != '')
                {
                    $current_comment_item = str_replace("{RecipePhotoUrl}", '/uploads/recipe_photos/big_photos/' . $recipe_photo, $current_comment_item);
                }
                else
                {
                    $current_comment_item = str_replace("{RecipePhotoUrl}", 'http://' . $_SERVER['HTTP_HOST'] . '/images/nophoto.gif', $current_comment_item);
                }
                
                $return_value = $return_value . $current_comment_item;
            }
            
            return $return_value;
        }
    }
?>