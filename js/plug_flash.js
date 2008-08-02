function RunFlash(swf, hauteur, largeur, couleur, window_mode, nom, vars) {
	document.write("<object classid=\"clsid:d27cdb6e-ae6d-11cf-96b8-444553540000\" codebase=\"http://fpdownload.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=8,0,0,0\" width=\""+hauteur+"\" height=\""+largeur+"\" id=\""+nom+"\" align=\"middle\">\n");
	document.write("<param name=\"allowScriptAccess\" value=\"always\" />\n");
	document.write("<param name='movie' value='"+swf+"' /> \n");
	document.write("<param name='quality' value='high' /> \n");
	document.write("<param name='bgcolor' value='"+couleur+"' /> \n");
	document.write("<param name='menu' value='true' /> \n");
	document.write("<param name='flashvars' value='"+vars+"' /> \n");
	if(window_mode=="transparent"||window_mode=="opaque"){
		document.write("<param name='wmode' value='"+window_mode+"' /> \n");
		document.write("<embed src='"+swf+"' menu='true' quality='high' wmode='"+window_mode+"' bgcolor='"+couleur+"' width='"+hauteur+"' height='"+largeur+"' name='"+nom+"' align='middle' allowScriptAccess='always' type='application/x-shockwave-flash' pluginspage='http://www.macromedia.com/go/getflashplayer' flashvars='"+vars+"' />\n");
		}
	else{
		document.write("<embed src='"+swf+"' menu='true' quality='high' bgcolor='"+couleur+"' width='"+hauteur+"' height='"+largeur+"' name='"+nom+"' align='middle' allowScriptAccess='always' type='application/x-shockwave-flash' pluginspage='http://www.macromedia.com/go/getflashplayer' flashvars='"+vars+"' />\n");
		}
	document.write("</object>\n");
	}