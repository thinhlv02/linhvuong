<!--                        --><?//= pre($lst_gift_item_info_); ?>
<?php foreach ($lst_gift_item_info_ as $key => $value) { ?>
    <div class="col-md-6 col-sm-6 col-xs-12 text-nowrap">
        <input type="checkbox" id="<?= $key ?>" name="itemKeys[<?= $key ?>]">
        <input type="number" name="itemValues[<?= $key ?>]" value="<?= $value ?>" class="numItems" min="1">
        <label for="<?= $key ?>"><?= $value ?></label>
    </div>

<?php } ?>