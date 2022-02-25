<?php

/**
 * Theme Images
 *
 * Add image sizes and dropdowns.
 *
 * @package WordPress
 * @since 1.0
 */

add_image_size('cover-image', 2000, 0);
add_image_size('footer-image', 2000, 400, true); //(cropped)


/**
 * Add image size to dropdown
 */
add_filter('image_size_names_choose', 'bkc_new_image_sizes');
function bkc_new_image_sizes($sizes)
{
    $addsizes = array(
        "cover-image" => 'Cover Image', // "image size name" => "Label (anything)"
        "footer-image" => 'Footer Image'
    );
    $newsizes = array_merge($sizes, $addsizes);
    return $newsizes;
}