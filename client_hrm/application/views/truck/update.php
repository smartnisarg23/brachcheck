<div class="wrapper wrapper-content animated">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Update role</h5>
                </div>
                <div class="ibox-content">
                    <?php echo form_open(base_url('trucks/update/' . $record_id), array("class" => "form-horizontal")); ?>
                    <div class="form-group"><label class="col-sm-2 control-label">Truck rego number</label>
                        <div class="col-sm-10"><input type="text" class="form-control" name="t_rego_num" id="t_rego_num" value="<?= (isset($t_rego_num) && $t_rego_num != "") ? $t_rego_num : ""; ?>"></div>
                    </div>
                    <div class="hr-line-dashed"></div>
                    <div class="form-group"><label class="col-sm-2 control-label">Truck nick name</label>
                        <div class="col-sm-10"><input type="text" class="form-control" name="t_nick_name" id="t_nick_name" value="<?= (isset($t_nick_name) && $t_nick_name != "") ? $t_nick_name : ""; ?>"></div>
                    </div>
                    <div class="hr-line-dashed"></div>
                    <div class="form-group"><label class="col-sm-2 control-label">Truck description</label>
                        <div class="col-sm-10"><input type="text" class="form-control" name="t_description" id="t_description" value="<?= (isset($t_description) && $t_description != "") ? $t_description : ""; ?>"></div>
                    </div>
                    <div class="hr-line-dashed"></div>
                    <div class="form-group"><label class="col-sm-2 control-label">Truck make</label>
                        <div class="col-sm-10">
                            <select class="form-control m-b" name="t_make" id="t_make">
                                <option value="">Please truck make</option>
                                <?php foreach ($truck_makes as $value) { ?>
                                    <option value="<?= $value["id"] ?>" <?= (isset($t_make) && $t_make == $value["id"]) ? "selected='selected'" : ""; ?> ><?= $value["tm_name"] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>
                    <div class="form-group"><label class="col-sm-2 control-label">Truck model</label>
                        <div class="col-sm-10">
                            <select class="form-control m-b" name="t_model" id="t_model">
                                <option value="">Please truck model</option>
                                <?php foreach ($make_models as $value) { ?>
                                    <option value="<?= $value["id"] ?>" <?= (isset($t_model) && $t_model == $value["id"]) ? "selected='selected'" : ""; ?> ><?= $value["tm_name"] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>
                    <div class="form-group"><label class="col-sm-2 control-label">Truck licence class</label>
                        <div class="col-sm-10">
                            <select class="form-control m-b" name="t_lic_cls" id="t_lic_cls">
                                <option value="">Please licence class</option>
                                <?php foreach ($licences as $value) { ?>
                                    <option value="<?= $value["id"] ?>" <?= (isset($t_lic_cls) && $t_lic_cls == $value["id"]) ? "selected='selected'" : ""; ?> ><?= $value["l_cls_name"] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>
                    <div class="form-group"><label class="col-sm-2 control-label">Manufacture year</label>
                        <div class="col-sm-10">
                            <select class="form-control m-b" name="t_man_yr" id="t_man_yr">
                                <option value="">Please manufacture year</option>
                                <?php
                                $starting_year = date('Y', strtotime('-20 year'));
                                $current_year = date('Y');
                                for ($starting_year; $starting_year <= $current_year; $starting_year++) {
                                    echo '<option value="' . $starting_year . '"';
                                    if ($starting_year == $current_year) {
                                        echo ' selected="selected"';
                                    }
                                    echo ' >' . $starting_year . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>
                    <div class="form-group"><label class="col-sm-2 control-label">Logbook required?</label>
                        <div class="col-sm-10">
                            <input type="checkbox" class="i-checks set-permission" name="t_logbook" id="t_logbook" value="Y" <?= ($t_logbook == "Y")? "checked=checked":"" ?>>
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>
                    <div class="form-group"  id="data_1"><label class="col-sm-2 control-label">Last COF/WOF date</label>
                        <div class="col-sm-10">
                            <div class="input-group date">
                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                <input type="text" class="form-control" id="t_wof_date" name="t_wof_date" value="<?= (isset($t_wof_date) && $t_wof_date != "") ? date('Y-m-d', strtotime($t_wof_date)) : ""; ?>" >
                            </div>
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>
                    <div class="form-group"><label class="col-sm-2 control-label">Truck notes</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="t_notes" id="t_notes" value="<?= (isset($t_notes) && $t_notes != "") ? $t_notes : ""; ?>">
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>
                    <div class="form-group"><label class="col-sm-2 control-label">Status</label>
                        <div class="col-sm-10">
                            <select class="form-control m-b" name="t_status" id="t_status">
                                <option value="1" <?= (isset($t_status) && $t_status == "1") ? "selected='selected'" : ""; ?> >Active</option>
                                <option value="0" <?= (isset($t_status) && $t_status == "0") ? "selected='selected'" : ""; ?> >Inactive</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-4 col-sm-offset-2">
                            <button class="btn btn-white" type="reset" onclick="window.location = '<?= base_url("trucks/index") ?>'">Cancel</button>
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
        $('#t_wof_date').datepicker({
            todayBtn: "linked",
            keyboardNavigation: false,
            forceParse: false,
            calendarWeeks: true,
            autoclose: true
        });
        $("#t_make").change(function () {
            var make_id = {"make_id": $(this).val()};
            $.ajax({
                type: "POST",
                data: make_id,
                url: "<?= base_url("truck_model/get_make_models") ?>",
                success: function (data) {
                    $("#t_model > option").remove();
                    $('#t_model').append("<option value=''>Please select model</option>");
                    $.each(data, function (i, data) {
                        $('#t_model').append("<option value='" + data.id + "'>" + data.tm_name + "</option>");
                    });
                }
            });
        });
    });
</script>