/*
* This file contains the functions that allow for fade in animations.
* To use it, the ScrollMagic.js library much be included.
* Add the class "fade" to any element the effect should be applied to.
* Then you can define the CSS for that element when "is-active" class
* is applied as a result if this script.
*/
(function($) {

	var Animations = {

		dom: function(){
			(this.$animate = document.querySelectorAll('.animate'))
		},

		initAnimations: function() {
			var app = this;

			for ( var i = 0; i < app.$animate.length ;  i++ ) {
				var x = app.$animate[i];
				app.animateElements(x, x, 0.75);
			}
		},

		animateElements: function(elTrigger, elAnimate, triggerHook) {
			var app = this;
			var controller = new ScrollMagic.Controller();
			var animateScene = new ScrollMagic.Scene({
				triggerElement: elTrigger,
				duration: 0,
				reverse: true,
				triggerHook: triggerHook
			})
			.on('start', function() {
				var elTitle = elAnimate;
				if( jQuery(elTitle).hasClass('is-animated') ) {
					jQuery(elTitle).removeClass('is-animated');
				} else {
					jQuery(elTitle).addClass('is-animated');
				}
			})
			// .addIndicators()
			.addTo(controller);
		},

		stickyNav: function() {
			var controller = new ScrollMagic.Controller();
			var navScene = new ScrollMagic.Scene({
				triggerElement: '.animate',
				duration: 0,
				reverse: true,
				triggerHook: 0
			})
			.setPin('.header')
			.setClassToggle('body', 'header-is-sticky')
			// .addIndicators()
			.addTo(controller);
		},

		ready: function(){
			var app = this;
			app.dom();
			app.initAnimations();
		}
	}

	Animations.ready();

})(jQuery);