<?php

Class Tbl_silver_logs_model extends MY_Model
{
    var $table = 'tbl_silver_logs';

    function __construct()
    {
        parent::__construct();
        $this->db = $this->load->database('logs', TRUE);
    }

    public function get_list_all($input, $userid)
    {
        $sql = "select * from tbl_silver_logs where user_id = $userid $input order by id desc ";

//        var_dump($sql);
        $rows = $this->db->query($sql);
        return $rows->result();
    }

}