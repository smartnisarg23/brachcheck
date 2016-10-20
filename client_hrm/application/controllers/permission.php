<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Permission extends CI_Controller {

    function __construct() {
        parent::__construct();
        check_permission();
        $this->load->model('RoleModel');
        $this->load->model('PermissionModel');
        $this->breadcrumb->add('Home', base_url());
    }

    public function index() {
        $permissions = $this->PermissionModel->getAllPermissions();
        $permission_list = $this->controllerlist->getControllers();
        $roles = $this->RoleModel->getAllRoles();
        $data['page_title'] = "Permissions";
        $data['page_name'] = "permission/index";
        $data['css'] = array("css/plugins/iCheck/custom.css");
        $data['js'] = array("js/plugins/iCheck/icheck.min.js");
        $data['permission_list'] = $permission_list;
        $data['permissions'] = $permissions;
        $data['roles'] = array_reverse($roles);
        $this->breadcrumb->add($data['page_title'], $data['page_name']);
        $this->load->view('index', $data);
    }

    public function manage_permission() {
        if (isset($_POST['operation']) && $_POST['operation'] == "add") {
            $insert_id = $this->PermissionModel->addPermission($_POST['role_id'], $_POST['controller'], $_POST['action']);
            if ($insert_id != "") {
                echo json_encode(array("status" => "success"));
            } else {
                echo json_encode(array("status" => "error"));
            }
        }
        if (isset($_POST['operation']) && $_POST['operation'] == "remove") {
            $attected_rows = $this->PermissionModel->removePermission($_POST['role_id'], $_POST['controller'], $_POST['action']);
            if ($attected_rows > 0) {
                echo json_encode(array("status" => "success"));
            } else {
                echo json_encode(array("status" => "error"));
            }
        }
    }

}