<?php

class DepartmentModel extends CI_Model {

    function __construct() {
        // Call the Model constructor
        parent::__construct();
        $this->table = "departments";
    }

    function getAllDepartments() {
        $this->db->select("d.*, b.b_name, c.c_name");
        $this->db->from($this->table . " as d");
        $this->db->join("companies as c", "c.id = d.d_company_id");
        $this->db->join("branches as b", "b.id = d.d_branch_id");
        if ($this->session->userdata['remote_user_data']['employee']['e_role_id'] == 1) {
            $this->db->where("d.d_company_id", $this->session->userdata['remote_user_data']['employee']['e_company_id']);
        } elseif ($this->session->userdata['remote_user_data']['employee']['e_role_id'] == 2) {
            $this->db->where("d.d_company_id", $this->session->userdata['remote_user_data']['employee']['e_company_id']);
            $this->db->where("d.d_branch_id", $this->session->userdata['remote_user_data']['employee']['e_branch_id']);
        } elseif ($this->session->userdata['remote_user_data']['employee']['e_role_id'] == 3) {
            $this->db->where("d.d_company_id", $this->session->userdata['remote_user_data']['employee']['e_company_id']);
            $this->db->where("d.d_branch_id", $this->session->userdata['remote_user_data']['employee']['e_branch_id']);
            $this->db->where("d.id", $this->session->userdata['remote_user_data']['employee']['e_department_id']);
        }
        $this->db->where("d.d_status !=", -1);
        $this->db->order_by("d.id", "desc");
        return $this->db->get()->result_array();
    }

    function getDepartment($id) {
        $this->db->select();
        $this->db->from($this->table);
        $this->db->where("id", $id);
        return $this->db->get()->row_array();
    }

    function createDepartment($data) {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }

    function updateDepartment($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update($this->table, $data);
    }

    function deleteDepartment($id) {
        $this->db->where('id', $id);
        return $this->db->update($this->table, array("d_status" => -1));
    }

    function getBranchDepartments($company_id, $branch_id) {
        $this->db->select("id, d_name");
        $this->db->from($this->table);
        $this->db->where("d_company_id", $company_id);
        $this->db->where("d_branch_id", $branch_id);
        $this->db->where("d_status !=", -1);
        $this->db->order_by("id", "desc");
        return $this->db->get()->result_array();
    }

}
