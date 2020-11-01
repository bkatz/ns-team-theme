<?php
/**
 * WP Login Form
 *
 * This file outputs the login form to which
 * ever page it is included on and redirects to
 * that page.
 *
 * @package WordPress
 * @since 1.0
 */

?>
<div class="page-content logged-out container">
	<div class="login-wrap">
		<h3 class="form-title">Please Login</h3>
		<div class="no-account">Don't have an account? <a href="/sign-up/">Sign Up Here</a></div>

		<?php

			global $post;
			if ( is_page( 'login' ) ) :
				$redirect = home_url();
			else :
				$redirect = get_the_permalink();
			endif;

			$args = array(
				'echo'			=> true,
				'remember'		=> false,
				'redirect'		=> $redirect,
				'form_id'		=> 'login-form',
			);
			wp_login_form( $args );

		?>

	</div>
	<!-- .login-wrap -->
</div>
<!-- .page-content -->