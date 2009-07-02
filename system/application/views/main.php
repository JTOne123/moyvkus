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
    
    
    
    
    
    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="css/shadowbox.css">
    <!-- SWFOBJECT -->

    <script type="text/javascript" src="js/plug_flash.js"></script>

    <!-- Shadowbox with Script.aculo.us -->

    <script type="text/javascript" src="js/scriptaculous/prototype.js"></script>

    <script type="text/javascript" src="js/scriptaculous/scriptaculous.js?load=effects"></script>

    <script type="text/javascript" src="js/scriptaculous/shadowbox-prototype.js"></script>

    <script type="text/javascript" src="js/scriptaculous/flashShadowboxInjector.js"></script>

    <script type="text/javascript" src="js/shadowbox.js"></script>

   <script type="text/javascript">
if (window.addEventListener)
    window.addEventListener('load', function () { Shadowbox.init; }, false);
else
    window.attachEvent('onload', function () { Shadowbox.init; });
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
							
							<script type="text/javascript">
    var flashVars="";
    flashVars+="xmlfeed=moyvkus.xml";            // Path to xml file or PHP script
    flashVars+="&myBckgrnd=0xFFFFFF";        // Image Reflection Background (for realistic reflection)
    flashVars+="&superGlass=true";            // Transparent reflection switch (for specific background): true or false
    flashVars+="&myBckGrndImage=";            // Path to load specific image background
    flashVars+="&myColor=0xFFFFFF";            // Image border color: Hex number
    flashVars+="&myTextColor=0x000000";        // Tooltip text color: Hex number
    flashVars+="&mySubTextColor=0x330033";    // Description text color: Hex number
    flashVars+="&myArrowColor=0xFFFFFF";    // Scrollbar arrow color: Hex number
    flashVars+="&myScrollColor=0xFF7FD4";    // Scrollbar color: Hex number
    flashVars+="&myLoadBarColor=0xFF7FD4";    // Load bar color: Hex number
    flashVars+="&myAlpha=0.6";                // Image border transparency ratio (0 (invisible) to 1 (max opacity))
    flashVars+="&Border=rounded";             // Image border aspect "rounded" or "square"
    flashVars+="&Tooltip=true";                // Tooltip switch
    flashVars+="&descText=true";             // Description text under front image
    flashVars+="&Scrollbar=true";        // Scrollbar behavior ("true" = autoHidden, "permanent" = always on, "false" = no scrollbar)
    flashVars+="&myStep=100";                // Images pitch
    flashVars+="&myOffset=10";                // Front image pitch
    flashVars+="&scaleDown=75";                // Inactive images Scale in %
    flashVars+="&scaleUp=100";                // Active images Scale in %
    flashVars+="&MaskScene=true";            // Scene side mask switch
    flashVars+="&shownPicture=5";            // Image shown at start
    flashVars+="&U_Flow=true";                // U Flow switch: Linear run or U run for images
    flashVars+="&descText=true";            // Description text below front image switch: true or false
    flashVars+="&scrollbar_Y=330";            // Y coord of scrollbar: int number
    flashVars+="&rollOverAnim=false";        // Rollover navigation switch: true or false
    flashVars+="&easeTime=1.5";                // Ease transition time (s): Float number
    flashVars+="&clips2move=8";                // Number of clips to animate: Int number
    flashVars+="&crossdomain=http://static.flickr.com/crossdomain.xml";    // Load specific crossdomain.xml to load image from other domain
   
    RunFlash("pictureflow-H240.swf", "425", "355", "#FFFFFF", "window", "PictureFlow", flashVars);
        </script>
							
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
						<td class="Statistic">
							<img src="../../images/logo320x100.gif"/>
							{population}
							<br>
							{number_of_recipes}
							<p>
							
							<a href="http://twitter.com/moyvkus" target="_blank">
							 <img src="../../images/twitter.png" class="HeaderLinks" />
							</a>
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