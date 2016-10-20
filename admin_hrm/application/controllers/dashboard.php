<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    function __construct() {
        parent::__construct();
        check_permission();
        $this->breadcrumb->add('Home', base_url());
    }

    public function index() {
        $data['page_title'] = "Home";
        $data['page_name'] = "dashboard/index";
        $data['css'] = array("css/plugins/toastr/toastr.min.css");
        $data['js'] = array("js/plugins/toastr/toastr.min.js");
        $this->load->view('index', $data);
    }

}
