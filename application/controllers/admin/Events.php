<?php

Class Events extends MY_Controller
{
    var $lst_gift_item_info_ = '';

    function __construct()
    {
        parent::__construct();
        $this->load->model('events_model');
        $this->load->model('Gift_item_info_model');

        $this->lst_gift_item_info_ = $this->Gift_item_info_model->_get_info_id_arr('');
    }

    function get_lst_gift_item_info__by_server($server_name)
    {
        $data = $this->Gift_item_info_model->_get_info_id_arr($server_name);
        return $data;
    }

    function index()
    {
        $server_cf = $this->_func_lst_server();

        $lstdata_end = [];
        if ($this->input->post('btnSearch')) {
            $server_name = $server_cf[$this->input->post('server')]['main'];


            $message = $this->session->flashdata('message');
            $this->data['message'] = $message;
            $lst_event_type = $this->events_model->list_type_events();
//        pre($lst_event_type);
            $lstdata = $this->events_model->get_list('', '', $server_name);
            $lstdata_end = [];
            foreach ($lstdata as $k => $v) {
                $lstdata_end[$k]['id'] = $v->id;
                $lstdata_end[$k]['events_title'] = $v->events_title;
                $lstdata_end[$k]['content'] = $v->content;
                $lstdata_end[$k]['events_link'] = $v->events_link;
                $lstdata_end[$k]['image_link'] = $v->image_link;
                $lstdata_end[$k]['list_gift'] = $v->list_gift;
                $lstdata_end[$k]['date_open'] = $v->date_open;
                $lstdata_end[$k]['date_close'] = $v->date_close;
                $lstdata_end[$k]['gold_condition'] = $v->gold_condition;
                $lstdata_end[$k]['status'] = $v->status;
                $lstdata_end[$k]['type'] = $v->type;
                $lstdata_end[$k]['type_name'] = isset($lst_event_type[$v->type]) ? $lst_event_type[$v->type] : '';
            }

//        pre($lstdata_end);
            $this->data['lst_gift_item_info_'] = $this->get_lst_gift_item_info__by_server($server_name);
        }
        $this->data['server_cf'] = $server_cf;
        $this->data['lstdata'] = $lstdata_end;
        $this->data['temp'] = $this->_template_f . 'events/view_index';
        $this->load->view('admin/layout', $this->data);
    }

    function add()
    {
        $server_cf = $this->_func_lst_server();

        if ($this->input->post('btnSearch')) {
            //08/04/2019 0:00:00 - 08/04/2019 23:59:59
            $reportdatetime = explode('-', $this->input->post('reportdatetime'));
            $date_open = str_replace("/", "-", $reportdatetime[0]);// $reportdatetime[0];            $reportdatetime[0];

            $date_close = str_replace("/", "-", $reportdatetime[1]);// $reportdatetime[0]; $reportdatetime[1];
            $type = $this->input->post('type');
            $events_title = $this->input->post('events_title');
            $content = $this->input->post('content');
//            $server = $this->input->post('server');
            $server_name = $server_cf[$this->input->post('server')]['main'];

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
                            $this->session->set_flashdata('message', 'Nhập số lượng cho vật phẩm đã checkbox');
                            redirect(admin_url('events'));
                        }
                    }
                }

                $list_items = implode(",", $tmp);


                $datasubmit = array(
                    'events_title' => $events_title,
                    'content' => $content,
                    'date_open' => date('Y-m-d H:i:s', strtotime($date_open)),
                    'date_close' => date('Y-m-d H:i:s', strtotime($date_close)),
                    'type' => $type,
                    'list_gift' => $list_items,
                );
//                var_dump($datasubmit);

                if ($this->events_model->create($datasubmit,$server_name)) {
//            echo $list_items;

                    $this->session->set_flashdata('message', 'Thêm thành công!');
                    redirect(admin_url('events'));
//                    echo 'thành công';
                } else {
                    $this->session->set_flashdata('message', 'Thêm thất bại!');
                    redirect(admin_url('events'));
//                    echo 'thất bại';
                }

            }

        }


//        pre($lstdata_end);
        $this->data['lst_gift_item_info_'] = $this->lst_gift_item_info_;
        $this->data['server_cf'] = $server_cf;

        $this->data['temp'] = $this->_template_f . 'events/add';
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
        $server_cf = $this->_func_lst_server();
        $server_name = $server_cf[$server]['main'];
//        pre($id_edit);
        $lstdata = $this->events_model->get_info($id_edit,'',$server_name);
//        pre($lstdata);


        if ($this->input->post('btnSearch')) {
            $type = $this->input->post('type');
            $events_title = $this->input->post('events_title');
            $content = $this->input->post('content');


            $date1 = str_replace("/", "-", $this->input->post('date1'));// $reportdatetime[0];            $reportdatetime[0];
            $date1 = date('Y-m-d H:i:s', strtotime($date1));
//            pre($date1);
//            die();

            $date2 = str_replace("/", "-", $this->input->post('date2'));// $reportdatetime[0];            $reportdatetime[0];
            $date2 = date('Y-m-d H:i:s', strtotime($date2));

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
                            redirect(admin_url('events'));
//                    echo 'thành công';
                        }
                    }
                }

                $list_items = implode(",", $tmp);

                $datasubmit = array(
                    'events_title' => $events_title,
                    'content' => $content,
                    'type' => $type,
                    'date_open' => $date1,
                    'date_close' => $date2,
                    'list_gift' => $list_items,
                );
//                pre($datasubmit);
//                die();

                if ($this->events_model->update($id_edit, $datasubmit,$server_name)) {
//            echo $list_items;


                    $this->session->set_flashdata('message', 'thành công!');
                    redirect(admin_url('events'));
//                    echo 'thành công';
                } else {
                    $this->session->set_flashdata('message', 'thất bại!');
                    redirect(admin_url('events'));
//                    echo 'thất bại';
                }

            }

        }

        $this->data['lstdata'] = $lstdata;
//        $this->data['lst_item_by_type_end'] = $lst_item_by_type_end;
        $this->data['lst_gift_item_info_'] = $this->lst_gift_item_info_;
//        $this->data['lst_gift_type'] = $this->lst_gift_type;
//        $this->data['lst_gift_unit'] = $this->lst_gift_unit;
        $this->data['temp'] = $this->_template_f . 'events/edit';
        $this->load->view('admin/layout', $this->data);
    }

    function del()
    {
        $id = $this->uri->segment(4);
        $server = $this->uri->segment(5);

        $server_cf = $this->_func_lst_server();
        $server_name = $server_cf[$server]['main'];
        $lstdata = $this->events_model->get_info($id, '', $server_name);

        if ($lstdata == null) {
            $this->session->set_flashdata('message', 'Không tồn tại');
            redirect(admin_url('events'));
        } else {
            if ($this->events_model->delete($id,$server_name)) {

                $this->session->set_flashdata('message', 'Xóa thành công!');

                redirect(admin_url('events'));

            } else {
                $this->session->set_flashdata('message', 'Thao tác không thành công!');

                redirect(admin_url('events'));

            }

        }

    }

    function edit_events()
    {


    }

    function ajax_edit_evt()
    {

    }
}