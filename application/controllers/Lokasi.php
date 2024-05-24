<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Lokasi extends CI_Controller
{

    private $data = [];
    public function __construct()
    {
        parent::__construct();
        $this->data = [
            'title' => 'Data Lokasi'
        ];
    }

    public function index()
    {
        $this->data['pages'] = 'pages_admin/lokasi/view';
        $this->load->view('_partials/admin', $this->data);
    }

    function show()
    {
        $this->db->where('hapus', 0);
        $dataKaryawan = $this->db->get('lokasi')->result_array();
        $this->output->set_content_type('application/json')->set_output(json_encode($dataKaryawan));
    }

    function save($id = null)
    {
        $response = [
            'status' => "Error",
            'message' => $id ? 'Data Was No Updated' : 'Data Was No Stored'
        ];
        $dataPost = $this->input->post();
        if ($id) {
            $this->db->where('id', $id);
            $stored = $this->db->update('lokasi', $dataPost);
        } else {
            $stored = $this->db->insert('lokasi', $dataPost);
        }

        if ($stored) {
            $response = [
                'status' => "OK",
                'message' => $id ? 'Data Was Updated' : 'Data Was Stored'
            ];
        }
        $this->output->set_content_type('application/json')->set_output(json_encode($response));
    }

    function delete($id)
    {
        $this->db->where('id', $id);
        $this->db->update('lokasi', ['hapus' => 1]);

        $response = [
            'status' => "OK",
            'message' => 'Data Has Deleted'
        ];
        $this->output->set_content_type('application/json')->set_output(json_encode($response));
    }
}

/* End of file Lokasi.php and path \application\controllers\Lokasi.php */
