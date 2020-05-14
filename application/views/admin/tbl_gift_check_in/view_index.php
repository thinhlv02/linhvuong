<?php if ($message) {
//    $this->load->view('admin/message', $this->data);
} ?>
<div class="page-title">
    <div class="title_left"><h3>Phúc lợi </h3></div>
    <div class="title_right">
        <div class="col-md-6 col-sm-6 col-xs-12 pull-right">
            <a href="
                    <?php echo admin_url('tbl_gift_check_in/add') ?>" class="btn btn-primary btn-sm">Thêm mới</a>
        </div>
    </div>
</div>
<!--form-->
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">

        <div class="x_panel">
            <?php if ($message) {
                $this->load->view('admin/message', $this->data);
            } ?>
            <div class="x_content">
                <br/>

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

                                <div class="col-md-2 col-sm-2 col-xs-12 col-md-offset-0">
                                    <input type="submit" class="btn btn-success" name="btnSearch" value="Tìm kiếm"/>
                                </div>
                            </div>

                </form>

            </div>
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
                        <th>#</th>
                        <th>list_server_id</th>
                        <th>pack_id</th>
                        <th>pack_name</th>
                        <th>list_items</th>
                        <th>Thao tác</th>
                    </tr>
                    </thead>

                    <tbody>

                    <?php $i = 0;
                    foreach ($lstdata as $key => $value):
                        $i++;
                        ?>
                        <tr>
                            <td><?= $i; ?></td>
                            <td><?php echo $value['list_server_id'] ?></td>
                            <td><?php echo $value['pack_id'] ?></td>
                            <td><?php echo $value['pack_name'] ?></td>

                            <td>
                                <?php
                                $tags = explode(',', $value['list_items']);

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


                            <td class="text-nowrap">
                                <a href="<?php echo admin_url('Tbl_gift_check_in/edit/') . $value['id']. '/'.$_POST['server'] ?>"
                                   class="btn btn-info btn-xs">Sửa</a>
                                <a onclick="confirm_del_event(<?php echo $value['id'] ?>, <?php echo $_POST['server'] ?>)"
                                   class="btn btn-danger btn-xs">Xóa</a>
                            </td>


                        </tr>

                    <?php endforeach ?>

                    </tbody>

                </table>
            </div>
        </div>
    </div>
</div>


<style type="text/css">

</style>
<script type="text/javascript">
    function confirm_del_event(id,server) {
        var r = confirm("Bạn có chắc chắn?");
        if (r == true) {
            window.location.href = "<?php echo admin_url('Tbl_gift_check_in/del/')?>" + id + '/'+ server;
        }
    }

</script>
