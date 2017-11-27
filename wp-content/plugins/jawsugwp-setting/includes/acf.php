<?php
/**
 * ACF
 *
 * @ JAWSUGWP_Setting
 */

// save json files.
function jaws_acf_json_save_point( $path ) {

	// update path
	$path = JAWSUGWP_PATH . '/acf-json';

	// return
	return $path;

}
add_filter( 'acf/settings/save_json', 'jaws_acf_json_save_point' );

// load json files.
function jaws_acf_json_load_point( $paths ) {

	// remove original path (optional)
	unset($paths[0]);

	// append path
	$paths[] = JAWSUGWP_PATH . '/acf-json';

	// return
	return $paths;

}
add_filter( 'acf/settings/load_json', 'jaws_acf_json_load_point' );

// CSS
function jaws_acf_css() {
?>
<style>
	.acf-taxonomy-field ul.acf-radio-list li,
	.acf-taxonomy-field ul.acf-checkbox-list li {
		display: inline-block;
		margin-right: 1em;
	}
</style>
<?php
}
add_action( 'admin_print_styles', 'jaws_acf_css' );
