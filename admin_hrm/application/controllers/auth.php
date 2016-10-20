<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Auth extends CI_Controller {

    function __construct() {
        parent::__construct();
//        check_permission();
        $this->load->model('AuthModel');
        $this->load->model('UserModel');
    }

    public function index() {
        if (!empty($this->session->userdata['user_data']) && $this->session->userdata['user_data']['role_id'] == "1") {
            redirect(base_url('dashboard/index'));
        }
        if (!empty($this->session->userdata['user_data']) && $this->session->userdata['user_data']['role_id'] != "1") {
            redirect(base_url('auth/choose_subdomain'));
        }
        $data['page_title'] = "Login";
        $this->load->view('login', $data);
    }

    public function login() {
        if (!empty($this->input->post())) {

            $this->form_validation->set_rules('email', 'Username/Email', 'trim|required|xss_clean');
            $this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');

            if ($this->form_validation->run() === TRUE) {
                $post_data = $this->input->post();
                $login_data = $this->AuthModel->getLoginData($post_data);
                $this->AuthModel->updateLastLogin($login_data["id"]);
                if (!empty($login_data)) {
                    if ($login_data["client_id"] == "0" && $login_data["supplier_id"] == "0") {
                        $user_session_data = array("id" => $login_data['id'],
                            "role_id" => $login_data['role_id'],
                            "username" => $login_data['username'],
                            "email_id" => $login_data['email_id'],
                            "last_login" => $login_data['last_login'],
                            "created_date" => $login_data['created_date'],
                            "status" => $login_data['status'],
                            "role_name" => $login_data['role_name'],
                            "is_admin_login" => false);
                        $this->session->set_userdata('user_data', $user_session_data);
//                        $this->session->set_flashdata("success", "Welcome to Engage - ".$user_session_data['username']);
                        redirect(base_url('dashboard/index'));
                    } elseif ($login_data["supplier_id"] != "0" && $login_data["client_id"] == "0") {
                        $supplier_data = $this->AuthModel->getSupplierData($login_data["supplier_id"]);
                        if (!empty($supplier_data) && $supplier_data["status"] == "1") {
                            $user_session_data = array("id" => $login_data['id'],
                                "role_id" => $login_data['role_id'],
                                "supplier_id" => $supplier_data['supplier_id'],
                                "username" => $login_data['username'],
                                "firstname" => $supplier_data['supplier_fname'],
                                "lastname" => $supplier_data['supplier_lname'],
                                "email_id" => $login_data['email_id'],
                                "user_subdomain" => $supplier_data['supplier_subdomain'],
                                "subscription_date" => $supplier_data['supplier_start_date'],
                                "last_login" => $login_data['last_login'],
                                "created_date" => $login_data['created_date'],
                                "status" => $login_data['status'],
                                "role_name" => $login_data['role_name'],
                                "is_admin_login" => false);
                            $this->session->set_userdata('remote_user_data', $user_session_data);
                            redirect($user_session_data['user_subdomain']);
                        } else {
                            $this->session->set_flashdata("error", "Your account is suspended. Please contact Administrator.");
                            redirect(base_url('auth/index'));
                        }
                    } elseif ($login_data["client_id"] != "0" && $login_data["supplier_id"] == "0") {
                        $client_data = $this->AuthModel->getClientData($login_data["client_id"]);
                        if (!empty($client_data) && $client_data["status"] == "1") {
                            $user_session_data = array("id" => $login_data['id'],
                                "role_id" => $login_data['role_id'],
                                "client_id" => $client_data['client_id'],
                                "username" => $login_data['username'],
                                "firstname" => $client_data['client_fname'],
                                "lastname" => $client_data['client_lname'],
                                "email_id" => $login_data['email_id'],
                                "user_subdomain" => $client_data['client_subdomain'],
                                "subscription_date" => $client_data['client_start_date'],
                                "last_login" => $login_data['last_login'],
                                "created_date" => $login_data['created_date'],
                                "status" => $login_data['status'],
                                "role_name" => $login_data['role_name'],
                                "is_admin_login" => false);
                            $this->session->set_userdata('remote_user_data', $user_session_data);
                            redirect($user_session_data['user_subdomain']);
                        } else {
                            $this->session->set_flashdata("error", "Your account is suspended. Please contact Administrator.");
                            redirect(base_url('auth/index'));
                        }
                    } elseif ($login_data["client_id"] != "0" && $login_data["supplier_id"] != "0") {
                        $client_data = $this->AuthModel->getClientData($login_data["client_id"]);
                        if (!empty($client_data) && $client_data["status"] == "1") {
                            $user_session_data = array("id" => $login_data['id'],
                                "role_id" => $login_data['role_id'],
                                "username" => $login_data['username'],
                                "firstname" => $client_data['client_fname'],
                                "lastname" => $client_data['client_lname'],
                                "email_id" => $login_data['email_id'],
                                "user_subdomain" => $client_data['client_subdomain'],
                                "subscription_date" => $client_data['client_start_date'],
                                "last_login" => $login_data['last_login'],
                                "created_date" => $login_data['created_date'],
                                "status" => $login_data['status'],
                                "role_name" => $login_data['role_name'],
                                "is_admin_login" => false);
                            $this->session->set_userdata('user_data', $user_session_data);
                            redirect(base_url("auth/choose_subdomain"));
                        } else {
                            $this->session->set_flashdata("error", "Your account is suspended. Please contact Administrator.");
                            redirect(base_url('auth/index'));
                        }
                    }
                } else {
                    $this->session->set_flashdata("error", "Your credentials are not correct.");
                    redirect(base_url('auth/index'));
                }
            } else {
                $this->session->set_flashdata("error", "Your credentials are not correct.");
                redirect(base_url('auth/index'));
            }
        } else {
            redirect(base_url('auth/index'));
        }
    }

    function logout() {
        $this->session->unset_userdata('user_data');
        redirect(base_url('auth/index'));
    }

    function choose_subdomain($type = "") {
        if ($type != "" && $type == "supplier") {
            $user_session_data = $this->session->userdata['user_data'];
            $user_session_data["role_id"] = 2;
            $user_session_data["role_name"] = "Supplier";
            $user_session_data["user_subdomain"] = SUPPLIER_SYSTEM;
            $this->session->set_userdata('remote_user_data', $user_session_data);
            redirect($user_session_data['user_subdomain']);
        }
        if ($type != "" && $type == "client") {
            $client_data = $this->AuthModel->getClientDataByUserId($this->session->userdata['user_data']['id']);
            $user_session_data = $this->session->userdata['user_data'];
            $user_session_data["role_id"] = 3;
            $user_session_data["role_name"] = "Client";
            $user_session_data["user_subdomain"] = $client_data["client_subdomain"];
            $this->session->set_userdata('remote_user_data', $user_session_data);
            redirect($user_session_data['user_subdomain']);
        }
        $data['page_title'] = "Choose subdomain";
        $this->load->view('auth/choose_subdomain', $data);
    }

    function forgot_password() {
        if (!empty($this->input->post())) {
            $this->form_validation->set_rules('email', 'Email', 'trim|required|xss_clean');
            if ($this->form_validation->run() === TRUE) {
                $post_data = $this->input->post();
                $login_data = $this->AuthModel->getLoginData($post_data);
                if (!empty($login_data)) {
                    
                } else {
                    $this->session->set_flashdata("error", "Your credentials are not correct.");
                    redirect(base_url('auth/index'));
                }
            } else {
                $this->session->set_flashdata("error", "Your credentials are not correct.");
                redirect(base_url('auth/index'));
            }
        } else {
            redirect(base_url('auth/index'));
        }
    }

    function get_user_portal($user_id) {
        if ($this->session->userdata['user_data']['role_id'] == "1") {
            $user_data = $this->UserModel->getUserById($user_id);
            if ($user_data['role_id'] == "2") {
                $supplier_data = $this->UserModel->getSupplierData($user_id);
                $user_session_data = array("id" => $user_data['id'],
                    "role_id" => $user_data['role_id'],
                    "username" => $user_data['username'],
                    "supplier_id" => $supplier_data['supplier_id'],
                    "firstname" => $supplier_data['supplier_fname'],
                    "lastname" => $supplier_data['supplier_lname'],
                    "email_id" => $user_data['email_id'],
                    "user_subdomain" => $supplier_data['supplier_subdomain'],
                    "last_login" => $user_data['last_login'],
                    "created_date" => $user_data['created_date'],
                    "status" => $user_data['status'],
                    "role_name" => $user_data['role_name'],
                    "is_admin_login" => true
                );
                $this->session->set_userdata('remote_user_data', $user_session_data);
                redirect($user_session_data['user_subdomain']);
            }
            if ($user_data['role_id'] == "3") {
                $client_data = $this->UserModel->getClientData($user_id);
                $user_session_data = array("id" => $user_data['id'],
                    "role_id" => $user_data['role_id'],
                    "username" => $user_data['username'],
                    "client_id" => $supplier_data['client_id'],
                    "firstname" => $client_data['client_fname'],
                    "lastname" => $client_data['client_lname'],
                    "email_id" => $user_data['email_id'],
                    "user_subdomain" => $client_data['client_subdomain'],
                    "last_login" => $user_data['last_login'],
                    "created_date" => $user_data['created_date'],
                    "status" => $user_data['status'],
                    "role_name" => $user_data['role_name'],
                    "is_admin_login" => true
                );
                $this->session->set_userdata('remote_user_data', $user_session_data);
                redirect($user_session_data['user_subdomain']);
            }
        }
    }
}