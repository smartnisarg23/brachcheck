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
        <link href="<?php echo base_url('assets/css/plugins/toastr/toastr.min.css') ?>" rel="stylesheet">
        <link href="<?php echo base_url('assets/css/plugins/sweetalert/sweetalert.css') ?>" rel="stylesheet">

        <?php if (isset($css) && $css != "") { ?>
            <?php foreach ($css as $value) { ?>
                <link href="<?php echo base_url('assets/' . $value) ?>" rel="stylesheet">
            <?php } ?>
        <?php } ?>
        <link href="<?php echo base_url('assets/css/style.css') ?>" rel="stylesheet">

        <!-- Mainly scripts -->
        <script type="text/javascript" src="<?php echo base_url('assets/js/jquery-2.1.1.js') ?>"></script>
        <script type="text/javascript" src="<?php echo base_url('assets/js/bootstrap.min.js') ?>"></script>
        <script type="text/javascript" src="<?php echo base_url('assets/js/plugins/metisMenu/jquery.metisMenu.js') ?>"></script>
        <script type="text/javascript" src="<?php echo base_url('assets/js/plugins/slimscroll/jquery.slimscroll.min.js') ?>"></script>

        <!-- Custom and plugin javascript -->
        <script type="text/javascript" src="<?php echo base_url('assets/js/inspinia.js') ?>"></script>
        <script type="text/javascript" src="<?php echo base_url('assets/js/plugins/pace/pace.min.js') ?>"></script>
        <script type="text/javascript" src="<?php echo base_url('assets/js/plugins/jquery-ui/jquery-ui.min.js') ?>"></script>
        <script type="text/javascript" src="<?php echo base_url('assets/js/jquery.blockUI.js') ?>"></script>
        <script type="text/javascript" src="<?php echo base_url('assets/js/plugins/sweetalert/sweetalert.min.js') ?>"></script>
        <script type="text/javascript" src="<?php echo base_url('assets/js/common.js') ?>"></script>
        <?php if (isset($this->datatable) && $this->datatable == TRUE) { ?>
        <script type="text/javascript" src="<?php echo base_url('assets/js/datatable.js') ?>"></script>
        <?php } ?>
        <?php if (isset($js) && $js != "") { ?>
            <?php foreach ($js as $value) { ?>
                <script type="text/javascript" src="<?php echo base_url('assets/' . $value) ?>"></script>
            <?php } ?>
        <?php } ?> 
    </head>

    <body>
        <div id="wrapper">
            <?php include 'side_menu.php'; ?>
            <div id="page-wrapper" class="gray-bg">
                <?php include 'top_menu.php'; ?>
                <div class="row wrapper border-bottom white-bg page-heading">
                    <div class="col-lg-10">
                        <h2><?= $page_title ?></h2>
                        <?= $this->breadcrumb->output() ?>
                    </div>
                    <div class="col-lg-2">

                    </div>
                </div>
                <?php if ($this->session->flashdata('success') != "") { ?>
                    <div class="row" style="margin-bottom: -20px;margin-top: 20px;">
                        <div class="col-md-12">
                            <div class="alert alert-success alert-dismissable">
                                <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                                <?= $this->session->flashdata('success') ?>
                            </div>
                        </div>
                    </div>
                <?php } ?>
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
                    <div class="row" style="margin-bottom: -20px;margin-top: 20px;">
                        <div class="col-md-12">
                            <div class="alert alert-danger alert-dismissable">
                                <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                                <?php echo validation_errors(); ?>
                            </div>
                        </div>
                    </div>
                <?php } ?>
                <?php if (isset($custom_error) && $custom_error != "") { ?>
                    <?php foreach ($custom_error as $value) { ?>
                        <div class="row" style="margin-bottom: -20px;margin-top: 20px;">
                            <div class="col-md-12">
                                <div class="alert alert-danger alert-dismissable">
                                    <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                                    <?php echo $value; ?>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                <?php } ?>