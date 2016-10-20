<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Branch extends CI_Controller {

    function __construct() {
        parent::__construct();
        $allow_methods = array("get_company_branches");
        check_permission($allow_methods);
        $this->load->model('BranchModel');
        $this->load->model('CompanyModel');
        $this->breadcrumb->add('Home', base_url());
        if ($this->router->fetch_method() == "index") {
            $this->datatable = TRUE;
        }
    }

    public function index() {
        $branches = $this->BranchModel->getAllBranches();
        $data['page_title'] = "Branches";
        $data['page_name'] = "branch/index";
        $data['css'] = array("css/plugins/dataTables/datatables.min.css");
        $data['js'] = array("js/plugins/dataTables/datatables.min.js");
        $data['branches'] = $branches;
        $this->breadcrumb->add($data['page_title'], $data['page_name']);
        $this->load->view('index', $data);
    }

    public function create() {
        if (!empty($this->input->post())) {
            $this->form_validation->set_rules('b_name', 'Name', 'trim|required|xss_clean');
            $this->form_validation->set_rules('b_code', 'Code', 'trim|xss_clean');
            $this->form_validation->set_rules('b_address_street', 'Street address', 'trim|xss_clean');
            $this->form_validation->set_rules('b_address_area', 'Area address', 'trim|xss_clean');
            $this->form_validation->set_rules('b_address_city', 'City address', 'trim|xss_clean');
            $this->form_validation->set_rules('b_address_state', 'State address', 'trim|xss_clean');
            $this->form_validation->set_rules('b_address_country', 'Country address', 'trim|xss_clean');
            $this->form_validation->set_rules('b_number', 'Number', 'trim|numeric|xss_clean');
            $this->form_validation->set_rules('b_contact_person', 'Contact person', 'trim|xss_clean');
            $this->form_validation->set_rules('b_status', 'Status', 'trim|xss_clean');
            $post_data = $this->input->post();
            if ($this->form_validation->run() === TRUE) {
                $inserted_id = $this->BranchModel->createBrach($post_data);
                if ($inserted_id != "") {
                    $this->session->set_flashdata("success", "Branch is successfully created.");
                    redirect(base_url("branch/index"));
                } else {
                    $this->session->set_flashdata("error", DB_OPERATION_ERROR);
                }
            } else {
                $data = $post_data;
            }
        }
        $data['companies'] = $this->CompanyModel->getAllCompanies();
        $data['page_title'] = "Create branch";
        $data['page_name'] = "branch/create";
        $this->breadcrumb->add("Branch", base_url("branch/index"));
        $this->breadcrumb->add($data['page_title'], $data['page_name']);
        $this->load->view('index', $data);
    }

    public function update($id) {
        $data = $this->BranchModel->getBranch($id);
        if (!empty($data)) {
            if (!empty($this->input->post())) {
                $this->form_validation->set_rules('b_name', 'Name', 'trim|required|xss_clean');
                $this->form_validation->set_rules('b_code', 'Code', 'trim|xss_clean');
                $this->form_validation->set_rules('b_address_street', 'Street address', 'trim|xss_clean');
                $this->form_validation->set_rules('b_address_area', 'Area address', 'trim|xss_clean');
                $this->form_validation->set_rules('b_address_city', 'City address', 'trim|xss_clean');
                $this->form_validation->set_rules('b_address_state', 'State address', 'trim|xss_clean');
                $this->form_validation->set_rules('b_address_country', 'Country address', 'trim|xss_clean');
                $this->form_validation->set_rules('b_number', 'Number', 'trim|numeric|xss_clean');
                $this->form_validation->set_rules('b_contact_person', 'Contact person', 'trim|xss_clean');
                $this->form_validation->set_rules('b_status', 'Status', 'trim|xss_clean');
                $post_data = $this->input->post();
                if ($this->form_validation->run() === TRUE) {
                    $updated_data = $this->BranchModel->updateBrach($id, $post_data);
                    if ($updated_data) {
                        $this->session->set_flashdata("success", "Branch is successfully updated.");
                        redirect(base_url("branch/index"));
                    } else {
                        $this->session->set_flashdata("error", DB_OPERATION_ERROR);
                    }
                }
            }
            $data['companies'] = $this->CompanyModel->getAllCompanies();
            $data['page_title'] = "Update branch";
            $data['page_name'] = "branch/update";
            $data['record_id'] = $id;
            $this->breadcrumb->add("Branch", base_url("branch/index"));
            $this->breadcrumb->add($data['page_title'], $data['page_name']);
            $this->load->view('index', $data);
        } else {
            $this->session->set_flashdata("error", "Sorry! Branch not found.");
            redirect(base_url("branch/index"));
        }
    }

    public function delete($id) {

        $data = $this->BranchModel->getBranch($id);
        if ($data != "") {
            $updated_data = $this->BranchModel->deleteBrach($id);
            if ($updated_data) {
                $this->session->set_flashdata("success", "Branch is successfully removed.");
            } else {
                $this->session->set_flashdata("error", DB_OPERATION_ERROR);
            }
        } else {
            $this->session->set_flashdata("error", "Sorry! Branch not found.");
        }
        redirect(base_url("branch/index"));
    }

    public function get_company_branches() {
        if (isset($_POST['company_id'])) {
            $this->output
                    ->set_content_type("application/json")
                    ->set_output(json_encode($this->BranchModel->getCompanyBranches($_POST['company_id'])));
        }
    }

}
