<?php

Class Admin extends MY_Controller
{
    var $_providers = '';
    var $_menu_access_arr_by_id = '';

    function __construct()
    {
        parent::__construct();
        $this->load->model('admin_model');
        $this->load->model('Menu_model');
        $this->load->model('menu_model');
        $this->load->model('menu_access_model');
        $this->load->model('providers_model');
        $this->_providers = $this->providers_model->get_list(array(), '', '');
//        $this->_menu_access_arr_by_id = $this->menu_access_model->get_list();

//        $employee = $this->employee_model->get_list();
//        $this->data['emp'] = $employee;
    }

    function index()
    {
//        pre($this->_menu_access_arr_by_id);
        $message = $this->session->flashdata('message');
        $this->data['message'] = $message;


        if ($this->input->post('btnAddadmin')) {
            $UserID = $this->input->post('UserID');
            $UserPassword = $this->input->post('UserPassword');
            $itemKeys = $this->input->post('itemKeys');

            $tmp = [];
            if ($itemKeys != null) {

                foreach ($itemKeys as $key => $value) {

                    $tmp[] = $value;

                }
                $list_items = implode(",", $tmp);

                $dataSubmit = array(
                    'UserID' => $UserID,
//                'UserPassword' => 'e10adc3949ba59abbe56e057f20f883e',
                    'UserPassword' => md5($UserPassword),
                    'provider_arr' => $list_items,
                    'time_create' => date("Y-m-d H:i:s"),
                    'creator' => $this->_id_login,
                );
//            pre($dataSubmit);
//            die();
                /* Check tài khoản đã tạo chưa */
                $input = array();
                $input['where'] = array(
                    'UserID' => $UserID
                );
                if (!$this->admin_model->get_list($input, '', '')) {
                    $insert_id = $this->admin_model->create($dataSubmit,'');
                    if ($insert_id >= 0) {
                        /* thêm quyền vào bảng menu_access*/
                        $menu = $this->menu_model->get_list('', '','');
//                pre($menu);

                        foreach ($menu as $key => $value) {
                            $dataSubmit1 = array(
                                'employee_id' => $insert_id,
                                'menu_id' => $value->id,
                                'access' => 0
                            );

//                        pre($dataSubmit);
//                        die();

                            $this->menu_access_model->create($dataSubmit1,'');
                        }
                        /* End thêm quyền vào bảng menu_access*/

                        $this->session->set_flashdata('message', 'Thêm tài khoản login hệ thống thành công!');
                        redirect(base_url('admin/admin'));
                    } else {
                        $this->session->set_flashdata('message', 'Thêm tài khoản login hệ thống thất bại!');
                        redirect(base_url('admin/admin'));
                    }
                } else {
                    $this->session->set_flashdata('message', 'Tài khoản này đã tồn tại, vui lòng kiểm tra lại!');
                    redirect(base_url('admin/admin'));
                }
                /* Check tài khoản đã tạo chưa */

            } else {
                $this->session->set_flashdata('message', 'Hãy chọn mã KD cho tài khoản');
                redirect(base_url('admin/admin'));
            }
        }

//        $admin = $this->admin_model->get_list(array('where' => array('id > ' => '37')));
        $admin = $this->admin_model->get_list('', '','');
        $admin_arr = [];
        $admin_2 = [];
        foreach ($admin as $k2 => $v2) {
            $admin_2[$v2->id]['id'] = $v2->id;
            $admin_2[$v2->id]['UserID'] = $v2->UserID;
        }

//        pre($admin_2);


        foreach ($admin as $k => $v) {
            $admin_arr[$v->id]['id'] = $v->id;
            $admin_arr[$v->id]['UserID'] = $v->UserID;
            $admin_arr[$v->id]['creator'] = isset($admin_2[$v->creator]) ? $admin_2[$v->creator]['UserID'] : 'no name';
            $admin_arr[$v->id]['time_create'] = $v->time_create;
            $admin_arr[$v->id]['employee_id'] = $v->employee_id;
            $admin_arr[$v->id]['provider_arr'] = $v->provider_arr;
        }

//        pre($admin_arr);
//        $admin = $this->admin_model->function_getlist();
        $this->data['res'] = $admin_arr;
        $this->data['providers'] = $this->_providers;
        $this->data['temp'] = 'admin/admin/admin';
        $this->load->view('admin/layout', $this->data);
    }

    function add111111()
    {
        $message = $this->session->flashdata('message');
        $this->data['message'] = $message;
        if ($this->input->post('btnAddadmin')) {
            $UserID = $this->input->post('UserID');
            $UserPassword = $this->input->post('UserPassword');
            $itemKeys = $this->input->post('itemKeys');

            $tmp = [];
            if ($itemKeys != null) {


                foreach ($itemKeys as $key => $value) {
//                    if (isset($itemValues[$key])) {
//                        if ($itemValues[$key] != '') {
                    $tmp[] = $key;
//                        }
//                    }
                }
                $list_items = implode(",", $tmp);

                $dataSubmit = array(
                    'UserID' => $UserID,
//                'UserPassword' => 'e10adc3949ba59abbe56e057f20f883e',
                    'UserPassword' => md5($UserPassword),
                    'provider_arr' => $list_items,
                    'time_create' => date("Y-m-d H:i:s"),
                    'creator' => $this->_id_login,
                );
//            pre($dataSubmit);
//            die();
                /* Check tài khoản đã tạo chưa */
                $input = array();
                $input['where'] = array(
                    'UserID' => $UserID
                );
                if (!$this->admin_model->get_list($input)) {
                    $insert_id = $this->admin_model->create($dataSubmit,'');
                    if ($insert_id >= 0) {
                        /* thêm quyền vào bảng menu_access*/
                        $menu = $this->menu_model->get_list();
//                pre($menu);

                        foreach ($menu as $key => $value) {
                            $dataSubmit1 = array(
                                'employee_id' => $insert_id,
                                'menu_id' => $value->id,
                                'access' => 0
                            );

//                        pre($dataSubmit);
//                        die();

                            $this->menu_access_model->create($dataSubmit1,'');
                        }
                        /* End thêm quyền vào bảng menu_access*/

                        $this->session->set_flashdata('message', 'Thêm tài khoản login hệ thống thành công!');
                        redirect(base_url('admin/admin'));
                    } else {
                        $this->session->set_flashdata('message', 'Thêm tài khoản login hệ thống thất bại!');
                        redirect(base_url('admin/admin'));
                    }
                } else {
                    $this->session->set_flashdata('message', 'Tài khoản này đã tồn tại, vui lòng kiểm tra lại!');
                    redirect(base_url('admin/admin/add'));
                }
                /* Check tài khoản đã tạo chưa */

            }
        }
        $this->data['providers'] = $this->_providers;
        $this->data['temp'] = 'admin/admin/add';
        $this->load->view('admin/layout', $this->data);
    }

    function edit()
    {
        $message = $this->session->flashdata('message');
        $this->data['message'] = $message;

        $user_id = $this->uri->segment(4);
        $user_id = intval($user_id);
        //pre($admin_id);
        $user = $this->admin_model->get_info($user_id,'','');
        if ($user == null) {
            $this->session->set_flashdata('message', 'Không tồn tại thông tin tài khoản!');
            redirect(base_url('admin/admin'));
        } else {
            $this->data['user'] = $user;
        }

        if ($this->input->post('btnUpdateadmin')) {
            $name = $this->input->post('txtName');

            $dataSubmit = array(
                'UserID' => $name
            );
            if ($this->admin_model->update($user_id, $dataSubmit,'')) {
                $this->session->set_flashdata('message', 'Sửa thành công!');
                redirect(base_url('admin/admin'));
            } else {
                $this->session->set_flashdata('message', 'Sửa thất bại!');
                redirect(base_url('admin/admin'));
            }
        }

        $this->data['temp'] = 'admin/admin/edit';
        $this->load->view('admin/layout', $this->data);
    }

    function access()
    {
        $message = $this->session->flashdata('message');
        $this->data['message'] = $message;

//        $menu_access = $this->menu_access_model->get_list();
//        $this->data['menu_access'] = $menu_access;

        $menu_access_id = $this->uri->segment(4);
        $menu_access_id = intval($menu_access_id);
//        pre($menu_access_id);
        $input = array();
        $input['where'] = array(
            'employee_id' => $menu_access_id
        );
        //(ví dụ $input['order'] = array('id','DESC'))

        $input['order'] = array('menu_id', 'ASC');
        $menu_access = $this->menu_access_model->get_list($input, '','');
//        pre($menu_access);
        if ($menu_access == null) {
            $this->session->set_flashdata('message', 'Không tồn tại quyền nv!');
            redirect(base_url('admin/access'));
        } else {
            $this->data['menu_access'] = $menu_access;
        }
        if ($this->input->post('btnUpdateemployee')) {
//            $access1 = $access2 = array();
//            var_dump($access1);
            $access1 = $this->input->post('access1');
            $access2 = $this->input->post('access2');
//            pre($access1);
//            pre($access1);
//            pre($access2);
            $i = 0;
            foreach ($menu_access as $row) {
                if ($access2 && in_array($row->id, $access2)) {
                    $this->menu_access_model->update($row->id, array('access' => 2),'');
                    $i++;
                } else if ($access1 && in_array($row->id, $access1)) {
                    $this->menu_access_model->update($row->id, array('access' => 1),'');
                    $i++;
                } else {
                    $this->menu_access_model->update($row->id, array('access' => 0),'');
                    $i++;
                }
            }
            if (count($i) > 0) {
                $this->session->set_flashdata('message', 'Cập nhật xong!');
                redirect(base_url('admin/admin/access/' . $menu_access_id));
            }
//            if (is_array($access1)) {
//                foreach ($access1 as $value) {
////                    if(in_array($value, $access2)){
////                        $this->employee_model->update($employee_id, array('access'=>2));
////                    }
////                    else{
////                        $this->employee_model->update($employee_id, array('access'=>1));
////                    }
//                }
//            }

//            if ($this->employee_model->update($employee_id, $dataSubmit)) {
//                $this->session->set_flashdata('message', 'Sửa quyền nhân sự thành công!');
//                redirect(base_url('admin/access' / $employee_id));
//            } else {
//                $this->session->set_flashdata('message', 'Sửa quyền nhân sự thất bại!');
//                redirect(base_url('admin/access' / $employee_id));
//            }
        }
        $this->data['menu_access_id'] = $menu_access_id;
        $this->data['temp'] = 'admin/admin/access';
        $this->load->view('admin/layout', $this->data);
    }

    function del()
    {
        $admin_id = $this->uri->segment(4);
        $admin_id = intval($admin_id);
        $admin = $this->admin_model->get_info($admin_id,'','');

        if ($admin == null) {
            $this->session->set_flashdata('message', 'Không tồn tại thông tin tài khoản login hệ thống!');
            redirect(base_url('admin/admin'));
        } else {
            if ($this->admin_model->delete($admin_id,'')) {
                /* nếu xóa tài khoản thì xóa luôn quyền trong menu-access*/
                $input = array();
                $input['where'] = array(
                    'employee_id' => $admin->id
                );
                $menu_access = $this->menu_access_model->get_list($input, '','');
                foreach ($menu_access as $value) {
                    $this->menu_access_model->delete($value->id,'');
                }
                /* End nếu xóa tài khoản thì xóa luôn quyền trong menu-access*/
//                $img = './upload/' . $admin->img;
//                unlink($img);
                //unlink($thumb_img);
                $this->session->set_flashdata('message', 'Xóa tài khoản login hệ thống thành công!');
                redirect(base_url('admin/admin'));
            } else {
                $this->session->set_flashdata('message', 'Thao tác không thành công!');
                redirect(base_url('admin/admin'));
            }
        }
    }

    function menu()
    {
        $lstdata = $this->Menu_model->get_list();

//        $lstdata_arr = [];
//        foreach ($lstdata as $key => $value) {
//            $lstdata_arr[$key]['id'] = $value->id;
//            $lstdata_arr[$key]['info_id'] = $value->info_id;
//            $lstdata_arr[$key]['info_id_name'] = isset($this->lst_gift_item_info_[$value->info_id]) ? $this->lst_gift_item_info_[$value->info_id] : 'null';
//            $lstdata_arr[$key]['type'] = $value->type;
//            $lstdata_arr[$key]['type_name'] = isset($this->lst_gift_type[$value->type]) ? $this->lst_gift_type[$value->type] : 'dcm';
//            $lstdata_arr[$key]['name'] = $value->name;
//            $lstdata_arr[$key]['quantity'] = $value->quantity;
//            $lstdata_arr[$key]['price'] = $value->price;
//            $lstdata_arr[$key]['unit'] = $value->unit;
//            $lstdata_arr[$key]['unit_name'] = isset($this->lst_gift_unit[$value->unit]) ? $this->lst_gift_unit[$value->unit] : 'failed unit name';
//            $lstdata_arr[$key]['time_open'] = $value->time_open;
//            $lstdata_arr[$key]['time_close'] = $value->time_close;
//            $lstdata_arr[$key]['status'] = $value->status;
//        }
//        pre($lstdata_arr);
        $message = $this->session->flashdata('message');
        $this->data['message'] = $message;
        $this->data['lstdata'] = $lstdata;

//        $this->data['lst_gift_type'] = $this->lst_gift_type;
//        $this->data['lst_gift_item_info_'] = $this->lst_gift_item_info_;
        $this->data['temp'] = $this->_template_f . 'admin/menu';
        $this->load->view('admin/layout', $this->data);

    }

    function ajax_menu()
    {
        $menu_name = trim($this->input->post('name'));
//        echo $menu_name;
        $datasubmit = array(
            'name' => $menu_name
        );
        if ($menu_name != '') {
            $id_insert = $this->menu_model->create($datasubmit,'');
            if ($id_insert) {
                //insert menu access
                $employee_arr = $this->menu_access_model->get_em_arr();
                $datasubmit2 = array(
                    'menu_id' => $id_insert,
                );
                foreach ($employee_arr as $value) {
                    $datasubmit2['employee_id'] = $value->employee_id;
                    $this->menu_access_model->create($datasubmit2,'');
                }
//                pre($datasubmit2);
//                die();


                echo 'Tạo thành công';
            } else {
                echo 'Tạo thất bại';
            }
        }
    }

    function del_menu()
    {
        $menu_id = $this->uri->segment(4);
        $menu_id = intval($menu_id);

        if ($this->menu_model->delete($menu_id,'')) {

            $this->menu_access_model->delete_menu_access($menu_id);


            $this->session->set_flashdata('message', 'Xóathành công!');
            redirect(site_url('admin/admin/menu'));
        } else {
            $this->session->set_flashdata('message', 'Thao tác không thành công!');
            redirect(site_url('admin/admin/menu'));
        }
    }

    function edit_menu()
    {
        $message = $this->session->flashdata('message');
        $this->data['message'] = $message;

        $user_id = $this->uri->segment(4);
        $user_id = intval($user_id);
        //pre($admin_id);
        $lstdata = $this->menu_model->get_info($user_id,'','');
//        if ($user == null) {
//            $this->session->set_flashdata('message', 'Không tồn tại thông tin tài khoản!');
//            redirect(base_url('admin/admin'));
//        } else {
//            $this->data['user'] = $user;
//        }

        if ($this->input->post('btnSearch')) {
            $name = $this->input->post('name');

            $dataSubmit = array(
                'name' => $name
            );
            if ($this->menu_model->update($user_id, $dataSubmit,'')) {
                $this->session->set_flashdata('message', 'Sửa thành công!');
                redirect(site_url('admin/admin/menu'));
            } else {
                $this->session->set_flashdata('message', 'Sửa thất bại!');
                redirect(site_url('admin/admin/menu'));
            }
        }
        $this->data['lstdata'] = $lstdata;
        $this->data['temp'] = 'admin/admin/edit_menu';
        $this->load->view('admin/layout', $this->data);
    }
}