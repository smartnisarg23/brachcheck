<?php

class UserModel extends CI_Model {

    function __construct() {
        // Call the Model constructor
        parent::__construct();
    }

    function getUsers() {
        $this->db->select("u.*, r.role_name");
        $this->db->from("users as u");
        $this->db->where("u.status", "1");
        $this->db->where("r.status", "1");
        $this->db->join("roles as r", "r.id = u.role_id");
        return $this->db->get()->result_array();
    }

    function getUserById($id) {
        $this->db->select("u.*, r.role_name");
        $this->db->from("users as u");
        $this->db->where("u.id", $id);
        $this->db->join("roles as r", "r.id = u.role_id");
        return $this->db->get()->row_array();
    }

    function getClientData($user_id) {
        $this->db->select("u.*, c.*");
        $this->db->from("users as u");
        $this->db->join("clients as c", "c.client_id = u.client_id");
        $this->db->where("u.id", $user_id);
        return $this->db->get()->row_array();
    }
    
    function getSupplierData($user_id) {
        $this->db->select("u.*, s.*");
        $this->db->from("users as u");
        $this->db->join("suppliers as s", "s.supplier_id = u.supplier_id");
        $this->db->where("u.id", $user_id);
        return $this->db->get()->row_array();
    }

}