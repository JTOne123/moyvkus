<script src="<?=$baseurl?>js/prototype.js"></script>
	 <script>
	function ajax_locator_country()
	{
		var country = escape($F("SelectCountry"));
		var url = '<?=$baseurl?>/search/ajax_locator_country';
		var pars = {countryID: country};
		
		var myAjax = new Ajax.Request(
					url, 
					 {
						method: 'post', 
						parameters: pars, 
						onComplete: showResponse
					 }
					);
	
	 function showResponse(originalRequest)
	{
		var returned = originalRequest.responseText;
		
		$("SelectRegion").insert({ top: returned });
	    //$("SelectRegion").insert({ top: "<option selected></option>" });
	}		
	}
	
	function ajax_locator_region()
	{
		var region = escape($F("SelectRegion"));
		var url = '<?=$baseurl?>/search/ajax_locator_region';
		var pars = {regionID: region};
		
		var myAjax = new Ajax.Request(
					url, 
					 {
						method: 'post', 
						parameters: pars, 
						onComplete: showResponseReg
					 }
					);
	
	 function showResponseReg(originalRequest)
	{
		var returned = originalRequest.responseText;
		
		$("SelectCity").insert({ top: returned });
		//$("SelectCity").insert({ top: "<option selected></option>" });
	}		
	}
	
</script>

<div class="MainDivProfile">
        <table cellpadding="0" cellspacing="0" class="MainTableProfile Friends">
            <tr>
                <td class="UserStatus">
                    {Search}
                </td>
            </tr>
            <tr>
                <td class="SearchTable">
                    <table>
                        <tr>
                            <td class="LabelText">
                                {SearchOption}
                            </td>
                            <td class="LabelValueSearchType">
                                <input id="SearchUsersType" name="SearchType" type="radio" onclick="ShowSearch();" checked />{SearchUsers}
                            </td>
                            <td class="LabelValueSearchType">
                                <input id="SearchRecipiesType" name="SearchType" type="radio" onclick="ShowSearch();" />{SearchRecipies}
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td class="SearchTable">
                    <div id="SearchUsers" class="SearchHiddenDiv" style="display: block;">
                        <table>
                            <tr>
                                <td class="SearchText">
                                    {SimpleSearch}
                                </td>
                                <td>
									<table cellpadding="0" cellspacing="0">
										<tr>
											<td>
											    <form id="SearchSimpleUsersForm" method="POST" action="/search/users_simple">
												<input type="text" name="txtSimpleSearchUsers" id="txtSimpleSearchUsers" class="LabelValueSearch" />
												</form>
											</td>
										</tr>
										<tr>
											<td>
												<span class="SimpleSearchDescription">{SimpleSearchDescriptionUser}</span>
											</td>
										</tr>
									</table>
                                </td>
                                <td class="SearchText">

                                    <a href="#" id="FriendFilterSubmit" name="FriendFilterSubmit" onclick="document.forms['SearchSimpleUsersForm'].submit();">
                                        <div class="Login_submit">
                                            {SearchButton}
                                        </div>
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td class="SeparateTD" colspan="3">
                                </td>
                            </tr>
                            <tr>
                                <td colspan="3">
                                    <a href="javascript:ShowAdvancedSearchUsers()"><b>{AdvancedSearch}</b></a>
                                </td>
                            </tr>
                        </table>
                        <div id="AdvancedSearchUsers" class="SearchHiddenDiv">
							<form id="SearchAdvancedUsersForm" method="POST" action="/search/users_advanced">
								<table class="AdvancedSearchTable">
									<tr>
										<td colspan="2" align="center">
											<div class="Note NoteSearchWidth">
												<table>
													<tr>
														<td>
															<b>{NoteSearch}</b>
														</td>
													</tr>
													<tr>
														<td>
															{NoteSearchAnswerUsers}
														</td>
													</tr>
												</table>
											</div>
										</td>
									</tr>
									<tr>
										<td class="LabelText">
											{FirstName}
										</td>
										<td class="LableValue">
											<input type="text" name="txtFirstName" id="Text2" class="LabelValueSearch" />
										</td>
									</tr>
									<tr>
										<td class="LabelText">
											{LastName}
										</td>
										<td class="LableValue">
											<input type="text" name="txtLastName" id="Text3" class="LabelValueSearch" />
										</td>
									</tr>
									<tr>
										<td class="LabelText">
											{Sex}
										</td>
										<td class="LableValue">
											<input type="radio" id="txtSexMan" name="txtSex" value="0" />{Man}&nbsp;
											<input type="radio" id="txtSexWoman" name="txtSex" value="1" />{Woman}
										</td>
									</tr>
									<tr>
										<td class="LabelText">
											{LocationText}
										</td>
										<td class="LableValue">
											<table class="TableWithSelects">
												<tr>
													<td class="LabelValueEditProfile">
														{Country}
													</td>
													<td>
														{SelectCountry}
													</td>
												</tr>
												<tr>
													<td class="LabelValueEditProfile">
														{Region}
													</td>
													<td>
														{SelectRegion}
													</td>
												</tr>
												<tr>
													<td class="LabelValueEditProfile">
														{City}
													</td>
													<td>
														{SelectCity}
													</td>
												</tr>
											</table>
									</tr>
									<tr>
										<td class="SeparateTD" colspan="2">
										</td>
									</tr>
									<tr>
										<td colspan="2" align="center">
											<div class="SearchButtonDiv">
												<a href="#" id="A2" name="FriendFilterSubmit" onclick="document.forms['SearchAdvancedUsersForm'].submit();">
													<div class="Login_submit">
														{SearchButton}
													</div>
												</a>
											</div>
										</td>
									</tr>
								</table>
						</form>
                        </div>
                    </div>
                    <div id="SearchRecipies" class="SearchHiddenDiv">
                        <table>
                            <tr>
                                <td class="SearchText">
                                    {SimpleSearch}
                                </td>
                                <td>
									<table cellpadding="0" cellspacing="0">
										<tr>
											<td>
											    <form id="SearchSimpleRecipesForm" method="POST" action="/search/recipes_simple">
													<input type="text" name="txtSimpleSearchRecipies" id="txtSimpleSearchRecipies" class="LabelValueSearch" />
											    </form>
											</td>
										</tr>
										<tr>
											<td>
												<span class="SimpleSearchDescription">{SimpleSearchDescriptionRecipies}</span>
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
                            <tr>
                                <td class="SeparateTD" colspan="3">
                                </td>
                            </tr>
                            <tr>
                                <td colspan="3">
                                    <a href="javascript:ShowAdvancedSearchRecipies()"><b>{AdvancedSearch}</b></a>
                                </td>
                            </tr>
                        </table>
                        <div id="AdvancedSearchRecipies" class="SearchHiddenDiv">
							<form id="SearchAdvancedRecipesForm" method="POST" action="/search/recipes_advanced">
								<table class="AdvancedSearchTable">
									<tr>
										<td colspan="2" align="center">
											<div class="Note NoteSearchWidth">
												<table>
													<tr>
														<td>
															<b>{NoteSearch}</b>
														</td>
													</tr>
													<tr>
														<td>
															{NoteSearchAnswerRecipies}
														</td>
													</tr>
												</table>
											</div>
										</td>
									</tr>
									<tr>
										<td class="LabelText">
											{RecipeName}:
										</td>
										<td class="LableValue">
											<input type="text" name="txtRecipeName" class="LabelValueSearch" />
										</td>
									</tr>
									<tr>
										<td class="LabelText">
											{Indigridients}
										</td>
										<td class="LableValue">
											<input type="text" name="txtIndigridients" class="LabelValueSearch" />
										</td>
									</tr>
									<tr>
										<td class="LabelText">
											{RecipeText}
										</td>
										<td class="LableValue">
											<input type="text" name="txtRecipeText" id="Text6" class="LabelValueSearch" />
										</td>
									</tr>
									<tr>
										<td colspan="2" align="center">
											<div class="SearchButtonDiv">
												<a href="#" id="A3" name="FriendFilterSubmit" onclick="document.forms['SearchAdvancedRecipesForm'].submit();">
													<div class="Login_submit">
														{SearchButton}
													</div>
												</a>
											</div>
										</td>
									</tr>
								</table>
							</form>
                        </div>
                </td>
            </tr>
            <tr>
                <td class="FriendsCount">
                    {SearchResultCount}
                </td>
            </tr>
            <tr>
                <td class="FriendsBuilder">
                    {SearchItemsListBuilder}
                </td>
            </tr>
			<tr>
				<td>
					<div align="center">{paginator}</div>
				</td>
			</tr>
        </table>
    </div>
	
	<script language="javascript" type="text/javascript">
    	
	window.onload = function(){
		ShowSearch()
	};
	
    function ShowSearch()
    {
		var SearchUsersType = document.getElementById("SearchUsersType");
        var SearchUsers = document.getElementById("SearchUsers");
		var SearchRecipies = document.getElementById("SearchRecipies");

		if(SearchUsersType.checked)
		{
            SearchUsers.style.display = "block";
		    SearchRecipies.style.display = "none";
		}
        else
		{
            SearchUsers.style.display = "none";
			SearchRecipies.style.display = "block";
		}


    }
	
    function ShowAdvancedSearchUsers()
    {
        var AdvancedSearchUsers = document.getElementById("AdvancedSearchUsers");
        if(AdvancedSearchUsers.style.display != "block")
            AdvancedSearchUsers.style.display = "block";
        else
            AdvancedSearchUsers.style.display = "none";

    }
    
    function ShowAdvancedSearchRecipies()
    {
        var AdvancedSearchRecipies = document.getElementById("AdvancedSearchRecipies");
        if(AdvancedSearchRecipies.style.display != "block")
            AdvancedSearchRecipies.style.display = "block";
        else
            AdvancedSearchRecipies.style.display = "none";
    }
    
    </script>