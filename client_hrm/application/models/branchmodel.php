<?php

class BranchModel extends CI_Model {

    function __construct() {
        // Call the Model constructor
        parent::__construct();
        $this->table = "branches";
    }

    function getAllBranches() {
        $this->db->select("b.*,c.c_name");
        $this->db->from($this->table . " as b ");
        $this->db->join("companies as c ", "c.id = b.b_company_id");
        if ($this->session->userdata['remote_user_data']['employee']['e_role_id'] == 1) {
            $this->db->where("b.b_company_id", $this->session->userdata['remote_user_data']['employee']['e_company_id']);
        } elseif ($this->session->userdata['remote_user_data']['employee']['e_role_id'] == 2) {
            $this->db->where("b.b_company_id", $this->session->userdata['remote_user_data']['employee']['e_company_id']);
            $this->db->where("b.id", $this->session->userdata['remote_user_data']['employee']['e_branch_id']);
        }
        $this->db->where("b.b_status !=", -1);
        $this->db->order_by("b.id", "desc");
        return $this->db->get()->result_array();
    }

    function getBranch($id) {
        $this->db->select();
        $this->db->from($this->table);
        $this->db->where("id", $id);
        if ($this->session->userdata['remote_user_data']['employee']['e_role_id'] == 1) {
            $this->db->where("b_company_id", $this->session->userdata['remote_user_data']['employee']['e_company_id']);
        } elseif ($this->session->userdata['remote_user_data']['employee']['e_role_id'] == 2) {
            $this->db->where("b_company_id", $this->session->userdata['remote_user_data']['employee']['e_company_id']);
            $this->db->where("id", $this->session->userdata['remote_user_data']['employee']['e_branch_id']);
        }
        return $this->db->get()->row_array();
    }

    function createBrach($data) {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }

    function updateBrach($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update($this->table, $data);
    }

    function deleteBrach($id) {
        $this->db->where('id', $id);
        return $this->db->update($this->table, array("b_status" => -1));
    }

    function getCompanyBranches($company_id) {
        $this->db->select("id, b_name");
        $this->db->from($this->table);
        $this->db->where("b_company_id", $company_id);
        if ($this->session->userdata['remote_user_data']['employee']['e_role_id'] != 1) {
            $this->db->where("id", $this->session->userdata['remote_user_data']['employee']['e_branch_id']);
        }
        $this->db->where("b_status !=", -1);
        $this->db->order_by("id", "desc");
        return $this->db->get()->result_array();
    }

}
