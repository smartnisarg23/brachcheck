<?php

class RunModel extends CI_Model {

    function __construct() {
        // Call the Model constructor
        parent::__construct();
        $this->table = "runs";
    }
    
    function getAllRuns() {
        $this->db->select();
        $this->db->from($this->table." as r ");
        $this->db->join("trucks as t", "t.id = r.r_default_truck_id", "left");
        $this->db->where("r_status !=",-1);
        $this->db->order_by("r.id","desc");
        return $this->db->get()->result_array();
    }
    
    function getRun($id) {
        $this->db->select();
        $this->db->from($this->table);
        $this->db->where("id",$id);
        return $this->db->get()->row_array();
    }
    
    function createRun($data) {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }
    
    function updateRun($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update($this->table, $data); 
    }
    
    function deleteRun($id) {
        $this->db->where('id', $id);
        return $this->db->update($this->table, array("tm_status"=>-1)); 
    }
}