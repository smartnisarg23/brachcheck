<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav metismenu" id="side-menu">
            <li class="nav-header">
                <div class="dropdown profile-element">
                    <span>
                        <img src="<?= base_url(($this->session->userdata['remote_user_data']['employee']['e_profile_image'] != "") ? "assets/img/employee_profile/" . $this->session->userdata['remote_user_data']['employee']['id'] . '/' . $this->session->userdata['remote_user_data']['employee']['e_profile_image'] : "assets/img/profile_small.jpg") ?>" class="img-circle" alt="image" width="48" height="48">
                    </span>
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                        <span class="clear"> <span class="block m-t-xs"> <strong class="font-bold"><?= (isset($this->session->userdata['remote_user_data']['is_admin_login']) && $this->session->userdata['remote_user_data']['is_admin_login'] == true) ? "Admin Login : " : ""; ?><?= $this->session->userdata['remote_user_data']['employee']['e_fname'] . " " . $this->session->userdata['remote_user_data']['employee']['e_lname'] ?></strong>
                            </span> <span class="text-muted text-xs block"> <?= $this->session->userdata['remote_user_data']['role_name'] . ':' . (isset($this->session->userdata['remote_user_data']['employee']) ? $this->session->userdata['remote_user_data']['employee']['role'] : "") ?> <b class="caret"></b></span> </span> </a>
                    <ul class="dropdown-menu animated fadeInRight m-t-xs">
                        <li><a href="<?= base_url('employee/profile') ?>">Profile</a></li>
                        <li><a href="<?= base_url('employee/change_password') ?>">Change Password</a></li>
                        <li><a href="<?= base_url('auth/logout') ?>">Logout</a></li>
                    </ul>
                </div>
                <div class="logo-element">
                    ES
                </div>
            </li>
            <li class="<?= ($this->router->fetch_class() == "dashboard" && $this->router->fetch_method() == "index") ? "active" : ""; ?>">
                <a href="<?= base_url("dashboard/index") ?>"><i class="fa fa-desktop"></i> <span class="nav-label">Dashboard</span></a>
            </li>
            <li class="<?= ($this->router->fetch_class() == "company") ? "active" : ""; ?>">
                <a href="<?= base_url("company/index") ?>"><i class="fa fa-home"></i> <span class="nav-label">Company</span></a>
            </li>
            <li class="<?= ($this->router->fetch_class() == "branch") ? "active" : ""; ?>">
                <a href="<?= base_url("branch/index") ?>"><i class="fa fa-home"></i> <span class="nav-label">Branch</span></a>
            </li>
            <li class="<?= ($this->router->fetch_class() == "department" || $this->router->fetch_class() == "costcenter" || $this->router->fetch_class() == "deliverycenter") ? "active" : ""; ?>">
                <a href="">
                    <i class="fa fa-building"></i> 
                    <span class="nav-label">Sites</span> 
                    <span class="fa arrow"></span>
                </a>
                <ul class="nav nav-second-level">
                    <li class="<?= ($this->router->fetch_class() == "department") ? "active" : ""; ?>">
                        <a href="<?= base_url("department/index") ?>"><span class="nav-label">Department</span></a>
                    </li>
                    <li class="<?= ($this->router->fetch_class() == "costcenter") ? "active" : ""; ?>">
                        <a href="<?= base_url("costcenter/index") ?>"><span class="nav-label">Cost center</span></a>
                    </li>
                    <li class="<?= ($this->router->fetch_class() == "deliverycenter") ? "active" : ""; ?>">
                        <a href="<?= base_url("deliverycenter/index") ?>"><span class="nav-label">Delivery center</span></a>
                    </li>
                </ul>
            </li>
            <li class="<?= ($this->router->fetch_class() == "employee") ? "active" : ""; ?>">
                <a href="<?= base_url("employee/index") ?>"><i class="fa fa-user"></i> <span class="nav-label">Employee</span></a>
            </li>
            <li class="<?= ($this->router->fetch_class() == "employee_roles" || $this->router->fetch_class() == "role") ? "active" : ""; ?>">
                <a href="">
                    <i class="fa fa-users"></i> 
                    <span class="nav-label">Roles</span> 
                    <span class="fa arrow"></span>
                </a>
                <ul class="nav nav-second-level">
                    <li class="<?= ($this->router->fetch_class() == "role") ? "active" : ""; ?>"><a href="<?= base_url("role/index") ?>">System role</a></li>
                    <li class="<?= ($this->router->fetch_class() == "employee_roles") ? "active" : ""; ?>"><a href="<?= base_url("employee_roles/index") ?>">Employee role</a></li>
                </ul>
            </li>
            <li class="<?= ($this->router->fetch_class() == "code_detail" || $this->router->fetch_class() == "code_header") ? "active" : ""; ?>">
                <a href="">
                    <i class="fa fa-codepen"></i> 
                    <span class="nav-label">Code Descriptions</span> 
                    <span class="fa arrow"></span>
                </a>
                <ul class="nav nav-second-level">
                    <li class="<?= ($this->router->fetch_class() == "code_detail") ? "active" : ""; ?>"><a href="<?= base_url("code_detail/index") ?>">Code details</a></li>
                    <li class="<?= ($this->router->fetch_class() == "code_header") ? "active" : ""; ?>"><a href="<?= base_url("code_header/index") ?>">Code headers</a></li>
                </ul>
            </li>
            <li class="<?= ($this->router->fetch_class() == "uniform") ? "active" : ""; ?>">
                <a href="<?= base_url("uniform/index") ?>"><i class="fa fa-user"></i> <span class="nav-label">Uniform</span></a>
            </li>
            <li class="<?= ($this->router->fetch_class() == "permission") ? "active" : ""; ?>">
                <a href="<?= base_url("permission/index") ?>"><i class="fa fa-sitemap"></i> <span class="nav-label">Permission</span></a>
            </li>
            <li class="<?= ($this->router->fetch_class() == "supplier") ? "active" : ""; ?>">
                <a href="<?= base_url("supplier/index") ?>"><i class="fa fa-sitemap"></i> <span class="nav-label">Supplier</span></a>
            </li>
        </ul>
    </div>
</nav>