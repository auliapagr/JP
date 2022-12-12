<?php
defined('BASEPATH') or exit('No direct script access allowed');

require('./assets/vendor/autoload.php');

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

require('./application/third_party/fpdf/fpdf.php');

class LaporanArdian extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('LaporanArdian_model');
        $this->load->library('pdf');
    }

    public function tanggalArdian()
    {
        $ardian['title'] = 'Laporan';
        $ardian['user'] = $this->db->get_where('user', ['username' =>
        $this->session->userdata('username')])->row_array();

        $this->load->view('templates/headerArdian', $ardian);
        $this->load->view('templates/sidebarArdian', $ardian);
        $this->load->view('templates/topbarArdian', $ardian);
        $this->load->view('admin/laporan/tanggalArdian', $ardian);
        $this->load->view('templates/footerArdian');
    }

    public function tabelArdian()
    {
        $ardian['title'] = 'Laporan';
        $ardian['user'] = $this->db->get_where('user', ['username' =>
        $this->session->userdata('username')])->row_array();
        $ardian_query = $this->LaporanArdian_model->tabelArdianLaporan();
        $data_kendaran = $ardian_query->num_rows();

        $ardian['data_laporan'] = $ardian_query->result();

        if ($data_kendaran > 0) {
            $ardian['title'] = "Laporan Pakir";
            $this->load->view('templates/headerArdian', $ardian);
            $this->load->view('templates/sidebarArdian', $ardian);
            $this->load->view('templates/topbarArdian', $ardian);
            $this->load->view('admin/laporan/tabelArdian', $ardian);
            $this->load->view('templates/footerArdian');
        }
    }

    function parkirPdf()
    {
        $ardianPdf = $this->LaporanArdian_model->ardianPdfData();
        $pdf = new FPDF('l', 'mm', 'A5');
        // membuat halaman baru
        $pdf->AddPage();
        // setting jenis font yang akan digunakan
        $pdf->SetFont('Arial', 'B', 16);
        // mencetak string 
        $pdf->Cell(190, 7, 'UNIVERSITAS MERCU BUANA', 0, 1, 'C');
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(190, 7, 'LAPORAN DAATA PARKIR', 0, 1, 'C');
        // Memberikan space kebawah agar tidak terlalu rapat
        $pdf->Cell(10, 7, '', 0, 1);
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(8, 6, 'NO', 1, 0);
        $pdf->Cell(37, 6, 'JENIS KENDARAAN', 1, 0);
        $pdf->Cell(35, 6, 'NOMOR POLISI', 1, 0);
        $pdf->Cell(37, 6, 'WAKTU MASUK', 1, 0);
        $pdf->Cell(37, 6, 'WAKTU KELUAR', 1, 0);
        $pdf->Cell(35, 6, 'BIAYA', 1, 1);
        $pdf->SetFont('Arial', '', 10);
        $no = 1;
        foreach ($ardianPdf as $row) {
            $pdf->Cell(8, 6, $no++, 1, 0);
            $pdf->Cell(37, 6, $row->jenis_kendaraan, 1, 0);
            $pdf->Cell(35, 6, $row->nomor_polisi, 1, 0);
            $pdf->Cell(37, 6, $row->tanggal_jam_masuk, 1, 0);
            $pdf->Cell(37, 6, $row->tanggal_jam_keluar, 1, 0);
            $pdf->Cell(35, 6, $row->biaya, 1, 1);
        }
        $pdf->Output();
    }

    public function parkirExcel()
    {
        $ardianExcel = $this->LaporanArdian_model->ardianExcelData();
        $spreadsheet = new Spreadsheet();
        $spreadsheet->getProperties()->setCreator('JANPANIK')
            ->setLastModifiedBy('JANPANIK')
            ->setTitle('Office 2007 XLSX Test Document')
            ->setSubject('Office 2007 XLSX Test Document')
            ->setDescription('Test document for Office 2007 XLSX, generated using PHP classes.')
            ->setKeywords('office 2007 openxml php')
            ->setCategory('Test result file');

        $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('D1', 'LAPORAN PARKIR JANPANIK')
            ->setCellValue('A3', 'No')
            ->setCellValue('B3', 'ID Kendaraan')
            ->setCellValue('C3', 'Jenis Kendaraan')
            ->setCellValue('D3', 'Nomor Polisi')
            ->setCellValue('E3', 'Waktu Masuk')
            ->setCellValue('F3', 'Waktu keluar')
            ->setCellValue('G3', 'Biaya');

        $i = 4;
        $no = 1;
        foreach ($ardianExcel as $row) {

            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('A' . $i, $no++)
                ->setCellValue('B' . $i, $row->id_kendaraan)
                ->setCellValue('C' . $i, $row->jenis_kendaraan)
                ->setCellValue('D' . $i, $row->nomor_polisi)
                ->setCellValue('E' . $i, $row->tanggal_jam_masuk)
                ->setCellValue('F' . $i, $row->tanggal_jam_keluar)
                ->setCellValue('G' . $i, $row->biaya);
            $i++;
        }

        $spreadsheet->getActiveSheet()->setTitle('Report Excel ' . date('d-m-Y H'));

        $spreadsheet->setActiveSheetIndex(0);

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="Laporan Parkir JANPANIK.xlsx"');
        header('Cache-Control: max-age=0');
        header('Cache-Control: max-age=1');
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
        header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT');
        header('Cache-Control: cache, must-revalidate');
        header('Pragma: public');

        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        $writer->save('php://output');
        exit;
    }

    public function parkirChart()
    {
        $ardian['title'] = 'Laporan Chart';
        $ardian['user'] = $this->db->get_where('user', ['username' =>
        $this->session->userdata('username')])->row_array();
        $data = $this->LaporanArdian_model->ardianChartData()->result();
        $ardian['data'] = json_encode($data);

        $this->load->view('templates/headerArdian', $ardian);
        $this->load->view('templates/sidebarArdian', $ardian);
        $this->load->view('templates/topbarArdian', $ardian);
        $this->load->view('admin/laporan/chartArdian', $ardian);
        $this->load->view('templates/footerArdian');
    }

    public function hapusLaporan()
    {
        $where = ['id_kendaraan' => $this->uri->segment(3)];
        $this->LaporanArdian_model->hapusLaporan($where);
        redirect('LaporanArdian/tabelArdian');
    }
}
