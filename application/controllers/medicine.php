<?php
class Medicine extends CI_Controller {
	private $data;
	
	public function __construct() {
		parent::__construct();
		
		$this->load->model('Medicinemodel', 'medicine');
		$this->layout = "Yes";
		
		$this->data = array();
		$this->data['header'] 	= $this->load->view('header', '', true);		
		$this->data['footer'] 	= $this->load->view('footer', '', true);
		
		$this->data['sidebar'] 	= $this->load->view('sidebar/medicine', '', true);
	}
	public function index() {
		if(isset($_POST['submitForm'])) {
			//echo "<pre>"; print_r($_POST); echo "</pre>";
			switch($_POST['submitForm']) {
				case 'save_medicine':
					$this->medicine->save_medicine($_POST);
					break;
					
				case 'update_medicine':
					$this->medicine->save_medicine($_POST, 'update');
					break;
					
				default:
			}
		}
		$this->data['medicines'] = $this->medicine->get_medicines();
		
		$this->load->view('content/medicine', $this->data);
	}
	
	public function add() {		
		$this->load->view('content/medicine-add', $this->data);
	}
	
	public function edit($id) {
		$this->data['info'] = $this->medicine->get_medicine_info($id);
		
		$this->load->view('content/medicine-edit', $this->data);
	}
}
?>