<?php $menu_access = $this->session->userdata('menu_access'); ?>
<?php if ($message) {
    $this->load->view('admin/message', $this->data);
} ?>
<div class="page-title">
    <div class="title_left text-nowrap"><h3>Thống kê tổng quan</h3></div>

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
                        <select class="select2_group form-control" name="server" onchange="get_lst_type(this)">

                            <?php foreach ($server_cf as $key => $value) { ?>
                                <option value="<?= $key ?>" <?php if (isset($_POST['server']) && $_POST['server'] == $key) echo 'selected' ?>>
                                    <?php echo $value['name'] ?>
                                </option>
                            <?php } ?>

                        </select>
                    </div>

                    <div class="col-md-2 col-sm-2 col-xs-12 col-md-offset-0">
                        <input type="submit" class="btn btn-success" name="btnSearch" value="Tìm"/>
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
                        <th>Thời gian</th>
                        <th>Import</th>
                        <th>Build</th>
                        <th>Active</th>
                        <th>Highest online</th>
                        <th>ave online</th>
                        <th>next day retention (R-0)</th>
                        <th>Three day retention (R_3)</th>
                        <th>sevent day retention (R_7)</th>
                        <th>total recharge</th>
                        <th>total recharge gold</th>
                        <th>extra gold</th>
                        <th>total times</th>
                        <th>total numbers</th>
                        <th>New pay number</th>
                        <th>ARPU</th>
                        <th>ARPPU</th>
                    </tr>
                    </thead>

                    <tbody>

                    <?php foreach ($lstdata as $key => $value): ?>
                        <tr>
                            <td class="text-nowrap"><?php echo date('d-m-Y', strtotime($value->time)) ?></td>
                            <td><?php echo number_format($value->import) ?></td>
                            <td><?php echo number_format($value->build) ?></td>
                            <td><?php echo number_format($value->active) ?></td>
                            <td><?php echo number_format($value->highest_online) ?></td>
                            <td><?php echo number_format($value->ave_online) ?></td>
                            <td><?php echo number_format($value->a0) ?></td>
                            <td><?php echo number_format($value->a3) ?></td>
                            <td><?php echo number_format($value->a7) ?></td>
                            <td><?php echo number_format($value->total_recharge) ?></td>
                            <td><?php echo number_format($value->total_recharge_gold) ?></td>
                            <td><?php echo number_format($value->extra_gold) ?></td>
                            <td><?php echo number_format($value->total_times) ?></td>
                            <td><?php echo number_format($value->total_numbers) ?></td>
                            <td><?php echo number_format($value->newpay_number) ?></td>
                            <td><?php echo number_format($value->arpu) ?></td>
                            <td><?php echo number_format($value->arppu) ?></td>

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
