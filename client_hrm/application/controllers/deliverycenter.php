<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Deliverycenter extends CI_Controller {

    function __construct() {
        parent::__construct();
        $allow_methods = array("get_branch_deliverycenter");
        check_permission($allow_methods);
        $this->load->model('BranchModel');
        $this->load->model('DepartmentModel');
        $this->load->model('DeliverycenterModel');
        $this->load->model('CompanyModel');
        $this->load->model('EmployeeModel');
        $this->load->model('Code_detailModel');
        $this->breadcrumb->add('Home', base_url());
        if($this->router->fetch_method() == "index"){
            $this->datatable = TRUE;
        }
    }

    public function index() {
        $deliverycenters = $this->DeliverycenterModel->getAllDeliverycenters();
        $data['page_title'] = "Delivery centers";
        $data['page_name'] = "deliverycenter/index";
        $data['css'] = array("css/plugins/dataTables/datatables.min.css");
        $data['js'] = array("js/plugins/dataTables/datatables.min.js");
        $data['deliverycenters'] = $deliverycenters;
        $this->breadcrumb->add($data['page_title'], $data['page_name']);
        $this->load->view('index', $data);
    }

    public function create() {
        if (!empty($this->input->post())) {
            $this->form_validation->set_rules('d_name', 'Name', 'trim|required|xss_clean');
            $this->form_validation->set_rules('d_code', 'Code', 'trim|xss_clean');
            $this->form_validation->set_rules('d_company_id', 'Company', 'trim|required|xss_clean');
            $this->form_validation->set_rules('d_branch_id', 'Branch', 'trim|required|xss_clean');
            $this->form_validation->set_rules('d_address_street', 'Street address', 'trim|xss_clean');
            $this->form_validation->set_rules('d_address_area', 'Area address', 'trim|xss_clean');
            $this->form_validation->set_rules('d_address_city', 'City address', 'trim|xss_clean');
            $this->form_validation->set_rules('d_address_state', 'State address', 'trim|xss_clean');
            $this->form_validation->set_rules('d_address_country', 'Country address', 'trim|xss_clean');
            $this->form_validation->set_rules('d_address_pincode', 'Pincode', 'trim|xss_clean');
            $this->form_validation->set_rules('d_approval_type', 'Approval type', 'trim|required|xss_clean');
            if ($this->input->post('d_approval_type') != "4") {
                $this->form_validation->set_rules('d_approver_id', 'Approver', 'trim|required|xss_clean');
            } else {
                $this->form_validation->set_rules('d_approver_id', 'Approver', 'trim|xss_clean');
            }
            $this->form_validation->set_rules('d_status', 'Status', 'trim|xss_clean');
            $post_data = $this->input->post();
            if ($this->form_validation->run() === TRUE) {
                $inserted_id = $this->DeliverycenterModel->createDeliverycenter($post_data);
                if ($inserted_id != "") {
                    $this->session->set_flashdata("success", "Delivery center is successfully created.");
                    redirect(base_url("deliverycenter/index"));
                } else {
                    $this->session->set_flashdata("error", DB_OPERATION_ERROR);
                }
            } else {
                $data = $post_data;
            }
        }
        $data['companies'] = $this->CompanyModel->getAllCompanies();
        $data['employees'] = $this->EmployeeModel->getAllCanLoginEmployees();
        $data['code_details'] = $this->Code_detailModel->getAllCode_detailsByType("APPROVAL_TYPE");
        $data['page_title'] = "Create delivery center";
        $data['page_name'] = "deliverycenter/create";
        $this->breadcrumb->add("Delivery center", base_url("deliverycenter/index"));
        $this->breadcrumb->add($data['page_title'], $data['page_name']);
        $this->load->view('index', $data);
    }

    public function update($id) {
        if (!empty($this->input->post())) {
            $this->form_validation->set_rules('d_name', 'Name', 'trim|required|xss_clean');
            $this->form_validation->set_rules('d_code', 'Code', 'trim|xss_clean');
            $this->form_validation->set_rules('d_company_id', 'Company', 'trim|required|xss_clean');
            $this->form_validation->set_rules('d_branch_id', 'Branch', 'trim|xss_clean');
            $this->form_validation->set_rules('d_address_street', 'Street address', 'trim|xss_clean');
            $this->form_validation->set_rules('d_address_area', 'Area address', 'trim|xss_clean');
            $this->form_validation->set_rules('d_address_city', 'City address', 'trim|xss_clean');
            $this->form_validation->set_rules('d_address_state', 'State address', 'trim|xss_clean');
            $this->form_validation->set_rules('d_address_country', 'Country address', 'trim|xss_clean');
            $this->form_validation->set_rules('d_address_pincode', 'Pincode', 'trim|xss_clean');
            $this->form_validation->set_rules('d_approval_type', 'Approval type', 'trim|required|xss_clean');
            if ($this->input->post('d_approval_type') != "4") {
                $this->form_validation->set_rules('d_approver_id', 'Approver', 'trim|required|xss_clean');
            } else {
                $this->form_validation->set_rules('d_approver_id', 'Approver', 'trim|xss_clean');
            }
            $this->form_validation->set_rules('d_status', 'Status', 'trim|xss_clean');
            $post_data = $this->input->post();
            if ($this->form_validation->run() === TRUE) {
                $updated_data = $this->DeliverycenterModel->updateDeliverycenter($id, $post_data);
                if ($updated_data) {
                    $this->session->set_flashdata("success", "Delivery center is successfully updated.");
                    redirect(base_url("deliverycenter/index"));
                } else {
                    $this->session->set_flashdata("error", DB_OPERATION_ERROR);
                }
            }
        }

        $data = $this->DeliverycenterModel->getDeliverycenter($id);
        $branches = $this->BranchModel->getCompanyBranches($data['d_company_id']);
        $data['companies'] = $this->CompanyModel->getAllCompanies();
        $data['employees'] = $this->EmployeeModel->getAllCanLoginEmployees();
        $data['code_details'] = $this->Code_detailModel->getAllCode_detailsByType("APPROVAL_TYPE");
        $data['branches'] = $branches;
        $data['page_title'] = "Update delivery center";
        $data['page_name'] = "deliverycenter/update";
        $data['record_id'] = $id;
        $this->breadcrumb->add("Delivery center", base_url("deliverycenter/index"));
        $this->breadcrumb->add($data['page_title'], $data['page_name']);
        $this->load->view('index', $data);
    }

    public function delete($id) {

        $data = $this->DeliverycenterModel->getDeliverycenter($id);
        if (count($data) > 0) {
            $updated_data = $this->DeliverycenterModel->deleteDeliverycenter($id);
            if ($updated_data) {
                $this->session->set_flashdata("success", "Delivery center is successfully removed.");
            } else {
                $this->session->set_flashdata("error", DB_OPERATION_ERROR);
            }
        } else {
            $this->session->set_flashdata("error", "Sorry! Delivery center not found.");
        }
        redirect(base_url("deliverycenter/index"));
    }

    public function get_branch_deliverycenter() {
        if (isset($_POST['company_id']) && isset($_POST['branch_id'])) {
            $this->output
                    ->set_content_type("application/json")
                    ->set_output(json_encode($this->DeliverycenterModel->getBranchDeliverycenters($_POST['company_id'], $_POST['branch_id'])));
        }
    }

}
