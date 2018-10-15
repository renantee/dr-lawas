<?php
class Medicinemodel extends CI_Model {
	private $table;
	
    function __construct() {
        parent::__construct();
		
		$this->table = 'medicine';
    }
	
	function get_medicines() {
		$query = $this->db->get($this->table);
		
        return $query->result();
	}
	
	function get_medicine_info($id) {
		$this->db->where('id', $id);
		$query = $this->db->get($this->table);
		
        return $query->result();
	}
	
	function save_medicine($data, $type='add') {
		foreach($data as $k=>$v) {
			if(in_array($k, array('generic_name', 'brand_name', 'preparation', 'dosage'))) {
				$this->db->set($k, $v);
			}
		}
		
		switch($type) {
			case 'update':
				$this->db->where('id', $data['medicine_id']);
				$this->db->update($this->table); 
				break;
				
			default: // new medicine				
				$this->db->insert($this->table);
		}		
	}
}
?>