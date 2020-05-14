<?php $menu_access = $this->session->userdata('menu_access');
/**/
//pre($menu_access);
?>
<div class="col-md-3 left_col">
    <div class="left_col scroll-view">
        <div class="navbar nav_title" style="border: 0;">
            <a href="<?php echo admin_url('tktongquan') ?>" class="site_title"><i class="fa fa-paw"></i>
                <span>Trang chủ</span></a>
        </div>

        <div class="clearfix"></div>

        <!-- menu profile quick info -->
        <div class="profile clearfix">
            <div class="profile_pic">
                <img src="<?php echo base_url() ?>/public/icon-linhvuong.png" alt=""
                     class="img-circle profile_img">
            </div>
            <div class="profile_info">
                <span>Xin chào,</span>
                <h2><?php echo $admin->UserID ?></h2>
            </div>
        </div>
        <!-- /menu profile quick info -->
        <br/>
        <!-- sidebar menu -->
        <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
            <div class="menu_section">
                <h3>Menu</h3>
                <ul class="nav side-menu">
                    <!---->
                    <!--                    // $access = $this->menu_access_model->get_column('menu_access', 'access',-->
                    <!--                    // array('employee_id' => $admin->employee_id, 'menu_id' => 1))[0]->access;-->
                    <!--                    --><?php //pre($menu_access) ?>
                    <?php if ($menu_access[1] >0) { ?>
                    <li><a href="<?php echo admin_url('admin') ?>"><i class="fa fa-user"></i>Phân cấp tài khoản </a></li>
                    <?php } ?>

                    <?php if ($menu_access[2] >0) { ?>

                    <li><a href="<?php echo admin_url('tktongquan') ?>"><i class="fa fa-list-alt"></i>Thống kê tổng quan game</a></li>
                    <?php } ?>


<!--                    <li><a href="--><?php //echo admin_url('tkserver') ?><!--"><i class="fa fa-tasks"></i>Thống kê từng server</a></li>-->
                    <?php if ($menu_access[3] >0) { ?>
                    <li><a href="<?php echo admin_url('ccu') ?>"><i class="fa fa-align-left"></i>Thống kê CCU</a></li>
                    <?php } ?>

                    <?php if ($menu_access[4] >0) { ?>
                    <li><a href="<?php echo admin_url('Level') ?>"><i class="fa fa-outdent"></i>Thống kê level</a></li>
                    <?php } ?>

                    <?php if ($menu_access[5] >0) { ?>
                    <li><a href="<?php echo admin_url('tktaikhoan') ?>"><i class="fa fa-envelope-o"></i>Thống kê tài khoản</a></li>
                    <?php } ?>
                    <?php if ($menu_access[6] >0) { ?>
                    <li><a href="<?php echo admin_url('shop_item') ?>"><i class="fa fa-bookmark"></i>Chợ</a></li>
                    <?php } ?>

                    <?php if ($menu_access[7] > 0  || $menu_access[8] >0 || $menu_access[9] > 0) { ?>
                    <li><a><i class="fa fa-tint"></i>Quản lý đồ<span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <?php if ($menu_access[7] > 0) { ?>
                            <li><a href="<?php echo admin_url('add_items/phatdo') ?>">Phát đồ</a></li>
                            <?php } ?>

                            <?php if ($menu_access[8] > 0) { ?>
                            <li><a href="<?php echo admin_url('add_items/duyetdo') ?>">Duyệt đồ</a></li>
                            <?php } ?>

                            <?php if ($menu_access[9] > 0) { ?>
                            <li><a href="<?php echo admin_url('add_items') ?>">Thống kê phát đồ</a></li>
                            <?php } ?>
                        </ul>
                    </li>

                    <?php } ?>


                    <?php if ($menu_access[10] >0) { ?>
                    <li><a href="<?php echo admin_url('chat') ?>"><i class="fa fa-bar-chart-o"></i>Logs chat</a></li>

                    <?php } ?>

                    <?php if ($menu_access[71] >0 || $menu_access[72] > 0) { ?>


                    <li><a><i class="fa fa-qrcode"></i>Check code<span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <?php if ($menu_access[71] >0 ) { ?>
                            <li><a href="<?php echo admin_url('gift_code/gift_code_add') ?>">Tạo code</a></li>
                            <?php } ?>


                            <?php if ($menu_access[72] > 0) { ?>
                            <li><a href="<?php echo admin_url('gift_code') ?>">Check code</a></li>
                            <?php } ?>

                        </ul>
                    </li>



                    <?php } ?>

                    <?php if ($menu_access[70] >0) { ?>
                    <li><a href="<?php echo admin_url('events') ?>"><i class="fa fa-plug"></i>Sự kiện</a></li>
                    <?php } ?>

                    <?php if ($menu_access[73] >0) { ?>
                        <li><a href="<?php echo admin_url('gift_item_info') ?>"><i class="fa fa-star"></i>Tạo gói quà</a></li>

                    <?php } ?>

                    <?php if ($menu_access[74] >0) { ?>
                        <li><a href="<?php echo admin_url('tbl_gift_check_in') ?>"><i class="fa fa-twitter-square"></i>Phúc lợi</a></li>

                    <?php } ?>


                </ul>
            </div>

        </div>
        <!-- /sidebar menu -->

        <!-- /menu footer buttons -->
        <div class="sidebar-footer hidden-small">
            <a data-toggle="tooltip" data-placement="top" title="Settings">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
            </a>
            <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
            </a>
            <a data-toggle="tooltip" data-placement="top" title="Lock">
                <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
            </a>
            <a data-toggle="tooltip" data-placement="top" title="Logout">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
            </a>
        </div>
        <!-- /menu footer buttons -->
    </div>
</div>