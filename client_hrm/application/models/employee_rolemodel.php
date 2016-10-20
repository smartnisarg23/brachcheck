<?php

class Employee_roleModel extends CI_Model {

    function __construct() {
        // Call the Model constructor
        parent::__construct();
        $this->table = "employee_roles";
        $this->role_uniform = "employee_role_uniforms";
        $this->employees = "employees";
    }
    
    function getAllRoles() {
        $this->db->select();
        $this->db->from($this->table);
        $this->db->where("r_status !=",-1);
        $this->db->order_by("r_name","asc");
        return $this->db->get()->result_array();
    }
    
    function getRole($id) {
        $this->db->select("er.*, e.e_fname, e.e_lname, e1.e_fname as update_e_fname, e1.e_lname as update_e_lname");
        $this->db->from($this->table." as er ");
        $this->db->join($this->employees." as e", "e.id = er.r_create_user");
        $this->db->join($this->employees." as e1", "e1.id = er.r_update_user");
        $this->db->where("er.id",$id);
        return $this->db->get()->row_array();
    }
    
    function createRole($data) {
        $data['r_create_date'] = date("Y-m-d H:i:s");
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }
    
    function updateRole($id, $data) {
        $data['r_update_date'] = date("Y-m-d H:i:s");
        $this->db->where('id', $id);
        return $this->db->update($this->table, $data); 
    }
    
    function deleteRole($id) {
        $this->db->where('id', $id);
        return $this->db->update($this->table, array("r_status"=>-1)); 
    }
    function getRoleUniform($id) {
        $this->db->select();
        $this->db->from($this->role_uniform);
        $this->db->where("role_id",$id);
        return $this->db->get()->result_array();
    }
    
    function getRoleEmployee($id) {
        $this->db->select();
        $this->db->from($this->employees);
        $this->db->where("e_role_type_id",$id);
        return $this->db->get()->result_array();
    }
}