<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Karyawan extends CI_Controller
{
    private $data = [];
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Karyawan_model', 'Mkaryawan');
        $this->load->model('Lokasi_model', 'Mlokasi');

        $this->data = [
            'title' => 'Data Karyawan'
        ];
    }

    public function index()
    {
        $this->data['lokasi'] = $this->Mlokasi->read(true, 0, 'hapus')->result();
        $this->data['pages'] = 'pages_admin/karyawan/view';
        $this->load->view('_partials/admin', $this->data);
    }

    function show()
    {

        $dataKaryawan = $this->Mkaryawan->read(true, '0', 'hapus')->result_array();
        foreach ($dataKaryawan as $key => $item) {
            $dataKaryawan[$key]['lokasi'] = $this->Mlokasi->read(true, $item['lokasi_kerja'], 'id')->row()->lokasi;
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
            $stored = $this->Mkaryawan->update($id, $dataPost);
        } else {
            $stored = $this->Mkaryawan->create($dataPost);
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
        $dataPost = ['hapus' => 1];
        $res = $this->Mkaryawan->delete($id, $dataPost);

        $response = [
            'status' => "OK",
            'message' => 'Data Has Deleted' . $res
        ];
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
                for ($row = 4; $row <= $highestRow; $row++) {
                    $nik = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
                    $nama = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
                    $jenis_kelamin = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
                    $lokasi = $worksheet->getCellByColumnAndRow(4, $row)->getValue();
                    $jabatan = $worksheet->getCellByColumnAndRow(5, $row)->getValue();
                    $departement = $worksheet->getCellByColumnAndRow(6, $row)->getValue();

                    $temp_data[] = array(
                        'nik'    => $nik,
                        'nama'    => $nama,
                        'jenis_kelamin'    => $jenis_kelamin,
                        'lokasi_kerja'    => $lokasi,
                        'jabatan'    => $jabatan,
                        'departement'    => $departement,
                        'hapus'    => 0,
                    );
                }
            }


            $insert = $this->Mkaryawan->create($temp_data, true);
            if ($insert) {
                redirect(base_url('karyawan'), 'refresh');
            } else {
                redirect(base_url('karyawan'), 'refresh');
            }
        } else {
            $this->output->set_content_type('application/json')->set_output(json_encode('no file upload'));
        }
    }
}

/* End of file Karyawan.php and path \application\controllers\Karyawan.php */
