<div class="wrapper wrapper-content animated">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Update licence</h5>
                </div>
                <div class="ibox-content">
                    <?php echo form_open(base_url('licence/update/' . $record_id), array("class" => "form-horizontal")); ?>
                    <div class="form-group"><label class="col-sm-2 control-label">Class name</label>
                        <div class="col-sm-10"><input type="text" class="form-control" name="l_cls_name" id="l_cls_name" value="<?= (isset($l_cls_name) && $l_cls_name != "") ? $l_cls_name : ""; ?>"></div>
                    </div>
                    <div class="hr-line-dashed"></div>
                    <div class="form-group"><label class="col-sm-2 control-label">Status</label>
                        <div class="col-sm-10">
                            <select class="form-control m-b" name="l_status" id="l_status">
                                <option value="1" <?= (isset($l_status) && $l_status == "1") ? "selected='selected'" : ""; ?> >Active</option>
                                <option value="0" <?= (isset($l_status) && $l_status == "0") ? "selected='selected'" : ""; ?> >Inactive</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-4 col-sm-offset-2">
                            <button class="btn btn-white" type="reset" onclick="window.location = '<?= base_url("licence/index") ?>'">Cancel</button>
                            <button class="btn btn-primary" type="submit">Save changes</button>
                        </div>
                    </div>
                    <?= form_close(); ?>
                </div>
            </div>
        </div>
    </div>
</div>