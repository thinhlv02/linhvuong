<?php $menu_access = $this->session->userdata('menu_access'); ?>
<?php if ($message) {
    $this->load->view('admin/message', $this->data);
} ?>
<div class="page-title">
    <div class="title_left"><h3>Thống kê level</h3></div>
    <div class="title_right">
        <div class="col-md-6 col-sm-6 col-xs-12 pull-right">

        </div>
    </div>
</div>
<!--form-->
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_content">
                <br/>
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

                        <label class="control-label col-md-1 col-sm-1 col-xs-12 text-left text-nowrap" for="first-name">Bắt đầu<span
                                    class="required">*</span></label>
                        <div class="col-md-2 col-sm-2 col-xs-12">
                            <!--                <span style="float: left;margin-top: 7px">Từ ngày: </span>-->

                                <input type="text" id="txtTo3" name="txtFrom" required
                                       class="form-control col-md-7 col-xs-12"
                                       value="<?php if (isset($_POST['txtFrom'])) echo $_POST['txtFrom'] ?>">

                        </div>

                        <label class="control-label col-md-1 col-sm-1 col-xs-2 text-left text-nowrap" for="first-name">kết thúc<span
                                    class="required">*</span></label>
                        <div class="col-md-2 col-sm-2 col-xs-12">
                            <!--                <span style="float: left;margin-top: 7px">Từ ngày: </span>-->

                            <input type="text" id="txtTo4" name="txtTo" required
                                   class="form-control col-md-7 col-xs-12"
                                   value="<?php if (isset($_POST['txtTo'])) echo $_POST['txtTo'] ?>">

                        </div>

                        <div class="col-md-6 col-sm-6 col-xs-12 " style="width: 70px">
                            <input type="submit" id="btnAddEvent" name="btnAddSearch" class="btn btn-success"
                                   value="Tìm">
                        </div>
                    </div>

                    <div class="form-group">

                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!--end form-->
<?php //pre($lstdata) ?>
<?php if (!empty($max_level)) { ?>


    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Danh sách</h2>
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
                            <th>Cấp độ/ vip</th>
                            <th>Total</th>

                            <?php foreach ($args as $vip => $levels): ?>

                                <th><?php echo $vip; ?></th>

                            <?php endforeach ?>

                        </tr>
                        </thead>

                        <tbody>


                        <?php for ($i = 0; $i <= $max_level; $i++) { ?>
                            <tr>
                                <td><?php echo $i; ?></td>
                                <td>
                                    <?php echo isset($total_levels[$i]) ? $total_levels[$i] : 0; ?>

                                </td>


                                <td>
                                    <?php echo isset($levels[$i]) ? $levels[$i] : 0; ?>

                                </td>


                            </tr>
                        <?php } ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

<?php } ?>


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
