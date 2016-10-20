<?php

class TruckModel extends CI_Model {

    function __construct() {
        // Call the Model constructor
        parent::__construct();
        $this->table = "trucks";
    }
    
    function getAllTrucks() {
        $this->db->select("t.*, tma.tm_name as t_make, tmo.tm_name as t_model, lc.l_cls_name as t_lic_cls");
        $this->db->from($this->table." as t");
        $this->db->join("truck_makes as tma", "tma.id = t.t_make", "left");
        $this->db->join("truck_models as tmo", "tmo.id = t.t_model", "left");
        $this->db->join("licence_classes as lc", "lc.id = t.t_lic_cls", "left");
        $this->db->order_by("id","desc");
        return $this->db->get()->result_array();
    }
    
    function getTruck($id) {
        $this->db->select();
        $this->db->from($this->table);
        $this->db->where("id",$id);
        return $this->db->get()->row_array();
    }
    
    function createTruck($data) {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }
    
    function updateTruck($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update($this->table, $data); 
    }
    
    function deleteTruck($id) {
        $this->db->where('id', $id);
        return $this->db->update($this->table); 
    }
}