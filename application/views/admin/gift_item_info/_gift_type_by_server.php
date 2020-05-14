<select class="select2_group form-control" name="type" onchange="get_lst_vatpham(this,<?= $server_post ?>)">
    <!--                            --><?php //pre($lst_gift_type) ?>
    <option value="0">Chọn server :  <?php echo $server_post ?></option>
    <?php foreach ($lst_gift_type as $key => $value) { ?>
        <option value="<?= $key ?>" <?php if (isset($_POST['type']) && $_POST['type'] == $key) echo 'selected' ?>>
            <?php echo $value ?>
        </option>
    <?php } ?>

</select>