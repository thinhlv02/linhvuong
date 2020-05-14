<?php

Class Gift_code_model extends MY_Model
{
    var $table = 'tbl_giftcode';

    function get_list_custom($where,$server_name)
    {
        if ($server_name != '') {
            $this->db = $this->load->database($server_name, TRUE);
        }

        $sql = "select * from tbl_giftcode where id > 0 $where order by time_send desc ";

        var_dump($sql);

                $rows = $this->db->query($sql);
        return $rows->result();
    }
}