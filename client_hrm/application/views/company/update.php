<div class="wrapper wrapper-content animated">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Update company</h5>
                </div>
                <div class="ibox-content">
                    <?php echo form_open(base_url('company/update/' . $record_id), array("class" => "form-horizontal")); ?>
                    <div class="form-group"><label class="col-sm-2 control-label">Name</label>
                        <div class="col-sm-10"><input type="text" class="form-control" name="c_name" id="c_name" value="<?= (isset($c_name) && $c_name != "") ? $c_name : ""; ?>"></div>
                    </div>
                    <div class="hr-line-dashed"></div>
                    <div class="form-group"><label class="col-sm-2 control-label">Code</label>
                        <div class="col-sm-10"><input type="text" class="form-control" name="c_code" id="c_code" value="<?= (isset($c_code) && $c_code != "") ? $c_code : ""; ?>"></div>
                    </div>
                    <div class="hr-line-dashed"></div>
                    <div class="form-group"><label class="col-sm-2 control-label">Address</label>
                        <div class="col-sm-10">
                            <input type="text" placeholder="Ploat number and street" class="form-control m-b"  name="c_address_street" id="c_address_street" value="<?= (isset($c_address_street) && $c_address_street != "") ? $c_address_street : ""; ?>">
                            <input type="text" placeholder="Area" class="form-control m-b" name="c_address_area" id="c_address_area" value="<?= (isset($c_address_area) && $c_address_area != "") ? $c_address_area : ""; ?>">
                            <input type="text" placeholder="City" class="form-control m-b" name="c_address_city" id="c_address_city" value="<?= (isset($c_address_city) && $c_address_city != "") ? $c_address_city : ""; ?>">
                            <input type="text" placeholder="State" class="form-control m-b" name="c_address_state" id="c_address_state" value="<?= (isset($c_address_state) && $c_address_state != "") ? $c_address_state : ""; ?>">
                            <input type="text" placeholder="Country" class="form-control m-b" name="c_address_country" id="c_address_country" value="<?= (isset($c_address_country) && $c_address_country != "") ? $c_address_country : ""; ?>">
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>
                    <div class="form-group"><label class="col-sm-2 control-label">Contact number</label>
                        <div class="col-sm-10"><input type="text" class="form-control" name="c_number" id="c_number" value="<?= (isset($c_number) && $c_number != "") ? $c_number : ""; ?>"></div>
                    </div>
                    <div class="hr-line-dashed"></div>
                    <div class="form-group"><label class="col-sm-2 control-label">Contact person</label>
                        <div class="col-sm-10"><input type="text" class="form-control" name="c_contact_person" id="c_contact_person" value="<?= (isset($c_contact_person) && $c_contact_person != "") ? $c_contact_person : ""; ?>"></div>
                    </div>
                    <div class="hr-line-dashed"></div>
                    <div class="form-group"><label class="col-sm-2 control-label">Approver</label>
                        <div class="col-sm-10">
                            <select class="form-control m-b" name="c_approver_id" id="c_approver_id">
                                <option value=""> Select approver</option>
                                <?php foreach ($employees as $value) { ?>
                                    <option value="<?= $value["id"] ?>" <?= (isset($c_approver_id) && $c_approver_id == $value["id"]) ? "selected='selected'" : ""; ?> ><?= $value["e_fname"] . " " . $value["e_lname"] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>
                    <div class="form-group"><label class="col-sm-2 control-label">Approver type</label>
                        <div class="col-sm-10">
                            <select class="form-control m-b" name="c_approval_type" id="c_approval_type">
                                <?php foreach ($code_details as $value) { ?>
                                    <option value="<?= $value["id"] ?>" <?= (isset($c_approval_type) && $c_approval_type == $value["id"]) ? "selected='selected'" : ""; ?> ><?= $value["cd_id"]." - ".$value["cd_short_description"] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>
                    <div class="form-group"><label class="col-sm-2 control-label">Status</label>
                        <div class="col-sm-10">
                            <select class="form-control m-b" name="c_status" id="c_status">
                                <option value="1" <?= (isset($c_status) && $c_status == "1") ? "selected='selected'" : ""; ?> >Active</option>
                                <option value="0" <?= (isset($c_status) && $c_status == "0") ? "selected='selected'" : ""; ?> >Inactive</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-4 col-sm-offset-2">
                            <button class="btn btn-white" type="submit">Cancel</button>
                            <button class="btn btn-primary" type="submit">Save changes</button>
                        </div>
                    </div>
                    <?= form_close(); ?>
                </div>
            </div>
        </div>
    </div>
</div>