<?php

Class Gift_item_info_model extends MY_Model
{
    var $table = 'tbl_gift_item_info';

    function __construct()
    {
        parent::__construct();
        $this->db = $this->load->database('main', TRUE);

    }

    function _get_info_id_arr($server_name)
    {
        if ($server_name != '') {
            $this->db = $this->load->database($server_name, TRUE);
        }
//        $lstdata = $this->Gift_item_info_model->get_list(ar);
//
//
//
//        $lstdata_arr = [];
//        foreach ($lstdata as $k => $v) {
//            $lstdata_arr[$v->info_id] = $v->name;
//        }
//        return $lstdata_arr;


        $rows = $this->db->query("select * from tbl_gift_item_info order by name asc ");
        $lstdata =  $rows->result();

        $lstdata_arr = [];
        foreach ($lstdata as $k => $v) {
//            $lstdata_arr[$v->info_id] = $v->name;
            $lstdata_arr[$v->id] = $v->name;
        }
        return $lstdata_arr;

    }

}