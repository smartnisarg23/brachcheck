<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Code_header extends CI_Controller {

    function __construct() {
        parent::__construct();
        check_permission();
        $this->load->model('Code_headerModel');
        $this->breadcrumb->add('Home', base_url());
        if($this->router->fetch_method() == "index"){
            $this->datatable = TRUE;
        }
    }

    public function index() {
        $code_headers = $this->Code_headerModel->getAllCode_headers();
        $data['page_title'] = "Code headers";
        $data['page_name'] = "code_header/index";
        $data['css'] = array("css/plugins/dataTables/datatables.min.css");
        $data['js'] = array("js/plugins/dataTables/datatables.min.js");
        $data['code_headers'] = $code_headers;
        $this->breadcrumb->add($data['page_title'], $data['page_name']);
        $this->load->view('index', $data);
    }

    public function create() {
        if (!empty($this->input->post())) {
            $this->form_validation->set_rules('ch_id', 'ID', 'trim|required|xss_clean|is_unique[code_headers.ch_id]');
            $this->form_validation->set_rules('ch_description', 'Description', 'trim|required|xss_clean');
            $this->form_validation->set_rules('ch_system', 'Is system code', 'trim|xss_clean');
            $this->form_validation->set_rules('ch_active', 'Is active', 'trim|xss_clean');
            $post_data = $this->input->post();
            if ($this->form_validation->run() === TRUE) {
                $post_data['create_user'] = $this->session->userdata['remote_user_data']['employee']['id'];
                $inserted_id = $this->Code_headerModel->createCode_header($post_data);
                if ($inserted_id != "") {
                    $this->session->set_flashdata("success", "Code header is successfully created.");
                    redirect(base_url("code_header/index"));
                } else {
                    $this->session->set_flashdata("error", DB_OPERATION_ERROR);
                }
            } else {
                $data = $post_data;
            }
        }
        $data['page_title'] = "Create code header";
        $data['page_name'] = "code_header/create";
        $this->breadcrumb->add("Code header", base_url("code_header/index"));
        $this->breadcrumb->add($data['page_title'], $data['page_name']);
        $this->load->view('index', $data);
    }

    public function update($id) {
        $data = $this->Code_headerModel->getCode_header($id);
        if ($data['ch_system'] == "1") {
            $this->session->set_flashdata("error", "Sorry! This code is freezed. You can't edit it");
            redirect(base_url("code_header/index"));
        }
        if (!empty($this->input->post())) {
            if ($this->input->post('ch_id') != $data['ch_id']) {
                $is_unique = '|is_unique[code_headers.ch_id]';
            } else {
                $is_unique = '';
            }
            $this->form_validation->set_rules('ch_id', 'ID', 'trim|required|xss_clean' . $is_unique);
            $this->form_validation->set_rules('ch_description', 'Description', 'trim|required|xss_clean');
            $this->form_validation->set_rules('ch_system', 'Is system code', 'trim|xss_clean');
            $this->form_validation->set_rules('ch_active', 'Is active', 'trim|xss_clean');
            $post_data = $this->input->post();
            if ($this->form_validation->run() === TRUE) {
                $post_data['update_user'] = $this->session->userdata['remote_user_data']['employee']['id'];
                $updated_data = $this->Code_headerModel->updateCode_header($id, $post_data);
                if ($updated_data) {
                    $this->session->set_flashdata("success", "Code header is successfully updated.");
                    redirect(base_url("code_header/index"));
                } else {
                    $this->session->set_flashdata("error", DB_OPERATION_ERROR);
                }
            }
        }
        $data['page_title'] = "Update code header";
        $data['page_name'] = "code_header/update";
        $data['record_id'] = $id;
        $this->breadcrumb->add("Code header", base_url("code_header/index"));
        $this->breadcrumb->add($data['page_title'], $data['page_name']);
        $this->load->view('index', $data);
    }

    public function delete($id) {
        $data = $this->Code_headerModel->getCode_header($id);
        if ($data['ch_system'] == "1") {
            $this->session->set_flashdata("error", "Sorry! This code is freezed. You can't delete it");
            redirect(base_url("code_header/index"));
        }
        if ($data != "") {
            $updated_data = $this->Code_headerModel->deleteCode_header($id);
            if ($updated_data) {
                $this->session->set_flashdata("success", "Code header is successfully removed.");
            } else {
                $this->session->set_flashdata("error", DB_OPERATION_ERROR);
            }
        } else {
            $this->session->set_flashdata("error", "Sorry! Code header not found.");
        }
        redirect(base_url("code_header/index"));
    }

}
