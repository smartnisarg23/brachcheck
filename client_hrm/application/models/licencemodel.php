<?php

class LicenceModel extends CI_Model {

    function __construct() {
        // Call the Model constructor
        parent::__construct();
        $this->table = "licence_classes";
    }
    
    function getAllLicences() {
        $this->db->select();
        $this->db->from($this->table);
        $this->db->where("l_status !=",-1);
        $this->db->order_by("id","desc");
        return $this->db->get()->result_array();
    }
    
    function getLicence($id) {
        $this->db->select();
        $this->db->from($this->table);
        $this->db->where("id",$id);
        return $this->db->get()->row_array();
    }
    
    function createLicence($data) {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }
    
    function updateLicence($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update($this->table, $data); 
    }
    
    function deleteLicence($id) {
        $this->db->where('id', $id);
        return $this->db->update($this->table, array("l_status"=>-1)); 
    }
}