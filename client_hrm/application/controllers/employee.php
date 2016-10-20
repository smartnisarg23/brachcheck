<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Employee extends CI_Controller {

    function __construct() {
        parent::__construct();
        $allow_methods = array("change_password", "email_exists", "email_exists_update");
        check_permission($allow_methods);
        $this->load->model('BranchModel');
        $this->load->model('DepartmentModel');
        $this->load->model('CostcenterModel');
        $this->load->model('DeliverycenterModel');
        $this->load->model('RoleModel');
        $this->load->model('EmployeeModel');
        $this->load->model('Employee_roleModel');
        $this->load->model('CompanyModel');
        $this->load->library('upload');
        $this->breadcrumb->add('Home', base_url());
        if ($this->router->fetch_method() == "index") {
            $this->datatable = TRUE;
        }
    }

    public function index() {
        $employees = $this->EmployeeModel->getAllEmployees();
        $data['page_title'] = "Employees";
        $data['page_name'] = "employee/index";
        $data['css'] = array("css/plugins/dataTables/datatables.min.css");
        $data['js'] = array("js/plugins/dataTables/datatables.min.js");
        $data['employees'] = $employees;
        $this->breadcrumb->add($data['page_title'], $data['page_name']);
        $this->load->view('index', $data);
    }

    public function create() {
        if (!empty($this->input->post())) {
            $this->form_validation->set_rules('e_id', 'Employee ID', 'trim|required|xss_clean');
            $this->form_validation->set_rules('e_role_id', 'System role', 'trim|required|xss_clean');
            $this->form_validation->set_rules('e_role_type_id', 'Employee role', 'trim|required|xss_clean');
            $this->form_validation->set_rules('e_fname', 'First name', 'trim|required|xss_clean');
            $this->form_validation->set_rules('e_mname', 'Middle name', 'trim|xss_clean');
            $this->form_validation->set_rules('e_lname', 'Last name', 'trim|required|xss_clean');
            $this->form_validation->set_rules('e_username', 'Username', 'trim|xss_clean');
            $this->form_validation->set_rules('e_email', 'Email', 'trim|required|xss_clean|callback_email_exists');
            $this->form_validation->set_rules('e_gender', 'Gender', 'trim|required|xss_clean');
            $this->form_validation->set_rules('e_joining_date', 'Start date', 'trim|required|xss_clean');
            $this->form_validation->set_rules('e_can_login', 'Can login', 'trim|xss_clean');
            if ($this->input->post('e_role_id') == "1") {
                $this->form_validation->set_rules('e_company_id', 'Company', 'trim|required|xss_clean');
            } elseif ($this->input->post('e_role_id') == "2") {
                $this->form_validation->set_rules('e_company_id', 'Company', 'trim|required|xss_clean');
                $this->form_validation->set_rules('e_branch_id', 'Branch', 'trim|required|xss_clean');
            } elseif ($this->input->post('e_role_id') == "3") {
                $this->form_validation->set_rules('e_company_id', 'Company', 'trim|required|xss_clean');
                $this->form_validation->set_rules('e_branch_id', 'Branch', 'trim|required|xss_clean');
                $this->form_validation->set_rules('e_department_id', 'Department', 'trim|required|xss_clean');
            } elseif ($this->input->post('e_role_id') == "4") {
                $this->form_validation->set_rules('e_company_id', 'Company', 'trim|required|xss_clean');
                $this->form_validation->set_rules('e_branch_id', 'Branch', 'trim|required|xss_clean');
                $this->form_validation->set_rules('e_costcenter_id', 'Cost center', 'trim|required|xss_clean');
            } elseif ($this->input->post('e_role_id') == "5") {
                $this->form_validation->set_rules('e_company_id', 'Company', 'trim|required|xss_clean');
                $this->form_validation->set_rules('e_branch_id', 'Branch', 'trim|required|xss_clean');
                $this->form_validation->set_rules('e_deliverycenter_id', 'Delivery center', 'trim|required|xss_clean');
            }
            $this->form_validation->set_rules('client_house_number', 'House number', 'trim|required|xss_clean');
            $this->form_validation->set_rules('client_address_street', 'Street name', 'trim|required|xss_clean');
            $this->form_validation->set_rules('client_address_suburb', 'Suburb', 'trim|required|xss_clean');
            $this->form_validation->set_rules('client_address_postalcode', 'Postal code', 'trim|required|xss_clean');
            $this->form_validation->set_rules('client_address_city', 'City', 'trim|required|xss_clean');
            $this->form_validation->set_rules('client_address_state', 'State', 'trim|required|xss_clean');
            $this->form_validation->set_rules('e_notes', 'Extra notes', 'trim|xss_clean');
            $this->form_validation->set_rules('e_status', 'Status', 'trim|xss_clean');
            $post_data = $this->input->post();
            $post_data["e_joining_date"] = date_format(date_create($this->input->post('e_joining_date')), "Y-m-d");
            if ($this->form_validation->run() === TRUE) {
                if ($post_data["e_can_login"] == 1) {
                    $client_data = array("client_fname" => $post_data['e_username'],
                        "client_lname" => $post_data['e_lname'],
                        "client_house_number" => $post_data['client_house_number'],
                        "client_address_street" => $post_data['client_address_street'],
                        "client_address_suburb" => $post_data['client_address_suburb'],
                        "client_address_city" => $post_data['client_address_city'],
                        "client_address_state" => $post_data['client_address_state'],
                        "client_address_postalcode" => $post_data['client_address_postalcode'],
                        "client_subdomain" => THIS_DOMAIN,
                        "client_start_date" => $post_data['e_joining_date'],
                        "create_user" => $this->session->userdata['remote_user_data']['employee']['id'],
                        "status" => $post_data['e_status']
                    );
                    $client_inserted_id = $this->EmployeeModel->createClientInAdminPortal($client_data);
                    $password = generate_random_string();
                    $login_data = array("role_id" => 3,
                        "client_id" => $client_inserted_id,
                        "email_id" => $post_data['e_email'],
                        "username" => $post_data['e_username'],
                        "password" => md5($password),
                        "status" => $post_data['e_status']
                    );
                    $login_inserted_id = $this->EmployeeModel->createLoginUser($login_data);
                    if ($login_inserted_id != "") {
                        $message = "Hello,<br> Your login credentials are:<br>Email: " . $post_data['e_email'] . "<br>" . "Password:" . $password . "<br>" . "You can change your password after first login.";
                        send_email($post_data['e_email'], "Engage Solutions | User Registration", $message);
                    }
                    $post_data["login_user_id"] = $login_inserted_id;
                }
                $employee_data = array("e_id" => $post_data['e_id'],
                    "e_role_id" => $post_data['e_role_id'],
                    "e_role_type_id" => $post_data['e_role_type_id'],
                    "e_fname" => $post_data['e_fname'],
                    "e_mname" => $post_data['e_mname'],
                    "e_lname" => $post_data['e_lname'],
                    "e_username" => $post_data['e_username'],
                    "e_gender" => $post_data['e_gender'],
                    "e_email" => $post_data['e_email'],
                    "e_house_number" => $post_data['client_house_number'],
                    "e_street" => $post_data['client_address_street'],
                    "e_suburb" => $post_data['client_address_suburb'],
                    "e_state" => $post_data['client_address_state'],
                    "e_city" => $post_data['client_address_city'],
                    "e_pincode" => $post_data['client_address_postalcode'],
                    "e_joining_date" => $post_data['e_joining_date'],
                    "e_company_id" => $post_data['e_company_id'],
                    "e_branch_id" => $post_data['e_branch_id'],
                    "e_department_id" => $post_data['e_department_id'],
                    "e_costcenter_id" => $post_data['e_costcenter_id'],
                    "e_deliverycenter_id" => $post_data['e_deliverycenter_id'],
                    "e_can_login" => $post_data['e_can_login'],
                    "login_user_id" => $post_data['login_user_id'],
                    "e_notes" => $post_data['e_notes'],
                    "e_status" => $post_data['e_status']
                );
                $inserted_id = $this->EmployeeModel->createEmployee($employee_data);
                if ($inserted_id != "") {
                    $this->session->set_flashdata("success", "Employee is successfully created.");
                    redirect(base_url("employee/index"));
                } else {
                    $this->session->set_flashdata("error", DB_OPERATION_ERROR);
                }
            } else {
                $data = $post_data;
            }
        }
        $data['roles'] = $this->RoleModel->getAllRoles();
        $data['role_types'] = $this->Employee_roleModel->getAllRoles();
        $data['companies'] = $this->CompanyModel->getAllCompanies();
        $data['page_title'] = "Create employee";
        $data['page_name'] = "employee/create";
        $data['css'] = array("css/plugins/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css", "css/plugins/iCheck/custom.css", "css/plugins/datapicker/datepicker3.css");
        $data['js'] = array("js/plugins/iCheck/icheck.min.js", "js/plugins/datapicker/bootstrap-datepicker.js");
        $this->breadcrumb->add("Employee", base_url("employee/index"));
        $this->breadcrumb->add($data['page_title'], $data['page_name']);
        $this->load->view('index', $data);
    }

    public function update($id) {
        $data = $this->EmployeeModel->getEmployee($id);
        if ($data != "") {
            if (!empty($this->input->post())) {
                $this->form_validation->set_rules('e_id', 'Employee ID', 'trim|required|xss_clean');
                $this->form_validation->set_rules('e_role_id', 'Role', 'trim|required|xss_clean');
                $this->form_validation->set_rules('e_role_type_id', 'Employee role', 'trim|required|xss_clean');
                $this->form_validation->set_rules('e_fname', 'First name', 'trim|required|xss_clean');
                $this->form_validation->set_rules('e_mname', 'Middle name', 'trim|xss_clean');
                $this->form_validation->set_rules('e_lname', 'Last name', 'trim|required|xss_clean');
                $this->form_validation->set_rules('e_email', 'Email', 'trim|required|xss_clean|callback_email_exists_update');
                $this->form_validation->set_rules('e_gender', 'Gender', 'trim|required|xss_clean');
                $this->form_validation->set_rules('e_joining_date', 'Start date', 'trim|required|xss_clean');
                $this->form_validation->set_rules('e_house_number', 'House number', 'trim|required|xss_clean');
                $this->form_validation->set_rules('e_street', 'Street', 'trim|required|xss_clean');
                $this->form_validation->set_rules('e_suburb', 'Suburb', 'trim|required|xss_clean');
                $this->form_validation->set_rules('e_pincode', 'Postal code', 'trim|required|xss_clean');
                $this->form_validation->set_rules('e_city', 'City', 'trim|required|xss_clean');
                $this->form_validation->set_rules('e_state', 'State', 'trim|required|xss_clean');
                $this->form_validation->set_rules('e_can_login', 'Can login', 'trim|xss_clean');
                if ($this->input->post('e_role_id') == "1") {
                    $this->form_validation->set_rules('e_company_id', 'Company', 'trim|required|xss_clean');
                } elseif ($this->input->post('e_role_id') == "2") {
                    $this->form_validation->set_rules('e_company_id', 'Company', 'trim|required|xss_clean');
                    $this->form_validation->set_rules('e_branch_id', 'Branch', 'trim|required|xss_clean');
                } elseif ($this->input->post('e_role_id') == "3") {
                    $this->form_validation->set_rules('e_company_id', 'Company', 'trim|required|xss_clean');
                    $this->form_validation->set_rules('e_branch_id', 'Branch', 'trim|required|xss_clean');
                    $this->form_validation->set_rules('e_department_id', 'Department', 'trim|required|xss_clean');
                } elseif ($this->input->post('e_role_id') == "4") {
                    $this->form_validation->set_rules('e_company_id', 'Company', 'trim|required|xss_clean');
                    $this->form_validation->set_rules('e_branch_id', 'Branch', 'trim|required|xss_clean');
                    $this->form_validation->set_rules('e_costcenter_id', 'Cost center', 'trim|required|xss_clean');
                } elseif ($this->input->post('e_role_id') == "5") {
                    $this->form_validation->set_rules('e_company_id', 'Company', 'trim|required|xss_clean');
                    $this->form_validation->set_rules('e_branch_id', 'Branch', 'trim|required|xss_clean');
                    $this->form_validation->set_rules('e_deliverycenter_id', 'Delivery center', 'trim|required|xss_clean');
                }
                $this->form_validation->set_rules('e_notes', 'Extra notes', 'trim|xss_clean');
                $this->form_validation->set_rules('e_status', 'Status', 'trim|xss_clean');
                $post_data = $this->input->post();
                if ($this->form_validation->run() === TRUE) {
                    $post_data["e_joining_date"] = date_format(date_create($this->input->post('e_joining_date')), "Y-m-d");
                    $employee_data = array("e_id" => $post_data['e_id'],
                        "e_role_id" => $post_data['e_role_id'],
                        "e_role_type_id" => $post_data['e_role_type_id'],
                        "e_fname" => $post_data['e_fname'],
                        "e_mname" => $post_data['e_mname'],
                        "e_lname" => $post_data['e_lname'],
                        "e_username" => $post_data['e_username'],
                        "e_gender" => $post_data['e_gender'],
                        "e_email" => $post_data['e_email'],
                        "e_house_number" => $post_data['e_house_number'],
                        "e_street" => $post_data['e_street'],
                        "e_suburb" => $post_data['e_suburb'],
                        "e_state" => $post_data['e_state'],
                        "e_city" => $post_data['e_city'],
                        "e_pincode" => $post_data['e_pincode'],
                        "e_joining_date" => $post_data['e_joining_date'],
                        "e_company_id" => $post_data['e_company_id'],
                        "e_branch_id" => $post_data['e_branch_id'],
                        "e_department_id" => $post_data['e_department_id'],
                        "e_costcenter_id" => $post_data['e_costcenter_id'],
                        "e_deliverycenter_id" => $post_data['e_deliverycenter_id'],
                        "e_can_login" => $post_data['e_can_login'],
                        "login_user_id" => $post_data['login_user_id'],
                        "e_notes" => $post_data['e_notes'],
                        "e_status" => $post_data['e_status']
                    );
                    $updated_data = $this->EmployeeModel->updateEmployee($id, $employee_data);
                    if ($updated_data) {
                        if ($post_data["e_can_login"] == 1) {
                            $client_data = array("client_fname" => $post_data['e_username'],
                                "client_lname" => $post_data['e_lname'],
                                "client_house_number" => $post_data['e_house_number'],
                                "client_address_street" => $post_data['e_street'],
                                "client_address_suburb" => $post_data['e_suburb'],
                                "client_address_city" => $post_data['e_city'],
                                "client_address_state" => $post_data['e_state'],
                                "client_address_postalcode" => $post_data['e_pincode'],
                                "client_subdomain" => THIS_DOMAIN,
                                "client_start_date" => $post_data['e_joining_date'],
                                "update_user" => $this->session->userdata['remote_user_data']['employee']['id'],
                                "status" => $post_data['e_status']
                            );
                            $client_id = $this->EmployeeModel->getClientIdByEmployeeEmail($data['e_email']);
                            $client_inserted_id = $this->EmployeeModel->updateClientInAdminPortal($client_id['client_id'], $client_data);
                            $login_data = array("username" => $post_data['e_username'],
                                "email_id" => $post_data['e_email'],
                                "status" => $post_data['e_status']
                            );
                            $this->EmployeeModel->updateLoginUser($data['login_user_id'], $login_data);
                        }
                        $this->session->set_flashdata("success", "Employee is successfully updated.");
                        redirect(base_url("employee/index"));
                    } else {
                        $this->session->set_flashdata("error", DB_OPERATION_ERROR);
                    }
                }
            }

            $data['roles'] = $this->RoleModel->getAllRoles();
            $data['role_types'] = $this->Employee_roleModel->getAllRoles();
            $data['companies'] = $this->CompanyModel->getAllCompanies();
            $data['branches'] = $this->BranchModel->getCompanyBranches($data['e_company_id']);
            $data['departments'] = $this->DepartmentModel->getBranchDepartments($data['e_company_id'], $data['e_branch_id']);
            $data['costcenters'] = $this->CostcenterModel->getBranchCostcenters($data['e_company_id'], $data['e_branch_id']);
            $data['deliverycenters'] = $this->DeliverycenterModel->getBranchDeliverycenters($data['e_company_id'], $data['e_branch_id']);
            $data['page_title'] = "Update employee";
            $data['page_name'] = "employee/update";
            $data['record_id'] = $id;
            $data['css'] = array("css/plugins/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css", "css/plugins/iCheck/custom.css", "css/plugins/datapicker/datepicker3.css");
            $data['js'] = array("js/plugins/iCheck/icheck.min.js", "js/plugins/datapicker/bootstrap-datepicker.js");
            $this->breadcrumb->add("Employee", base_url("employee/index"));
            $this->breadcrumb->add($data['page_title'], $data['page_name']);
            $this->load->view('index', $data);
        } else {
            $this->session->set_flashdata("error", "Sorry! Employee not found.");
            redirect(base_url("employee/index"));
        }
    }

    public function change_password() {
        if (!empty($this->input->post())) {
            $this->form_validation->set_rules('c_password', 'Current password', 'trim|required|xss_clean');
            $this->form_validation->set_rules('n_password', 'New password', 'trim|required|xss_clean|matches[rn_password]');
            $this->form_validation->set_rules('rn_password', 'Repeat new password', 'trim|required|xss_clean');
            if ($this->form_validation->run() === TRUE) {
                $data = $this->EmployeeModel->getEmployeePassword($this->session->userdata['remote_user_data']['id']);
                $post_data = $this->input->post();
                if ($data['password'] == md5($post_data['c_password'])) {
                    $this->EmployeeModel->updateLoginUser($this->session->userdata['remote_user_data']['id'], array("password" => md5($post_data['n_password'])));
                    $this->session->set_flashdata("success", "Your password is successfully changed.");
                    redirect(base_url("dashboard/index"));
                } else {
                    $this->session->set_flashdata("error", "Current password is not matching");
                    redirect(base_url("employee/change_password"));
                }
            }
        }
        $data['page_title'] = "Change password";
        $data['page_name'] = "employee/change_password";
        $this->breadcrumb->add("Employee", base_url("employee/index"));
        $this->breadcrumb->add($data['page_title'], $data['page_name']);
        $this->load->view('index', $data);
    }

    public function delete($id) {

        $data = $this->EmployeeModel->getEmployee($id);
        if ($data != "") {
            $updated_data = $this->EmployeeModel->deleteEmployee($id);
            if ($updated_data) {
                $this->session->set_flashdata("success", "Employee is successfully removed.");
            } else {
                $this->session->set_flashdata("error", DB_OPERATION_ERROR);
            }
        } else {
            $this->session->set_flashdata("error", "Sorry! Employee not found.");
        }
        redirect(base_url("employee/index"));
    }

    public function profile() {
        $employee = $this->session->userdata['remote_user_data']['employee']['id'];
        $data = $this->EmployeeModel->getEmployee($employee);
        if (!empty($this->input->post())) {
            $this->form_validation->set_rules('e_id', 'Employee ID', 'trim|required|xss_clean');
            $this->form_validation->set_rules('e_fname', 'First name', 'trim|required|xss_clean');
            $this->form_validation->set_rules('e_lname', 'Last name', 'trim|required|xss_clean');
            $this->form_validation->set_rules('e_email', 'Email', 'trim|required|xss_clean|callback_email_exists_profile');
            $this->form_validation->set_rules('e_mobile', 'Mobile', 'trim|numeric|xss_clean');
            $this->form_validation->set_rules('e_street', 'Street', 'trim|xss_clean');
            $this->form_validation->set_rules('e_suburb', 'Suburb', 'trim|xss_clean');
            $this->form_validation->set_rules('e_state', 'State', 'trim|xss_clean');
            $this->form_validation->set_rules('e_city', 'City', 'trim|xss_clean');
            $this->form_validation->set_rules('e_pincode', 'Pincode', 'trim|xss_clean');
            $post_data = $this->input->post();

            if ($this->form_validation->run() === TRUE) {
                if (isset($_FILES['profile_image']) && $_FILES['profile_image']['name'] != "") {
                    if (!file_exists(FCPATH . 'assets/img/employee_profile/' . $this->session->userdata['remote_user_data']['employee']['id'])) {
                        mkdir(FCPATH . 'assets/img/employee_profile/' . $this->session->userdata['remote_user_data']['employee']['id'], 0777, true);
                    }
                    $config = array(
                        'upload_path' => FCPATH . 'assets/img/employee_profile/' . $this->session->userdata['remote_user_data']['employee']['id'],
                        'allowed_types' => "gif|jpg|png|jpeg",
                        'overwrite' => TRUE,
                        'max_size' => "2048000", // Can be set to particular file size , here it is 2 MB(2048 Kb)
                        'max_height' => "768",
                        'max_width' => "1024"
                    );
                    $this->upload->initialize($config);
                    if ($this->upload->do_upload("profile_image")) {
                        $profile_image_data = $this->upload->data();
                        $post_data['e_profile_image'] = $profile_image_data['file_name'];
                    } else {
                        $this->session->set_flashdata("error", $this->upload->display_errors());
                        redirect(base_url("employee/profile"));
                    }
                }
                $updated_data = $this->EmployeeModel->updateEmployee($employee, $post_data);
                $client_data['client_fname'] = $this->input->post('e_fname');
                $client_data['client_lname'] = $this->input->post('e_lname');
                $client_data['client_address_street'] = $this->input->post('e_street');
                $client_data['client_address_suburb'] = $this->input->post('e_suburb');
                $client_data['client_address_city'] = $this->input->post('e_city');
                $client_data['client_address_state'] = $this->input->post('e_state');
                $client_data['client_address_postalcode'] = $this->input->post('e_pincode');
                $updated_data = $this->EmployeeModel->updateClientInAdminPortal($this->session->userdata['remote_user_data']['client_id'], $client_data);
                if ($updated_data) {
                    $user_session_data = $this->session->userdata['remote_user_data'];
                    $data = $this->EmployeeModel->getEmployeeByEmail($this->session->userdata['remote_user_data']['email_id']);
                    $user_session_data['employee'] = $data;
                    $this->session->set_userdata('remote_user_data', $user_session_data);
                    $this->session->set_flashdata("success", "Your profile is successfully updated.");
                    redirect(base_url("dashboard/index"));
                } else {
                    $this->session->set_flashdata("error", DB_OPERATION_ERROR);
                }
            }
        }
        $data['page_title'] = "Update profile";
        $data['page_name'] = "employee/profile";
        $data['css'] = array("css/plugins/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css", "css/plugins/iCheck/custom.css", "css/plugins/datapicker/datepicker3.css");
        $data['js'] = array("js/plugins/iCheck/icheck.min.js", "js/plugins/datapicker/bootstrap-datepicker.js");
        $this->breadcrumb->add("Employee", base_url("employee/index"));
        $this->breadcrumb->add($data['page_title'], $data['page_name']);
        $this->load->view('index', $data);
    }

    public function email_exists($email) {
        $rows = $this->EmployeeModel->emailExists($email);
        if ($rows > 0) {
            $this->form_validation->set_message('email_exists', 'Email id already exists. Please choose another one.');
            return false;
        } else {
            return true;
        }
    }

    public function email_exists_update() {
        $rows = $this->EmployeeModel->emailExistsUpdate($this->uri->segment(3), $this->input->post('e_email'));
        if ($rows > 0) {
            $this->form_validation->set_message('email_exists_update', 'Email id already exists. Please choose another one.');
            return false;
        } else {
            return true;
        }
    }

    public function email_exists_profile() {
        $rows = $this->EmployeeModel->emailExistsUpdate($this->session->userdata['remote_user_data']['employee']['id'], $this->input->post('e_email'));
        if ($rows > 0) {
            $this->form_validation->set_message('email_exists_update', 'Email id already exists. Please choose another one.');
            return false;
        } else {
            return true;
        }
    }

}
