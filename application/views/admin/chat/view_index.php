<?php $menu_access = $this->session->userdata('menu_access'); ?>
<?php if ($message) {
    $this->load->view('admin/message', $this->data);
} ?>
<div class="page-title">
    <div class="title_left"><h3>Logs chat</h3></div>
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

                    <div class="form-group">
                        <label class="control-label col-md-1 col-sm-1 col-xs-12 text-left" for="first-name">user_id
                            <span
                                    class="required">*</span>
                        </label>
                        <div class="col-md-2 col-sm-2 col-xs-12">
                            <input type="number" id="first-name" name="user_id"
                                   value="<?= isset($_POST['user_id']) ? $_POST['user_id'] : '' ?>" min="1"
                                   class="form-control col-md-7 col-xs-12">
                        </div>

                        <label class="control-label col-md-1 col-sm-1 col-xs-12" for="first-name">Tên hiển thị<span
                                    class="required">*</span>
                        </label>
                        <div class="col-md-3 col-sm-3 col-xs-12">
                            <input type="text" id="first-name" name="display_name"
                                   value="<?= isset($_POST['display_name']) ? $_POST['display_name'] : '' ?>"
                                   class="form-control col-md-7 col-xs-12">
                        </div>

                        <div class="col-md-2 col-sm-2 col-xs-12 col-md-offset-0">
                            <input type="submit" class="btn btn-success" name="btnSearch" value="Tìm"/>
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
                        <th>UserID</th>
                        <th>Tên tk</th>
                        <th>Server</th>
                        <th>Nội dung chat</th>
                        <th>Khóa chat</th>
<!--                        <th></th>-->
                    </tr>
                    </thead>

                    <tbody>

                    <?php foreach ($lstdata as $key => $value): ?>
                        <tr>
                            <td><?php echo $value['user_id'] ?></td>
                            <td><?php echo $value['display_name'] ?></td>
                            <td>N/A</td>
                            <td><?php echo $value['content'] ?></td>
                            <td id="btn_lock_chat_<?php echo $value['id'] ?>">
                                <?php if ($value['status'] == 0) { ?>
                                    <button class="label label-danger" onclick="openForm('<?= $value['id'] ?>', '0')">Khóa chat</button>
                                <?php } else { ?>
                                    <button class="label label-primary" onclick="openForm('<?= $value['id'] ?>', '1')">Mỏ chat</button>

                                <?php }  ?>

                                <div class="form-popup" id="myForm-<?php echo $value['id'] ?>">
                                    <form id="send_chat_<?php echo $value['id'] ?>" action="" class="form-container" method="post">

                                        <input type="hidden" name="id" value="<?= $value['id'] ?>"/>
                                        <input type="hidden" name="user_id" value="<?= $value['user_id'] ?>"/>
                                        <input type="text" name="type" value=""/>
                                        <input type="text" name="display_name" class="form-control" value="<?= $value['display_name'] ?>" readonly/>

                                        <div class="form-group">
                                            <textarea rows="4" cols="50" name="content" class="content" form="usrform" required></textarea>
                                        </div>
                                        <div class="form-group">

                                            <!--                                        <input type="hidden" value="123456" name="xxx"/>-->
                                            <button type="submit" class="btn btn-success">Gửi</button>
                                            <button type="button" class="btn btn-danger" onclick="closeForm('<?php echo $value['id'] ?>')">ẩn</button>
                                        </div>

                                    </form>
                                </div>

                            </td>
<!--                            <td>-->
<!--                                -->
<!--                            </td>-->
                        </tr>
                    <?php endforeach ?>

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</div>


<script type="text/javascript">
    function openForm(id, type) {
        $("#btn_lock_chat_"+id).css("position", "relative");
        $("#myForm-"+id).css("position", "absolute");
        $('input[name=type]').val(type);

        $('input.id_chat').val(id);
        // console.log(id);
        console.log(type);
        document.getElementById("myForm-" + id).style.display = "block";


        var _onSuccess = function (data) {
            // console.log(data);
            if (data == 'NOT_LOGIN') {
                window.location.reload(true);
            } else if (data === 'false') {
                alert('Danh mục "' + cat_name + '" không tồn tại!');
            } else {
                console.log(data);
                var result = data.split('-');
                console.log(result[0]);
                // alert( result[2] );
                closeForm(result[0]);

                if (result[2] ==1) {
                    $('#btn_lock_chat_' + result[0]).text('Đã mở nick ' + result[1]);
                    alert('Đã mở nick: ' + result[1]);
                }  else {

                    $('#btn_lock_chat_' + result[0]).text('Đã khóa nick ' + result[1]);

                    alert('Đã khóa nick: ' + result[1]);
                    // $("#content_info").html(data);
                }
            }
        };

        $("#send_chat_" + id).submit(function (e) {
            //prevent Default functionality
            e.preventDefault();
            // console.log('abc');
            var data = $("#send_chat_" + id).serialize();
            var content = $("#send_chat_" + id).find(".content").val();
            data = data + '&content=' + content+ '&server=' + <?php echo $_POST['server'] ?>;
            console.log('data', data);

            getAjax('<?php echo admin_url('chat/ajax_lock_chat') ?>', data, 'POST', _onSuccess);

        });

    }

    function closeForm(id) {
        document.getElementById("myForm-" + id).style.display = "none";
    }
</script>

<style>
    .form-popup {
        display: none;
        /*position: fixed;*/
        bottom: 0;
        right: 15px;
        border: 3px solid #f1f1f1;
        z-index: 9;
    }

    /* Add styles to the form container */
    .form-container {
        max-width: 300px;
        padding: 10px;
        background-color: white;
    }

    /* Full-width input fields */
    .form-container input[type=text], .form-container input[type=password] {
        width: 100%;
        padding: 15px;
        margin: 5px 0 22px 0;
        border: none;
        background: #f1f1f1;
    }

    .form-container input[type=text]:focus, .form-container input[type=password]:focus {
        background-color: #ddd;
        outline: none;
    }
</style>