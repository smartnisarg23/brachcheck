<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    function __construct() {
        parent::__construct();
        if (empty($this->session->userdata['remote_user_data'])) {
            redirect(base_url('auth/index'));
        }
        $this->breadcrumb->add('Home', base_url());
        if($this->router->fetch_method() == "index"){
            $this->datatable = TRUE;
        }
    }

    public function index() {
        $data['page_title'] = "Home";
        $data['page_name'] = "dashboard/index";
        $data['css'] = array("css/plugins/toastr/toastr.min.css");
        $data['js'] = array("js/plugins/toastr/toastr.min.js");
        $this->load->view('index', $data);
    }
}