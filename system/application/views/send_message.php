    <div class="MainDivProfile">
        <form id="MessageForm" method="POST" action="/send_message/send_to/id/{sended_to_id}">
        <table cellpadding="0" cellspacing="0" class="MainTableProfile Friends">
            <tr>
                <td class="UserStatus">
                    {NewMessage}
                </td>
            </tr>
            <tr>
                <td class="Dialog Message">
                    <table>
                        <tr>
                            <td colspan="2" class="MessageTitle">
                                {NewMessage}
                            </td>
                        </tr>
                        <tr>
                            <td valign="top">
                                <img src="{AvatarUrl}" title="{FriendFullName}" class="MessageAvatar" />
                            </td>
                            <td class="MessageTd">
                                <table class="Message" style="width:100%;height:100%">
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
                                            <input id="txtSubject" name="txtSubject" type="text" size="35" class="MessageSubject" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="LabelText LabelTextMessage">
                                            {Text}
                                        </td>
                                        <td class="LableValue LabelValueMessage">
                                            <textarea id="txtText" name="txtText" class="MessageSubject" rows="6"></textarea>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
						<tr>
							<td colspan="2">
					          <table class="MessageButtons">
                                        <tr>
                                            <td>
                                                <a href="#" id="lnkSend" name="lnkSend" onclick="document.forms['MessageForm'].btnSend.click();">
                                                    <div class="Login_submit">
                                                        {Send}
                                                    </div>
                                                </a>
												<input id="btnSend" name="btnSend" type="submit" value="true" style="display: none;"/>
                                            </td>
                                            <td>
                                                <a href="javascript:history.back(1)" id="lnkCancel" name="lnkCancel">
                                                    <div class="Login_submit">
                                                        {Cancel}
                                                    </div>
                                                </a>
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