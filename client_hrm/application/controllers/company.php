<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Company extends CI_Controller {

    function __construct() {
        parent::__construct();
        check_permission();
        $this->load->model('CompanyModel');
        $this->load->model('EmployeeModel');
        $this->load->model('Code_detailModel');
        $this->breadcrumb->add('Home', base_url());
        if($this->router->fetch_method() == "index"){
            $this->datatable = TRUE;
        }
    }

    public function index() {
        $companies = $this->CompanyModel->getAllCompanies();
        $data['page_title'] = "Company";
        $data['page_name'] = "company/index";
        $data['css'] = array("css/plugins/dataTables/datatables.min.css");
        $data['js'] = array("js/plugins/dataTables/datatables.min.js");
        $data['companies'] = $companies;
        $this->breadcrumb->add($data['page_title'], $data['page_name']);
        $this->load->view('index', $data);
    }

    public function create() {
        if (!empty($this->input->post())) {
            $this->form_validation->set_rules('c_name', 'Name', 'trim|required|xss_clean');
            $this->form_validation->set_rules('c_code', 'Code', 'trim|xss_clean');
            $this->form_validation->set_rules('c_address_street', 'Street address', 'trim|xss_clean');
            $this->form_validation->set_rules('c_address_area', 'Area address', 'trim|xss_clean');
            $this->form_validation->set_rules('c_address_city', 'City address', 'trim|xss_clean');
            $this->form_validation->set_rules('c_address_state', 'State address', 'trim|xss_clean');
            $this->form_validation->set_rules('c_address_country', 'Country address', 'trim|xss_clean');
            $this->form_validation->set_rules('c_number', 'Number', 'trim|numeric|xss_clean');
            $this->form_validation->set_rules('c_contact_person', 'Contact person', 'trim|xss_clean');
            $this->form_validation->set_rules('c_approval_type', 'Approval type', 'trim|required|xss_clean');
            if ($this->input->post('c_approval_type') != "4") {
                $this->form_validation->set_rules('c_approver_id', 'Approver', 'trim|required|xss_clean');
            } else {
                $this->form_validation->set_rules('c_approver_id', 'Approver', 'trim|xss_clean');
            }
            $this->form_validation->set_rules('c_status', 'Status', 'trim|xss_clean');
            $post_data = $this->input->post();
            if ($this->form_validation->run() === TRUE) {
                $inserted_id = $this->CompanyModel->createCompany($post_data);
                if ($inserted_id != "") {
                    $this->session->set_flashdata("success", "Company is successfully created.");
                    redirect(base_url("company/index"));
                } else {
                    $this->session->set_flashdata("error", DB_OPERATION_ERROR);
                }
            } else {
                $data = $post_data;
            }
        }
        $data['employees'] = $this->EmployeeModel->getAllCanLoginEmployees();
        $data['code_details'] = $this->Code_detailModel->getAllCode_detailsByType("APPROVAL_TYPE");
        $data['page_title'] = "Create company";
        $data['page_name'] = "company/create";
        $this->breadcrumb->add("Company", base_url("company/index"));
        $this->breadcrumb->add($data['page_title'], $data['page_name']);
        $this->load->view('index', $data);
    }

    public function update($id) {
        if (!empty($this->input->post())) {
            $this->form_validation->set_rules('c_name', 'Name', 'trim|required|xss_clean');
            $this->form_validation->set_rules('c_code', 'Code', 'trim|xss_clean');
            $this->form_validation->set_rules('c_address_street', 'Street address', 'trim|xss_clean');
            $this->form_validation->set_rules('c_address_area', 'Area address', 'trim|xss_clean');
            $this->form_validation->set_rules('c_address_city', 'City address', 'trim|xss_clean');
            $this->form_validation->set_rules('c_address_state', 'State address', 'trim|xss_clean');
            $this->form_validation->set_rules('c_address_country', 'Country address', 'trim|xss_clean');
            $this->form_validation->set_rules('c_number', 'Number', 'trim|numeric|xss_clean');
            $this->form_validation->set_rules('c_contact_person', 'Contact person', 'trim|xss_clean');
            $this->form_validation->set_rules('c_approval_type', 'Approval type', 'trim|required|xss_clean');
            if ($this->input->post('c_approval_type') != "4") {
                $this->form_validation->set_rules('c_approver_id', 'Approver', 'trim|required|xss_clean');
            } else {
                $this->form_validation->set_rules('c_approver_id', 'Approver', 'trim|xss_clean');
            }
            $this->form_validation->set_rules('c_status', 'Status', 'trim|xss_clean');
            $post_data = $this->input->post();
            if ($this->form_validation->run() === TRUE) {
                $updated_data = $this->CompanyModel->updateCompany($id, $post_data);
                if ($updated_data) {
                    $this->session->set_flashdata("success", "Company is successfully updated.");
                    redirect(base_url("company/index"));
                } else {
                    $this->session->set_flashdata("error", DB_OPERATION_ERROR);
                }
            }
        }

        $data = $this->CompanyModel->getCompany($id);
        $data['employees'] = $this->EmployeeModel->getAllCanLoginEmployees();
        $data['code_details'] = $this->Code_detailModel->getAllCode_detailsByType("APPROVAL_TYPE");
        $data['page_title'] = "Update company";
        $data['page_name'] = "company/update";
        $data['record_id'] = $id;
        $this->breadcrumb->add("Company", base_url("company/index"));
        $this->breadcrumb->add($data['page_title'], $data['page_name']);
        $this->load->view('index', $data);
    }

    public function delete($id) {

        $data = $this->CompanyModel->getCompany($id);
        if ($data != "") {
            $updated_data = $this->CompanyModel->deleteCompany($id);
            if ($updated_data) {
                $this->session->set_flashdata("success", "Company is successfully removed.");
            } else {
                $this->session->set_flashdata("error", DB_OPERATION_ERROR);
            }
        } else {
            $this->session->set_flashdata("error", "Sorry! Company not found.");
        }
        redirect(base_url("company/index"));
    }

}
