<?php

Class Gift_code extends MY_Controller
{
    var $lst_gift_item_info_ = '';

    function __construct()
    {
        parent::__construct();
        $this->load->model('gift_code_model');
        $this->load->model('Init_giftcode_model');
        $this->load->model('Gift_item_info_model');

        $this->lst_gift_item_info_ = $this->Gift_item_info_model->_get_info_id_arr('');
//        $dcm = $this->Init_giftcode_model->get_list();
//        pre($dcm);
//        $this->load->model('service_package_model');
//        $this->load->model('service_package_user_model');
//        $this->load->model('agency_model');
//        $this->load->model('admin_model');
//        $this->load->model('vn_city_model');
//        $this->load->model('vn_district_model');
//        $this->load->model('vn_ward_model');
//        $this->load->model('admin_model');
//        $this->load->model('user_model');

//        $service_package = $this->service_package_model->get_list(array('where_in' => array('parent_id', array('1','2','3','4')),'order' => array('id', 'asc')));
//        $agency = $this->agency_model->get_list(array('order' => array('id', 'asc')));
//        $this->data['service_package'] = $service_package;
//        $this->data['agency'] = $agency;
//
//        $create_by = $this->admin_model->get_list(array('where_in' => array('level', array('5'))));
//        $this->data['create_by'] = $create_by;

//        pre($service_package);
    }

    function index()
    {
        $server_cf = $this->_func_lst_server();
//        pre($this->lst_gift_item_info_);
        $message = $this->session->flashdata('message');
        $this->data['message'] = $message;


        $this->data['server_cf'] =  $server_cf;
        $this->data['lst_gift_item_info_'] = $this->lst_gift_item_info_;
        $this->data['temp'] = 'admin/gift_code/list';
//        $this->data['view'] = 'admin/gift_code/add';
        $this->load->view('admin/layout', $this->data);

    }

    function gift_code_add()
    {
        $server_cf = $this->_func_lst_server();

        $message = $this->session->flashdata('message');
        $this->data['message'] = $message;

        //check type_giftcode = 1 neu


        if ($this->input->post('btnAdd')) {
            $server_name = $server_cf[$this->input->post('server')]['main'];
            //08/04/2019 0:00:00 - 08/04/2019 23:59:59
//            var_dump($this->input->post('reportdatetime'));
//            die();
            $reportdatetime = explode('-', $this->input->post('reportdatetime'));
//            $date_open = $reportdatetime[0];
            $date_open = str_replace("/", "-", $reportdatetime[0]);// $reportdatetime[0];
            $date_open = date('Y-m-d H:i:s', strtotime($date_open));
//            var_dump($date_open);
//            die();
            $date_close = str_replace("/", "-", $reportdatetime[1]);// $reportdatetime[0];
            $date_close = date('Y-m-d H:i:s', strtotime($date_close));

            $list_server_id = $this->input->post('list_server_id');
            $type_giftcode = $this->input->post('type_giftcode');

            if ($type_giftcode == 1) {
                //check type_giftcode = 1 nếu đã tồn tại khi false
                $check_type_giftcode = $this->gift_code_model->get_list(array('where' => array('type_giftcode' => 1)), '',$server_name);
                if (!empty($check_type_giftcode)) {
                    $this->session->set_flashdata('message', 'Chỉ được tạo 1 lần loại code này!');
                    redirect(admin_url('gift_code/gift_code_add'));
                }
            }


            $level_min = $this->input->post('level_min');
            $quantity = $this->input->post('quantity');

            $itemKeys = $this->input->post('itemKeys');
//            var_dump($itemKeys);
            $itemValues = $this->input->post('itemValues');
//            pre($itemValues);

            $tmp = [];
            if ($itemKeys != null && !empty($itemValues)) {


                foreach ($itemKeys as $key => $value) {
                    if (isset($itemValues[$key])) {
                        if ($itemValues[$key] != '') {
                            $tmp[] = $key . "-" . $itemValues[$key];
                        } else {
                            $this->session->set_flashdata('message', 'Vui lòng không để trống các vật phẩm đã checkbox!');
                            redirect(admin_url('gift_code/gift_code_add'));
                        }
                    }
                }

                $list_items = implode(",", $tmp);

                $datasubmit = array(
                    'list_server_id' => $list_server_id,
                    'type_giftcode' => $type_giftcode,
                    'level_min' => $level_min,
                    'quantity' => $quantity,
                    'list_items' => $list_items,
                    'time_open' => $date_open,
                    'time_close' => $date_close
                );
//                pre($datasubmit);
//
//                die();

                if ($this->Init_giftcode_model->create_not_id($datasubmit,$server_name)) {
                    $this->session->set_flashdata('message', 'Thêm thành công: '.$server_name);
                    redirect(admin_url('gift_code/gift_code_add'));
//                    echo 'thành công server: '.$server_name;
                } else {
                    $this->session->set_flashdata('message', 'Thêm thất bại!');
                    redirect(admin_url('gift_code/gift_code_add'));
                }

            }

        }
        $this->data['server_cf'] = $server_cf;
        $this->data['lst_gift_item_info_'] = $this->lst_gift_item_info_;
        $this->data['temp'] = 'admin/gift_code/add';

        $this->load->view('admin/layout', $this->data);
    }

    function ajax_send_giftcode()
    {
        $server_cf = $this->_func_lst_server();
        $server = $this->input->post('server');

        $server_name = $server_cf[$server]['main'];
        $id = $this->input->post('id');
        $user_id = $this->input->post('user_id');

//        echo 'idchat: '. $user_id;
//        echo '<br/>';
//        echo  'content: '.$content; // chỗ này đây, anh chỉ ehco 1 lần ?? hiểu.

        $dataSubmit = array(
            'user_id_received' => $user_id,
            'time_send' => date("Y-m-d H:i:s"),
            'admin_nick' => $this->_uid,
        );
//        pre($dataSubmit);

        $id_insert = $this->gift_code_model->update($id, $dataSubmit,$server_name);
//        if ($this->branch_model->update($branch_id, $dataSubmit)) {
        if ($id_insert) {
            echo $id;
//            echo 'success';
        } else echo $id;
    }

    function ajax_getdata()
    {
        $server_cf = $this->_func_lst_server();
        $sv = $this->input->post('server');
        $server_name = $server_cf[$sv]['main'];

//        if ($this->input->post('btnAdd')) {
        $type = trim($this->input->post('type', true));
        $txtFrom = date("Y-m-d", strtotime(trim($this->input->post('txtFrom', true))));
        $txtto = date("Y-m-d", strtotime(trim($this->input->post('txtTo', true))));

        $input = '';
        if ($type == 2) {
            $input = "and date(time_send) between '" . $txtFrom . "' and '" . $txtto . "' ";
        }

//            $service_package_id = $this->input->post('service_package_id');
//            $agent = $this->input->post('agent');
//            $create_by = $this->input->post('create_by');
        $giftcode = $this->input->post('giftcode');
        $user_id_received = $this->input->post('user_id_received');
        $type_giftcode = $this->input->post('type_giftcode');
        $use_by = $this->input->post('use_by');
//            $input = '';
            if ($type_giftcode!= '99') {
                $input .= "and type_giftcode = $type_giftcode ";
            }
//            if ($service_package_id != 'all') {
//                $input['where']['service_package_id'] = $service_package_id;
//            }
//            if ($agent != 'all') {
//                $input['where']['agent'] = $agent;
//            }

//            if ($create_by != 'all') {
//                $input['where']['create_by'] = $create_by;
//            } user_id_received

        if ($giftcode != '') {
//                $input['where']['giftcode'] = $giftcode;
            $input .= "and giftcode = '$giftcode' ";
        }

        if ($user_id_received != '') {
//                $input['where']['giftcode'] = $giftcode;
            $input = "and user_id_received = $user_id_received ";
        }

//            if ($use_by != 'all') {
//                $null = null;
//                if ($use_by == 1) {
//                    $input['where']['use_by is not null'] = $null;
//                } else {
//                    $input['where']['use_by is null'] = $null;
//                }
//            }

//            echo $input;

        $res = $this->gift_code_model->get_list_custom($input,$server_name);
        $res_arr = array();
        $index = 0;
        foreach ($res as $key => $value) {
            $index++;
//                if ($value->type == 1) {
//                    $type = 'Cộng tiền DIV';
//                } else {
//                    $type = 'Gói Dịch vụ';
//                }
//                $sv_pk_name = '';
//                if ($value->service_package_id != '') {
//                    $sv_pk = $this->service_package_model->get_info($value->service_package_id);
//                    $sv_pk_name = $sv_pk->name;
//                }
//                $gift_code_address = '';
//                if ($value->service_package_user_id != 0) {
//                    $gift_code_address = $this->service_package_user_model->get_info($value->service_package_user_id);
//                    $gift_code_address = $gift_code_address->address;
//                }
//                $area_name = '';
//                if ($value->area_id != '') {
//                    $area = explode('_', $value->area_id);
//                    if (isset($area[0])) {
//                        $vn_city = $this->vn_city_model->get_info($area[0]);
//                        $area_name .= $vn_city->name;
//                    }
//                    if (isset($area[1])) {
//                        $vn_district = $this->vn_district_model->get_info($area[1]);
//                        $area_name .= '_' . $vn_district->name;
//                    }
//                    if (isset($area[2])) {
//                        $vn_ward = $this->vn_ward_model->get_info($area[2]);
//                        $area_name .= '_' . $vn_ward->name;
//                    }
//                }
//                $use_by_name = '';
//                $agency = $this->agency_model->get_info($value->agent);
//                $ad = $this->admin_model->get_info($value->create_by);
//                if ($value->use_by != '') {
//                    $user = $this->user_model->get_info($value->use_by);
//                    $use_by_name = $user->fullname;
//                }
            $res_arr[$index] = new stdClass();
            $res_arr[$index]->id = $value->id;
            $res_arr[$index]->list_server_id = $value->list_server_id == 0 ? 'Tất cả' : $value->list_server_id;
            $res_arr[$index]->type_giftcode = $value->type_giftcode == 1 ? ' 1 code duy nhất và mỗi user chỉ được dùng 1 lần' : 'nhiều code và mỗi code dùng 1 lần / 1 user';

            $res_arr[$index]->giftcode = $value->giftcode;
            $res_arr[$index]->list_items = $value->list_items;
            $res_arr[$index]->status = $value->status == 0 ? 'Chưa dùng' : 'Dùng rồi';
            $res_arr[$index]->user_id_used = $value->user_id_used;
            $res_arr[$index]->user_id_received = $value->user_id_received;
            $res_arr[$index]->time_send = $value->time_send;
            $res_arr[$index]->time_used = $value->time_used;
            $res_arr[$index]->admin_nick = $value->admin_nick;

//                $res_arr[$index]->status = $sv_pk_name;
//                $res_arr[$index]->agent = $agency->name;
//                $res_arr[$index]->expire_date = $value->expire_date;
//                $res_arr[$index]->use_by = $use_by_name;
//                $res_arr[$index]->create_time = $value->create_time;
//                $res_arr[$index]->create_by = $ad->username;
//                $res_arr[$index]->area_id = $area_name;
        }
        // pre($res_arr);
        $this->data['server'] = $sv;
        $this->data['res'] = $res_arr;

//            $this->data['temp'] = 'admin/gift_code/table_ajax';
        $this->load->view($this->_template_f . 'gift_code/table_ajax', $this->data);
//        }

    }
}