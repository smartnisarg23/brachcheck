<div class="wrapper wrapper-content animated">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Uniform</h5>
                </div>
                <div class="ibox-content" style="float: left;width: 100%">
                    <div class="form-group col-sm-12">
                        <label class="col-sm-2 control-label">Id</label>
                        <div class="col-sm-10"><?= $record_id ?></div>
                    </div>
                    <div class="form-group col-sm-12">
                        <label class="col-sm-2 control-label">Name</label>
                        <div class="col-sm-10"><?= $u_name ?></div>
                    </div>
                    <div class="form-group col-sm-12">
                        <label class="col-sm-2 control-label">Comments</label>
                        <div class="col-sm-10"><?= $u_comments ?></div>
                    </div>
                    <div class="form-group col-sm-12">
                        <label class="col-sm-2 control-label">Gender</label>
                        <div class="col-sm-10">
                            <?= (isset($u_gender) && $u_gender == "M") ? "Male" : "" ?>
                            <?= (isset($u_gender) && $u_gender == "F") ? "Female" : "" ?>
                            <?= (isset($u_gender) && $u_gender == "U") ? "Unisex" : "" ?>
                        </div>
                    </div>
                    <div class="form-group col-sm-12">
                        <label class="col-sm-2 control-label">Created date</label>
                        <div class="col-sm-10"><?= $u_create_date ?></div>
                    </div>
                    <div class="form-group col-sm-12">
                        <label class="col-sm-2 control-label">Created user</label>
                        <div class="col-sm-10"><?= $e_fname . " " . $e_lname; ?></div>
                    </div>
                    <div class="form-group col-sm-12">
                        <label class="col-sm-2 control-label">Updated date</label>
                        <div class="col-sm-10"><?= $u_update_date ?></div>
                    </div>
                    <div class="form-group col-sm-12">
                        <label class="col-sm-2 control-label">Updated user</label>
                        <div class="col-sm-10"><?= $update_e_fname . " " . $update_e_lname; ?></div>
                    </div>
                    <?php
                    foreach ($roles as $key => $value) {
                        if (isset($role_attach) && in_array($value['id'], $role_attach)) {
                            $r_temp[] = $value['r_name'];
                        }
                    }
                    ?>
                    <div class="form-group col-sm-12">
                        <label class="col-sm-2 control-label">Attach role(<?= count($r_temp) ?>)</label>
                        <div class="col-sm-10">
                            <?= implode(", ", $r_temp); ?>
                        </div>
                    </div>
                    <div class="form-group col-sm-12">
                        <label class="col-sm-2 control-label">Attach employees(<?= count($employee_attach) ?>)</label>
                        <div class="col-sm-10">
                            <?= implode(", ", $employee_attach); ?>
                        </div>
                    </div>
                    <div class="form-group col-sm-12">
                        <label class="col-sm-2 control-label">Status</label>
                        <div class="col-sm-10">
                            <?= (isset($u_status) && $u_status == "1") ? "Active" : ""; ?>
                            <?= (isset($u_status) && $u_status == "0") ? "Inactive" : ""; ?>
                        </div>
                    </div>
                    <div class="form-group col-sm-12">
                        <div class="col-sm-4 col-sm-offset-2">
                            <button class="btn btn-primary" type="reset" onclick="window.location = '<?= base_url("uniform/update/" . $record_id) ?>'">Maintain</button>
                        </div>
                    </div>
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