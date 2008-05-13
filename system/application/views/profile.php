<div class="MainDivProfile">
        <table cellpadding="0" cellspacing="0" class="MainTableProfile">
            <tr>
                <td colspan="3" class="UserStatus">
					<table class="ProfileHeaderTable">
						<tr>
							<td class="UserStatusInHeaderTable">
								{UserStatus}
							</td>
							<td class="UserStatusInHeaderTable UserStatusEdit">
								<a href="{EditProfileUrl}" >{Edit}</a>
							</td>
						</tr>
					</table>
                </td>
            </tr>
            <tr>
                <td valign="top" colspan="2">
                    <div class="LeftColumn">
                        <table cellpadding="0" cellspacing="5" class="LeftTableProfile">
                            <tr>
                                <td class="Headers">
                                    {Avatar}
                                </td>
                            </tr>
                            <tr>
                                <td class="Avatar">
                                    <img id="avatar" src="{AvatarUrl}"/>
                                </td>
                            </tr>
                            <tr>
                                <td class="Headers">
                                    {MyFriendsHeader}
                                </td>
                            </tr>
                            <tr>
                                <td>
									<table class="MyFunctionsTable">
										<tr style="display:{SendMessageShow}">
											<td>
												<a href="{SendMessageUrl}">
													<div class="Login_submit">
														{SendMessage}
													</div>
												</a>
											</td>
										</tr>
										<tr style="display:{AddToFriendsShow}">
											<td>
												<a href="{AddToFriendsUrl}">
													<div class="Login_submit">
														{AddToFriends}
													</div>
												</a>
											</td>
										</tr>
										<tr style="display:{DeleteFromFriendsShow}">
											<td>
												<a href="{DeleteFromFriendsUrl}">
													<div class="Login_submit">
														{DeleteFromFriends}
													</div>
												</a>
											</td>
										</tr>
										<tr>
											<td>
												<a href="{FriendsUrl}">
													<div class="Login_submit">
														{Friends}
													</div>
												</a>
											</td>
										</tr>
									</table>
                                </td>
                            </tr>
                        </table>
                    </div>
                </td>
                <td valign="top">
                    <div class="RightColumn">
                        <table cellpadding="0" cellspacing="5" class="RightTableProfile">
                            <tr>
                                <td class="Headers">
                                    {MyData}
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <table cellpadding="0" cellspacing="0">
                                        <tr>
                                            <td class="LabelText">
                                                {FirstNameText}
                                            </td>
                                            <td class="LableValue">
                                                {FirstName}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="LabelText">
                                                {LastNameText}
                                            </td>
                                            <td class="LableValue">
                                                {LastName}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="LabelText">
                                                {SexText}
                                            </td>
                                            <td class="LableValue">
                                                {Sex}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="LabelText">
                                                {BirthdayText}
                                            </td>
                                            <td class="LableValue">
                                                {Birthday}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="LabelText">
                                                {LoctionText}
                                            </td>
                                            <td class="LableValue">
                                                {Loction}
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td class="Headers">
                                    {Contacts}
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <table cellpadding="0" cellspacing="0">
                                        <tr>
                                            <td class="LabelText">
                                                {WebSiteText}
                                            </td>
                                            <td class="LableValue">
												<a href="http://{WebSite}">{WebSite}</a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="LabelText">
                                                {InstantMessagerText}
                                            </td>
                                            <td class="LableValue">
                                                {InstantMessager}
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td class="Headers">
                                    {MyInfo}
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <table cellpadding="0" cellspacing="0">
                                        <tr>
                                            <td class="LabelText">
                                                {ActivitiesText}
                                            </td>
                                            <td class="LableValue">
                                                {Activities}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="LabelText">
                                                {InterestsText}
                                            </td>
                                            <td class="LableValue">
                                                {Interests}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="LabelText">
                                                {AboutText}
                                            </td>
                                            <td class="LableValue">
                                                {About}
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td class="Headers">
                                    {MyRatingTextHeader}
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <table cellpadding="0" cellspacing="0">
                                        <tr>
                                            <td class="LabelText">
                                                {MyRatingText}
                                            </td>
                                            <td class="LableValue">
                                                {MyRating}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="LabelText">
                                                {MyRatingLevelText}
                                            </td>
                                            <td class="LableValue">
                                                {MyRatingLevel}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="LabelText">
                                                {MyBestRecipesText}
                                            </td>
                                            <td class="LableValue">
                                                <a href="#">{MyBestRecipe}</a>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td class="Headers">
                                    {MyRecipes}
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    {UserRecipes}
                                    {id} - {name} <br>
								    {/UserRecipes}
                                </td>
                            </tr>
                        </table>
                    </div>
                </td>
            </tr>
        </table>
    </div>