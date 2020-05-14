<?php

Class Tbl_gift_check_in extends MY_Controller
{
    var $lst_gift_item_info_ = '';

    function __construct()
    {
        parent::__construct();
        $this->load->model('Tbl_gift_check_in_model');
        $this->load->model('Gift_item_info_model');


//        $evt = $this->events_model->demo();
//        pre($evt);
        // $this->data['evt'] = $evt;

        $this->lst_gift_item_info_ = $this->Gift_item_info_model->_get_info_id_arr('');
    }

    function index()
    {
        $message = $this->session->flashdata('message');
        $this->data['message'] = $message;
        $server_cf = $this->_func_lst_server();

//        pre($pack_id[0]->pack_id);
//        $value1_check = $this->branch_model->check_branch(21);
//        pre($value1_check);
        $lstdata_end = [];

        if ($this->input->post('btnSearch')) {

            $server_name = $server_cf[$this->input->post('server')]['main'];

            $lstdata = $this->Tbl_gift_check_in_model->get_list('', '', $server_name);

            foreach ($lstdata as $k => $v) {
                $lstdata_end[$k]['id'] = $v->id;
                $lstdata_end[$k]['list_server_id'] = $v->list_server_id;
                $lstdata_end[$k]['pack_id'] = $v->pack_id;
                $lstdata_end[$k]['pack_name'] = $v->pack_name;
                $lstdata_end[$k]['list_items'] = $v->list_items;
            }
//        pre($lstdata_end);

            $this->data['lst_gift_item_info_'] = $this->Gift_item_info_model->_get_info_id_arr($server_name);

        }

        $this->data['lstdata'] = $lstdata_end;
        $this->data['server_cf'] = $server_cf;
        $this->data['temp'] = $this->_template_f . 'tbl_gift_check_in/view_index';
        $this->load->view('admin/layout', $this->data);
    }


    function add()
    {
        $server_cf = $this->_func_lst_server();

//        pre($pack_id[0]->pack_id);
//        $value1_check = $this->branch_model->check_branch(21);
//        pre($value1_check);
        if ($this->input->post('btnSearch')) {

            $server_name = $server_cf[$this->input->post('server')]['main'];


            $pack_id = $this->Tbl_gift_check_in_model->get_list(array(
                'order' => array('id', 'desc'),
                'limit' => array('1', '0')

            ), 'pack_id', $server_name);
            $pack_id = $pack_id[0]->pack_id;

            $pack_name = $this->input->post('pack_name');
            $list_server_id = $this->input->post('list_server_id');

            $itemKeys = $this->input->post('itemKeys');
            $itemValues = $this->input->post('itemValues');
//            var_dump($_POST);

            $tmp = [];
            if ($itemKeys != null) {


                foreach ($itemKeys as $key => $value) {
                    if (isset($itemValues[$key])) {
                        if ($itemValues[$key] != '') {
                            $tmp[] = $key . "-" . $itemValues[$key];
                        } else {
                            // die
                            $this->session->set_flashdata('message', 'Nhập đúng số lượng đã checkbox vật phẩm!');
                            redirect(admin_url('Tbl_gift_check_in'));
//                    echo 'thành công';
                        }
                    }
                }

                $list_items = implode(",", $tmp);

                $datasubmit = array(
                    'pack_name' => $pack_name,
                    'pack_id' => $pack_id + 1,
                    'list_items' => $list_items,
                    'list_server_id' => $list_server_id,
                );
//                var_dump($datasubmit);

                if ($this->Tbl_gift_check_in_model->create($datasubmit, $server_name)) {
//            echo $list_items;


                    $this->session->set_flashdata('message', 'Thêm thành công: ' . $server_name);
                    redirect(admin_url('Tbl_gift_check_in'));

                } else {
                    $this->session->set_flashdata('message', 'Thêm thất bại!');
                    redirect(admin_url('Tbl_gift_check_in'));

                }

            }

        }

        $message = $this->session->flashdata('message');
        $this->data['message'] = $message;

//        pre($lstdata_end);
        $this->data['lst_gift_item_info_'] = $this->lst_gift_item_info_;

        $this->data['server_cf'] = $server_cf;
        $this->data['temp'] = $this->_template_f . 'tbl_gift_check_in/_view_add';
        $this->load->view('admin/layout', $this->data);
    }

    function edit()
    {
        $message = $this->session->flashdata('message');
        $this->data['message'] = $message;

        $id_edit = $this->uri->segment(4);
        $id_edit = intval($id_edit);

        $server = $this->uri->segment(5);
        $server = intval($server);
//        pre($id_edit);

        $server_cf = $this->_func_lst_server();
        $server_name = $server_cf[$server]['main'];


        $lstdata = $this->Tbl_gift_check_in_model->get_info($id_edit, '', $server_name);
//        pre($lstdata);


        if ($this->input->post('btnSearch')) {
            $pack_name = $this->input->post('pack_name');
            $list_server_id = $this->input->post('list_server_id');

            $itemKeys = $this->input->post('itemKeys');
            $itemValues = $this->input->post('itemValues');
//            var_dump($_POST);

            $tmp = [];
            if ($itemKeys != null) {


                foreach ($itemKeys as $key => $value) {
                    if (isset($itemValues[$key])) {
                        if ($itemValues[$key] != '') {
                            $tmp[] = $key . "-" . $itemValues[$key];
                        } else {
                            // die
                            $this->session->set_flashdata('message', 'Nhập đúng số lượng đã checkbox vật phẩm!');
                            redirect(admin_url('Tbl_gift_check_in'));
//                    echo 'thành công';
                        }
                    }
                }

                $list_items = implode(",", $tmp);

                $datasubmit = array(
                    'pack_name' => $pack_name,
                    'list_items' => $list_items,
                    'list_server_id' => $list_server_id,
                );
//                var_dump($datasubmit);

                if ($this->Tbl_gift_check_in_model->update($id_edit, $datasubmit, $server_name)) {
//            echo $list_items;


                    $this->session->set_flashdata('message', 'thành công '. $server_name);
                    redirect(admin_url('Tbl_gift_check_in'));
//                    echo 'thành công';
                } else {
                    $this->session->set_flashdata('message', 'thất bại!');
                    redirect(admin_url('Tbl_gift_check_in'));
//                    echo 'thất bại';
                }

            }

        }

        $this->data['lstdata'] = $lstdata;
//        $this->data['lst_item_by_type_end'] = $lst_item_by_type_end;
        $this->data['lst_gift_item_info_'] = $this->lst_gift_item_info_;
//        $this->data['lst_gift_type'] = $this->lst_gift_type;
//        $this->data['lst_gift_unit'] = $this->lst_gift_unit;
        $this->data['temp'] = $this->_template_f . 'tbl_gift_check_in/edit';
        $this->load->view('admin/layout', $this->data);
    }

    function del()
    {
        $id = $this->uri->segment(4);

        $server = $this->uri->segment(5);

        $server_cf = $this->_func_lst_server();
        $server_name = $server_cf[$server]['main'];

        $lstdata = $this->Tbl_gift_check_in_model->get_info($id,'',$server_name);

        if ($lstdata == null) {
            $this->session->set_flashdata('message', 'Không tồn tại');
            redirect(admin_url('Tbl_gift_check_in'));
        } else {
            if ($this->Tbl_gift_check_in_model->delete($id,$server_name)) {

                //update pack_id
                $lst_update = $this->Tbl_gift_check_in_model->get_list('','',$server_name);
                $pack_id = 0;
                foreach ($lst_update as $key => $value) {
                    $pack_id++;
                    $this->Tbl_gift_check_in_model->update($value->id, array('pack_id' => $pack_id), $server_name);
                }

                $this->session->set_flashdata('message', 'Xóa thành công!');

                redirect(admin_url('Tbl_gift_check_in'));

            } else {
                $this->session->set_flashdata('message', 'Thao tác không thành công!');

                redirect(admin_url('Tbl_gift_check_in'));

            }

        }

    }
}