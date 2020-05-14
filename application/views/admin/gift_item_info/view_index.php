<script language="javascript" src="<?php echo base_url('public') ?>/ckeditor/ckeditor.js"
        type="text/javascript"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>public/ckfinder/ckfinder.js"></script>
<div class="page-title">
    <div class="title_left"><h3>Thống kê gói quà</h3></div>
    <div class="title_right">
        <div class="col-md-6 col-sm-6 col-xs-12 pull-right">
            <a href="
                    <?php echo admin_url('gift_item_info/add') ?>" class="btn btn-primary btn-sm">Thêm mới</a>

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
                        <select class="select2_group form-control" name="server">

                            <?php foreach ($server_cf as $key => $value) { ?>
                                <option value="<?= $key ?>" <?php if (isset($_POST['server']) && $_POST['server'] == $key) echo 'selected' ?>>
                                    <?php echo $value['name'] ?>
                                </option>
                            <?php } ?>

                        </select>
                    </div>


                    <div class="col-md-2 col-sm-2 col-xs-12" style="">
                        <input type="submit" id="btnAddEvent" name="btnAddemployee" required="required"
                               class="btn btn-success"
                               value="Tìm">
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
                <h2>Danh sách (<?php echo count($lstdata) ?>)</h2>
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
                <table id="datatable-product" class="table table-striped table-bordered bulk_action" style="position: relative">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>InfoID</th>
                        <th>Name</th>
                        <th>Type</th>
                        <th>Status</th>

                    </tr>
                    </thead>

                    <tbody>

                    <?php foreach ($lstdata as $key => $value): ?>
                        <tr class="">
                            <td><?php echo $value['id'] ?></td>
                            <td><?php echo $value['info_id'] ?></td>
                            <td><?php echo $value['name'] ?></td>
                            <td><?php echo $value['type_name'] ?></td>
                            <td>
                                <?php if ($value['status'] == 1) { ?>

                                    <span class="label label-primary" onclick="Show_popup_status(this, '<?= $value['id'] ?>', '#pupStatus', '<?= $value['status'] ?>');">Mở</span>

                                <?php } else if ($value['status'] == 0) { ?>

                                    <span class="label label-danger" onclick="Show_popup_status(this, '<?= $value['id'] ?>', '#pupStatus', '<?= $value['status'] ?>');">Đóng</span>

                                <?php } ?>
                            </td>

                        </tr>
                    <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- set status -->
<div class="tooltip-demo" id="pupStatus" style="display: none">

    <div class="tooltip-demo-inner p-3" id="">
        <input type="hidden" id="server_id"/>
        <input type="hidden" id="upk_id_edit"/>
        <select class="slcStatus  input-sm" id="slcStatus"></select>
        <button class="btn btn-primary btn-sm update_status">OK</button>
        <i class="fa fa-chevron-right"></i>

    </div>
</div>
<!-- end set status -->


<script type="text/javascript">

    function Show_popup_status(obj, upk_id, popupBoxId, currStatus) {
        console.log(obj, upk_id, popupBoxId, currStatus);
        $('#server_id').val(<?php if (isset($_POST['server'])) echo $_POST['server'] ?>);
        $('#upk_id_edit').val(upk_id);
        $('#slcStatus option').remove();
        if (currStatus == '1') {
            $('.slcStatus').append("<option value='0'>Đóng</option>");

        } else if (currStatus == '0') {

            $('.slcStatus').append("<option value='-1'>Mở</option>");
        }

        var pos = $(obj).offset();
        var eW = $(popupBoxId).outerWidth();
        var tleft = pos.left - eW - 10;
        var ttop = pos.top - 20;
        console.log(ttop);

        $(popupBoxId).css("top", ttop + "px");
        $(popupBoxId).css("left", tleft + "px");

        $(popupBoxId).slideDown(500);

        $("body").click(function (event) {
            var chk_click = event.target.nodeName;
            if (chk_click == 'TD') {
                $('.tooltip-demo').hide();
            }

            console.log(chk_click);
        });
    }

    $('.update_status').click(function () {
        var server_id = $.trim($('#server_id').val());
        var pk_id = $.trim($('#upk_id_edit').val());
        var status = $.trim($('.slcStatus').val());

        if (confirm("Bạn có muốn đổi trạng thái này ?")) {
            var _onSuccess_stt = function (data) {

                if (data == 'NOT_LOGIN') {
                    // window.location.reload(true);
                } else if (data == 'NOT_RIGHT') {
                    // alert("Bạn không có quyền thực hiện chức năng này!");
                    // window.location.reload(true);
                } else if (data == 'NOT_VALID') {
                    // alert("Có lỗi xảy ra!");
                    // window.location.reload(true);
                } else {

                    alert(data);
                    $('.tooltip-demo').hide();
                    window.location.reload(true);

                }

            };

            var params = {
                'server_id': server_id,
                'status': status,
                'pk_id': pk_id
            };

            console.log(params);

            getAjax('<?php echo admin_url('Gift_item_info/ajax_set_status') ?>', params, 'POST', _onSuccess_stt);

        }
    });

</script>

