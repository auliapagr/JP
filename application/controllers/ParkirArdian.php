<?php

class ParkirArdian extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('ParkirArdian_model');
        $this->load->library('pdf');
        $this->load->library('form_validation');
    }

    function ardianParkir()
    {
        $ardian['title'] = 'Parkir Masuk';
        $ardian['user'] = $this->db->get_where('user', ['username' =>
        $this->session->userdata('username')])->row_array();

        $this->load->view('templates/headerArdian', $ardian);
        $this->load->view('templates/sidebarArdian', $ardian);
        $this->load->view('templates/topbarArdian', $ardian);
        $this->load->view('admin/parkir/masukArdian', $ardian);
        $this->load->view('templates/footerArdian');
    }

    public function ardianParkirMasuk()
    {
        $ardian['title'] = 'Parkir Masuk';
        $ardian['user'] = $this->db->get_where('user', ['username' =>
        $this->session->userdata('username')])->row_array();
        $this->form_validation->set_rules('nomor_polisi', 'No Polisi', 'required', ['required' => 'Nomor Polisi Wajib diisi']);

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/headerArdian', $ardian);
            $this->load->view('templates/sidebarArdian', $ardian);
            $this->load->view('templates/topbarArdian', $ardian);
            $this->load->view('admin/parkir/masukArdian', $ardian);
            $this->load->view('templates/footerArdian');
        } else {
            $this->ParkirArdian_model->parkirMasuk();
            $this->ParkirArdian_model->parkirMasukAlert();
            redirect('ParkirArdian/ardianParkir');
        }
    }

    public function ardianParkirKeluar()
    {
        $ardian['title'] = 'Parkir Keluar';
        $ardian['user'] = $this->db->get_where('user', ['username' =>
        $this->session->userdata('username')])->row_array();
        $this->form_validation->set_rules('nomor_polisi', 'No Polisi', 'required', ['required' => 'Nomor Polisi Wajib diisi']);

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/headerArdian', $ardian);
            $this->load->view('templates/sidebarArdian', $ardian);
            $this->load->view('templates/topbarArdian', $ardian);
            $this->load->view('admin/parkir/keluarArdian', $ardian);
            $this->load->view('templates/footerArdian');
        } else {
            $ardian_nomor_polisi = $this->input->post('nomor_polisi');
            $ardian_no_polisi_tanpa_spasi = str_replace(' ', '', $ardian_nomor_polisi);
            $query = $this->ParkirArdian_model->ardianKendaraanCari($ardian_no_polisi_tanpa_spasi);
            $data_kendaran = $query->num_rows();

            if ($data_kendaran > 0) {
                $ardian['title'] = "Parkir Keluar";
                $ardian['ardian_no_polisi_tanpa_spasi'] = $ardian_no_polisi_tanpa_spasi;
                $this->load->view('templates/headerArdian', $ardian);
                $this->load->view('templates/sidebarArdian', $ardian);
                $this->load->view('templates/topbarArdian', $ardian);
                $this->load->view('admin/parkir/bayarArdian', $ardian);
                $this->load->view('templates/footerArdian');
            }
        }
    }

    public function ardianParkirKeluarProses()
    {
        $ardian['title'] = 'Parkir Keluar';
        $ardian['user'] = $this->db->get_where('user', ['username' =>
        $this->session->userdata('username')])->row_array();
        $this->ParkirArdian_model->ardianKendaraanKeluar();
        $ardian['title'] = "Proses Kendaraan Keluar";
        $this->load->view('templates/headerArdian', $ardian);
        $this->load->view('templates/sidebarArdian', $ardian);
        $this->load->view('templates/topbarArdian', $ardian);
        $this->load->view('admin/parkir/bayarsuksesardian', $ardian);
        $this->load->view('templates/footerArdian');
    }
}
