<?php

Class Binh_chung_info_model extends MY_Model
{
    var $table = 'tbl_binh_chung_info';

    function __construct() // từ từ anh bảo; ý là cádi
    {
        parent::__construct();
//        $this->db = $this->load->database('account', TRUE);
    }

    function get_list_all_binhchung_info($server_name)
    { //get all and map with tbl_binhcung_data
//        $this->db = $this->load->database($server_name, TRUE);

        $data = $this->Binh_chung_info_model->get_list('','',$server_name);
        $data_end = array();
        foreach ($data as $k => $v) {
            $data_end[$v->id]['id'] = $v->id;
            $data_end[$v->id]['country_id'] = $v->country_id;
            $data_end[$v->id]['binh_chung_type'] = $v->binh_chung_type;
            $data_end[$v->id]['level'] = $v->level;
        }
        return $data_end;

    }

    function binh_chung_type()
    {
//        EquipmentQuanVo = 1;
//        EquipmentQuanVan = 2;
//        EquipmentBinhChung = 3;
//        Gem = 4; Silver = 5; Gold = 6; exp = 7, paddy = 8, book = 9
        $type_status = array(
            '1' => 'Bộ binh',
            '2' => 'Giáo binh',
            '3' => 'Kỵ binh',//1: b? binh, 2: giáo binh, 3: k? binh, 4: cung binh
            '4' => 'cung binh'
        );

        $type_status_end = array();
        foreach ($type_status as $key => $value) {
            $type_status_end[$key]['type'] = $value;
        }

        return $type_status_end;
    }

//    public function function_getlist111111111()
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
//  `dalcheeni_lazum3`.`adusers` a
//  JOIN dalcheeni_lazum3.`employee` b
//    ON a.`employee_id` = b.`id`
//  JOIN dalcheeni_lazum3.`level` c
//    ON b.`level` = c.`id`
//WHERE a.`UserName` NOT IN ('admin')
//        ";
////        var_dump($sql);
//        $rows = $this->db->query($sql);
//        return $rows->result();
//    }
}