<?php $menu_access = $this->session->userdata('menu_access'); ?>
<?php //if ($message) {
//    $this->load->view('admin/message', $this->data);
//} ?>
<div class="page-title">
    <div class="title_left"><h3>Thống kê tài khoản</h3></div>
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
                <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" method="post">

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

                        <label class="control-label col-md-1 col-sm-1 col-xs-12 text-left" for="first-name">userid
                            <span
                                    class="required">*</span>
                        </label>
                        <div class="col-md-2 col-sm-2 col-xs-12">
                            <input type="number" id="first-name" name="userid"
                                   value="<?= isset($_POST['userid']) ? $_POST['userid'] : '' ?>" min="1"
                                   class="form-control col-md-7 col-xs-12">
                        </div>

                        <label class="control-label col-md-1 col-sm-1 col-xs-12" for="first-name">Username<span
                                    class="required">*</span>
                        </label>
                        <div class="col-md-2 col-sm-2 col-xs-12">
                            <input type="text" id="first-name" name="nick"
                                   value="<?= isset($_POST['nick']) ? $_POST['nick'] : '' ?>"
                                   class="form-control col-md-7 col-xs-12">
                        </div>

                        <label class="control-label col-md-1 col-sm-1 col-xs-12" for="first-name">Vip<span
                                    class="required">*</span>
                        </label>
                        <div class="col-md-2 col-sm-2 col-xs-12">
                            <input type="number" id="first-name" name="vip"
                                   value="<?= isset($_POST['vip']) ? $_POST['vip'] : '' ?>"
                                   class="form-control col-md-7 col-xs-12">
                        </div>


                        <div class="form-group">

                            <div class="col-md-2 col-sm-2 col-xs-12 col-md-offset-0">
                                <input type="submit" class="btn btn-success" name="btnSearch" value="Tìm"/>
                            </div>
                        </div>


                    </div>



                    <!--                    <div class="ln_solid"></div>-->
                    <!--                    <div class="form-group">-->
                    <!--                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">-->
                    <!--                            <input type="submit" class="btn btn-success" name="btnSearch" value="Tìm"/>-->
                    <!--                        </div>-->
                    <!--                    </div>-->

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
                <h2>Danh sách (<?php if (isset($lstdata)) echo count($lstdata) ?>)</h2>
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
                        <th>display name</th>
                        <th>Platform</th>
                        <th>Vip</th>
                        <th>Level</th>
                        <th>Exp</th>
                        <th>Vàng</th>
                        <th>Createtime</th>
                        <th>Last login</th>
                        <th>Whether online</th>
                    </tr>
                    </thead>

                    <tbody>

                    <?php foreach ($lstdata as $key => $value): ?>
                        <tr>
                            <td><?php echo $value['userid'] ?></td>
                            <td><?php echo $value['nick'] ?></td>
                            <td><?php echo $value['display_name'] ?></td>
                            <td><?php echo $value['platform'] ?></td>
                            <td><?php echo $value['vip'] ?></td>
                            <td><?php echo $value['level'] ?></td>
                            <td><?php echo number_format($value['exp']) ?></td>
                            <td><?php echo number_format($value['gold']) ?></td>
                            <td><?php echo $value['created_at'] ?></td>
                            <td><?php echo $value['logouttime'] ?></td>
                            <td>N/A</td>
                        </tr>
                    <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!--button click 5 tác vụ-->
<?php if ($user_id_check_logs != 0 ) { ?>
        <div class="row">
            <div class="col-md-12">
                <div class="x_panel">

                    <div class="x_content">
                        <a href="javascript:void(0)" class="btn btn-primary"
                           onclick="f_ajax('<?= $user_id_check_logs ?>', 'gold', '<?= isset($_POST['server']) ? $_POST['server'] : 1 ?>')">Tk Vàng</a>
                        <a href="javascript:void(0)" class="btn btn-success"
                           onclick="f_ajax('<?= $user_id_check_logs ?>', 'silver', '<?= isset($_POST['server']) ? $_POST['server'] : 1 ?>')">Tk Bạc </a>
                        <a href="javascript:void(0)" class="btn btn-info"
                           onclick="f_ajax('<?= $user_id_check_logs ?>', 'paddy', '<?= isset($_POST['server']) ? $_POST['server'] : 1 ?>')">Tk Lúa</a>
                        <a href="javascript:void(0)" class="btn btn-warning"
                           onclick="f_ajax('<?= $user_id_check_logs ?>', 'binhchung', '<?= isset($_POST['server']) ? $_POST['server'] : 1 ?>')">Tk binh chủng</a>
                        <a href="javascript:void(0)" class="btn btn-danger"
                           onclick="f_ajax('<?= $user_id_check_logs ?>', 'gem', '<?= isset($_POST['server']) ? $_POST['server'] : 1 ?>')">Tk Ngọc</a>

                        <a href="javascript:void(0)" class="btn btn-default"
                           onclick="f_ajax('<?= $user_id_check_logs ?>', 'horse', '<?= isset($_POST['server']) ? $_POST['server'] : 1 ?>')">Ngựa</a>

                        <a href="javascript:void(0)" class="btn btn-primary"
                           onclick="f_ajax('<?= $user_id_check_logs ?>', 'book', '<?= isset($_POST['server']) ? $_POST['server'] : 1 ?>')">Sách</a>

                        <a href="javascript:void(0)" class="btn btn-success"
                           onclick="f_ajax('<?= $user_id_check_logs ?>', 'quan_gioi', '<?= isset($_POST['server']) ? $_POST['server'] : 1 ?>')">Quân giới</a>

                    </div>

                </div>


            </div>


        </div>
    <?php } ?>

<!--// replace ajax-->
<div id="content_info"></div>
<!--// replace ajax-->

<!--button click 5 tác vụ-->

<script type="text/javascript">
    function f_ajax(userid, type,server) {


        var _onSuccess_index = function (data) {
            // console.log(data);
            // $("#question").html('');
            if (data == 'NOT_LOGIN') {
                window.location.reload(true);
            } else if (data === 'false') {
                alert('Danh mục "' + cat_name + '" không tồn tại!');
            } else {
                // console.log(data);
                $("#content_info").html(data);

                $('#txtFrom').daterangepicker({
                    singleDatePicker: true,
                    calender_style: "picker_4",
                    locale: {
                        format: 'DD-MM-YYYY'
                    }
                }, function (start, end, label) {
                    console.log(start.toISOString(), end.toISOString(), label);
                });

                $('#txtTo').daterangepicker({
                    singleDatePicker: true,
                    calender_style: "picker_4",
                    locale: {
                        format: 'DD-MM-YYYY'
                    }
                }, function (start, end, label) {
                    console.log(start.toISOString(), end.toISOString(), label);
                });


                //submit form gold
                $("#formAddProduct_gold").submit(function (e) {
                    //prevent Default functionality
                    e.preventDefault();
                    // console.log('formAddProduct_gold111111111 =>>>>>> ' + userid);
                    var data = $("#formAddProduct_gold").serialize() + '&userid=' + userid + '&server='+server;

                    console.log('data =>>> gold => ' + data);


                    getAjax('<?php echo admin_url('tktaikhoan/ajax_gold') ?>', data, 'POST', _onSuccess_gold);

                });

                //submit form silver
                $("#formAddProduct_silver").submit(function (e) {
                    //prevent Default functionality
                    e.preventDefault();
                    // console.log('abc');
                    var data = $("#formAddProduct_silver").serialize() + '&userid=' + userid+ '&server='+server;
                    // console.log('data silver ' + data);

                    getAjax('<?php echo admin_url('tktaikhoan/ajax_silver') ?>', data, 'POST', _onSuccess_silver);

                });

                //submit form paddy
                $("#formAddProduct_paddy").submit(function (e) {
                    //prevent Default functionality
                    e.preventDefault();
                    // console.log('abc');
                    var data = $("#formAddProduct_paddy").serialize() + '&userid=' + userid+ '&server='+server;
                    // console.log('data silver ' + data);

                    getAjax('<?php echo admin_url('tktaikhoan/ajax_paddy') ?>', data, 'POST', _onSuccess_paddy);

                });

                //formAddProduct_binhchung

                $("#formAddProduct_binhchung").submit(function (e) {
                    //prevent Default functionality
                    e.preventDefault();
                    console.log('formAddProduct_binhchung');
                    var data = $("#formAddProduct_binhchung").serialize() + '&userid=' + userid+ '&server='+server;
                    console.log('binhchung');

                    getAjax('<?php echo admin_url('tktaikhoan/ajax_binhchung') ?>', data, 'POST', _onSuccess_binhchung);

                });

                //submit form paddy
                $("#formAddProduct_gem").submit(function (e) {
                    //prevent Default functionality
                    e.preventDefault();
                    // console.log('abc');
                    var data = $("#formAddProduct_gem").serialize() + '&userid=' + userid+ '&server='+server;
                    // console.log('data silver ' + data);

                    getAjax('<?php echo admin_url('tktaikhoan/ajax_gem') ?>', data, 'POST', _onSuccess_gem);

                });


                //submit form paddy
                $("#formAddProduct_horse").submit(function (e) {
                    //prevent Default functionality
                    e.preventDefault();
                    // console.log('abc');
                    var data = $("#formAddProduct_horse").serialize() + '&userid=' + userid+ '&server='+server;
                    // console.log('data silver ' + data);

                    getAjax('<?php echo admin_url('tktaikhoan/ajax_horse') ?>', data, 'POST', _onSuccess_horse);

                });

                //submit form paddy
                $("#formAddProduct_book").submit(function (e) {
                    //prevent Default functionality
                    e.preventDefault();
                    // console.log('abc');
                    var data = $("#formAddProduct_book").serialize() + '&userid=' + userid+ '&server='+server;
                    // console.log('data silver ' + data);

                    getAjax('<?php echo admin_url('tktaikhoan/ajax_book') ?>', data, 'POST', _onSuccess_book);

                });

                //submit form paddy
                $("#formAddProduct_quan_gioi").submit(function (e) {
                    //prevent Default functionality
                    e.preventDefault();
                    // console.log('abc');
                    var data = $("#formAddProduct_quan_gioi").serialize() + '&userid=' + userid+ '&server='+server;
                    // console.log('data silver ' + data);

                    getAjax('<?php echo admin_url('tktaikhoan/ajax_quan_gioi') ?>', data, 'POST', _onSuccess_quan_gioi);

                });



            }
        };

        var params = {
            'userid': userid,
            'type': type,
        };

        // console.log(params);

        getAjax('<?php echo admin_url('tktaikhoan/ajax_logs') ?>', params, 'POST', _onSuccess_index);

        var _onSuccess_gold = function (data) {
            console.log(data);
            // $("#question").html('');
            if (data == 'NOT_LOGIN') {
                window.location.reload(true);
            } else if (data === 'false') {
                alert('Danh mục "' + cat_name + '" không tồn tại!');
            } else {
                // console.log(data);
                $("#gold_table").html(data);
            }
        };

        var _onSuccess_silver = function (data) {
            console.log(data);
            // $("#question").html('');
            if (data == 'NOT_LOGIN') {
                window.location.reload(true);
            } else if (data === 'false') {
                alert('Danh mục "' + cat_name + '" không tồn tại!');
            } else {
                console.log(data);
                $("#silver_table").html(data);
            }
        };//

        var _onSuccess_paddy = function (data) {
            console.log(data);
            // $("#question").html('');
            if (data == 'NOT_LOGIN') {
                window.location.reload(true);
            } else if (data === 'false') {
                alert('Danh mục "' + cat_name + '" không tồn tại!');
            } else {
                console.log(data);
                $("#paddy_table").html(data);
            }
        };//

        var _onSuccess_binhchung = function (data) {
            // console.log(data);
            $("#question").html('');
            if (data == 'NOT_LOGIN') {
                window.location.reload(true);
            } else if (data === 'false') {
                alert('Danh mục "' + cat_name + '" không tồn tại!');
            } else {
                // console.log(data);
                $("#binhchung_table").html(data);
            }
        };


        var _onSuccess_gem = function (data) {
            console.log(data);
            // $("#question").html('');
            if (data == 'NOT_LOGIN') {
                window.location.reload(true);
            } else if (data === 'false') {
                alert('Danh mục "' + cat_name + '" không tồn tại!');
            } else {
                console.log(data);
                $("#gem_table").html(data);
            }
        };//

        var _onSuccess_horse = function (data) {
            console.log(data);
            // $("#question").html('');
            if (data == 'NOT_LOGIN') {
                window.location.reload(true);
            } else if (data === 'false') {
                alert('Danh mục "' + cat_name + '" không tồn tại!');
            } else {
                console.log(data);
                $("#horse_table").html(data);
            }
        };//

        var _onSuccess_book = function (data) {
            console.log(data);
            // $("#question").html('');
            if (data == 'NOT_LOGIN') {
                window.location.reload(true);
            } else if (data === 'false') {
                alert('Danh mục "' + cat_name + '" không tồn tại!');
            } else {
                console.log(data);
                $("#book_table").html(data);
            }
        };//

        var _onSuccess_quan_gioi = function (data) {
            console.log(data);
            // $("#question").html('');
            if (data == 'NOT_LOGIN') {
                window.location.reload(true);
            } else if (data === 'false') {
                alert('Danh mục "' + cat_name + '" không tồn tại!');
            } else {
                console.log(data);
                $("#quan_gioi_table").html(data);
            }
        };//





    }
</script>
