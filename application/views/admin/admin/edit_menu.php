<script language="javascript" src="<?php echo base_url('public') ?>/ckeditor/ckeditor.js"
        type="text/javascript"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>public/ckfinder/ckfinder.js"></script>
<div class="page-title">
    <div class="title_left"><h3>Sửa meu</h3></div>
    <div class="title_right">
        <div class="col-md-6 col-sm-6 col-xs-12 pull-right">

            <a href="<?php echo admin_url('admin/menu') ?>" class="btn btn-info btn-sm">Danh sách</a>
        </div>
    </div>
</div>
<?php //pre($lstdata); ?>

<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">

        <div class="x_panel">
            <?php if ($message) {
                $this->load->view('admin/message', $this->data);
            } ?>
            <form id="formAddProduct" data-parsley-validate class="form-horizontal form-label-left" method="post"
                  enctype="multipart/form-data">
                <div class="form-group">

                    <label class="control-label col-md-1 col-sm-1 col-xs-1 text-left" for="first-name">Tên<span
                                class="required">*</span></label>
                    <div class="col-md-5 col-sm-5 col-xs-12">
                        <input type="text" id="txtName" name="name" value="<?= $lstdata->name ?>" required
                               class="form-control col-md-7 col-xs-12">
                    </div>

                    <div class="col-md-2 col-sm-2 col-xs-12 col-md-offset-0">
                        <input type="submit" class="btn btn-success" name="btnSearch" value="cập nhật"/>
                    </div>

                </div>


            </form>

        </div>

    </div>

</div>



<script type="text/javascript">

</script>


