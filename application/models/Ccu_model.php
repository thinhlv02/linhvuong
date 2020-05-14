<?php

Class Ccu_model extends MY_Model
{
    var $table = 'ccu_log';

    function __construct()
    {
        parent::__construct();
//        $this->db = $this->load->database('logs', TRUE);
    }

    public function function_getlist_ccu($date1, $date2, $go,$server_name)
    {
        $this->db = $this->load->database($server_name, TRUE);
        $add = "";
//        if ($date1 != '' && $date2 != '') {
        $add = "AND DATE(`date`) BETWEEN '" . $date1 . "' AND '" . $date2 . "' ";


//        echo $go;

        if ($go == 0) {
            $sql = "SELECT TIME,(total) AS ccutong,ccu_provider FROM `ccu_log` WHERE id > 0  $add";
        } else if ($go > 0 && $go < 3) {
            $sql = "SELECT TIME,MAX(total) AS ccutong,MAX(ccu_provider) ccu_provider
                    FROM `ccu_log` WHERE id > 0 $add GROUP BY DATE(`date`), DATE_FORMAT(`time`,'%H')";
        } else if ($go > 2) {
            $sql = "SELECT t1.date, t1.time, t1.total , t2.ccu_min
FROM linhvuongmobile_logs.`ccu_log` t1
INNER JOIN
(
    SELECT `date`, MAX(total) AS max_total,  MIN(total) AS ccu_min
    FROM linhvuongmobile_logs.`ccu_log`
    GROUP BY DATE(date)
) t2
    ON t1.`date` = t2.`date` AND t1.total = t2.max_total 
    where date(t1.date) between '".$date1."' and '".$date2."'
    group by date(t1.date)";
        }
//        }

//        else {
//            $add = " AND DATE(DATE) = DATE(NOW())";
//            $sql = "SELECT TIME,(total) AS ccutong,ccu_provider
//              FROM `ccu_log` WHERE id > 0  $add";
//        }
//                    var_dump($sql);
        $rows = $this->db->query($sql);
        return $rows->result();
    }

    public function get_ccu_custom($date1, $date2,$server_name)
    {
        $this->db = $this->load->database($server_name, TRUE);
        $rows = $this->db->query("
        SELECT t1.date, t1.time, t1.total,t1.`android`,t1.`ios`	
            FROM `ccu_log` t1
            INNER JOIN
            (
                SELECT `date`, MAX(total) AS max_total
                FROM `ccu_log`
                GROUP BY DATE(date)
            ) t2
                ON t1.`date` = t2.`date` AND t1.total = t2.max_total 
                where date(t1.date) between '" . $date1 . "' and '" . $date2 . "'
                group by date(t1.date);
        ");
        return $rows->result();

    }
}