<?php $menu_access = $this->session->userdata('menu_access'); ?>
<?php if ($message) {
    $this->load->view('admin/message', $this->data);
} ?>
<div class="page-title">
    <div class="title_left text-nowrap"><h3>Thống kê phát đồ</h3></div>
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
                        <th>Trạng thái</th>
                        <th>Tài khoản thực hiện</th>
                        <th>Người nhận</th>
                        <th>Vật phẩm / SL</th>
                        <th>Thời gian phát</th>
                        <th>Thời gian duyệt/hủy</th>
                        <th>Tài khoản duyệt hủy</th>
                        <th>Trạng thái</th>
                    </tr>
                    </thead>

                    <tbody>

                    <?php
//                    pre($lst_gift_item_info_[12]);
                    $i = 0;
                    foreach ($lstdata as $key => $value):
                        $i++;
                        ?>
                        <tr>
                            <td><?php echo $i; ?></td>
                            <td><?php if ($value->sub == 0) echo "cộng"; else echo 'Trừ'; ?></td>
                            <td><?php echo $value->admin_nick ?></td>
                            <td><?php echo $value->list_user_id ?></td>
                            <td>
                                <!--                                <ul>-->
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
                                <!--                                </ul>-->

                            </td>
                            <td><?php if ($value->date_create) echo date('Y-m-d H:i:s', strtotime($value->date_create)) ?></td>
                            <td><?php if ($value->date_process) echo date('Y-m-d H:i:s', strtotime($value->date_process)) ?></td>
                            <td><?php echo $value->admin_confirm ?></td>
                            <td><?php if ($value->status == 0) echo "Chờ"; elseif ($value->status == 1) echo 'Đã duyệt'; else echo 'Hủy'; ?></td>
                        </tr>

                    <?php endforeach ?>

                    </tbody>

                </table>
            </div>
        </div>
    </div>
</div>


<style type="text/css">
    td {
        vertical-align: middle !important;
    }

    .action a {
        font-size: 22px;
        display: block;
        cursor: pointer;
    }
</style>
<script type="text/javascript">

</script>
