<?php

Class Session_logs_model extends MY_Model
{
    var $table = 'session_log';

    function __construct() // từ từ anh bảo; ý là cádi
    {
        parent::__construct();
        $this->db = $this->load->database('logs', TRUE);

    }

    public function get_list_all($input, $userid)
    {
        $sql = "select * from session_log where user_id = $userid $input ";

//        var_dump($sql);
        $rows = $this->db->query($sql);
        return $rows->result();
    }
}