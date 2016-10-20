<?php

class Truck_makeModel extends CI_Model {

    function __construct() {
        // Call the Model constructor
        parent::__construct();
        $this->table = "truck_makes";
    }
    
    function getAllTruck_makes() {
        $this->db->select();
        $this->db->from($this->table);
        $this->db->where("tm_status !=",-1);
        $this->db->order_by("id","desc");
        return $this->db->get()->result_array();
    }
    
    function getTruck_make($id) {
        $this->db->select();
        $this->db->from($this->table);
        $this->db->where("id",$id);
        return $this->db->get()->row_array();
    }
    
    function createTruck_make($data) {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }
    
    function updateTruck_make($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update($this->table, $data); 
    }
    
    function deleteTruck_make($id) {
        $this->db->where('id', $id);
        return $this->db->update($this->table, array("tm_status"=>-1)); 
    }
}