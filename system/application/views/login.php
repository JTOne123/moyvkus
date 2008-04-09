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