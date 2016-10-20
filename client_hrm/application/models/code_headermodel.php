<?php

class Code_headerModel extends CI_Model {

    function __construct() {
        // Call the Model constructor
        parent::__construct();
        $this->table = "code_headers";
    }

    function getAllCode_headers() {
        $this->db->select();
        $this->db->from($this->table);
        $this->db->order_by("create_date", "desc");
        return $this->db->get()->result_array();
    }

    function getCode_header($id) {
        $this->db->select();
        $this->db->from($this->table);
        $this->db->where("id", $id);
        return $this->db->get()->row_array();
    }

    function createCode_header($data) {
        $data['create_date'] = date("Y-m-d H:i:s");
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }

    function updateCode_header($id, $data) {
        $data['update_date'] = date("Y-m-d H:i:s");
        $this->db->where('id', $id);
        return $this->db->update($this->table, $data);
    }

    function deleteCode_header($id) {
        return $this->db->delete($this->table, array("id" => $id));
    }
}