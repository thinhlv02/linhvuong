<?php //if ($message) {
//    $this->load->view('admin/message', $this->data);
//} ?>
<div class="page-title">
    <div class="title_left text-nowrap"><h3>Danh sách tài khoản quản trị</h3></div>

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
                    <label class="control-label col-md-1 col-sm-1 col-xs-12 text-left" for="first-name">Tài khoản<span
                                class="required">*</span></label>
                    <!--            <span style="float: left;margin-top: 7px">Số</span>-->
                    <div class="col-md-2 col-sm-2 col-xs-12">
                        <input type="text" name="UserID" required placeholder="nhập tên "
                               class="form-control col-md-7 col-xs-12">
                    </div>

                    <label class="control-label col-md-1 col-sm-1 col-xs-12 text-left" for="first-name">Mật khẩu<span
                                class="required">*</span></label>

                    <div class="col-md-2 col-sm-2 col-xs-12">
                        <input type="password" name="UserPassword" value="" required placeholder="nhập Mật khẩu"
                               class="form-control col-md-7 col-xs-12">
                    </div>


                    <label class="control-label col-md-1 col-sm-1 col-xs-12 text-left text-left text-nowrap" for="first-name">Mã KD<span
                                class="required">*</span></label>

                    <div class="col-md-2 col-sm-2 col-xs-12">
                        <select name="itemKeys[]" multiple="multiple" placeholder="Chọn mã kinh doanh" onchange="console.log($(this).children(':selected').length)" class="selectPartner form-control">

                            <?php foreach ($providers as $key => $value) { ?>

                                <option value="<?= $value->provider_id ?>"><?= $value->partners ?></option>

                            <?php } ?>

                        </select>

                    </div>

                    <div class="col-md-2 col-sm-2 col-xs-12 text-center">
                        <input type="submit" id="btnAddEvent" name="btnAddadmin" required="required"
                               class="btn btn-success"
                               value="Thêm">
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
                <h2>Danh sách (<?php echo count($res) ?>)</h2>
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
                        <th>Tên đăng nhập</th>
                        <th>Người tạo</th>
                        <th>Thời gian tạo</th>
                        <th>Hành động</th>
                        <th>Phân quyền</th>
                    </tr>
                    </thead>

                    <tbody>
                    <!--            --><?php //$this->load->model('level_model') ?>
                    <?php $i = 0; ?>

                    <?php foreach ($res as $key => $value): ?>
                        <?php
                        $i++;
                        ?>
                        <tr>
                            <td><?php echo $i; ?></td>
                            <td><?php echo $value['UserID'] ?></td>
                            <td><?php echo $value['creator'] ?></td>
                            <td><?= $value['time_create'] ?></td>
                            <td class="text-nowrap">
                                <a href="
                        <?php echo admin_url('admin/edit/') . $value['id'] ?>"
                                   class="btn btn-info btn-xs">Sửa</a>
                                <a onclick="confirm_del_event(<?php echo $value['id'] ?>)"
                                   class="btn btn-danger btn-xs">Xóa</a>
                            </td>
                            <td><a href="<?php echo admin_url('admin/access/') . $value['id'] ?>"
                                   class="btn btn-info btn-xs"><?php echo $value['UserID'] ?></a>
                            </td>
                        </tr>
                    <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript">
    function confirm_del_event(id) {
        var r = confirm("Bạn có chắc chắn muốn xóa tài khoản này?");
        if (r == true) {
            window.location.href = "<?php echo admin_url('admin/del/')?>" + id;
        }
    }
</script>