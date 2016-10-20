<div class="wrapper wrapper-content animated">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Create department</h5>
                </div>
                <div class="ibox-content">
                    <?php echo form_open(base_url('department/create'), array("class" => "form-horizontal")); ?>
                    <div class="form-group"><label class="col-sm-2 control-label">Name</label>
                        <div class="col-sm-10"><input type="text" class="form-control" name="d_name" id="d_name" value="<?= (isset($d_name) && $d_name != "") ? $d_name : ""; ?>"></div>
                    </div>
                    <div class="hr-line-dashed"></div>
                    <div class="form-group"><label class="col-sm-2 control-label">Code</label>
                        <div class="col-sm-10"><input type="text" class="form-control" name="d_code" id="d_code" value="<?= (isset($d_code) && $d_code != "") ? $d_code : ""; ?>"></div>
                    </div>
                    <div class="hr-line-dashed"></div>
                    <div class="form-group"><label class="col-sm-2 control-label">Company</label>
                        <div class="col-sm-10">
                            <select class="form-control m-b" name="d_company_id" id="d_company_id">
                                <option value="">Please select company</option>
                                <?php foreach ($companies as $value) { ?>
                                    <option value="<?= $value["id"] ?>" <?= (isset($d_company_id) && $d_company_id == $value["id"]) ? "selected='selected'" : ""; ?> ><?= $value["c_name"] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>
                    <div class="form-group"><label class="col-sm-2 control-label">Branch</label>
                        <div class="col-sm-10">
                            <select class="form-control m-b" name="d_branch_id" id="d_branch_id">
                                <option value="">Please select branch</option>
                            </select>
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>
                    <div class="form-group"><label class="col-sm-2 control-label">Status</label>
                        <div class="col-sm-10">
                            <select class="form-control m-b" name="d_status" id="d_status">
                                <option value="1" <?= (isset($d_status) && $d_status == "1") ? "selected='selected'" : ""; ?> >Active</option>
                                <option value="0" <?= (isset($d_status) && $d_status == "0") ? "selected='selected'" : ""; ?> >Inactive</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-4 col-sm-offset-2">
                            <button class="btn btn-white" type="reset" onclick="window.location = '<?= base_url("department/index") ?>'">Cancel</button>
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
        $("#d_company_id").change(function () {
            var company_id = {"company_id": $(this).val()};
            $.ajax({
                type: "POST",
                data: company_id,
                url: "<?= base_url("branch/get_company_branches") ?>",
                success: function (data) {
                    $("#d_branch_id > option").remove();
                    $.each(data, function (i, data) {
                        $('#d_branch_id').append("<option value='" + data.id + "'>" + data.b_name + "</option>");
                    });
                }
            });
        });
    });
</script>