<?php

class CostcenterModel extends CI_Model {

    function __construct() {
        // Call the Model constructor
        parent::__construct();
        $this->table = "costcenters";
    }

    function getAllCostcenters() {
        $this->db->select("c.*, b.b_name, com.c_name as com_name");
        $this->db->from($this->table . " as c");
        $this->db->join("branches as b", "b.id = c.c_branch_id", "left");
        $this->db->join("companies as com", "com.id = c.c_company_id", "left");
        if ($this->session->userdata['remote_user_data']['employee']['e_role_id'] == 1) {
            $this->db->where("c.c_company_id", $this->session->userdata['remote_user_data']['employee']['e_company_id']);
        } elseif ($this->session->userdata['remote_user_data']['employee']['e_role_id'] == 2) {
            $this->db->where("c.c_company_id", $this->session->userdata['remote_user_data']['employee']['e_company_id']);
            $this->db->where("c.c_branch_id", $this->session->userdata['remote_user_data']['employee']['e_branch_id']);
        } elseif ($this->session->userdata['remote_user_data']['employee']['e_role_id'] == 4) {
            $this->db->where("c.c_company_id", $this->session->userdata['remote_user_data']['employee']['e_company_id']);
            $this->db->where("c.c_branch_id", $this->session->userdata['remote_user_data']['employee']['e_branch_id']);
            $this->db->where("c.id", $this->session->userdata['remote_user_data']['employee']['e_costcenter_id']);
        }
        $this->db->where("c.c_status !=", -1);
        $this->db->order_by("c.id", "desc");
        return $this->db->get()->result_array();
    }

    function getCostcenter($id) {
        $this->db->select();
        $this->db->from($this->table);
        $this->db->where("id", $id);
        return $this->db->get()->row_array();
    }

    function createCostcenter($data) {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }

    function updateCostcenter($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update($this->table, $data);
    }

    function deleteCostcenter($id) {
        $this->db->where('id', $id);
        return $this->db->update($this->table, array("c_status" => -1));
    }

    function getBranchCostcenters($company_id, $branch_id) {
        $this->db->select("id, c_name");
        $this->db->from($this->table);
        $this->db->where("c_company_id", $company_id);
        $this->db->where("c_branch_id", $branch_id);
        $this->db->where("c_status !=", -1);
        $this->db->order_by("id", "desc");
        return $this->db->get()->result_array();
    }

}
