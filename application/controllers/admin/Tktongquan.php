<?php

Class Tktongquan extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Cutoff_chiso_model');
        $this->load->model('Users_model');

//        $input = array();
//        $input['where'] = array(
//            'role' => 2
//        );
//        $emp = $this->employee_model->get_list($input);
//        $this->data['emp'] = $emp;
    }

    function index()
    {
        $message = $this->session->flashdata('message');
        $this->data['message'] = $message;
        $server_cf = $this->_func_lst_server();

        $lstacc = [];

        if ($this->input->post('btnSearch')) {
            $server_name = $server_cf[$this->input->post('server')]['logs'];

            $lstacc = $this->Cutoff_chiso_model->get_list(array('order' => array('id', 'desc')), '', $server_name);

        }
        $this->data['server_cf'] = $server_cf;
        $this->data['lstdata'] = $lstacc;
        $this->data['temp'] = $this->_template_f. 'tktongquan/view_index';
        $this->load->view('admin/layout', $this->data);
    }

}