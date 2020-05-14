<?php

Class Gift_type_model extends MY_Model
{
    var $table = 'tbl_gift_type';

    function __construct() // từ từ anh bảo; ý là cádi
    {
        parent::__construct();
        $this->db = $this->load->database('main', TRUE);
        //bang 2 lay cai gi ay nhi lisst o table: goy y
    }

    function lst_gift_type()
    {
        $lstdata = $this->Gift_type_model->get_list('','','');

        $type_status_end = array();
        foreach ($lstdata as $key => $value) {
            $type_status_end[$value->id] = $value->name;
        }

        return $type_status_end;
    }


    function lst_gift_type_by_server($server_name)
    {
//        if ($server_name != '') {
//            $this->db = $this->load->database($server_name, TRUE);
//        }

        $lstdata = $this->Gift_type_model->get_list('','',$server_name);

        $type_status_end = array();
        foreach ($lstdata as $key => $value) {
            $type_status_end[$value->id] = $value->name;
        }

//        var_dump($type_status_end);

        return $type_status_end;
    }

}