<?php

Class Tbl_gift_check_in_model extends MY_Model
{
    var $table = 'tbl_gift_check_in';

    function __construct()
    {
        parent::__construct();
        $this->db = $this->load->database('main', TRUE);
    }

}