<?php

class PermissionModel extends CI_Model {

    function __construct() {
        // Call the Model constructor
        parent::__construct();
        $this->table = "permissions";
    }

    function getAllPermissions() {
        $this->db->select();
        $this->db->from($this->table);
        $this->db->order_by("id", "desc");
        return $this->db->get()->result_array();
    }

    function addPermission($role_id, $controller, $action) {
        $this->db->insert($this->table, array("role_id" => $role_id, "controller" => $controller, "action" => $action));
        return $this->db->insert_id();
    }

    function removePermission($role_id, $controller, $action) {
        $this->db->delete($this->table, array("role_id" => $role_id, "controller" => $controller, "action" => $action));
        return $this->db->affected_rows();
    }

    function getPermissionsByRole($role_id) {
        $this->db->select();
        $this->db->from($this->table);
        $this->db->where("role_id", $role_id);
        $this->db->order_by("id", "desc");
        return $this->db->get()->result_array();
    }
    
    function checkPermission($role_id, $controller, $action) {
        $this->db->select();
        $this->db->from($this->table);
        $this->db->where("role_id", $role_id);
        $this->db->where("controller", $controller);
        $this->db->where("action", $action);
        $this->db->order_by("id", "desc");
        return $this->db->get()->row_array();
    }
}