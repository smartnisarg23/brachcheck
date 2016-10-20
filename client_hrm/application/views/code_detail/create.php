<div class="wrapper wrapper-content animated">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Create code detail</h5>
                </div>
                <div class="ibox-content">
                    <?php echo form_open(base_url('code_detail/create'), array("class" => "form-horizontal")); ?>
                    <div class="form-group"><label class="col-sm-2 control-label">Header Id</label>
                        <div class="col-sm-10">
                            <select class="form-control m-b" name="cd_header_id" id="cd_header_id">
                                <?php foreach ($code_headers as $value) { ?>
                                    <option value="<?= $value["id"] ?>" <?= (isset($cd_header_id) && $cd_header_id == $value["id"]) ? "selected='selected'" : ""; ?> ><?= $value["ch_id"] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>
                    <div class="form-group"><label class="col-sm-2 control-label">ID</label>
                        <div class="col-sm-10"><input type="text" class="form-control" name="cd_id" id="cd_id" value="<?= (isset($cd_id) && $cd_id != "") ? $cd_id : ""; ?>"></div>
                    </div>
                    <div class="hr-line-dashed"></div>
                    <div class="form-group"><label class="col-sm-2 control-label">Short description</label>
                        <div class="col-sm-10"><input type="text" class="form-control" name="cd_short_description" id="cd_short_description" value="<?= (isset($cd_short_description) && $cd_short_description != "") ? $cd_short_description : ""; ?>"></div>
                    </div>
                    <div class="hr-line-dashed"></div>
                    <div class="form-group"><label class="col-sm-2 control-label">Description</label>
                        <div class="col-sm-10"><input type="text" class="form-control" name="cd_description" id="cd_description" value="<?= (isset($cd_description) && $cd_description != "") ? $cd_description : ""; ?>"></div>
                    </div>
                    <div class="hr-line-dashed"></div>
                    <div class="form-group"><label class="col-sm-2 control-label">Extra notes</label>
                        <div class="col-sm-10"><textarea class="form-control" name="cd_extra_data" id="cd_extra_data"><?= (isset($cd_extra_data) && $cd_extra_data != "") ? $cd_extra_data : ""; ?></textarea></div>
                    </div>
                    <div class="hr-line-dashed"></div>
                    <div class="form-group"><label class="col-sm-2 control-label">Is system code ?</label>
                        <div class="col-sm-10">
                            <select class="form-control m-b" name="cd_system" id="cd_system">
                                <option value="1" <?= (isset($cd_system) && $cd_system == "1") ? "selected='selected'" : ""; ?> >Yes</option>
                                <option value="-1" <?= (isset($cd_system) && $cd_system == "-1") ? "selected='selected'" : ""; ?> >No</option>
                            </select>
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>
                    <div class="form-group"><label class="col-sm-2 control-label">Is active code ?</label>
                        <div class="col-sm-10">
                            <select class="form-control m-b" name="cd_active" id="cd_active">
                                <option value="1" <?= (isset($cd_active) && $cd_active == "1") ? "selected='selected'" : ""; ?> >Yes</option>
                                <option value="-1" <?= (isset($cd_active) && $cd_active == "-1") ? "selected='selected'" : ""; ?> >No</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-4 col-sm-offset-2">
                            <button class="btn btn-white" type="reset" onclick="window.location = '<?= base_url("code_detail/index") ?>'">Cancel</button>
                            <button class="btn btn-primary" type="submit">Save changes</button>
                        </div>
                    </div>
                    <?= form_close(); ?>
                </div>
            </div>
        </div>
    </div>
</div>