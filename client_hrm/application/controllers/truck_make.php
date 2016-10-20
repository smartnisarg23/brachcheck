<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Truck_make extends CI_Controller {

    function __construct() {
        parent::__construct();
        check_permission();
        $this->load->model('Truck_makeModel');
        $this->breadcrumb->add('Home', base_url());
        if ($this->router->fetch_method() == "index") {
            $this->datatable = TRUE;
        }
    }

    public function index() {
        $truck_makes = $this->Truck_makeModel->getAllTruck_makes();
        $data['page_title'] = "Truck maker";
        $data['page_name'] = "truck_make/index";
        $data['css'] = array("css/plugins/dataTables/datatables.min.css");
        $data['js'] = array("js/plugins/dataTables/datatables.min.js");
        $data['truck_makes'] = $truck_makes;
        $this->breadcrumb->add($data['page_title'], $data['page_name']);
        $this->load->view('index', $data);
    }

    public function create() {
        if (!empty($this->input->post())) {
            $this->form_validation->set_rules('tm_name', 'Name', 'trim|required|xss_clean');
            $post_data = $this->input->post();
            if ($this->form_validation->run() === TRUE) {
                $inserted_id = $this->Truck_makeModel->createTruck_make($post_data);
                if ($inserted_id != "") {
                    $this->session->set_flashdata("success", "Truck maker is successfully created.");
                    redirect(base_url("truck_make/index"));
                } else {
                    $this->session->set_flashdata("error", DB_OPERATION_ERROR);
                }
            } else {
                $data = $post_data;
            }
        }
        $data['page_title'] = "Create truck maker";
        $data['page_name'] = "truck_make/create";
        $this->breadcrumb->add("Truck maker", base_url("truck_make/index"));
        $this->breadcrumb->add($data['page_title'], $data['page_name']);
        $this->load->view('index', $data);
    }

    public function update($id) {
        if (!empty($this->input->post())) {
            $this->form_validation->set_rules('tm_name', 'Name', 'trim|required|xss_clean');
            $post_data = $this->input->post();
            if ($this->form_validation->run() === TRUE) {
                $updated_data = $this->Truck_makeModel->updateTruck_make($id, $post_data);
                if ($updated_data) {
                    $this->session->set_flashdata("success", "Trucks maker is successfully updated.");
                    redirect(base_url("truck_make/index"));
                } else {
                    $this->session->set_flashdata("error", DB_OPERATION_ERROR);
                }
            }
        }

        $data = $this->Truck_makeModel->getTruck_make($id);
        $data['page_title'] = "Update truck maker";
        $data['page_name'] = "truck_make/update";
        $data['record_id'] = $id;
        $this->breadcrumb->add("Truck maker", base_url("truck_make/index"));
        $this->breadcrumb->add($data['page_title'], $data['page_name']);
        $this->load->view('index', $data);
    }

    public function delete($id) {
        $data = $this->Truck_makeModel->getTruck_make($id);
        if ($data != "") {
            $updated_data = $this->Truck_makeModel->deleteTruck_make($id);
            if ($updated_data) {
                $this->session->set_flashdata("success", "Trucks maker is successfully removed.");
            } else {
                $this->session->set_flashdata("error", DB_OPERATION_ERROR);
            }
        } else {
            $this->session->set_flashdata("error", "Sorry! Trucks maker not found.");
        }
        redirect(base_url("truck_make/index"));
    }

}
