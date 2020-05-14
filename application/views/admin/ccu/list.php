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
            <!--            <a href="-->
            <?php //echo admin_url('notifications/add') ?><!--" class="btn btn-primary btn-sm">Thêm mới</a>-->
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

                <label class="control-label col-md-1 col-sm-1 col-xs-12 text-nowrap" for="first-name">Từ ngày<span
                            class="required"></span></label>
                <div class="col-md-2 col-sm-2 col-xs-12">
                    <input type="text" id="txtTo3" name="date1" required
                           value="<?php if (isset($_POST['date1'])) echo date('d-m-Y', strtotime($_POST['date1'])) ?>"
                           class="form-control col-md-7 col-xs-12"/>
                </div>

                <label class="control-label col-md-1 col-sm-1 col-xs-12 text-nowrap" for="first-name">Đến ngày<span
                            class="required"></span></label>
                <div class="col-md-2 col-sm-2 col-xs-12">
                    <input type="text" id="txtTo4" name="date2" required
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


    <script type="text/javascript" src="<?php echo base_url(); ?>public/scripts/ckeditor/ckeditor.js"></script>

    <script src="<?php echo base_url(); ?>public/js/highcharts/highcharts.js"></script>


    <div id="container"></div>
    <div id="container2"></div>

    <?php if (isset($go) && $go < 3) { ?>
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
                            echo $time->ccutong . ',';
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
    <?php } ?>


    <?php if (isset($go) && $go > 2) { ?>
        <script>

            //chart 2

            Highcharts.chart('container2', {
                chart: {
                    type: 'column'
                },
                title: {
                    text: 'Biểu đồ CCU cột theo ngày'
                },
                subtitle: {
                    // text: 'Source: WorldClimate.com'
                },
                xAxis: {
                    categories: [
                        <?php
                        foreach ($ccu as $time) {
                            echo '"' . date("d-m-Y", strtotime($time->TIME)) . '"' . ',';
                        }
                        ?>
                    ],
                    crosshair: true
                },
                yAxis: {
                    min: 0,
                    title: {
                        text: 'Rainfall (mm)'
                    }
                },
                tooltip: {
                    headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                    pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                        '<td style="padding:0"><b>{point.y:.1f} mm</b></td></tr>',
                    footerFormat: '</table>',
                    shared: true,
                    useHTML: true
                },
                plotOptions: {
                    column: {
                        pointPadding: 0.2,
                        borderWidth: 0
                    }
                },
                series: [{
                    name: 'CCU max',
                    data: [
                        <?php
                        foreach ($ccu as $time) {
                            echo $time->ccutong . ',';
                        }
                        ?>

                    ]

                }, {
                    name: 'CCU min',
                    data: [
                        <?php
                        foreach ($ccu as $time) {
                            echo $time->ccu_min . ',';
                        }
                        ?>

                    ]

                }]
            });
        </script>

    <?php } ?>


</div>

<!--table 1-->

<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>CCU theo thiết bị</h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                           aria-expanded="false"><i class="fa fa-wrench"></i></a>
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
                        <th>Ngày</th>
                        <th colspan="4" class="text-center">CCU cao điểm</th>
                        <th rowspan="3">Trung bình</th>
                    </tr>
                    <tr>
                        <th rowspan="2"></th>
                        <th>Thời gian</th>
                        <th>Số lượng</th>
                        <th colspan="2" class="text-center">Thiết bị</th>
                    </tr>
                    <tr>
                        <th colspan="2"></th>
                        <th>Android</th>
                        <th>Ios</th>
                    </tr>
                    </thead>
                    <tbody>

                    <?php foreach ($ccu_arr_custom as $row) {
                        $avg = ($row->ios + $row->android) / 2;
                        ?>
                        <tr>
                            <td><?php echo $row->date ?></td>
                            <td><?php echo $row->time ?></td>
                            <td><?php echo $row->total ?></td>
                            <td><?php echo $row->android ?></td>
                            <td><?php echo $row->ios ?></td>
                            <td><?php echo $avg ?></td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>

    </div>


</div>
