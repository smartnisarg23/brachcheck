<div class="wrapper wrapper-content animated">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Update role</h5>
                </div>
                <div class="ibox-content">
                    <?php echo form_open(base_url('truck_model/update/' . $record_id), array("class" => "form-horizontal")); ?>
                    <div class="form-group"><label class="col-sm-2 control-label">Name</label>
                        <div class="col-sm-10"><input type="text" class="form-control" name="tm_name" id="tm_name" value="<?= (isset($tm_name) && $tm_name != "") ? $tm_name : ""; ?>"></div>
                    </div>
                    <div class="hr-line-dashed"></div>
                    <div class="form-group"><label class="col-sm-2 control-label">Truck make</label>
                        <div class="col-sm-10">
                            <select class="form-control m-b" name="tm_make" id="tm_make">
                                <option value="">Please truck make</option>
                                <?php foreach ($truck_makes as $value) { ?>
                                    <option value="<?= $value["id"] ?>" <?= (isset($tm_make) && $tm_make == $value["id"]) ? "selected='selected'" : ""; ?> ><?= $value["tm_name"] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>
                    <div class="form-group"><label class="col-sm-2 control-label">Status</label>
                        <div class="col-sm-10">
                            <select class="form-control m-b" name="tm_status" id="tm_status">
                                <option value="1" <?= (isset($tm_status) && $tm_status == "1") ? "selected='selected'" : ""; ?> >Active</option>
                                <option value="0" <?= (isset($tm_status) && $tm_status == "0") ? "selected='selected'" : ""; ?> >Inactive</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-4 col-sm-offset-2">
                            <button class="btn btn-white" type="reset" onclick="window.location = '<?= base_url("truck_model/index") ?>'">Cancel</button>
                            <button class="btn btn-primary" type="submit">Save changes</button>
                        </div>
                    </div>
                    <?= form_close(); ?>
                </div>
            </div>
        </div>
    </div>
</div>