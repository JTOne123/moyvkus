    <div class="MainDivProfile">
        <table cellpadding="0" cellspacing="0" class="MainTableProfile Friends">
            <tr>
                <td class="UserStatus">
                {NameOfAuthor} - {MyRecipes}
                </td>
            </tr>
            <tr>
                <td class="FriendsFilter">
                    <form id="FriendsFilterForm" method="POST" action="/myfriends/id/{UserID}" class="FriendsFilterForm">
						<table>
							<tr>
								<td>
									{RecipesFilter}
								</td>
								<td>
									<input type="text" name="InputFriendsFilter" id="InputFriendsFilter" />
								</td>
								<td>
									<a href="#" id="FriendFilterSubmit" name="FriendFilterSubmit" onclick="document.forms['FriendsFilterForm'].submit();">
										<div class="Login_submit">
											{Search}
										</div>
									</a>
								</td>
							</tr>
						</table>
					</form>

                </td>
            </tr>
            <tr>
                <td class="FriendsCount">
                    {RecipesCount}
                </td>
            </tr>
            <tr>
                <td class="FriendsBuilder">
                    {RecipesBuilder}
                    
                    <div align="center">{paginator}</div>
                </td>
            </tr>
        </table>
    </div>