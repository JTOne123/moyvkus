<script src="<?=$baseurl?>js/prototype.js"></script>
<script>
	function ajax_locator_country()
	{
		var country = escape($F("SelectCountry"));
		var url = '<?=$baseurl?>/edit_profile/ajax_locator_country';
		var pars = {countryID: country};
		
		var myAjax = new Ajax.Request(
					url, 
					 {
						method: 'post', 
						parameters: pars, 
						onComplete: showResponse
					 }
					);
	
	 function showResponse(originalRequest)
	{
		var returned = originalRequest.responseText;
		
		$("SelectRegion").insert({ top: returned });
	    //$("SelectRegion").insert({ top: "<option selected></option>" });
	}		
	}
	
	function ajax_locator_region()
	{
		var region = escape($F("SelectRegion"));
		var url = '<?=$baseurl?>/edit_profile/ajax_locator_region';
		var pars = {regionID: region};
		
		var myAjax = new Ajax.Request(
					url, 
					 {
						method: 'post', 
						parameters: pars, 
						onComplete: showResponseReg
					 }
					);
	
	 function showResponseReg(originalRequest)
	{
		var returned = originalRequest.responseText;
		
		$("SelectCity").insert({ top: returned });
		//$("SelectCity").insert({ top: "<option selected></option>" });
	}		
	}
	
</script>


<script language="javascript" type="text/javascript">
	function AttachValidators()
	{
		var oldPassword = document.getElementById("txtOldPassword");

		if(oldPassword.value != "")
		{
    		addButton("btnSave" ,"vgEditProfile");

    		addValidatorRegEx("txtNewPassword", "errorDivNewPassword", "^.{6,21}$", "vgEditProfile");
    		addValidatorCompare("txtReNewPassword", "txtNewPassword", "errorDivReNewPassword", "vgEditProfile");

    		addSubmitButton("Save", "vgEditProfile");
			addSubmitButton("lnkSave", "vgEditProfile");
		}

    }
	
	function btnSaveClick()
	{
		var btnSave = document.getElementById("btnSave");
		btnSave.click();
	}	
	
	function imposeMaxLength(object, MaxLen)
	{
	if(object.value.length > MaxLen)
	   object.value = object.value.substring(0, MaxLen);
	}
	
    </script>
	
    
	<div class="MainDivProfile">
        <table cellpadding="0" cellspacing="0" class="MainTableProfile">
            <tr>
                <td colspan="3" class="UserStatus">
					<table class="ProfileHeaderTable">
						<tr>
							<td class="UserStatusInHeaderTable">
								{UserStatus}
							</td>
							<td class="UserStatusInHeaderTable UserStatusEdit">
								<a href="#" id="lnkSave" onclick="btnSaveClick()">{Save}</a>&nbsp;<a href="{ProfileUrl}">{Cancel}</a>							
							</td>
						</tr>
					</table>
                </td>
            </tr>
            <tr>
                <td valign="top" colspan="2">
                    <div class="LeftColumn">
                        <table cellpadding="0" cellspacing="5" class="LeftTableProfile">
                            <tr>
                                <td class="Headers">
                                    {Avatar}
                                </td>
                            </tr>
                            <tr>
                                <td class="Avatar">
                                    <img id="avatar" src="{AvatarUrl}"/>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                
								<?=form_open_multipart('edit_profile/do_upload'); ?>
								<input type="file" name="userfile" size="15" />

			                    <a href="#"  onclick="document.getElementById('btnUpload').click();">
                                    <div class="Login_submit">
                                       {Upload}
                                    </div>
                                </a>
								<input id="btnUpload" type="submit" value="{Upload}" style="display:none;"/>
								
								{AvatarUploadError}
								</form>	
						
								
								<form id="EditProfile" name="EditProfile" method="POST" action="/edit_profile/">									
                                </td>
                            </tr>
                            <tr>
                                <td class="Headers">
                                    {MySettings}
                                </td>
                            </tr>
                            <tr>
                                <td>

                                </td>
                            </tr>
                        </table>
                    </div>
                </td>
                <td valign="top">
                    <div class="RightColumn">
                        <table cellpadding="0" cellspacing="5" class="RightTableProfile">
                            <tr>
                                <td class="Headers">
                                    {MyData}
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <table cellpadding="0" cellspacing="0">
                                        <tr>
                                            <td class="LabelText">
                                                {FirstNameText}
                                            </td>
                                            <td class="LableValue">
                                                <input type="text" id="txtFirstName" name="txtFirstName" value="{FirstName}" class="LabelValueEdit" maxlength="100"/>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="LabelText">
                                                {LastNameText}
                                            </td>
                                            <td class="LableValue">
                                                <input type="text" id="txtLastName" name="txtLastName" value="{LastName}" class="LabelValueEdit" maxlength="100"/>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="LabelText">
                                                {SexText}
                                            </td>
                                            <td class="LableValue">
                                                <input type="radio" id="txtSexMan" name="txtSex" value="txtSexMan" {txtSexManCHECKED}/>{Man}&nbsp;
                                                <input type="radio" id="txtSexWoman" name="txtSex" value="txtSexWoman" {txtSexWomanCHECKED}/>{Woman}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="LabelText">
                                                {BirthdayText}
                                            </td>
                                            <td class="LableValue">
												<table class="TableWithSelects">
													<tr>
														<td class="LabelValueEditProfile">{Day}</td>
														<td>{SelectDay}</td>
													</tr>
													<tr>
														<td class="LabelValueEditProfile">{Month}</td>
														<td>{SelectMonth}</td>
													</tr>
													<tr>
														<td class="LabelValueEditProfile">{Year}</td>
														<td>{SelectYear}</td>
													</tr>
												</table>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="LabelText">
                                                {LoctionText}
                                            </td>
                                            <td class="LableValue">
												<table class="TableWithSelects">
													<tr>
														<td class="LabelValueEditProfile">{Country}</td>
														<td>{SelectCountry}</td>
													</tr>
													<tr>
														<td class="LabelValueEditProfile">{Region}</td>
														<td>{SelectRegion}												
														</td>
													</tr>
													<tr>
														<td class="LabelValueEditProfile">{City}</td>
														<td>{SelectCity}</td>
													</tr>
												</table>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td class="Headers">
                                    {Contacts}
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <table cellpadding="0" cellspacing="0">
                                        <tr>
                                            <td class="LabelText">
                                                {WebSiteText}
                                            </td>
                                            <td class="LableValue">
                                                <input type="text" id="txtWebSite" name="txtWebSite" value="{WebSite}" class="LabelValueEdit" maxlength="100"/>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="LabelText">
                                                {InstantMessagerText}
                                            </td>
                                            <td class="LableValue">
                                                <input type="text" id="txtPhone" name="txtPhone" value="{InstantMessager}" class="LabelValueEdit" maxlength="15"/>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td class="Headers">
                                    {MyInfo}
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <table cellpadding="0" cellspacing="0">
                                        <tr>
                                            <td class="LabelText">
                                                {ActivitiesText}
                                            </td>
                                            <td class="LableValue">
                                                <textarea type="text" id="txtActivities" name="txtActivities" rows="4" class="LabelValueEdit" onkeypress="return imposeMaxLength(this, 2000);">{Activities}</textarea>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="LabelText">
                                                {InterestsText}
                                            </td>
                                            <td class="LableValue">
                                                <textarea type="text" id="txtInterests" name="txtInterests" rows="4" class="LabelValueEdit" onkeypress="return imposeMaxLength(this, 2000);">{Interests}</textarea>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="LabelText">
                                                {AboutText}
                                            </td>
                                            <td class="LableValue">
                                                <textarea type="text" id="txtAbout" name="txtAbout" rows="4" class="LabelValueEdit" onkeypress="return imposeMaxLength(this, 2000);">{About}</textarea>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td class="Headers">
                                    {LoginInformation}
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <table cellpadding="0" cellspacing="0">
                                        <tr>
                                            <td class="LabelText">
                                                {NewEmailText}
                                            </td>
                                            <td class="LableValue LabelValueEdit">
                                                {Email}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="LabelText">
                                                {OldPasswordText}
                                            </td>
                                            <td class="LableValue">
												<table cellpadding="0" cellspacing="0">
													<tr>
														<td>
															<input type="password" id="txtOldPassword" name="txtOldPassword" onblur="AttachValidators();" class="LabelValueEdit"/>
														</td>
														<td>
															<div id="errorDivOldPassword" class="Login_validator" style="display:{OldPasswordError}">
																<img src="../../images/invalid.gif" />
															</div>
														</td>
													</tr>
												</table>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="LabelText">
                                                {NewPassword}
                                            </td>
                                            <td class="LableValue">
												<table cellpadding="0" cellspacing="0">
													<tr>
														<td>
															<input type="password" id="txtNewPassword" name="txtNewPassword" class="LabelValueEdit"/>
															{ErrorNewPassword}
														</td>
														<td>
															<div id="errorDivNewPassword" class="Login_validator">
																<img src="../../images/invalid.gif" />
															</div>
														</td>
													</tr>
												</table>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="LabelText">
                                                {ReNewPassword}
                                            </td>
                                            <td class="LableValue">
												<table cellpadding="0" cellspacing="0">
													<tr>
														<td>
															<input type="password" id="txtReNewPassword" name="txtReNewPassword" class="LabelValueEdit"/>
														</td>
														<td>
															<div id="errorDivReNewPassword" class="Login_validator">
																<img src="../../images/invalid.gif" />
															</div>
														</td>
													</tr>
												</table>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <table cellpadding="0" cellspacing="0" class="SaveButtonTable">
                                        <tr>
                                            <td class="SaveLabelTD">
                                                {SaveAllChanges}
                                            </td>
                                            <td class="SaveButtonTD">
                                                <div align="right">
                                                   <a href="#" id="Save" name="Save" onclick="btnSaveClick()">
                                                        <div class="Login_submit">
                                                            {Save}
                                                        </div>
                                                    </a>
                                                </div>
												<input id="btnSave" name="btnSave" type="submit" value="true" style="display:none;"/>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                    </div>
                </td>
            </tr>
        </table>
    </div>
</form>