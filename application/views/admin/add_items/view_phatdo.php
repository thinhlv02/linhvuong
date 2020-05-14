<div class="page-title">
    <div class="title_left"><h3>Phát đồ</h3></div>
    <div class="title_right">
        <div class="col-md-6 col-sm-6 col-xs-12 pull-right">


        </div>
    </div>
</div>

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
                    <div class="row">
                        <div class="col-12 col-sm-12 col-md-7">

                            <div class="form-group">

                                <div class="row scroll_giftcode">
                                    <!--                        --><? //= pre($lst_gift_item_info_); ?>
                                    <?php foreach ($lst_gift_item_info_ as $key => $value) { ?>
                                        <div class="col-md-6 col-sm-6 col-xs-12 text-nowrap">
                                            <input type="checkbox" id="<?= $key ?>" name="itemKeys[<?= $key ?>]">
                                            <input type="number" name="itemValues[<?= $key ?>]" class="numItems" value="<?= $value ?>"
                                                   min="1">
                                            <label for="<?= $key ?>"><?= $value ?></label>
                                        </div>

                                    <?php } ?>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-sm-12 col-md-5">
                            <div class="form-group">


                                <label class="control-label col-md-2 col-sm-2 col-xs-1 text-left text-nowrap"
                                       for="first-name">Trạng thái<span
                                            class="required">*</span></label>
                                <div class="col-md-10 col-sm-10 col-xs-12">
                                    <select class="select2_group form-control" name="sub">
                                        <option value="0" <?php if (isset($_POST['sub']) && $_POST['sub'] == 1) echo 'selected' ?>>
                                            Cộng
                                        </option>
                                        <option value="1" <?php if (isset($_POST['sub']) && $_POST['sub'] == 2) echo 'selected' ?>>
                                            Trừ
                                        </option>
                                    </select>
                                </div>


                            </div>

                            <div class="form-group">

                                <label class="control-label col-md-2 col-sm-2 col-xs-12 text-left text-nowrap"
                                       for="first-name">Userid list<span
                                            class="required">*</span></label>

                                <div class="col-md-10 col-sm-10 col-xs-12">
                                    <input type="text" id="txtName" name="list_user_id" value="" required
                                           placeholder="Nhập 0 để phát tất"
                                           class="form-control col-md-7 col-xs-12">
                                </div>
                            </div>


                            <div class="form-group">

                                <label class="control-label col-md-2 col-sm-2 col-xs-1 text-left text-nowrap"
                                       for="first-name">Tiêu đề<span
                                            class="required">*</span></label>
                                <div class="col-md-10 col-sm-10 col-xs-12">
                                    <input type="text" id="txtName" name="title" value="" required
                                           class="form-control col-md-7 col-xs-12">
                                </div>


                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-2 col-sm-2 col-xs-1 text-left text-nowrap"
                                       for="first-name">Nội dung<span
                                            class="required">*</span></label>
                                <div class="col-md-10 col-sm-10 col-xs-12">
                                    <input type="text" id="txtName" name="note" value="" required
                                           class="form-control col-md-7 col-xs-12">
                                </div>


                            </div>

                            <label class="control-label col-md-2 col-sm-2 col-xs-12 text-left text-nowrap" for="first-name">Server<span
                                        class="required">*</span></label>
                            <div class="col-md-10 col-sm-10 col-xs-12">
                                <select class="select2_group form-control" name="server" >

                                    <?php foreach ($server_cf as $key => $value) { ?>
                                        <option value="<?= $key ?>" <?php if (isset($_POST['server']) && $_POST['server'] == $key) echo 'selected' ?>>
                                            <?php echo $value['name'] ?>
                                        </option>
                                    <?php } ?>

                                </select>
                            </div>

                            <div class="form-group">

                                <div class="col-md-12 col-sm-12 col-xs-12 text-center">
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


<!--<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>-->


<script>

    //submit form gold
    $("#formAddProduct").submit(function (e) {
        //prevent Default functionality
        e.preventDefault();

        var data = $("#formAddProduct").serialize();
        console.log(data);

        getAjax('<?php echo admin_url('add_items/phatdo_add') ?>', data, 'POST', _onSuccess_gold);

    });

    var _onSuccess_gold = function (data) {
        console.log(data);
        // $("#question").html('');
        if (data == 'NOT_LOGIN') {
            window.location.reload(true);
        } else if (data === 'false') {
            alert('dữ liệu chọn sai nhé!!');
            // alert('Danh mục "' + cat_name + '" không tồn tại!');
        } else {
            alert(data);
            // location.reload();

        }
    };

    function confirm_del_event(id) {
        var r = confirm("Bạn có chắc chắn?");
        if (r == true) {
            window.location.href = "<?php echo admin_url('shop_item/del/')?>" + id;
        }
    }
</script>
