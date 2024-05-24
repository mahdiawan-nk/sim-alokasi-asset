<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pengguna extends CI_Controller
{

    private $data = [];
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Admin_model', 'Madmin');

        $this->data = [
            'title' => 'Data Karyawan'
        ];
    }

    public function index()
    {
        $this->data['pages'] = 'pages_admin/pengguna/view';
        $this->load->view('_partials/admin', $this->data);
    }

    function show()
    {

        $dataadmin = $this->Madmin->read()->result_array();
        $this->output->set_content_type('application/json')->set_output(json_encode($dataadmin));
    }

    function save($id = null)
    {
        $response = [
            'status' => "Error",
            'message' => $id ? 'Data Was No Updated' : 'Data Was No Stored'
        ];
        $dataPost = $this->input->post();
        if ($id) {
            if ($dataPost['password'] != '') {
                $dataPost['password'] = md5($this->input->post('password'));
            }else{
                unset($dataPost['password']);
            }
            $stored = $this->Madmin->update($id, $dataPost);
        } else {
            $dataPost['password'] = md5($this->input->post('password'));
            $stored = $this->Madmin->create($dataPost);
        }


        if ($stored) {
            $response = [
                'status' => "OK",
                'message' => $id ? 'Data Was Updated' : 'Data Was Stored'
            ];
        }
        $this->output->set_content_type('application/json')->set_output(json_encode($dataPost));
    }

    function delete($id)
    {
        $res = $this->Madmin->delete($id);

        $response = [
            'status' => "OK",
            'message' => 'Data Has Deleted' . $id
        ];
        $this->output->set_content_type('application/json')->set_output(json_encode($response));
    }
}

/* End of file Pengguna.php and path \application\controllers\Pengguna.php */
