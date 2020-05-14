<?php

Class Tbl_paddy_logs_model extends MY_Model
{
    var $table = 'tbl_paddy_logs';

    function __construct()
    {
        parent::__construct();
        $this->db = $this->load->database('logs', TRUE);
    }

    public function get_list_all($input, $userid)
    {
        $sql = "select * from tbl_paddy_logs where user_id = $userid $input order by id desc ";

//        var_dump($sql);
        $rows = $this->db->query($sql);
        return $rows->result();
    }

}