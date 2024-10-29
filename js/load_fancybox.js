var $j = jQuery.noConflict();


$j(document).ready(function(){ 
			$j(".fancybox").fancybox({
				'width': '75%',
				'height': '95%',
				'autoScale': true,
				'transitionIn': 'none',
				'transitionOut': 'none',
				'type': 'iframe'
			});
});
