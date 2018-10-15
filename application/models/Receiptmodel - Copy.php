<?php
class Receiptmodel extends CI_Model {
	private $table;
	
    function __construct() {
        parent::__construct();
    }
	
	/*************************************
	 * This will get patient visit details
	 * @param: numeric (visit ID)
	 * returns query result
	 *************************************/
	function get_patient($id) {
		$this->db->select('DATE_FORMAT(d.date_visit, "%Y-%m-%d") AS date_visit', FALSE);
		$this->db->select('p.firstname, p.lastname, p.address, d.age, p.sex');		
		$this->db->from('patient AS p');
		$this->db->join('patient_details AS d', 'p.id = d.patient_id', 'left');
		
		$this->db->where('d.id', $id);
		$query = $this->db->get();
		
        return $query->result();
	}
	
	/*************************************
	 * This will get patient medicines
	 * @param: numeric (visit ID)
	 * returns query result
	 *************************************/
	function get_medicine($id) {
		$this->db->select('m.generic_name, m.brand_name, pm.preparation, pm.dosage, pm.pcs');		
		$this->db->from('patient_medicine AS pm');
		$this->db->join('medicine AS m', 'pm.medicine_id = m.id', 'left');
		
		$this->db->where('pm.patient_detail_id', $id);
		$query = $this->db->get();
		
        return $query->result();
	}
}
?>