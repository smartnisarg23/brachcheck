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

function generate_random_string($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

function send_email($to, $subject, $message) {
    $CI = & get_instance();
    $CI->load->library('email');
    $config['protocol'] = 'smtp';
    $config['smtp_host'] = 'ssl://smtp.gmail.com';
    $config['smtp_port'] = 465;
    $config['smtp_timeout'] = '30';
    $config['smtp_user'] = 'nisarg.phpdeveloper@gmail.com';
    $config['smtp_pass'] = 'Nisarg@90';
    $config['charset'] = 'utf-8';
    $config['newline'] = "\r\n";
    $config['wordwrap'] = TRUE;
    $config['mailtype'] = 'html';
    $CI->email->initialize($config);
    $CI->email->from('nisarg.phpdeveloper@gmail.com', 'Nisarg Patel');
    $CI->email->to($to);
    $CI->email->subject($subject);
    $CI->email->message($message);
    if ($CI->email->send()) {
        return true;
    } else {
        return show_error($this->email->print_debugger());
    }
}

function last_query() {
    $CI = & get_instance();
    echo "<pre>";
    print_r($CI->db->last_query());
    echo "</pre>";
    die;
}

function check_permission($allow_methods = array()) {
    $CI = & get_instance();
    $CI->load->model('PermissionModel');
    if (!empty($CI->session->userdata['remote_user_data'])) {
//        if (!in_array($CI->router->fetch_method(), $allow_methods)) {
//            $has_permission = $CI->PermissionModel->checkPermission($CI->session->userdata['remote_user_data']['employee']['e_role_id'], $CI->router->fetch_class(), $CI->router->fetch_method());
//            if (count($has_permission) <= 0) {
//                $CI->session->set_flashdata("error", NO_USER_PERMISSION);
//                redirect(base_url("dashboard/index"));
//            }
//        }
    } else {
        redirect(base_url('auth/index'));
    }
}
