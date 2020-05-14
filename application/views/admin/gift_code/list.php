<?php if (isset($message)) {
    $this->load->view('admin/message', $this->data);
} ?>
<div class="page-title">
    <div class="title_left"><h3>Mã quà tặng</h3></div>
    <div class="title_right">
        <div class="col-md-6 col-sm-6 col-xs-12 pull-right">
<!--            <a href="-->
<!--        --><?php //echo admin_url('gift_code/add') ?><!--" class="btn btn-primary btn-sm">Thêm mới</a>-->
            <!--                    <a href="-->
            <!--        --><?php //echo admin_url('admin') ?><!--" class="btn btn-info btn-sm">Quay lại danh sách</a>-->
        </div>
    </div>
</div>
<div class="x_panel">
    <?php if ($message) {
        $this->load->view('admin/message', $this->data);
    } ?>
    <form id="formAddProduct" data-parsley-validate class="form-horizontal form-label-left" method="post"
          enctype="multipart/form-data">
        <div class="form-group">
            <label class="control-label col-md-1 col-sm-1 col-xs-12 text-left" for="first-name">Chọn<span
                        class="required">*</span></label>
            <div class="col-md-2 col-sm-2 col-xs-12">
                <select class="select2_group form-control" onchange="get_val(this)" name="type">
                    <option value="1">Tất cả</option>
                    <option value="2">Chọn thời gian</option>
                </select>
            </div>

<!--            <div id="select_date">-->

                <label class="control-label col-md-1 col-sm-1 col-xs-2 text-left text-nowrap" for="first-name">Bắt đầu<span
                            class="required">*</span></label>

<!--                <div class="select_date">-->
                <div class="col-md-2 col-sm-2 col-xs-12">
                    <!--                <span style="float: left;margin-top: 7px">Từ ngày: </span>-->
                    <div class="select_date">
                        <input type="text" id="txtTo4" name="txtFrom" required
                               class="form-control col-md-7 col-xs-12"
                               value="<?php if (isset($_POST['txtFrom'])) echo $_POST['txtFrom'] ?>">
                    </div>
                </div>
<!--                </div>-->

                <label class="control-label col-md-1 col-sm-1 col-xs-2 text-left text-nowrap" for="first-name">kết thúc<span
                            class="required">*</span></label>
                <div class="col-md-2 col-sm-2 col-xs-12">
                    <!--                <span style="float: left;margin-top: 7px">Từ ngày: </span>-->
                    <div class="select_date">
                        <input type="text" id="txtTo3" name="txtTo" required
                               class="form-control col-md-7 col-xs-12"
                               value="<?php if (isset($_POST['txtTo'])) echo $_POST['txtTo'] ?>">
                    </div>
                </div>
<!--            </div>-->

            <label class="control-label col-md-1 col-sm-1 col-xs-1 text-nowrap" for="first-name">UserID<span
                        class="required"></span></label>
            <div class="col-md-2 col-sm-2 col-xs-12">
                <input type="number" name="user_id_received" value="<?php if (isset($_POST['user_id_received'])) echo $_POST['user_id_received'] ?>"
                       class="form-control"/>
            </div>



        </div>

        <div class="form-group">


            <label class="control-label col-md-1 col-sm-1 col-xs-1 text-nowrap text-left" for="first-name">Code<span
                        class="required"></span></label>
            <div class="col-md-2 col-sm-2 col-xs-12">
                <input type="text" name="giftcode" value="<?php if (isset($_POST['giftcode'])) echo $_POST['giftcode'] ?>"
                       class="form-control"/>
            </div>
            <!--            <label class="control-label col-md-1 col-sm-1 col-xs-12 text-nowrap" for="first-name">Hạn dùng<span-->
            <!--                        class="required"></span></label>-->
            <!--            <div class="col-md-2 col-sm-2 col-xs-12">-->
            <!--                <input type="text" id="txtFrom" name="expire_date" required-->
            <!--                       value="-->
            <?php //if (isset($_POST['expire_date'])) echo date('d-m-Y', strtotime($_POST['expire_date'])) ?><!--"-->
            <!--                       class="form-control col-md-7 col-xs-12"/>-->
            <!--            </div>-->
                        <label class="control-label col-md-1 col-sm-1 col-xs-1 text-nowrap text-left" for="first-name">Loại<span
                                    class="required"></span></label>
                        <div class="col-md-2 col-sm-2 col-xs-12">
                            <select class="select2_group form-control" name="type_giftcode">

                                <option value="99">All</option>
                                <option value="1">1 lần</option>
                                <option value="2">Dùng nhiều lần</option>
                            </select>
                        </div>

                    <label class="control-label col-md-1 col-sm-1 col-xs-12 text-left text-nowrap" for="first-name">Server<span
                                class="required">*</span></label>
                    <div class="col-md-2 col-sm-2 col-xs-12">
                        <select class="select2_group form-control server_val" name="server" >

                            <?php foreach ($server_cf as $key => $value) { ?>
                                <option value="<?= $key ?>" <?php if (isset($_POST['server']) && $_POST['server'] == $key) echo 'selected' ?>>
                                    <?php echo $value['name'] ?>
                                </option>
                            <?php } ?>

                        </select>
                    </div>
        </div>

        <div class="form-group">
            <div class="col-md-1 col-sm-1 col-xs-12 col-md-offset-1" style="">
                <input type="submit" id="btnAddEvent" name="btnAdd" required="required" class="btn btn-success"
                       value="Tìm kiếm">
            </div>
            <!--            <div class="col-md-3 col-sm-3 col-xs-12">-->
            <!--            <a href="-->
            <?php //echo admin_url('city/add') ?><!--" class="btn btn-primary btn-sm">Thêm mới</a>-->
            <!--                <a href="-->
            <?php //echo admin_url('config_payment') ?><!--" class="btn btn-success">Quay lại danh sách</a>-->
            <!--            </div>-->
        </div>
    </form>
</div>

<!--load data here-->
<div id="load_data">


</div>
<!--load data here-->

<script>
    function confirmDel(id) {
        if (confirm('Bạn có chắc chắn muốn xóa??')) {
//            window.location.href = '<?php //echo base_url('admin/config_payment/del/')?>//' + id;
        }
    }
</script>

<script type="text/javascript">
    function openForm(id) {
        $("#btn_lock_chat_"+id).css("position", "relative");
        $("#myForm-"+id).css("position", "absolute");

        $('input.id_chat').val(id);
        // console.log(id);
        document.getElementById("myForm-" + id).style.display = "block";


        var _onSuccess = function (data) {
            // console.log(data);
            if (data == 'NOT_LOGIN') {
                window.location.reload(true);
            } else if (data === 'false') {
                alert('Danh mục "' + cat_name + '" không tồn tại!');
            } else {
                alert('Thành công');
                console.log(data);
                closeForm(data);
                $('#btn_lock_chat_' + data).hide();
                $('#send_'+data).hide();
                // $("#content_info").html(data);
            }
        };

        $("#send_chat_" + id).submit(function (e) {
            //prevent Default functionality
            e.preventDefault();
            // console.log('abc');
            var data = $("#send_chat_" + id).serialize();
            // var content = $("#send_chat_" + id).find(".content").val();
            // data = data + '&content=' + content;
            console.log('data->>>>>>', data);

            getAjax('<?php echo admin_url('gift_code/ajax_send_giftcode') ?>', data, 'POST', _onSuccess);

        });

    }

    function closeForm(id) {
        document.getElementById("myForm-" + id).style.display = "none";
    }


    //date

    $(document).ready(function () {
        $('.select_date').hide().find('input, textarea').prop('disabled', true);
    });

    function get_val(sel) {
        if (sel.value == 2) {
            $('.select_date').show().find('input, textarea').prop('disabled', false);
        } else {
            $('.select_date').hide().find('input, textarea').prop('disabled', true);
        }
    }

    // end date


    $("#formAddProduct").submit(function (e) {
        //prevent Default functionality
        e.preventDefault();
        // console.log('formAddProduct_gold111111111 =>>>>>> ' + userid);
        var data = $("#formAddProduct").serialize();
        var server_val = $("#formAddProduct").find(".server_val").val();

        // console.log('data =>>> ' + data);
        // console.log('server_val =>>> ' + server_val);

        // console.log('data =>>> ' + $('input[name="server"]').val());

        getAjax('<?php echo admin_url('Gift_code/ajax_getdata') ?>', data, 'POST', _onSuccess_);

    });

    var _onSuccess_ = function (data) {
        // console.log(data);
        // $("#question").html('');
        if (data == 'NOT_LOGIN') {
            window.location.reload(true);
        } else if (data === 'false') {
            alert('Danh mục "' + cat_name + '" không tồn tại!');
        } else {
            // console.log(data);
            $("#load_data").html(data);
        }
    };
</script>
