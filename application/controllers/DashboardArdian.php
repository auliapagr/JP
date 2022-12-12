<?php
defined('BASEPATH') or exit('No direct script access allowed');

class DashboardArdian extends CI_Controller
{
    public function index()
    {
        $ardian['title'] = 'JANPANIK';
        $ardian['user'] = $this->db->get_where('user', ['username' =>
        $this->session->userdata('username')])->row_array();

        $this->load->view('templates/headerArdian', $ardian);
        $this->load->view('templates/sidebarArdian', $ardian);
        $this->load->view('templates/topbarArdian', $ardian);
        $this->load->view('admin/dashboard/dashboardArdian', $ardian);
        $this->load->view('templates/footerArdian');
    }
}
