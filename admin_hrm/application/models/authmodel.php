<?php

class AuthModel extends CI_Model {

    function __construct() {
        // Call the Model constructor
        parent::__construct();
        $this->users = "users";
        $this->clients = "clients";
        $this->suppliers = "suppliers";
    }

    function getLoginData($data) {
        $this->db->select("u.*, r.role_name");
        $this->db->from($this->users." as u");
        $this->db->where("u.email_id", $data['email']);
        $this->db->where("u.password", md5($data['password']));
        $this->db->join("roles as r", "r.id = u.role_id");
        $this->db->limit(1);
        return $this->db->get()->row_array();
    }
    
    function getClientData($client_id) {
        $this->db->select();
        $this->db->from($this->clients);
        $this->db->where("client_id", $client_id);
        $this->db->limit(1);
        return $this->db->get()->row_array();
    }
    
    function getClientDataByUserId($user_id) {
        $this->db->select("c.*,u.client_id as uc_id");
        $this->db->from($this->users." as u");
        $this->db->join($this->clients." as c","c.client_id = u.client_id");
        $this->db->where("u.id", $user_id);
        $this->db->limit(1);
        return $this->db->get()->row_array();
    }
    function getSupplierData($supplier_id) {
        $this->db->select();
        $this->db->from($this->suppliers);
        $this->db->where("supplier_id", $supplier_id);
        $this->db->limit(1);
        return $this->db->get()->row_array();
    }
    function updateLastLogin($id) {
        $this->db->where('id', $id);
        return $this->db->update($this->users, array("last_login"=>date("Y-m-d H:i:s"))); 
    }
}
