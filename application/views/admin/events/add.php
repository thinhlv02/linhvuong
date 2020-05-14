
<div class="page-title">
    <div class="title_left"><h3>Sự kiện </h3></div>
    <div class="title_right">
        <div class="col-md-6 col-sm-6 col-xs-12 pull-right">

        </div>
    </div>
</div>
<!--form-->
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">

        <div class="x_panel">
            <?php if (isset($message)) {
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
                                    <?php foreach ($lst_gift_item_info_ as $key => $value) { ?>
                                        <div class="col-md-6 col-sm-6 col-xs-12 text-nowrap">

                                            <input type="checkbox" id="<?= $key ?>" name="itemKeys[<?= $key ?>]">
                                            <input type="number" name="itemValues[<?= $key ?>]" value="<?= $value ?>"
                                                   class="numItems" min="1">
                                            <label for="<?= $key ?>"><?= $value ?></label>

                                        </div>

                                    <?php } ?>

                                </div>

                            </div>

                        </div>

                        <div class="col-12 col-sm-12 col-md-5">

                            <div class="form-group">

                                <label class="control-label col-md-2 col-sm-2 col-xs-12 text-left" for="first-name">Loại
                                    Events<span
                                            class="required">*</span></label>
                                <div class="col-md-10 col-sm-10 col-xs-12">
                                    <select class="select2_group form-control" name="type">
                                        <option value="1" <?php if (isset($_POST['type']) && $_POST['type'] == 1) echo 'selected' ?>>
                                            Event nạp
                                        </option>
                                        <option value="2" <?php if (isset($_POST['type']) && $_POST['type'] == 2) echo 'selected' ?>>
                                            Event tiêu
                                        </option>
                                    </select>
                                </div>


                            </div>

                            <div class="form-group">

                                <label class="control-label col-md-2 col-sm-2 col-xs-12 text-left" for="first-name">Tên
                                    events<span
                                            class="required">*</span></label>
                                <div class="col-md-10 col-sm-10 col-xs-12">
                                    <input type="text" id="txtName" name="events_title" value="" required
                                           class="form-control col-md-7 col-xs-12">
                                </div>
                            </div>

                            <div class="form-group">


                                <label class="control-label col-md-2 col-sm-2 col-xs-12 text-left" for="first-name">Nội
                                    dung<span
                                            class="required">*</span></label>
                                <div class="col-md-10 col-sm-10 col-xs-12">
                                    <input type="text" id="txtName" name="content" value="" required
                                           class="form-control col-md-7 col-xs-12">
                                </div>
                            </div>

                            <div class="form-group">


                                <label class="control-label col-md-2 col-sm-2 col-xs-12 text-left" for="first-name">Thời
                                    gian<span
                                            class="required">*</span></label>
                                <div class="col-md-10 col-sm-10 col-xs-12">
                                    <input type="text" id="reportdatetime" name="reportdatetime" required
                                           class="form-control col-md-7 col-xs-12"
                                           value="<?php if (isset($_POST['txtTo'])) echo $_POST['txtTo'] ?>">

                                </div>
                            </div>

                            <div class="form-group">

                                <label class="control-label col-md-2 col-sm-2 col-xs-12 text-left text-nowrap" for="first-name">Server<span
                                            class="required">*</span></label>
                                <div class="col-md-10 col-sm-10 col-xs-12">
                                    <select class="select2_group form-control" name="server" onchange="get_lst_item_info_by_server(this)">

                                        <?php foreach ($server_cf as $key => $value) { ?>
                                            <option value="<?= $key ?>" <?php if (isset($_POST['server']) && $_POST['server'] == $key) echo 'selected' ?>>
                                                <?php echo $value['name'] ?>
                                            </option>
                                        <?php } ?>

                                    </select>
                                </div>


                            </div>

                            <div class="form-group text-center">


                                <div class="col-md-12 col-sm-12 col-xs-12">
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
<!--end form-->

<script type="text/javascript">
    function confirm_del_event(id) {
        var r = confirm("Bạn có chắc chắn?");
        if (r == true) {
            window.location.href = "<?php echo admin_url('Events/del/')?>" + id;
        }
    }

    function get_lst_item_info_by_server(sel) {
        var server_name = sel.value;

        // ajax
        var params = {
            'server': server_name
        };

        // console.log(params);
        var _onSuccess = function (data) {
            // console.log(data);

            if (data == 'NOT_LOGIN') {
                window.location.reload(true);
            } else if (data === 'false') {
                alert('Danh mục "' + cat_name + '" không tồn tại!');
            } else {
                console.log(data);
                $(".scroll_giftcode").html(data);
            }
        };

        getAjax('<?php echo admin_url('Gift_item_info/ajax_get_tbl_gift_item_info_by_server') ?>', params, 'POST', _onSuccess);

    }


</script>
