<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Auth extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('AuthModel');
        $this->load->model('EmployeeModel');
    }

    public function index() {
        if (!empty($this->session->userdata['remote_user_data'])) {
            $user_session_data = $this->session->userdata['remote_user_data'];
            $data = $this->EmployeeModel->getEmployeeByEmail($this->session->userdata['remote_user_data']['email_id']);
            $user_session_data['employee'] = $data;
            $this->session->set_userdata('remote_user_data', $user_session_data);
//            $this->session->set_flashdata("success", "Welcome to Engage - ".$user_session_data['firstname']);
            redirect(base_url('dashboard/index'));
        } else {
            redirect(ADMIN_SYSTEM);
        }
        $data['page_title'] = "Login";
        $this->load->view('login', $data);
    }

    public function logout() {
        $this->session->unset_userdata('remote_user_data');
        redirect(ADMIN_SYSTEM);
    }

}