<?php

Class Tbl_gem_info_model extends MY_Model
{
    var $table = 'tbl_gem_info';

    function __construct()
    {
        parent::__construct();
        $this->db = $this->load->database('main', TRUE);
//        $this->db = $this->load->database('account', TRUE);
    }

}