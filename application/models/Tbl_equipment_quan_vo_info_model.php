<?php

Class Tbl_equipment_quan_vo_info_model extends MY_Model
{
    var $table = 'tbl_equipment_quan_vo_info';

    function __construct()
    {
        parent::__construct();
        $this->db = $this->load->database('main', TRUE);
//        $this->db = $this->load->database('account', TRUE);
    }

}