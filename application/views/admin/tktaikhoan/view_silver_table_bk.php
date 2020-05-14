<div class="x_content">
    <table id="datatable-product-2" class="table table-striped table-bordered bulk_action">
        <thead>
        <tr>
            <th>tài nguyên</th>
            <th>hành động</th>
            <th>mô tả</th>
            <th>nguồn cũ</th>
            <th>biến động</th>
            <th>cập nhật</th>
            <th>Logintime</th>
            <th>Logouttime</th>
        </tr>
        </thead>

        <tbody>
        <?php foreach ($lstdata as $key => $value): ?>
            <?php $act_silver = $act_paddy = '';
            if ($value->silver_update == 0) {
                $act_silver = '0';
            } elseif ($value->silver_update > 0) {
                $act_silver = 'Tăng';
            } else {
                $act_silver = 'Giảm';
            }

            if ($value->paddy_update == 0) {
                $act_paddy = '0';
            } elseif ($value->paddy_update > 0) {
                $act_paddy = 'Tăng';
            } else {
                $act_paddy = 'Giảm';
            }
            ?>

            <?php if (in_array($resources, array('0', '1'))) { ?>


                <tr>
                    <td><?php echo 'bạc' ?></td>
                    <td><?php echo $act_silver; ?></td>
                    <td><?php echo $value->description_silver ?></td>
                    <td><?php echo number_format($value->silver_old) ?></td>
                    <td><?php echo number_format($value->silver_update) ?></td>
                    <td><?php echo number_format($value->silver_new) ?></td>
                    <td><?php echo $value->logintime ?></td>
                    <td><?php echo $value->logouttime ?></td>
                </tr>

            <?php } ?>

            <?php if (in_array($resources, array('0', '2'))) { ?>
                <tr>
                    <td><?php echo 'lúa' ?></td>
                    <td><?php echo $act_paddy ?></td>
                    <td><?php echo $value->description_paddy ?></td>
                    <td><?php echo number_format($value->paddy_old) ?></td>
                    <td><?php echo number_format($value->paddy_update) ?></td>
                    <td><?php echo number_format($value->paddy_new) ?></td>
                    <td><?php echo $value->logintime ?></td>
                    <td><?php echo $value->logouttime ?></td>
                </tr>

            <?php } ?>
        <?php endforeach ?>
        </tbody>
    </table>
</div>

<script>
    $('#datatable-product-2').dataTable({
        "ordering": false
    });
</script>