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
            <form id="formAddProduct" data-parsley-validate class="form-horizontal form-label-left" method="post"
                  enctype="multipart/form-data">
                <div class="form-group">
                    <label class="control-label col-md-1 col-sm-1 col-xs-1 text-left text-nowrap" for="first-name">Gói
                        quà<span
                                class="required">*</span></label>
                    <div class="col-md-2 col-sm-2 col-xs-12">
                        <select class="select2_group form-control" name="type" onchange="get_info(this)">

                            <?php foreach ($lst_gift_type as $key => $value) { ?>
                                <option value="<?= $key ?>" <?php if ($lstdata->type == $key) echo 'selected' ?>>
                                    <?php echo $value ?>
                                </option>
                            <?php } ?>

                        </select>
                    </div>


                    <label class="control-label col-md-1 col-sm-1 col-xs-1 text-left text-nowrap" for="first-name">vật
                        phẩm<span
                                class="required">*</span></label>
                    <div class="col-md-2 col-sm-2 col-xs-12" id="replace_info">
                        <select class="select2_group form-control" name="info">

                            <?php foreach ($lst_item_by_type_end as $key => $value) { ?>
                                <option value="<?= $value['id'] . '-' . $value['name'] ?>" <?php if ($lstdata->info_id == $value['id']) echo 'selected' ?>>
                                    <?php echo $value['name'] ?>
                                </option>
                            <?php } ?>

                        </select>
                    </div>

                    <label class="control-label col-md-1 col-sm-1 col-xs-1 text-left text-nowrap" for="first-name">Số
                        lượng<span
                                class="required">*</span></label>
                    <div class="col-md-2 col-sm-2 col-xs-12">
                        <input type="number" id="txtName" name="quantity" value="<?= $lstdata->quantity ?>" required
                               class="form-control col-md-7 col-xs-12">
                    </div>


                </div>


                <div class="form-group">

                    <label class="control-label col-md-1 col-sm-1 col-xs-12 text-left" for="first-name">TG mở<span
                                class="required"></span></label>
                    <div class="col-md-2 col-sm-2 col-xs-12">
                        <input type="text" id="report_date1" name="date1" required
                               value="<?php echo date('d-m-Y H:i:s', strtotime($lstdata->time_open)) ?>"
                               class="form-control col-md-7 col-xs-12"/>
                    </div>

                    <label class="control-label col-md-1 col-sm-1 col-xs-12 text-nowrap text-left" for="first-name">TG
                        đóng<span
                                class="required"></span></label>
                    <div class="col-md-2 col-sm-2 col-xs-12">
                        <input type="text" id="report_date2" name="date2" required
                               value="<?php echo date('d-m-Y H:i:s', strtotime($lstdata->time_close)) ?>"
                               class="form-control col-md-7 col-xs-12">
                    </div>

                    <label class="control-label col-md-1 col-sm-1 col-xs-1 text-left text-nowrap" for="first-name">Loại
                        tiền<span
                                class="required">*</span></label>
                    <div class="col-md-2 col-sm-2 col-xs-12">
                        <select class="select2_group form-control" name="unit">

                            <?php foreach ($lst_gift_unit as $key => $value) { ?>
                                <option value="<?= $key ?>" <?php if ($lstdata->unit == $key) echo 'selected' ?>>
                                    <?php echo $value ?>
                                </option>
                            <?php } ?>

                        </select>
                    </div>

                    <label class="control-label col-md-1 col-sm-1 col-xs-1 text-left text-nowrap" for="first-name">Giá
                        tiền<span
                                class="required">*</span></label>
                    <div class="col-md-2 col-sm-2 col-xs-12">
                        <input type="number" id="txtName" name="price" value="<?= $lstdata->price ?>" required
                               class="form-control col-md-7 col-xs-12">
                    </div>


                </div>


                <div class="form-group">

                    <div class="col-md-2 col-sm-2 col-xs-12 col-md-offset-0">
                        <input type="submit" class="btn btn-success" name="btnSearch" value="cập nhật"/>
                    </div>
                </div>

            </form>

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


