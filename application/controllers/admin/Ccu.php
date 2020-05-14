<?php

Class Ccu extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Ccu_model');
    }

    function index()
    {
        $server_cf = $this->_server_cf;

        $message = $this->session->flashdata('message');
        $this->data['message'] = $message;
//        $input = array();
//        $input['where']['type'] = 1;
//        $input['order'] = array('id', 'desc');

//        $ccu = $this->ccu_model->get_list($input);
//        $this->data['res'] = $ccu;
//        pre($ccu);
        $date1 = $date2 = date('Y-m-d');

        $ccu_arr_custom = [];
        $ccu_arr = [];
        if ($this->input->post('search')) {
            $server_name = $server_cf[$this->input->post('server')]['logs'];
//            pre($server_name);
            $date1 = date('Y-m-d', strtotime($this->input->post('date1')));
            $date2 = date('Y-m-d', strtotime($this->input->post('date2')));
//            $ccu = $this->Ccu_model->function_getlist_ccu($date1, $date2);


        $date1x = date_create(" " . $date1 . " ");
        $date2x = date_create(" " . $date2 . " ");
        $diff = date_diff($date1x, $date2x);
        $go = $diff->format("%a");

//        else {
        $ccu = $this->Ccu_model->function_getlist_ccu($date1, $date2, $go,$server_name);
        $ccu_arr = array();
        if ($go> 2) {
            $ccu = $this->Ccu_model->function_getlist_ccu($date1, $date2, $go,$server_name);

            $i = 0;

            foreach ($ccu as $key => $value) {
                $i++;
                $ccu_arr[$i] = new stdClass();
                $ccu_arr[$i]->TIME = $value->date;
                $ccu_arr[$i]->ccutong = $value->total;
                $ccu_arr[$i]->ccu_min = $value->ccu_min;

//                $tags = explode(',', $value->ccu_provider);
//                $ccu_arr[$i]->xxx = $tags;
//                $ccu_arr[$i]->android = '';
//                $ccu_arr[$i]->ios = '';
//                $ccu_arr[$i]->ccu_web = '';

//                foreach ($tags as $key2 => $value2) {
//                    if (isset($value2[0]) && $value2[0] != '') {
//                        $ccu_arr[$i]->android = explode(':', $value2[0])[0];
////                        $ccu_arr[$i]->android = explode(':', $value2[0])[1];
//                    }
//                    if (isset($value2[1]) && $value2[1] != '') {
//                        $ccu_arr[$i]->ios = explode(':', $value2[1])[0];
//                    }
//                    if (isset($value2[2]) && $value2[2] != '') {
//                        $ccu_arr[$i]->ccu_web = explode(':', $value2[2])[0];
//                    }
//                }
            }
        } else {

            $ccu = $this->Ccu_model->function_getlist_ccu($date1, $date2, $go,$server_name);

            $i = 0;

            foreach ($ccu as $key => $value) {
                $i++;
                $ccu_arr[$i] = new stdClass();
                $ccu_arr[$i]->TIME = $value->TIME;
                $ccu_arr[$i]->ccutong = $value->ccutong;

                $tags = explode(',', $value->ccu_provider);
                $ccu_arr[$i]->xxx = $tags;
                $ccu_arr[$i]->android = '';
                $ccu_arr[$i]->ios = '';
                $ccu_arr[$i]->ccu_web = '';

                foreach ($tags as $key2 => $value2) {
                    if (isset($value2[0]) && $value2[0] != '') {
                        $ccu_arr[$i]->android = explode(':', $value2[0])[0];
//                        $ccu_arr[$i]->android = explode(':', $value2[0])[1];
                    }
                    if (isset($value2[1]) && $value2[1] != '') {
                        $ccu_arr[$i]->ios = explode(':', $value2[1])[0];
                    }
                    if (isset($value2[2]) && $value2[2] != '') {
                        $ccu_arr[$i]->ccu_web = explode(':', $value2[2])[0];
                    }
                }
            }
        }


//        pre($ccu_arr);

        // cái này tính riêng cho table ở phía cuối cùng nhé

        $input = array();
        $input['order'] = array('id', 'desc');
        $input['limit'] = array('1', '0');
//        $ccu_device = $this->Ccu_model->get_list($input);
//        $ccu_custom = $this->Ccu_model->get_ccu_custom($input);

        if ($date1 == date('Y-m-d') && $date2 == date('Y-m-d')) {
            $date1 = new DateTime($date1);
            $date1->sub(new DateInterval('P2D'));

            $expirydate = $date1->format('Y-m-d');
            $date1 = $expirydate;

        }
            $ccu_arr_custom = $this->Ccu_model->get_ccu_custom($date1, $date2,$server_name);

//        $date = new DateTime($date1);
//        $date->sub(new DateInterval('P3D'));
//        $expirydate = $date->format('Y-m-d');
//
//        pre($expirydate);

//            pre($ccu);
            $this->data['ccu'] = $ccu_arr;
            $this->data['go'] = $go;

        }
        $this->data['temp'] = 'admin/ccu/list';
        $this->data['ccu_arr_custom'] = $ccu_arr_custom;

//        pre($ccu_arr);

        $this->data['server_cf'] = $server_cf;
        $this->load->view('admin/layout', $this->data);
    }
}