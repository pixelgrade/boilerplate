<?php
/**
 * Handle updates via the WUpdates.com service.
 *
 * Put here the code provided by WUpdates.com for your theme.
 *
 * @package Boilerplate
 * @since 1.0.0
 */

// @todo EXAMPLE!!! PLEASE DO NOT LEAVE IT LIKE THIS!!! PUT IN THE PROPER CODE FROM WUPDATES!!!
/* Automagical updates */
function wupdates_check_JDKZB( $transient ) {
	// First get the theme directory name (the theme slug - unique)
	$slug = basename( get_template_directory() );

	// Nothing to do here if the checked transient entry is empty or if we have already checked
	if ( empty( $transient->checked ) || empty( $transient->checked[ $slug ] ) || ! empty( $transient->response[ $slug ] ) ) {
		return $transient;
	}

	// Let's start gathering data about the theme
	// Then WordPress version
	include( ABSPATH . WPINC . '/version.php' ); // phpcs:ignore
	$http_args = array (
		'body' => array(
			'slug' => $slug,
			'url' => home_url( '/' ), //the site's home URL
			'version' => 0,
			'locale' => get_locale(),
			'phpv' => phpversion(),
			'child_theme' => is_child_theme(),
			'data' => null, //no optional data is sent by default
		),
		'user-agent' => 'WordPress/' . $wp_version . '; ' . home_url( '/' )
	);

	// If the theme has been checked for updates before, get the checked version
	if ( isset( $transient->checked[ $slug ] ) && $transient->checked[ $slug ] ) {
		$http_args['body']['version'] = $transient->checked[ $slug ];
	}

	// Use this filter to add optional data to send
	// Make sure you return an associative array - do not encode it in any way
	$optional_data = apply_filters( 'wupdates_call_data_request', $http_args['body']['data'], $slug, $http_args['body']['version'] );

	// Encrypting optional data with private key, just to keep your data a little safer
	// You should not edit the code bellow
	$optional_data = json_encode( $optional_data );
	$w=array();$re="";$s=array();$sa=md5('58caeaecbb702f55470f71e6876642b7857582da');
	$l=strlen($sa);$d=$optional_data;$ii=-1;
	while(++$ii<256){$w[$ii]=ord(substr($sa,(($ii%$l)+1),1));$s[$ii]=$ii;} $ii=-1;$j=0;
	while(++$ii<256){$j=($j+$w[$ii]+$s[$ii])%255;$t=$s[$j];$s[$ii]=$s[$j];$s[$j]=$t;}
	$l=strlen($d);$ii=-1;$j=0;$k=0;
	while(++$ii<$l){$j=($j+1)%256;$k=($k+$s[$j])%255;$t=$w[$j];$s[$j]=$s[$k];$s[$k]=$t;
		$x=$s[(($s[$j]+$s[$k])%255)];$re.=chr(ord($d[$ii])^$x);}
	$optional_data=bin2hex($re);

	// Save the encrypted optional data so it can be sent to the updates server
	$http_args['body']['data'] = $optional_data;

	// Check for an available update
	$url = $http_url = set_url_scheme( 'https://wupdates.com/wp-json/wup/v1/themes/check_version/JDKZB', 'http' );
	if ( $ssl = wp_http_supports( array( 'ssl' ) ) ) {
		$url = set_url_scheme( $url, 'https' );
	}

	$raw_response = wp_remote_post( $url, $http_args );
	if ( $ssl && is_wp_error( $raw_response ) ) {
		$raw_response = wp_remote_post( $http_url, $http_args );
	}
	// We stop in case we haven't received a proper response
	if ( is_wp_error( $raw_response ) || 200 != wp_remote_retrieve_response_code( $raw_response ) ) {
		return $transient;
	}

	$response = (array) json_decode($raw_response['body']);
	if ( ! empty( $response ) ) {
		// You can use this action to show notifications or take other action
		do_action( 'wupdates_before_response', $response, $transient );
		if ( isset( $response['allow_update'] ) && $response['allow_update'] && isset( $response['transient'] ) ) {
			$transient->response[ $slug ] = (array) $response['transient'];
		}
		do_action( 'wupdates_after_response', $response, $transient );
	}

	return $transient;
}
add_filter( 'pre_set_site_transient_update_themes', 'wupdates_check_JDKZB' );

function wupdates_add_id_JDKZB( $ids = array() ) {
	//  @todo EXAMPLE!!! PLEASE DO NOT LEAVE IT LIKE THIS!!! PUT IN THE PROPER DATA GENERATED WITH THE CODE BELLOW (PUT A BREAKPOINT : )!!!
//	/*
//	 * Temporary code to generate the digest for the wupdates code for pro themes.
//	 */
//	$theme_stylesheet_name = 'Boilerplate';
//	$slug         = 'boilerplate';
//	$hash_id = 'v7zV3'; // the WUpdates main theme hash ID
//	$type = 'theme_modular';
//	// This is the digest you need to paste in the array at the end of the function.
//	$theme_digest = md5( 'name-' . $theme_stylesheet_name . ';slug-' . $slug . ';id-' . $hash_id . ';type-' . $type );
//	/*
//	 * End of temporary code.
//	 */

	// First get the theme directory name (unique)
	$slug = basename( get_template_directory() );

	// Now add the predefined details about this product
	// Do not tamper with these please!!!
	$ids[ $slug ] = array( 'name' => 'Boilerplate', 'slug' => 'boilerplate', 'id' => 'JDKZB', 'type' => 'theme_modular', 'digest' => '334eca86d4bcf69a497928cc3d816272', );

	return $ids;
}
add_filter( 'wupdates_gather_ids', 'wupdates_add_id_JDKZB', 10, 1 );
