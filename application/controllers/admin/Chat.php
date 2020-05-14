<?php

Class Chat extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Chat_model');
        $this->load->model('Chat_lock_list_model');

    }

    function index()
    {
        $server_cf = $this->_func_lst_server();

        $lstdata_end = array();
        $input = array();

        if ($this->input->post('btnSearch')) {
            $server_name = $server_cf[$this->input->post('server')]['main'];
            $server_name_logs = $server_cf[$this->input->post('server')]['logs'];
            //get list chat lock all
            $lst_lock_chat = $this->Chat_lock_list_model->get_list('', '', $server_name);
            $lst_lock_chat_end = array();
            foreach ($lst_lock_chat as $key => $value) {
                $lst_lock_chat_end[$value->user_id]['user_id'] = $value->user_id;
            }
//        pre($lst_lock_chat_end);
//        die();


//            pre($_POST);
            $user_id = $this->input->post('user_id');
//            pre($user_id);
            $display_name = $this->input->post('display_name');

            if ($user_id != '') {
                $input['where']['user_id'] = $user_id;
            }
            if ($display_name != '') {
                $input['where']['display_name'] = $display_name;
            }
//        }
//        pre($input);
            $lstdata_chat = $this->Chat_model->get_list($input, '', $server_name_logs);
//        pre($lstdata);

            $lstdata_end = array();
//        $data_2 = new stdClass();

//        foreach ($lstdata_chat as $key => $value) {
////            if (isset($lst_user_[$value->userid])) {
//            $lstdata_end[$value->user_id]['id'] = $value->id;
//            $lstdata_end[$value->user_id]['user_id'] = $value->user_id;
//            $lstdata_end[$value->user_id]['display_name'] = $value->display_name;
//            $lstdata_end[$value->user_id]['content'] = $value->content;
//            $lstdata_end[$value->user_id]['status'] = isset($lst_lock_chat_end[$value->user_id]) ? 1 : 0;
//
//        }

            foreach ($lstdata_chat as $key => $value) {
//            if (isset($lst_user_[$value->userid])) {
                $lstdata_end[$value->id]['id'] = $value->id;
                $lstdata_end[$value->id]['user_id'] = $value->user_id;
                $lstdata_end[$value->id]['display_name'] = $value->display_name;
                $lstdata_end[$value->id]['content'] = $value->content;
                $lstdata_end[$value->id]['status'] = isset($lst_lock_chat_end[$value->user_id]) ? 1 : 0;

            }

//        pre($lstdata_end);
        }
        $message = $this->session->flashdata('message');
        $this->data['message'] = $message;
        $this->data['lstdata'] = $lstdata_end;
        $this->data['server_cf'] = $server_cf;

        $this->data['temp'] = $this->_template_f . 'chat/view_index';
        $this->load->view('admin/layout', $this->data);
    }

    function ajax_lock_chat()
    {
        $server_cf = $this->_func_lst_server();
        $server_name = $server_cf[$this->input->post('server')]['main'];

        $id = $this->input->post('id');
        $user_id = $this->input->post('user_id');
        $display_name = $this->input->post('display_name');
        $content = $this->input->post('content');
        $type = $this->input->post('type');

//        echo 'idchat: '. $user_id;
//        echo '<br/>';
//        echo  'content: '.$content; // chỗ này đây, anh chỉ ehco 1 lần ?? hiểu.

        $dataSubmit = array(
            'user_id' => $user_id,
            'note' => $content,
        );

//        $data_update = array(
//            'unlock' => '1',
//            'id' => $id
//        );
//        pre($data_update);
//        die();

        if ($type == 1) {
            $id_insert = $this->Chat_lock_list_model->update_custom($user_id,$server_name);
        } else {
            $id_insert = $this->Chat_lock_list_model->create($dataSubmit,$server_name);
        }


        if ($id_insert) {
            echo $id . '-' . $display_name . '-' . $type;
        } else echo 'false';
    }

}