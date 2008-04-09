    <script language="javascript" type="text/javascript">

    window.onload = function() {
    	addForm("LoginForm" ,"vgLogin");

    	addValidatorRegEx("email", "errorDivEmail", "^([a-zA-Z0-9_\\.\\-])+\\@([a-zA-Z0-9\\.\\-])+\\.[a-zA-Z0-9]{2,4}$", "vgLogin");

    	addValidatorRegEx("password", "errorDivPassword", "^.{6,21}$", "vgLogin");

    	addSubmitButton("login_sumbit", "vgLogin");
    }
    </script>

    <div id="login">
        <form id="LoginForm" method="POST" action="/login">
            <div class="Login">
                <table cellpadding="0" cellspacing="0">
                    <tr>
                        <td class="Login_text">
                            E-mail:
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input id="email" name="email" value="<?=$this->validation->email;?>" type="text" class="Login_input" />
                        </td>
                        <td>
                            <div id="errorDivEmail" class="Login_validator">
                                <img src="invalid.gif" />
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
                            <input id="password" name="password" type="password" class="Login_input" />
                        </td>
                        <td>
                            <div id="errorDivPassword" class="Login_validator">
                                <img src="invalid.gif" />
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
                            <a href="#" id="login_sumbit" name="login_sumbit">
                                <div class="Login_submit">
                                    {log_in}
                                </div>
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <td class="Login_space" colspan="2">
                            <a href="#">{forgot_password}</a>
                        </td>
                    </tr>
                </table>
            </div>
        </form>
    </div>


<!-- 
<div id="Registration" class="Registration">
        <form method="POST" action="/login" id="RegistForm">
            <table cellpadding="2" cellspacing="0" class="Registration_table">
                <tbody>
                    <tr>
                        <td class="Registration_text">
                            E-mail:
                        </td>
                        <td>
                            <input id="email" name="email" value="<?=$this->validation->email;?>" type="text" class="Registration_input" />
                        </td>
                    </tr>
                    <tr>
                        <td class="Registration_text">
                            {password}
                        </td>
                        <td>
                            <input id="password" name="password" type="password" class="Registration_input" />
                        </td>
                    </tr>                    
                    <tr>
                        <td colspan="2" class="Registration_signup_td">
	                       <input type="submit" value="{log_in}" name="B1">
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
							<?php echo $this->validation->email_error;?>
							<?php echo $this->validation->password_error;?>
                        </td>
                    </tr>
                    </tbody>
            </table>
            </form>
        </div>
    </div>
-->
