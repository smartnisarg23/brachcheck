<div class="wrapper wrapper-content animated">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Update code header</h5>
                </div>
                <div class="ibox-content">
                    <?php echo form_open(base_url('code_header/update/' . $record_id), array("class" => "form-horizontal")); ?>
                    <div class="form-group"><label class="col-sm-2 control-label">ID</label>
                        <div class="col-sm-10"><input type="text" class="form-control" name="ch_id" id="ch_id" value="<?= (isset($ch_id) && $ch_id != "") ? $ch_id : ""; ?>"></div>
                    </div>
                    <div class="hr-line-dashed"></div>
                    <div class="form-group"><label class="col-sm-2 control-label">Description</label>
                        <div class="col-sm-10"><input type="text" class="form-control" name="ch_description" id="ch_description" value="<?= (isset($ch_description) && $ch_description != "") ? $ch_description : ""; ?>"></div>
                    </div>
                    <div class="hr-line-dashed"></div>
                    <div class="form-group"><label class="col-sm-2 control-label">Is system code ?</label>
                        <div class="col-sm-10">
                            <select class="form-control m-b" name="ch_system" id="ch_system">
                                <option value="1" <?= (isset($ch_system) && $ch_system == "1") ? "selected='selected'" : ""; ?> >Yes</option>
                                <option value="-1" <?= (isset($ch_system) && $ch_system == "-1") ? "selected='selected'" : ""; ?> >No</option>
                            </select>
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>
                    <div class="form-group"><label class="col-sm-2 control-label">Is active code ?</label>
                        <div class="col-sm-10">
                            <select class="form-control m-b" name="ch_active" id="ch_active">
                                <option value="1" <?= (isset($ch_active) && $ch_active == "1") ? "selected='selected'" : ""; ?> >Yes</option>
                                <option value="-1" <?= (isset($ch_active) && $ch_active == "-1") ? "selected='selected'" : ""; ?> >No</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-4 col-sm-offset-2">
                            <button class="btn btn-white" type="reset" onclick="window.location = '<?= base_url("code_header/index") ?>'">Cancel</button>
                            <button class="btn btn-primary" type="submit">Save changes</button>
                        </div>
                    </div>
                    <?= form_close(); ?>
                </div>
            </div>
        </div>
    </div>
</div>