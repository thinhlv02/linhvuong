<div class="page-title">
    <div class="title_left"><h3>Thống kê binh chủng</h3></div>
    <div class="title_right">

    </div>
</div>

<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <form id="formAddProduct_binhchung" data-parsley-validate class="form-horizontal form-label-left" method="post"
                  enctype="multipart/form-data">
                <div class="form-group">

                    <label class="control-label col-md-1 col-sm-1 col-xs-12" for="first-name">Chọn<span
                                class="required">*</span></label>
                    <div class="col-md-2 col-sm-2 col-xs-12">
                        <select class="select2_group form-control"  name="binh_chung_type">
                            <option value="0">Tất cả</option>
                            <?php foreach ($binh_chung_type as $k => $v) { ?>
                                <option value="<?= $k ?>"><?= $v['type'] ?></option>
                            <?php } ?>
<!--                            -->
<!--                            <option value="2">Chọn thời gian</option>-->
                        </select>
                    </div>


                    <div class="col-md-6 col-sm-6 col-xs-12 " style="width: 70px">
                        <input type="submit" id="btnAddEvent" name="btnAddEvent" class="btn btn-success"
                               value="Tìm">
                    </div>
                </div>


            </form>

            <div id="binhchung_table"></div>



        </div>

    </div>

</div>

<script>
    $('#datatable-product-2').dataTable({
        "ordering": false
    });
</script>
