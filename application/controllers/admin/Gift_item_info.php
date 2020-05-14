<?php

Class Gift_item_info extends MY_Controller
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

    function ajax_list_gift_type_by_server()
    {
        $server_cf = $this->_func_lst_server();
        $server_post = $this->input->post('server');

        $server_name = $server_cf[$server_post]['main'];
        //change when onchange selected server
        $data = $this->Gift_type_model->lst_gift_type_by_server($server_name);

//        var_dump($data);

//        return $data;
//        echo 'i am server ' . $server_name;

        $this->data['server_post'] = $server_post;
        $this->data['lst_gift_type'] = $data;
//        $this->data['name_field'] = $name_field;

        $this->load->view($this->_template_f . 'gift_item_info/_gift_type_by_server', $this->data);

    }


    function index()
    {
        $server_cf = $this->_func_lst_server();
//        pre($this->lst_gift_item_info_);
        $message = $this->session->flashdata('message');
        $this->data['message'] = $message;
        $lstdata_end = array();
        if ($this->input->post('btnAddemployee')) {

            $server_name = $server_cf[$this->input->post('server')]['main'];

            $lstdata = $this->Gift_item_info_model->get_list(array('order' => array('name', 'asc')), '', $server_name);

            foreach ($lstdata as $key => $value) {

                $lstdata_end[$key]['id'] = $value->id;
                $lstdata_end[$key]['info_id'] = $value->info_id;
                $lstdata_end[$key]['name'] = $value->name;
                $lstdata_end[$key]['type'] = $value->type;
                $lstdata_end[$key]['type_name'] = isset($this->lst_gift_type[$value->type]) ? $this->lst_gift_type[$value->type] : 'dcm';
                $lstdata_end[$key]['status'] = $value->status;

            }
        }

        $this->data['server_cf'] = $server_cf;
        $this->data['lstdata'] = $lstdata_end;
//        $this->data['lst_gift_type'] = $this->lst_gift_type;
//        pre($lstdata_end);

        $this->data['temp'] = $this->_template_f . 'gift_item_info/view_index';
        $this->load->view('admin/layout', $this->data);
    }

    function add()
    {
        $server_cf = $this->_func_lst_server();
//        pre($this->lst_gift_item_info_);
        $message = $this->session->flashdata('message');
        $this->data['message'] = $message;

        $this->data['server_cf'] = $server_cf;
//        $this->data['lstdata'] = $lstdata_end;
        $this->data['lst_gift_type'] = $this->lst_gift_type;
//        pre($lstdata_end);

        $this->data['temp'] = $this->_template_f . 'gift_item_info/add';
        $this->load->view('admin/layout', $this->data);
    }

    function ajax_get_list_gift_item_by_type()
    {
        $server_cf = $this->_func_lst_server();
        $server_name = $server_cf[$this->input->post('server')]['main'];
//        echo '111111'.$server_name;
//        die();
        $type = $this->input->post('type');
        $selected = $this->input->post('selected');

        //get list tbl_gift_item_info_by_type

        $lst_gift_item_info_by_type = $this->Gift_item_info_model->get_list(array('where' => array('type' => $type)), '', $server_name);

        $lst_gift_item_info_by_type_end = [];
        foreach ($lst_gift_item_info_by_type as $k => $value) {
            $lst_gift_item_info_by_type_end[$value->info_id] = $value->info_id;
        }
//        pre($lst_gift_item_info_by_type_end);
        //get list tbl_gift_item_info_by_type
//        echo 'abc' . $type;
        $lstdata = [];
        $model = '';
        $input = [];


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


//        if ($type == 1) {

//        pre($input);
        $lstdata = $this->$model->get_list($input, '', $server_name);
//        }
        $name_field = 'name';
        if ($type == 4) {
            $name_field = 'gem_name';
        }
        $lstdata_end = [];
        foreach ($lstdata as $key => $value) {
            $lstdata_end[$value->id]['id'] = $value->id;
            $lstdata_end[$value->id]['name'] = $value->$name_field;
            if ($selected == 1) {
                $lstdata_end[$value->id]['selected'] = isset($lst_gift_item_info_by_type_end[$value->id]) ? '1' : '0';
            }
        }
//        pre($lstdata_end);
        $this->data['lstdata'] = $lstdata_end;
//        $this->data['name_field'] = $name_field;

        $this->load->view($this->_template_f . 'gift_item_info/view_form_select', $this->data);
    }


    function ajax_get_tbl_gift_item_info_by_server()
    {
        $server_cf = $this->_func_lst_server();
        $server_name = $server_cf[$this->input->post('server')]['main'];
//        echo '111111'.$server_name;
//        die();


        //get list tbl_gift_item_info_by_type

        $lst_data = $this->Gift_item_info_model->get_list('', '', $server_name);

        $lstdata_arr = [];
        foreach ($lst_data as $k => $v) {
//            $lstdata_arr[$v->info_id] = $v->name;
            $lstdata_arr[$v->id] = $v->name;
        }

//        var_dump($data);
//        die();

        $this->data['lst_gift_item_info_'] = $lstdata_arr;

//        var_dump($lst_data);

        $this->load->view($this->_template_f . 'gift_item_info/_gift_item_info_by_server', $this->data);
    }


    function ajax_insert_data()
    {
        $server_cf = $this->_func_lst_server();

        $server_name = $server_cf[$this->input->post('server')]['main'];
        $type = $this->input->post('type');
        $info = explode('-', $this->input->post('info'));
//
//        pre($info);
//        die();

        if ($info[0] == '') {
            echo 'chưa chọn vật phẩm';
        } else {

            $data_submit = array(
                'info_id' => $info[0],
                'name' => $info[1],
                'type' => $type,
            );

//        pre($data_submit);

            if ($this->Gift_item_info_model->create($data_submit, $server_name)) {
                echo 'Thành công server: ' . $server_name;
//            return true;
//            $this->session->set_flashdata('message', 'Thêmthành công!');
//            redirect(base_url('admin/shop_item/add_shop_item'));

            } else {
                echo 'Thất bại';
//            $this->session->set_flashdata('message', 'Thêm thất bại!');
//            redirect(base_url('admin/shop_item/add_shop_item'));
            }
        }
    }


    function ajax_set_status()
    {
        $server_cf = $this->_func_lst_server();

        $server_name = $server_cf[$this->input->post('server_id')]['main'];

        $pk_id = trim($this->input->post('pk_id'));

        $status = trim($this->input->post('status'));
        $status = in_array($status, array('1', '0')) ? $status : '1';

        // var_dump($pk_info, $msg);die;
        if ($this->Gift_item_info_model->update($pk_id, array('status' => $status),$server_name)) {

            echo 'ok';
        } else {

            die('false');
        }

    }


}