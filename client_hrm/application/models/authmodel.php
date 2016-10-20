<?php

class AuthModel extends CI_Model {

    function __construct() {
        // Call the Model constructor
        parent::__construct();
    }

    function getLoginData($data) {
        $this->db->select("u.*, r.role_name");
        $this->db->from("users as u");
        $this->db->where("(u.email_id = '".$data['email']."' OR u.username = '".$data['email']."')");
        $this->db->where("u.password",  md5($data['password']));
        $this->db->join("roles as r", "r.id = u.role_id");
        $this->db->limit(1);
        return $this->db->get()->row_array();
    }
}
