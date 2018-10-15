<?php
class Home extends CI_Controller {
	private $data;
	
	public function __construct() {
		parent::__construct();
		
		$this->layout = "Yes";
		
		$this->data = array();
		$this->data['header'] 	= $this->load->view('header', '', true);		
		$this->data['footer'] 	= $this->load->view('footer', '', true);
		
		$this->data['sidebar'] 	= $this->load->view('sidebar/home', '', true);
	}
	public function index() {		
		$this->load->view('content/home', $this->data);
	}
}
?>