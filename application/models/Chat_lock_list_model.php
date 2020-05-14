<?php

Class Chat_lock_list_model extends MY_Model
{
    var $table = 'tbl_lock_chat_all';


    function update_custom($userid,$server_name)
    {
        if ($server_name != '') {
            $this->db = $this->load->database($server_name, TRUE);
        }
        $sql = "update tbl_lock_chat_all set `unlock` = 1 where user_id = ".$userid." ";

//        var_dump($sql);
//        $rows =

            if($this->db->query($sql)) {
                return true;
            }
            return false;
//        return $rows->result();
    }

}