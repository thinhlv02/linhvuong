<?php

Class MY_Controller extends CI_Controller
{
    var $_template_f = '';
    var $_provider_id = '';
    var $_id_login = '';
    var $_uid = '';
    var $_server_cf = '';
    public $data = array();

    function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $new_url = $this->uri->segment(1);
        $this->_template_f = $this->config->item('template_f');
        $this->_provider_id = $this->_session_provider_id();
        $this->_id_login = $this->_session_uid();
        $this->_uid = $this->_session_uname();
        $this->_server_cf = $this->_func_lst_server();


        //pre ($new_url);
        switch ($new_url) {
            case 'admin' :
                {
                    $this->load->model('menu_access_model');
                    $this->_islogin();
                    $a = $this->data['admin'] = $this->session->userdata('admin');
//                pre($a->UserID);
//                pre($admin);
                    if ($this->session->userdata('admin')) {
                        /*lưu session menu_access*/
                        $input = array();
                        $input['where'] = array(
                            'employee_id' => $this->session->userdata('admin')->id
                        );
                        $menu_access = $this->menu_access_model->get_list($input, '', '');
                        $access = array();
                        foreach ($menu_access as $value) {
                            $access[$value->menu_id] = $value->access;
                        }

//                $this->data['menu_access'] = $this->session->userdata('admin');

                        $this->session->set_userdata('menu_access', $access);
//                $access = $this->session->userdata('menu_access');
//                pre($access[1]);

                        /*lưu session menu_access*/
                    }
                    break;
                }

            default:
                {
//                $this->load->model('content_model');
//                $content = $this->content_model->get_info(1);
//                $this->data['content'] = $content;

//                $this->load->model('event_model');
//                $list_event = $this->event_model->get_list();
//                $now = new DateTime();
//                $now = $now->getTimestamp();
//                $count_event = 0;
//                foreach ($list_event as $value) {
//                    if ($now >= $value->time_from && $now <= $value->time_to) {
//                        $count_event++;
//                    }
//                }
//                $this->data['count_event'] = $count_event;

//                $this->load->model('notice_model');
//                $input_notice = array();
//                $input_notice['limit'] = array('4', '0');
//                $notice_right = $this->notice_model->get_list($input_notice);
//                $this->data['notice_right'] = $notice_right;
//                $this->load->model('chart_money_model');
//                $input_tbl_chart_money = array();
//                $input_tbl_chart_money['limit'] = array('4', '0');
//                $input_tbl_chart_money = $this->chart_money_model->get_list($input_tbl_chart_money);
//                $this->data['chart_money_model'] = $input_tbl_chart_money;

//                promotion ở index
//                $this->load->model('promotion_model');
//                $input_promotion = array();
//                $input_promotion['limit'] = array('2', '0');
//                $promotion_footer = $this->promotion_model->get_list($input_promotion);
//                $this->data['promotion_footer'] = $promotion_footer;
                }
        }
    }

    protected function _islogin()
    {
        $controller = $this->uri->rsegment('1');
        $controller = strtolower($controller);

        $login = $this->session->userdata('login');
        //neu ma chua dang nhap,ma truy cap 1 controller khac login
        if (!$login && $controller != 'login') {
            redirect(base_url('admin/login'));
        }
        //neu ma admin da dang nhap thi khong cho phep vao trang login nua.
        if ($login && $controller == 'login') {
            redirect(base_url('admin/tktongquan'));
        }
    }

    protected function _session_provider_id()
    {
        if ($this->session->userdata('admin')) {
            $provider_id = trim($this->session->userdata('admin')->provider_arr);
            $provider_id = is_numeric($provider_id) ? $provider_id : 1;
            return $provider_id;
        }

    }

    protected function _session_uid()
    {
        if ($this->session->userdata('admin')) {
            $_data = trim($this->session->userdata('admin')->id);
            return $_data;
        }
    }

    protected function _session_uname()
    {
        if ($this->session->userdata('admin')) {
            $_uid = trim($this->session->userdata('admin')->UserID);
            return $_uid;
        }
    }

    protected function _func_lst_server()
    {
        return $this->config->config["LST_SERVER"];
    }
}