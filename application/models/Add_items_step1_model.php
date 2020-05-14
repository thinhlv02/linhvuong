<?php

Class Add_items_step1_model extends MY_Model
{
    var $table = 'admin_add_items_step1';

    function __construct()
    {
        parent::__construct();
        $this->db = $this->load->database('main', TRUE);
//        $this->db = $this->load->database('account', TRUE);
        //bang 2 lay cai gi ay nhi lisst o table: goy y
    }

//    public function function_getlist()
//    {
//        $sql = "
//         SELECT
//  a.`id`,
//  a.`UserName`,
//  a.`Password`,
//  a.`employee_id`,
//  b.`name`,
//  b.`level`,
//  c.`level_name`
//FROM
//  `adusers` a
//  JOIN `employee` b
//    ON a.`employee_id` = b.`id`
//  JOIN `level` c
//    ON b.`level` = c.`id`
//WHERE a.`UserName` NOT IN ('admin')
//        ";
////        var_dump($sql);
//        $rows = $this->db->query($sql);
//        return $rows->result();
//    }
}