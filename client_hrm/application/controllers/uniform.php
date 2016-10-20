<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Uniform extends CI_Controller {

    function __construct() {
        parent::__construct();
        check_permission();
        $this->load->model('UniformModel');
        $this->load->model('Employee_roleModel');
        $this->breadcrumb->add('Home', base_url());
        if($this->router->fetch_method() == "index"){
            $this->datatable = TRUE;
        }
    }

    public function index() {
        $uniforms = $this->UniformModel->getAllUniforms();
        foreach ($uniforms as $key => $value) {
            $temp_uniform_roles = $this->UniformModel->getUniformRole($value['id']);
            $attach_emp = 0;
            foreach ($temp_uniform_roles as $k => $v) {
                $attach_emp += count($this->Employee_roleModel->getRoleEmployee($v['role_id']));
            }
            $temp[] = array("id" => $value['id'],
                "u_name" => $value['u_name'],
                "u_comments" => $value['u_comments'],
                "u_gender" => $value['u_gender'],
                "u_create_date" => $value['u_create_date'],
                "u_create_user" => $value['u_create_user'],
                "u_update_date" => $value['u_update_date'],
                "u_update_user" => $value['u_update_user'],
                "u_status" => $value['u_status'],
                "role_attach" => count($temp_uniform_roles),
                "employee_attach" => $attach_emp);
        }
        $data['page_title'] = "Uniforms";
        $data['page_name'] = "uniform/index";
        $data['css'] = array("css/plugins/dataTables/datatables.min.css");
        $data['js'] = array("js/plugins/dataTables/datatables.min.js");
        $data['uniforms'] = $temp;
        $this->breadcrumb->add($data['page_title'], $data['page_name']);
        $this->load->view('index', $data);
    }

    public function create() {
        if (!empty($this->input->post())) {
            $this->form_validation->set_rules('u_name', 'Name', 'trim|required|xss_clean');
            $this->form_validation->set_rules('u_comments', 'Details', 'trim|xss_clean');
            $this->form_validation->set_rules('u_gender', 'Gender', 'trim|required|xss_clean');
            $this->form_validation->set_rules('role_attach[]', 'Attach role', 'trim|required|xss_clean');
            $this->form_validation->set_rules('u_status', 'Status', 'trim|xss_clean');
            $post_data = $this->input->post();
            if ($this->form_validation->run() === TRUE) {
                $uniform_data['u_name'] = $post_data['u_name'];
                $uniform_data['u_comments'] = $post_data['u_comments'];
                $uniform_data['u_gender'] = $post_data['u_gender'];
                $uniform_data['u_status'] = $post_data['u_status'];
                $uniform_data['u_create_user'] = $this->session->userdata['remote_user_data']['employee']['id'];
                $inserted_id = $this->UniformModel->createUniform($uniform_data);
                foreach ($post_data['role_attach'] as $val) {
                    $role_data["role_id"] = $val;
                    $role_data["uniform_id"] = $inserted_id;
                    $this->UniformModel->attachRole($role_data);
                }

                if ($inserted_id != "") {
                    $this->session->set_flashdata("success", "Uniform is successfully created.");
                    redirect(base_url("uniform/index"));
                } else {
                    $this->session->set_flashdata("error", DB_OPERATION_ERROR);
                }
            } else {
                $data = $post_data;
            }
        }
        $data['roles'] = $this->Employee_roleModel->getAllRoles();
        $data['page_title'] = "Create uniform";
        $data['page_name'] = "uniform/create";
        $data['css'] = array("css/plugins/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css", "css/plugins/iCheck/custom.css");
        $data['js'] = array("js/plugins/iCheck/icheck.min.js");
        $this->breadcrumb->add("Uniforms", base_url("uniform/index"));
        $this->breadcrumb->add($data['page_title'], $data['page_name']);
        $this->load->view('index', $data);
    }

    public function update($id) {
        if (!empty($this->input->post())) {
            $this->form_validation->set_rules('u_name', 'Name', 'trim|required|xss_clean');
            $this->form_validation->set_rules('u_comments', 'Details', 'trim|xss_clean');
            $this->form_validation->set_rules('u_gender', 'Gender', 'trim|required|xss_clean');
            $this->form_validation->set_rules('role_attach[]', 'Attach role', 'trim|required|xss_clean');
            $this->form_validation->set_rules('u_status', 'Status', 'trim|xss_clean');
            $post_data = $this->input->post();
            if ($this->form_validation->run() === TRUE) {
                $uniform_data['u_name'] = $post_data['u_name'];
                $uniform_data['u_comments'] = $post_data['u_comments'];
                $uniform_data['u_gender'] = $post_data['u_gender'];
                $uniform_data['u_status'] = $post_data['u_status'];
                $uniform_data['u_update_user'] = $this->session->userdata['remote_user_data']['employee']['id'];
                $updated_data = $this->UniformModel->updateUniform($id, $uniform_data);
                $this->UniformModel->removeAttachRole($id);
                foreach ($post_data['role_attach'] as $val) {
                    $role_data["role_id"] = $val;
                    $role_data["uniform_id"] = $id;
                    $this->UniformModel->attachRole($role_data);
                }
                if ($updated_data) {
                    $this->session->set_flashdata("success", "Uniform is successfully updated.");
                    redirect(base_url("uniform/index"));
                } else {
                    $this->session->set_flashdata("error", DB_OPERATION_ERROR);
                }
            }
        }
        $data = $this->UniformModel->getUniform($id);
        $data['roles'] = $this->Employee_roleModel->getAllRoles();
        foreach ($this->UniformModel->getUniformRole($id) as $key => $value) {
            $data['role_attach'][] = $value['role_id'];
        }
        $data['page_title'] = "Update uniform";
        $data['page_name'] = "uniform/update";
        $data['record_id'] = $id;
        $data['css'] = array("css/plugins/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css", "css/plugins/iCheck/custom.css");
        $data['js'] = array("js/plugins/iCheck/icheck.min.js");
        $this->breadcrumb->add("Uniforms", base_url("uniform/index"));
        $this->breadcrumb->add($data['page_title'], $data['page_name']);
        $this->load->view('index', $data);
    }

    public function view($id) {
        $data = $this->UniformModel->getUniform($id);
        $data['roles'] = $this->Employee_roleModel->getAllRoles();
        foreach ($this->UniformModel->getUniformRole($id) as $key => $value) {
            $data['role_attach'][] = $value['role_id'];
            foreach ($this->Employee_roleModel->getRoleEmployee($value['role_id']) as $k => $v) {
                $data['employee_attach'][] = $v['e_fname']." ".$v["e_lname"];
            }
        }
        $data['page_title'] = "View uniform";
        $data['page_name'] = "uniform/view";
        $data['record_id'] = $id;
        $this->breadcrumb->add("Uniforms", base_url("uniform/index"));
        $this->breadcrumb->add($data['page_title'], $data['page_name']);
        $this->load->view('index', $data);
    }

    public function delete($id) {

        $data = $this->UniformModel->getUniform($id);
        if ($data != "") {
            $updated_data = $this->UniformModel->deleteUniform($id);
            if ($updated_data) {
                $this->session->set_flashdata("success", "Uniform is successfully removed.");
            } else {
                $this->session->set_flashdata("error", DB_OPERATION_ERROR);
            }
        } else {
            $this->session->set_flashdata("error", "Sorry! Uniform not found.");
        }
        redirect(base_url("uniform/index"));
    }

}
