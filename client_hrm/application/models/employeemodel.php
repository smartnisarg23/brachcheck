<?php

class EmployeeModel extends CI_Model {

    function __construct() {
        // Call the Model constructor
        parent::__construct();
        $this->table = "employees";
        $this->admindb = $this->load->database('admin_db', TRUE);
    }

    function getAllEmployees() {
        $this->db->select("e.*, r.r_name as role, com.c_name as com_name, b.b_name as branch, d.d_name as department, c.c_name as costcenter, dc.d_name as deliverycenter");
        $this->db->from($this->table . " as e ");
        $this->db->join("roles as r", "r.id = e.e_role_id");
        $this->db->join("companies as com", "com.id = e.e_company_id", "left");
        $this->db->join("branches as b", "b.id = e.e_branch_id", "left");
        $this->db->join("departments as d", "d.id = e.e_department_id", "left");
        $this->db->join("costcenters as c", "c.id = e.e_costcenter_id", "left");
        $this->db->join("deliverycenters as dc", "dc.id = e.e_deliverycenter_id", "left");
        if ($this->session->userdata['remote_user_data']['employee']['e_role_id'] == 1) {
            $this->db->where("e.e_company_id", $this->session->userdata['remote_user_data']['employee']['e_company_id']);
        } elseif ($this->session->userdata['remote_user_data']['employee']['e_role_id'] == 2) {
            $this->db->where("e.e_company_id", $this->session->userdata['remote_user_data']['employee']['e_company_id']);
            $this->db->where("e.e_branch_id", $this->session->userdata['remote_user_data']['employee']['e_branch_id']);
        } elseif ($this->session->userdata['remote_user_data']['employee']['e_role_id'] == 3) {
            $this->db->where("e.e_company_id", $this->session->userdata['remote_user_data']['employee']['e_company_id']);
            $this->db->where("e.e_branch_id", $this->session->userdata['remote_user_data']['employee']['e_branch_id']);
            $this->db->where("e.e_department_id", $this->session->userdata['remote_user_data']['employee']['e_department_id']);
        } elseif ($this->session->userdata['remote_user_data']['employee']['e_role_id'] == 4) {
            $this->db->where("e.e_company_id", $this->session->userdata['remote_user_data']['employee']['e_company_id']);
            $this->db->where("e.e_branch_id", $this->session->userdata['remote_user_data']['employee']['e_branch_id']);
            $this->db->where("e.e_costcenter_id", $this->session->userdata['remote_user_data']['employee']['e_costcenter_id']);
        } elseif ($this->session->userdata['remote_user_data']['employee']['e_role_id'] == 5) {
            $this->db->where("e.e_company_id", $this->session->userdata['remote_user_data']['employee']['e_company_id']);
            $this->db->where("e.e_branch_id", $this->session->userdata['remote_user_data']['employee']['e_branch_id']);
            $this->db->where("e.e_deliverycenter_id", $this->session->userdata['remote_user_data']['employee']['e_deliverycenter_id']);
        }
        $this->db->where("e.e_status !=", -1);
        $this->db->order_by("e.id", "desc");
        return $this->db->get()->result_array();
    }

    function getAllCanLoginEmployees() {
        $this->db->select();
        $this->db->from($this->table);
        $this->db->where("e_status", 1);
        $this->db->where("e_can_login", 1);
        return $this->db->get()->result_array();
    }
    
    function getEmployee($id) {
        $this->db->select("e.*, r.r_name as role, com.c_name as com_name, b.b_name as branch, d.d_name as department, c.c_name as costcenter, dc.d_name as deliverycenter");
        $this->db->from($this->table . " as e ");
        $this->db->join("roles as r", "r.id = e.e_role_id");
        $this->db->join("companies as com", "com.id = e.e_company_id", "left");
        $this->db->join("branches as b", "b.id = e.e_branch_id", "left");
        $this->db->join("departments as d", "d.id = e.e_department_id", "left");
        $this->db->join("costcenters as c", "c.id = e.e_costcenter_id", "left");
        $this->db->join("deliverycenters as dc", "dc.id = e.e_deliverycenter_id", "left");
        if ($this->session->userdata['remote_user_data']['employee']['e_role_id'] == 1) {
            $this->db->where("e.e_company_id", $this->session->userdata['remote_user_data']['employee']['e_company_id']);
        } elseif ($this->session->userdata['remote_user_data']['employee']['e_role_id'] == 2) {
            $this->db->where("e.e_company_id", $this->session->userdata['remote_user_data']['employee']['e_company_id']);
            $this->db->where("e.e_branch_id", $this->session->userdata['remote_user_data']['employee']['e_branch_id']);
        } elseif ($this->session->userdata['remote_user_data']['employee']['e_role_id'] == 3) {
            $this->db->where("e.e_company_id", $this->session->userdata['remote_user_data']['employee']['e_company_id']);
            $this->db->where("e.e_branch_id", $this->session->userdata['remote_user_data']['employee']['e_branch_id']);
            $this->db->where("e.e_department_id", $this->session->userdata['remote_user_data']['employee']['e_department_id']);
        } elseif ($this->session->userdata['remote_user_data']['employee']['e_role_id'] == 4) {
            $this->db->where("e.e_company_id", $this->session->userdata['remote_user_data']['employee']['e_company_id']);
            $this->db->where("e.e_branch_id", $this->session->userdata['remote_user_data']['employee']['e_branch_id']);
            $this->db->where("e.e_costcenter_id", $this->session->userdata['remote_user_data']['employee']['e_costcenter_id']);
        } elseif ($this->session->userdata['remote_user_data']['employee']['e_role_id'] == 5) {
            $this->db->where("e.e_company_id", $this->session->userdata['remote_user_data']['employee']['e_company_id']);
            $this->db->where("e.e_branch_id", $this->session->userdata['remote_user_data']['employee']['e_branch_id']);
            $this->db->where("e.e_deliverycenter_id", $this->session->userdata['remote_user_data']['employee']['e_deliverycenter_id']);
        }
        $this->db->where("e.id", $id);
        return $this->db->get()->row_array();
    }

    function getEmployeeByEmail($email) {
        $this->db->select("e.*, r.r_name as role, b.b_name as branch, d.d_name as department, c.c_name as costcenter, dc.d_name as deliverycenter");
        $this->db->from($this->table . " as e ");
        $this->db->join("roles as r", "r.id = e.e_role_id", "left");
        $this->db->join("branches as b", "b.id = e.e_branch_id", "left");
        $this->db->join("departments as d", "d.id = e.e_department_id", "left");
        $this->db->join("costcenters as c", "c.id = e.e_costcenter_id", "left");
        $this->db->join("deliverycenters as dc", "dc.id = e.e_deliverycenter_id", "left");
        $this->db->where("e.e_email", $email);
        return $this->db->get()->row_array();
    }

    function createEmployee($data) {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }

    function updateEmployee($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update($this->table, $data);
    }

    function deleteEmployee($id) {
        $this->db->where('id', $id);
        return $this->db->update($this->table, array("e_status" => -1));
    }

    function emailExists($email) {
        $this->db->where('e_email', $email);
        $query = $this->db->get($this->table);
        return $query->num_rows();
    }

    function emailExistsUpdate($id, $email) {
        $this->db->select();
        $this->db->from($this->table);
        $this->db->where("id != ", $id);
        $this->db->where("e_email", $email);
        $query = $this->db->get();
        return $query->num_rows();
    }

    function createClientInAdminPortal($data) {
        $data['create_date'] = date("Y-m-d H:i:s");
        $this->admindb->insert("clients", $data);
        return $this->admindb->insert_id();
    }

    function updateClientInAdminPortal($id, $data) {
        $data['update_date'] = date("Y-m-d H:i:s");
        $this->admindb->where('client_id', $id);
        return $this->admindb->update("clients", $data);
    }

    function getClientIdByEmployeeEmail($email) {
        $this->admindb->select();
        $this->admindb->from("users");
        $this->admindb->where("email_id", $email);
        return $this->admindb->get()->row_array();
    }

    function createLoginUser($data) {
        $this->admindb->insert("users", $data);
        return $this->admindb->insert_id();
    }

    function updateLoginUser($id, $data) {
        $this->admindb->where('id', $id);
        return $this->admindb->update("users", $data);
    }

    function getEmployeePassword($id) {
        $this->admindb->select("id, password");
        $this->admindb->from("users");
        $this->admindb->where("id", $id);
        return $this->admindb->get()->row_array();
    }

}
