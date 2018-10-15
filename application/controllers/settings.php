<?php
class Settings extends CI_Controller {
	private $data;
	
	public function __construct() {
		parent::__construct();
		
		$this->layout = "Yes";
		
		$this->data = array();
		$this->data['header'] 	= $this->load->view('header', '', true);		
		$this->data['footer'] 	= $this->load->view('footer', '', true);
		
		$this->data['sidebar'] 	= $this->load->view('sidebar/settings', '', true);
	}
	public function index() {
		$this->data['message'] = '';
		if(isset($_POST['submitForm'])) {
			switch($_POST['submitForm']) {
				case 'save_settings':					
					$settings = array();
					foreach($_POST as $k=>$v) {
						if(in_array($k, array('header', 'rx', 'license', 'ptr', 'tin'))) {
							$settings[$k] = $v;
						}
					}
					$str = json_encode($settings);
					
					$fp = fopen(SETTINGS_CONFIG_FILE, FOPEN_WRITE_CREATE_DESTRUCTIVE);
					fwrite($fp, $str);
					fclose($fp);
					
					$this->data['message'] = '<br /><br /><font color="red">You successfully updated receipt content!</font>';
					break;
					
				default:
			}
		}
	
		$settings = file(SETTINGS_CONFIG_FILE);
		$this->data['settings'] = json_decode($settings[0], true);
		
		$this->load->view('content/settings', $this->data);
	}
}
?>