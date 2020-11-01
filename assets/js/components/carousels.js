/*
* Theme carousel settings can be configured here.
*/

(function($) {

	// Hero Carousel
	$( function() {

		if( ! $('.hero--carousel').length > 0 ) {
			return false;
		}

		$('.hero--carousel').slick({
	        autoplay: false,
	        autoplaySpeed: 5000,
	        fade: true,
	        dots: false,
	        slide: '.hero-item',
	        useTransform: true,
	        infinite: true,
	        slidesToShow: 1,
	        vertical: false,
	        speed: 700,
	        rows: 0,
	        adaptiveHeight: false,
	        // cssEase: 'cubic-bezier(0.600, -0.175, 0.7, 0.1)',
	        cssEase: 'ease-in',
	        prevArrow: '<span class="carousel-controls is-previous"><i data-feather="chevron-left"></i></span>',
	        nextArrow: '<span class="carousel-controls is-next"><i data-feather="chevron-right"></i></span>',
			responsive: [
				{
					breakpoint: 1025,
					settings: {
						// slidesToShow: 1,
					}
				},
				{
					breakpoint: 768,
					settings: {
						// slidesToShow: 1,
					}
				}
			]
		});

		feather.replace();

	});
	// END Hero Carousel

})(jQuery);