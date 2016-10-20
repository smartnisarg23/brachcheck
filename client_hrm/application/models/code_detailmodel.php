<?php

class Code_detailModel extends CI_Model {

    function __construct() {
        // Call the Model constructor
        parent::__construct();
        $this->table = "code_details";
        $this->code_headers = "code_headers";
    }

    function getAllCode_details() {
        $this->db->select("cd.*,ch.ch_id");
        $this->db->from($this->table . " as cd ");
        $this->db->join($this->code_headers . " as ch", "cd.cd_header_id = ch.id");
        $this->db->order_by("cd.create_date", "desc");
        return $this->db->get()->result_array();
    }
    
    function getAllCode_detailsByType($type) {
        $this->db->select("cd.*,ch.ch_id");
        $this->db->from($this->table . " as cd ");
        $this->db->join($this->code_headers . " as ch", "cd.cd_header_id = ch.id");
        $this->db->where("ch.ch_id", $type);
        $this->db->order_by("cd.create_date", "desc");
        return $this->db->get()->result_array();
    }

    function getCode_detail($id) {
        $this->db->select("cd.*,ch.ch_id");
        $this->db->from($this->table . " as cd ");
        $this->db->join($this->code_headers . " as ch", "cd.cd_header_id = ch.id");
        $this->db->where("cd.id", $id);
        return $this->db->get()->row_array();
    }

    function createCode_detail($data) {
        $data['create_date'] = date("Y-m-d H:i:s");
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }

    function updateCode_detail($id, $data) {
        $data['update_date'] = date("Y-m-d H:i:s");
        $this->db->where('id', $id);
        return $this->db->update($this->table, $data);
    }

    function deleteCode_detail($id) {
        return $this->db->delete($this->table, array("id" => $id));
    }

    function check_unique($header_id, $cd_id) {
        $this->db->select();
        $this->db->from($this->table);
        $this->db->where("cd_header_id", $header_id);
        $this->db->where("cd_id", $cd_id);
        return $this->db->get()->result_array();
    }
}