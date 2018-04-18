<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * default page title
 */
$config['site_name'] = "";

/**
 * Theme base file name and other theme specific files.
 * These files should be in .php format.
 * For example: If its global.php, then put 'global'.
 */
$config['theme_path'] = 'themes/sample-theme/';
$config['theme_base_file'] = 'global';
$config['theme_meta_file'] = 'meta';
$config['theme_header_file'] = 'header';
$config['theme_memberheader_file'] = 'memberheader';
$config['theme_guestheader_file'] = 'guestheader';
$config['theme_sidebar_file'] = 'sidebar';
$config['theme_footer_file'] = 'footer';
$config['theme_breadcrumb_file'] = 'breadcrumb';

/**
 * admin themes
 **/
$config['admin_theme_path'] = 'themes/sample-theme/';
$config['admin_theme_base_file'] = 'global';
$config['admin_theme_meta_file'] = 'meta';
$config['admin_theme_header_file'] = 'header';
$config['admin_theme_memberheader_file'] = 'memberheader';
$config['admin_theme_guestheader_file'] = 'guestheader';
$config['admin_theme_sidebar_file'] = 'sidebar';
$config['admin_theme_footer_file'] = 'footer';
$config['admin_theme_breadcrumb_file'] = 'breadcrumb';



/**
 * to_replace and replace_with arrays
 * This is used in the application/helpers/MY_path_helper.php file.  The system
 * will already do a path replacement for items in the themes folder declared in
 * $config['theme_dir'].  If you have other folders created outside of the themes
 * folder above, and want them to be converted to absolute paths, you can declare
 * them here.
 */
$config['to_replace'] = array(
	'sample_replace_string_one',
	'sample_replace_string_two'
);

$config['replace_with'] = array(
	'this is the replaced string sample_replace_string_one',
	'this is the replaced string sample_replace_string_two'
);