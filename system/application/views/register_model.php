    <div style="width: 100%; height: 100%; display: inline;">
        <!--Содержимое этой дивки и есть регистрация-->
<script language="javascript" type="text/javascript">

    window.onload = function() {
    addForm("RegistForm" ,"vg");
    
    addValidatorRegEx("email", "errorDivEmail", "^([a-zA-Z0-9_\\.\\-])+\\@([a-zA-Z0-9\\.\\-])+\\.[a-zA-Z0-9]{2,4}$", "vg");
    
    addValidatorRegEx("first_name", "errorDivFirstName", "^.{4,100}$", "vg");

    addValidatorRegEx("last_name", "errorDivLastName", "^.{4,100}$", "vg");

    addValidatorRegEx("password", "errorDivPassword", "^.{6,21}$", "vg");
	
	addValidatorCompare("repassword", "password", "errorDivRePassword", "vg");
	
	addValidatorRegEx("captcha", "errorDivCaptcha", "^.{4}$", "vg");

    addSubmitButton("send", "vg");
    }
	
</script>
	
        <div id="Registration" class="Registration">
        <form method="POST" action="<?=base_url()?>register" id="RegistForm">
            <table cellpadding="2" cellspacing="0" class="Registration_table">
                <tbody>
                    <tr>
                        <td colspan="2" class="Registraion_h2">
                            {sign_up_message}
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            {sign_up_slogan_message}
                        </td>
                    </tr>
                    <tr>
                        <td class="Registration_text">
                            {first_name}
                        </td>
                        <td>
                            <input id="first_name" name="first_name" value="" type="text" class="Registration_input" />
						</td>
                    </tr>
                    <tr>
                        <td class="Registration_text">
                            {last_name}
                        </td>
                        <td>
                            <input id="last_name" name="last_name" value="" type="text" class="Registration_input" />
						</td>
                    </tr>
                    <tr>
                        <td class="Registration_text">
                            E-mail:
                        </td>
                        <td>
                            <input id="email" name="email" value="" type="text" class="Registration_input" />
                        </td>
                    </tr>
                    <tr>
                        <td class="Registration_text">
                            {password}
                        </td>
                        <td>
                            <input id="password" name="password" " value="" type="password" class="Registration_input" />
                        </td>
                    </tr>
                    <tr>
                        <td class="Registration_text">
                            {repassword}
                        </td>
                        <td>
                            <input id="repassword" name="repassword" " type="password" class="Registration_input" />
                        </td>
                    </tr>
                    <tr>
                        <td class="Registration_text">
                            {image}
                        </td>
                        <td>
                            <input id="captcha" name="captcha" type="text" class="Registration_input" />
                        </td>
                    </tr>
                    
                    <tr>
                        <td colspan="2" class="Registration_signup_td">
						    <a href="#" id="send" name="send">
                                <div class="Registration_signup">
                                    {sign_up}
                                </div>
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <div id="errorDivEmail" class="Registraion_validator">
                            {Error_email}
                            </div>
							<div id="errorDivFirstName" class="Registraion_validator">
                            {Error_firstname}
                            </div>
							<div id="errorDivLastName" class="Registraion_validator">
                            {Error_lastname}
                            </div>
							<div id="errorDivPassword" class="Registraion_validator">
                            {Error_password}
                            </div>
							<div id="errorDivRePassword" class="Registraion_validator">
                            {Error_repassword}
                            </div>
							<div id="errorDivCaptcha" class="Registraion_validator">
                            {Error_captcha}
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
            </form>
        </div>
    </div>