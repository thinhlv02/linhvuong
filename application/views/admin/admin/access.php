<script language="javascript" src="<?php echo base_url('public') ?>/ckeditor/ckeditor.js"
        type="text/javascript"></script>
<div class="page-title">
    <div class="title_left">
        <h3>User : <span
                    style="color: red"><?php echo $this->admin_model->get_info($menu_access_id, '','')->UserID ?></span>
        </h3>
        <?php
        //        $where = array();
        //        $where[$this->key] = $menu_access;
        ?>
        <!--        <h4>Login : <span-->
        <!--                    style="color: green">--><?php //echo $this->admin_model->get_info_rule(array('UserID' => $menu_access_id))->UserID ?><!--</span>-->
        <!--        </h4>-->
    </div>
    <div class="title_right">
        <div class="col-md-5 col-sm-5 col-xs-12 pull-right">
            <!--            <a href="-->
            <?php //echo admin_url('employee/add') ?><!--" class="btn btn-primary btn-sm">Thêm mới</a>-->
            <a href="<?php echo admin_url('admin') ?>" class="btn btn-info btn-sm">Danh sách</a>
        </div>
    </div>
</div>
<?php if ($message) {
    $this->load->view('admin/message', $this->data);
} ?>

<div class="x_panel">
    <form id="" data-parsley-validate class="form-horizontal form-label-left" method="post"
          enctype="multipart/form-data">

        <div class="x_title">
            <h2>Danh sách quyền</h2>
            <ul class="nav navbar-right panel_toolbox">
                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i
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
            <!--            <table id="datatable-product" class="table table-striped table-bordered bulk_action">-->
            <table class="table table-striped table-bordered bulk_action">
                <thead>
                <tr>
                    <th>Stt</th>
                    <th>Chức năng</th>
                    <th class="center">
                        <button type="button" id="selectAllAccess1" class="btn btn-primary btn-sm">Xem</button>
                    </th>
                    <th class="center">
                        <button type="button" id="selectAllAccess2" class="btn btn-success btn-sm">Sửa</button>
                    </th>
                </tr>
                </thead>

                <tbody>
<!--                                --><?php //pre($menu_access) ?>
                <?php $i = 0 ?>
                <?php foreach ($menu_access as $key => $value): ?>
                    <?php
                    $i++;
                    $menu = $this->menu_model->get_info($value->menu_id, '','')
                    ?>
                    <tr>
                        <td><?php echo $i ?></td>
                        <td><?php echo $menu->name ?></td>
                        <td class="center access1"><input type="checkbox" name="access1[]"
                                                          value="<?php echo $value->id ?>" <?php if ($value->access == 1 || $value->access == 2) echo 'checked' ?>>
                        </td>
                        <td class="center access2"><input type="checkbox" name="access2[]"
                                                          value="<?php echo $value->id ?>" <?php if ($value->access == 2) echo 'checked' ?>>
                        </td>
                    </tr>
                <?php endforeach ?>
                </tbody>
            </table>
        </div>

        <div class="form-group">
            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-2" style="width: 70px">
                <input type="submit" id="btnUpdateEvent" name="btnUpdateemployee" required
                       class="btn btn-success" value="Cập nhật">
            </div>
        </div>
    </form>
</div>


<script type="text/javascript">
    $(document).ready(function () {
        $('body').on('click', '#selectAllAccess1', function () {
            if ($(this).hasClass('allChecked')) {
                $('input[type="checkbox"]', '.access1').prop('checked', false);
            } else {
                $('input[type="checkbox"]', '.access1').prop('checked', true);
            }
            $(this).toggleClass('allChecked');
        })

        //

        $('body').on('click', '#selectAllAccess2', function () {
            if ($(this).hasClass('allChecked')) {
                $('input[type="checkbox"]', '.access2').prop('checked', false);
            } else {
                $('input[type="checkbox"]', '.access2').prop('checked', true);
            }
            $(this).toggleClass('allChecked');
        })
    });
</script>

<style>
    input[type=checkbox] {
        margin: 0px 0 0;
        zoom: 1.5;
    }

    .center {
        text-align: center;
    }
</style>