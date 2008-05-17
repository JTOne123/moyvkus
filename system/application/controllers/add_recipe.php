<?php

class Add_recipe extends Controller {

	function Add_recipe()
	{
		parent::Controller();

		$this->load->library('validation');
		$this->load->library('receipesmanagement');

		$this->load->helper('form');
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
		$data = $this->_edit_recipe($data);

		$data['body']= $this->parser->parse('add_recipe', $data);

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

		$data['NameOfRecipe'] = $this->lang->line('NameOfRecipe');
		$data['CategoryOfRecipe'] = $this->lang->line('CategoryOfRecipe');
		$data['KitchenOfRecipe'] = $this->lang->line('KitchenOfRecipe');
		$data['PortionsOfRecipe'] = $this->lang->line('PortionsOfRecipe');
		$data['PortionsQttyOfRecipe'] = $this->lang->line('PortionsQttyOfRecipe');
		$data['IngredientsOfRecipe'] = $this->lang->line('IngredientsOfRecipe');
		$data['TextOfRecipe'] = $this->lang->line('TextOfRecipe');
		$data['Save'] = $this->lang->line('Save');
		$data['NewRecipeTitle'] = $this->lang->line('AddRecipe');
		$data['RecipeImgText'] = $this->lang->line('RecipeImgText');

		$data['errorDivName']	= $this->lang->line('errorDivName');
		$data['errorDivPortions']	= $this->lang->line('errorDivPortions');
		$data['errorDivIngredients']	= $this->lang->line('errorDivIngredients');
		$data['errorDivRecipeText']	= $this->lang->line('errorDivRecipeText');
		
		return $data;
	}

	function _edit_recipe($data)
	{

		$id_of_recipe_from_uri=$this->uri->segment(3);
		if($id_of_recipe_from_uri!=FALSE)
		{
			$arr=$this->receipesmanagement->getdataforedit($id_of_recipe_from_uri);

			$user_id=$arr[0]['user_id'];
			if($user_id!==$this->userauthorization->get_loged_on_user_id())
			{
				redirect('profile', 'refresh');
			}

			$data['name'] = $arr[0]['name'];
			$data['portions'] = $arr[0]['portions'];
			$data['ingredients'] = $arr[0]['ingredients'];
			$data['recipe_text'] = $arr[0]['recipe_text'];
			//Создаем сессию для временного храниния между постбеками переменных
			$options = array(
                   'update_or_insert'  => 'update',
                   'id_of_recipe'     => $id_of_recipe_from_uri,
               );
             $this->session->set_userdata($options);

			$data['photo'] = '/uploads/recipe_photos/'.$arr[0]['photo_name'];
			
			$categorys=$this->receipesmanagement->GetCategorys();
			
			$data['categorys']=form_dropdown('category', $categorys, $arr[0]['category_id']); // id=22 - Разное

			$kitchens=$this->receipesmanagement->GetKitchens();
			$data['kitchens']=form_dropdown('kitchens', $kitchens, $arr[0]['kitchen_id']);
			
		}
		else
		{
			$data['name'] = '';
			$data['portions'] = '';
			$data['ingredients'] = '';
			$data['recipe_text'] = '';
			$data['photo'] = '';
			
			$categorys=$this->receipesmanagement->GetCategorys();
			$data['categorys']=form_dropdown('category', $categorys, '22'); // id=22 - Разное

			$kitchens=$this->receipesmanagement->GetKitchens();
			$data['kitchens']=form_dropdown('kitchens', $kitchens, '');
		}

		return $data;
	}



	function _data_bind($data)
	{

		if($this->uri->segment(1)=='add_new_recipe')
		{
			$this->session->set_userdata('update_or_insert', 'insert');
			
			$data['ShowPhoto'] = 'none';
		}
		
		$rules['name'] = "required|min_length[5]|max_length[300]";
		$rules['portions'] = "required|numeric";
		$rules['ingredients'] = "required|min_length[25]|max_length[2000]";
		$rules['receipe_text'] = "required|min_length[100]|max_length[3000]";

		$this->validation->set_rules($rules);

		$fields['name']	= $this->lang->line('NameOfRecipe');
		$fields['portions']	= $this->lang->line('PortionsOfRecipe');
		$fields['ingredients']	= $this->lang->line('IngredientsOfRecipe');
		$fields['receipe_text']	= $this->lang->line('TextOfRecipe');

		$this->validation->set_fields($fields);

		if ($this->validation->run())
		{
			$name = $this->input->post('name');
			$portions = $this->input->post('portions');
			$kitchen_id = $this->input->post('kitchens');
			$category_id = $this->input->post('category');
			$ingredients = $this->input->post('ingredients');
			$recipe_text = $this->input->post('receipe_text');
			//берем значения с сессии
			$update_or_insert=$this->session->userdata('update_or_insert');
			$id_of_recipe = $this->session->userdata('id_of_recipe');

			$photo_name='';
			$user_id=$this->userauthorization->get_loged_on_user_id();
			$rating='';

		
			//Сохраняем рецепт *****
			if($update_or_insert=='insert')
			{
			$last_inserted_id=$this->receipesmanagement->SaveRecipe($name, $category_id, $kitchen_id, $portions, $ingredients, $recipe_text, $photo_name, $user_id, $rating, $id_of_recipe);
			}
			if($update_or_insert=='update')
			{
				$this->receipesmanagement->UpdateRecipe($name, $category_id, $kitchen_id, $portions, $ingredients, $recipe_text, $photo_name, $user_id, $rating, $id_of_recipe);
				$last_inserted_id=$id_of_recipe;
			}
			
			//Убиваем сессию
			$this->session->unset_userdata('update_or_insert');
			$this->session->unset_userdata('id_of_recipe');
			
			//upload
			$this->load->library('image_lib');

			$config['upload_path'] = './uploads/recipe_photos/stacked';
			$config['allowed_types'] = 'gif|jpg|png';
			$config['max_size']	= '2048';
			$this->load->library('upload', $config);

			if ($this->upload->do_upload())
			{

				$upl_arr=$this->upload->data();
								
                @unlink('./uploads/recipe_photos/big_photos/recipe_photo_id'.$last_inserted_id.$upl_arr['file_ext']);
                @unlink('./uploads/recipe_photos/recipe_photo_id'.$last_inserted_id.$upl_arr['file_ext']);
                
				$config['image_library'] = 'GD2';
				$config['new_image'] = './uploads/recipe_photos/recipe_photo_id'.$last_inserted_id.$upl_arr['file_ext'];
				$config['source_image'] = './uploads/recipe_photos/stacked/'.$upl_arr['raw_name'].$upl_arr['file_ext'];
				$config['quality'] = '90%';
				$config['width'] = 300;
				$config['height'] = 100;
				$this->image_lib->initialize($config);
				$this->image_lib->resize();


				$config['new_image'] = './uploads/recipe_photos/big_photos/recipe_photo_id'.$last_inserted_id.$upl_arr['file_ext'];
				$config['source_image'] = './uploads/recipe_photos/stacked/'.$upl_arr['raw_name'].$upl_arr['file_ext'];
				$config['quality'] = '90%';
				$config['width'] = 500;
				$config['height'] = 250;
				$this->image_lib->initialize($config);
				$this->image_lib->resize();

				//watermark
				$config['source_image'] = './uploads/recipe_photos/big_photos/recipe_photo_id'.$last_inserted_id.$upl_arr['file_ext'];
				$config['wm_text'] = '©MoyVkus.ru';
				$config['wm_type'] = 'text';
				$config['wm_font_path'] = './system/fonts/Arial-Black.ttf';
				$config['wm_font_size'] = '8';
				$config['wm_font_color'] = 'ffffff';
				$config['wm_vrt_alignment'] = 'bottom';
				$config['wm_hor_alignment'] = 'left';
				$config['wm_padding'] = '0';

				$this->image_lib->initialize($config);
				$this->image_lib->watermark();
				
                //Сохраняем фото
				$this->receipesmanagement->SavePhoto($last_inserted_id, 'recipe_photo_id'.$last_inserted_id.$upl_arr['file_ext']);
				
				//Удаляем загруженную юзером фотку со стековой папки
				unlink('./uploads/recipe_photos/stacked/'.$upl_arr['raw_name'].$upl_arr['file_ext']);
			}
			//
			redirect('my_recipes', 'refresh');
		}
		return $data;
	}

}
?>