<script src="<?=$baseurl?>js/prototype.js"></script>
<script language="javascript" type="text/javascript">
    
    function ShowSearchUsers()
    {
        var SearchUsers = document.getElementById("SearchUsers");
        if(SearchUsers.style.display != "block")
            SearchUsers.style.display = "block";
        else
            SearchUsers.style.display = "none";

    }
    
    function ShowAdvancedSearchUsers()
    {
        var AdvancedSearchUsers = document.getElementById("AdvancedSearchUsers");
        if(AdvancedSearchUsers.style.display != "block")
            AdvancedSearchUsers.style.display = "block";
        else
            AdvancedSearchUsers.style.display = "none";

    }
    
    function ShowSearchRecipies()
    {
        var SearchRecipies = document.getElementById("SearchRecipies");
        if(SearchRecipies.style.display != "block")
            SearchRecipies.style.display = "block";
        else
            SearchRecipies.style.display = "none";

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
                                <input id="SearchUsersType" name="SearchType" type="radio" onclick="ShowSearchUsers();ShowSearchRecipies();"
                                    checked />{SearchUsers}
                            </td>
                            <td class="LabelValueSearchType">
                                <input id="SearchRecipiesType" name="SearchType" type="radio" onclick="ShowSearchRecipies();ShowSearchUsers();" />{SearchRecipies}
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
                                    <input type="text" name="InputFriendsFilter" id="InputFriendsFilter" class="LabelValueSearch" />
                                    <span class="SimpleSearchDescription">{SimpleSearchDescriptionUser}</span>
                                </td>
                                <td class="SearchText">
                                    <form id="SearchUsersForm" method="POST" action="/search/users">
                                    </form>
                                    <a href="#" id="FriendFilterSubmit" name="FriendFilterSubmit" onclick="document.forms['SearchUsersForm'].submit();">
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
                                        <input type="radio" id="txtSexMan" name="txtSex" value="txtSexMan" />{Man}&nbsp;
                                        <input type="radio" id="txtSexWoman" name="txtSex" value="txtSexWoman" />{Woman}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="LabelText">
                                        {LoctionText}
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
                                            <a href="#" id="A2" name="FriendFilterSubmit" onclick="document.forms['SearchUsersForm'].submit();">
                                                <div class="Login_submit">
                                                    {SearchButton}
                                                </div>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <div id="SearchRecipies" class="SearchHiddenDiv">
                        <table>
                            <tr>
                                <td class="SearchText">
                                    {SimpleSearch}
                                </td>
                                <td>
                                    <input type="text" name="InputFriendsFilter" id="Text1" class="LabelValueSearch" />
                                    <span class="SimpleSearchDescription">{SimpleSearchDescriptionUser}</span>
                                </td>
                                <td class="SearchText">
                                    <form id="SearchRecipiesForm" method="POST" action="/search/resipies">
                                    </form>
                                    <a href="#" id="A1" name="FriendFilterSubmit" onclick="document.forms['SearchRecipiesForm'].submit();">
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
                                        {RecipeName}
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
                                            <a href="#" id="A3" name="FriendFilterSubmit" onclick="document.forms['SearchRecipiesForm'].submit();">
                                                <div class="Login_submit">
                                                    {SearchButton}
                                                </div>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            </table>
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
        </table>
    </div>