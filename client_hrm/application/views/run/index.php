<div class="wrapper wrapper-content animated">
    <div class="row">
        <div class="col-md-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Run</h5>
                    <div class="ibox-tools">
                        <button type="button" class="btn btn-w-m btn-primary" onclick="window.location = '<?= base_url("run/create") ?>'">New Run</button>
                    </div>
                </div>
                <div class="ibox-content">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover dataTables-example" >
                            <thead>
                                <tr>
                                    <th>Run ID</th>
                                    <th>Short description</th>
                                    <th>Start time</th>
                                    <th>Logbook required?</th>
                                    <th>Expected duration's</th>
                                    <th>Rundays</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($runs as $key => $value) { ?>
                                    <tr>
                                        <td><?= $value['r_id'] ?></td>
                                        <td><?= $value['r_s_desc'] ?></td>
                                        <td><?= $value['r_start_time'] ?></td>
                                        <td><?= $value['r_log_book'] ?></td>
                                        <td><?= $value['r_duration'] ?></td>
                                        <?php $days = explode(",", $value['r_run_days']); ?>
                                        <td>
                                            <?php foreach ($days as $key => $val) { ?>
                                                <?= $val ?>
                                            <?php } ?>
                                        </td>
                                        <td><?= get_status($value['r_status']) ?></td>
                                        <td class="center">
                                            <a class="btn btn-white btn-bitbucket" href="<?= base_url("run/update/" . $value["id"]) ?>">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            <a class="btn btn-white btn-bitbucket" href="<?= base_url("run/delete/" . $value["id"]) ?>" onclick="return deleteMsg('Run')">
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