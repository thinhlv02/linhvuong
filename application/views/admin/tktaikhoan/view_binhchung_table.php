<div class="x_content">
    <table id="datatable-product-2" class="table table-striped table-bordered bulk_action">
        <thead>
        <tr>
            <th>Tên binh chủng</th>
            <th colspan="3" class="text-center">Trang bị</th>
            <th>Tướng sở hữu</th>
            <th>EXP</th>
        </tr>
        </thead>

        <tbody>
<!--        --><?php //pre($binh_chung_type_post) ?>

        <?php foreach ($lstdata as $key => $value): ?>
            <?php if ($binh_chung_type_post == 0) { ?>
                <tr>
                    <td><?php echo $value['binh_chung_name'] . ' -> level: ' . $value['binh_chung_info_binh_level'] ?></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td><?php echo $value['quanVoId'] ?></td>
                    <td><?php echo $value['totalExp'] ?></td>
                </tr>
                <?php
            } else {
                if ($value['binh_chung_info_binh_chung_type'] == $binh_chung_type_post) { ?>
                    <tr>
                        <td><?php echo $value['binh_chung_name'] . ' -> level: ' . $value['binh_chung_info_binh_level'] ?></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td><?php echo $value['quanVoId'] ?></td>
                        <td><?php echo $value['totalExp'] ?></td>
                    </tr>
                <?php }
            } ?>

        <?php endforeach ?>
        </tbody>
    </table>
</div>

