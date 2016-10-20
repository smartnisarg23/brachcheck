<div class="wrapper wrapper-content animated">
    <div class="row">
        <div class="col-md-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Uniforms</h5>
                    <div class="ibox-tools">
                        <button type="button" class="btn btn-w-m btn-primary" onclick="window.location='<?= base_url("uniform/create") ?>'">New Uniform</button>
                    </div>
                </div>
                <div class="ibox-content">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover dataTables-example" >
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Created</th>
                                    <th>Status</th>
                                    <th>Roles attached</th>
                                    <th>Employees attached</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($uniforms as $key => $value) { ?>
                                    <tr>
                                        <td><?= $value['u_name'] ?></td>
                                        <td><?= $value['u_create_date'] ?></td>
                                        <td><?= get_status($value['u_status']) ?></td>
                                        <td><?= $value['role_attach'] ?></td>
                                        <td><?= $value['employee_attach'] ?></td>
                                        <td class="center">
                                            <a class="btn btn-white btn-bitbucket" href="<?=  base_url("uniform/view/".$value["id"])?>">
                                                <i class="fa fa-eye"></i>
                                            </a>
                                            <a class="btn btn-white btn-bitbucket" href="<?=  base_url("uniform/update/".$value["id"])?>">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            <a class="btn btn-white btn-bitbucket" href="<?=  base_url("uniform/delete/".$value["id"])?>" onclick="return deleteMsg('Uniform')">
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