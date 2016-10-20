<?php

class CompanyModel extends CI_Model {

    function __construct() {
        // Call the Model constructor
        parent::__construct();
        $this->table = "companies";
    }
    
    function getAllCompanies() {
        $this->db->select();
        $this->db->from($this->table);
        $this->db->where("c_status !=",-1);
//        $this->db->where("id", $this->session->userdata['remote_user_data']['employee']['e_company_id']);
        $this->db->order_by("id","desc");
        return $this->db->get()->result_array();
    }
    
    function getCompany($id) {
        $this->db->select();
        $this->db->from($this->table);
        $this->db->where("id",$id);
        return $this->db->get()->row_array();
    }
    
    function createCompany($data) {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }
    
    function updateCompany($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update($this->table, $data); 
    }
    
    function deleteCompany($id) {
        $this->db->where('id', $id);
        return $this->db->update($this->table, array("c_status"=>-1)); 
    }
}
