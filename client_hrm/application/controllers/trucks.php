<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Trucks extends CI_Controller {

    function __construct() {
        parent::__construct();
        check_permission();
        $this->load->model('TruckModel');
        $this->load->model('Truck_makeModel');
        $this->load->model('Truck_modelModel');
        $this->load->model('LicenceModel');
        $this->breadcrumb->add('Home', base_url());
        if($this->router->fetch_method() == "index"){
            $this->datatable = TRUE;
        }
    }

    public function index() {
        $trucks = $this->TruckModel->getAllTrucks();
        $data['page_title'] = "Trucks";
        $data['page_name'] = "truck/index";
        $data['css'] = array("css/plugins/dataTables/datatables.min.css");
        $data['js'] = array("js/plugins/dataTables/datatables.min.js");
        $data['trucks'] = $trucks;
        $this->breadcrumb->add($data['page_title'], $data['page_name']);
        $this->load->view('index', $data);
    }

    public function create() {
        $truck_makes = $this->Truck_makeModel->getAllTruck_makes();
        $licences = $this->LicenceModel->getAllLicences();
        if (!empty($this->input->post())) {
            $this->form_validation->set_rules('t_rego_num', 'Truck rego number', 'trim|required|xss_clean');
            $this->form_validation->set_rules('t_nick_name', 'Truck nick name', 'trim|required|xss_clean');
            $this->form_validation->set_rules('t_description', 'Truck description', 'trim|required|xss_clean');
            $this->form_validation->set_rules('t_make', 'Truck make', 'trim|required|xss_clean');
            $this->form_validation->set_rules('t_model', 'Truck model', 'trim|required|xss_clean');
            $this->form_validation->set_rules('t_lic_cls', 'Truck licence class', 'trim|required|xss_clean');
            $this->form_validation->set_rules('t_man_yr', 'Manufacture year', 'trim|required|xss_clean');
            $this->form_validation->set_rules('t_logbook', 'Logbook required', 'trim|required|xss_clean');
            $this->form_validation->set_rules('t_wof_date', 'Last COF/WOF date', 'trim|required|xss_clean');
            $this->form_validation->set_rules('t_notes', 'Truck notes', 'trim|required|xss_clean');
            $this->form_validation->set_rules('t_status', 'Status', 'trim|xss_clean');
            $post_data = $this->input->post();
            if ($this->form_validation->run() === TRUE) {
                $post_data["t_wof_date"] = date_format(date_create($this->input->post('t_wof_date')), "Y-m-d");
                $inserted_id = $this->TruckModel->createTruck($post_data);
                if ($inserted_id != "") {
                    $this->session->set_flashdata("success", "Truck is successfully created.");
                    redirect(base_url("trucks/index"));
                } else {
                    $this->session->set_flashdata("error", DB_OPERATION_ERROR);
                }
            } else {
                $data = $post_data;
            }
        }
        $data['truck_makes'] = $truck_makes;
        $data['licences'] = $licences;
        $data['page_title'] = "Create truck";
        $data['page_name'] = "truck/create";
        $data['css'] = array("css/plugins/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css", "css/plugins/iCheck/custom.css", "css/plugins/datapicker/datepicker3.css");
        $data['js'] = array("js/plugins/iCheck/icheck.min.js", "js/plugins/datapicker/bootstrap-datepicker.js");
        $this->breadcrumb->add("Truck", base_url("truck/index"));
        $this->breadcrumb->add($data['page_title'], $data['page_name']);
        $this->load->view('index', $data);
    }

    public function update($id) {
        $truck_makes = $this->Truck_makeModel->getAllTruck_makes();
        $licences = $this->LicenceModel->getAllLicences();
        if (!empty($this->input->post())) {
            $this->form_validation->set_rules('t_rego_num', 'Truck rego number', 'trim|required|xss_clean');
            $this->form_validation->set_rules('t_nick_name', 'Truck nick name', 'trim|required|xss_clean');
            $this->form_validation->set_rules('t_description', 'Truck description', 'trim|required|xss_clean');
            $this->form_validation->set_rules('t_make', 'Truck make', 'trim|required|xss_clean');
            $this->form_validation->set_rules('t_model', 'Truck model', 'trim|required|xss_clean');
            $this->form_validation->set_rules('t_lic_cls', 'Truck licence class', 'trim|required|xss_clean');
            $this->form_validation->set_rules('t_man_yr', 'Manufacture year', 'trim|required|xss_clean');
            $this->form_validation->set_rules('t_logbook', 'Logbook required', 'trim|required|xss_clean');
            $this->form_validation->set_rules('t_wof_date', 'Last COF/WOF date', 'trim|required|xss_clean');
            $this->form_validation->set_rules('t_notes', 'Truck notes', 'trim|required|xss_clean');
            $this->form_validation->set_rules('t_status', 'Status', 'trim|xss_clean');
            $post_data = $this->input->post();
            if ($this->form_validation->run() === TRUE) {
                $post_data["t_wof_date"] = date_format(date_create($this->input->post('t_wof_date')), "Y-m-d");
                $updated_data = $this->TruckModel->updateTruck($id, $post_data);
                if ($updated_data) {
                    $this->session->set_flashdata("success", "Truck is successfully updated.");
                    redirect(base_url("trucks/index"));
                } else {
                    $this->session->set_flashdata("error", DB_OPERATION_ERROR);
                }
            }
        }
        $data = $this->TruckModel->getTruck($id);
        $make_models = $this->Truck_modelModel->getMakeModels($data["t_make"]);
        $data['truck_makes'] = $truck_makes;
        $data['licences'] = $licences;
        $data['make_models'] = $make_models;
        $data['page_title'] = "Update truck";
        $data['page_name'] = "truck/update";
        $data['css'] = array("css/plugins/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css", "css/plugins/iCheck/custom.css", "css/plugins/datapicker/datepicker3.css");
        $data['js'] = array("js/plugins/iCheck/icheck.min.js", "js/plugins/datapicker/bootstrap-datepicker.js");
        $data['record_id'] = $id;
        $this->breadcrumb->add("Truck", base_url("truck/index"));
        $this->breadcrumb->add($data['page_title'], $data['page_name']);
        $this->load->view('index', $data);
    }

    public function delete($id) {

        $data = $this->TruckModel->getTruck($id);
        if ($data != "") {
            $updated_data = $this->TruckModel->deleteTruck($id);
            if ($updated_data) {
                $this->session->set_flashdata("success", "Truck is successfully removed.");
            } else {
                $this->session->set_flashdata("error", DB_OPERATION_ERROR);
            }
        } else {
            $this->session->set_flashdata("error", "Sorry! Truck not found.");
        }
        redirect(base_url("truck/index"));
    }
}
