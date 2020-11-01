// Notifications
(function($) {

	var notification = $('.notification');

	$(notification).each(function() {

		var closeNotification 		= $('.notification__close');
		var cookieInterval 			= $(this).data('display');
		var topCookie 				= Cookies.get('notificationTopCookie');
		var bottomCookie 			= Cookies.get('notificationBottomCookie');

		// Show the notification bar if no cookie is set.
		if ( topCookie !== 'disabled' && $('.notification.is-top').length > 0 ) {
			setTimeout(function() {
				$('.notification.is-top').removeClass('is-hidden');
					$('body').addClass('has-notification-top');
			}, 500);
		}

		if ( bottomCookie !== 'disabled' && $('.notification.is-bottom').length > 0 ) {
			setTimeout(function() {
				$('.notification.is-bottom').removeClass('is-hidden');
				$('body').addClass('has-notification-bottom');
			}, 500);
		}

		// When the user closes the bar...
		$( closeNotification ).on( 'click', function(e) {

			e.preventDefault();

			if( $(this).closest('.notification').hasClass('is-top') ) {
				if( 'all' !== cookieInterval ) {
					Cookies.set('notificationTopCookie', 'disabled', { expires: cookieInterval });
				}
				$('body').removeClass('has-notification-top');
			}

			if( $(this).closest('.notification').hasClass('is-bottom') ) {
				if( 'all' !== cookieInterval ) {
					Cookies.set('notificationBottomCookie', 'disabled', { expires: cookieInterval });
				}
				$('body').removeClass('has-notification-bottom');
			}

			$(this).closest('.notification').addClass('is-dismissed');

			setTimeout(function() {
				$(this).closest('.notification').remove();
			}, 500);

		});

	});

})(jQuery);