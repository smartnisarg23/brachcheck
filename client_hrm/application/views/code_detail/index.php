<div class="wrapper wrapper-content animated">
    <div class="row">
        <div class="col-md-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Code details</h5>
                    <div class="ibox-tools">
                        <button type="button" class="btn btn-w-m btn-primary" onclick="window.location='<?= base_url("code_detail/create") ?>'">New Code detail</button>
                    </div>
                </div>
                <div class="ibox-content">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover dataTables-example" >
                            <thead>
                                <tr>
                                    <th>Header</th>
                                    <th>ID</th>
                                    <th>Short Description</th>
                                    <th>System code</th>
                                    <th>Active</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($code_details as $key => $value) { ?>
                                    <tr>
                                        <td><?= $value['ch_id'] ?></td>
                                        <td><?= $value['cd_id'] ?></td>
                                        <td><?= $value['cd_short_description'] ?></td>
                                        <td><?= ($value['cd_system'] == "1")? "Yes":"No"; ?></td>
                                        <td><?= ($value['cd_active'] == "1")? "Yes":"No"; ?></td>
                                        <td class="center">
                                            <a class="btn btn-white btn-bitbucket" href="<?=  base_url("code_detail/update/".$value["id"])?>">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            <a class="btn btn-white btn-bitbucket" href="<?=  base_url("code_detail/delete/".$value["id"])?>" onclick="return deleteMsg('Code detail')">
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