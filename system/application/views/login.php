 <div id="Registration" class="Registration">
        <form method="POST" action="/login/try_login" id="RegistForm">
            <table cellpadding="2" cellspacing="0" class="Registration_table">
                <tbody>
                    <tr>
                        <td class="Registration_text">
                            E-mail:
                        </td>
                        <td>
                            <input id="email" name="email" type="text" class="Registration_input" />
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
						    <a href="#" id="send" name="send">
                                <div class="Registration_signup">
                                    {log_in}
                                </div>
                            </a>
                            <input type="submit" value="Submit" name="B1">
                        </td>
                    </tr>
                    </tbody>
            </table>
            </form>
        </div>
    </div>