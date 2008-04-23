    <script language="javascript" type="text/javascript">

    window.onload = function() {
    addButton("btnSend" ,"vgInvite");

    addValidatorRegEx("txtEmail", "errorDivEmail", "^([a-zA-Z0-9_\\.\\-])+\\@([a-zA-Z0-9\\.\\-])+\\.[a-zA-Z0-9]{2,4}$", "vgInvite");
	
    addSubmitButton("lnkSend", "vgInvite");
    }

	function btnSendClick()
	{
		var btnSend = document.getElementById("btnSend");
		btnSend.click();
	}
    </script>

    <div class="MainDivProfile">
            <table cellpadding="0" cellspacing="0" class="MainTableProfile Friends">
                <tr>
                    <td class="UserStatus">
                        {Invite}
                    </td>
                </tr>
                <tr>
                    <td class="Dialog Message">
						<form id="InviteForm" name="InviteForm" method="POST" action="/invite/">
							<table class="InvateMainTable">
								<tr>
									<td class="MessageTitle">
										{Information}
									</td>
								</tr>
								<tr>
									<td class="Note">
										<table>
											<tr>
												<td>
													{Note}
												</td>
											</tr>
											<tr>
												<td>
													{NoteAnswer}
												</td>
											</tr>
										</table>
									</td>
								</tr>
								<tr>
									<td>
										<table class="Message">
											<tr>
												<td class="LabelText LabelTextMessage">
													{Email}
												</td>
												<td class="LableValue LabelValueMessage">
													<input id="txtEmail" name="txtEmail" type="text" size="35" class="MessageSubject" />
													<?=$this->validation->txtEmail_error;?>
												</td>
												<td>
													<div id="errorDivEmail" class="Login_validator">
														<img src="../../images/invalid.gif" />
													</div>
												</td>
											</tr>
											<tr>
												<td class="LabelText LabelTextMessage">
													{FirstName}
												</td>
												<td class="LableValue LabelValueMessage" colspan="2">
													<input id="txtFirstName" name="txtFirstName" type="text" size="35" class="MessageSubject" />
													<?=$this->validation->txtFirstName_error;?>
												</td>
											</tr>
											<tr>
												<td class="LabelText LabelTextMessage">
													{LastName}
												</td>
												<td class="LableValue LabelValueMessage" colspan="2">
													<input id="txtLastName" name="txtLastName" type="text" size="35" class="MessageSubject" />
													<?=$this->validation->txtLastName_error;?>
												</td>
											</tr>
											<tr>
												<td>
												</td>
												<td>
													<table>
														<tr>
															<td>
																<a href="#" id="lnkSend" name="lnkSend" onclick="btnSendClick();">
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
                    </td>
                </tr>
            </table>
    </div>
