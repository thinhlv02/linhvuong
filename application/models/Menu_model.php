<?php

Class Menu_model extends MY_Model
{
    var $table = 'menu';

    function __construct() // từ từ anh bảo; ý là cádi
    {
        parent::__construct();
        //$this->db = $this->load->database('account', TRUE);
        //bang 2 lay cai gi ay nhi lisst o table: goy y
    }
}