<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
   "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<!-- PageHeader START -->
   {header}
	<!-- PageHeader END -->
</head>
<body>
	<table class="MainTable" cellpadding="0" cellspacing="0">
		<tr>
			<td align="center" class="ImageHeaderTD">
				<table>
					<tr>
						<td class="LogoTD">
							<a href="<?=base_url()?>profile"><img src="<?=base_url()?>images/top_logo.gif" class="HeaderLinks"/></a>
						</td>
						<td>
							<img src="<?=base_url()?>images/top_center_header.gif"/>
						</td>
						<td>
							<a href="<?=base_url()?>logout"><img src="<?=base_url()?>images/top_logout.gif" class="HeaderLinks"/></a>
						</td>
					</tr>
				</table>
			</td>
		</tr>
		<!-- Top Sidebar START-->
		<tr>
			<td class="BodyTD">
				{menu}
			</td>
		</tr>
		<!-- Top Sidebar END-->
		<!-- Left Sidebar START -->
		<!-- Left Sidebar END -->
		<!-- Page Body START -->
		<tr>
			<td class="BodyTD">
				{body}
			</td>
		</tr>
		<!-- Page Body END -->
		<!-- Body Footer START-->
		<!-- Body Footer END -->
		<!-- Counters START-->
		<!-- Counters END-->
		<tr>
			<td align="center" class="About">
				<br/>
				<br/>
				(c)&nbsp;<a id="firstAuthorLink"></a>&nbsp;|&nbsp;<a id="secondAuthorLink"></a>&nbsp;2008
			</td>
		</tr>
		<tr>
			<td align="center" class="ImageBottomTD">
				<img src="<?=base_url()?>images/bottom.gif" class="ImageBottom"/>	
			</td>
		</tr>
	</table>
</body>

    <script language="javascript" type="text/javascript">

    var firstAuthorLink = document.getElementById('firstAuthorLink');
    var secondAuthorLink = document.getElementById('secondAuthorLink');

    var DatsyukName = "Дацюк Павел";
    var DatsyukId = 2;

    var VerbovskyName = "Вербовский Александр";
    var VerbovskyId = 1;

    if(Math.random()<0.5)
    {
    	firstAuthorLink.innerHTML = DatsyukName;
    	secondAuthorLink.innerHTML = VerbovskyName;

    	firstAuthorLink.href = "<?=base_url()?>profile/id/" + DatsyukId;
    	secondAuthorLink.href = "<?=base_url()?>profile/id/" + VerbovskyId;
    }
    else
    {
    	firstAuthorLink.innerHTML = VerbovskyName;
    	secondAuthorLink.innerHTML = DatsyukName;

    	firstAuthorLink.href = "<?=base_url()?>profile/id/" + VerbovskyId;
    	secondAuthorLink.href = "<?=base_url()?>profile/id/" + DatsyukId;
    }

    </script>

	
</html>