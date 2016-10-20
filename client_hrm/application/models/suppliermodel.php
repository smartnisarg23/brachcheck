<?php

class SupplierModel extends CI_Model {

    function __construct() {
        // Call the Model constructor
        parent::__construct();
        $this->table = "suppliers";
        $this->supplier_customer_connections = "supplier_customer_connections";
        $this->admindb = $this->load->database('admin_db', TRUE);
        $this->supplierdb = $this->load->database('supplier_db', TRUE);
    }

    function getAllSuppliers() {
        $this->admindb->select();
        $this->admindb->from($this->table);
        return $this->admindb->get()->result_array();
    }

    function shareClientDetails($data) {
        $this->supplierdb->insert($this->supplier_customer_connections, $data);
        return $this->supplierdb->insert_id();
    }

    function checkClientConnection($supplier_id, $client_id) {
        $this->supplierdb->select();
        $this->supplierdb->from($this->supplier_customer_connections);
        $this->supplierdb->where('supplier_id', $supplier_id);
        $this->supplierdb->where('client_id', $client_id);
        return $this->supplierdb->get()->row_array();
    }
    
    function getSharedSuppliers() {
        $this->supplierdb->select("group_concat(supplier_id separator ',') as suppliers",FALSE);
        $this->supplierdb->from($this->supplier_customer_connections);
        return $this->supplierdb->get()->row_array();
    }

}
