<div class="page-title">
    <div class="title_left"><h3>Thêm danh sách chợ</h3></div>
    <div class="title_right">
        <div class="col-md-6 col-sm-6 col-xs-12 pull-right">
            <a href="
                    <?php echo admin_url('Shop_item') ?>" class="btn btn-info btn-sm">Quay lại danh sách</a>

        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">

        <div class="x_panel">
            <?php if (isset($message)) {
                $this->load->view('admin/message', $this->data);
            } ?>
            <form id="formAddProduct" data-parsley-validate class="form-horizontal form-label-left" method="post"
                  enctype="multipart/form-data">
                <div class="form-group">
                    <label class="control-label col-md-1 col-sm-1 col-xs-1 text-left text-nowrap" for="first-name">Server<span
                                class="required">*</span></label>
                    <div class="col-md-2 col-sm-2 col-xs-12">
                        <select class="select2_group form-control" name="server" onchange="get_lst_type(this)">

                            <?php foreach ($server_cf as $key => $value) { ?>
                                <option value="<?= $key ?>" <?php if (isset($_POST['server']) && $_POST['server'] == $key) echo 'selected' ?>>
                                    <?php echo $value['name'] ?>
                                </option>
                            <?php } ?>

                        </select>
                    </div>


                    <label class="control-label col-md-1 col-sm-1 col-xs-1 text-left text-nowrap" for="first-name">Loại quà<span
                                class="required">*</span></label>
                    <div class="col-md-2 col-sm-2 col-xs-12">
                        <select class="select2_group form-control" name="type" id="type_by_server" onchange="get_lst_vatpham(this, 1)">>
                            <option value="0">Chọn 1 loại</option>

                            <?php foreach ($lst_gift_type as $key => $value) { ?>
                                <option value="<?= $key ?>" <?php if (isset($_POST['type']) && $_POST['type'] == $key) echo 'selected' ?>>
                                    <?php echo $value ?>
                                </option>
                            <?php } ?>

                        </select>
                    </div>

                    <label class="control-label col-md-1 col-sm-1 col-xs-1 text-left text-nowrap" for="first-name">Vật phẩm<span
                                class="required">*</span></label>


                    <div class="col-md-2 col-sm-2 col-xs-12" id="replace_info">

                    </div>

                    <label class="control-label col-md-1 col-sm-1 col-xs-1 text-left text-nowrap" for="first-name">Số lượng<span
                                class="required">*</span></label>
                    <div class="col-md-2 col-sm-2 col-xs-12">
                        <input type="number" id="txtName" name="quantity" value="" required min="1"
                               class="form-control col-md-7 col-xs-12">
                    </div>

                </div>


                <div class="form-group">

                    <label class="control-label col-md-1 col-sm-1 col-xs-1 text-left text-nowrap" for="first-name">Bắt đầu<span
                                class="required"></span></label>
                    <div class="col-md-2 col-sm-2 col-xs-12">

                        <input type="text" id="report_date1" name="date1" required
                               class="form-control col-md-7 col-xs-12"
                               value="<?php if (isset($_POST['txtTo'])) echo $_POST['txtTo'] ?>">

                    </div>

                    <label class="control-label col-md-1 col-sm-1 col-xs-1 text-left text-nowrap" for="first-name">Kết thúc<span
                                class="required"></span>
                        <input type="checkbox" value="close" id="check_id" onclick="get_checkbox()"/>

                    </label>

                    <div class="col-md-2 col-sm-2 col-xs-12">


                        <input type="text" id="report_date2" name="date2"
                               class="form-control col-md-7 col-xs-12"
                               value="<?php if (isset($_POST['txtTo'])) echo $_POST['txtTo'] ?>">


                    </div>

                    <label class="control-label col-md-1 col-sm-1 col-xs-1 text-left text-nowrap" for="first-name">Giá tiền<span
                                class="required">*</span></label>
                    <div class="col-md-2 col-sm-2 col-xs-12">
                        <input type="number" id="txtName" name="price" value="" required min="1"
                               class="form-control col-md-7 col-xs-12">
                    </div>

                    <label class="control-label col-md-1 col-sm-1 col-xs-1 text-left text-nowrap" for="first-name">Loại tiền<span
                                class="required">*</span></label>
                    <div class="col-md-2 col-sm-2 col-xs-12">
                        <select class="select2_group form-control" name="unit">

                            <?php foreach ($lst_gift_unit as $key => $value) { ?>
                                <option value="<?= $key ?>" <?php if (isset($_POST['unit']) && $_POST['unit'] == $key) echo 'selected' ?>>
                                    <?php echo $value ?>
                                </option>
                            <?php } ?>

                        </select>
                    </div>


                    <div class="col-md-2 col-sm-2 col-xs-12 col-md-offset-0">
                        <input type="submit" class="btn btn-success" name="btnSearch" value="Tạo"/>
                    </div>


                </div>

            </form>

        </div>

    </div>

</div>


<script>
    function get_lst_vatpham(sel, server_id) {
        var type = sel.value;
        console.log(type);
        if (type == 0) {
            $("#replace_info").hide();
        } else {
            // ajax
            var params = {
                'server': server_id,
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


    //submit form gold
    $("#formAddProduct").submit(function (e) {
        //prevent Default functionality
        e.preventDefault();

        var data = $("#formAddProduct").serialize();
        console.log(data);

        getAjax('<?php echo admin_url('shop_item/add_market') ?>', data, 'POST', _onSuccess_gold);

    });

    var _onSuccess_gold = function (data) {
        // console.log(data);
        // $("#question").html('');
        if (data == 'NOT_LOGIN') {
            window.location.reload(true);
        } else if (data === 'false') {
            alert('Danh mục "' + cat_name + '" không tồn tại!');
        } else {
            alert(data);
            location.reload();

            // alert('Tạo thành công');
            // location.reload();

        }
    };

    function confirm_del_event(id) {
        var r = confirm("Bạn có chắc chắn?");
        if (r == true) {
            window.location.href = "<?php echo admin_url('shop_item/del/')?>" + id;
        }
    }


    function get_checkbox() {

        if ($('#check_id').is(":checked")) {
            console.log('test');

            $("#report_date2").val('');
        } else {
            console.log('not check');
        }

    }

    //adddddd

    //onchange select server
    function get_lst_type(sel) {
        console.log(sel.value);
        var params = {
            'server': sel.value,
        };

        console.log(params);

        getAjax('<?php echo admin_url('Gift_item_info/ajax_list_gift_type_by_server') ?>', params, 'POST', _onSuccess_get_type_by_server);

        if (sel.value == 2) {
            // $('#select_date').show().find('input, textarea').prop('disabled', false);
        } else {
            // $('#select_date').hide().find('input, textarea').prop('disabled', true);
        }
    }

    var _onSuccess_get_type_by_server = function (data) {

        if (data == 'NOT_LOGIN') {
            // window.location.reload(true);
        } else if (data == 'NOT_RIGHT') {
            // alert("Bạn không có quyền thực hiện chức năng này!");
            // window.location.reload(true);
        } else if (data == 'NOT_VALID') {
            // alert("Có lỗi xảy ra!");
            // window.location.reload(true);
        } else {
            $('#type_by_server').html(data);
            $(".info").hide();

            console.log(data);

            // alert(data);
            // $('.tooltip-demo').hide();
            // window.location.reload(true);

        }

    };
</script>
