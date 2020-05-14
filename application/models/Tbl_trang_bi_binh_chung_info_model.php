<?php

Class Tbl_trang_bi_binh_chung_info_model extends MY_Model
{
    var $table = 'tbl_trang_bi_binh_chung_info';

    function __construct()
    {
        parent::__construct();
        $this->db = $this->load->database('main', TRUE);
//        $this->db = $this->load->database('account', TRUE);
    }

}