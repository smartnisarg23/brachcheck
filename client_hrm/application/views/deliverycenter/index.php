<div class="wrapper wrapper-content animated">
    <div class="row">
        <div class="col-md-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Delivery center</h5>
                    <div class="ibox-tools">
                        <button type="button" class="btn btn-w-m btn-primary" onclick="window.location='<?= base_url("deliverycenter/create") ?>'">New Delivery center</button>
                    </div>
                </div>
                <div class="ibox-content">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover dataTables-example" >
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Code</th>
                                    <th>Company</th>
                                    <th>Branch</th>
                                    <th>Address</th>
                                    <th>Contact person</th>
                                    <th>Contact number</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($deliverycenters as $key => $value) { ?>
                                    <tr>
                                        <td><?= $value['d_name'] ?></td>
                                        <td><?= $value['d_code'] ?></td>
                                        <td><?= $value['c_name'] ?></td>
                                        <td><?= $value['b_name'] ?></td>
                                        <td>
                                            <?= $value['d_address_street'] ?><br/>
                                            <?= $value['d_address_area'] ?><br/>
                                            <?= $value['d_address_city'] ?><br/>
                                            <?= $value['d_address_state'] ?><br/>
                                            <?= $value['d_address_country'] ?>
                                            <?= $value['d_address_pincode'] ?>
                                        </td>
                                        <td><?= $value['d_contact_person'] ?></td>
                                        <td><?= $value['d_number'] ?></td>
                                        <td><?= get_status($value['d_status']) ?></td>
                                        <td class="center">
                                            <a class="btn btn-white btn-bitbucket" href="<?=  base_url("deliverycenter/update/".$value["id"])?>">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            <a class="btn btn-white btn-bitbucket" href="<?=  base_url("deliverycenter/delete/".$value["id"])?>" onclick="return deleteMsg('Delivery center')">
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