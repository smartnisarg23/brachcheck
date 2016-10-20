<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav metismenu" id="side-menu">
            <li class="nav-header">
                <div class="dropdown profile-element">
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                        <span class="clear"> <span class="block m-t-xs"> <strong class="font-bold"><?= $this->session->userdata['user_data']['username'] ?></strong>
                            </span> <span class="text-muted text-xs block"> <?= $this->session->userdata['user_data']['role_name'] ?> <b class="caret"></b></span> </span> </a>
                    <ul class="dropdown-menu animated fadeInRight m-t-xs">
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
            <li class="<?= ($this->router->fetch_class() == "users" && $this->router->fetch_method() == "index") ? "active" : ""; ?>">
                <a href="<?= base_url("users/index") ?>"><i class="fa fa-users"></i> <span class="nav-label">Users</span></a>
            </li>
        </ul>

    </div>
</nav>