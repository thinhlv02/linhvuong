<?php

Class Add_items extends MY_Controller
{
    var $lst_gift_item_info_ = '';
    var $sub_arr = '';

    function __construct()
    {
        parent::__construct();
        $this->load->model('Gift_item_info_model');
        $this->load->model('Add_items_model');
        $this->load->model('Add_items_step1_model');
        $this->lst_gift_item_info_ = $this->Gift_item_info_model->_get_info_id_arr('');
        $this->sub_arr = $this->Add_items_model->sub_arr();


//        $input = array();
//        $input['where'] = array(
//            'role' => 2
//        );
//        $emp = $this->employee_model->get_list($input);
//        $this->data['emp'] = $emp;
    }

    function index()
    {
        $server_cf = $this->_func_lst_server();
        $lstdata = [];
//        pre($this->_uid);
        $message = $this->session->flashdata('message');
        $this->data['message'] = $message;
//        $this->data['lstdata'] = [];
        if ($this->input->post('btnSearch')) {
            $server_name = $server_cf[$this->input->post('server')]['main'];
            $lstdata = $this->Add_items_step1_model->get_list('', '', $server_name);
//        pre($lstdata);
        }
        $this->data['lst_gift_item_info_'] = $this->lst_gift_item_info_;
        $this->data['lstdata'] = $lstdata;
        $this->data['server_cf'] = $server_cf;

        $this->data['temp'] = $this->_template_f . 'add_items/view_index';
        $this->load->view('admin/layout', $this->data);
    }

    //phát đồ

    function phatdo()
    {
        $server_cf = $this->_func_lst_server();
        if ($this->input->post('btnSearch')) {
            echo $_POST;
        }
//        $lstdata = $this->Shop_item_model->get_list();

//        $lstdata_arr = [];
//        foreach ($lstdata as $key => $value) {
//            $lstdata_arr[$key]['id'] = $value->id;
//            $lstdata_arr[$key]['info_id'] = $value->info_id;
//            $lstdata_arr[$key]['info_id_name'] = isset($this->lst_gift_item_info_[$value->info_id]) ? $this->lst_gift_item_info_[$value->info_id] : 'null';
//            $lstdata_arr[$key]['type'] = $value->type;
//            $lstdata_arr[$key]['type_name'] = isset($this->lst_gift_type[$value->type]) ? $this->lst_gift_type[$value->type] : 'dcm';
//            $lstdata_arr[$key]['name'] = $value->name;
//            $lstdata_arr[$key]['quantity'] = $value->quantity;
//            $lstdata_arr[$key]['price'] = $value->price;
//            $lstdata_arr[$key]['unit'] = $value->unit;
//            $lstdata_arr[$key]['unit_name'] = isset($this->lst_gift_unit[$value->unit]) ? $this->lst_gift_unit[$value->unit] : 'failed unit name';
//            $lstdata_arr[$key]['time_open'] = $value->time_open;
//            $lstdata_arr[$key]['time_close'] = $value->time_close;
//            $lstdata_arr[$key]['status'] = $value->status;
//        }
//        pre($lstdata_arr);
        $message = $this->session->flashdata('message');
        $this->data['message'] = $message;
        $this->data['lstdata'] = [];

//        $this->data['lst_gift_type'] = $this->lst_gift_type;
        $this->data['lst_gift_item_info_'] = $this->lst_gift_item_info_;
        $this->data['server_cf'] = $server_cf;
        $this->data['temp'] = $this->_template_f . 'add_items/view_phatdo';
        $this->load->view('admin/layout', $this->data);
    }

    function phatdo_add()
    {
        $server_cf = $this->_func_lst_server();
        $server_name = $server_cf[$this->input->post('server')]['main'];
//        echo '12';
        $list_user_id = $this->input->post('list_user_id');
        $title = $this->input->post('title');
        $note = $this->input->post('note');
        $sub = $this->input->post('sub');

        //lay gia tri post len nhu nao?
        //pre($this->input->post('itemKeys'));
        //pre($this->input->post('itemValues'));

        $itemKeys = $this->input->post('itemKeys');
        $itemValues = $this->input->post('itemValues');

//        pre($itemKeys);
//        pre($itemValues);

        $tmp = [];
        if ($itemKeys != null) {


            foreach ($itemKeys as $key => $value) {
                if (isset($itemValues[$key])) {
                    if ($itemValues[$key] != '') {
                        $tmp[] = $key . "-" . $itemValues[$key];
                    }
                }
            }

            $list_items = implode(",", $tmp);

//            pre($list_items);//chuan roi day, haha. tiep di.ok de anh sua phat da nhe ,tks em
            //ok?

            //xu ly insert vào table : admin_add_items_step1
            if ($list_items != '') {

                $dataSubmit = array(
                    'list_user_id' => $list_user_id,
                    'list_items' => $list_items,
                    'title' => $title,
                    'note' => $note,
                    'sub' => $sub,
                    'admin_nick' => $this->_uid,
                    'date_create' => date('Y-m-d H:i:s'),
                    'status' => 0,
                );

                if ($this->Add_items_step1_model->create($dataSubmit,$server_name)) {
//            echo $list_items;
                    echo 'thành công server: '.$server_name;
                } else {
                    echo 'thất bại';
                }
            } else {
                echo 'Vui lòng chọn ít nhất 1 vật phẩm';
            }
        } else {
            echo 'false';
        }
//            prev($dataSubmit);


    }

    //duyệt đồ

    function duyetdo()
    {
        $lstdata = [];
        $server_cf = $this->_func_lst_server();
        if ($this->input->post('btnSearch')) {
            //        pre($this->_uid);
            $message = $this->session->flashdata('message');
            $this->data['message'] = $message;
//        $this->data['lstdata'] = [];
            $server_name = $server_cf[$this->input->post('server')]['main'];
            $lstdata = $this->Add_items_step1_model->get_list('','',$server_name);
//        pre($lstdata);
            $this->data['lst_gift_item_info_'] = $this->lst_gift_item_info_;
        }
        $this->data['server_cf'] = $server_cf;
        $this->data['lstdata'] = $lstdata;

        $this->data['temp'] = $this->_template_f . 'add_items/view_duyetdo';
        $this->load->view('admin/layout', $this->data);
    }

    function ajax_duyetdo()
    {
        $server_cf = $this->_func_lst_server();
//        {list_user_id: "1,23", list_items: "56-7,899-12", note: "test nội dung 5", sub: "1"}
//        $server = $this->input->post('server');
        $server_name = $server_cf[$this->input->post('server')]['main'];

        $type = $this->input->post('type');
        $list_user_id = $this->input->post('list_user_id');
        $list_items = $this->input->post('list_items');
        $note = $this->input->post('note');
        $sub = $this->input->post('sub');
        $id_admin_item_step1 = $this->input->post('id_admin_item_step1');
        $admin_nick = $this->_uid;

        if ($type == 1) { // duyệt
            $dataSubmit = array(
                'list_user_id' => $list_user_id,
                'list_items' => $list_items,
                'note' => $note,
                'sub' => $sub,
                'admin_nick' => $admin_nick,
            );
            $dataupdate = array(
                'date_process' => date('Y-m-d H:i:s'),
                'admin_confirm' => $admin_nick,
                'status' => 1
            );

            if ($this->Add_items_model->create($dataSubmit,$server_name)) {
                //update table Add_items_step1
                $this->Add_items_step1_model->update($id_admin_item_step1, $dataupdate,$server_name);

                echo $id_admin_item_step1;
            } else {
                echo false;
            }
        } else if ($type == 0) { //hủy
            if ($this->Add_items_step1_model->delete($id_admin_item_step1,$server_name)) {

                echo $id_admin_item_step1;
            } else {
                echo false;
            }
        }


    }
}