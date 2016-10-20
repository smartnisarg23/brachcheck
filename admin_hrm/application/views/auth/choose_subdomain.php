<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?php echo $page_title; ?> | Engage Solutions</title>
        <link href="<?php echo base_url('assets/css/bootstrap.min.css') ?>" rel="stylesheet">
        <link href="<?php echo base_url('assets/font-awesome/css/font-awesome.css') ?>" rel="stylesheet">
        <link href="<?php echo base_url('assets/css/animate.css') ?>" rel="stylesheet">
        <link href="<?php echo base_url('assets/css/style.css') ?>" rel="stylesheet">
    </head>
    <body class="gray-bg">
        <div class="middle-box text-center animated fadeInDown">
            <h3 class="font-bold">Choose portal</h3>
            <div class="error-desc">
                <p>
                    <a href="<?= base_url("auth/choose_subdomain/supplier") ?>"><button class="btn btn-primary btn-lg" type="button">Go to Supplier portal</button></a> 
                </p>
                <p>
                    <a href="<?= base_url("auth/choose_subdomain/client") ?>"><button class="btn btn-info btn-lg" type="button">Go to Client portal</button></a>
                </p>
                <p>
                    <a href="<?= base_url("auth/logout") ?>"><button class="btn btn-danger btn-lg" type="button">Logout</button></a>
                </p>
            </div>
        </div>
        <!-- Mainly scripts -->
        <script type="text/javascript" src="<?php echo base_url('assets/js/jquery-2.1.1.js') ?>"></script>
        <script type="text/javascript" src="<?php echo base_url('assets/js/bootstrap.min.js') ?>"></script>
    </body>
</html>