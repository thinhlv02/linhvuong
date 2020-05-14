<select class="select2_group form-control info" name="info">
    <!--                            --><?php //pre($type_status) ?>
    <?php foreach ($lstdata as $key => $value) { ?>
        <option value="<?= $value['id'] . '-' . $value['name'] ?>" <?php if (isset($value['selected']) && $value['selected'] == 1) echo 'disabled' ?>>
            <?php echo $value['name'] ?>
        </option>
    <?php } ?>

</select>
