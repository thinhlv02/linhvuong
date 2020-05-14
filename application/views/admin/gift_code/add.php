<script language="javascript" src="<?php echo base_url('public') ?>/ckeditor/ckeditor.js"
        type="text/javascript"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>public/ckfinder/ckfinder.js"></script>

<div class="page-title">
    <div class="title_left"><h3>Thêm</h3></div>
    <!--    <div class="title_right">-->
    <!--        <div class="col-md-6 col-sm-6 col-xs-12 pull-right">-->
    <!--            <!--            <a href="-->
    <!--            -->
    <?php ////echo admin_url('config_payment/add') ?><!--<!--" class="btn btn-primary btn-sm">Thêm mới</a>-->
    <!--            <a href="-->
    <?php //echo admin_url('config_payment') ?><!--" class="btn btn-info btn-sm">Quay lại danh sách</a>-->
    <!--        </div>-->
    <!--    </div>-->
</div>
<?php //  pre($unit); ?>

<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <?php if ($message) {
                $this->load->view('admin/message', $this->data);
            } ?>

            <div class="x_content">
                <br/>
                <form id="formAddProduct" data-parsley-validate class="form-horizontal form-label-left" method="post"
                      enctype="multipart/form-data"
                      onSubmit="if(!confirm('Bạn có chắc chắn muốn tạo gift code ?')){return false;}">

                    <div class="row">
                        <div class="col-12 col-sm-12 col-md-7">
                            <div class="form-group">

                                <div class="row scroll_giftcode">
                                    <!--                        --><? //= pre($lst_gift_item_info_); ?>
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
                                <label class="control-label col-md-2 col-sm-2 col-xs-12  text-left"
                                       for="first-name">Loại<span
                                            class="required"></span></label>
                                <div class="col-md-10 col-sm-10 col-xs-12">
                                    <select class="select2_group form-control" name="type_giftcode" id="type">
                                        <!--                    <option value="all">Chọn một loại</option>-->
                                        <option value="1">1 code duy nhất và mỗi user chỉ được dùng 1 lần</option>
                                        <option value="2">nhiều code và mỗi code dùng 1 lần / 1 user</option>
                                    </select>
                                </div>


                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-2 col-sm-2 col-xs-12  text-left" for="first-name">level_min<span
                                            class="required"></span></label>
                                <div class="col-md-10 col-sm-10 col-xs-12">
                                    <input id="id_div" type="number" name="level_min" class="form-control"
                                           placeholder="Default Input"
                                           value="0">
                                </div>

                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-2 col-sm-2 col-xs-12  text-left" for="first-name">Số
                                    lượng<span
                                            class="required"></span></label>
                                <div class="col-md-10 col-sm-10 col-xs-12">
                                    <input type="number" name="quantity" class="form-control"
                                           placeholder="Default Input"
                                           min="1"
                                           value="1"
                                           required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-2 col-sm-2 col-xs-12 text-left" for="first-name">list server <span
                                            class="required"></span></label>
                                <div class="col-md-10 col-sm-10 col-xs-12">
                                    <input type="text" name="list_server_id" class="form-control"
                                           placeholder="Default Input"
                                           value="0"
                                           required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-2 col-sm-2 col-xs-12 text-left" for="first-name">Thời
                                    gian<span
                                            class="required">*</span></label>
                                <div class="col-md-10 col-sm-10 col-xs-12">
                                    <!--                <span style="float: left;margin-top: 7px">Từ ngày: </span>-->

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

                                <div class="col-md-12 col-sm-12 col-xs-12 text-center" style="">
                                    <input type="submit" id="btnAddEvent" name="btnAdd" required="required"
                                           class="btn btn-success"
                                           value="Thực hiện">
                                </div>
                                <!--            <div class="col-md-3 col-sm-3 col-xs-12">-->
                                <!--            <a href="-->
                                <?php //echo admin_url('city/add') ?><!--" class="btn btn-primary btn-sm">Thêm mới</a>-->
                                <!--                <a href="-->
                                <?php //echo admin_url('config_payment') ?><!--" class="btn btn-success">Quay lại danh sách</a>-->
                                <!--            </div>-->
                            </div>

                        </div>
                        <!--            <div class="col-md-4 col-sm-4 col-xs-12">4</div>-->
                    </div>


                    <div class="form-group">


                    </div>


                </form>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript">

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

