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
        <table cellpadding="0" cellspacing="0" class="MainTableProfile Friends">
            <tr>
                <td class="UserStatus">
                {NameOfAuthor} - {MyBlog}
                </td>
            </tr>
            <tr>

            </tr>
            <tr>
                <td class="FriendsCount">
                    <div align="right">{EditPostBut}</div> {PostTitle}
                </td>
            </tr>
            <tr>
                <td class="FriendsBuilder">
                    {PostText}
                    
                    <p>
                    <div align="left"><script src="http://odnaknopka.ru/ok3.js" type="text/javascript"></script></div>
                </td>
            </tr>
             <tr>
                <td colspan="2">
                    <br />
                    <br />
                    <a name="comments"></a>
                    <a href="javascript:showYourCommentDiv()"><b>{YourComment}</b></a>
                    <div id="YourCommentDiv" class="YourCommentDiv">
                        <table width="100%">
                            <tr>
                                <td colspan="2">
                                    <form name="comment_form" method="POST" action="/comments/new_comment_blog/">
                                    <textarea id ="comment" name="comment" rows="2" cols="20" class="CommentsTextBox"></textarea>
                                    <input type="hidden" name="blog_id" value="{blog_id}" />

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
    </div>