<div class="wrapper wrapper-content animated">
    <div class="row">
        <div class="col-md-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Roles</h5>
                    <div class="ibox-tools">
                        <button type="button" class="btn btn-w-m btn-primary" onclick="window.location='<?= base_url("role/create") ?>'">New Role</button>
                    </div>
                </div>
                <div class="ibox-content">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover dataTables-example" >
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Details</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($roles as $key => $value) { ?>
                                    <tr>
                                        <td><?= $value['r_name'] ?></td>
                                        <td><?= $value['r_details'] ?></td>
                                        <td><?= get_status($value['r_status']) ?></td>
                                        <td class="center">
                                            <a class="btn btn-white btn-bitbucket" href="<?=  base_url("role/update/".$value["id"])?>">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            <a class="btn btn-white btn-bitbucket" href="<?=  base_url("role/delete/".$value["id"])?>" onclick="return deleteMsg('Role')">
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