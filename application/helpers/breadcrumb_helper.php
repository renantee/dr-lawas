<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Breadcrumb Helper
 * 
 * Helper for generating breadcrumb
 *
 * @package		CodeIgniter
 * @subpackage	Helpers
 * @category	Helpers
 * @author		Mark Johnson P. Pilar
 */
 function breadcrumbs($class = '')
 {	
	$CI =& get_instance();
	$url = $CI->uri->uri_string();	
	$url = explode('/', $url);
	$href = '/';
	
	for ($x=0; $x<count($url); $x++) {
		if ($x != count($url)-1) {
			$href .= $url[$x] . '/';
			$url[$x] = '<a href="'.site_url($href).'" class="link_list">' . humanize($url[$x]) . '</a>';
		} else {
			$url[$x] = '<span style="color: #263c72;">' . humanize($url[$x]) . '</span>';	
		}
	}
	
	return implode(' | ', $url);
 }