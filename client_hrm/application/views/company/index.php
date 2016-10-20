<div class="wrapper wrapper-content animated">
    <div class="row">
        <div class="col-md-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Companies</h5>
                    <div class="ibox-tools">
                        <button type="button" class="btn btn-w-m btn-primary" onclick="window.location='<?= base_url("company/create") ?>'">New Company</button>
                    </div>
                </div>
                <div class="ibox-content">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover dataTables-example">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Code</th>
                                    <th>Address</th>
                                    <th>Contact person</th>
                                    <th>Contact number</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($companies as $key => $value) { ?>
                                    <tr>
                                        <td><?= $value['c_name'] ?></td>
                                        <td><?= $value['c_code'] ?></td>
                                        <td>
                                            <?= $value['c_address_street'] ?><br/>
                                            <?= $value['c_address_area'] ?><br/>
                                            <?= $value['c_address_city'] ?><br/>
                                            <?= $value['c_address_state'] ?><br/>
                                            <?= $value['c_address_country'] ?>
                                        </td>
                                        <td><?= $value['c_contact_person'] ?></td>
                                        <td><?= $value['c_number'] ?></td>
                                        <td><?= get_status($value['c_status']) ?></td>
                                        <td class="center">
                                            <a class="btn btn-white btn-bitbucket" href="<?=  base_url("company/update/".$value["id"])?>">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            <a class="btn btn-white btn-bitbucket" href="<?=  base_url("company/delete/".$value["id"])?>" onclick="return deleteMsg('Company')">
                                                <i class="fa fa-times-circle"></i>
                                            </a>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>