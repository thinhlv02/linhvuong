<?php

Class Menu_access_model extends MY_Model
{
    var $table = 'menu_access';

    function __construct() // từ từ anh bảo; ý là cádi
    {
        parent::__construct();
//        $this->db = $this->load->database('account', TRUE);
        //bang 2 lay cai gi ay nhi lisst o table: goy y
    }

    function get_em_arr()
    {
        $rows = $this->db->query('select a.`employee_id` from `menu_access` a group by a.`employee_id`');

        return $rows->result();

    }

    function delete_menu_access($menu_id)
    {

      $this->db->query("DELETE FROM menu_access WHERE menu_id= '".$menu_id."' ");

    }
}