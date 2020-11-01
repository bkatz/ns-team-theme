// Init functions.
(function($) {

	// Renders and feather icons. Usage: feathericons.com.
	feather.replace();

	// Hero Item Video: Fade in background video when loaded.
	if( $('.hero-item__video').length > 0 ) {
		$(window).load(function(){
			$('.hero-item__video').removeClass('loading');
		});
	}

	// Scrolling links.
	var smoothLink = $('.scroll a, a.scroll, .button--scroll');
	$(smoothLink).on('click', function(e){

		var url 		= $(this).attr('href');
		var urlHash 	= url.substring(url.indexOf('#'));
		var id 			= '#' + url.substring(url.indexOf('#')+1);

		// Only scroll if an ID exists, else do the default.
		if( $(id).length > 0 ) {
			e.preventDefault();
			$('body, html').animate({
		        scrollTop: $(urlHash).offset().top
		    }, 1000);
		}

	});
	// END menu link scroller

	// Convert SVG images to elements for CSS manipulation.
	$('.is-svg').each( function() {
	    var $img 		= $(this);
	    var imgID 		= $img.attr('id');
	    var imgClass 	= $img.attr('class');
	    var imgURL 		= $img.attr('src');

	    jQuery.get(imgURL, function(data) {
	        var $svg = jQuery(data).find('svg');
	        if(typeof imgID !== 'undefined') {
	            $svg = $svg.attr('id', imgID);
	        }
	        if(typeof imgClass !== 'undefined') {
	            $svg = $svg.attr('class', imgClass+' replaced-svg');
	        }
	        $svg = $svg.removeAttr('xmlns:a');
	        if(!$svg.attr('viewBox') && $svg.attr('height') && $svg.attr('width')) {
	            $svg.attr('viewBox', '0 0 ' + $svg.attr('height') + ' ' + $svg.attr('width'))
	        }
	        $img.replaceWith($svg);
	    }, 'xml');

	});
	// END Convert SVG images to elements.

})(jQuery);