<div class="x_panel">

    <div class="x_content">
        <table id="datatable-product" class="table table-striped table-bordered bulk_action">
            <!--        <table id="datatable-buttons" class="table table-striped table-bordered">-->
            <thead>
            <tr>
                <th>STT</th>
                <th>server</th>
                <th>type code</th>
                <th>code</th>
                <th>Giá trị code</th>
                <th>Status</th>
                <th>UserID get money</th>
                <th>UserID </th>
                <th>Time send</th>
                <th>Time use</th>
                <th>Sender</th>
                <th>Hành động</th>
<!--                <th></th>-->

            </tr>
            </thead>
            <tbody>
            <?php $i = 0;
            //            pre($lst_gift_item_info_);?>
            <?php if (isset($res)) foreach ($res as $row) {
                $i++; ?>
                <tr id="<?php echo $row->id ?>"
                    class="<?php if (isset($_GET['id']) && $_GET['id'] == $row->id) echo 'bg_thanhly'; ?>">
                    <td><?php echo $i ?></td>
                    <td><?php echo $row->list_server_id ?></td>
                    <td><?php echo $row->type_giftcode ?></td>
                    <td><?php echo $row->giftcode ?></td>

                    <td>
                        <!--                                <ul>-->
                        <?php
                        //                        echo $row->list_items;
                        $tags = explode(',', $row->list_items);

                        foreach ($tags as $k1 => $v1) {
                            $item = explode('-', $v1);
                            $item_name = isset($lst_gift_item_info_[$item[0]]) ? $lst_gift_item_info_[$item[0]] : 'N/A';

                            echo '<p class="text-nowrap">'. $item_name.' / '. $item[1].  '</p>';
//                            echo '<li>' . $item_name . ' - ' . $item[1] . '<br/>' . '</li>';
                        }
                        //                                echo $value->list_items
                        ?>
                        <!--                                </ul>-->

                    </td>
                    <td><?php echo $row->status ?></td>
                    <td><?php echo $row->user_id_used ?></td>
                    <td><?php echo $row->user_id_received ?></td>
                    <td><?php echo $row->time_send ?></td>
                    <td><?php echo $row->time_used ?></td>
                    <td><?php echo $row->admin_nick ?></td>
<!--                    <td></td>-->
                    <td id="btn_lock_chat_<?php echo $row->id ?>">
                        <?php if ($row->user_id_received == 0) { ?>
                            <button class="label label-primary" id="send_<?php echo $row->id; ?>" onclick="openForm('<?= $row->id ?>')">Gửi</button>
                        <?php } else { ?>
                            <button class="label label-danger" onclick="openForm('<?= $row->id ?>')">Gửi lại</button>
                        <?php } ?>

                        <div class="form-popup" id="myForm-<?php echo $row->id ?>">
                            <form id="send_chat_<?php echo $row->id ?>" action="" class="form-container" method="post">

                                <input type="hidden" name="id" value="<?php echo $row->id ?>"/>
                                <input type="hidden" name="server" value="<?php echo $server ?>"/>
                                <input type="number" name="user_id" value="<?php if ($row->user_id_received != 0) echo $row->user_id_received ?>" required/>

                                <!--                                <div class="form-group">-->
                                <!--                                    <textarea rows="4" cols="50" name="content" class="content" form="usrform"></textarea>-->
                                <!--                                </div>-->
                                <div class="form-group">

                                    <!--                                        <input type="hidden" value="123456" name="xxx"/>-->
                                    <button type="submit" class="btn btn-success">Gửi</button>
                                    <button type="button" class="btn btn-danger" onclick="closeForm('<?php echo $row->id ?>')">ẩn</button>
                                </div>

                            </form>
                        </div>
                    </td>

<!--                    <td>-->
<!--                        -->
<!--                    </td>-->
                </tr>
            <?php } ?>
            </tbody>
        </table>
        <!-- <a href="#" class="btn btn-danger">Xóa đã chọn </a> -->
    </div>
</div>

<script>
    $("#datatable-product").dataTable();
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