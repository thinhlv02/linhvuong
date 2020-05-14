<?php $menu_access = $this->session->userdata('menu_access'); ?>
<?php if (isset($message)) {
    $this->load->view('admin/message', $this->data);
} ?>
<div class="page-title">
    <div class="title_left"><h3>Duyệt đồ</h3></div>
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
            <form id="formAddProduct" data-parsley-validate class="form-horizontal form-label-left" method="post"
                  enctype="multipart/form-data">
                <div class="form-group">
                    <label class="control-label col-md-1 col-sm-1 col-xs-1 text-left text-nowrap" for="first-name">Server<span
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

                    <div class="col-md-2 col-sm-2 col-xs-12 col-md-offset-0">
                        <input type="submit" class="btn btn-success" name="btnSearch" value="Tìm kiếm"/>
                    </div>


                </div>


            </form>

        </div>

    </div>

</div>
<!--end form-->
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
                <table id="datatable-product" class="table table-striped table-bordered bulk_action">
                    <thead>
                    <tr>
                        <th>STT</th>
                        <th>Đồ phát</th>
                        <th style="display: none"></th>
                        <th style="display: none"></th>
                        <th>Trạng thái</th>
                        <th style="display: none"></th>
                        <th>Danh sách nhận</th>
                        <th>Người phát</th>
                        <th>Thời gian</th>
                        <th>Tiêu đề</th>
                        <th>Nội dung</th>
                        <th>Thao tác</th>
                    </tr>
                    </thead>

                    <tbody>

                    <?php
                    $i = 0;
                    foreach ($lstdata as $key => $value):
                        $i++;
                        ?>
                        <tr id="id_<?php echo $value->id ?>">
                            <td><?= $i; ?></td>
                            <td>
                                <?php
                                $tags = explode(',', $value->list_items);

                                foreach ($tags as $k1 => $v1) {
                                    $item = explode('-', $v1);
//                                    $item_name = $item[0];
                                    $item_name = isset($lst_gift_item_info_[$item[0]]) ? $lst_gift_item_info_[$item[0]] : 'N/A';

//                                    echo $item_name.' / '. $item[1].  '<br/>';
                                    echo '<li>' . $item_name . ' - ' . $item[1] . '<br/>' . '</li>';
                                }
                                //                                echo $value->list_items
                                ?>

                            </td>
                            <td class="id_admin_item_step1" style="display: none"><?= $value->id ?></td>
                            <td class="list_items" style="display: none"><?php echo $value->list_items ?></td>
                            <td><?php if ($value->sub == 0) echo "cộng"; else echo 'Trừ'; ?></td>
                            <td style="display: none" class="sub"><?= $value->sub ?></td>
                            <td class="list_user_id"><?php echo $value->list_user_id ?></td>
                            <td class=""><?php echo $value->admin_nick ?></td>
                            <td><?php if ($value->date_create) echo date('Y-m-d H:i:s', strtotime($value->date_create)) ?></td>
                            <td><?php echo $value->title ?></td>
                            <td class="note"><?php echo $value->note ?></td>
                            <td>
                                <?php if ($value->status == 0) { ?>
                                    <button class="btn btn-primary btn-sm send_data" id="hide_button_<?php echo $value->id ?>">Duyệt</button>
                                    <button class="btn btn-danger btn-sm cancel_data" id="huy_button_<?php echo $value->id ?>">Hủy</button>
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


<!--<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>-->

<script type="text/javascript">
    $('.send_data').click(function () {
        var $row = $(this).closest("tr");    // Find the row
        console.log($row);
        var list_user_id = $row.find(".list_user_id").text(); // Find the text
        var list_items = $row.find(".list_items").text(); // Find the text
        var note = $row.find(".note").text(); // Find the text
        var sub = $row.find(".sub").text(); // Find the text
        var id_admin_item_step1 = $row.find(".id_admin_item_step1").text(); // Find the text
        // var sub =$(this).data("sub"); // will return the string "123"
        // var sub = $(this).attr('sub');
        // console.log($("#trowId").attr("data-sub"));

        // var term = $($row).attr('data-sub');
        // alert(term);

        // console.log(list_user_id);
        // console.log(list_items);
        // console.log(note);
        // console.log(sub);
        // console.log(sub);
        var params = {
            'type': 1,
            'list_user_id': list_user_id,
            'list_items': list_items,
            'note': note,
            'sub': sub,
            'id_admin_item_step1': id_admin_item_step1,
            'server': <?= $_POST['server'] ?>
        };
        console.log(params);

        getAjax('<?php echo admin_url('add_items/ajax_duyetdo') ?>', params, 'POST', _onSuccess);


    });

    $('.cancel_data').click(function () {
        var $row = $(this).closest("tr");    // Find the row
        console.log($row);

        var id_admin_item_step1 = $row.find(".id_admin_item_step1").text(); // Find the text

        var params = {
            'type': 0,
            'id_admin_item_step1': id_admin_item_step1,
            'server': <?= $_POST['server'] ?>
        };
        console.log(params);

        getAjax('<?php echo admin_url('add_items/ajax_duyetdo') ?>', params, 'POST', _huy);


    });


    var _onSuccess = function (data) {
        console.log(data);
        // $("#question").html('');
        if (data == 'NOT_LOGIN') {
            window.location.reload(true);
        } else if (data === 'false') {
            alert('Danh mục "' + cat_name + '" không tồn tại!');
        } else {
            // if (data == true) {
            $('#hide_button_' + data).hide();
            $('#huy_button_' + data).hide();
            alert('Duyệt thành công')
            // } else {
            //     alert('Duyệt thất bại');
            // }
            // console.log(data);
            // $("#silver_table").html(data);
        }
    };//

    var _huy = function (data) {
        console.log(data);
        // $("#question").html('');
        if (data == 'NOT_LOGIN') {
            window.location.reload(true);
        } else if (data === 'false') {
            alert('Danh mục "' + cat_name + '" không tồn tại!');
        } else {
            // if (data == true) {
            $('#hide_button_' + data).hide();
            $('#huy_button_' + data).hide();
            alert('Đã hủy')
        }
    };//
</script>
