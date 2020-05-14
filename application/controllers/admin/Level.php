<?php

Class Level extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Player_model');
    }

    function index()
    {
        $server_cf = $this->_server_cf;
        $message = $this->session->flashdata('message');
        $this->data['message'] = $message;
//        $this->data['lstdata'] = [];
//        $this->data['max_level'] = [];
        $from = $to = '';
        if ($this->input->post('btnAddSearch')) {
            $server_name = $server_cf[$this->input->post('server')]['main'];
            $from = date('Y-m-d', strtotime($this->input->post('txtFrom')));
            $to = date('Y-m-d', strtotime($this->input->post('txtTo')));
//        }
            $lstvip = $this->Player_model->get_array_level($from, $to,$server_name);
            //pre($lstvip);
            $args = [];
            $total_levels = [];
            foreach ($lstvip as $row) {
                $args[$row->vip][$row->level] = $row->total;
                if (!isset($total_levels[$row->level])) {
                    $total_levels[$row->level] = 0;
                }
                $total_levels[$row->level] += $row->total;
            }


            //pre($args);

            $max_level = 0;
            $all_levels = [];
            foreach ($args as $vip => $levels) {
                foreach ($levels as $level => $total) {
                    $all_levels[] = $level;
                }
            }
            if (!empty($all_levels)) {
                $max_level = max($all_levels);
//                pre($all_levels);
            }
            // trướ đc

//        die('aaaaaa');
//            $this->data['lstdata'] = [];
            $this->data['max_level'] = $max_level;
//            pre($max_level);
            $this->data['args'] = $args;
//            pre($args);
            $this->data['total_levels'] = $total_levels;
//            pre($total_levels);
            $this->data['total_vip'] = count($args);
//            pre(count($args));
//            pre($this->data);
        }
        $this->data['temp'] = $this->_template_f. 'tklevel/view_index_1';
        $this->data['server_cf'] = $server_cf;
        $this->load->view('admin/layout', $this->data);
    }

}