<?php

Class Dashboard extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('admin_model');
        $this->load->model('Player_model');
        $this->load->model('Events_model');
        $this->load->model('Gopy_model');
    }

    function index()
    {
//        die('aaaaaa');
        $message = $this->session->flashdata('message');
        $this->data['message'] = $message;
        $this->data['temp'] = 'admin/dashboard';
        $this->load->view('admin/layout', $this->data);
    }

    function lst_player()
    {


    }
}