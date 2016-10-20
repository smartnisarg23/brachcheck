<div class="wrapper wrapper-content animated">
    <div class="row">
        <?php foreach ($suppliers as $key => $value) { ?>
            <div class="col-md-4">
                <div class="contact-box">
                    <div class="col-sm-4">
                        <div class="text-center">
                            <?php
                            $profile_pic = base_url('assets/img/default_profile_pic.png');
                            if (@getimagesize($value['supplier_subdomain'] . 'assets/img/supplier_profile/' . $value['supplier_id'] . '/' . $value['supplier_profile_image']) != "") {
                                $profile_pic = $value['supplier_subdomain'] . 'assets/img/supplier_profile/' . $value['supplier_id'] . '/' . $value['supplier_profile_image'];
                            }
                            ?>
                            <img alt="Profile Image" class="img-circle m-t-xs img-responsive" src="<?= $profile_pic ?>">
                        </div>
                    </div>
                    <div class="col-sm-8">
                        <h3><strong><?= $value['supplier_fname'] . " " . $value['supplier_lname'] ?></strong></h3>
                        <address>
                            <?= $value['supplier_house_number'] .', '. $value['supplier_address_street'] . ',' ?><br>
                            <?= $value['supplier_address_suburb'] . ',' ?><br>
                            <?= $value['supplier_address_city'] . ',' ?><br>
                            <?= $value['supplier_address_state'] . ',' ?><br>
                            <?= $value['supplier_address_postalcode'] . ',' ?><br>
                            <abbr title="Phone">P:</abbr> <?= $value['supplier_mobile_number'] ?>
                        </address>
                    </div>
                    <div class="clearfix"></div>
                    <div class="contact-box-footer">
                        <div class="m-t-xs btn-group share_btn_<?= $value['supplier_id'] ?>">
                            <?php if (in_array($value['supplier_id'], $shared_suppliers)) { ?>
                                <a class="btn btn-warning"> Details Shared </a>
                            <?php } else { ?>
                                <a class="btn btn-primary" onclick="share_details('<?= $value['supplier_id'] ?>')"> Share Your Details </a>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</div>
<script type="text/javascript">
    function share_details(sup_id) {
        $.ajax({
            type: "POST",
            data: {supplier_id: sup_id},
            url: "<?= base_url("supplier/share_details") ?>",
            success: function (data) {
                swal("Done!", "Your details has been shared with supplier!", "success");
                $('.share_btn_' + sup_id).html('<a class="btn btn-warning"> Details Shared </a>');
            }
        });
    }
</script>