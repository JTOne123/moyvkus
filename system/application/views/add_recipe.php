<div class="MainDivProfile">
	<table class="MainTableProfile">
		<tr>
			<td colspan="2" class="UserStatus">
				{NewRecipeTitle}
			</td>
		</tr>
		<tr>
			<td class="LabelText LabelValueMessage LabelValueEdit">
				<?=form_open_multipart('add_recipe'); ?>
				{NameOfRecipe}: 
			</td>
			<td class="LableValue LableValueFriends">
				<input type="text" name="name" value="<?=$name?><?=$this->validation->name;?>" size="30">
			</td>
		</tr>
		<tr>
			<td class="LabelText LabelValueMessage LabelValueEdit">
				{CategoryOfRecipe}:
			</td>
			<td class="LableValue LableValueFriends">
				{categorys}
			</td>
		</tr>
		<tr>
			<td class="LabelText LabelValueMessage LabelValueEdit">
				{KitchenOfRecipe}:
			</td>
			<td class="LableValue LableValueFriends">
				 {kitchens}
			</td>
		</tr>
		<tr>
			<td class="LabelText LabelValueMessage LabelValueEdit">
				{PortionsOfRecipe}:
			</td>
			<td class="LableValue LableValueFriends">
				<input type="text" name="portions" value="<?=$portions?>" size="3"> {PortionsQttyOfRecipe}
			</td>
		</tr>
		<tr>
			<td class="LabelText LabelValueMessage LabelValueEdit">
				{IngredientsOfRecipe}:
			</td>
			<td class="LableValue LableValueFriends">
				<textarea rows="5" name="ingredients" cols="40"><?=$ingredients?><?=$this->validation->ingredients;?></textarea>
			</td>
		</tr>
		<tr>
			<td class="LabelText LabelValueMessage LabelValueEdit">
				{TextOfRecipe}:
			</td>
			<td class="LableValue LableValueFriends">
				<textarea rows="5" name="receipe_text" cols="40"><?=$recipe_text?><?=$this->validation->receipe_text;?></textarea>
			</td>
		</tr>
		<tr>
			<td class="LabelText LabelValueMessage LabelValueEdit">
				<img id="photo" src="{photo}"/>
			</td>
			<td class="LableValue LableValueFriends">
				<input type="file" name="userfile" size="15" />
			</td>
		</tr>
		<tr>
			<td class="LabelText LabelValueMessage LabelValueEdit">
				{update_or_insert}
				{id_of_recipe}
			</td>
			<td class="LableValue LableValueFriends">
				<input type="submit" value="{Save}" name="submit">
			</td>
		</tr>
		<tr>
			<td colspan="2">
				</form>
				<?=$this->validation->portions_error; ?>
				<?=$this->validation->name_error; ?>
				<?=$this->validation->ingredients_error; ?>
				<?=$this->validation->receipe_text_error; ?>
			</td>
		</tr>
	</table>
</div>