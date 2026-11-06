<?php
class Rtu_model extends CI_Model {
	public function __construct()
	{
	$this->load->database();
	}
	
	/*GET RTU INFO*/
	public function rtu_info($mac_addr){
	 
	$query_rtu = $this->db->query("SELECT `id`,`rtu_sn_number`,
	`connection_type`,
	`update_rtu`,
	`update_rtu_location`,
	`update_rtu_ssh`,
	`update_rtu_force_lp`,
	`mac_addr`,
	`rtu_site_name` FROM meter_rtu
	   WHERE mac_addr = ".$this->db->escape($mac_addr)."");
	return $query_rtu->row_array();

	}
	
	/*GET METER LIST(CONTENT) for csv*/
	public function meter_list($rtu_sn_number){
	
	$query_meter = $this->db->query("SELECT * FROM meter_details
	   WHERE rtu_sn_number_id = ".$this->db->escape($rtu_sn_number)." and meter_status = 'Active' order by meter_name ASC LIMIT 0,32");
	return $query_meter->result_array();

	}

	/*RESET CSV update to ZERO*/
	public function rtu_list_reset_update($mac_addr){
			
	$data = array(
	'update_rtu' => '0',
	);

	$this->db->where('mac_addr', $mac_addr);
	$this->db->update('meter_rtu', $data);
	}
	
	/*RESET Location update to ZERO*/
	public function rtu_location_reset_update($mac_addr){
			
	$data = array( 
	'update_rtu_location' => '0',
	);

	$this->db->where('mac_addr', $mac_addr);
	$this->db->update('meter_rtu', $data);
	}

	/*RESET FORCE LP to ZERO*/
	public function rtu_lp_reset_update($mac_addr){
			
	$data = array(
	'update_rtu_force_lp' => '0',
	);

	$this->db->where('mac_addr', $mac_addr);
	$this->db->update('meter_rtu', $data);
	}
}