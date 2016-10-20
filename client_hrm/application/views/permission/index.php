<div class="wrapper wrapper-content animated">
    <div class="row">
        <div class="col-md-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Permissions</h5>
                </div>
                <div class="ibox-content">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Controller</th>
                                <th>Action</th>
                                <?php foreach ($roles as $key => $value) { ?>
                                <th class="center"><?= $value['r_name'] ?></th>
                                <?php } ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($permission_list as $controller => $actions) { ?>
                                <?php foreach ($actions as $action) { ?>
                                    <tr>
                                        <td><?= $controller ?></td>
                                        <td><?= $action ?></td>
                                        <?php foreach ($roles as $key => $value) { ?>
                                            <?php $name = str_replace(" ", "_", strtolower($value['r_name'])) . "_" . $controller . "_" . $action; ?>
                                            <?php
                                            $checked = "";
                                            foreach ($permissions as $key => $val) {
                                                if ($val['role_id'] == $value['id'] && $val['controller'] == $controller && $val['action'] == $action) {
                                                    $checked = "checked='checked'";
                                                }
                                            }
                                            ?>
                                            <td style="text-align: center">
                                                <input type="checkbox" class="i-checks set-permission" <?= $checked ?> name="<?= $name ?>" data-role="<?= $value['id'] ?>" data-controller="<?= $controller ?>" data-action="<?= $action ?>">
                                            </td>
                                        <?php } ?>
                                    </tr>
                                <?php } ?>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function () {
        $('.i-checks').iCheck({
            checkboxClass: 'icheckbox_square-green',
            radioClass: 'iradio_square-green',
        });
        $(".i-checks").on("ifChecked", add_permission);
        $(".i-checks").on("ifUnchecked", remove_permission);
    });
    function add_permission() {
        var $this = $(this);
        $.ajax({
            type: "POST",
            data: {"operation": "add", "role_id": $this.data('role'), "controller": $this.data('controller'), "action": $this.data('action')},
            url: "<?= base_url("permission/manage_permission") ?>",
            success: function (data) {
                var obj = JSON.parse(data);
                if (obj.status != "success") {
                    alert('<?= DB_OPERATION_ERROR ?>');
                }
            }
        });
    }
    function remove_permission() {
        var $this = $(this);
        $.ajax({
            type: "POST",
            data: {"operation": "remove", "role_id": $this.data('role'), "controller": $this.data('controller'), "action": $this.data('action')},
            url: "<?= base_url("permission/manage_permission") ?>",
            success: function (data) {
                var obj = JSON.parse(data);
                if (obj.status != "success") {
                    alert('<?= DB_OPERATION_ERROR ?>');
                }
            }
        });
    }
</script>