<?php
/**
 * Post Meta.
 *
 * Here, you can register custom post meta fields using the Carbon Fields library.
 *
 * @see https://carbonfields.net/docs/containers-post-meta/
 */

use Carbon_Fields\Container\Container;
use Carbon_Fields\Field\Field;

/*
Container::make( 'term_meta', __( 'Custom Data', 'wmpt' ) )
	->where( 'term_taxonomy', '=', 'category' )
	->add_fields( array(
		Field::make( 'image', 'crb_img' ),
	));
*/
