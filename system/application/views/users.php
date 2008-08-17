<script src="<?=$baseurl?>js/prototype.js"></script>
<script>
function ajax_rate()
{
	var UsersPageDescr = "{UsersPageDescrRate}";
	var url = '<?=$baseurl?>users/rate';
	var pars = {visible: '1'};
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
		$('rate').update(returned)
		$('UsersPageDescr').update(UsersPageDescr)
	}
}

function ajax_active()
{
	var UsersPageDescr = "{UsersPageDescrActive}";
	var url = '<?=$baseurl?>users/active';
	var myAjax = new Ajax.Request(
	url,
	{
		method: 'post',
		onComplete: showResponse
	}
	);

	function showResponse(originalRequest)
	{
		var returned = originalRequest.responseText;
		$('rate').update(returned)
		$('UsersPageDescr').update(UsersPageDescr)
	}
}

function ajax_newbes()
{
	var UsersPageDescr = "{UsersPageDescrNewbes}";
	var url = '<?=$baseurl?>users/newbes';
	var myAjax = new Ajax.Request(
	url,
	{
		method: 'post',
		onComplete: showResponse
	}
	);

	function showResponse(originalRequest)
	{
		var returned = originalRequest.responseText;
		$('rate').update(returned)
		$('UsersPageDescr').update(UsersPageDescr)
	}
}
</script>


<div class="MainDivProfile">
        <table cellpadding="0" cellspacing="0" class="MainTableProfile Friends">
            <tr>
                <td class="UserStatus">
                    {Users}
                </td>
            </tr>
            <tr>

            </tr>
            <tr>
                <td class="FriendsCount">
                    <div id="UsersPageDescr">{UsersPageDescrRate}</div>
                </td>
            </tr>
            <tr>
                <td class="FriendsBuilder">
                    {UserListLinks}
                </td>
            </tr>
			<tr>
				<td class="FriendsBuilder">
	                 
					<div id="rate">{rate}</div>
				
                </td>
			</tr>
        </table>
    </div>