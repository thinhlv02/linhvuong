<?php

Class Events_model extends MY_Model
{
    var $table = 'tbl_events';

    function __construct() // từ từ anh bảo; ý là cádi
    {
        parent::__construct();
//        $this->db = $this->load->database('normal', TRUE);
        //bang 2 lay cai gi ay nhi lisst o table: goy y
    }

    function list_type_events() {
        $lst = array(
            '1' => 'Event nạp',
            '2' => 'Event tiêu',
        );
        $lstdata = [];
        foreach ($lst as $k => $v) {
            $lstdata[$k] = $v;
        }
        return $lstdata;
    }

//    public function demo()
//    {
//        $sql = "
//            SELECT * from events
//        ";
//
//        var_dump($sql);
//        $rows = $this->db->query($sql);
//        return $rows->result();
//    }
}