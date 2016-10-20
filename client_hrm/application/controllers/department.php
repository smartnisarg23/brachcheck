<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Department extends CI_Controller {

    function __construct() {
        parent::__construct();
        $allow_methods = array("get_branch_department");
        check_permission($allow_methods);
        $this->load->model('BranchModel');
        $this->load->model('DepartmentModel');
        $this->load->model('CompanyModel');
        $this->breadcrumb->add('Home', base_url());
        if($this->router->fetch_method() == "index"){
            $this->datatable = TRUE;
        }
    }

    public function index() {
        $departments = $this->DepartmentModel->getAllDepartments();
        $data['page_title'] = "Departments";
        $data['page_name'] = "department/index";
        $data['css'] = array("css/plugins/dataTables/datatables.min.css");
        $data['js'] = array("js/plugins/dataTables/datatables.min.js");
        $data['departments'] = $departments;
        $this->breadcrumb->add($data['page_title'], $data['page_name']);
        $this->load->view('index', $data);
    }

    public function create() {
        if (!empty($this->input->post())) {
            $this->form_validation->set_rules('d_name', 'Name', 'trim|required|xss_clean');
            $this->form_validation->set_rules('d_code', 'Code', 'trim|xss_clean');
            $this->form_validation->set_rules('d_company_id', 'Company', 'trim|required|xss_clean');
            $this->form_validation->set_rules('d_branch_id', 'Branch', 'trim|required|xss_clean');
            $this->form_validation->set_rules('d_status', 'Status', 'trim|xss_clean');
            $post_data = $this->input->post();
            if ($this->form_validation->run() === TRUE) {
                $inserted_id = $this->DepartmentModel->createDepartment($post_data);
                if ($inserted_id != "") {
                    $this->session->set_flashdata("success", "Department is successfully created.");
                    redirect(base_url("department/index"));
                } else {
                    $this->session->set_flashdata("error", DB_OPERATION_ERROR);
                }
            } else {
                $data = $post_data;
            }
        }
        $data['companies'] = $this->CompanyModel->getAllCompanies();
        $data['page_title'] = "Create department";
        $data['page_name'] = "department/create";
        $this->breadcrumb->add("Department", base_url("department/index"));
        $this->breadcrumb->add($data['page_title'], $data['page_name']);
        $this->load->view('index', $data);
    }

    public function update($id) {
        if (!empty($this->input->post())) {
            $this->form_validation->set_rules('d_name', 'Name', 'trim|required|xss_clean');
            $this->form_validation->set_rules('d_code', 'Code', 'trim|xss_clean');
            $this->form_validation->set_rules('d_company_id', 'Company', 'trim|required|xss_clean');
            $this->form_validation->set_rules('d_branch_id', 'Branch', 'trim|xss_clean');
            $this->form_validation->set_rules('d_status', 'Status', 'trim|xss_clean');
            $post_data = $this->input->post();
            if ($this->form_validation->run() === TRUE) {
                $updated_data = $this->DepartmentModel->updateDepartment($id, $post_data);
                if ($updated_data) {
                    $this->session->set_flashdata("success", "Department is successfully updated.");
                    redirect(base_url("department/index"));
                } else {
                    $this->session->set_flashdata("error", DB_OPERATION_ERROR);
                }
            }
        }

        $data = $this->DepartmentModel->getDepartment($id);
        $branches = $this->BranchModel->getCompanyBranches($data['d_company_id']);
        $data['companies'] = $this->CompanyModel->getAllCompanies();
        $data['branches'] = $branches;
        $data['page_title'] = "Update department";
        $data['page_name'] = "department/update";
        $data['record_id'] = $id;
        $this->breadcrumb->add("Department", base_url("department/index"));
        $this->breadcrumb->add($data['page_title'], $data['page_name']);
        $this->load->view('index', $data);
    }

    public function delete($id) {

        $data = $this->DepartmentModel->getDepartment($id);
        if ($data != "") {
            $updated_data = $this->DepartmentModel->deleteDepartment($id);
            if ($updated_data) {
                $this->session->set_flashdata("success", "Department is successfully removed.");
            } else {
                $this->session->set_flashdata("error", DB_OPERATION_ERROR);
            }
        } else {
            $this->session->set_flashdata("error", "Sorry! Department not found.");
        }
        redirect(base_url("department/index"));
    }
    
    public function get_branch_department() {
        if (isset($_POST['company_id']) && isset($_POST['branch_id'])) {
            $this->output
                    ->set_content_type("application/json")
                    ->set_output(json_encode($this->DepartmentModel->getBranchDepartments($_POST['company_id'], $_POST['branch_id'])));
        }
    }
}