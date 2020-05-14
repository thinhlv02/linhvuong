<?php

Class Tbl_book_info_model extends MY_Model
{
    var $table = 'tbl_book_info';

    function __construct()
    {
        parent::__construct();
        $this->db = $this->load->database('main', TRUE);
//        $this->db = $this->load->database('account', TRUE);
    }

}