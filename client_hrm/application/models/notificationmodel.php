<?php

class NotificationModel extends CI_Model {

    function __construct() {
        // Call the Model constructor
        parent::__construct();
        $this->table = "notifications";
        $this->admindb = $this->load->database('admin_db', TRUE);
    }

    function getAllNotificationes() {
        $this->admindb->select();
        $this->admindb->from($this->table);
        $this->admindb->where("status", 1);
        $this->admindb->order_by("create_date", "desc");
        return $this->admindb->get()->result_array();
    }

    function createNotification($data) {
        $this->admindb->insert($this->table, $data);
        return $this->admindb->insert_id();
    }
    function updateNotification($id) {
        $this->admindb->where('id', $id);
        return $this->admindb->update($this->table, array("status" => 0));
    }
}