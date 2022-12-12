<?php
defined('BASEPATH') or exit('No direct script access allowed');

class LaporanArdian_model extends CI_Model
{
    public function ardianExcelData()
    {
        $this->db->select('*');
        $this->db->from('kendaraan');
        $this->db->order_by('id_kendaraan', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }

    public function ardianPdfData()
    {
        $this->db->select('*');
        $this->db->from('kendaraan');
        $this->db->order_by('id_kendaraan', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }

    public function ardianChartData()
    {
        $query = $this->db->query("SELECT jenis_kendaraan, COUNT( * ) AS total 
        FROM kendaraan n
        GROUP BY jenis_kendaraan");
        return $query;
    }

    public function tabelardianLaporan()
    {
        $tanggal = $this->input->post('tanggal');

        $this->db->like('tanggal_jam_keluar', $tanggal, 'after');
        return $this->db->get('kendaraan');
    }

    public function hapusLaporan($where = null)
    {
        $this->db->delete('kendaraan', $where);
    }
}
