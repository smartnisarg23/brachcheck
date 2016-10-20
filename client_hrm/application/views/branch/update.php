<div class="wrapper wrapper-content animated">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Update branch</h5>
                </div>
                <div class="ibox-content">
                    <?php echo form_open(base_url('branch/update/' . $record_id), array("class" => "form-horizontal")); ?>
                    <div class="form-group"><label class="col-sm-2 control-label">Name</label>
                        <div class="col-sm-10"><input type="text" class="form-control" name="b_name" id="b_name" value="<?= (isset($b_name) && $b_name != "") ? $b_name : ""; ?>"></div>
                    </div>
                    <div class="hr-line-dashed"></div>
                    <div class="form-group"><label class="col-sm-2 control-label">Code</label>
                        <div class="col-sm-10"><input type="text" class="form-control" name="b_code" id="b_code" value="<?= (isset($b_code) && $b_code != "") ? $b_code : ""; ?>"></div>
                    </div>
                    <div class="hr-line-dashed"></div>
                    <div class="form-group"><label class="col-sm-2 control-label">Company</label>
                        <div class="col-sm-10">
                            <select class="form-control m-b" name="b_company_id" id="b_company_id">
                                <?php foreach ($companies as $value) { ?>
                                    <option value="<?= $value["id"] ?>" <?= (isset($b_company_id) && $b_company_id == $value["id"]) ? "selected='selected'" : ""; ?> ><?= $value["c_name"] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>
                    <div class="form-group"><label class="col-sm-2 control-label">Address</label>
                        <div class="col-sm-10">
                            <input type="text" placeholder="Ploat number and street" class="form-control m-b"  name="b_address_street" id="b_address_street" value="<?= (isset($b_address_street) && $b_address_street != "") ? $b_address_street : ""; ?>">
                            <input type="text" placeholder="Area" class="form-control m-b" name="b_address_area" id="b_address_area" value="<?= (isset($b_address_area) && $b_address_area != "") ? $b_address_area : ""; ?>">
                            <input type="text" placeholder="City" class="form-control m-b" name="b_address_city" id="b_address_city" value="<?= (isset($b_address_city) && $b_address_city != "") ? $b_address_city : ""; ?>">
                            <input type="text" placeholder="State" class="form-control m-b" name="b_address_state" id="b_address_state" value="<?= (isset($b_address_state) && $b_address_state != "") ? $b_address_state : ""; ?>">
                            <input type="text" placeholder="Country" class="form-control m-b" name="b_address_country" id="b_address_country" value="<?= (isset($b_address_country) && $b_address_country != "") ? $b_address_country : ""; ?>">
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>
                    <div class="form-group"><label class="col-sm-2 control-label">Contact number</label>
                        <div class="col-sm-10"><input type="text" class="form-control" name="b_number" id="b_number" value="<?= (isset($b_number) && $b_number != "") ? $b_number : ""; ?>"></div>
                    </div>
                    <div class="hr-line-dashed"></div>
                    <div class="form-group"><label class="col-sm-2 control-label">Contact person</label>
                        <div class="col-sm-10"><input type="text" class="form-control" name="b_contact_person" id="b_contact_person" value="<?= (isset($b_contact_person) && $b_contact_person != "") ? $b_contact_person : ""; ?>"></div>
                    </div>
                    <div class="hr-line-dashed"></div>
                    <div class="form-group"><label class="col-sm-2 control-label">Status</label>
                        <div class="col-sm-10">
                            <select class="form-control m-b" name="b_status" id="b_status">
                                <option value="1" <?= (isset($b_status) && $b_status == "1") ? "selected='selected'" : ""; ?> >Active</option>
                                <option value="0" <?= (isset($b_status) && $b_status == "0") ? "selected='selected'" : ""; ?> >Inactive</option>
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