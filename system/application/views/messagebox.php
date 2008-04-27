    <script language="javascript" type="text/javascript">
		function btnYesClick()
		{
			var btnYes = document.getElementById("btnYes");
			btnYes.click();
		}
	</script>
	
	<div class="MainDivProfile">
        <table cellpadding="0" cellspacing="0" class="MainTableProfile Friends">
            <tr>
                <td class="UserStatus">
                    {MessageBoxTitle}
                </td>
            </tr>
            <tr>
                <td class="Dialog">
                    {MessageBoxText}
                    <br />
                    <br />
					<form id="DialogForm" method="POST" action="/messagebox/type/{Type}/{Item}/{ItemId}">
						<table class="DialogTable">
							<tr>
								<td>
									<a href="#" id="lnkYes" name="lnkYes" onclick="btnYesClick();" style="display:{DisplayYes}">
										<div class="Login_submit">
											{Yes}
										</div>
									</a>
									<input id="btnYes" name="btnYes" type="submit" style="display:none;"/>
								</td>
								<td>
									<a href="javascript:history.back(1)" id="lnkNo" name="lnkNo" style="display:{DisplayNo}">
										<div class="Login_submit">
											{No}
										</div>
									</a>
								</td>
							</tr>
						</table>
					</form>
                </td>
            </tr>
        </table>
    </div>