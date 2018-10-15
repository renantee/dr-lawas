<?php
class Lists extends CI_Controller {
	private $data;
	
	public function __construct() {
		parent::__construct();
		
		$this->load->model('Medicinemodel', 'medicine');
		$this->layout = "No";
		
		$this->data = array();
	}
	public function index() {
		$this->data['medicines'] = $this->medicine->get_medicines();
		
		$this->load->view('content/lists', $this->data);
	}
}
?>