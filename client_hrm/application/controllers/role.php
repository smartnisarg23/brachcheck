<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Role extends CI_Controller {

    function __construct() {
        parent::__construct();
        check_permission();
//        $this->load->model('BranchModel');
//        $this->load->model('DepartmentModel');
        $this->load->model('RoleModel');
        $this->breadcrumb->add('Home', base_url());
        if($this->router->fetch_method() == "index"){
            $this->datatable = TRUE;
        }
    }

    public function index() {
        $roles = $this->RoleModel->getAllRoles();
        $data['page_title'] = "Roles";
        $data['page_name'] = "role/index";
        $data['css'] = array("css/plugins/dataTables/datatables.min.css");
        $data['js'] = array("js/plugins/dataTables/datatables.min.js");
        $data['roles'] = $roles;
        $this->breadcrumb->add($data['page_title'], $data['page_name']);
        $this->load->view('index', $data);
    }

    public function create() {
        if (!empty($this->input->post())) {
            $this->form_validation->set_rules('r_name', 'Name', 'trim|required|xss_clean');
            $this->form_validation->set_rules('r_details', 'Details', 'trim|xss_clean');
            $this->form_validation->set_rules('r_status', 'Status', 'trim|xss_clean');
            $post_data = $this->input->post();
            if ($this->form_validation->run() === TRUE) {
                $inserted_id = $this->RoleModel->createRole($post_data);
                if ($inserted_id != "") {
                    $this->session->set_flashdata("success", "Role is successfully created.");
                    redirect(base_url("role/index"));
                } else {
                    $this->session->set_flashdata("error", DB_OPERATION_ERROR);
                }
            } else {
                $data = $post_data;
            }
        }
        $data['page_title'] = "Create role";
        $data['page_name'] = "role/create";
        $this->breadcrumb->add("Role", base_url("role/index"));
        $this->breadcrumb->add($data['page_title'], $data['page_name']);
        $this->load->view('index', $data);
    }

    public function update($id) {
        if (!empty($this->input->post())) {
            $this->form_validation->set_rules('r_name', 'Name', 'trim|required|xss_clean');
            $this->form_validation->set_rules('r_details', 'Details', 'trim|xss_clean');
            $this->form_validation->set_rules('r_status', 'Status', 'trim|xss_clean');
            $post_data = $this->input->post();
            if ($this->form_validation->run() === TRUE) {
                $updated_data = $this->RoleModel->updateRole($id, $post_data);
                if ($updated_data) {
                    $this->session->set_flashdata("success", "Role is successfully updated.");
                    redirect(base_url("role/index"));
                } else {
                    $this->session->set_flashdata("error", DB_OPERATION_ERROR);
                }
            }
        }

        $data = $this->RoleModel->getRole($id);
        $data['page_title'] = "Update role";
        $data['page_name'] = "role/update";
        $data['record_id'] = $id;
        $this->breadcrumb->add("Role", base_url("role/index"));
        $this->breadcrumb->add($data['page_title'], $data['page_name']);
        $this->load->view('index', $data);
    }

    public function delete($id) {

        $data = $this->RoleModel->getRole($id);
        if ($data != "") {
            $updated_data = $this->RoleModel->deleteRole($id);
            if ($updated_data) {
                $this->session->set_flashdata("success", "Role is successfully removed.");
            } else {
                $this->session->set_flashdata("error", DB_OPERATION_ERROR);
            }
        } else {
            $this->session->set_flashdata("error", "Sorry! Role not found.");
        }
        redirect(base_url("role/index"));
    }
}