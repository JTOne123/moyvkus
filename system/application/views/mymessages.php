    <div class="MainDivProfile">
        <table cellpadding="0" cellspacing="0" class="MainTableProfile Friends">
            <tr>
                <td class="UserStatus">
                    {MyMessages}
                </td>
            </tr>
            <tr>
                <td class="FriendsFilter">
                    <form id="MessagesFilterForm" method="POST" action="/mymessages">
                    </form>
                    <table>
                        <tr>
                            <td>
                                {MessagesFilter}
                            </td>
                            <td>
                                <input type="text" name="InputFriendsFilter" id="InputFriendsFilter" />
                            </td>
                            <td>
                                <a href="#" id="FriendFilterSubmit" name="FriendFilterSubmit" onclick="document.forms['MessagesFilterForm'].submit();">
                                    <div class="Login_submit">
                                        {Search}
                                    </div>
                                </a>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td class="FriendsCount">
                    {MessagesCount}
                </td>
            </tr>
            <tr>
                <td class="FriendsBuilder">
                    {MessageListBuilder}
                </td>
            </tr>
        </table>
    </div>
