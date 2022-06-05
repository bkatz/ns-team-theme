<?php
/**
 * Module: Email Signup
 */

// Section ID and Classes
$id 			= get_sub_field('section_id');
$class 			= get_sub_field('section_class');
$section_id 	= ($id) ? $id : null;
$section_class 	= ($class) ? $class : null;

// Section Data
?>

<section id="<?php echo $section_id; ?>" class="signup <?php echo $section_class; ?>">

	<div class="container">
		<h2>Get periodic email updates for upcoming events</h2>
		<?php gravity_form(1, false, false, false, '', true); ?>
		<p><a href="/contact/">If you would like to contact Miriam, click here!</a></p>
	</div>

</section><!-- .signup -->