{YourComment}:<br>

<form method="POST" action="/comments/new_comment/">
<textarea rows="2" name="comment" cols="20"><?php echo $this->validation->comment;?></textarea>
<input type="hidden" name="recipe_id" value="{recipe_id}<?php echo $this->validation->recipe_id;?>" />
<br>
<input type="submit" value="{SubmitCommentForm}" name="Submit">
</form>

<?php echo $this->validation->comment_error; ?>
<?php echo $this->validation->recipe_id_error; ?>