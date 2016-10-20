<div class="wrapper wrapper-content animated">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Create uniform</h5>
                </div>
                <div class="ibox-content">
                    <?php echo form_open(base_url('uniform/create'), array("class" => "form-horizontal")); ?>
                    <div class="form-group"><label class="col-sm-2 control-label">Name</label>
                        <div class="col-sm-10"><input type="text" class="form-control" name="u_name" id="u_name" value="<?= (isset($u_name) && $u_name != "") ? $u_name : ""; ?>"></div>
                    </div>
                    <div class="hr-line-dashed"></div>
                    <div class="form-group"><label class="col-sm-2 control-label">Comments</label>
                        <div class="col-sm-10"><input type="text" class="form-control" name="u_comments" id="u_comments" value="<?= (isset($u_comments) && $u_comments != "") ? $u_comments : ""; ?>"></div>
                    </div>
                    <div class="hr-line-dashed"></div>
                    <div class="form-group"><label class="col-sm-2 control-label">Gender</label>
                        <div class="col-sm-10">
                            <div class="i-checks"><label> <input type="radio" checked="checked" value="M" id="u_gender_male" name="u_gender"> <i></i> Male </label></div>
                            <div class="i-checks"><label> <input type="radio" value="F" id="u_gender_female" name="u_gender"> <i></i> Female </label></div>
                            <div class="i-checks"><label> <input type="radio" value="U" id="u_gender_unisex" name="u_gender"> <i></i> Unisex </label></div>
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>
                    <div class="form-group"><label class="col-sm-2 control-label">Attach role</label>
                        <div class="col-sm-10">
                            <select class="form-control m-b" name="role_attach[]" id="role_attach" multiple="multiple">
                                <option value="">Select role</option>
                                <?php foreach ($roles as $key => $value) { ?>
                                <option value="<?=$value['id']?>" <?= (isset($role_attach) && $role_attach == $value['id']) ? "selected='selected'" : ""; ?> ><?=$value['r_name']?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>
                    <div class="form-group"><label class="col-sm-2 control-label">Status</label>
                        <div class="col-sm-10">
                            <select class="form-control m-b" name="u_status" id="u_status">
                                <option value="1" <?= (isset($u_status) && $u_status == "1") ? "selected='selected'" : ""; ?> >Active</option>
                                <option value="0" <?= (isset($u_status) && $u_status == "0") ? "selected='selected'" : ""; ?> >Inactive</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-4 col-sm-offset-2">
                            <button class="btn btn-white" type="reset" onclick="window.location = '<?= base_url("uniform/index") ?>'">Cancel</button>
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