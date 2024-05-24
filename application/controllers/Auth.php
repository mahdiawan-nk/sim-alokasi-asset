<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Admin_model', 'Admin');
    }

    public function index()
    {
        $data['pages'] = 'login';
        $this->load->view('_partials/index', $data);
    }

    function checklogin()
    {

        $PostAccount = [
            'identity' => $this->input->post('email_user'),
            'password' => md5($this->input->post('password_user'))
        ];

        $getUserAccount = $this->Admin->SelectAccountUser($PostAccount);
        if ($getUserAccount) {
            $array = array(
                'login' => TRUE,
                'username' => $getUserAccount->username,
                'level'=>$getUserAccount->level
            );

            $this->session->set_userdata($array);
            redirect(base_url('dashboard'), 'refresh');
        } else {
            redirect(base_url(''), 'location');
        }
        
    }

    public function Logout()
    {
        $array = array(
            'username' => null,
            'login' => FALSE,
            'level' => null
        );
        $this->session->unset_userdata($array); //clear session
        $this->session->sess_destroy(); //tutup session
        redirect(base_url(''));
    }
}

/* End of file Auth.php and path \application\controllers\Auth.php */
