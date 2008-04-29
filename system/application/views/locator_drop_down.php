<?php 
if(isset($regions))
{
foreach ($regions as $id=>$region) : ?>
<option value="<?=$id?>"><?=$region?></option>
<?php endforeach; 
}?>


<?php 
if(isset($citys))
{
foreach ($citys as $id=>$name) : ?>
<option value="<?=$id?>"><?=$name?></option>
<?php endforeach; 
}?>