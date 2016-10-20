<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="shortcut icon" href="<?php echo base_url('assets/img/favicon.png') ?>">
        <title><?php echo $page_title; ?> | Engage Solutions</title>
        <link href="<?php echo base_url('assets/css/bootstrap.min.css') ?>" rel="stylesheet">
        <link href="<?php echo base_url('assets/font-awesome/css/font-awesome.css') ?>" rel="stylesheet">
        <link href="<?php echo base_url('assets/css/animate.css') ?>" rel="stylesheet">
        <link href="<?php echo base_url('assets/css/style.css') ?>" rel="stylesheet">
    </head>
    <body class="gray-bg">
        <div class="loginColumns animated fadeInDown">
            <?php if ($this->session->flashdata('error') != "") { ?>
                <div class="row" style="margin-bottom: -20px;margin-top: 20px;">
                    <div class="col-md-12">
                        <div class="alert alert-danger alert-dismissable">
                            <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                            <?= $this->session->flashdata('error') ?>
                        </div>
                    </div>
                </div>
            <?php } ?>
            <?php if (validation_errors() != "") { ?>
                <div class="row">
                    <div class="col-md-12">
                        <div class="alert alert-danger alert-dismissable">
                            <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                            <?php echo validation_errors(); ?>
                        </div>
                    </div>
                </div>
            <?php } ?>
            <div class="row">
                <div class="col-md-6">
                    <h2 class="font-bold">Welcome to Engage Solutions</h2>
                    <p>
                        Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.
                    </p>
                </div>
                <div class="col-md-6">
                    <div class="ibox-content">
                        <?php echo form_open(base_url('auth/login'), array("class" => "m-t")); ?>
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Username/Email" name="email">
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" placeholder="Password" name="password">
                        </div>
                        <button type="submit" class="btn btn-primary block full-width m-b" name="login_btn" value="login" >Login</button>
                        <a href="#">
                            <small>Forgot password?</small>
                        </a>
                        <?php echo form_close(); ?>
                    </div>
                </div>
            </div>
            <hr/>
            <div class="row">
                <div class="col-md-6">
                    Engage Solutions
                </div>
                <div class="col-md-6 text-right">
                    <small>&COPY; <?= date('Y') ?>-<?= date('Y') + 1 ?></small>
                </div>
            </div>
        </div>

        <!-- Mainly scripts -->
        <script type="text/javascript" src="<?php echo base_url('assets/js/jquery-2.1.1.js') ?>"></script>
        <script type="text/javascript" src="<?php echo base_url('assets/js/bootstrap.min.js') ?>"></script>
    </body>
</html>
