<?php if (isset($message)) {
    $this->load->view('admin/message', $this->data);
}
//pre($ccu);
?>
<div class="page-title">
    <div class="title_left"><h3>Biểu đồ CCU</h3></div>
    <div class="title_right">
        <!--        <div class="col-md-6 col-sm-6 col-xs-12 pull-right">-->
        <!--            <a href="-->
        <?php //echo admin_url('admin/add') ?><!--" class="btn btn-primary btn-sm">Thêm mới</a>-->
        <!--            <a href="-->
        <?php //echo admin_url('admin') ?><!--" class="btn btn-info btn-sm">Quay lại danh sách</a>-->
        <!--        </div>-->
    </div>
</div>
<div class="x_panel">
    <div class="x_title">
        <!--        <h2>Danh sách bài đăng(--><?php //echo count($res) ?><!--)</h2>-->
        <div class="col-md-6 col-sm-6 col-xs-12 pull-left">
<!--            <a href="--><?php //echo admin_url('notifications/add') ?><!--" class="btn btn-primary btn-sm">Thêm mới</a>-->
            <!--            <a href="-->
            <?php //echo admin_url('admin') ?><!--" class="btn btn-info btn-sm">Quay lại danh sách</a>-->
        </div>
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
        <form method="post">
            <!--        <div class="col-md-2 col-sm-2 col-xs-12">-->
            <div class="form-group">
                <label class="control-label col-md-1 col-sm-1 col-xs-12 text-nowrap" for="first-name">Từ ngày<span
                            class="required"></span></label>
                <div class="col-md-2 col-sm-2 col-xs-12">
                    <input type="text" id="txtFrom" name="date1" required
                           value="<?php if (isset($_POST['date1'])) echo date('d-m-Y', strtotime($_POST['date1'])) ?>"
                           class="form-control col-md-7 col-xs-12" />
                </div>

                <label class="control-label col-md-1 col-sm-1 col-xs-12 text-nowrap" for="first-name">Đến ngày<span
                            class="required"></span></label>
                <div class="col-md-2 col-sm-2 col-xs-12">
                    <input type="text" id="txtTo" name="date2" required
                           value="<?php if (isset($_POST['date2'])) echo date('d-m-Y', strtotime($_POST['date2'])) ?>"
                           class="form-control col-md-7 col-xs-12">
                </div>
            </div>
            <!--                <div class="ln_solid"></div>-->
            <div class="form-group">
                <div class="col-md-2 col-sm-2 col-xs-12">
                    <div class="col-md-12 col-sm-12 col-xs-12 pull-left" id="new-search-area"></div>
                </div>
                <div class="col-xs-1 col-xs-1">
                    <input type="submit" class="btn btn-success btn-sm" name="search" value="Tìm kiếm"/>
                </div>
            </div>

            <!--                <div class="col-xs-1 col-xs-1">-->
            <!--                    --><?php //if (isset($res) && count($res) > 0) { ?>
            <!--                        <input type="submit" id="" name="btn_excel" required-->
            <!--                               class="btn btn-primary btn-sm" value="Xuất excel">-->
            <!--                    --><?php //} ?>
            <!--                </div>-->
        </form>
    </div>

    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/series-label.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>

    <div id="container"></div>

    <script>

        Highcharts.chart('container', {

            title: {
                text: 'Biểu đồ CCU theo thời gian'
            },

            // subtitle: {
            //     text: 'Tạo bởi admin'
            // },

            yAxis: {
                title: {
                    text: 'Số lượng người online'
                }
            },
            legend: {
                layout: 'vertical',
                align: 'right',
                verticalAlign: 'middle'
            },

            // plotOptions: {
            //     series: {
            //         label: {
            //             connectorAllowed: false
            //         },
            //         pointStart: 2
            //     }
            // },

            xAxis: {
                // categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
                //     'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
                categories: [
                    <?php
                    //                    foreach ($new_user1 as $value) {
                    //                        echo date('d', strtotime($value)) . ',';
                    //                    }
                    foreach ($ccu as $time) {
//                        pre($time). '<br />';
//                        $date_new = $dt->format("Y-m-d");
                        echo '"' . date("H:i:s", strtotime($time->TIME)) . '"' . ',';
//                       echo $time->TIME.',';
                    }
                    ?>
                ]
            },

            series: [{
                name: 'Tổng',
                // data: [43, 52, 57, 69, 97, 111, 113, 115]
                data: [
                    <?php
                    foreach ($ccu as $time) {
                        echo $time->ccutong. ',';
                    }
                    ?>
                ]
            },{
                name: 'Kỹ thuật viên',
                // data: [43, 52, 57, 69, 97, 111, 113, 115]
                data: [
                    <?php
                    foreach ($ccu as $time) {
                       echo $time->ccu_ktv. ',';
                    }
                    ?>
                ]

            },{
                name: 'Khách hàng',
                // data: [43, 52, 57, 69, 97, 111, 113, 115]
                data: [
                    <?php
                    foreach ($ccu as $time) {
                        echo $time->ccu_users. ',';
                    }
                    ?>
                ]
            }],

            responsive: {
                rules: [{
                    condition: {
                        maxWidth: 500
                    },
                    chartOptions: {
                        legend: {
                            layout: 'horizontal',
                            align: 'center',
                            verticalAlign: 'bottom'
                        }
                    }
                }]
            }

        });
    </script>

<!--    action user-->
    <div id="container2"></div>

    <script>

        Highcharts.chart('container2', {

            title: {
                text: 'Biểu đồ CCU hoạt động theo khu vực'
            },

            // subtitle: {
            //     text: 'Tạo bởi admin'
            // },

            yAxis: {
                title: {
                    text: 'Số lượng người online'
                }
            },
            legend: {
                layout: 'vertical',
                align: 'right',
                verticalAlign: 'middle'
            },

            // plotOptions: {
            //     series: {
            //         label: {
            //             connectorAllowed: false
            //         },
            //         pointStart: 2
            //     }
            // },

            xAxis: {
                // categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
                //     'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
                categories: [
                    <?php
                    //                    foreach ($new_user1 as $value) {
                    //                        echo date('d', strtotime($value)) . ',';
                    //                    }
                    foreach ($ccu as $time) {
//                        pre($time). '<br />';
//                        $date_new = $dt->format("Y-m-d");
                        echo '"' . date("H:i:s", strtotime($time->TIME)) . '"' . ',';
//                       echo $time->TIME.',';
                    }
                    ?>
                ]
            },

            series: [{
                name: 'Tổng',
                // data: [43, 52, 57, 69, 97, 111, 113, 115]
                data: [
                    <?php
                    foreach ($ccu as $time) {
                        echo $time->ccutong. ',';
                    }
                    ?>
                ]
            },{
                name: 'Map',
                // data: [43, 52, 57, 69, 97, 111, 113, 115]
                data: [
                    <?php
                    foreach ($ccu as $time) {
                        echo $time->map. ',';
                    }
                    ?>
                ]

            },{
                name: 'cứu hộ',
                // data: [43, 52, 57, 69, 97, 111, 113, 115]
                data: [
                    <?php
                    foreach ($ccu as $time) {
                        echo $time->cuuho. ',';
                    }
                    ?>
                ]
            },{
                name: 'gói dịch vụ',
                // data: [43, 52, 57, 69, 97, 111, 113, 115]
                data: [
                    <?php
                    foreach ($ccu as $time) {
                        echo $time->goidichvu. ',';
                    }
                    ?>
                ]

            },{
                name: 'vật tư',
                // data: [43, 52, 57, 69, 97, 111, 113, 115]
                data: [
                    <?php
                    foreach ($ccu as $time) {
                        echo $time->vattu. ',';
                    }
                    ?>
                ]

            },{
                name: 'tìm thợ',
                // data: [43, 52, 57, 69, 97, 111, 113, 115]
                data: [
                    <?php
                    foreach ($ccu as $time) {
                        echo $time->timtho. ',';
                    }
                    ?>
                ]

            },{
                name: 'đăng ký cộng tác viên',
                // data: [43, 52, 57, 69, 97, 111, 113, 115]
                data: [
                    <?php
                    foreach ($ccu as $time) {
                        echo $time->dkctv. ',';
                    }
                    ?>
                ]

            },{
                name: 'naptien',
                // data: [43, 52, 57, 69, 97, 111, 113, 115]
                data: [
                    <?php
                    foreach ($ccu as $time) {
                        echo $time->naptien. ',';
                    }
                    ?>
                ]

            },{
                name: 'km',
                // data: [43, 52, 57, 69, 97, 111, 113, 115]
                data: [
                    <?php
                    foreach ($ccu as $time) {
                        echo $time->km. ',';
                    }
                    ?>
                ]

            },{
                name: 'Khác',
                // data: [43, 52, 57, 69, 97, 111, 113, 115]
                data: [
                    <?php
                    foreach ($ccu as $time) {
                        echo $time->other. ',';
                    }
                    ?>
                ]

            },],

            responsive: {
                rules: [{
                    condition: {
                        maxWidth: 500
                    },
                    chartOptions: {
                        legend: {
                            layout: 'horizontal',
                            align: 'center',
                            verticalAlign: 'bottom'
                        }
                    }
                }]
            }

        });
    </script>
<!--    action user-->
</div>

<!--table 1-->

<div class="row">
    <div class="col-md-6 col-sm-6 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>CCU theo thiết bị</h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="#">Settings 1</a>
                            </li>
                            <li><a href="#">Settings 2</a>
                            </li>
                        </ul>
                    </li>
                    <li><a class="close-link"><i class="fa fa-close"></i></a>
                    </li>
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <table id="datatable-banner" class="table table-striped table-bordered bulk_action">
                    <thead>
                    <tr>
                        <th>Tổng</th>
                        <th>android</th>
                        <th>ios</th>
                        <th>web</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($ccu_device as $row){

                        $tags = explode(',', $row->ccu_info);
                        $android = '';
                        $ios = '';
                        $ccu_web = '';
                        foreach ($tags as $key2 => $value2) {
                            if (isset($value2[0]) && $value2[0] != '') {
                                $android = explode(':', $value2[0])[0];
//                        $ccu_arr[$i]->android = explode(':', $value2[0])[1];
                            }
                            if (isset($value2[1]) && $value2[1] != '') {
                                $ios = explode(':', $value2[1])[0];
                            }
                            if (isset($value2[2]) && $value2[2] != '') {
                                $ccu_web = explode(':', $value2[2])[0];
                            }
                        }
                        ?>
                        <tr>
                            <td><?php echo $row->ccu ?></td>
                            <td><?php echo $android?></td>
                            <td><?php echo $ios?></td>
                            <td><?php echo $ccu_web?></td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>

    </div>

    <div class="col-md-6 col-sm-6 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>CCU hiện tại</h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="#">Settings 1</a>
                            </li>
                            <li><a href="#">Settings 2</a>
                            </li>
                        </ul>
                    </li>
                    <li><a class="close-link"><i class="fa fa-close"></i></a>
                    </li>
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <table id="datatable-banner" class="table table-striped table-bordered bulk_action">
                    <thead>
                    <tr>
                        <th>Tổng</th>
                        <th>Khách hàng</th>
                        <th>Kỹ thuật  viên</th>
                        <th>Chăm sóc KH</th>
                        <th>Cộng tác viên</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($ccu_device as $row){  ?>
                        <tr>
                            <td><?php echo $row->ccu ?></td>
                            <td><?php echo $row->ccu_users?></td>
                            <td><?php echo $row->ccu_ktv?></td>
                            <td><?php echo $row->ccu_cskh?></td>
                            <td><?php echo $row->ccu_ctv?></td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>

<!--table 1-->

<!--table2-->


<!--table2-->

<style>
    /*#container {*/
        /*min-width: 310px;*/
        /*max-width: 800px;*/
        /*height: 400px;*/
        /*margin: 0 auto*/
    /*}*/
</style>