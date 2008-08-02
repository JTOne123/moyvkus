/*****************************************************************
 *
 * flashShadowboxInjector 1.0 - by osamwal - http://www.yaelle.com/
 *
 * v 1.0 - 2008.01.29 - initial release
 *
 * Licensed under the Creative Commons Attribution 2.5 License - http://creativecommons.org/licenses/by/2.5/
 * Credit to Bramus! - http://www.bram.us/ for FlashLightBoxInjector
 *****************************************************************/

	var flashShadowboxInjector = Class.create();
	
	flashShadowboxInjector.prototype = {
			
		initialize : function() {
			var objBody = document.getElementsByTagName("body").item(0);
			var objContainer = document.createElement("div");
			objContainer.setAttribute('id','flashShadowboxInjectionBox');
			objContainer.style.display = 'none';
			objBody.appendChild(objContainer);	
			
		},
		
		reset : function() {
			$('flashShadowboxInjectionBox').innerHTML = "";
		},
		
		appendElement : function(link, title, id, rel) {
			new Insertion.Bottom('flashShadowboxInjectionBox', '<a href="' + link + '" title="' + title + '" id="' + id + '" rel="' + rel + '">' + link + '</a>');
		},
		
		prependElement : function(link, title, id, rel) {
			new Insertion.Top('flashShadowboxInjectionBox', '<a href="' + link + '" title="' + title + '" id="' + id + '" rel="' + rel + '">' + link + '</a>');
		},
		
		updateImageList : function() {
			
			Shadowbox.setup();	
		},
		
		start : function(url,rel,id) {
			var FlashClick={
				href:	 url,
				rel:	 rel,
				tagName: "A",
				id:		 id
			};
			Shadowbox.trigger(FlashClick);
		}
		
	}
	
	function initFlashShadowboxInjector() { 
		myflashShadowboxInjector = new flashShadowboxInjector(); 
	}
	
	Event.observe(window, 'load', initFlashShadowboxInjector, false);