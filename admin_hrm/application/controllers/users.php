<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Users extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('UserModel');
        check_permission();
        $this->breadcrumb->add('Home', base_url());
    }

    public function index() {
        $users = $this->UserModel->getUsers();
        $data['page_title'] = "Users";
        $data['page_name'] = "users/index";
        $data['css'] = array("css/plugins/dataTables/datatables.min.css");
        $data['js'] = array("js/plugins/dataTables/datatables.min.js");
        $data['users'] = $users;
        $this->breadcrumb->add($data['page_title'], base_url("users/index"));
        $this->load->view('index', $data);
    }
}