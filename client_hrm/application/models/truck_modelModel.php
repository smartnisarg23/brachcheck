<?php

class Truck_modelModel extends CI_Model {

    function __construct() {
        // Call the Model constructor
        parent::__construct();
        $this->table = "truck_models";
    }
    
    function getAllTruck_models() {
        $this->db->select("tmo.*, tma.tm_name tm_make");
        $this->db->from($this->table." as tmo");
        $this->db->join("truck_makes as tma", "tma.id = tmo.tm_make", "left");
        $this->db->where("tmo.tm_status !=",-1);
        $this->db->order_by("tmo.id","desc");
        return $this->db->get()->result_array();
    }
    
    function getTruck_model($id) {
        $this->db->select();
        $this->db->from($this->table);
        $this->db->where("id",$id);
        return $this->db->get()->row_array();
    }
    
    function createTruck_model($data) {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }
    
    function updateTruck_model($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update($this->table, $data); 
    }
    
    function deleteTruck_model($id) {
        $this->db->where('id', $id);
        return $this->db->update($this->table, array("tm_status"=>-1)); 
    }
    
    function getMakeModels($make_id){
        $this->db->select();
        $this->db->from($this->table);
        $this->db->where("tm_make",$make_id);
        return $this->db->get()->result_array();
    }
}