<script language="javascript" src="<?php echo base_url('public') ?>/ckeditor/ckeditor.js"
        type="text/javascript"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>public/ckfinder/ckfinder.js"></script>
<div class="page-title">
    <div class="title_left"><h3>Sửa</h3></div>
    <div class="title_right">
        <div class="col-md-6 col-sm-6 col-xs-12 pull-right">

            <a href="<?php echo admin_url('shop_item') ?>" class="btn btn-info btn-sm">Danh sách</a>
        </div>
    </div>
</div>
<?php //pre($lstdata); ?>


<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">


        <div class="x_panel">
            <?php if ($message) {
                $this->load->view('admin/message', $this->data);
            } ?>
            <div class="x_content">
                <br/>

            <form id="formAddProduct" data-parsley-validate class="form-horizontal form-label-left" method="post"
                  enctype="multipart/form-data">
                <?php ?>
                <div class="row">
                    <div class="col-12 col-sm-12 col-md-7">
                        <div class="form-group">
                            <div class="row scroll_giftcode">

                                <?php foreach ($lst_gift_item_info_ as $key => $value) {
                                    $checked = '';
                                    $num_items = '';
                                    ?>


                                    <?php $tags = explode(',', $lstdata->list_items);
                                    foreach ($tags as $k1 => $v1) {
                                        $item = explode('-', $v1);
                                        if ($key == $item['0']) {
                                            $checked = 'checked';
                                            $num_items = $item['1'];
                                        }
                                    }

                                    ?>
                                    <div class="col-md-6 col-sm-6 col-xs-12 text-nowrap">
                                        <input type="checkbox" id="<?= $key ?>"
                                               name="itemKeys[<?= $key ?>]" <?= $checked ?>>
                                        <input type="number" name="itemValues[<?= $key ?>]" value="<?= $num_items ?>" class="numItems" min="1">
                                        <label for="<?= $key ?>"><?= $value ?></label>
                                    </div>

                                <?php } ?>
                            </div>


                        </div>

                    </div>

                    <div class="col-12 col-sm-12 col-md-5">

                        <div class="form-group">

                            <label class="control-label col-md-2 col-sm-2 col-xs-12 text-left" for="first-name">Pack
                                name<span
                                        class="required">*</span></label>
                            <div class="col-md-10 col-sm-10 col-xs-12">
                                <input type="text" id="txtName" name="pack_name" value="<?= $lstdata->pack_name ?>"
                                       required
                                       class="form-control col-md-7 col-xs-12">
                            </div>

                        </div>

                        <div class="form-group">

                            <label class="control-label col-md-2 col-sm-2 col-xs-12 text-left" for="first-name">list server<span
                                        class="required">*</span></label>
                            <div class="col-md-10 col-sm-10 col-xs-12">
                                <input type="text" id="txtName" name="list_server_id"
                                       value="<?= $lstdata->list_server_id ?>" required
                                       class="form-control col-md-7 col-xs-12">
                            </div>

                        </div>

                        <div class="form-group text-center">

                            <div class="col-md-12 col-sm-12 col-xs-12 col-md-offset-0">
                                <input type="submit" class="btn btn-success" name="btnSearch" value="Gửi"/>
                            </div>


                        </div>

                    </div>
                </div>


            </form>

        </div>
        </div>

    </div>

</div>



<script type="text/javascript">
    function get_info(sel) {
        var type = sel.value;


        console.log(type);

        if (type == 0) {
            $("#replace_info").hide();
        } else {
            // ajax
            var params = {
                'type': type,
                'selected': 0,
            };

            // console.log(params);
            var _onSuccess = function (data) {
                // console.log(data);
                // $("#question").html('');
                if (data == 'NOT_LOGIN') {
                    window.location.reload(true);
                } else if (data === 'false') {
                    alert('Danh mục "' + cat_name + '" không tồn tại!');
                } else {
                    console.log(data);
                    $("#replace_info").html(data);
                }
            };//

            getAjax('<?php echo admin_url('Gift_item_info/ajax_get_list_gift_item_by_type') ?>', params, 'POST', _onSuccess);
        }
    }

</script>


