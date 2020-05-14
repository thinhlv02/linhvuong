<div class="page-title">
    <div class="title_left"><h3>Quản lý menu</h3></div>
    <div class="title_right">
        <div class="col-md-6 col-sm-6 col-xs-12 pull-right">


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



                    <label class="control-label col-md-1 col-sm-1 col-xs-1 text-left" for="first-name">Tên menu<span
                                class="required">*</span></label>
                    <div class="col-md-2 col-sm-2 col-xs-12">
                        <input type="text" id="txtName" name="name" value="" required
                               class="form-control col-md-7 col-xs-12">
                    </div>

                    <div class="col-md-2 col-sm-2 col-xs-12 col-md-offset-0">
                        <input type="submit" class="btn btn-success" name="btnSearch" value="Tạo"/>
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
                        <th>Menu</th>
                        <th>Thao tác</th>
                    </tr>
                    </thead>

                    <tbody>
                    <?php foreach ($lstdata as $k => $v) { ?>

                        <tr>
                            <td><?= $v->id ?></td>
                            <td><?= $v->name ?></td>
                            <td>
                                <a href="<?php echo admin_url('admin/edit_menu/') . $v->id ?>"
                                   class="btn btn-info btn-xs">Sửa</a>
                                <a onclick="confirm_del_event(<?php echo $v->id ?>)"
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

<!--<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>-->


<script>

    //submit form gold
    $("#formAddProduct").submit(function (e) {
        //prevent Default functionality
        e.preventDefault();

        var data = $("#formAddProduct").serialize();
        console.log(data);

        getAjax('<?php echo admin_url('admin/ajax_menu') ?>', data, 'POST', _onSuccess);

    });

    var _onSuccess = function (data) {
        // console.log(data);
        // $("#question").html('');
        if (data == 'NOT_LOGIN') {
            window.location.reload(true);
        } else if (data === 'false') {
            alert('Danh mục "' + cat_name + '" không tồn tại!');
        } else {
            alert(data);
            location.reload();

        }
    };

    function confirm_del_event(id) {
        var r = confirm("Bạn có chắc chắn?");
        if (r == true) {
            window.location.href = "<?php echo admin_url('admin/del_menu/')?>" + id;
        }
    }
</script>
