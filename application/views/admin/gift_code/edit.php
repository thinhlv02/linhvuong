<script language="javascript" src="<?php echo base_url('public') ?>/ckeditor/ckeditor.js"
        type="text/javascript"></script>
<div class="page-title">
    <div class="title_left"><h3>Chỉnh sửa thông tin</h3></div>
    <!--    <div class="title_right">-->
    <!--        <div class="col-md-5 col-sm-5 col-xs-12 pull-right">-->
    <!--<!--            <a href="-->
    <?php ////echo admin_url('config_payment/add') ?><!--<!--" class="btn btn-primary btn-sm">Thêm mới</a>-->
    <!--            <a href="-->
    <?php //echo admin_url('config_payment') ?><!--" class="btn btn-info btn-sm">Quay lại danh sách</a>-->
    <!--        </div>-->
    <!--    </div>-->
</div>
<?php if ($message) {
    $this->load->view('admin/message', $this->data);
} ?>
<div class="x_panel">
    <form id="" data-parsley-validate class="form-horizontal form-label-left" method="post"
          enctype="multipart/form-data">
        <div class="form-group">
            <label class="control-label col-md-1 col-sm-1 col-xs-1 text-nowrap" for="first-name">Luồng tiền<span
                        class="required"></span></label>
            <div class="col-md-3 col-sm-3 col-xs-12">
                <select class="select2_group form-control" name="id_money">
                    <?php
                    foreach ($money_id as $value) { ?>
                        <option value="<?php echo $value->id ?>" <?php if ($value->id == $res->id_money) echo 'selected' ?>><?php echo $value->name ?></option>
                    <?php } ?>
                </select>
            </div>

            <label class="control-label col-md-1 col-sm-1 col-xs-1 text-nowrap" for="first-name">Khu vực<span
                        class="required"></span></label>
            <div class="col-md-2 col-sm-2 col-xs-12">
                <select class="select2_group form-control" name="area_id">
                    <?php
                    foreach ($area as $value) { ?>
                        <option value="<?php echo $value->id ?>" <?php if ($value->id == $res->area_id) echo 'selected' ?>><?php echo $value->name ?></option>
                    <?php } ?>
                </select>
            </div>

            <label class="control-label col-md-1 col-sm-1 col-xs-12 text-nowrap" for="first-name">Thời gian<span
                        class="required"></span></label>
            <div class="col-md-1 col-sm-1 col-xs-12">
                <input type="number" name="time" class="form-control" placeholder="Default Input" min="0" value="<?php echo $res->time  ?>">
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-md-1 col-sm-1 col-xs-12 text-nowrap" for="first-name">Giới hạn<span
                        class="required"></span></label>
            <div class="col-md-3 col-sm-3 col-xs-12">
                <input type="number" name="limit" class="form-control" placeholder="Default Input" min="0" value="<?php echo $res->limit  ?>">
            </div>

            <label class="control-label col-md-1 col-sm-1 col-xs-12 text-nowrap" for="first-name">Tỷ lệ(%)<span
                        class="required"></span></label>
            <div class="col-md-2 col-sm-2 col-xs-12">
                <input type="number" name="tyle" class="form-control" placeholder="Default Input" min="0" max="100" value="<?php echo $res->tyle*100  ?>">
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-1 col-sm-1 col-xs-12 col-md-offset-1" style="">
                <input type="submit" id="btnUpdateEvent" name="btnEdit" required
                       class="btn btn-success" value="Cập nhật">
            </div>
            <div class="col-md-3 col-sm-3 col-xs-12">
                <!--            <a href="-->
                <?php //echo admin_url('city/add') ?><!--" class="btn btn-primary btn-sm">Thêm mới</a>-->
                <a href="<?php echo admin_url('config_payment') ?>" class="btn btn-success">Quay lại danh sách</a>
            </div>
        </div>
    </form>
</div>

<script type="text/javascript">
    $(document).ready(function () {
        $('input[type=radio][name=change_baohanh]').change(function () {
            if (this.value == 1) {
                $('#test').show();
                $('#wait_baohanh').hide();
            }
            else if (this.value == 2) {
                $('#test').hide();
                $('#wait_baohanh').show();
            }
        });
    });

    $(document).ready(function () {
        $('input[type=radio][name=change_ngaymua]').change(function () {
            if (this.value == 1) {
                $('#ngaymua').show();
                $('#wait_ngaymua').hide();
            }
            else if (this.value == 2) {
                $('#ngaymua').hide();
                $('#wait_ngaymua').show();
            }
        });
    });


    $(function () {
        $('#baohanh_selector').change(function () {
            $('.baohanhs').hide();
            $('#' + $(this).val()).show();
        });
    });

    $(function () {
        $('#ngaymua_selector').change(function () {
            $('.ngaymuas').hide();
            $('#' + $(this).val()).show();
        });
    });
</script>

<style>
    .col-md-1-5, .col-sm-1-5 {
        width: 12.49995%;
    }

    .col-xs-3-5 {
        width: 29.16655%;
    }
</style>

<!--<html>-->
<!---->
<!--</html>-->