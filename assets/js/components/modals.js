jQuery(document).ready(function($) {

	// $('.modal-video-open').modalVideo({
	// 	modestbranding: 1,
	// });

	// Initialize functions.
	initModals();

	// Initialize modals.
	function initModals() {

		var modal 			= $('.modal'),
			modalTrigger	= $('.modal-trigger'),
			modalClose 		= $('.modal__close');

		$(modalTrigger).on('click', function(e) {
			e.preventDefault();
			var modalID = $(this).data('modal');

			$(modal).each(function(){
				var ID = $(this).data('modal');

				if( ID == modalID ) {
					$(this).addClass('is-active');
					$('body').addClass('no-scroll');
					return;
				}

			});

		});

		// Close modal on "Esc".
		$(document).keyup(function(e) {
		     if (e.key === 'Escape' && $('.modal.is-active').length > 0 ) {
				closeModal();
		    }
		});

		// Close button click
		$(modalClose).on('click', function() {
			closeModal();
		});

		function closeModal() {
			$(modal).removeClass('is-active');
			$('body').removeClass('no-scroll');
		}

	}

});