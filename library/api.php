<?php
/*
* WP REST API Functions
*
* @package al3
* @subpackage Core
*/
?>


<?php
/*
This snippet takes care of all functions needed to
run the WP API in this very theme.

Developed by: Laurens Lamberty
URL: http://lamberty.me
*/

function haddak_wp_json($path) {
    return 'http://haddak.de/wp-json/wp/v2/' . $path;
}

function haddak_acf_json($path) {
    return 'http://haddak.de/wp-json/acf/v2/' . $path;
}

function slug_get_json( $url ) {
	//GET the remote site
	$response = wp_remote_get( $url );

	//Check for error
	if ( is_wp_error( $response ) ) {
		return sprintf( __('The URL %1s could not be retrieved.', 'al3'), $url );
	}

	//get just the body
	$data = wp_remote_retrieve_body( $response );

	//return if not an error
	if ( ! is_wp_error( $data )  ) {

		//decode and return
		return json_decode( $data );

	}

}

function slug_insert_post_from_json( $post ) {

	//check we have an array or object
	//either make sure its an array or throw an error
	if ( is_array( $post ) || is_object( $post )  ) {
		//ensure $post is an array, converting from object if need be
		$post = (array) $post;
	}
	else {
		return sprintf( __('The data inputted to %1s must be an object or an array', 'al3'), __FUNCTION__ );
	}


	//set up an array to do most of the conversion in one loop
	//Note: We set ID as import_id to ATTEMPT to use the same ID
	//Leaving as ID would UPDATE an existing post of the same ID
	$convert_keys = array(
		'title' => 'post_title',
		'content' => 'post_content',
		'slug' => 'post_name',
		'status' => 'post_status',
		'parent' => 'post_parent',
		'excerpt' => 'post_excerpt',
		'date' => 'post_date',
		'type' => 'post_type',
		'ID' => 'import_id',
	);

	//copy FROM json array TO how wp_insert_post() wants it and unset old key
	foreach ( $convert_keys as $from => $to ) {
		if ( isset( $post[ $from ] ) ) {
			$post[ $to ] = $post[ $from ];
			unset( $post[ $from ] );
		}

	}

	//prepare author ID
	$post[ 'post_author' ] = $post[ 'author' ]->ID;
	unset( $post[ 'author' ] );

	//put terms object into it's own array and unset
	//for now let it be.
	$terms = (array) $post[ 'terms' ];
	unset( $post[ 'terms'] );

	//create post and return its ID
	return wp_insert_post( $post );

}
