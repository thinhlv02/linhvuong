<?php

Class Shop_item extends MY_Controller
{
    var $lst_gift_item_info_ = '';
    var $lst_gift_type = '';
    var $lst_gift_unit = '';

    function __construct()
    {
        parent::__construct();
        $this->load->model('Gift_item_info_model');
        $this->load->model('Gift_type_model');
        $this->load->model('Shop_item_model');


        $this->load->model('Tbl_equipment_quan_vo_info_model');
        $this->load->model('Tbl_equipment_quan_van_info_model');
        $this->load->model('Tbl_trang_bi_binh_chung_info_model');
        $this->load->model('Tbl_gem_info_model');
        $this->load->model('Tbl_book_info_model');
        $this->load->model('Tbl_quan_van_info_model');
        $this->load->model('Tbl_quan_vo_info_model');

        $this->lst_gift_item_info_ = $this->Gift_item_info_model->_get_info_id_arr('');
        $this->lst_gift_type = $this->Gift_type_model->lst_gift_type();
        $this->lst_gift_unit = $this->Shop_item_model->_get_unit_arr();
    }

    function index()
    {
        $server_cf = $this->_func_lst_server();
        $lstdata_arr = [];

        if ($this->input->post('btnSearch')) {

            $server_name = $server_cf[$this->input->post('server')]['main'];

            $lstdata = $this->Shop_item_model->get_list(array('order' => array('time_open', 'desc')), '', $server_name);

            $lstdata_arr = [];
            foreach ($lstdata as $key => $value) {
                $lstdata_arr[$key]['id'] = $value->id;
                $lstdata_arr[$key]['info_id'] = $value->info_id;
//            $lstdata_arr[$key]['info_id_name'] = isset($this->lst_gift_item_info_[$value->info_id]) ? $this->lst_gift_item_info_[$value->info_id] : 'null';
                $lstdata_arr[$key]['type'] = $value->type;
                $lstdata_arr[$key]['type_name'] = isset($this->lst_gift_type[$value->type]) ? $this->lst_gift_type[$value->type] : 'dcm';
                $lstdata_arr[$key]['name'] = $value->name;
                $lstdata_arr[$key]['quantity'] = $value->quantity;
                $lstdata_arr[$key]['price'] = $value->price;
                $lstdata_arr[$key]['unit'] = $value->unit;
                $lstdata_arr[$key]['unit_name'] = isset($this->lst_gift_unit[$value->unit]) ? $this->lst_gift_unit[$value->unit] : 'N/A';
                $lstdata_arr[$key]['time_open'] = $value->time_open;
                $lstdata_arr[$key]['time_close'] = $value->time_close;
                $lstdata_arr[$key]['status'] = $value->status;
            }
//        pre($lstdata_arr);
            $message = $this->session->flashdata('message');
            $this->data['message'] = $message;

            $this->data['lst_gift_unit'] = $this->lst_gift_unit;

            $this->data['lst_gift_type'] = $this->lst_gift_type;

//        $this->data['lst_gift_item_info_'] = $this->lst_gift_item_info_;

        }
        $this->data['lstdata'] = $lstdata_arr;
        $this->data['server_cf'] = $server_cf;
        $this->data['temp'] = $this->_template_f . 'shop_item/view_index';
        $this->load->view('admin/layout', $this->data);
    }


    function add()
    {
        $message = $this->session->flashdata('message');
        $this->data['message'] = $message;
        $server_cf = $this->_func_lst_server();
        $lstdata_arr = [];

        if ($this->input->post('btnSearch1111111')) {

            $server_name = $server_cf[$this->input->post('server')]['main'];

            $lstdata = $this->Shop_item_model->get_list('', '', $server_name);

            $lstdata_arr = [];
            foreach ($lstdata as $key => $value) {
                $lstdata_arr[$key]['id'] = $value->id;
                $lstdata_arr[$key]['info_id'] = $value->info_id;
//            $lstdata_arr[$key]['info_id_name'] = isset($this->lst_gift_item_info_[$value->info_id]) ? $this->lst_gift_item_info_[$value->info_id] : 'null';
                $lstdata_arr[$key]['type'] = $value->type;
                $lstdata_arr[$key]['type_name'] = isset($this->lst_gift_type[$value->type]) ? $this->lst_gift_type[$value->type] : 'dcm';
                $lstdata_arr[$key]['name'] = $value->name;
                $lstdata_arr[$key]['quantity'] = $value->quantity;
                $lstdata_arr[$key]['price'] = $value->price;
                $lstdata_arr[$key]['unit'] = $value->unit;
                $lstdata_arr[$key]['unit_name'] = isset($this->lst_gift_unit[$value->unit]) ? $this->lst_gift_unit[$value->unit] : 'N/A';
                $lstdata_arr[$key]['time_open'] = $value->time_open;
                $lstdata_arr[$key]['time_close'] = $value->time_close;
                $lstdata_arr[$key]['status'] = $value->status;
            }
//        pre($lstdata_arr);

//        $this->data['lst_gift_item_info_'] = $this->lst_gift_item_info_;

        }
        $this->data['lst_gift_unit'] = $this->lst_gift_unit;
        $this->data['lst_gift_type'] = $this->lst_gift_type;
        $this->data['lstdata'] = $lstdata_arr;
        $this->data['server_cf'] = $server_cf;
        $this->data['temp'] = $this->_template_f . 'shop_item/add';
        $this->load->view('admin/layout', $this->data);
    }


    function add_market()
    {
        $server_cf = $this->_func_lst_server();
        $server_name = $server_cf[$this->input->post('server')]['main'];

//        pre($_POST);
//
//        die();
//        name=thinhlv+test&quantity_remaining=12&price=67&unit=2&type=4&date1=04-04-2019&date2=04-04-2019
        $info = explode('-', $this->input->post('info'));
//        pre($info);
//        die();
        if ($info[0] == '') {
            echo 'chưa chọn vật phẩm';
        } else {
            $type = $this->input->post('type');
            $info_id = $info[0];
            $name = $info[1];
            $quantity = $this->input->post('quantity');
            $price = $this->input->post('price');
            $unit = $this->input->post('unit');

//            $reportdatetime = explode('-', $this->input->post('reportdatetime'));
//            $date_open = str_replace("/", "-", $reportdatetime[0]);// $reportdatetime[0];            $reportdatetime[0];
//
//            $date_close = str_replace("/", "-", $reportdatetime[1]);// $reportdatetime[0]; $reportdatetime[1];



            $date1 = str_replace("/", "-", $this->input->post('date1'));// $reportdatetime[0];            $reportdatetime[0];
            $date1 = date('Y-m-d H:i:s', strtotime($date1));

            $date2_post = $this->input->post('date2');

            if ($date2_post != '') {
                $date2 = str_replace("/", "-", $date2_post);// $reportdatetime[0];            $reportdatetime[0];
                $date2 = date('Y-m-d H:i:s', strtotime($date2));
            }

            $dataSubmit = array(
                'info_id' => $info_id,
                'type' => $type,
                'name' => $name,
                'quantity' => $quantity,
                'quantity_remaining' => $quantity,
                'price' => $price,
                'unit' => $unit,
                'time_open' => $date1,

            );
            if ($date2_post != '') {
                $dataSubmit['time_close'] =  $date2;
            }
//            pre($dataSubmit);
//            die();

            if ($this->Shop_item_model->create($dataSubmit,$server_name)) {
                echo 'thành công';
            } else {
                echo 'thất bại';
            }
        }

    }

    function edit()
    {
        $message = $this->session->flashdata('message');
        $this->data['message'] = $message;

        $shop_id = $this->uri->segment(4);
        $server = $this->uri->segment(5);
        $server = intval($server);
        $shop_id = intval($shop_id);
        //pre($shop_id);

        $server_cf = $this->_func_lst_server();
        $server_name = $server_cf[$server]['main'];

        $lstdata = $this->Shop_item_model->get_info($shop_id, '', $server_name);
//        die();



//        pre($lstdata->);

        $type = $lstdata->type;
        //list vật phẩm theo gói quà info_ID
        switch ($type) {
            case "1":
                $model = 'Tbl_equipment_quan_vo_info_model';
                break;
            case "2":
                $model = 'Tbl_equipment_quan_van_info_model';
                break;
            case "3":
                $model = 'Tbl_trang_bi_binh_chung_info_model';
                break;
            case "4":
                $model = 'Tbl_gem_info_model';
                break;

            case "5":
                $model = 'Gift_type_model';
                $input = array('where' => array('id' => 5));
                break;

            case "6":
                $model = 'Gift_type_model';
                $input = array('where' => array('id' => 6));
                break;

            case "7":
                $model = 'Gift_type_model';
                $input = array('where' => array('id' => 7));
                break;

            case "8":
                $model = 'Gift_type_model';
                $input = array('where' => array('id' => 8));
                break;
            case "9":
                $model = 'Tbl_book_info_model';
                break;

            case "10":
                $model = 'Tbl_quan_van_info_model';
                break;

            case "11":
                $model = 'Tbl_quan_vo_info_model';
                break;


            default:
        }


//        pre($input);
        $lst_item_by_type = $this->$model->get_list('','','');

        $name_field = 'name';
        if ($type == 4) {
            $name_field = 'gem_name';
        }
        $lst_item_by_type_end = [];
        foreach ($lst_item_by_type as $key => $value) {
            $lst_item_by_type_end[$value->id]['id'] = $value->id;
            $lst_item_by_type_end[$value->id]['name'] = $value->$name_field;

        }
        //list vật phẩm theo gói quà info_ID


//        die();

        if ($this->input->post('btnSearch')) {
            $info = explode('-', $this->input->post('info'));
            $type = $this->input->post('type');

            $quantity = $this->input->post('quantity');
            $price = $this->input->post('price');
            $unit = $this->input->post('unit');

            $date1 = str_replace("/", "-", $this->input->post('date1'));// $reportdatetime[0];            $reportdatetime[0];
            $date1 = date('Y-m-d H:i:s', strtotime($date1));

            $date2 = str_replace("/", "-", $this->input->post('date2'));// $reportdatetime[0];            $reportdatetime[0];
            $date2 = date('Y-m-d H:i:s', strtotime($date2));

//            $date2 = date('Y-m-d H:i:s', strtotime($this->input->post('date2')));

            $dataSubmit = array(
                'info_id' => $info[0],
                'name' => $info[1],
                'type' => $type,

                'quantity' => $quantity,
                'quantity_remaining' => $quantity,
                'price' => $price,
                'unit' => $unit,
                'time_open' => $date1,
                'time_close' => $date2,
            );
//            pre($dataSubmit);
//            die();
            if ($this->Shop_item_model->update($shop_id, $dataSubmit,$server_name)) {
                $this->session->set_flashdata('message', 'Sửa thành công!');
                redirect(admin_url('shop_item'));
            } else {
                $this->session->set_flashdata('message', 'Sửa thất bại!');
                redirect(admin_url('shop_item'));
            }
        }

        $this->data['lstdata'] = $lstdata;
        $this->data['lst_item_by_type_end'] = $lst_item_by_type_end;
        $this->data['lst_gift_item_info_'] = $this->lst_gift_item_info_;
        $this->data['lst_gift_type'] = $this->lst_gift_type;
        $this->data['lst_gift_unit'] = $this->lst_gift_unit;
        $this->data['temp'] = $this->_template_f . 'shop_item/edit';
        $this->load->view('admin/layout', $this->data);
    }

    function del()
    {
        $id = $this->uri->segment(4);
        $server = $this->uri->segment(5);

        $server_cf = $this->_func_lst_server();
        $server_name = $server_cf[$server]['main'];


//        echo $id. ','.$server;
//        die();
        $lstdata = $this->Shop_item_model->get_info($id,'', $server_name);

        if ($lstdata == null) {
            $this->session->set_flashdata('message', 'Không tồn tại');
            redirect(admin_url('shop_item'));
        } else {
            if ($this->Shop_item_model->delete($id, $server_name)) {

                $this->session->set_flashdata('message', 'Xóa thành công!');

                redirect(admin_url('shop_item'));

            } else {
                $this->session->set_flashdata('message', 'Thao tác không thành công!');

                redirect(admin_url('shop_item'));

            }

        }

    }

}