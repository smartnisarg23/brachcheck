<?php

function pre($data) {
    echo "<pre>";
    print_r($data);
    echo "</pre>";
    die;
}

function pr($data) {
    echo "<pre>";
    print_r($data);
    echo "</pre>";
}

function get_status($status) {
    if ($status == "-1") {
        return "Removed";
    } elseif ($status == "0") {
        return "Unactive";
    } elseif ($status == "1") {
        return "Active";
    }
}

function check_permission($allow_methods = array()) {
    $CI = & get_instance();
    if (!empty($CI->session->userdata['user_data'])) {
        if ($CI->session->userdata['user_data']['role_id'] != "1") {
            redirect('auth/index');
        }
    } else {
        redirect(base_url('auth/index'));
    }
}

function get_user_domain($role_id, $user_id){
    $CI = & get_instance();
    if($role_id == "2"){
        $data = $CI->UserModel->getSupplierData($user_id);
        return $data['supplier_subdomain'];
    }
    if($role_id == "3"){
        $data = $CI->UserModel->getClientData($user_id);
        return $data['client_subdomain'];
    }
}