<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-md-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Users</h5>
                    <div class="ibox-tools">
                        <button type="button" class="btn btn-w-m btn-primary">New User</button>
                    </div>
                </div>
                <div class="ibox-content">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover dataTables-example" >
                            <thead>
                                <tr>
                                    <th>Username</th>
                                    <th>Email Id</th>
                                    <th>Role</th>
                                    <th>Join Date</th>
                                    <th>User domain</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($users as $key => $value) { ?>
                                    <tr>
                                        <td><?= $value['username'] ?></td>
                                        <td><?= $value['email_id'] ?></td>
                                        <td><?= $value['role_name'] ?></td>
                                        <td><?= $value['created_date'] ?></td>
                                        <td><?= ($value['role_id'] != "1") ? get_user_domain($value['role_id'], $value['id']) : '--' ?></td>
                                        <td><?= get_status($value['status']) ?></td>
                                        <td class="center">
<!--                                            <a class="btn btn-white btn-bitbucket">
                                                <i class="fa fa-edit"></i>
                                            </a>-->
                                            <?php if ($value['role_id'] != 1 && $value['role_id'] != 4) { ?>
                                                <a class="btn btn-white btn-bitbucket" href="<?= base_url("auth/get_user_portal/" . $value['id']) ?>">
                                                    <i class="fa fa-external-link"></i>
                                                </a>
                                            <?php } ?>

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
<script>
    $(document).ready(function () {
        $('.dataTables-example').DataTable({
            dom: '<"html5buttons"B>lTfgitp',
            buttons: [
                {extend: 'copy'},
                {extend: 'csv'},
                {extend: 'excel', title: 'ExampleFile'},
                {extend: 'pdf', title: 'ExampleFile'},
                {extend: 'print',
                    customize: function (win) {
                        $(win.document.body).addClass('white-bg');
                        $(win.document.body).css('font-size', '10px');

                        $(win.document.body).find('table')
                                .addClass('compact')
                                .css('font-size', 'inherit');
                    }
                }
            ]

        });
    });

</script>