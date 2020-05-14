<?php

Class Player_model extends MY_Model
{
    var $table = 'player';

    function __construct() // từ từ anh bảo; ý là cádi
    {
        parent::__construct();
//        $this->db = $this->load->database('normal', TRUE);

    }

    public function get_array_level($from, $to,$server_name)
    {
        $this->db = $this->load->database($server_name, TRUE);

        $where = '';
        if ($from != '' && $to != '') {
            $where = " where date(`logout_time`) between '".$from."' AND '".$to."' ";
        }
        $sql = "
            select count(*) as total, level, vip from player $where  group by level, vip;
        ";
//
//        var_dump($sql);
        $rows = $this->db->query($sql);
        return $rows->result();
    }

    //get all player to array and use
    function player_get_all($server_name) {
        $this->db = $this->load->database($server_name, TRUE);
        $lst = $this->Player_model->get_list('','',$server_name);

        $lst_arr = [];
        foreach ($lst as $k => $value) {
            $lst_arr[$value->user_id]['userid'] = $value->user_id;
            $lst_arr[$value->user_id]['nick'] = $value->user_name;
        }
        return $lst_arr;
    }
}