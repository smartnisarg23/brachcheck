<div class="wrapper wrapper-content animated">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Your profile</h5>
                </div>
                <div class="ibox-content">
                    <?php echo form_open_multipart(base_url('employee/profile'), array("class" => "form-horizontal")); ?>
                    <div class="form-group"><label class="col-sm-2 control-label">ID</label>
                        <div class="col-sm-10"><input type="text" placeholder="Employee ID" class="form-control" name="e_id" id="e_id" value="<?= (isset($e_id) && $e_id != "") ? $e_id : ""; ?>"></div>
                    </div>
                    <div class="hr-line-dashed"></div>
                    <div class="form-group"><label class="col-sm-2 control-label">Name</label>
                        <div class="col-sm-10">
                            <input type="text" placeholder="First name" class="form-control m-b"  name="e_fname" id="e_fname" value="<?= (isset($e_fname) && $e_fname != "") ? $e_fname : ""; ?>">
<!--                            <input type="text" placeholder="Middle name" class="form-control m-b"  name="e_mname" id="e_mname" value="<?= (isset($e_mname) && $e_mname != "") ? $e_mname : ""; ?>">-->
                            <input type="text" placeholder="Last name" class="form-control m-b"  name="e_lname" id="e_lname" value="<?= (isset($e_lname) && $e_lname != "") ? $e_lname : ""; ?>">
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>
                    <div class="form-group"><label class="col-sm-2 control-label">Email</label>
                        <div class="col-sm-10"><input type="email" placeholder="Email" class="form-control" name="e_email" id="e_email" value="<?= (isset($e_email) && $e_email != "") ? $e_email : ""; ?>"></div>
                    </div>
                    <div class="hr-line-dashed"></div>
                    <div class="form-group"><label class="col-sm-2 control-label">Mobile</label>
                        <div class="col-sm-10"><input type="text" placeholder="Mobile" class="form-control" name="e_mobile" id="e_mobile" value="<?= (isset($e_mobile) && $e_mobile != "") ? $e_mobile : ""; ?>"></div>
                    </div>
                    <div class="hr-line-dashed"></div>
                    <div class="form-group"><label class="col-sm-2 control-label">Address</label>
                        <div class="col-sm-10">
                            <input type="text" placeholder="Street Name" class="form-control m-b"  name="e_street" id="e_street" value="<?= (isset($e_street) && $e_street != "") ? $e_street : ""; ?>">
                            <input type="text" placeholder="Suburb" class="form-control m-b"  name="e_suburb" id="e_suburb" value="<?= (isset($e_suburb) && $e_suburb != "") ? $e_suburb : ""; ?>">
                            <input type="text" placeholder="State" class="form-control m-b"  name="e_state" id="e_state" value="<?= (isset($e_state) && $e_state != "") ? $e_state : ""; ?>">
                            <input type="text" placeholder="City" class="form-control m-b"  name="e_city" id="e_city" value="<?= (isset($e_city) && $e_city != "") ? $e_city : ""; ?>">
                            <input type="text" placeholder="Pincode" class="form-control m-b"  name="e_pincode" id="e_pincode" value="<?= (isset($e_pincode) && $e_pincode != "") ? $e_pincode : ""; ?>">
                        </div>
                    </div>
<!--                    <div class="hr-line-dashed"></div>
                    <div class="form-group"><label class="col-sm-2 control-label">Gender</label>
                        <div class="col-sm-10">
                            <div class="i-checks"><label> <input type="radio" checked="checked" value="M" id="e_gender_male" name="e_gender"> <i></i> Male </label></div>
                            <div class="i-checks"><label> <input type="radio" value="F" id="e_gender_female" name="e_gender"> <i></i> Female </label></div>
                        </div>
                    </div>-->
                    <div class="hr-line-dashed"></div>
                    <div class="form-group"><label class="col-sm-2 control-label">Profile image</label>
                        <div class="col-sm-10">
                            <input type="file" class="form-control m-b"  name="profile_image" id="profile_image">
                            <?php if (isset($e_profile_image) && $e_profile_image != "") { ?>
                                <span>
                                    <img src="<?= base_url('assets/img/employee_profile/'.$this->session->userdata['remote_user_data']['employee']['id'].'/'.$e_profile_image) ?>" height="100" width="100">
                                </span>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>
                    <div class="form-group">
                        <div class="col-sm-4 col-sm-offset-2">
                            <button class="btn btn-white" type="reset" onclick="window.location = '<?= base_url("dashboard/index") ?>'">Cancel</button>
                            <button class="btn btn-primary" type="submit">Save changes</button>
                        </div>
                    </div>
                    <?= form_close(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function () {
        $('.i-checks').iCheck({
            checkboxClass: 'icheckbox_square-green',
            radioClass: 'iradio_square-green',
        });
    });
</script>