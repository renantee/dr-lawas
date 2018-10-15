<?php
class Patientmodel extends CI_Model {
	private $table;
	
    function __construct() {
        parent::__construct();
		
		$this->table = 'patient';
    }
	
	function get_patients($date='') {
		if(!empty($date)) {
			$this->db->select('DATE_FORMAT(d.time_visit, "%h:%i %p") AS time_visit', FALSE);
			$this->db->select('DATE_FORMAT(d.date_visit, "%Y-%m-%d") AS date_visit', FALSE);
			$this->db->select('DATE_FORMAT(p.date_created, "%h:%i %p") AS time_created', FALSE);
			$this->db->select('DATE_FORMAT(p.date_created, "%Y-%m-%d") AS date_created', FALSE);			
			$this->db->select('p.id, p.firstname, p.lastname');
			$this->db->from("{$this->table} AS p");
			$this->db->join('patient_details AS d', 'p.id = d.patient_id', 'left');
			
			$where = "DATE_FORMAT(d.date_visit, '%Y-%m-%d') = '$date' OR DATE_FORMAT(p.date_created, '%Y-%m-%d') = '$date'";
			$this->db->order_by('d.date_visit', 'desc');
			$this->db->order_by('d.time_visit', 'desc');
			$this->db->where($where);
			
			$query = $this->db->get();
		}
		else {
			$this->db->order_by('date_created', 'desc');
			$query = $this->db->get($this->table);
		}
		
        return $query->result();
	}
	
	function get_patient_info($id) {
		$this->db->where('id', $id);
		$query = $this->db->get($this->table);
		
        return $query->result();
	}
	
	/*******************
	 * @param $id 	(numeric)	patient ID
	 * @param $visit(numeric)	visit ID
	 *******************/
	function get_patient_details($id, $visit=0) {
		$this->db->select('DATE_FORMAT(d.date_visit, "%Y-%m-%d") AS date_visit', FALSE);
		$this->db->select('DATE_FORMAT(d.time_visit, "%h:%i %p") AS time_visit', FALSE);
		$this->db->select('d.id, d.patient_id, d.age, d.weight');		
		$this->db->from("{$this->table} AS p");
		$this->db->join('patient_details AS d', 'p.id = d.patient_id', 'left');
		
		$this->db->where('patient_id', $id);
		if($visit) {
			$this->db->where('d.id', $visit);
		}
		$this->db->order_by('d.date_visit', 'desc');
		$this->db->order_by('d.time_visit', 'desc');		
		$query = $this->db->get();
		
        return $query->result();
	}	
	
	function get_patient_medicine($id) {
		$this->db->select('m.generic_name, m.brand_name, p.medicine_id, p.preparation, p.dosage, p.pcs');		
		$this->db->from("patient_medicine AS p");
		$this->db->join('medicine AS m', 'p.medicine_id = m.id', 'left');
		
		$this->db->where('p.patient_detail_id', $id);
		$this->db->order_by('p.id');
		$query = $this->db->get();
		
        return $query->result();
	}
	
	function save_patient($data, $type='add') {
		foreach($data as $k=>$v) {
			if(in_array($k, array('firstname', 'middlename', 'lastname', 'sex', 'birthdate', 'address'))) {
				$this->db->set($k, $v);
			}
		}
		
		switch($type) {
			case 'update':
				date_default_timezone_set('Asia/Manila');
				$this->db->set('date_updated', date("Y-m-d H:i:s"));
							
				$this->db->where('id', $data['patient_id']);				
				$this->db->update($this->table); 
				break;
				
			default: // new patient	
				$this->db->insert($this->table);
				return $this->db->insert_id();
		}
	}
	
	function save_visit($data, $type='add') {
		foreach($data as $k=>$v) {
			if(in_array($k, array('patient_id', 'date_visit', 'time_visit', 'age', 'weight'))) {
				$this->db->set($k, $v);
			}
		}
		
		switch($type) {
			case 'update':
				$this->db->where('id', $data['visit_id']);
				$this->db->update('patient_details');
				$patient_detail_id = $data['visit_id'];
				
				// delete existing medicine
				$this->db->where('patient_detail_id', $data['visit_id']);
				$this->db->delete('patient_medicine');
				break;
				
			case 'delete':
				// delete visit
				$this->db->where('id', $data['visit_id']);
				$this->db->delete('patient_details');
				
				// delete existing medicine
				$this->db->where('patient_detail_id', $data['visit_id']);
				$this->db->delete('patient_medicine');
				break;
					
			default: // new patient visit details
				$this->db->insert('patient_details');
				$patient_detail_id = $this->db->insert_id();
		}
		
		// new medicine details
		if(isset($data['medicine_id'])) {
			foreach($data['medicine_id'] as $k=>$v) {
				$this->db->set('patient_detail_id', $patient_detail_id);
				$this->db->set('medicine_id', $v);
				$this->db->set('preparation', $data['preparation'][$k]);
				$this->db->set('dosage', $data['dosage'][$k]);
				$this->db->set('pcs', $data['pcs'][$k]);
				
				$this->db->insert('patient_medicine');
			}
		}
	}
	
	function calculate_age($dob) {
		list($y,$m,$d) = explode('-', $dob);
	   
		if(($m = (date('m') - $m)) < 0) {
			$y++;
		} 
		elseif($m == 0 && date('d') - $d < 0) {
			$y++;
		}
	   
		return date('Y') - $y;   
	}
}
?>