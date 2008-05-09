    <div class="MainDivProfile">
        <table cellpadding="0" cellspacing="0" class="MainTableProfile Friends">
            <tr>
                <td class="UserStatus">
                    {MyFriends}
                </td>
            </tr>
            <tr>
                <td class="FriendsFilter">
                    <form id="FriendsFilterForm" method="POST" action="/myfriends/id/{UserID}" class="FriendsFilterForm">
						<table>
							<tr>
								<td>
									{FriendsFilter}
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
                    {FriendsCount}
                </td>
            </tr>
            <tr>
                <td class="FriendsBuilder">
                    {FriendsBuilder}
                </td>
            </tr>
        </table>
    </div>