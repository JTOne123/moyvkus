    <script language="javascript" type="text/javascript">

    window.onload = function() {
    addButton("btnSend" ,"vgForgetPassword");

    addValidatorRegEx("txtEmail", "errorDivEmail", "^([a-zA-Z0-9_\\.\\-])+\\@([a-zA-Z0-9\\.\\-])+\\.[a-zA-Z0-9]{2,4}$", "vgForgetPassword");
	
    addSubmitButton("lnkSend", "vgForgetPassword");
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
                        {ForgetPassword}
                    </td>
                </tr>
                <tr>
                    <td class="Dialog Message">
						<form id="ForgetPasswordForm" name="ForgetPasswordForm" method="POST" action="/forget_password/">
							<table class="InvateMainTable">
								<tr>
									<td class="MessageTitle">
										{InformationForgetPassword}
									</td>
								</tr>
								<tr>
									<td class="Note">
										<table>
											<tr>
												<td>
													<b>{NoteForgetPassword}</b>
												</td>
											</tr>
											<tr>
												<td>
													{NoteAnswerForgetPassword}
												</td>
											</tr>
										</table>
									</td>
								</tr>
								<tr>
									<td>
										<table class="Message">
											<tr>
												<td class="LabelText ForgetPasswordEmailTD">
													{Email}
												</td>
												<td>
													<input id="txtEmail" name="txtEmail" type="text" size="35" class="MessageSubject ForgetPasswordEmail" />
													<?=$this->validation->txtEmail_error;?>
												</td>
												<td class="ForgetPasswordErrorDiv">
													<div id="errorDivEmail" class="Login_validator">
														<img src="../../images/invalid.gif" />
													</div>
												</td>
											</tr>
											<tr>
												<td colspan="3">
													<table class="InvateMainTable">
														<tr>
															<td>
																<a href="#" id="lnkSend" name="lnkSend" onclick="btnSendClick();">
																	<div class="Login_submit">
																		{SendForgetPassword}
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
