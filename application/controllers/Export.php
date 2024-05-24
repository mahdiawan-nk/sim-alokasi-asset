<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Export extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('Pdf');
    }

    public function karyawanPdf()
    {
        $pdf = new PDF('L', 'mm', array(215, 330));
        $pdf->AddPage();
        $pdf->SetFont('Times', 'B', 12);
        $pdf->Cell(0, 7, 'DATA KARYAWAN', 0, 1, 'C');
        $pdf->ln(2);
        $pdf->SetWidths(array(8, 45, 65, 45, 45, 45, 45));
        $pdf->SetLineHeight(7);
        $pdf->SetAligns(array('C', 'C', 'C', 'C', 'C', 'C', 'C'));
        $pdf->SetFont('Times', 'B', 12);
        $pdf->Cell(8, 7, "NO", 1, 0, 'C');
        $pdf->Cell(45, 7, "NIK/NO.BET", 1, 0, 'C');
        $pdf->Cell(65, 7, "NAMA", 1, 0, 'C');
        $pdf->Cell(45, 7, "JENIS KELAMIN", 1, 0, 'C');
        $pdf->Cell(45, 7, "LOKASI KERJA", 1, 0, 'C');
        $pdf->Cell(45, 7, "JABATAN", 1, 0, 'C');
        $pdf->Cell(45, 7, "DEPARTEMENT", 1, 0, 'C');

        $dataLog = $this->db->get('karyawan')->result();
        $pdf->Ln();
        $pdf->SetFont('Times', '', 12);
        foreach ($dataLog as $key => $item) {
            $pdf->Row(array(
                $key + 1,
                $item->nik,
                $item->nama,
                $item->jenis_kelamin,
                $item->lokasi_kerja,
                $item->jabatan,
                $item->departement,

            ));
        }


        $pdf->Output();
    }

    function karyawanExcel()
    {
        include APPPATH . 'third_party/PHPExcel/PHPExcel.php';
        $excel = new PHPExcel();
        $excel->getProperties()->setCreator('My Notes Code')
            ->setLastModifiedBy('My Notes Code')
            ->setTitle("Data User Komputer")
            ->setSubject("User Komputer")
            ->setDescription("Laporan Semua Data User Komputer")
            ->setKeywords("Data Komputer");

        // Buat sebuah variabel untuk menampung pengaturan style dari header tabel
        $style_col = array(
            'font' => array('bold' => true), // Set font nya jadi bold
            'alignment' => array(
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, // Set text jadi ditengah secara horizontal (center)
                'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
            ),
            'borders' => array(
                'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
                'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  // Set border right dengan garis tipis
                'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis
                'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
            )
        );

        // Buat sebuah variabel untuk menampung pengaturan style dari isi tabel
        $style_row = array(
            'alignment' => array(
                'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
            ),
            'borders' => array(
                'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
                'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  // Set border right dengan garis tipis
                'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis
                'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
            )
        );

        $excel->setActiveSheetIndex(0)->setCellValue('A1', "DATA KARYAWAN"); // Set kolom A1 dengan tulisan "DATA SISWA"
        $excel->getActiveSheet()->mergeCells('A1:F1'); // Set Merge Cell pada kolom A1 sampai E1
        $excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(TRUE); // Set bold kolom A1
        $excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(15); // Set font size 15 untuk kolom A1
        $excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // Set text center untuk kolom A1
        // Buat header tabel nya pada baris ke 3
        $excel->setActiveSheetIndex(0)->setCellValue('A3', "NO"); // Set kolom A3 dengan tulisan "NO"
        $excel->setActiveSheetIndex(0)->setCellValue('B3', "NIK/NO.BET"); // Set kolom B3 dengan tulisan "NIS"
        $excel->setActiveSheetIndex(0)->setCellValue('C3', "NAMA"); // Set kolom C3 dengan tulisan "NAMA"
        $excel->setActiveSheetIndex(0)->setCellValue('D3', "JENIS KELAMIN"); // Set kolom D3 dengan tulisan "JENIS KELAMIN"
        $excel->setActiveSheetIndex(0)->setCellValue('E3', "LOKASI KERJA"); // Set kolom E3 dengan tulisan "ALAMAT"
        $excel->setActiveSheetIndex(0)->setCellValue('F3', "JABATAN"); // Set kolom E3 dengan tulisan "ALAMAT"
        $excel->setActiveSheetIndex(0)->setCellValue('G3', "DEPARTEMENT"); // Set kolom E3 dengan tulisan "ALAMAT"
        // Apply style header yang telah kita buat tadi ke masing-masing kolom header
        $excel->getActiveSheet()->getStyle('A3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('B3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('C3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('D3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('E3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('F3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('G3')->applyFromArray($style_col);
        // Panggil function view yang ada di SiswaModel untuk menampilkan semua data siswanya
        $dataLog = $this->db->get('karyawan')->result();
        $no = 1; // Untuk penomoran tabel, di awal set dengan 1
        $numrow = 4; // Set baris pertama untuk isi tabel adalah baris ke 4
        foreach ($dataLog as $data) { // Lakukan looping pada variabel siswa
                $lokasi = $this->db->get_where('lokasi', ['id' => $data->lokasi_kerja])->row()->lokasi;
                $excel->setActiveSheetIndex(0)->setCellValue('A' . $numrow, $no);
                $excel->setActiveSheetIndex(0)->setCellValue('B' . $numrow, $data->nik);
                $excel->setActiveSheetIndex(0)->setCellValue('C' . $numrow, $data->nama);
                $excel->setActiveSheetIndex(0)->setCellValue('D' . $numrow, $data->jenis_kelamin);
                $excel->setActiveSheetIndex(0)->setCellValue('E' . $numrow, $lokasi);
                $excel->setActiveSheetIndex(0)->setCellValue('F' . $numrow, $data->jabatan);
                $excel->setActiveSheetIndex(0)->setCellValue('G' . $numrow, $data->departement);

                // Apply style row yang telah kita buat tadi ke masing-masing baris (isi tabel)
                $excel->getActiveSheet()->getStyle('A' . $numrow)->applyFromArray($style_row);
                $excel->getActiveSheet()->getStyle('B' . $numrow)->applyFromArray($style_row);
                $excel->getActiveSheet()->getStyle('C' . $numrow)->applyFromArray($style_row);
                $excel->getActiveSheet()->getStyle('D' . $numrow)->applyFromArray($style_row);
                $excel->getActiveSheet()->getStyle('E' . $numrow)->applyFromArray($style_row);
                $excel->getActiveSheet()->getStyle('F' . $numrow)->applyFromArray($style_row);
                $excel->getActiveSheet()->getStyle('g' . $numrow)->applyFromArray($style_row);

                $no++; // Tambah 1 setiap kali looping
                $numrow++; // Tambah 1 setiap kali looping
        }
        // Set width kolom
        $excel->getActiveSheet()->getColumnDimension('A')->setWidth(5); // Set width kolom A
        $excel->getActiveSheet()->getColumnDimension('B')->setWidth(15); // Set width kolom B
        $excel->getActiveSheet()->getColumnDimension('C')->setWidth(25); // Set width kolom C
        $excel->getActiveSheet()->getColumnDimension('D')->setWidth(20); // Set width kolom D
        $excel->getActiveSheet()->getColumnDimension('E')->setWidth(15); // Set width kolom E
        $excel->getActiveSheet()->getColumnDimension('F')->setWidth(15); // Set width kolom E
        $excel->getActiveSheet()->getColumnDimension('G')->setWidth(15); // Set width kolom E

        // Set height semua kolom menjadi auto (mengikuti height isi dari kolommnya, jadi otomatis)
        $excel->getActiveSheet()->getDefaultRowDimension()->setRowHeight(-1);
        // Set orientasi kertas jadi LANDSCAPE
        $excel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
        // Set judul file excel nya
        $excel->getActiveSheet(0)->setTitle("Laporan Data Karyawan");
        $excel->setActiveSheetIndex(0);
        // Proses file excel
        $montNow = date('F Y');
        $FileName = 'LIST UPDATE DATA KARYAWAN' . $montNow . '-' . time() . '.xlsx';
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="' . $FileName . '"'); // Set nama file excel nya
        header('Cache-Control: max-age=0');
        $write = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
        $write->save('php://output');
    }

    function toExcelKomputer()
    {
        include APPPATH . 'third_party/PHPExcel/PHPExcel.php';
        $excel = new PHPExcel();
        $excel->getProperties()->setCreator('My Notes Code')
            ->setLastModifiedBy('My Notes Code')
            ->setTitle("Data User Komputer")
            ->setSubject("User Komputer")
            ->setDescription("Laporan Semua Data User Komputer")
            ->setKeywords("Data Komputer");

        // Buat sebuah variabel untuk menampung pengaturan style dari header tabel
        $style_col = array(
            'font' => array('bold' => true), // Set font nya jadi bold
            'alignment' => array(
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, // Set text jadi ditengah secara horizontal (center)
                'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
            ),
            'borders' => array(
                'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
                'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  // Set border right dengan garis tipis
                'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis
                'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
            )
        );

        // Buat sebuah variabel untuk menampung pengaturan style dari isi tabel
        $style_row = array(
            'alignment' => array(
                'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
            ),
            'borders' => array(
                'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
                'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  // Set border right dengan garis tipis
                'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis
                'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
            )
        );

        $excel->setActiveSheetIndex(0)->setCellValue('A1', "DATA ASSET LAPTOP/PC USER"); // Set kolom A1 dengan tulisan "DATA SISWA"
        $excel->getActiveSheet()->mergeCells('A1:F1'); // Set Merge Cell pada kolom A1 sampai E1
        $excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(TRUE); // Set bold kolom A1
        $excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(15); // Set font size 15 untuk kolom A1
        $excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // Set text center untuk kolom A1
        // Buat header tabel nya pada baris ke 3
        $excel->setActiveSheetIndex(0)->setCellValue('A3', "NO"); // Set kolom A3 dengan tulisan "NO"
        $excel->setActiveSheetIndex(0)->setCellValue('B3', "SN"); // Set kolom B3 dengan tulisan "NIS"
        $excel->setActiveSheetIndex(0)->setCellValue('C3', "User"); // Set kolom C3 dengan tulisan "NAMA"
        $excel->setActiveSheetIndex(0)->setCellValue('D3', "Departement"); // Set kolom D3 dengan tulisan "JENIS KELAMIN"
        $excel->setActiveSheetIndex(0)->setCellValue('E3', "Lokasi"); // Set kolom E3 dengan tulisan "ALAMAT"
        $excel->setActiveSheetIndex(0)->setCellValue('F3', "Status"); // Set kolom E3 dengan tulisan "ALAMAT"
        // Apply style header yang telah kita buat tadi ke masing-masing kolom header
        $excel->getActiveSheet()->getStyle('A3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('B3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('C3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('D3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('E3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('F3')->applyFromArray($style_col);
        // Panggil function view yang ada di SiswaModel untuk menampilkan semua data siswanya
        $dataLog = $this->db->get('komputer')->result();
        $no = 1; // Untuk penomoran tabel, di awal set dengan 1
        $numrow = 4; // Set baris pertama untuk isi tabel adalah baris ke 4
        foreach ($dataLog as $data) { // Lakukan looping pada variabel siswa
            $this->db->order_by('id', 'desc');
            $logs = $this->db->get_where('komputer_transaksi', ['id_komputer' => $data->id]);
            $lastUser = $logs->row();
            if ($logs->num_rows() > 0) {
                $userData = $this->db->get_where('karyawan', ['id' => $lastUser->karyawan_id])->row();
                $user = $userData->nama;
                $departement = $userData->departement;
                $lokasi = $this->db->get_where('lokasi', ['id' => $data->lokasi])->row()->lokasi;
                $status = $lastUser->status;
                $excel->setActiveSheetIndex(0)->setCellValue('A' . $numrow, $no);
                $excel->setActiveSheetIndex(0)->setCellValue('B' . $numrow, $data->serial_number);
                $excel->setActiveSheetIndex(0)->setCellValue('C' . $numrow, $user);
                $excel->setActiveSheetIndex(0)->setCellValue('D' . $numrow, $departement);
                $excel->setActiveSheetIndex(0)->setCellValue('E' . $numrow, $lokasi);
                $excel->setActiveSheetIndex(0)->setCellValue('F' . $numrow, $status);

                // Apply style row yang telah kita buat tadi ke masing-masing baris (isi tabel)
                $excel->getActiveSheet()->getStyle('A' . $numrow)->applyFromArray($style_row);
                $excel->getActiveSheet()->getStyle('B' . $numrow)->applyFromArray($style_row);
                $excel->getActiveSheet()->getStyle('C' . $numrow)->applyFromArray($style_row);
                $excel->getActiveSheet()->getStyle('D' . $numrow)->applyFromArray($style_row);
                $excel->getActiveSheet()->getStyle('E' . $numrow)->applyFromArray($style_row);
                $excel->getActiveSheet()->getStyle('F' . $numrow)->applyFromArray($style_row);

                $no++; // Tambah 1 setiap kali looping
                $numrow++; // Tambah 1 setiap kali looping
            }
        }
        // Set width kolom
        $excel->getActiveSheet()->getColumnDimension('A')->setWidth(5); // Set width kolom A
        $excel->getActiveSheet()->getColumnDimension('B')->setWidth(15); // Set width kolom B
        $excel->getActiveSheet()->getColumnDimension('C')->setWidth(25); // Set width kolom C
        $excel->getActiveSheet()->getColumnDimension('D')->setWidth(20); // Set width kolom D
        $excel->getActiveSheet()->getColumnDimension('E')->setWidth(15); // Set width kolom E
        $excel->getActiveSheet()->getColumnDimension('F')->setWidth(15); // Set width kolom E

        // Set height semua kolom menjadi auto (mengikuti height isi dari kolommnya, jadi otomatis)
        $excel->getActiveSheet()->getDefaultRowDimension()->setRowHeight(-1);
        // Set orientasi kertas jadi LANDSCAPE
        $excel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
        // Set judul file excel nya
        $excel->getActiveSheet(0)->setTitle("Laporan Data Siswa");
        $excel->setActiveSheetIndex(0);
        // Proses file excel
        $montNow = date('F Y');
        $FileName = 'LIST PC DAN LAPTOP STAFF UPDATE ' . $montNow . '-' . time() . '.xlsx';
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="' . $FileName . '"'); // Set nama file excel nya
        header('Cache-Control: max-age=0');
        $write = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
        $write->save('php://output');
    }

    function toExcelRadio()
    {
        include APPPATH . 'third_party/PHPExcel/PHPExcel.php';
        $excel = new PHPExcel();
        $excel->getProperties()->setCreator('My Notes Code')
            ->setLastModifiedBy('My Notes Code')
            ->setTitle("Data User Radio")
            ->setSubject("User Radio")
            ->setDescription("Laporan Semua Data User Radio")
            ->setKeywords("Data Radio");

        // Buat sebuah variabel untuk menampung pengaturan style dari header tabel
        $style_col = array(
            'font' => array('bold' => true, 'color' => array('rgb' => 'FFFFFF')), // Set font nya jadi bold
            'alignment' => array(
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, // Set text jadi ditengah secara horizontal (center)
                'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
            ),
            'borders' => array(
                'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
                'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  // Set border right dengan garis tipis
                'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis
                'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
            ),
            'fill' => array(
                'type' => PHPExcel_Style_Fill::FILL_SOLID,
                'color' => array('rgb' => '0a8a39')
            )
        );

        // Buat sebuah variabel untuk menampung pengaturan style dari isi tabel
        $style_row = array(
            'alignment' => array(
                'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
            ),
            'borders' => array(
                'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
                'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  // Set border right dengan garis tipis
                'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis
                'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
            )
        );

        $excel->setActiveSheetIndex(0)->setCellValue('A1', "STATUS DAN AVAILABILITY RADIO"); // Set kolom A1 dengan tulisan "DATA SISWA"
        $excel->getActiveSheet()->mergeCells('A1:L1'); // Set Merge Cell pada kolom A1 sampai E1
        $excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(TRUE); // Set bold kolom A1
        $excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(15); // Set font size 15 untuk kolom A1
        $excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // Set text center untuk kolom A1
        // Buat header tabel nya pada baris ke 3
        $excel->setActiveSheetIndex(0)->setCellValue('A3', "NO"); // Set kolom A3 dengan tulisan "NO"
        $excel->setActiveSheetIndex(0)->setCellValue('B3', "Registrasi Perangkat"); // Set kolom B3 dengan tulisan "NIS"
        $excel->setActiveSheetIndex(0)->setCellValue('C3', "Brand Name"); // Set kolom C3 dengan tulisan "NAMA"
        $excel->setActiveSheetIndex(0)->setCellValue('D3', "ID"); // Set kolom D3 dengan tulisan "JENIS KELAMIN"
        $excel->setActiveSheetIndex(0)->setCellValue('E3', "Tipe/Model Radio"); // Set kolom E3 dengan tulisan "ALAMAT"
        $excel->setActiveSheetIndex(0)->setCellValue('F3', "Dept"); // Set kolom E3 dengan tulisan "ALAMAT"
        $excel->setActiveSheetIndex(0)->setCellValue('G3', "User"); // Set kolom E3 dengan tulisan "ALAMAT"
        $excel->setActiveSheetIndex(0)->setCellValue('H3', "TM/TL"); // Set kolom E3 dengan tulisan "ALAMAT"
        $excel->setActiveSheetIndex(0)->setCellValue('I3', "Detail Lokasi"); // Set kolom E3 dengan tulisan "ALAMAT"
        $excel->setActiveSheetIndex(0)->setCellValue('J3', "Radio"); // Set kolom E3 dengan tulisan "ALAMAT"
        $excel->setActiveSheetIndex(0)->setCellValue('K3', "Lokasi"); // Set kolom E3 dengan tulisan "ALAMAT"
        $excel->setActiveSheetIndex(0)->setCellValue('L3', "Status"); // Set kolom E3 dengan tulisan "ALAMAT"
        // Apply style header yang telah kita buat tadi ke masing-masing kolom header
        $excel->getActiveSheet()->getStyle('A3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('B3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('C3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('D3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('E3')->getAlignment()->setWrapText(true);
        $excel->getActiveSheet()->getStyle('E3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('F3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('G3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('H3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('I3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('J3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('K3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('L3')->applyFromArray($style_col);
        // Panggil function view yang ada di SiswaModel untuk menampilkan semua data siswanya
        $dataLog = $this->db->get('radio')->result();
        $no = 1; // Untuk penomoran tabel, di awal set dengan 1
        $numrow = 4; // Set baris pertama untuk isi tabel adalah baris ke 4
        foreach ($dataLog as $data) { // Lakukan looping pada variabel siswa
            $this->db->order_by('id', 'desc');
            $logs = $this->db->get_where('radio_transaksi', ['id_radio' => $data->id]);
            $lastUser = $logs->row();
            if ($logs->num_rows() > 0) {
                $userData = $this->db->get_where('karyawan', ['id' => $lastUser->karyawan_id])->row();
                $user = $userData->nama;
                $jabatan = $userData->jabatan;
                $departement = $userData->departement;
                $lokasi = $this->db->get_where('lokasi', ['id' => $data->lokasi])->row()->lokasi;
                $status = $lastUser->status;
                $excel->setActiveSheetIndex(0)->setCellValue('A' . $numrow, $no);
                $excel->setActiveSheetIndex(0)->setCellValue('B' . $numrow, $data->reg_perangkat);
                $excel->setActiveSheetIndex(0)->setCellValue('C' . $numrow, $data->brand_nama);
                $excel->setActiveSheetIndex(0)->setCellValue('D' . $numrow, $data->kode_id);
                $excel->setActiveSheetIndex(0)->setCellValue('E' . $numrow, $data->model_radio);
                $excel->setActiveSheetIndex(0)->setCellValue('F' . $numrow, $departement);
                $excel->setActiveSheetIndex(0)->setCellValue('G' . $numrow, $user);
                $excel->setActiveSheetIndex(0)->setCellValue('H' . $numrow, $jabatan);
                $excel->setActiveSheetIndex(0)->setCellValue('I' . $numrow, $data->detail_lokasi);
                $excel->setActiveSheetIndex(0)->setCellValue('J' . $numrow, $data->type_radio);
                $excel->setActiveSheetIndex(0)->setCellValue('K' . $numrow, $lokasi);
                $excel->setActiveSheetIndex(0)->setCellValue('L' . $numrow, $status);

                // Apply style row yang telah kita buat tadi ke masing-masing baris (isi tabel)
                $excel->getActiveSheet()->getStyle('A' . $numrow)->applyFromArray($style_row);
                $excel->getActiveSheet()->getStyle('B' . $numrow)->applyFromArray($style_row);
                $excel->getActiveSheet()->getStyle('C' . $numrow)->applyFromArray($style_row);
                $excel->getActiveSheet()->getStyle('D' . $numrow)->applyFromArray($style_row);
                $excel->getActiveSheet()->getStyle('E' . $numrow)->applyFromArray($style_row);
                $excel->getActiveSheet()->getStyle('F' . $numrow)->applyFromArray($style_row);
                $excel->getActiveSheet()->getStyle('G' . $numrow)->applyFromArray($style_row);
                $excel->getActiveSheet()->getStyle('H' . $numrow)->applyFromArray($style_row);
                $excel->getActiveSheet()->getStyle('I' . $numrow)->applyFromArray($style_row);
                $excel->getActiveSheet()->getStyle('J' . $numrow)->applyFromArray($style_row);
                $excel->getActiveSheet()->getStyle('K' . $numrow)->applyFromArray($style_row);
                $excel->getActiveSheet()->getStyle('L' . $numrow)->applyFromArray($style_row);

                $no++; // Tambah 1 setiap kali looping
                $numrow++; // Tambah 1 setiap kali looping
            }
        }
        // Set width kolom
        $excel->getActiveSheet()->getColumnDimension('A')->setWidth(5); // Set width kolom A
        $excel->getActiveSheet()->getColumnDimension('B')->setWidth(25); // Set width kolom B
        $excel->getActiveSheet()->getColumnDimension('C')->setWidth(15); // Set width kolom C
        $excel->getActiveSheet()->getColumnDimension('D')->setWidth(10); // Set width kolom D
        $excel->getActiveSheet()->getColumnDimension('E')->setWidth(15); // Set width kolom E
        $excel->getActiveSheet()->getColumnDimension('F')->setWidth(20); // Set width kolom E
        $excel->getActiveSheet()->getColumnDimension('G')->setWidth(20); // Set width kolom E
        $excel->getActiveSheet()->getColumnDimension('H')->setWidth(15); // Set width kolom E
        $excel->getActiveSheet()->getColumnDimension('I')->setWidth(15); // Set width kolom E
        $excel->getActiveSheet()->getColumnDimension('J')->setWidth(15); // Set width kolom E
        $excel->getActiveSheet()->getColumnDimension('K')->setWidth(15); // Set width kolom E
        $excel->getActiveSheet()->getColumnDimension('L')->setWidth(15); // Set width kolom E

        // Set height semua kolom menjadi auto (mengikuti height isi dari kolommnya, jadi otomatis)
        $excel->getActiveSheet()->getDefaultRowDimension()->setRowHeight(-1);
        // Set orientasi kertas jadi LANDSCAPE
        $excel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
        // Set judul file excel nya
        $excel->getActiveSheet(0)->setTitle("Laporan Data Siswa");
        $excel->setActiveSheetIndex(0);
        // Proses file excel
        $montNow = date('F Y');
        $FileName = 'LIST RADIO KOMUNIKASI UPDATE' . $montNow . '-' . time() . '.xlsx';
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="' . $FileName . '"'); // Set nama file excel nya
        header('Cache-Control: max-age=0');
        $write = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
        $write->save('php://output');
    }

    function toExcelPhone()
    {
        include APPPATH . 'third_party/PHPExcel/PHPExcel.php';
        $excel = new PHPExcel();
        $excel->getProperties()->setCreator('My Notes Code')
            ->setLastModifiedBy('My Notes Code')
            ->setTitle("Data User Komputer")
            ->setSubject("User Komputer")
            ->setDescription("Laporan Semua Data User Komputer")
            ->setKeywords("Data Komputer");

        // Buat sebuah variabel untuk menampung pengaturan style dari header tabel
        $style_col = array(
            'font' => array('bold' => true, 'color' => array('rgb' => 'FFFFFF')), // Set font nya jadi bold
            'alignment' => array(
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, // Set text jadi ditengah secara horizontal (center)
                'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
            ),
            'borders' => array(
                'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
                'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  // Set border right dengan garis tipis
                'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis
                'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
            ),
            'fill' => array(
                'type' => PHPExcel_Style_Fill::FILL_SOLID,
                'color' => array('rgb' => '0a8a39')
            )
        );

        // Buat sebuah variabel untuk menampung pengaturan style dari isi tabel
        $style_row = array(
            'alignment' => array(
                'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
            ),
            'borders' => array(
                'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
                'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  // Set border right dengan garis tipis
                'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis
                'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
            )
        );

        $excel->setActiveSheetIndex(0)->setCellValue('A1', "DATA ASSET TELEPHONY USER"); // Set kolom A1 dengan tulisan "DATA SISWA"
        $excel->getActiveSheet()->mergeCells('A1:F1'); // Set Merge Cell pada kolom A1 sampai E1
        $excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(TRUE); // Set bold kolom A1
        $excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(11); // Set font size 15 untuk kolom A1
        $excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // Set text center untuk kolom A1
        // Buat header tabel nya pada baris ke 3
        // Buat header tabel nya pada baris ke 3
        $type = ['TYPE 1', 'TYPE 2'];
        $rowIndex = 4; // Index baris untuk data

        foreach ($type as $index => $item) {
            // Set baris awal untuk setiap tipe
            $startRow = $rowIndex;

            // Set header untuk tipe
            $excel->setActiveSheetIndex(0)->setCellValue('A' . $startRow, "HANDSET " . $item); // Set kolom A1 dengan tulisan "DATA SISWA"
            $excel->getActiveSheet()->mergeCells('A' . $startRow . ':D' . $startRow); // Set Merge Cell pada kolom A1 sampai E1
            $excel->getActiveSheet()->getStyle('A' . $startRow)->getFont()->setBold(TRUE); // Set bold kolom A1
            $excel->getActiveSheet()->getStyle('A' . $startRow)->getFont()->setSize(11); // Set font size 15 untuk kolom A1

            // Set header untuk kolom pada tipe
            $excel->setActiveSheetIndex(0)->setCellValue('A' . ($startRow + 1), "NO"); // Set kolom A3 dengan tulisan "NO"
            $excel->setActiveSheetIndex(0)->setCellValue('B' . ($startRow + 1), "LOKAIS/USER"); // Set kolom B3 dengan tulisan "NIS"
            $excel->setActiveSheetIndex(0)->setCellValue('C' . ($startRow + 1), "EXT"); // Set kolom C3 dengan tulisan "NAMA"
            $excel->setActiveSheetIndex(0)->setCellValue('D' . ($startRow + 1), "LOKASI"); // Set kolom E3 dengan tulisan "ALAMAT"

            // Apply style header yang telah kita buat tadi ke masing-masing kolom header
            $excel->getActiveSheet()->getStyle('A' . ($startRow + 1))->applyFromArray($style_col);
            $excel->getActiveSheet()->getStyle('B' . ($startRow + 1))->applyFromArray($style_col);
            $excel->getActiveSheet()->getStyle('C' . ($startRow + 1))->applyFromArray($style_col);
            $excel->getActiveSheet()->getStyle('D' . ($startRow + 1))->applyFromArray($style_col);

            $this->db->where('type', $item);
            $dataLog = $this->db->get('phone')->result();
            $numrow = $startRow + 2; // Set baris pertama untuk isi tabel adalah baris ke 4
            $no = 1; // Untuk penomoran tabel, di awal set dengan 1
            foreach ($dataLog as $data) { // Lakukan looping pada variabel siswa
                $this->db->order_by('id', 'desc');
                $logs = $this->db->get_where('phone_transaksi', ['id_phone' => $data->id]);
                $lastUser = $logs->row();
                if ($logs->num_rows() > 0 && $item == $data->type) {
                    $userData = $this->db->get_where('karyawan', ['id' => $lastUser->karyawan_id])->row();
                    $user = $userData->nama;
                    $departement = $userData->departement;
                    $lokasi = $this->db->get_where('lokasi', ['id' => $data->lokasi])->row()->lokasi;
                    $status = $lastUser->status;
                    $excel->setActiveSheetIndex(0)->setCellValue('A' . $numrow, $no);
                    $excel->setActiveSheetIndex(0)->setCellValue('B' . $numrow, $user . ' / ' . $userData->jabatan);
                    $excel->setActiveSheetIndex(0)->setCellValue('C' . $numrow, $data->ext);
                    $excel->setActiveSheetIndex(0)->setCellValue('D' . $numrow, $lokasi);

                    // Apply style row yang telah kita buat tadi ke masing-masing baris (isi tabel)
                    $excel->getActiveSheet()->getStyle('A' . $numrow)->applyFromArray($style_row);
                    $excel->getActiveSheet()->getStyle('B' . $numrow)->applyFromArray($style_row);
                    $excel->getActiveSheet()->getStyle('C' . $numrow)->applyFromArray($style_row);
                    $excel->getActiveSheet()->getStyle('D' . $numrow)->applyFromArray($style_row);

                    $no++; // Tambah 1 setiap kali looping
                    $numrow++; // Tambah 1 setiap kali looping
                }
            }

            // Set width kolom
            $excel->getActiveSheet()->getColumnDimension('A')->setWidth(5); // Set width kolom A
            $excel->getActiveSheet()->getColumnDimension('B')->setWidth(35); // Set width kolom B
            $excel->getActiveSheet()->getColumnDimension('C')->setWidth(15); // Set width kolom C
            $excel->getActiveSheet()->getColumnDimension('D')->setWidth(15); // Set width kolom D

            // Increment row index untuk selanjutnya
            $rowIndex = $numrow + 2;
        }





        // Set height semua kolom menjadi auto (mengikuti height isi dari kolommnya, jadi otomatis)
        $excel->getActiveSheet()->getDefaultRowDimension()->setRowHeight(-1);
        // Set orientasi kertas jadi LANDSCAPE
        $excel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
        // Set judul file excel nya
        $excel->getActiveSheet(0)->setTitle("Default");
        $excel->setActiveSheetIndex(0);
        // Proses file excel
        $montNow = date('F Y');
        $FileName = 'LIST IP TELEPHONY UPDATE-' . $montNow . '-' . time() . '.xlsx';
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="' . $FileName . '"'); // Set nama file excel nya
        header('Cache-Control: max-age=0');
        $write = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
        $write->save('php://output');
    }
}

/* End of file Export.php and path \application\controllers\Export.php */
