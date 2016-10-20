<div class="wrapper wrapper-content animated">
    <div class="row">
        <div class="col-md-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Licences</h5>
                    <div class="ibox-tools">
                        <button type="button" class="btn btn-w-m btn-primary" onclick="window.location='<?= base_url("licence/create") ?>'">New Licence</button>
                    </div>
                </div>
                <div class="ibox-content">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover dataTables-example" >
                            <thead>
                                <tr>
                                    <th>Class name</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($licences as $key => $value) { ?>
                                    <tr>
                                        <td><?= $value['l_cls_name'] ?></td>
                                        <td><?= get_status($value['l_status']) ?></td>
                                        <td class="center">
                                            <a class="btn btn-white btn-bitbucket" href="<?=  base_url("licence/update/".$value["id"])?>">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            <a class="btn btn-white btn-bitbucket" href="<?=  base_url("licence/delete/".$value["id"])?>" onclick="return deleteMsg('Licence')">
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