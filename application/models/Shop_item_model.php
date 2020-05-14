<?php

Class Shop_item_model extends MY_Model
{
    var $table = 'tbl_shop_item';

    function __construct() // từ từ anh bảo; ý là cádi
    {
        parent::__construct();
//        $this->db = $this->load->database('account', TRUE);
        //bang 2 lay cai gi ay nhi lisst o table: goy y
    }

    function _get_unit_arr()
    {
        $lstdata = array(
            '1' => 'Vàng',
            '2' => 'Bạc',
            '3' => 'Lúa',
        );
        $lstdata_end = [];
        foreach ($lstdata as $k => $v) {
            $lstdata_end[$k] = $v;
        }
        return $lstdata_end;
    }

}