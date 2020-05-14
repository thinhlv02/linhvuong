<?php

Class Tktaikhoan extends MY_Controller
{
    var $binh_chung_type = '';
    var $_player_arr = '';

//    var $server_cf = '';

    function __construct()
    {
        parent::__construct();
//        $this->load->model('admin_model');
        $this->load->model('Player_model');
        $this->load->model('Session_logs_model');
        $this->load->model('Users_model');
        $this->load->model('Binhchung_data_model');
        $this->load->model('Binh_chung_info_model');
        $this->load->model('Tbl_gold_logs_model');
        $this->load->model('Tbl_silver_logs_model');
        $this->load->model('Tbl_paddy_logs_model');
        $this->load->model('Tbl_gem_logs_model');
        $this->load->model('Tbl_horse_logs_model');
        $this->load->model('Tbl_book_logs_model');
        $this->load->model('Tbl_quan_gioi_logs_model');
        $this->binh_chung_type = $this->Binh_chung_info_model->binh_chung_type();
//        $this->server_cf = $this


//        $input = array();
//        $input['where'] = array(
//            'role' => 2
//        );
//        $emp = $this->employee_model->get_list($input);
//        $this->data['emp'] = $emp;
    }


    function player_get_all_by_server($server_name)
    {
        $data = $this->Player_model->player_get_all($server_name);
        return $data;
//        return 'test call aaaaaaa'.$server_name;
    }

    function index()
    {
        $server_cf = $this->_server_cf;
        $input = array();
        //lst users
        $lst_user = $this->Users_model->get_list(array('where_in' => array('provider_id', $this->_provider_id)), '', '');
        $lst_user_ = array();
        foreach ($lst_user as $key => $value) {
            $lst_user_[$value->user_id]['user_id'] = $value->user_id;
            $lst_user_[$value->user_id]['provider_id'] = $value->provider_id;
            $lst_user_[$value->user_id]['created_at'] = $value->time_reg;
        }
//        pre($lst_user_);
        $user_id_check_logs = '';
        $lstplayer_ = array();
        if ($this->input->post('btnSearch')) {
            $server_name = $server_cf[$this->input->post('server')]['main'];

            $userid = $this->input->post('userid');
//            pre($userid);
            $nick = $this->input->post('nick');
            $vip = $this->input->post('vip');

            if ($userid != '') {
                $input['where']['user_id'] = $userid;
                $user_id_check_logs = $userid;
            }
            if ($nick != '') {
                $input['where']['user_name'] = $nick;
                $user_id_check_logs = $this->Player_model->get_list(array('where' => array('user_name' => $nick)), 'user_id', $server_name);
//                pre($user_id_check_logs);

                if (!empty($user_id_check_logs)) {


                    $user_id_check_logs = $user_id_check_logs[0]->user_id;
                } else {
                    $user_id_check_logs = '';
                }
            }
            if ($vip != '') {
                $input['where']['vip'] = $vip;
            }
//            $input['where']['ban'] = $ban;
//            $employee = $this->employee_model->get_list($input);
//            $this->data['res'] = $employee;
//            $this->data['ban'] = $ban;
//            $this->session->set_userdata('employee', $employee);
//            pre($employee);
//        }
//        pre($input);
            $lstplayer = $this->Player_model->get_list($input, '', $server_name);
//        pre($data);

//        $data_2 = new stdClass();

            foreach ($lstplayer as $key => $value) {
                if (isset($lst_user_[$value->user_id])) {
                    $lstplayer_[$value->user_id]['userid'] = $value->user_id;
                    $lstplayer_[$value->user_id]['nick'] = $value->user_name;
                    $lstplayer_[$value->user_id]['display_name'] = $value->display_name;
                    $lstplayer_[$value->user_id]['vip'] = $value->vip;
                    $lstplayer_[$value->user_id]['level'] = $value->level;
                    $lstplayer_[$value->user_id]['exp'] = $value->exp;
                    $lstplayer_[$value->user_id]['gold'] = $value->gold;
                    $lstplayer_[$value->user_id]['logouttime'] = $value->logout_time;
                    $lstplayer_[$value->user_id]['created_at'] = $lst_user_[$value->user_id]['created_at'];
                    $lstplayer_[$value->user_id]['platform'] = $lst_user_[$value->user_id]['provider_id'];
                }
            }
//        pre($lstplayer_);my


            $message = $this->session->flashdata('message');
            $this->data['message'] = $message;


//        pre($user_id_check_logs);
//        pre($this->_template_f);

        }
        $this->data['server_cf'] = $server_cf;
        $this->data['lstdata'] = $lstplayer_;
        $this->data['user_id_check_logs'] = $user_id_check_logs;
        $this->data['temp'] = $this->_template_f . 'tktaikhoan/view_index';
        $this->load->view('admin/layout', $this->data);
    }

    function ajax_logs()
    {
        $resources = trim($this->input->post('resources', true));
        $userid = trim($this->input->post('userid', true));
        $type = trim($this->input->post('type', true));

        switch ($type) {
            case "gold":
//                $lstdata = $this->Session_logs_model->get_list(array('where' => array('user_id' => $userid)));
//                $this->data['lstdata'] = $lstdata;
//            pre($t);

                $this->load->view($this->_template_f . 'tktaikhoan/view_gold', $this->data);
                break;

            case "silver": //bạc
                $this->load->view($this->_template_f . 'tktaikhoan/view_silver', $this->data);
                break; //paddy

            case "paddy": //lúa
                $this->load->view($this->_template_f . 'tktaikhoan/view_paddy', $this->data);
                break; //paddy

//            case "vatpham":
//                $lstdata = $this->Session_logs_model->get_list(array('where' => array('user_id' => $userid)));
//                $this->data['lstdata'] = $lstdata;
//            pre($t);

//                $this->load->view($this->_template_f . 'tktaikhoan/view_vatpham', $this->data);
//                break;
            case "binhchung":

                $this->data['binh_chung_type'] = $this->binh_chung_type;
                $this->load->view($this->_template_f . 'tktaikhoan/view_binhchung', $this->data);
                break;

            //gem
            case "gem": //gem
                $this->load->view($this->_template_f . 'tktaikhoan/view_gem', $this->data);
                break; //gem

            case "horse":
                $this->load->view($this->_template_f . 'tktaikhoan/view_horse', $this->data);
                break;

            case "book":
                $this->load->view($this->_template_f . 'tktaikhoan/view_book', $this->data);
                break;

            case "quan_gioi":
                $this->load->view($this->_template_f . 'tktaikhoan/view_quan_gioi', $this->data);
                break;

            default:
//                echo "Your favorite color is neither red, blue, nor green!";
        }
    }

    function ajax_gold()
    {
        $server_cf = $this->_func_lst_server();
        $server_name = $server_cf[$this->input->post('server')]['main'];
        $userid = trim($this->input->post('userid', true));
        $type = trim($this->input->post('type', true));
        $txtFrom = date("Y-m-d", strtotime(trim($this->input->post('txtFrom', true))));;
        $txtto = date("Y-m-d", strtotime(trim($this->input->post('txtTo', true))));;

//        $_player_arr = $this->player_get_all($server);
//        pre($_player_arr);

//        echo $txtFrom;
//        echo $txtto;
//        echo $type;
        $input = '';
        if ($type == 2) {
            $input = "and date(time) between '" . $txtFrom . "' and '" . $txtto . "' ";
        }

        $lst_data = $this->Tbl_gold_logs_model->get_list_all($input, $userid);

        $lst_player_by_server = $this->player_get_all_by_server($server_name);
//        pre($lst_player_by_server);

        $lst_data_arr = [];

        foreach ($lst_data as $k => $value) {
            $lst_data_arr[$value->id]['id'] = $value->id;
            $lst_data_arr[$value->id]['user_id'] = $value->user_id;
            $lst_data_arr[$value->id]['nick'] = isset($lst_player_by_server[$value->user_id]) ? $lst_player_by_server[$value->user_id]['nick'] : 'dcm';
            $lst_data_arr[$value->id]['info_id'] = $value->info_id;
            $lst_data_arr[$value->id]['old_quantity'] = $value->old_quantity;
            $lst_data_arr[$value->id]['new_quantity'] = $value->new_quantity;
            $lst_data_arr[$value->id]['update_quantity'] = $value->update_quantity;
            $lst_data_arr[$value->id]['description'] = $value->description;
            $lst_data_arr[$value->id]['time'] = $value->time;
        }

        $this->data['lstdata'] = $lst_data_arr;

        $this->load->view($this->_template_f . 'tktaikhoan/view_gold_table', $this->data);

    }

    function ajax_silver()
    {
        $server_cf = $this->_func_lst_server();
//        pre($server_cf);
//        die();
        $server_name = $server_cf[$this->input->post('server')]['main'];
        $userid = trim($this->input->post('userid', true));
        $resources = trim($this->input->post('resources', true));
        $type = trim($this->input->post('type', true));
        $txtFrom = date("Y-m-d", strtotime(trim($this->input->post('txtFrom', true))));;
        $txtto = date("Y-m-d", strtotime(trim($this->input->post('txtTo', true))));;
//        $txtto = trim($this->input->post('txtTo', true));
//        echo $txtFrom;
//        echo $txtto;

        $input = '';
        if ($type == 2) {
            $input = "and date(time) between '" . $txtFrom . "' and '" . $txtto . "' ";
        }

//        $this->data['lstdata'] = $this->Session_logs_model->get_list_all($input, $userid);
        $lst_data = $this->Tbl_silver_logs_model->get_list_all($input, $userid);
        $lst_player_by_server = $this->player_get_all_by_server($server_name);

        $lst_data_arr = [];

        foreach ($lst_data as $k => $value) {
            $lst_data_arr[$value->id]['id'] = $value->id;
            $lst_data_arr[$value->id]['user_id'] = $value->user_id;
            $lst_data_arr[$value->id]['nick'] = isset($lst_player_by_server[$value->user_id]) ? $lst_player_by_server[$value->user_id]['nick'] : 'dcm';
            $lst_data_arr[$value->id]['info_id'] = $value->info_id;
            $lst_data_arr[$value->id]['old_quantity'] = $value->old_quantity;
            $lst_data_arr[$value->id]['new_quantity'] = $value->new_quantity;
            $lst_data_arr[$value->id]['update_quantity'] = $value->update_quantity;
            $lst_data_arr[$value->id]['description'] = $value->description;
            $lst_data_arr[$value->id]['time'] = $value->time;
        }

        $this->data['lstdata'] = $lst_data_arr;
        $this->data['resources'] = $resources;
        $this->load->view($this->_template_f . 'tktaikhoan/view_silver_table', $this->data);

    }

//ajax_paddy

    function ajax_paddy()
    {
        $server_cf = $this->_func_lst_server();
        $server_name = $server_cf[$this->input->post('server')]['main'];
        $userid = trim($this->input->post('userid', true));
        $type = trim($this->input->post('type', true));
        $txtFrom = date("Y-m-d", strtotime(trim($this->input->post('txtFrom', true))));;
        $txtto = date("Y-m-d", strtotime(trim($this->input->post('txtTo', true))));;
//        $txtto = trim($this->input->post('txtTo', true));
//        echo $txtFrom;
//        echo $txtto;

        $input = '';
        if ($type == 2) {
            $input = "and date(time) between '" . $txtFrom . "' and '" . $txtto . "' ";
        }

        $lst_data = $this->Tbl_paddy_logs_model->get_list_all($input, $userid);
        $lst_player_by_server = $this->player_get_all_by_server($server_name);

        $lst_data_arr = [];

        foreach ($lst_data as $k => $value) {
            $lst_data_arr[$value->id]['id'] = $value->id;
            $lst_data_arr[$value->id]['user_id'] = $value->user_id;
            $lst_data_arr[$value->id]['nick'] = isset($lst_player_by_server[$value->user_id]) ? $lst_player_by_server[$value->user_id]['nick'] : 'dcm';
            $lst_data_arr[$value->id]['info_id'] = $value->info_id;
            $lst_data_arr[$value->id]['old_quantity'] = $value->old_quantity;
            $lst_data_arr[$value->id]['new_quantity'] = $value->new_quantity;
            $lst_data_arr[$value->id]['update_quantity'] = $value->update_quantity;
            $lst_data_arr[$value->id]['description'] = $value->description;
            $lst_data_arr[$value->id]['time'] = $value->time;
        }

        $this->data['lstdata'] = $lst_data_arr;
        $this->load->view($this->_template_f . 'tktaikhoan/view_paddy_table', $this->data);

    }

    function ajax_binhchung()
    {
        $server_cf = $this->_func_lst_server();
        $server_name = $server_cf[$this->input->post('server')]['main'];

        $userid = trim($this->input->post('userid', true));
        $binh_chung_type_post = trim($this->input->post('binh_chung_type', true));

//        echo $txtFrom;
//        echo $txtto;
//        echo $type;
        $input = array();
        $input['where'] = array('user_id' => $userid);
//        if ($type == 2) {
//            $input = "where date(logouttime) between '" . $txtFrom . "' and '" . $txtto . "' ";
//        }
//        get list get_list_all_binhchung_info
        $lst_binh_chung_info = $this->Binh_chung_info_model->get_list_all_binhchung_info($server_name);
//        pre($lst_binh_chung_info);
//        get list get_list_all_binhchung_info


        $lstdata = $this->Binhchung_data_model->get_list(array('where' => array('user_id' => $userid)), '', $server_name);
//                $this->data['lstdata'] = $lstdata;
//                pre($lstdata);
        //check data is not null

        $lst_data_end = array();
        $lst_data_end_2 = array();
        if (!empty($lstdata)) {


            foreach (explode(';', $lstdata[0]->data) as $key => $value) {
                $lst_data_end[] = json_decode($value, true);

            }
//            pre($lst_data_end);
            $lst_data_end_2 = array();
            foreach ($lst_data_end as $k => $v) {
                $lst_data_end_2[$k]['infoId'] = $v['infoId'];
                $lst_data_end_2[$k]['binh_chung_info_id'] = isset($lst_binh_chung_info[$v['infoId']]) ? $lst_binh_chung_info[$v['infoId']]['id'] : '';
                $lst_data_end_2[$k]['binh_chung_info_country_id'] = isset($lst_binh_chung_info[$v['infoId']]) ? $lst_binh_chung_info[$v['infoId']]['country_id'] : '';
                $lst_data_end_2[$k]['binh_chung_info_binh_chung_type'] = isset($lst_binh_chung_info[$v['infoId']]) ? $lst_binh_chung_info[$v['infoId']]['binh_chung_type'] : '';
                $lst_data_end_2[$k]['binh_chung_info_binh_level'] = isset($lst_binh_chung_info[$v['infoId']]) ? $lst_binh_chung_info[$v['infoId']]['level'] : '';
                $lst_data_end_2[$k]['binh_chung_name'] = isset($this->binh_chung_type [$lst_binh_chung_info[$v['infoId']]['binh_chung_type']]) ? $this->binh_chung_type [$lst_binh_chung_info[$v['infoId']]['binh_chung_type']]['type'] : '';

                $lst_data_end_2[$k]['listTrangBi'] = $v['listTrangBi'];
                $lst_data_end_2[$k]['id'] = $v['id'];
                $lst_data_end_2[$k]['userId'] = $v['userId'];
                $lst_data_end_2[$k]['totalExp'] = $v['totalExp'];
                $lst_data_end_2[$k]['quanVoId'] = $v['quanVoId'];
            }
//        pre($lst_data_end_2);
        }

        $this->data['lstdata'] = $lst_data_end_2;
        $this->data['binh_chung_type_post'] = $binh_chung_type_post;

        $this->load->view($this->_template_f . 'tktaikhoan/view_binhchung_table', $this->data);

    }


    function ajax_gem()
    {
        $server_cf = $this->_func_lst_server();
        $server_name = $server_cf[$this->input->post('server')]['main'];
        $userid = trim($this->input->post('userid', true));
        $type = trim($this->input->post('type', true));
        $txtFrom = date("Y-m-d", strtotime(trim($this->input->post('txtFrom', true))));;
        $txtto = date("Y-m-d", strtotime(trim($this->input->post('txtTo', true))));;
//        $txtto = trim($this->input->post('txtTo', true));
//        echo $txtFrom;
//        echo $txtto;

        $input = '';
        if ($type == 2) {
            $input = "and date(time) between '" . $txtFrom . "' and '" . $txtto . "' ";
        }

        $lst_data = $this->Tbl_gem_logs_model->get_list_all($input, $userid);
        $lst_player_by_server = $this->player_get_all_by_server($server_name);

        $lst_data_arr = [];

        foreach ($lst_data as $k => $value) {
            $lst_data_arr[$value->id]['id'] = $value->id;
            $lst_data_arr[$value->id]['user_id'] = $value->user_id;
            $lst_data_arr[$value->id]['nick'] = isset($lst_player_by_server[$value->user_id]) ? $lst_player_by_server[$value->user_id]['nick'] : 'dcm';
            $lst_data_arr[$value->id]['info_id'] = $value->info_id;
            $lst_data_arr[$value->id]['old_quantity'] = $value->old_quantity;
            $lst_data_arr[$value->id]['new_quantity'] = $value->new_quantity;
            $lst_data_arr[$value->id]['update_quantity'] = $value->update_quantity;
            $lst_data_arr[$value->id]['description'] = $value->description;
            $lst_data_arr[$value->id]['time'] = $value->time;
        }

        $this->data['lstdata'] = $lst_data_arr;
        $this->load->view($this->_template_f . 'tktaikhoan/view_gem_table', $this->data);

    }

    ////////////////////
    function ajax_horse()
    {
        $server_cf = $this->_func_lst_server();
        $server_name = $server_cf[$this->input->post('server')]['main'];
        $userid = trim($this->input->post('userid', true));
        $type = trim($this->input->post('type', true));
        $txtFrom = date("Y-m-d", strtotime(trim($this->input->post('txtFrom', true))));;
        $txtto = date("Y-m-d", strtotime(trim($this->input->post('txtTo', true))));;
//        $txtto = trim($this->input->post('txtTo', true));
//        echo $txtFrom;
//        echo $txtto;

        $input = '';
        if ($type == 2) {
            $input = "and date(time) between '" . $txtFrom . "' and '" . $txtto . "' ";
        }

        $lst_data = $this->Tbl_horse_logs_model->get_list_all($input, $userid);
        $lst_player_by_server = $this->player_get_all_by_server($server_name);

        $lst_data_arr = [];

        foreach ($lst_data as $k => $value) {
            $lst_data_arr[$value->id]['id'] = $value->id;
            $lst_data_arr[$value->id]['user_id'] = $value->user_id;
            $lst_data_arr[$value->id]['nick'] = isset($lst_player_by_server[$value->user_id]) ? $lst_player_by_server[$value->user_id]['nick'] : 'dcm';
            $lst_data_arr[$value->id]['info_id'] = $value->info_id;
            $lst_data_arr[$value->id]['old_quantity'] = $value->old_quantity;
            $lst_data_arr[$value->id]['new_quantity'] = $value->new_quantity;
            $lst_data_arr[$value->id]['update_quantity'] = $value->update_quantity;
            $lst_data_arr[$value->id]['description'] = $value->description;
            $lst_data_arr[$value->id]['time'] = $value->time;
        }

        $this->data['lstdata'] = $lst_data_arr;
        $this->load->view($this->_template_f . 'tktaikhoan/view_horse_table', $this->data);

    }

    function ajax_book()
    {
        $server_cf = $this->_func_lst_server();
        $server_name = $server_cf[$this->input->post('server')]['main'];
        $userid = trim($this->input->post('userid', true));
        $type = trim($this->input->post('type', true));
        $txtFrom = date("Y-m-d", strtotime(trim($this->input->post('txtFrom', true))));;
        $txtto = date("Y-m-d", strtotime(trim($this->input->post('txtTo', true))));;
//        $txtto = trim($this->input->post('txtTo', true));
//        echo $txtFrom;
//        echo $txtto;

        $input = '';
        if ($type == 2) {
            $input = "and date(time) between '" . $txtFrom . "' and '" . $txtto . "' ";
        }

        $lst_data = $this->Tbl_book_logs_model->get_list_all($input, $userid);
        $lst_player_by_server = $this->player_get_all_by_server($server_name);

        $lst_data_arr = [];

        foreach ($lst_data as $k => $value) {
            $lst_data_arr[$value->id]['id'] = $value->id;
            $lst_data_arr[$value->id]['user_id'] = $value->user_id;
            $lst_data_arr[$value->id]['nick'] = isset($lst_player_by_server[$value->user_id]) ? $lst_player_by_server[$value->user_id]['nick'] : 'dcm';
            $lst_data_arr[$value->id]['info_id'] = $value->info_id;
            $lst_data_arr[$value->id]['old_quantity'] = $value->old_quantity;
            $lst_data_arr[$value->id]['new_quantity'] = $value->new_quantity;
            $lst_data_arr[$value->id]['update_quantity'] = $value->update_quantity;
            $lst_data_arr[$value->id]['description'] = $value->description;
            $lst_data_arr[$value->id]['time'] = $value->time;
        }

        $this->data['lstdata'] = $lst_data_arr;
        $this->load->view($this->_template_f . 'tktaikhoan/view_book_table', $this->data);

    }

    function ajax_quan_gioi()
    {
        $server_cf = $this->_func_lst_server();
        $server_name = $server_cf[$this->input->post('server')]['main'];

        $userid = trim($this->input->post('userid', true));
        $type = trim($this->input->post('type', true));
        $txtFrom = date("Y-m-d", strtotime(trim($this->input->post('txtFrom', true))));;
        $txtto = date("Y-m-d", strtotime(trim($this->input->post('txtTo', true))));;
//        $txtto = trim($this->input->post('txtTo', true));
//        echo $txtFrom;
//        echo $txtto;

        $input = '';
        if ($type == 2) {
            $input = "and date(time) between '" . $txtFrom . "' and '" . $txtto . "' ";
        }

        $lst_data = $this->Tbl_quan_gioi_logs_model->get_list_all($input, $userid);
        $lst_player_by_server = $this->player_get_all_by_server($server_name);

        $lst_data_arr = [];

        foreach ($lst_data as $k => $value) {
            $lst_data_arr[$value->id]['id'] = $value->id;
            $lst_data_arr[$value->id]['user_id'] = $value->user_id;
            $lst_data_arr[$value->id]['nick'] = isset($lst_player_by_server[$value->user_id]) ? $lst_player_by_server[$value->user_id]['nick'] : 'dcm';
            $lst_data_arr[$value->id]['info_id'] = $value->info_id;
            $lst_data_arr[$value->id]['old_quantity'] = $value->old_quantity;
            $lst_data_arr[$value->id]['new_quantity'] = $value->new_quantity;
            $lst_data_arr[$value->id]['update_quantity'] = $value->update_quantity;
            $lst_data_arr[$value->id]['description'] = $value->description;
            $lst_data_arr[$value->id]['time'] = $value->time;
        }

        $this->data['lstdata'] = $lst_data_arr;
        $this->load->view($this->_template_f . 'tktaikhoan/view_quan_gioi_table', $this->data);

    }

}