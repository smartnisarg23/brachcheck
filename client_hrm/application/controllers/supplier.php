<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Supplier extends CI_Controller {

    function __construct() {
        parent::__construct();
        check_permission();
        $this->load->model('SupplierModel');
        $this->load->model('NotificationModel');
        $this->breadcrumb->add('Home', base_url());
    }

    public function index() {
        $suppliers = $this->SupplierModel->getAllSuppliers();
        $shared_suppliers = $this->SupplierModel->getSharedSuppliers();
        $data['shared_suppliers'] = explode(',', $shared_suppliers['suppliers']);
        $data['page_title'] = "Suppliers";
        $data['page_name'] = "supplier/index";
        $data['suppliers'] = $suppliers;
        $this->breadcrumb->add($data['page_title'], $data['page_name']);
        $this->load->view('index', $data);
    }

    public function share_details() {
        $supplier_id = $this->input->post('supplier_id');
        $checkShareDetails = $this->SupplierModel->checkClientConnection($supplier_id, $this->session->userdata['remote_user_data']['employee']['id']);
        if (count($checkShareDetails) < 1) {
            $connection_data = array("supplier_id" => $supplier_id,
                "client_id" => $this->session->userdata['remote_user_data']['client_id'],
                "connection_date" => date("Y-m-d H:i:s"),
                "status" => 1);
            $this->SupplierModel->shareClientDetails($connection_data);
            $notification_data = array("user_portal" => 'supplier',
                "type" => 'client_details',
                "user_id" => $supplier_id,
                "message" => $this->session->userdata['remote_user_data']['employee']['e_fname'] . ' ' . $this->session->userdata['remote_user_data']['employee']['e_lname'] . ' shared his contact details with you.',
                "create_date" => date("Y-m-d H:i:s"),
                "status" => 1);
            $this->NotificationModel->createNotification($notification_data);
        }
    }

}
