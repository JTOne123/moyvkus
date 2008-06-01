    <script language="javascript" type="text/javascript">

 window.onload = function() {

    	addForm("LoginForm" ,"vgLogin");

    	addValidatorRegEx("emailLogin", "errorDivEmail", "^([a-zA-Z0-9_\\.\\-])+\\@([a-zA-Z0-9\\.\\-])+\\.[a-zA-Z0-9]{2,4}$", "vgLogin");

    	addValidatorRegEx("passwordLogin", "errorDivPassword", "^.{6,21}$", "vgLogin");

    	addSubmitButton("login_sumbit", "vgLogin");
		
		
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

<div class="MainDivProfile">
	<table cellpadding="0" cellspacing="5" class="MainTableProfile Main">
		<tr>
			<td colspan="2" class="LittleDescriptionTD">
				{LittleDescription}
			</td>
		</tr>
			<tr>
			<td valign="top">
				<table>
					<tr>
						<td valign="top">
							{login}
						</td>
						<td class="InfoTable">
							<table>
								<tr>
									<td>
										{Info1}
									</td>
								</tr>
								<tr>
									<td>
										{Info2}
									</td>
								</tr>
								<tr>
									<td>
										{Info3}
									</td>
								</tr>
								<tr>
									<td>
										{Info4}
									</td>
								</tr>
								<tr>
									<td>
										{Info5}
									</td>
								</tr>
							</table>
						</td>
					</tr>
					<tr>
						<td colspan="2">
							<div class="ScreenVideoDiv">
								{screen_video}
							</div>
						</td>
					</tr>
				</table>

			</td>
			<td valign="top">
				<table>
					<tr>
						<td>
							{register}
						</td>
					</tr>
					<tr>
						<td>
							<img src="../../images/logo320x100.gif"/>
						</td>
					</tr>
				</table>

			</td>
		</tr>
		<tr>
			<td colspan="2">
				{search_recipe}
			</td>
		</tr>
		<tr>
			<td colspan="2">
				{best_recipe_builder}
			</td>
		</tr>
	</table>
</div>