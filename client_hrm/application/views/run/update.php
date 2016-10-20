<div class="wrapper wrapper-content animated">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Update run</h5>
                </div>
                <div class="ibox-content">
                    <?php echo form_open(base_url('run/update/' . $record_id), array("class" => "form-horizontal")); ?>
                    <div class="form-group"><label class="col-sm-2 control-label">Run id</label>
                        <div class="col-sm-10"><input type="text" class="form-control" name="r_id" id="r_id" value="<?= (isset($r_id) && $r_id != "") ? $r_id : ""; ?>"></div>
                    </div>
                    <div class="hr-line-dashed"></div>
                    <div class="form-group"><label class="col-sm-2 control-label">Run description</label>
                        <div class="col-sm-10"><input type="text" class="form-control" name="r_desc" id="r_desc" value="<?= (isset($r_desc) && $r_desc != "") ? $r_desc : ""; ?>"></div>
                    </div>
                    <div class="hr-line-dashed"></div>
                    <div class="form-group"><label class="col-sm-2 control-label">Run short description</label>
                        <div class="col-sm-10"><input type="text" class="form-control" name="r_s_desc" id="r_s_desc" value="<?= (isset($r_s_desc) && $r_s_desc != "") ? $r_desc : ""; ?>"></div>
                    </div>
                    <div class="hr-line-dashed"></div>
                    <div class="form-group"><label class="col-sm-2 control-label">Run start time</label>
                        <div class="col-sm-10">
                            <select class="form-control m-b" name="r_start_time" id="r_start_time">
                                <?php
                                for ($hour = 0; $hour <= 23; $hour++) {
                                    for ($mins = 0; $mins < 60; $mins = $mins + 15) {
                                        ?>
                                        <option value="<?= $hour . ":" . $mins ?>" <?= (isset($r_start_time) && $r_start_time == $hour . ":" . $mins ) ? "selected='selected'" : ""; ?> ><?= $hour . ":" . $mins ?></option>
                                        <?php
                                    }
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>
                    <div class="form-group"><label class="col-sm-2 control-label">Run duration</label>
                        <div class="col-sm-10">
                            <select class="form-control m-b" name="r_duration" id="r_duration">
                                <?php
                                for ($hour = 0; $hour <= 23; $hour++) {
                                    for ($mins = 0; $mins < 100; $mins = $mins + 25) {
                                        ?>
                                        <option value="<?= $hour . "." . $mins ?>" <?= (isset($r_start_time) && $r_start_time == $hour . "." . $mins ) ? "selected='selected'" : ""; ?> ><?= $hour . "." . $mins ?></option>
                                        <?php
                                    }
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>
                    <div class="form-group"><label class="col-sm-2 control-label">Logbook required?</label>
                        <div class="col-sm-10">
                            <input type="checkbox" class="i-checks set-permission" name="r_log_book" id="r_log_book" value="Y" <?=(isset($r_log_book) && $r_log_book == "Y")? "checked=checked":""; ?>>
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>
                    <div class="form-group"><label class="col-sm-2 control-label">Training required</label>
                        <div class="col-sm-10">
                            <input type="checkbox" class="i-checks set-permission" name="r_training" id="r_training" value="Y" <?=(isset($r_run_days) && $r_run_days == "Y")? "checked=checked":""; ?>>
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>
                    <div class="form-group"><label class="col-sm-2 control-label">Min/Max drivers trained for run</label>
                        <div class="col-sm-2">
                            <select class="form-control m-b" name="r_min_driver" id="r_min_driver">
                                <?php
                                for ($min = 0; $min <= 500; $min++) {
                                    ?>
                                    <option value="<?= $min ?>" <?= (isset($r_min_driver) && $r_min_driver == $min ) ? "selected='selected'" : ""; ?> ><?= $min ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-sm-1" style="text-align: center;margin-top: 5px;font-size: 15px;">to</div>
                        <div class="col-sm-2">
                            <select class="form-control m-b" name="r_max_driver" id="r_max_driver">
                                <?php
                                for ($max = 0; $max <= 500; $max++) {
                                    ?>
                                    <option value="<?= $max ?>" <?= (isset($r_max_driver) && $r_max_driver == $max ) ? "selected='selected'" : ""; ?> ><?= $max ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>
                    <div class="form-group"><label class="col-sm-2 control-label">Run days</label>
                        <div class="col-sm-10">
                            <input type="checkbox" class="i-checks set-permission" name="r_run_days[]" value="Monday" <?=(isset($r_run_days) && in_array("Monday", $r_run_days))? "checked=checked":""; ?>> Monday
                            <input type="checkbox" class="i-checks set-permission" name="r_run_days[]" value="Tuesday" <?=(isset($r_run_days) && in_array("Tuesday", $r_run_days))? "checked=checked":""; ?>> Tuesday
                            <input type="checkbox" class="i-checks set-permission" name="r_run_days[]" value="Wednesday" <?=(isset($r_run_days) && in_array("Wednesday", $r_run_days))? "checked=checked":""; ?>> Wednesday
                            <input type="checkbox" class="i-checks set-permission" name="r_run_days[]" value="Thursday" <?=(isset($r_run_days) && in_array("Thursday", $r_run_days))? "checked=checked":""; ?>> Thursday
                            <input type="checkbox" class="i-checks set-permission" name="r_run_days[]" value="Friday" <?=(isset($r_run_days) && in_array("Friday", $r_run_days))? "checked=checked":""; ?>> Friday
                            <input type="checkbox" class="i-checks set-permission" name="r_run_days[]" value="Saturday" <?=(isset($r_run_days) && in_array("Saturday", $r_run_days))? "checked=checked":""; ?>> Saturday
                            <input type="checkbox" class="i-checks set-permission" name="r_run_days[]" value="Sunday" <?=(isset($r_run_days) && in_array("Sunday", $r_run_days))? "checked=checked":""; ?>> Sunday
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>
                    <div class="form-group"><label class="col-sm-2 control-label">Default truck</label>
                        <div class="col-sm-10">
                            <select class="form-control m-b" name="r_default_truck_id" id="r_default_truck_id">
                                <option value="">Please select truck</option>
                                <?php foreach ($trucks as $value) { ?>
                                    <option value="<?= $value["id"] ?>" <?= (isset($r_default_truck_id) && $r_default_truck_id == $value["id"]) ? "selected='selected'" : ""; ?> ><?= $value["t_rego_num"] . " - " . $value["t_make"] . " " . $value["t_model"] . " " . $value["t_man_yr"] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>
                    <div class="form-group"><label class="col-sm-2 control-label">Run notes</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="r_notes" id="r_notes" value="<?= (isset($r_notes) && $r_notes != "") ? $r_notes : ""; ?>">
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>
                    <div class="form-group"><label class="col-sm-2 control-label">Status</label>
                        <div class="col-sm-10">
                            <select class="form-control m-b" name="r_status" id="r_status">
                                <option value="1" <?= (isset($r_status) && $r_status == "1") ? "selected='selected'" : ""; ?> >Active</option>
                                <option value="0" <?= (isset($r_status) && $r_status == "0") ? "selected='selected'" : ""; ?> >Inactive</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-4 col-sm-offset-2">
                            <button class="btn btn-white" type="reset" onclick="window.location = '<?= base_url("run/index") ?>'">Cancel</button>
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