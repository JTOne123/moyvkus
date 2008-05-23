<script src="<?=$baseurl?>js/prototype.js"></script>

<script>
	function ajax_vote(marker, recipe_id)
	{
		//var country = escape($F("SelectCountry"));
		var url = '<?=$baseurl?>ratings/act';
		var pars = {marker: marker, recipe_id:recipe_id};
		var myAjax = new Ajax.Request(
					url, 
					 {
						method: 'post', 
						parameters: pars, 
						onComplete: showResponse
					 }
					);
	
	 function showResponse(originalRequest)
	{
		var returned = originalRequest.responseText;
		$(recipe_id).update(returned).addClassName('highlight')
	}		
	}
		
</script>

<script language="javascript" type="text/javascript">
    
	function ShowFullSizePhotoDiv(show, e)
	{
				
	var FullSizePhotoDiv = document.getElementById("FullSizePhotoDiv");
	
	if (document.all) 
		{
			X = event.clientX;
			Y = event.clientY;
		}
	else 
		{
			X = e.pageX + "px";
			Y = e.pageY + "px";
		}

		if(show == 1)
			{
				FullSizePhotoDiv.style.left = X;
				FullSizePhotoDiv.style.top = Y;
				
				FullSizePhotoDiv.style.display = "block";
				
			}
		else
			{
				setTimeout("hideFullSizePhotoDiv()", 1000);
			}
		
	}
	
	function hideFullSizePhotoDiv()
	{
		var FullSizePhotoDiv = document.getElementById("FullSizePhotoDiv");
		FullSizePhotoDiv.style.display = "none";
	}
	
	function showYourCommentDiv()
	{
		var FullSizePhotoDiv = document.getElementById("YourCommentDiv");
		FullSizePhotoDiv.style.display = "block";
	}
	
	window.onload = function() {
    addButton("btnAddComment" ,"vgViewRecipe");

	addValidatorRegEx("comment", "errorDivComment", "^.{5,1500}$", "vgViewRecipe");

    addSubmitButton("lnkAddComment", "vgViewRecipe");
	}

</script>

<div class="MainDivProfile">
    <table cellpadding="0" cellspacing="0" class="MainTableProfile">
        <tr>
            <td colspan="2" class="UserStatus">
                {ViewRecipeTitle}
            </td>
        </tr>
        <tr>
            <td class="Dialog Message">
                <table>
                    <tr>
                        <td class="Headers">
                            {RecipePhoto}:
                        </td>
                        <td class="Headers">
                            {MainData}:
                        </td>
                    </tr>
                    <tr>
                        <td class="ViewRecipeTD">
                            <img src="{RecipeImgUrl}" class="RecipeImg" onmousemove="ShowFullSizePhotoDiv(1, event)"
                                onmouseout="ShowFullSizePhotoDiv(0, event)" />
                        </td>
                        <td class="ViewRecipeTD">
                            <table cellpadding="0" cellspacing="0" class="UserTable">
                                <tr>
                                    <td colspan="2">
                                        <table cellpadding="0" cellspacing="0" class="UserTable">
                                            <tr>
                                                <td>
                                                    <a href="{LinkToUserProfile}">
                                                        <img src="{UserImgUrl}" class="FriendAvatar" /></a>
                                                </td>
                                                <td class="LinkToUser">
                                                    <a href="{LinkToUserProfile}">{NameOfAuthor}</a>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="LabelText LableTextViewRecipe">
                                        {AddedDateLabel}:
                                    </td>
                                    <td class="LableValue LableValueViewRecipe">
                                        {AddedDateValue}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="LabelText LableTextViewRecipe">
                                        {CategoryNameLabel}:
                                    </td>
                                    <td class="LableValue LableValueViewRecipe">
                                        {CategoryNameValue}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="LabelText LableTextViewRecipe">
                                        {KitchenNameLabel}:
                                    </td>
                                    <td class="LableValue LableValueViewRecipe">
                                        {KitchenNameValue}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="LabelText LableTextViewRecipe">
                                        {RatingLabel}:
                                    </td>
                                    <td class="LableValue LableValueViewRecipe">
                                        <div id="{recipe_id}">{RatingValue}</div>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <table class="ViewRecipeTableArrow">
                                            <tr>
                                                <td>
                                                  <a href="#"><img src="{UpArrowImgUrl}" onclick="ajax_vote('+', '{recipe_id}')" class="ArrowImgLink"/></a>
                                                </td>
                                                <td>
                                                  <a href="#"><img src="{DownArrowImgUrl}" onclick="ajax_vote('-', '{recipe_id}')" class="ArrowImgLink"/></a>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                                <tr>
									<td>
									</td>
                                    <td>
                                        {ButtonEdit}
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td class="Headers">
                            {IngredientsText}:
                        </td>
                        <td class="Headers">
                            {RecipeText}:
                        </td>
                    </tr>
                    <tr>
                        <td class="ViewRecipeTD">
                            {IngredientsValue}
                        </td>
                        <td class="ViewRecipeTD">
                            {RecipeValue}
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
							<a name="comments"></a>
                            <a href="javascript:showYourCommentDiv()">{YourComment}</a>
                            <div id="YourCommentDiv" class="YourCommentDiv">
                                <table width="100%">
                                    <tr>
                                        <td colspan="2">
                                            <form name="comment_form" method="POST" action="/comments/new_comment/">
                                            <textarea id ="comment" name="comment" rows="2" cols="20" class="CommentsTextBox"></textarea>
                                            <input type="hidden" name="recipe_id" value="{recipe_id}" />

                                        </td>
                                    </tr>
									<tr>
										<td colspan="2">
											<div id="errorDivComment" class="Registraion_validator">
												{errorDivComment}
											</div>
										</td>
									</tr>
                                    <tr>
                                        <td class="ViewRecipeCommentTD">
                                        </td>
                                        <td class="btnAddCommentTD">
                                            <a href="#comments" id="lnkAddComment" name="lnkAddComment" onclick="document.getElementById('btnAddComment').click();">
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
                            </div>
                            <br />
                            <br />
                            {CommentsBuilder}
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</div>
<div id="FullSizePhotoDiv" class="FullSizePhotoDiv">
    <table>
        <tr>
            <td class="UserStatus">
                {FullSizePhotoDivTitle}
            </td>
        </tr>
        <tr>
            <td>
                <img src="{RecipeImgUrl}" />
            </td>
        </tr>
    </table>
</div>
