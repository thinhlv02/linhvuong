<?php

Class Users_model extends MY_Model
{
    var $table = 'users';

    function __construct() // từ từ anh bảo; ý là cádi
    {
        parent::__construct();
        //$this->db = $this->load->database('account', TRUE);
    }



    public function get_count_all()
    {
        $sql = "select count(id) total_dk, a.`created_at`  from users a group by date(a.`created_at`)
        ";
//        var_dump($sql);
        $rows = $this->db->query($sql);
        return $rows->result();
    }
}