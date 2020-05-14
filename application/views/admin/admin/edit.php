<script language="javascript" src="<?php echo base_url('public') ?>/ckeditor/ckeditor.js"
        type="text/javascript"></script>
<div class="page-title">
    <div class="title_left"><h3>User: <span
                    style="color: red"><?php echo $user->UserID ?></span>
        </h3>
    </div>
    <div class="title_right">
        <div class="col-md-5 col-sm-5 col-xs-12 pull-right">
            <!--<a href="<?php echo admin_url('admin/add') ?>" class="btn btn-primary btn-sm">Thêm mới</a> -->
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
        <div class="form-group">
            <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Tên đăng nhập<span
                        class="required">*</span></label>
            <div class="col-md-7 col-sm-7 col-xs-12">
                <input type="text" id="txtName" name="txtName"
                       value="<?php echo $user->UserID ?>" required
                       class="form-control col-md-7 col-xs-12">
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-2" style="width: 70px">
                <input type="submit" id="btnUpdateEvent" name="btnUpdateadmin" required
                       class="btn btn-success" value="Cập nhật">
            </div>
        </div>
    </form>
</div>

<script type="text/javascript">
    $(document).ready(function () {
        $('input[type=radio][name=changeImg]').change(function () {
            if (this.value == 1) {
                $("#imgChange").html('<input type="file" id="imageEvent" name="imageEvent" value="" required="required" style="padding: 5px;" accept="image/*">');
                $('#pre_img').show();
                $("#img_event").hide();
            }
            else if (this.value == 2) {
                $("#img_event").show();
                $("#imgChange").html('');
                $('#pre_img').hide();
            }
            $("#imageEvent").change(function () {
                readURL(this);
            });
        });
    });

    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#pre_img').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>

