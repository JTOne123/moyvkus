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
					   <td class="ViewRecipeTD">
						   <img src="{RecipeImgUrl}" />
					   </td>
					   <td class="ViewRecipeTD">
						   <table>
							   <tr>
								   <td colspan="2">
									   <a href="{LinkToUserProfile}"><img src="{UserImgUrl}" /></a>
									   <br>
									   <a href="{LinkToUserProfile}">{NameOfAuthor}</a>
								   </td>
							   </tr>
							   <tr>
								   <td class="LabelText LableValueViewRecipe">
									   {AddedDateLabel}:
								   </td>
								   <td class="LableValue">
									   {AddedDateValue}
								   </td>
							   </tr>
							   <tr>
								   <td class="LabelText LableValueViewRecipe">
									   {CategoryNameLabel}:
								   </td>
								   <td class="LableValue">
									   {CategoryNameValue}
								   </td>
							   </tr>
							   <tr>
								   <td class="LabelText LableValueViewRecipe">
									   {KitchenNameLabel}:
								   </td>
								   <td class="LableValue">
									   {KitchenNameValue}
								   </td>
							   </tr>
							   <tr>
								   <td class="LabelText LableValueViewRecipe">
									   {RatingLabel}:
								   </td>
								   <td class="LableValue">
									   {RatingValue}
								   </td>
							   </tr>
							   <tr>
								   <td colspan="2">
									   <table>
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
					   <td>
						   {IngredientsValue}
					   </td>
					   <td>
						   {RecipeValue}
					   </td>
				   </tr>
				   <tr>
					   <td colspan="2">
						   {CommentsBuilder}
					   </td>
				   </tr>
			   </table>
			</td>
		</tr>
	</table>
   </div>