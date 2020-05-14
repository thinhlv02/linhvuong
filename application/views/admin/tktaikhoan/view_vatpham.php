

<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
<!--                --><?php //pre($lstdata) ?>
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
                        <th>ID</th>
                        <th>Username</th>
                        <th>Nguồn</th>
                        <th>Kênh nạp</th>
                        <th>Vàng cũ</th>
                        <th>Vàng mới</th>
                        <th>thay đổi</th>
                    </tr>
                    </thead>

                    <tbody>

                    <?php foreach ($lstdata as $key => $value): ?>
                        <tr>
                            <td><?php echo $value->user_id ?></td>
                            <td><?php echo $value->username ?></td>
                            <td><?php echo $value->description_gold ?></td>
                            <td>N/A</td>
                            <td><?php echo number_format($value->gold_old) ?></td>
                            <td><?php echo number_format($value->gold_new) ?></td>
                            <td><?php echo number_format( $value->gold_update) ?></td>
                        </tr>
                    <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
