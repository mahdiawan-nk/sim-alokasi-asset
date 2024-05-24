<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Radio extends CI_Controller
{

    private $data = [];
    public function __construct()
    {
        parent::__construct();
        $this->data = [
            'title' => 'Data Radio'
        ];
    }

    public function index()
    {
        $this->data['lokasi'] = $this->db->get_where('lokasi', ['hapus' => 0])->result();
        $this->data['pages'] = 'pages_admin/radio/view';
        $this->load->view('_partials/admin', $this->data);
    }

    function show()
    {
        
        $dataKaryawan = $this->db->get('radio')->result_array();
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
            $stored = $this->db->update('radio', $dataPost);
        } else {
            $stored = $this->db->insert('radio', $dataPost);
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
        $this->db->update('radio', ['hapus' => 1]);

        $response = [
            'status' => "OK",
            'message' => 'Data Has Deleted'
        ];
        $this->output->set_content_type('application/json')->set_output(json_encode($response));
    }

    function transaksi()
    {
        $this->data['lokasi'] = $this->db->get_where('lokasi', ['hapus' => 0])->result();
        $this->data['pages'] = 'pages_admin/radio/trx_log';
        $this->load->view('_partials/admin', $this->data);
    }

    function show_log()
    {
        if($this->input->get('selected') == 'true'){
            $this->db->where('hapus', 1);
        }else{
            $this->db->where('hapus', 0);
        }
        $dataLog = $this->db->get('radio')->result_array();

        foreach ($dataLog as $key => $item) {
            $this->db->order_by('id', 'desc');
            $logs = $this->db->get_where('radio_transaksi', ['id_radio' => $item['id']]);
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

        $config['upload_path']          = './file_ba/radio/';
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
            $this->db->insert('radio_transaksi', $dataPost);
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
                    $kode_id = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
                    $reg_perangkat = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
                    $brand_nama = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
                    $model_radio = $worksheet->getCellByColumnAndRow(4, $row)->getValue();
                    $type_radio = $worksheet->getCellByColumnAndRow(5, $row)->getValue();
                    $lokasi = $worksheet->getCellByColumnAndRow(6, $row)->getValue();
                    $detail_lokasi = $worksheet->getCellByColumnAndRow(7, $row)->getValue();

                    $temp_data[] = array(
                        'kode_id'    => $kode_id,
                        'reg_perangkat'    => $reg_perangkat,
                        'brand_name'    => $brand_nama,
                        'model_radio'    => $model_radio,
                        'type_radio'    => $type_radio,
                        'lokasi'    => $lokasi,
                        'detail_lokasi'    => $detail_lokasi,
                        'hapus'    => 0,
                    );
                }
            }


            $insert = $this->db->insert_batch('radio', $temp_data);

            if ($insert) {
                redirect(base_url('radio'), 'refresh');
            } else {
                redirect(base_url('radio'), 'refresh');
            }

        } else {
            redirect(base_url('radio'), 'refresh');
        }
    }
}

/* End of file Radio.php and path \application\controllers\Radio.php */
