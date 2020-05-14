<div class="page-title">
    <div class="title_left"><h3>Chợ</h3></div>
    <div class="title_right">
        <div class="col-md-6 col-sm-6 col-xs-12 pull-right">
                        <a href="
                    <?php echo admin_url('Shop_item/add') ?>" class="btn btn-primary btn-sm">Thêm mới</a>


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
                        <select class="select2_group form-control" name="server" >

                            <?php foreach ($server_cf as $key => $value) { ?>
                                <option value="<?= $key ?>" <?php if (isset($_POST['server']) && $_POST['server'] == $key) echo 'selected' ?>>
                                    <?php echo $value['name'] ?>
                                </option>
                            <?php } ?>

                        </select>
                    </div>

                    <div class="col-md-2 col-sm-2 col-xs-12 col-md-offset-0">
                        <input type="submit" class="btn btn-success" name="btnSearch" value="Tìm kiếm"/>
                    </div>


                </div>


            </form>

        </div>

    </div>

</div>


<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">

        <div class="x_panel">
            <div class="x_title">
                <h2>Danh sách </h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                           aria-expanded="false"><i
                                    class="fa fa-wrench"></i></a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="#">Settings 1</a>
                            </li>
                            <li><a href="#">Settings 2</a>
                            </li>
                        </ul>
                    </li>
                    <li><a class="close-link"><i class="fa fa-close"></i></a></li>
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <table id="datatable-product" class="table table-striped table-bordered bulk_action">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Gói quà</th>
                        <th>vật phẩm</th>
                        <!--                        <th>Info_name</th>-->
                        <th>Số lượng</th>
                        <th>Giá tiền</th>
                        <th>Loại tiền</th>
                        <th>Thời gian mở</th>
                        <th>Thời gian đóng</th>
                        <th>Thao tác</th>
                    </tr>
                    </thead>

                    <tbody>
                    <?php foreach ($lstdata as $k => $v) { ?>

                        <tr>
                            <td><?= $v['id'] ?></td>
                            <td><?= $v['type_name'] ?></td>
                            <td><?= $v['name'] ?></td>
                            <!--                            <td>--><? //= $v['info_id_name'] ?><!--</td>-->
                            <td><?= $v['quantity'] ?></td>
                            <td><?= $v['price'] ?></td>

                            <td><?= $v['unit_name'] ?></td>
                            <td><?= $v['time_open'] ?></td>
                            <td><?= $v['time_close'] ?></td>

                            <td class="text-nowrap">
                                <a href="<?php echo admin_url('shop_item/edit/') . $v['id'].'/'.$_POST['server'] ?>"
                                   class="btn btn-info btn-xs">Sửa</a>
                                <a onclick="confirm_del_event('<?php echo $v['id'] ?>', '<?= $_POST['server'] ?>')"
                                   class="btn btn-danger btn-xs">Xóa</a>
                            </td>

                        </tr>
                    <?php } ?>

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</div>




<script>
    //function get_info(sel) {
    //    var type = sel.value;
    //    console.log(type);
    //    if (type == 0) {
    //        $("#replace_info").hide();
    //    } else {
    //        // ajax
    //        var params = {
    //            'type': type,
    //            'selected': 0,
    //        };
    //
    //        // console.log(params);
    //        var _onSuccess = function (data) {
    //            // console.log(data);
    //            // $("#question").html('');
    //            if (data == 'NOT_LOGIN') {
    //                window.location.reload(true);
    //            } else if (data === 'false') {
    //                alert('Danh mục "' + cat_name + '" không tồn tại!');
    //            } else {
    //                console.log(data);
    //                $("#replace_info").html(data);
    //            }
    //        };//
    //
    //        getAjax('<?php //echo admin_url('Gift_item_info/ajax_get_list_gift_item_by_type') ?>//', params, 'POST', _onSuccess);
    //    }
    //}


    //submit form gold
    //$("#formAddProduct").submit(function (e) {
    //    //prevent Default functionality
    //    e.preventDefault();
    //
    //    var data = $("#formAddProduct").serialize();
    //    // console.log(data);
    //
    //    getAjax('<?php //echo admin_url('shop_item/add_market') ?>//', data, 'POST', _onSuccess_gold);
    //
    //});

    // var _onSuccess_gold = function (data) {
    //     // console.log(data);
    //     // $("#question").html('');
    //     if (data == 'NOT_LOGIN') {
    //         window.location.reload(true);
    //     } else if (data === 'false') {
    //         alert('Danh mục "' + cat_name + '" không tồn tại!');
    //     } else {
    //         alert(data);
    //         location.reload();
    //
    //         // alert('Tạo thành công');
    //         // location.reload();
    //
    //     }
    // };

    function confirm_del_event(id,server) {
        var r = confirm("Bạn có chắc chắn?");
        if (r == true) {
            window.location.href = "<?php echo admin_url('shop_item/del/')?>" + id + '/' + server;
        }
    }


    // function get_checkbox() {
    //
    //     if ($('#check_id').is(":checked")) {
    //         console.log('test');
    //
    //         $("#report_date2").val('');
    //     } else {
    //         console.log('not check');
    //     }
    //
    // }
</script>
