<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Licence extends CI_Controller {

    function __construct() {
        parent::__construct();
        check_permission();
        $this->load->model('LicenceModel');
        $this->breadcrumb->add('Home', base_url());
        if ($this->router->fetch_method() == "index") {
            $this->datatable = TRUE;
        }
    }

    public function index() {
        $licences = $this->LicenceModel->getAllLicences();
        $data['page_title'] = "Licence";
        $data['page_name'] = "licence/index";
        $data['css'] = array("css/plugins/dataTables/datatables.min.css");
        $data['js'] = array("js/plugins/dataTables/datatables.min.js");
        $data['licences'] = $licences;
        $this->breadcrumb->add($data['page_title'], $data['page_name']);
        $this->load->view('index', $data);
    }

    public function create() {
        if (!empty($this->input->post())) {
            $this->form_validation->set_rules('l_cls_name', 'Name', 'trim|required|xss_clean');
            $post_data = $this->input->post();
            if ($this->form_validation->run() === TRUE) {
                $inserted_id = $this->LicenceModel->createLicence($post_data);
                if ($inserted_id != "") {
                    $this->session->set_flashdata("success", "Licence is successfully created.");
                    redirect(base_url("licence/index"));
                } else {
                    $this->session->set_flashdata("error", DB_OPERATION_ERROR);
                }
            } else {
                $data = $post_data;
            }
        }
        $data['page_title'] = "Create licence";
        $data['page_name'] = "licence/create";
        $this->breadcrumb->add("Licence", base_url("licence/index"));
        $this->breadcrumb->add($data['page_title'], $data['page_name']);
        $this->load->view('index', $data);
    }

    public function update($id) {
        if (!empty($this->input->post())) {
            $this->form_validation->set_rules('l_cls_name', 'Name', 'trim|required|xss_clean');
            $post_data = $this->input->post();
            if ($this->form_validation->run() === TRUE) {
                $updated_data = $this->LicenceModel->updateLicence($id, $post_data);
                if ($updated_data) {
                    $this->session->set_flashdata("success", "Licence is successfully updated.");
                    redirect(base_url("licence/index"));
                } else {
                    $this->session->set_flashdata("error", DB_OPERATION_ERROR);
                }
            }
        }

        $data = $this->LicenceModel->getLicence($id);
        $data['page_title'] = "Update licence";
        $data['page_name'] = "licence/update";
        $data['record_id'] = $id;
        $this->breadcrumb->add("Licence", base_url("licence/index"));
        $this->breadcrumb->add($data['page_title'], $data['page_name']);
        $this->load->view('index', $data);
    }

    public function delete($id) {

        $data = $this->LicenceModel->getLicence($id);
        if ($data != "") {
            $updated_data = $this->LicenceModel->deleteLicence($id);
            if ($updated_data) {
                $this->session->set_flashdata("success", "Licence is successfully removed.");
            } else {
                $this->session->set_flashdata("error", DB_OPERATION_ERROR);
            }
        } else {
            $this->session->set_flashdata("error", "Sorry! Licence not found.");
        }
        redirect(base_url("licence/index"));
    }

}
