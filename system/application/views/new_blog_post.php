<script src="<?=base_url()?>js/tiny_mce/tiny_mce.js" type="text/javascript">

</script>

<script type="text/javascript">
tinyMCE.init({
	mode : "textareas",
	theme : "simple",
	plugins : "advimage"

});
</script>



    <div class="MainDivProfile">
        <table cellpadding="0" cellspacing="0" class="MainTableProfile Friends">
            <tr>
                <td class="UserStatus">
                    {NewBlogPost}
                </td>
            </tr>
 
 
            <tr>
                <td class="FriendsBuilder">
                    
      							<?=form_open('new_blog_post'); ?>
							{BlogPostTitle}:           
                
      <input type="text" id="title" name="title" value="<?=$this->validation->title;?>{post_title}" size="30" class="RecipeInput">
	  <?=$this->validation->title_error; ?>         
                
	  <p>
       {BlogText}:         
      <textarea rows="10" id="text" name="text" cols="50" class="RecipeInput"><?=$this->validation->text;?>{post_text}</textarea>
	  <?=$this->validation->text_error; ?>           
                
                
                

					<p>
							<a href="#" id="lnkSave" onclick="document.getElementById('btnSave').click();">
								<div class="Login_submit">
									{Save}
								</div>
							</a>
							<input type="submit" value="{Save}" id="btnSave" name="submit" style="display:none;">
						

						
							</form>
						
					     
                
                
                
                </td>
            </tr>
        </table>
    </div>