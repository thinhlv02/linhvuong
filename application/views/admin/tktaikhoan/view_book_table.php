<div class="x_content">
    <table id="datatable-product-2" class="table table-striped table-bordered bulk_action">
        <thead>
        <tr>
            <th>ID</th>
            <th>Username</th>
            <th>Nguồn</th>
            <th>Kênh nạp</th>
            <th>cũ</th>
            <th>mới</th>
            <th>thay đổi</th>
            <th>time</th>
            <!--            <th>Logouttime</th>-->
        </tr>
        </thead>

        <tbody>

        <?php foreach ($lstdata as $key => $value): ?>
            <tr>
                <td><?php echo $value['user_id'] ?></td>
                <td><?php echo $value['nick'] ?></td>
                <!--                <td>--><?php // ?><!--</td>-->
                <td><?php echo nl2br($value['description']) ?></td>
                <td>N/A</td>
                <td><?php echo number_format($value['old_quantity']) ?></td>
                <td><?php echo number_format($value['new_quantity']) ?></td>
                <td><?php echo number_format( $value['update_quantity']) ?></td>
                <td><?php echo  $value['time'] ?></td>
                <!--                <td>--><?php //echo  $value->logouttime ?><!--</td>-->
            </tr>
        <?php endforeach ?>
        </tbody>
    </table>
</div>

<script>
    $('#datatable-product-2').dataTable({
        "ordering": false
    });
</script>