<div class="MainDivProfile">
    <table cellpadding="0" cellspacing="0" class="MainTableProfile">
        <tr>
            <td class="UserStatus">
				{YourComment}
			</td>
		</tr>
		<tr>
			<td class="Dialog Message">
				<table class="CommentsNewComments">
					<tr>
						<td colspan="2">
							<form method="POST" action="/comments/new_comment/">
							<textarea rows="2" name="comment" cols="20" class="CommentsTextBox"><?php echo $this->validation->comment;?></textarea>
							<input type="hidden" name="recipe_id" value="{recipe_id}<?php echo $this->validation->recipe_id;?>" />
						</td>
					</tr>
					<tr>
						<td>
						</td>
						<td class="btnAddCommentTD">
							<a href="#" id="Save" name="Save" onclick="document.getElementById('btnAddComment').click();">
								<div class="Login_submit">
									{SubmitCommentForm}
								</div>
							</a>
							<input id="btnAddComment" type="submit" value="{SubmitCommentForm}" name="Submit"
								style="display: none;">
							</form>
						</td>
					</tr>
				</table>
				<?php echo $this->validation->comment_error; ?>
				<?php echo $this->validation->recipe_id_error;?>
			</td>
		</tr>
	</table>
</div>