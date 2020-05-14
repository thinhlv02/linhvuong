<?php

Class Cutoff_chiso_model extends MY_Model
{
    var $table = 'cutoff_chiso';

    function __construct() // từ từ anh bảo; ý là cádi
    {
        parent::__construct();
        $this->db = $this->load->database('logs', TRUE);
    }

}