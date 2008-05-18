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
							{RecipePhoto}
						 </td>
						 <td class="Headers">
							{MainData}
						 </td>
				   </tr>
				   <tr>
					   <td class="ViewRecipeTD" >
						   <img src="{RecipeImgUrl}" class="RecipeImg"  onmousemove="ShowFullSizePhotoDiv(1, event)" onmouseout="ShowFullSizePhotoDiv(0, event)"/>
					   </td>
					   <td class="ViewRecipeTD">
						   <table cellpadding="0" cellspacing="0" class="UserTable">
							   <tr>
								   <td colspan="2">
								         <table cellpadding="0" cellspacing="0" class="UserTable">
											<tr>
												<td>
													<a href="{LinkToUserProfile}">
													<img src="{UserImgUrl}" class="FriendAvatar"/></a>
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
									   {RatingValue}
								   </td>
							   </tr>
							   <tr>
								   <td colspan="2">
									   <table class="ViewRecipeTableArrow">
										   <tr>
											   <td>
												   <img src="{UpArrowImgUrl}" />
											   </td>
											   <td>
												   <img src="{DownArrowImgUrl}" />
											   </td>
										   </tr>
									   </table>
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
					   
					   		{YourComment}:<br>
					   	   <form method="POST" action="/comments/new_comment/">
					       <textarea rows="2" name="comment" cols="20"></textarea>
					       <input type="hidden" name="recipe_id" value="{recipe_id}" />
					       <br>
					       <input type="submit" value="{SubmitCommentForm}" name="Submit">
					       </form>
					   		
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
					<img src="{RecipeImgUrl}"/>
				</td>
			</tr>
		</table>
	</div>