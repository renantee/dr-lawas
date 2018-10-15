<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Asset Class
 * 
 * Class for managing files such as js, image and css path
 *
 * @package		CodeIgniter
 * @subpackage	Libraries
 * @category	Libraries
 * @author		Mark Johnson P. Pilar
 */
class Asset {

	private $_ci;
	private $_theme = NULL;
	
	/**
	 * Constructor
	 */ 
	 public function __construct()
	 {
		$this->_ci =& get_instance();
	 }
	 
	 /**
	 * Return the css file path
	 *
	 */
	 public function css_path($css, $theme = '')
	 {
		$base_url = config_item('base_url');
		
		if (strlen(trim($theme)) > 0) {
			$theme = $this->get_theme_name();
			$path = $base_url . APPPATH . 'themes/' . $theme . '/css/' . $css;
		} else {
			$path = $base_url . 'resources/css/' . $css;
		}
		return $path;
	 }
	 
	 /**
	 * Returns the js file path
	 *
	 */
	 public function js_path($js, $theme = '')
	 {
		$base_url = config_item('base_url');
		
		if (strlen(trim($theme)) > 0) {
			$theme = $this->get_theme_name();
			$path = $base_url . APPPATH . 'themes/' . $theme . '/js/' . $js;
		} else {
			$path = $base_url . 'resources/js/' . $js;
		}
		return $path;
	 }
	 
	 /**
	 * Returns the image file path
	 *
	 */
	 public function img_path($img, $theme = '')
	 {
		$base_url = config_item('base_url');
		
		if (strlen(trim($theme)) > 0) {
			$theme = $this->get_theme_name();
			$path = $base_url . APPPATH . 'themes/' . $theme . '/img/' . $img;
		} else {
			$path = $base_url . 'resources/img/' . $img;
		}
		return $path;
	 }
	 
	 /**
	 * Get the theme being set
	 * 
	 * @return theme name
	 */
	 public function get_theme_name()
	 {
		$exp = explode('/', $this->_ci->template->get_theme_path());
		$imp = implode('_', $exp);
		$exp = explode('_', rtrim($imp, '_'));
		
		$this->_theme = end($exp);
		
		return $this->_theme;
	 }
}