<?php

class UniformModel extends CI_Model {

    function __construct() {
        // Call the Model constructor
        parent::__construct();
        $this->table = "employee_uniform_master";
        $this->role_uniform = "employee_role_uniforms";
        $this->employees = "employees";
    }
    
    function getAllUniforms() {
        $this->db->select();
        $this->db->from($this->table);
        $this->db->where("u_status !=",-1);
        $this->db->order_by("id","desc");
        return $this->db->get()->result_array();
    }
    
    function getUniform($id) {
        $this->db->select("u.*, e.e_fname, e.e_lname, e1.e_fname as update_e_fname, e1.e_lname as update_e_lname");
        $this->db->from($this->table." as u ");
        $this->db->join($this->employees." as e", "e.id = u.u_create_user");
        $this->db->join($this->employees." as e1", "e1.id = u.u_update_user");
        $this->db->where("u.id",$id);
        return $this->db->get()->row_array();
    }
    
    function createUniform($data) {
        $data['u_create_date'] = date("Y-m-d H:i:s");
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }
    
    function updateUniform($id, $data) {
        $data['u_update_date'] = date("Y-m-d H:i:s");
        $this->db->where('id', $id);
        return $this->db->update($this->table, $data); 
    }
    
    function deleteUniform($id) {
        $this->db->where('id', $id);
        return $this->db->update($this->table, array("u_status"=>-1)); 
    }
    
    function attachRole($data) {
        $this->db->insert($this->role_uniform, $data);
        return $this->db->insert_id();
    }
    function removeAttachRole($id) {
        $this->db->where("uniform_id", $id);
        return $this->db->delete($this->role_uniform);
    }
    function getUniformRole($id) {
        $this->db->select();
        $this->db->from($this->role_uniform);
        $this->db->where("uniform_id",$id);
        return $this->db->get()->result_array();
    }
}