<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Code_detail extends CI_Controller {

    function __construct() {
        parent::__construct();
        check_permission();
        $this->load->model('Code_detailModel');
        $this->load->model('Code_headerModel');
        $this->breadcrumb->add('Home', base_url());
        if($this->router->fetch_method() == "index"){
            $this->datatable = TRUE;
        }
    }

    public function index() {
        $code_details = $this->Code_detailModel->getAllCode_details();
        $data['page_title'] = "Code details";
        $data['page_name'] = "code_detail/index";
        $data['css'] = array("css/plugins/dataTables/datatables.min.css");
        $data['js'] = array("js/plugins/dataTables/datatables.min.js");
        $data['code_details'] = $code_details;
        $this->breadcrumb->add($data['page_title'], $data['page_name']);
        $this->load->view('index', $data);
    }

    public function create() {
        if (!empty($this->input->post())) {
            $this->form_validation->set_rules('cd_header_id', 'Header Id', 'trim|required|xss_clean');
            $this->form_validation->set_rules('cd_id', 'Detail ID', 'trim|required|xss_clean|callback_check_unique_detail');
            $this->form_validation->set_rules('cd_short_description', 'Short Description', 'trim|required|xss_clean');
            $this->form_validation->set_rules('cd_description', 'Description', 'trim|required|xss_clean');
            $this->form_validation->set_rules('cd_extra_data', 'Extra note', 'trim|xss_clean');
            $this->form_validation->set_rules('cd_system', 'Is system code', 'trim|xss_clean');
            $this->form_validation->set_rules('cd_active', 'Is active', 'trim|xss_clean');
            $post_data = $this->input->post();
            if ($this->form_validation->run() === TRUE) {
                $post_data['create_user'] = $this->session->userdata['remote_user_data']['employee']['id'];
                $inserted_id = $this->Code_detailModel->createCode_detail($post_data);
                if ($inserted_id != "") {
                    $this->session->set_flashdata("success", "Code detail is successfully created.");
                    redirect(base_url("code_detail/index"));
                } else {
                    $this->session->set_flashdata("error", DB_OPERATION_ERROR);
                }
            } else {
                $data = $post_data;
            }
        }
        $data['code_headers'] = $this->Code_headerModel->getAllCode_headers();
        $data['page_title'] = "Create code detail";
        $data['page_name'] = "code_detail/create";
        $this->breadcrumb->add("Code detail", base_url("code_detail/index"));
        $this->breadcrumb->add($data['page_title'], $data['page_name']);
        $this->load->view('index', $data);
    }

    public function update($id) {
        $data = $this->Code_detailModel->getCode_detail($id);
        if ($data['cd_system'] == "1") {
            $this->session->set_flashdata("error", "Sorry! This code is freezed. You can't edit it");
            redirect(base_url("code_detail/index"));
        }
        if (!empty($this->input->post())) {
            if ($this->input->post('cd_header_id') != $data['cd_header_id'] || $this->input->post('cd_id') != $data['cd_id']) {
                $is_unique = '|callback_check_unique_detail';
            } else {
                $is_unique = '';
            }
            $this->form_validation->set_rules('cd_header_id', 'Header Id', 'trim|required');
            $this->form_validation->set_rules('cd_id', 'Description', 'trim|required|xss_clean'.$is_unique);
            $this->form_validation->set_rules('cd_short_description', 'Description', 'trim|required|xss_clean');
            $this->form_validation->set_rules('cd_description', 'Description', 'trim|required|xss_clean');
            $this->form_validation->set_rules('cd_extra_data', 'Description', 'trim|xss_clean');
            $this->form_validation->set_rules('cd_system', 'Is system code', 'trim|xss_clean');
            $this->form_validation->set_rules('cd_active', 'Is active', 'trim|xss_clean');
            $post_data = $this->input->post();
            if ($this->form_validation->run() === TRUE) {
                $post_data['update_user'] = $this->session->userdata['remote_user_data']['employee']['id'];
                $updated_data = $this->Code_detailModel->updateCode_detail($id, $post_data);
                if ($updated_data) {
                    $this->session->set_flashdata("success", "Code detail is successfully updated.");
                    redirect(base_url("code_detail/index"));
                } else {
                    $this->session->set_flashdata("error", DB_OPERATION_ERROR);
                }
            }
        }
        $data['code_headers'] = $this->Code_headerModel->getAllCode_headers();
        $data['page_title'] = "Update code detail";
        $data['page_name'] = "code_detail/update";
        $data['record_id'] = $id;
        $this->breadcrumb->add("Code detail", base_url("code_detail/index"));
        $this->breadcrumb->add($data['page_title'], $data['page_name']);
        $this->load->view('index', $data);
    }

    public function delete($id) {
        $data = $this->Code_detailModel->getCode_detail($id);
        if ($data['cd_system'] == "1") {
            $this->session->set_flashdata("error", "Sorry! This code is freezed. You can't delete it");
            redirect(base_url("code_detail/index"));
        }
        if ($data != "") {
            $updated_data = $this->Code_detailModel->deleteCode_detail($id);
            if ($updated_data) {
                $this->session->set_flashdata("success", "Code detail is successfully removed.");
            } else {
                $this->session->set_flashdata("error", DB_OPERATION_ERROR);
            }
        } else {
            $this->session->set_flashdata("error", "Sorry! Code detail not found.");
        }
        redirect(base_url("code_detail/index"));
    }

    public function check_unique_detail() {
        $header_id = $this->input->post('cd_header_id');
        $cd_id = $this->input->post('cd_id');
        $unique_data = $this->Code_detailModel->check_unique($header_id, $cd_id);
//        echo "<pre>"; print_r($unique_data); echo "</pre>";die;
        if (count($unique_data) < 1) {
            return TRUE;
        } else {
            $this->form_validation->set_message('check_unique_detail','ID already exist for seleted header'.count($unique_data));
            return FALSE;
        }
    }

}
