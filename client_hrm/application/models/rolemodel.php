<?php

class RoleModel extends CI_Model {

    function __construct() {
        // Call the Model constructor
        parent::__construct();
        $this->table = "roles";
    }
    
    function getAllRoles() {
        $this->db->select();
        $this->db->from($this->table);
        $this->db->where("r_status !=",-1);
        $this->db->order_by("id","desc");
        return $this->db->get()->result_array();
    }
    
    function getRole($id) {
        $this->db->select();
        $this->db->from($this->table);
        $this->db->where("id",$id);
        return $this->db->get()->row_array();
    }
    
    function createRole($data) {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }
    
    function updateRole($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update($this->table, $data); 
    }
    
    function deleteRole($id) {
        $this->db->where('id', $id);
        return $this->db->update($this->table, array("r_status"=>-1)); 
    }
}