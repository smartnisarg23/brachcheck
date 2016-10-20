<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Truck_model extends CI_Controller {

    function __construct() {
        parent::__construct();
        check_permission();
        $this->load->model('Truck_makeModel');
        $this->load->model('Truck_modelModel');
        $this->breadcrumb->add('Home', base_url());
        if($this->router->fetch_method() == "index"){
            $this->datatable = TRUE;
        }
    }

    public function index() {
        $truck_models = $this->Truck_modelModel->getAllTruck_models();
        $data['page_title'] = "Truck model";
        $data['page_name'] = "truck_model/index";
        $data['css'] = array("css/plugins/dataTables/datatables.min.css");
        $data['js'] = array("js/plugins/dataTables/datatables.min.js");
        $data['truck_models'] = $truck_models;
        $this->breadcrumb->add($data['page_title'], $data['page_name']);
        $this->load->view('index', $data);
    }

    public function create() {
        $truck_makes = $this->Truck_makeModel->getAllTruck_makes();
        if (!empty($this->input->post())) {
            $this->form_validation->set_rules('tm_name', 'Name', 'trim|required|xss_clean');
            $this->form_validation->set_rules('tm_make', 'Truck make', 'trim|required|xss_clean');
            $post_data = $this->input->post();
            if ($this->form_validation->run() === TRUE) {
                $inserted_id = $this->Truck_modelModel->createTruck_model($post_data);
                if ($inserted_id != "") {
                    $this->session->set_flashdata("success", "Truck model is successfully created.");
                    redirect(base_url("truck_model/index"));
                } else {
                    $this->session->set_flashdata("error", DB_OPERATION_ERROR);
                }
            } else {
                $data = $post_data;
            }
        }
        $data['truck_makes'] = $truck_makes;
        $data['page_title'] = "Create truck model";
        $data['page_name'] = "truck_model/create";
        $this->breadcrumb->add("Truck model", base_url("truck_model/index"));
        $this->breadcrumb->add($data['page_title'], $data['page_name']);
        $this->load->view('index', $data);
    }

    public function update($id) {
        $truck_makes = $this->Truck_makeModel->getAllTruck_makes();
        if (!empty($this->input->post())) {
            $this->form_validation->set_rules('tm_name', 'Name', 'trim|required|xss_clean');
            $this->form_validation->set_rules('tm_make', 'Truck make', 'trim|required|xss_clean');
            $post_data = $this->input->post();
            if ($this->form_validation->run() === TRUE) {
                $updated_data = $this->Truck_modelModel->updateTruck_model($id, $post_data);
                if ($updated_data) {
                    $this->session->set_flashdata("success", "Truck model is successfully updated.");
                    redirect(base_url("truck_model/index"));
                } else {
                    $this->session->set_flashdata("error", DB_OPERATION_ERROR);
                }
            }
        }

        $data = $this->Truck_modelModel->getTruck_model($id);
        $data['truck_makes'] = $truck_makes;
        $data['page_title'] = "Update truck model";
        $data['page_name'] = "truck_model/update";
        $data['record_id'] = $id;
        $this->breadcrumb->add("Truck model", base_url("truck_model/index"));
        $this->breadcrumb->add($data['page_title'], $data['page_name']);
        $this->load->view('index', $data);
    }

    public function delete($id) {
        $data = $this->Truck_modelModel->getTruck_model($id);
        if ($data != "") {
            $updated_data = $this->Truck_modelModel->deleteTruck_model($id);
            if ($updated_data) {
                $this->session->set_flashdata("success", "Truck model is successfully removed.");
            } else {
                $this->session->set_flashdata("error", DB_OPERATION_ERROR);
            }
        } else {
            $this->session->set_flashdata("error", "Sorry! Truck model not found.");
        }
        redirect(base_url("truck_model/index"));
    }

    public function get_make_models($make_id = "") {
        if (isset($_POST['make_id'])) {
            $this->output
                    ->set_content_type("application/json")
                    ->set_output(json_encode($this->Truck_modelModel->getMakeModels($_POST['make_id'])));
        }
    }
}
