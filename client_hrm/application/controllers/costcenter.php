<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Costcenter extends CI_Controller {

    function __construct() {
        parent::__construct();
        $allow_methods = array("get_branch_costcenter");
        check_permission($allow_methods);
        $this->load->model('BranchModel');
        $this->load->model('DepartmentModel');
        $this->load->model('CostcenterModel');
        $this->load->model('CompanyModel');
        $this->breadcrumb->add('Home', base_url());
        if($this->router->fetch_method() == "index"){
            $this->datatable = TRUE;
        }
    }

    public function index() {
        $costcenters = $this->CostcenterModel->getAllCostcenters();
        $data['page_title'] = "Costcenters";
        $data['page_name'] = "costcenter/index";
        $data['css'] = array("css/plugins/dataTables/datatables.min.css");
        $data['js'] = array("js/plugins/dataTables/datatables.min.js");
        $data['costcenters'] = $costcenters;
        $this->breadcrumb->add($data['page_title'], $data['page_name']);
        $this->load->view('index', $data);
    }

    public function create() {
        if (!empty($this->input->post())) {
            $this->form_validation->set_rules('c_name', 'Name', 'trim|required|xss_clean');
            $this->form_validation->set_rules('c_code', 'Code', 'trim|xss_clean');
            $this->form_validation->set_rules('c_company_id', 'Company', 'trim|required|xss_clean');
            $this->form_validation->set_rules('c_branch_id', 'Branch', 'trim|xss_clean');
            $this->form_validation->set_rules('c_status', 'Status', 'trim|xss_clean');
            $post_data = $this->input->post();
            if ($this->form_validation->run() === TRUE) {
                $inserted_id = $this->CostcenterModel->createCostcenter($post_data);
                if ($inserted_id != "") {
                    $this->session->set_flashdata("success", "Costcenter is successfully created.");
                    redirect(base_url("costcenter/index"));
                } else {
                    $this->session->set_flashdata("error", DB_OPERATION_ERROR);
                }
            } else {
                $data = $post_data;
            }
        }
        $data['companies'] = $this->CompanyModel->getAllCompanies();
        $data['page_title'] = "Create costcenter";
        $data['page_name'] = "costcenter/create";
        $this->breadcrumb->add("Costcenter", base_url("costcenter/index"));
        $this->breadcrumb->add($data['page_title'], $data['page_name']);
        $this->load->view('index', $data);
    }

    public function update($id) {
        if (!empty($this->input->post())) {
            $this->form_validation->set_rules('c_name', 'Name', 'trim|required|xss_clean');
            $this->form_validation->set_rules('c_code', 'Code', 'trim|xss_clean');
            $this->form_validation->set_rules('c_company_id', 'Company', 'trim|required|xss_clean');
            $this->form_validation->set_rules('c_branch_id', 'Branch', 'trim|xss_clean');
            $this->form_validation->set_rules('c_status', 'Status', 'trim|xss_clean');
            $post_data = $this->input->post();
            if ($this->form_validation->run() === TRUE) {
                $updated_data = $this->CostcenterModel->updateCostcenter($id, $post_data);
                if ($updated_data) {
                    $this->session->set_flashdata("success", "Costcenter is successfully updated.");
                    redirect(base_url("costcenter/index"));
                } else {
                    $this->session->set_flashdata("error", DB_OPERATION_ERROR);
                }
            }
        }

        $data = $this->CostcenterModel->getCostcenter($id);
        $branches = $this->BranchModel->getCompanyBranches($data['c_company_id']);
        $data['companies'] = $this->CompanyModel->getAllCompanies();
        $data['branches'] = $branches;
        $data['page_title'] = "Update costcenter";
        $data['page_name'] = "costcenter/update";
        $data['record_id'] = $id;
        $this->breadcrumb->add("Costcenter", base_url("costcenter/index"));
        $this->breadcrumb->add($data['page_title'], $data['page_name']);
        $this->load->view('index', $data);
    }

    public function delete($id) {

        $data = $this->CostcenterModel->getCostcenter($id);
        if ($data != "") {
            $updated_data = $this->CostcenterModel->deleteCostcenter($id);
            if ($updated_data) {
                $this->session->set_flashdata("success", "Costcenter is successfully removed.");
            } else {
                $this->session->set_flashdata("error", DB_OPERATION_ERROR);
            }
        } else {
            $this->session->set_flashdata("error", "Sorry! Costcenter not found.");
        }
        redirect(base_url("costcenter/index"));
    }

    public function get_branch_costcenter() {
        if (isset($_POST['company_id']) && isset($_POST['branch_id'])) {
            $this->output
                    ->set_content_type("application/json")
                    ->set_output(json_encode($this->CostcenterModel->getBranchCostcenters($_POST['company_id'], $_POST['branch_id'])));
        }
    }
}