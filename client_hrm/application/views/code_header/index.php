<div class="wrapper wrapper-content animated">
    <div class="row">
        <div class="col-md-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Code headers</h5>
                    <div class="ibox-tools">
                        <button type="button" class="btn btn-w-m btn-primary" onclick="window.location='<?= base_url("code_header/create") ?>'">New Code header</button>
                    </div>
                </div>
                <div class="ibox-content">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover dataTables-example" >
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Description</th>
                                    <th>System code</th>
                                    <th>Active</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($code_headers as $key => $value) { ?>
                                    <tr>
                                        <td><?= $value['ch_id'] ?></td>
                                        <td><?= $value['ch_description'] ?></td>
                                        <td><?= ($value['ch_system'] == "1")? "Yes":"No"; ?></td>
                                        <td><?= ($value['ch_active'] == "1")? "Yes":"No"; ?></td>
                                        <td class="center">
                                            <a class="btn btn-white btn-bitbucket" href="<?=  base_url("code_header/update/".$value["id"])?>">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            <a class="btn btn-white btn-bitbucket" href="<?=  base_url("code_header/delete/".$value["id"])?>" onclick="return deleteMsg('Code header')">
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