<div class="wrapper wrapper-content animated">
    <div class="row">
        <div class="col-md-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Employees</h5>
                    <div class="ibox-tools">
                        <button type="button" class="btn btn-w-m btn-primary" onclick="window.location='<?= base_url("employee/create") ?>'">New Employee</button>
                    </div>
                </div>
                <div class="ibox-content">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover dataTables-example" >
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Role</th>
                                    <th>Gender</th>
                                    <th>Join date</th>
                                    <th>Branch</th>
                                    <th>Department</th>
                                    <th>Cost center</th>
                                    <th>Delivery center</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($employees as $key => $value) { ?>
                                    <tr>
                                        <td><?= $value['e_fname']." ".$value['e_mname']." ".$value['e_lname'] ?></td>
                                        <td><?= $value['role'] ?></td>
                                        <td><?= $value['e_gender'] ?></td>
                                        <td><?= $value['e_joining_date'] ?></td>
                                        <td><?= $value['branch'] ?></td>
                                        <td><?= $value['department'] ?></td>
                                        <td><?= $value['costcenter'] ?></td>
                                        <td><?= $value['deliverycenter'] ?></td>
                                        <td><?= get_status($value['e_status']) ?></td>
                                        <td class="center">
                                            <a class="btn btn-white btn-bitbucket" href="<?=  base_url("employee/update/".$value["id"])?>">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            <a class="btn btn-white btn-bitbucket" href="<?=  base_url("employee/delete/".$value["id"])?>" onclick="return deleteMsg('Employee')">
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