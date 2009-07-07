 <div class="MainDivProfile">
        <form id="MessageForm" method="POST" action="/message">
        <table cellpadding="0" cellspacing="0" class="MainTableProfile Friends">
            <tr>
                <td class="UserStatus">
                    {GetMessage}
                </td>
            </tr>
            <tr>
                <td class="Dialog Message">
                    <table>
                        <tr>
                            <td colspan="2" class="MessageTitle">
                                {GetMessage}
                            </td>
                        </tr>
                        <tr>
                            <td valign="top">
                                <img src="{AvatarUrl}" title="{FriendFullName}" class="MessageAvatar" />
                            </td>
                            <td class="MessageTd">
                                <table class="Message">
                                    <tr>
                                        <td class="LabelText LabelTextMessage">
                                            {From}
                                        </td>
                                        <td class="LableValue LabelValueMessage">
                                            <a href="{UserUrl}">{UserFullName}</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="LabelText LabelTextMessage">
                                            {To}
                                        </td>
                                        <td class="LableValue LabelValueMessage">
                                            <a href="{FriendUrl}">{FriendFullName}</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="LabelText LabelTextMessage">
                                            {Subject}
                                        </td>
                                        <td class="LableValue LabelValueMessage">
                                            {SubjectValue}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="LabelText LabelTextMessage">
                                            {Text}
                                        </td>
                                        <td class="LableValue LabelValueMessage">
                                            {TextValue}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                        </td>
                                        <td>
                                            <table class="GetMessageButtonsTable">
                                                <tr>
                                                    <td>
                                                        <a href="{AnswerUrl}" id="lnkAnswer" name="lnkAnswer">
                                                            <div class="Login_submit">
                                                                {Answer}
                                                            </div>
                                                        </a>
                                                    </td>
                                                    <td>
                                                        <a href="{MessageDeleteUrl}" id="lnkDelete" name="lnkDelete">
                                                            <div class="Login_submit">
                                                                {Delete}
                                                            </div>
                                                        </a>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            {HistoryRepeater}
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
        </form>
    </div>