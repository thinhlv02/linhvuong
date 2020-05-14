<?php

Class Gopy_model extends MY_Model
{
    var $table = 'gopy';

    function __construct() // từ từ anh bảo; ý là cádi
    {
        parent::__construct();
        $this->db = $this->load->database('logs', TRUE);
    }
}