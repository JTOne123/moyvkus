<table class="SearchRecipePanel">
    <tr>
        <td class="SearchTextMain">
            {SimpleSearchRecipe}
        </td>
        <td>
			<table cellpadding="0" cellspacing="0">
				<tr>
					<td>
					    <form id="SearchSimpleRecipesForm" method="POST" action="/search/recipes_simple" class="NormalForm">
							<table cellpadding="0" cellspacing="0">
								<tr>
									<td>
										<input type="text" name="txtSimpleSearchRecipies" id="txtSimpleSearchRecipies" class="LabelValueSearch" />
									</td>
								</tr>
								<tr>
									<td>
										<span class="SimpleSearchDescription">{SimpleSearchDescriptionRecipies}</span>
									</td>
								</tr>
							</table>		
						</form>
					</td>
				</tr>
			</table>
        </td>
        <td class="SearchText">
            <a href="#" id="A1" name="FriendFilterSubmit" onclick="document.forms['SearchSimpleRecipesForm'].submit();">
                <div class="Login_submit">
                    {SearchButton}
                </div>
            </a>
        </td>
    </tr>
</table>