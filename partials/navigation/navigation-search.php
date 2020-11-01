<div class="search-module">
	<a href="#" class="close">Close <i data-feather="x-circle"></i></a>
	<div class="container">

		<div class="form-wrap">

			<form role="search" method="get" class="search-form" action="<?php echo home_url( '/' ); ?>">

				<div class="icon">
					<i data-feather="search"></i>
					<input type="submit" class="search-submit" value="<?php echo esc_attr_x( 'Yes', 'submit button' ) ?>" />
				</div><!-- .icon -->

		        <input type="search" class="search-field"
		            placeholder="<?php echo esc_attr_x( 'What are you looking for?', 'placeholder' ) ?>"
		            value="<?php echo get_search_query() ?>" name="s"
		            title="<?php echo esc_attr_x( 'Search for:', 'label' ) ?>" />

			</form><!-- form -->

		</div><!-- .form-wrap -->

	</div>
</div>