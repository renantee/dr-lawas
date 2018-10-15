<?php
class Patient extends CI_Controller {
	private $data;
	
	public function __construct() {
		parent::__construct();
		date_default_timezone_set('Asia/Manila');
		
		$this->load->model('Patientmodel', 'patient');
		$this->load->model('Medicinemodel', 'medicine');
		$this->layout = "Yes";
		
		$this->data = array();
		$this->data['header'] 	= $this->load->view('header', '', true);		
		$this->data['footer'] 	= $this->load->view('footer', '', true);
		
		$this->data['sidebar'] 	= $this->load->view('sidebar/patient', '', true);
	}
	
	public function index() {
		if(isset($_POST['submitForm'])) {
			switch($_POST['submitForm']) {
				case 'save_patient':
					$newPatient = $this->patient->save_patient($_POST);
					
					redirect("patient/view/$newPatient");
					break;
					
				case 'update_patient':
					$this->patient->save_patient($_POST, 'update');
					
					redirect("patient/view/{$_POST['patient_id']}");
					break;
					
				case 'save_visit':
					$this->patient->save_visit($_POST);
					
					redirect("patient/view/{$_POST['patient_id']}");
					break;
					
				case 'update_visit':
					$this->patient->save_visit($_POST, 'update');
					
					redirect("patient/view/{$_POST['patient_id']}");
					break;
				
				case 'delete_visit':
					$this->patient->save_visit($_POST, 'delete');
					
					redirect("patient/view/{$_POST['patient_id']}");
					break;
					
				default:
			}
		}
		$this->data['patients'] = $this->patient->get_patients();
		
		$this->load->view('content/patient', $this->data);
	}
	
	public function today() {		
		$this->data['patients'] = $this->patient->get_patients(date('Y-m-d'));
		
		$this->load->view('content/patient-today', $this->data);
	}
	
	public function add() {		
		$this->load->view('content/patient-add', $this->data);
	}
	
	public function edit($id) {
		$this->data['info'] = $this->patient->get_patient_info($id);
		
		$this->load->view('content/patient-edit', $this->data);
	}
	
	public function view($id) {
		$this->data['details'] = $this->patient->get_patient_details($id);
		
		$this->data['info'] = $this->patient->get_patient_info($id);
		$this->data['info'][0]->age = $this->patient->calculate_age($this->data['info'][0]->birthdate);
		$this->data['info'][0]->no_of_visit = count($this->data['details']);
		
		$this->data['medicine'] = array();
		foreach($this->data['details'] as $val) {
			$this->data['medicine'][$val->id] = $this->patient->get_patient_medicine($val->id);
		}
		
		$this->load->view('content/patient-view', $this->data);
	}
	
	/*******************
	 * @param $id 	(numeric)	patient ID
	 * @param $type	(string)	visit action
	 * @param $visit(numeric)	visit ID
	 *******************/
	public function visit($id, $type='add', $visit=0) {		
		$this->data['details'] = $this->patient->get_patient_details($id, $visit);
		$this->data['info'] = $this->patient->get_patient_info($id);
		$this->data['info'][0]->age = $this->patient->calculate_age($this->data['info'][0]->birthdate);
		$this->data['info'][0]->no_of_visit = count($this->data['details']);
		
		// for medicine
		$this->_data['medicines'] = $this->medicine->get_medicines();
		$this->data['list_of_medicine'] = $this->load->view('content/lists', $this->_data, true);
		
		switch($type) {
			case 'edit':
				$this->data['visit']['date'] = $this->data['details'][0]->date_visit;
				$this->data['visit']['time'] = $this->data['details'][0]->time_visit;
				
				// patient's medicine
				$this->data['patient_medicine'] = $this->patient->get_patient_medicine($visit);
								
				$this->load->view('content/patient-edit-visit', $this->data);
				break;
				
			case 'delete':
				$this->data['visit']['date'] = $this->data['details'][0]->date_visit;
				$this->data['visit']['time'] = $this->data['details'][0]->time_visit;
				
				// patient's medicine
				$this->data['patient_medicine'] = $this->patient->get_patient_medicine($visit);
								
				$this->load->view('content/patient-delete-visit', $this->data);
				break;
				
			default:
				$this->data['visit']['date'] = date('Y-m-d');
				$this->data['visit']['time'] = date('H:i:s');
				
				$this->load->view('content/patient-visit', $this->data);
		}
	}
}
?>