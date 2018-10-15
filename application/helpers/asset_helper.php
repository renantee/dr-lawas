<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Asset Helper
 * 
 * Helper for getting the css, js and image path
 *
 * @package		CodeIgniter
 * @subpackage	Helpers
 * @category	Helpers
 * @author		Mark Johnson P. Pilar
 */
 function css($file)
 {
	$CI =& get_instance();
	$CI->load->library('asset');
	return $CI->asset->css_path($file);
 }
 
 function theme_css($file)
 {
	$CI =& get_instance();
	$CI->load->library('asset');
	$theme = $CI->asset->get_theme_name();
	return $CI->asset->css_path($file, $theme);
 }
 
 function js($file)
 {
	$CI =& get_instance();
	$CI->load->library('asset');
	return $CI->asset->js_path($file);
 }
 
 function theme_js($file)
 {
	$CI =& get_instance();
	$CI->load->library('asset');
	$theme = $CI->asset->get_theme_name();
	return $CI->asset->js_path($file, $theme);
 }
 
 function img($file)
 {
	$CI =& get_instance();
	$CI->load->library('asset');
	return $CI->asset->img_path($file);
 }
 
 function theme_img($file)
 {
	$CI =& get_instance();
	$CI->load->library('asset');
	$theme = $CI->asset->get_theme_name();
	return $CI->asset->img_path($file, $theme);
 }