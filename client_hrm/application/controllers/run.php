<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Run extends CI_Controller {

    function __construct() {
        parent::__construct();
        check_permission();
        $this->load->model('RunModel');
        $this->load->model('TruckModel');
        $this->breadcrumb->add('Home', base_url());
        if($this->router->fetch_method() == "index"){
            $this->datatable = TRUE;
        }
    }

    public function index() {
        $runs = $this->RunModel->getAllRuns();
        $data['page_title'] = "Run";
        $data['page_name'] = "run/index";
        $data['css'] = array("css/plugins/dataTables/datatables.min.css");
        $data['js'] = array("js/plugins/dataTables/datatables.min.js");
        $data['runs'] = $runs;
        $this->breadcrumb->add($data['page_title'], $data['page_name']);
        $this->load->view('index', $data);
    }

    public function create() {
        $trucks = $this->TruckModel->getAllTrucks();
        if (!empty($this->input->post())) {
            $this->form_validation->set_rules('r_id', 'Run id', 'trim|required|xss_clean');
            $this->form_validation->set_rules('r_desc', 'Run description', 'trim|required|xss_clean');
            $this->form_validation->set_rules('r_s_desc', 'Run short description', 'trim|required|xss_clean');
            $this->form_validation->set_rules('r_start_time', 'Run start time', 'trim|required|xss_clean');
            $this->form_validation->set_rules('r_duration', 'Run duration', 'trim|required|xss_clean');
            $post_data = $this->input->post();
            if ($this->form_validation->run() === TRUE) {
                $post_data['r_run_days'] = implode(',', $this->input->post('r_run_days'));
                $inserted_id = $this->RunModel->createRun($post_data);
                if ($inserted_id != "") {
                    $this->session->set_flashdata("success", "Run is successfully created.");
                    redirect(base_url("run/index"));
                } else {
                    $this->session->set_flashdata("error", DB_OPERATION_ERROR);
                }
            } else {
                $data = $post_data;
            }
        }
        $data['page_title'] = "Create run";
        $data['page_name'] = "run/create";
        $data['css'] = array("css/plugins/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css", "css/plugins/iCheck/custom.css", "css/plugins/datapicker/datepicker3.css");
        $data['js'] = array("js/plugins/iCheck/icheck.min.js", "js/plugins/datapicker/bootstrap-datepicker.js");
        $data['trucks'] = $trucks;
        $this->breadcrumb->add("Run", base_url("run/index"));
        $this->breadcrumb->add($data['page_title'], $data['page_name']);
        $this->load->view('index', $data);
    }

    public function update($id) {
        $trucks = $this->TruckModel->getAllTrucks();
        if (!empty($this->input->post())) {
            $this->form_validation->set_rules('r_id', 'Run id', 'trim|required|xss_clean');
            $this->form_validation->set_rules('r_desc', 'Run description', 'trim|required|xss_clean');
            $this->form_validation->set_rules('r_s_desc', 'Run short description', 'trim|required|xss_clean');
            $this->form_validation->set_rules('r_start_time', 'Run start time', 'trim|required|xss_clean');
            $this->form_validation->set_rules('r_duration', 'Run duration', 'trim|required|xss_clean');
            $post_data = $this->input->post();
            if ($this->form_validation->run() === TRUE) {
                $post_data['r_run_days'] = implode(',', $this->input->post('r_run_days'));
                $updated_data = $this->RunModel->updateRun($id, $post_data);
                if ($updated_data) {
                    $this->session->set_flashdata("success", "Run is successfully updated.");
                    redirect(base_url("run/index"));
                } else {
                    $this->session->set_flashdata("error", DB_OPERATION_ERROR);
                }
            }
        }

        $data = $this->RunModel->getRun($id);
        $data['r_run_days'] = explode(",", $data['r_run_days']);
        $data['page_title'] = "Update run";
        $data['page_name'] = "run/update";
        $data['record_id'] = $id;
        $data['css'] = array("css/plugins/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css", "css/plugins/iCheck/custom.css", "css/plugins/datapicker/datepicker3.css");
        $data['js'] = array("js/plugins/iCheck/icheck.min.js", "js/plugins/datapicker/bootstrap-datepicker.js");
        $data['trucks'] = $trucks;
        $this->breadcrumb->add("Run", base_url("run/index"));
        $this->breadcrumb->add($data['page_title'], $data['page_name']);
        $this->load->view('index', $data);
    }

    public function delete($id) {
        $data = $this->RunModel->getRun($id);
        if ($data != "") {
            $updated_data = $this->RunModel->deleteRun($id);
            if ($updated_data) {
                $this->session->set_flashdata("success", "Run is successfully removed.");
            } else {
                $this->session->set_flashdata("error", DB_OPERATION_ERROR);
            }
        } else {
            $this->session->set_flashdata("error", "Sorry! Run not found.");
        }
        redirect(base_url("run/index"));
    }

}
