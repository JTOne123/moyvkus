    <script language="javascript" type="text/javascript">

    window.onload = function() {
    	addForm("LoginForm" ,"vgLogin");

    	addValidatorRegEx("emailLogin", "errorDivEmail", "^([a-zA-Z0-9_\\.\\-])+\\@([a-zA-Z0-9\\.\\-])+\\.[a-zA-Z0-9]{2,4}$", "vgLogin");

    	addValidatorRegEx("passwordLogin", "errorDivPassword", "^.{6,21}$", "vgLogin");

    	addSubmitButton("login_sumbit", "vgLogin");
    }
    </script>

    <div id="login">
        <form id="LoginForm" method="POST" action="/login/">
            <div class="Login">
                <table cellpadding="0" cellspacing="0">
                    <tr>
                        <td class="Login_text">
                            E-mail:
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input id="emailLogin" name="emailLogin" value="<?=$this->validation->emailLogin;?>" type="text" class="Login_input" />
                        </td>
                        <td>
                            <div id="errorDivEmail" class="Login_validator">
                                <img src="../../images/invalid.gif" />
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="Login_text">
                            {password}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input id="passwordLogin" name="passwordLogin" type="password" class="Login_input" />
                        </td>
                        <td>
                            <div id="errorDivPassword" class="Login_validator">
                                <img src="../../images/invalid.gif" />
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="Login_checkbox Login_space" colspan="2">
                            <input name="checkbox_remember" type="checkbox" />{checkbox_remember}
                        </td>
                    </tr>
                    <tr>
                        <td class="Login_space" colspan="2">
							<div class="MyRecipeButtonDiv">
								<a href="#" id="login_sumbit" name="login_sumbit">
									<div class="Login_submit">
										{log_in}
									</div>
								</a>
							</div>
                        </td>
                    </tr>
                    <tr>
                        <td class="Login_space" colspan="2">
                            <a href="{ForgetPasswordUrl}">{forgot_password}</a>
                        </td>
                    </tr>
                         <tr>
                        <td colspan="2">
							<?php echo $this->validation->emailLogin_error;?>
							<?php echo $this->validation->passwordLogin_error;?>
                        </td>
                    </tr>
                </table>
            </div>
        </form>
    </div>