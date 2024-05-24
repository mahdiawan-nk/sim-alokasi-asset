<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Komputer extends CI_Controller
{

    private $data = [];
    public function __construct()
    {
        parent::__construct();
        $this->data = [
            'title' => 'Data Komputer/Laptop'
        ];
    }

    public function index()
    {
        $this->data['lokasi'] = $this->db->get_where('lokasi', ['hapus' => 0])->result();
        $this->data['pages'] = 'pages_admin/komputer/view';
        $this->load->view('_partials/admin', $this->data);
    }

    function show()
    {
        $this->db->where('hapus', 0);
        $dataKaryawan = $this->db->get('komputer')->result_array();
        foreach ($dataKaryawan as $key => $item) {
            $dataKaryawan[$key]['lokasi_name'] = $this->db->get_where('lokasi', ['id' => $item['lokasi']])->row()->lokasi;
        }
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
            $stored = $this->db->update('komputer', $dataPost);
        } else {
            $stored = $this->db->insert('komputer', $dataPost);
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
        $this->db->update('komputer', ['hapus' => 1]);

        $response = [
            'status' => "OK",
            'message' => 'Data Has Deleted'
        ];
        $this->output->set_content_type('application/json')->set_output(json_encode($response));
    }

    function transaksi()
    {
        $this->data['lokasi'] = $this->db->get_where('lokasi', ['hapus' => 0])->result();
        $this->data['pages'] = 'pages_admin/komputer/trx_log';
        $this->load->view('_partials/admin', $this->data);
    }

    function show_log()
    {
        if($this->input->get('selected') == 'true'){
            $this->db->where('hapus', 1);
        }else{
            $this->db->where('hapus', 0);
        }

        $dataLog = $this->db->get('komputer')->result_array();

        foreach ($dataLog as $key => $item) {
            $this->db->order_by('id', 'desc');
            $logs = $this->db->get_where('komputer_transaksi', ['id_komputer' => $item['id']]);
            $trx = [];

            foreach ($logs->result() as $log) {
                $trx[] = [
                    'karyawan' => $this->db->get_where('karyawan', ['id' => $log->karyawan_id])->row(),
                    'last_use' => date('D, d M Y H:i', strtotime($log->waktu_pemakaian)),
                    'status' => $log->status,
                    'file_ba' => $log->file_ba
                ];
            }
            $lastUser = $logs->row();
            $dataLog[$key]['lokasi_name'] = $this->db->get_where('lokasi', ['id' => $item['lokasi']])->row()->lokasi;
            $dataLog[$key]['log_user'] = $trx;
            $dataLog[$key]['last_user'] = $lastUser ? $this->db->get_where('karyawan', ['id' => $lastUser->karyawan_id])->row()->nama : null;
        }

        $this->output->set_content_type('application/json')->set_output(json_encode($dataLog));
    }

    public function save_log()
    {

        $dataPost = $this->input->post();
        unset($dataPost['nik']);

        $config['upload_path']          = './file_ba/komputer';
        $config['allowed_types']        = 'pdf';

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('file_ba')) {
            $data =  $this->upload->display_errors();
            $response = [
                'code' => 403,
                'status' => "error",
                'message' => 'Data Not Stored!! ' . $data,
            ];
        } else {
            $data =  $this->upload->data();
            $dataPost['file_ba'] = $data['file_name'];
            $this->db->insert('komputer_transaksi', $dataPost);
            $response = [
                'code' => 200,
                'status' => "OK",
                'message' => 'Data Was Stored',
            ];
        }

        $this->output->set_content_type('application/json')->set_output(json_encode($response));
    }

    function import()
    {
        $this->load->library('excel');
        if (isset($_FILES["file"]["name"])) {
            $path = $_FILES["file"]["tmp_name"];
            $object = PHPExcel_IOFactory::load($path);
            foreach ($object->getWorksheetIterator() as $worksheet) {
                $highestRow = $worksheet->getHighestRow();
                $highestColumn = $worksheet->getHighestColumn();
                for ($row = 2; $row <= $highestRow; $row++) {
                    $type = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
                    $serial_number = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
                    $kode_lokasi = $worksheet->getCellByColumnAndRow(3, $row)->getValue();

                    $temp_data[] = array(
                        'type'    => $type,
                        'serial_number'    => $serial_number,
                        'lokasi'    => $kode_lokasi,
                        'hapus'    => 0,
                    );
                }
            }


            $insert = $this->db->insert_batch('komputer', $temp_data);

            if ($insert) {
                redirect(base_url('komputer'), 'refresh');
            } else {
                redirect(base_url('komputer'), 'refresh');
            }
            
        } else {
            redirect(base_url('komputer'), 'refresh');
        }
    }
}

/* End of file Komputer.php and path \application\controllers\Komputer.php */
