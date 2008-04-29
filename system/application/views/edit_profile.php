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
/*	function AttachValidators()
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
*/	
    </script>
	
    
	<div class="MainDivProfile">
        <table cellpadding="0" cellspacing="0" class="MainTableProfile">
            <tr>
                <td colspan="2" class="UserStatus">
                    {UserStatus}
                </td>
                <td class="UserStatus UserStatusEdit">
                    <a href="#" id="lnkSave" onclick="btnSaveClick()">{Save}</a>&nbsp;<a href="{ProfileUrl}">{Cancel}</a>
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

								<br />

								<input type="submit" value="{Upload}" />
								<br />
								{Error}
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
                                    <table cellpadding="0" cellspacing="0" class="SettingsTable">
                                        <tr>
                                            <td>
                                                <input type="checkbox" />{MySettings1}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <input type="checkbox" />{MySettings2}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <input type="checkbox" />{MySettings3}
                                            </td>
                                        </tr>
                                    </table>
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
                                            <td class="LableValue LabelValueEdit">
                                                <input type="text" id="txtFirstName" name="txtFirstName" value="{FirstName}"/>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="LabelText">
                                                {LastNameText}
                                            </td>
                                            <td class="LableValue LabelValueEdit">
                                                <input type="text" id="txtLastName" name="txtLastName" value="{LastName}"/>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="LabelText">
                                                {SexText}
                                            </td>
                                            <td class="LableValue LabelValueEdit">
                                                <input type="radio" id="txtSexMan" name="txtSex" value="txtSexMan" {txtSexManCHECKED}/>{Man}&nbsp;
                                                <input type="radio" id="txtSexWoman" name="txtSex" value="txtSexWoman" {txtSexWomanCHECKED}/>{Woman}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="LabelText">
                                                {BirthdayText}
                                            </td>
                                            <td class="LableValue LabelValueEdit">
												<table>
													<tr>
														<td>{Day}</td>
														<td>{SelectDay}</td>
													</tr>
													<tr>
														<td>{Month}</td>
														<td>{SelectMonth}</td>
													</tr>
													<tr>
														<td>{Year}</td>
														<td>{SelectYear}</td>
													</tr>
												</table>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="LabelText">
                                                {LoctionText}
                                            </td>
                                            <td class="LableValue LabelValueEdit">
												<table>
													<tr>
														<td>{Country}</td>
														<td>{SelectCountry}</td>
													</tr>
													<tr>
														<td>{Region}</td>
														<td>{SelectRegion}												
														</td>
													</tr>
													<tr>
														<td>{City}</td>
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
                                            <td class="LableValue LabelValueEdit">
                                                <input type="text" id="txtWebSite" name="txtWebSite" value="{WebSite}" />
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="LabelText">
                                                {InstantMessagerText}
                                            </td>
                                            <td class="LableValue LabelValueEdit">
                                                <input type="text" id="txtPhone" name="txtPhone" value="{InstantMessager}" />
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
                                            <td class="LableValue LabelValueEdit">
                                                <input type="text" id="txtActivities" name="txtActivities" value="{Activities}"/>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="LabelText">
                                                {InterestsText}
                                            </td>
                                            <td class="LableValue LabelValueEdit">
                                                <input type="text" id="txtInterests" name="txtInterests" value="{Interests}"/>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="LabelText">
                                                {AboutText}
                                            </td>
                                            <td class="LableValue LabelValueEdit">
                                                <input type="text" id="txtAbout" name="txtAbout" value="{About}"/>
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
                                            <td class="LableValue LabelValueEdit">
												<table cellpadding="0" cellspacing="0">
													<tr>
														<td>
															<input type="password" id="txtOldPassword" name="txtOldPassword" onblur="AttachValidators();"/>
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
                                            <td class="LableValue LabelValueEdit">
												<table cellpadding="0" cellspacing="0">
													<tr>
														<td>
															<input type="password" id="txtNewPassword" name="txtNewPassword" />
															<?php
															        if(isset($this->validation->txtNewPassword_error))
																	echo $this->validation->txtNewPassword_error;
															?>
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
                                            <td class="LableValue LabelValueEdit">
												<table cellpadding="0" cellspacing="0">
													<tr>
														<td>
															<input type="password" id="txtReNewPassword" name="txtReNewPassword" />
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
                                                   <!-- <a href="#" id="Save" name="Save" onclick="btnSaveClick()"> -->
                                                        <div class="Login_submit">
                                                            {Save}
                                                            <input type="submit" name="btnSave" value="{Save}" />
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