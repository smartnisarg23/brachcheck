<div class="wrapper wrapper-content animated">
    <div class="row">
        <div class="col-md-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Trucks</h5>
                    <div class="ibox-tools">
                        <button type="button" class="btn btn-w-m btn-primary" onclick="window.location = '<?= base_url("trucks/create") ?>'">New Truck</button>
                    </div>
                </div>
                <div class="ibox-content">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover dataTables-example" >
                            <thead>
                                <tr>
                                    <th>Truck rego</th>
                                    <th>Truck description</th>
                                    <th>Make</th>
                                    <th>Model</th>
                                    <th>Year</th>
                                    <th>Licence class</th>
                                    <th>Last WOF/COF</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($trucks as $key => $value) { ?>
                                    <tr>
                                        <td><?= $value['t_rego_num'] ?></td>
                                        <td><?= $value['t_description'] ?></td>
                                        <td><?= $value['t_make'] ?></td>
                                        <td><?= $value['t_model'] ?></td>
                                        <td><?= $value['t_man_yr'] ?></td>
                                        <td><?= $value['t_lic_cls'] ?></td>
                                        <td><?= date('Y-m-d', strtotime($value['t_wof_date'])); ?></td>
                                        <td><?= get_status($value['t_status']) ?></td>
                                        <td class="center">
                                            <a class="btn btn-white btn-bitbucket" href="<?= base_url("trucks/update/" . $value["id"]) ?>">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            <a class="btn btn-white btn-bitbucket" href="<?= base_url("trucks/delete/" . $value["id"]) ?>" onclick="return deleteMsg('Truck')">
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