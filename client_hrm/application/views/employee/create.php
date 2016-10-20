<div class="wrapper wrapper-content animated">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Create Employee</h5>
                </div>
                <div class="ibox-content">
                    <?php echo form_open(base_url('employee/create'), array("class" => "form-horizontal")); ?>
                    <div class="form-group"><label class="col-sm-2 control-label">ID</label>
                        <div class="col-sm-10"><input type="text" placeholder="Employee ID" class="form-control" name="e_id" id="e_id" value="<?= (isset($e_id) && $e_id != "") ? $e_id : ""; ?>"></div>
                    </div>
                    <div class="hr-line-dashed"></div>
                    <div class="form-group"><label class="col-sm-2 control-label">Name</label>
                        <div class="col-sm-10">
                            <input type="text" placeholder="First name" class="form-control m-b"  name="e_fname" id="e_fname" value="<?= (isset($e_fname) && $e_fname != "") ? $e_fname : ""; ?>">
                            <input type="text" placeholder="Middle name" class="form-control m-b"  name="e_mname" id="e_mname" value="<?= (isset($e_mname) && $e_mname != "") ? $e_mname : ""; ?>">
                            <input type="text" placeholder="Last name" class="form-control m-b"  name="e_lname" id="e_lname" value="<?= (isset($e_lname) && $e_lname != "") ? $e_lname : ""; ?>">
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>
                    <div class="form-group"><label class="col-sm-2 control-label">Address</label>
                        <div class="col-sm-10">
                            <input type="text" placeholder="House number" class="form-control m-b"  name="client_house_number" id="client_house_number" value="<?= (isset($client_house_number) && $client_house_number != "") ? $client_house_number : ""; ?>">
                            <input type="text" placeholder="Street name" class="form-control m-b"  name="client_address_street" id="client_address_street" value="<?= (isset($client_address_street) && $client_address_street != "") ? $client_address_street : ""; ?>">
                            <input type="text" placeholder="Suburb" class="form-control m-b"  name="client_address_suburb" id="client_address_suburb" value="<?= (isset($client_address_suburb) && $client_address_suburb != "") ? $client_address_suburb : ""; ?>">
                            <input type="text" placeholder="Postal code" class="form-control m-b"  name="client_address_postalcode" id="client_address_postalcode" value="<?= (isset($client_address_postalcode) && $client_address_postalcode != "") ? $client_address_postalcode : ""; ?>">
                            <input type="text" placeholder="City" class="form-control m-b"  name="client_address_city" id="client_address_city" value="<?= (isset($client_address_city) && $client_address_city != "") ? $client_address_city : ""; ?>">
                            <input type="text" placeholder="State" class="form-control m-b"  name="client_address_state" id="client_address_state" value="<?= (isset($client_address_state) && $client_address_state != "") ? $client_address_state : ""; ?>">
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>
                    <div class="form-group"><label class="col-sm-2 control-label">Username</label>
                        <div class="col-sm-10"><input type="text" placeholder="Username" class="form-control" name="e_username" id="e_username" value="<?= (isset($e_username) && $e_username != "") ? $e_username : ""; ?>"></div>
                    </div>
                    <div class="hr-line-dashed"></div>
                    <div class="form-group"><label class="col-sm-2 control-label">Email</label>
                        <div class="col-sm-10"><input type="text" placeholder="Email" class="form-control" name="e_email" id="e_email" value="<?= (isset($e_email) && $e_email != "") ? $e_email : ""; ?>"></div>
                    </div>
                    <div class="hr-line-dashed"></div>
                    <div class="form-group"><label class="col-sm-2 control-label">Gender</label>
                        <div class="col-sm-10">
                            <div class="i-checks"><label> <input type="radio" checked="checked" value="M" id="e_gender_male" name="e_gender"> <i></i> Male </label></div>
                            <div class="i-checks"><label> <input type="radio" value="F" id="e_gender_female" name="e_gender"> <i></i> Female </label></div>
                            <div class="i-checks"><label> <input type="radio" value="U" id="e_gender_unspecified" name="e_gender"> <i></i> Unspecified </label></div>
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>
                    <div class="form-group"  id="data_1"><label class="col-sm-2 control-label">Start date</label>
                        <div class="col-sm-10">
                            <div class="input-group date">
                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                <input type="text" class="form-control" id="e_joining_date" name="e_joining_date" value="<?= (isset($e_joining_date) && $e_joining_date != "") ? $e_joining_date : ""; ?>" >
                            </div>
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>
                    <div class="form-group"><label class="col-sm-2 control-label">Can login ?</label>
                        <div class="col-sm-10">
                            <label> <input class="can_do_login" type="checkbox" value="1" name="e_can_login" id="e_can_login" <?= (isset($e_can_login) && $e_can_login == "1") ? "checked='checked'" : ""; ?>> <i></i> Yes </label>
                            <!--<input type="text" placeholder="password" class="form-control m-b"  name="e_password" id="e_password" style="display: none;">-->
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>
                    <div class="form-group"><label class="col-sm-2 control-label">Employee role</label>
                        <div class="col-sm-10">
                            <select class="form-control m-b" name="e_role_type_id" id="e_role_type_id">
                                <option value="">Please select role</option>
                                <?php foreach ($role_types as $value) { ?>
                                    <option value="<?= $value["id"] ?>" <?= (isset($e_role_type_id) && $e_role_type_id == $value["id"]) ? "selected='selected'" : ""; ?> ><?= $value["r_name"] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>
                    <div class="form-group"><label class="col-sm-2 control-label">System role</label>
                        <div class="col-sm-10">
                            <select class="form-control m-b" name="e_role_id" id="e_role_id">
                                <option value="">Please select role</option>
                                <?php foreach ($roles as $value) { ?>
                                    <option value="<?= $value["id"] ?>" <?= (isset($e_role_id) && $e_role_id == $value["id"]) ? "selected='selected'" : ""; ?> ><?= $value["r_name"] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="hr-line-dashed company-block"></div>
                    <div class="form-group company-block"><label class="col-sm-2 control-label">Company</label>
                        <div class="col-sm-10">
                            <select class="form-control m-b" name="e_company_id" id="e_company_id">
                                <option value="">Please select company</option>
                                <?php foreach ($companies as $value) { ?>
                                    <option value="<?= $value["id"] ?>" <?= (isset($e_company_id) && $e_company_id == $value["id"]) ? "selected='selected'" : ""; ?> ><?= $value["c_name"] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="hr-line-dashed branch-block"></div>
                    <div class="form-group branch-block"><label class="col-sm-2 control-label">Branch</label>
                        <div class="col-sm-10">
                            <select class="form-control m-b" name="e_branch_id" id="e_branch_id">
                                <option value="">Please select branch</option>
                            </select>
                        </div>
                    </div>
                    <div class="hr-line-dashed department-block"></div>
                    <div class="form-group department-block"><label class="col-sm-2 control-label">Department</label>
                        <div class="col-sm-10">
                            <select class="form-control m-b" name="e_department_id" id="e_department_id">
                                <option value="">Please select department</option>
                            </select>
                        </div>
                    </div>
                    <div class="hr-line-dashed cost-center-block"></div>
                    <div class="form-group cost-center-block"><label class="col-sm-2 control-label">Cost center</label>
                        <div class="col-sm-10">
                            <select class="form-control m-b" name="e_costcenter_id" id="e_costcenter_id">
                                <option value="">Please select cost center</option>
                            </select>
                        </div>
                    </div>
                    <div class="hr-line-dashed delivery-center-block"></div>
                    <div class="form-group delivery-center-block"><label class="col-sm-2 control-label">Delivery center</label>
                        <div class="col-sm-10">
                            <select class="form-control m-b" name="e_deliverycenter_id" id="e_deliverycenter_id">
                                <option value="">Please select delivery center</option>
                            </select>
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>
                    <div class="form-group"><label class="col-sm-2 control-label">Extra Notes</label>
                        <div class="col-sm-10">
                            <textarea  class="form-control m-b" name="e_notes" id="e_notes"><?= (isset($e_notes) && $e_notes != "") ? $e_notes : ""; ?></textarea>
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>
                    <div class="form-group"><label class="col-sm-2 control-label">Status</label>
                        <div class="col-sm-10">
                            <select class="form-control m-b" name="e_status" id="e_status">
                                <option value="1" <?= (isset($e_status) && $e_status == "1") ? "selected='selected'" : ""; ?> >Active</option>
                                <option value="0" <?= (isset($e_status) && $e_status == "0") ? "selected='selected'" : ""; ?> >Inactive</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-4 col-sm-offset-2">
                            <button class="btn btn-white" type="reset" onclick="window.location = '<?= base_url("employee/index") ?>'">Cancel</button>
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
        $('.company-block').hide();
        $('.branch-block').hide();
        $('.department-block').hide();
        $('.cost-center-block').hide();
        $('.delivery-center-block').hide();
        $('.i-checks').iCheck({
            checkboxClass: 'icheckbox_square-green',
            radioClass: 'iradio_square-green',
        });
        $('.can_do_login').iCheck({
            checkboxClass: 'icheckbox_square-green',
        });
        $('#data_1 .input-group.date').datepicker({
            todayBtn: "linked",
            keyboardNavigation: false,
            forceParse: false,
            calendarWeeks: true,
            autoclose: true,
            endDate: '+3m'
        });
    });

    $("#e_role_id").change(function () {
        var role_id = $(this).val();
        if (role_id == 1) {
            $('.company-block').show();
            $('.branch-block').hide();
            $('.department-block').hide();
            $('.cost-center-block').hide();
            $('.delivery-center-block').hide();
        } else if (role_id == 2) {
            $('.company-block').show();
            $('.branch-block').show();
            $('.department-block').hide();
            $('.cost-center-block').hide();
            $('.delivery-center-block').hide();
        } else if (role_id == 3) {
            $('.company-block').show();
            $('.branch-block').show();
            $('.department-block').show();
            $('.cost-center-block').hide();
            $('.delivery-center-block').hide();
        } else if (role_id == 4) {
            $('.company-block').show();
            $('.branch-block').show();
            $('.department-block').hide();
            $('.cost-center-block').show();
            $('.delivery-center-block').hide();
        } else if (role_id == 5) {
            $('.company-block').show();
            $('.branch-block').show();
            $('.department-block').hide();
            $('.cost-center-block').hide();
            $('.delivery-center-block').show();
        }
    });
    $("#e_company_id").change(function () {
        var company_id = {"company_id": $(this).val()};
        $.ajax({
            type: "POST",
            data: company_id,
            url: "<?= base_url("branch/get_company_branches") ?>",
            success: function (data) {
                $("#e_branch_id > option").remove();
                $('#e_branch_id').append("<option value=''>Please select branch</option>");
                $.each(data, function (i, data) {
                    $('#e_branch_id').append("<option value='" + data.id + "'>" + data.b_name + "</option>");
                });
            }
        });
    });
    $("#e_branch_id").change(function () {
        $.ajax({
            type: "POST",
            data: {"company_id": $("#e_company_id").val(), "branch_id": $(this).val()},
            url: "<?= base_url("department/get_branch_department") ?>",
            success: function (data) {
                $("#e_department_id > option").remove();
                $('#e_department_id').append("<option value=''>Please select department</option>");
                $.each(data, function (i, data) {
                    $('#e_department_id').append("<option value='" + data.id + "'>" + data.d_name + "</option>");
                });
            }
        });
        $.ajax({
            type: "POST",
            data: {"company_id": $("#e_company_id").val(), "branch_id": $(this).val()},
            url: "<?= base_url("costcenter/get_branch_costcenter") ?>",
            success: function (data) {
                $("#e_costcenter_id > option").remove();
                $('#e_costcenter_id').append("<option value=''>Please select cost center</option>");
                $.each(data, function (i, data) {
                    $('#e_costcenter_id').append("<option value='" + data.id + "'>" + data.c_name + "</option>");
                });
            }
        });
        $.ajax({
            type: "POST",
            data: {"company_id": $("#e_company_id").val(), "branch_id": $(this).val()},
            url: "<?= base_url("deliverycenter/get_branch_deliverycenter") ?>",
            success: function (data) {
                $("#e_deliverycenter_id > option").remove();
                $('#e_deliverycenter_id').append("<option value=''>Please select delivery center</option>");
                $.each(data, function (i, data) {
                    $('#e_deliverycenter_id').append("<option value='" + data.id + "'>" + data.d_name + "</option>");
                });
            }
        });
    });

</script>