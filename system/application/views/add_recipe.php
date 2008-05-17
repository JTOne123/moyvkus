 <script language="javascript" type="text/javascript">
    window.onload = function() {
    addButton("btnSave" ,"vgAddRecipe");

	addValidatorRegEx("name", "errorDivName", "^.{5,300}$", "vgAddRecipe");
    addValidatorRegEx("portions", "errorDivPortions", "^\\d+$", "vgAddRecipe");
	addValidatorRegEx("ingredients", "errorDivIngredients", "^.{25,2000}$", "vgAddRecipe");
    addValidatorRegEx("receipe_text", "errorDivRecipeText", "^.{100,3000}$", "vgAddRecipe");

    addSubmitButton("lnkSave", "vgAddRecipe");
    }
 </script>

<div class="MainDivProfile">
	<table cellpadding="0" cellspacing="0" class="MainTableProfile">
		<tr>
			<td colspan="2" class="UserStatus">
				{NewRecipeTitle}
			</td>
		</tr>
		<tr>
			<td class="Dialog Message">
				<table>
					<tr>
						<td class="LabelText LabelValueMessage LabelValueEdit">
							<?=form_open_multipart('add_recipe'); ?>
							{NameOfRecipe}: 
						</td>
						<td class="LableValue LableValueAddRecipe">
							<input type="text" id="name" name="name" value="<?=$name?><?=$this->validation->name;?>" size="30" class="RecipeInput">
							<?=$this->validation->name_error; ?>
							<div id="errorDivName" class="Registraion_validator_more_height">
								{errorDivName}
							</div>
						</td>
					</tr>
					<tr>
						<td class="LabelText LabelValueMessage LabelValueEdit">
							{CategoryOfRecipe}:
						</td>
						<td class="LableValue LableValueAddRecipe">
							{categorys}
						</td>
					</tr>
					<tr>
						<td class="LabelText LabelValueMessage LabelValueEdit">
							{KitchenOfRecipe}:
						</td>
						<td class="LableValue LableValueAddRecipe">
							 {kitchens}
						</td>
					</tr>
					<tr>
						<td class="LabelText LabelValueMessage LabelValueEdit">
							{PortionsOfRecipe}:
						</td>
						<td class="LableValue LableValueAddRecipe">
							<input type="text" id="portions" name="portions" value="<?=$portions?>" size="3" class="RecipeInputPortions"> {PortionsQttyOfRecipe}
							<?=$this->validation->portions_error; ?>
							<div id="errorDivPortions" class="Registraion_validator">
								{errorDivPortions}
							</div>
						</td>
					</tr>
					<tr>
						<td class="LabelText LabelValueMessage LabelValueEdit">
							{IngredientsOfRecipe}:
						</td>
						<td class="LableValue LableValueAddRecipe">
							<textarea rows="5" id="ingredients" name="ingredients" cols="40" class="RecipeInput"><?=$ingredients?><?=$this->validation->ingredients;?></textarea>
							<?=$this->validation->ingredients_error; ?>
							<div id="errorDivIngredients" class="Registraion_validator_more_height">
								{errorDivIngredients}
							</div>
						</td>
					</tr>
					<tr>
						<td class="LabelText LabelValueMessage LabelValueEdit">
							{TextOfRecipe}:
						</td>
						<td class="LableValue LableValueAddRecipe">
							<textarea rows="5" id="receipe_text" name="receipe_text" cols="40" class="RecipeInput"><?=$recipe_text?><?=$this->validation->receipe_text;?></textarea>
							<?=$this->validation->receipe_text_error; ?>
							<div id="errorDivRecipeText" class="Registraion_validator_more_height">
								{errorDivRecipeText}
							</div>
						</td>
					</tr>
					<tr>
						<td class="LabelText LabelValueMessage LabelValueEdit">
						</td>
						<td class="LableValue LableValueAddRecipe">
							<img id="photo" src="{photo}" style="display:{ShowPhoto}"/>
						</td>
					</tr>
					<tr>
						<td class="LabelText LabelValueMessage LabelValueEdit">
							{RecipeImgText}
						</td>
						<td class="LableValue LableValueAddRecipe">
							<input type="file" name="userfile" size="40" class="RecipeInput"/>
						</td>
					</tr>
					<tr>
						<td class="LabelText LabelValueMessage LabelValueEdit">
						</td>
						<td class="LableValue LableValueAddRecipe ButtonAddRecipeWidth">
							<a href="#" id="lnkSave" onclick="document.getElementById('btnSave').click();">
								<div class="Login_submit">
									{Save}
								</div>
							</a>
							<input type="submit" value="{Save}" id="btnSave" name="submit" style="display:none;">
						</td>
					</tr>
					<tr>
						<td colspan="2">
							</form>
						</td>
					</tr>
				</table>
			</td>
		</tr>
	</table>
</div>