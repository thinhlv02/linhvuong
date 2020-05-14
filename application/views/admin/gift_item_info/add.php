<script language="javascript" src="<?php echo base_url('public') ?>/ckeditor/ckeditor.js"
        type="text/javascript"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>public/ckfinder/ckfinder.js"></script>
<div class="page-title">
    <div class="title_left"><h3>Tạo gói quà mới</h3></div>
    <div class="title_right">
        <div class="col-md-6 col-sm-6 col-xs-12 pull-right">
            <a href="
                    <?php echo admin_url('gift_item_info') ?>" class="btn btn-primary btn-sm">Danh sách</a>

        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">


        <div class="x_panel">
            <?php if ($message) {
                $this->load->view('admin/message', $this->data);
            } ?>
            <form id="formAddProduct" data-parsley-validate class="form-horizontal form-label-left" method="post"
                  enctype="multipart/form-data">
                <div class="form-group">
                    <label class="control-label col-md-1 col-sm-1 col-xs-12 text-left text-nowrap" for="first-name">Server<span
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


                    <label class="control-label col-md-1 col-sm-1 col-xs-1 text-left text-nowrap" for="first-name">Gói quà<span
                                class="required">*</span></label>
                    <div class="col-md-2 col-sm-2 col-xs-12" id="type_by_server">
                        <select class="select2_group form-control" name="type" onchange="get_lst_vatpham(this, 1)">
                            <!--                            --><?php //pre($lst_gift_type) ?>
                            <option value="0">Chọn server : 1</option>
                            <?php foreach ($lst_gift_type as $key => $value) { ?>
                                <option value="<?= $key ?>" <?php if (isset($_POST['type']) && $_POST['type'] == $key) echo 'selected' ?>>
                                    <?php echo $value ?>
                                </option>
                            <?php } ?>

                        </select>
                    </div>


                    <label class="control-label col-md-1 col-sm-1 col-xs-1 text-left text-nowrap" for="first-name">vật phẩm<span
                                class="required">*</span></label>
                    <div class="col-md-3 col-sm-3 col-xs-12" id="replace_info">

                    </div>


                    <div class="col-md-2 col-sm-2 col-xs-12" style="">
                        <input type="submit" id="btnAddEvent" name="btnAddemployee" required="required"
                               class="btn btn-success"
                               value="Thêm">
                    </div>

                </div>


            </form>
        </div>
    </div>
</div>

<script type="text/javascript">
    function get_lst_vatpham(sel, server_name) {
        var type = sel.value;


        console.log(type);

        if (type == 0) {
            $(".info").hide();
        } else {
            // ajax
            var params = {
                'server': server_name,
                'type': type,
                'selected': 1,
            };

            console.log(params);
            var _onSuccess = function (data) {
                // console.log(data);
                // $("#question").html('');
                if (data == 'NOT_LOGIN') {
                    window.location.reload(true);
                } else if (data === 'false') {
                    alert('Danh mục "' + cat_name + '" không tồn tại!');
                } else {
                    // console.log(data);
                    $("#replace_info").html(data);
                }
            };//

            getAjax('<?php echo admin_url('Gift_item_info/ajax_get_list_gift_item_by_type') ?>', params, 'POST', _onSuccess);
        }
    }


    $("#formAddProduct").submit(function (e) {
        //prevent Default functionality
        e.preventDefault();
        // console.log('formAddProduct_binhchung');
        var data = $("#formAddProduct").serialize();
        // console.log('data ->>>>>>> ' + data);

        getAjax('<?php echo admin_url('Gift_item_info/ajax_insert_data') ?>', data, 'POST', _onSuccess_2);

    });

    var _onSuccess_2 = function (data) {
        // console.log(data);
        // $("#question").html('');
        if (data == 'NOT_LOGIN') {
            window.location.reload(true);
        } else if (data === 'false') {
            alert('Danh mục "' + cat_name + '" không tồn tại!');
        } else {
            // console.log(data);
            alert(data);
            location.reload();
            // $("#binhchung_table").html(data);
        }
    };

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

