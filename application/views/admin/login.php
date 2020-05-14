<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Trang quản lý</title>

    <?php $this->load->view('admin/head'); ?>

</head>

<body class="login">
<div>
    <a class="hiddenanchor" id="signup"></a>
    <a class="hiddenanchor" id="signin"></a>

    <div class="login_wrapper">
        <div class="animate form login_form">
            <section class="login_content">
                <!--                --><?php //if ($message) {
                //                    $this->load->view('admin/message', $this->data);
                //                } ?>
                <form method="post" action="">
                    <h1>Đăng nhập</h1>
                    <!-- <p><?php //echo validation_errors(); ?><p> -->
                    <div>
                        <input type="text" name="username" value="" class="form-control" placeholder="Username" required=""/>
                    </div>
                    <div>
                        <input type="password" name="password" class="form-control" placeholder="Password" required=""
                               value=""/>
                    </div>
                    <div style="color: red"><?php echo validation_errors(); ?></div>
                    <div>
                        <button type="submit">Đăng nhập</button>
                        <!--                        <a class="reset_pass" href="#">Quên mật khẩu?</a>-->
                    </div>

                    <div class="clearfix"></div>

                    <div class="separator">
                    </div>
                </form>
            </section>
        </div>
    </div>
</div>
</body>
</html>
