    <div style="width: 100%; height: 100%; display: inline;">
        <!--Содержимое этой дивки и есть регистрация-->
        <div id="Registration" class="Registration">
        <form method="POST" action="register">
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
                            <input name="first_name" type="text" class="Registration_input" />
                        </td>
                    </tr>
                    <tr>
                        <td class="Registration_text">
                            {last_name}
                        </td>
                        <td>
                            <input name="last_name" type="text" class="Registration_input" />
                        </td>
                    </tr>
                    <tr>
                        <td class="Registration_text">
                            E-mail:
                        </td>
                        <td>
                            <input name="email" type="text" class="Registration_input" />
                        </td>
                    </tr>
                    <tr>
                        <td class="Registration_text">
                            {password}
                        </td>
                        <td>
                            <input name="pass" type="text" class="Registration_input" />
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" class="Registration_signup_td">
                             <input type="submit" value="{sing_up}" name="send">
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <div id="Registraion_validator" class="Registraion_validator">
                            {Error}
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
            </form>
        </div>
    </div>