<?=form_open_multipart('add_recipe'); ?>
<br>
<br>
{NameOfRecipe}: <input type="text" name="name" value="<?=$name?><?=$this->validation->name;?>" size="30">


<br>
<br>
{CategoryOfRecipe}: {categorys}
<br>
<br>
{KitchenOfRecipe}: {kitchens}

<br><br>
{PortionsOfRecipe}: <input type="text" name="portions" value="<?=$portions?>" size="3"> {PortionsQttyOfRecipe}
<br>
<br>
{IngredientsOfRecipe}: <textarea rows="5" name="ingredients" cols="40"><?=$ingredients?><?=$this->validation->ingredients;?></textarea>
<br>
<br>

{TextOfRecipe}: <textarea rows="5" name="receipe_text" cols="40"><?=$recipe_text?><?=$this->validation->receipe_text;?></textarea>

<br>
<br>
<br>
<img id="photo" src="{photo}"/>
<br>
<input type="file" name="userfile" size="15" />
{update_or_insert}
{id_of_recipe}
<br>
<br>
<input type="submit" value="{Save}" name="submit">
</form>

<?=$this->validation->portions_error; ?>
<?=$this->validation->name_error; ?>
<?=$this->validation->ingredients_error; ?>
<?=$this->validation->receipe_text_error; ?>