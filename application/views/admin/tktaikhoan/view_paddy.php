<div class="page-title">
    <div class="title_left"><h3>Thống kê tài lúa</h3></div>
    <div class="title_right">

    </div>
</div>

<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <form id="formAddProduct_paddy" data-parsley-validate class="form-horizontal form-label-left" method="post"
                  enctype="multipart/form-data">
                <div class="form-group">

                    <label class="control-label col-md-1 col-sm-1 col-xs-12" for="first-name">Chọn<span
                                class="required">*</span></label>
                    <div class="col-md-1 col-sm-1 col-xs-12">
                        <select class="select2_group form-control" onchange="get_val(this)" name="type">
                            <option value="1">Tất cả</option>
                            <option value="2">Chọn thời gian</option>
                        </select>
                    </div>

                    <div id="select_date">

                        <label class="control-label col-md-1 col-sm-1 col-xs-2" for="first-name">Bắt đầu<span
                                    class="required">*</span></label>
                        <div class="col-md-2 col-sm-2 col-xs-12">
                            <!--                <span style="float: left;margin-top: 7px">Từ ngày: </span>-->
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <input type="text" id="txtFrom" name="txtFrom" required
                                       class="form-control col-md-7 col-xs-12"
                                       value="<?php if (isset($_POST['txtFrom'])) echo $_POST['txtFrom'] ?>">
                            </div>
                        </div>

                        <label class="control-label col-md-1 col-sm-1 col-xs-2" for="first-name">kết thúc<span
                                    class="required">*</span></label>
                        <div class="col-md-2 col-sm-2 col-xs-12">
                            <!--                <span style="float: left;margin-top: 7px">Từ ngày: </span>-->
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <input type="text" id="txtTo" name="txtTo" required
                                       class="form-control col-md-7 col-xs-12"
                                       value="<?php if (isset($_POST['txtTo'])) echo $_POST['txtTo'] ?>">
                            </div>
                        </div>
                    </div>

                    <div class="col-md-2 col-sm-2 col-xs-12">
                        <input type="submit" id="btnAddEvent" name="btnAddEvent" class="btn btn-success"
                               value="Tìm">
                    </div>


                </div>


            </form>

            <div id="paddy_table"></div>

        </div>


    </div>
</div>

<script>
    $(document).ready(function () {
        $('#select_date').hide().find('input, textarea').prop('disabled', true);
    });

    function get_val(sel) {
        if (sel.value == 2) {
            $('#select_date').show().find('input, textarea').prop('disabled', false);
        } else {
            $('#select_date').hide().find('input, textarea').prop('disabled', true);
        }
        // $('#select_date').hide().find('input, textarea').prop('disabled', true);

        // alert(sel.value);

    }
</script>

