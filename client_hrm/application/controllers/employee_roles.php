<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Employee_roles extends CI_Controller {

    function __construct() {
        parent::__construct();
        check_permission();
        $this->load->model('Employee_roleModel');
        $this->load->model('UniformModel');
        $this->load->model('EmployeeModel');
        $this->breadcrumb->add('Home', base_url());
        if ($this->router->fetch_method() == "index") {
            $this->datatable = TRUE;
        }
    }

    public function index() {
        $roles = $this->Employee_roleModel->getAllRoles();
        foreach ($roles as $key => $value) {
            $temp[] = array("id" => $value['id'],
                "r_name" => $value['r_name'],
                "r_comments" => $value['r_comments'],
                "r_create_date" => $value['r_create_date'],
                "r_create_user" => $value['r_create_user'],
                "r_update_date" => $value['r_update_date'],
                "r_update_user" => $value['r_update_user'],
                "r_status" => $value['r_status'],
                "uniform_attach" => count($this->Employee_roleModel->getRoleUniform($value['id'])),
                "employee_attach" => count($this->Employee_roleModel->getRoleEmployee($value['id'])));
        }

        $data['page_title'] = "Employee Roles";
        $data['page_name'] = "employee_roles/index";
        $data['css'] = array("css/plugins/dataTables/datatables.min.css");
        $data['js'] = array("js/plugins/dataTables/datatables.min.js");
        $data['roles'] = $temp;
        $this->breadcrumb->add($data['page_title'], $data['page_name']);
        $this->load->view('index', $data);
    }

    public function create() {
        if (!empty($this->input->post())) {
            $this->form_validation->set_rules('r_name', 'Name', 'trim|required|xss_clean');
            $this->form_validation->set_rules('r_comments', 'Details', 'trim|xss_clean');
            $this->form_validation->set_rules('r_status', 'Status', 'trim|xss_clean');
            $post_data = $this->input->post();
            if ($this->form_validation->run() === TRUE) {
                $post_data['r_create_user'] = $this->session->userdata['remote_user_data']['employee']['id'];
                $inserted_id = $this->Employee_roleModel->createRole($post_data);
                if ($inserted_id != "") {
                    $this->session->set_flashdata("success", "Role is successfully created.");
                    redirect(base_url("employee_roles/index"));
                } else {
                    $this->session->set_flashdata("error", DB_OPERATION_ERROR);
                }
            } else {
                $data = $post_data;
            }
        }
        $data['page_title'] = "Create employee roles";
        $data['page_name'] = "employee_roles/create";
        $this->breadcrumb->add("Employee roles", base_url("employee_roles/index"));
        $this->breadcrumb->add($data['page_title'], $data['page_name']);
        $this->load->view('index', $data);
    }

    public function update($id) {
        if (!empty($this->input->post())) {
            $this->form_validation->set_rules('r_name', 'Name', 'trim|required|xss_clean');
            $this->form_validation->set_rules('r_comments', 'Details', 'trim|xss_clean');
            $this->form_validation->set_rules('r_status', 'Status', 'trim|xss_clean');
            $post_data = $this->input->post();
            if ($this->form_validation->run() === TRUE) {
                $post_data['r_update_user'] = $this->session->userdata['remote_user_data']['employee']['id'];
                $updated_data = $this->Employee_roleModel->updateRole($id, $post_data);
                if ($updated_data) {
                    $this->session->set_flashdata("success", "Role is successfully updated.");
                    redirect(base_url("employee_roles/index"));
                } else {
                    $this->session->set_flashdata("error", DB_OPERATION_ERROR);
                }
            }
        }

        $data = $this->Employee_roleModel->getRole($id);
        $data['page_title'] = "Update employee roles";
        $data['page_name'] = "employee_roles/update";
        $data['record_id'] = $id;
        $this->breadcrumb->add("Employee roles", base_url("employee_roles/index"));
        $this->breadcrumb->add($data['page_title'], $data['page_name']);
        $this->load->view('index', $data);
    }

    public function view($id) {
        $data = $this->Employee_roleModel->getRole($id);
        $data['uniforms'] = $this->UniformModel->getAllUniforms();
        $data['employees'] = $this->EmployeeModel->getAllEmployees();
        foreach ($this->Employee_roleModel->getRoleUniform($id) as $key => $value) {
            $data['uniform_attach'][] = $value['uniform_id'];
        }
        foreach ($this->Employee_roleModel->getRoleEmployee($id) as $key => $value) {
            $data['employee_attach'][] = $value['id'];
        }
        if ($data != "") {
            $data['page_title'] = "View employee roles";
            $data['page_name'] = "employee_roles/view";
            $data['record_id'] = $id;
            $this->breadcrumb->add("Employee roles", base_url("employee_roles/index"));
            $this->breadcrumb->add($data['page_title'], $data['page_name']);
            $this->load->view('index', $data);
        } else {
            $this->session->set_flashdata("error", "Sorry! Role not found.");
            redirect(base_url("employee_roles/index"));
        }
    }

    public function delete($id) {

        $data = $this->Employee_roleModel->getRole($id);
        if ($data != "") {
            $updated_data = $this->Employee_roleModel->deleteRole($id);
            if ($updated_data) {
                $this->session->set_flashdata("success", "Role is successfully removed.");
            } else {
                $this->session->set_flashdata("error", DB_OPERATION_ERROR);
            }
        } else {
            $this->session->set_flashdata("error", "Sorry! Role not found.");
        }
        redirect(base_url("employee_roles/index"));
    }

}