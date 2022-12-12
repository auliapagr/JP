<?php

class ParkirArdian_model extends CI_Model
{
    public function parkirMasuk()
    {
        $ardian_tambah['jenis_kendaraan'] = $this->input->post('jenis_kendaraan');
        $ardian_nomor_polisi = $this->input->post('nomor_polisi');
        $ardian_no_polisi_tanpa_spasi = str_replace(' ', '', $ardian_nomor_polisi);
        $ardian_tambah['nomor_polisi'] = strtoupper($ardian_no_polisi_tanpa_spasi);
        $ardian_tambah['tanggal_jam_masuk'] = $this->input->post('tanggal_jam_masuk');

        $this->db->insert('kendaraan', $ardian_tambah);
    }

    public function parkirMasukAlert()
    {
        $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert"> 
        Data <strong>Parkir</strong> berhasil ditambahkan.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        </div>');
    }

    public function ardianKendaraanCari($ardian_nomor_polisi)
    {
        $ardian_no_polisi_tanpa_spasi = str_replace(' ', '', $ardian_nomor_polisi);
        $ardian_nomor_polisi_kapital = strtoupper($ardian_no_polisi_tanpa_spasi);

        $this->db->where('biaya', 0); #cari kendaraan yang belum bayar
        $this->db->where('nomor_polisi', $ardian_nomor_polisi_kapital);
        $this->db->from('kendaraan');
        return $this->db->get();
    }

    public function ardianParkirBiaya($ardian_jenis_kendaraan, $ardian_tanggal_jam_masuk, $ardian_tanggal_jam_keluar)
    {
        # ------ mencari selisih jam ------

        $ardian_tanggal_jam_masuk2 = strtotime($ardian_tanggal_jam_masuk);
        $ardian_tanggal_jam_keluar2 = strtotime($ardian_tanggal_jam_keluar);

        $selisih_waktu_detik = abs($ardian_tanggal_jam_masuk2 - $ardian_tanggal_jam_keluar2);
        $selisih_waktu_jam = $selisih_waktu_detik / 3600;

        # ------ mencari selisih tanggal ------

        $ardian_tanggal_masuk_unix = mysql_to_unix($ardian_tanggal_jam_masuk);
        $ardian_tanggal_keluar_unix = mysql_to_unix($ardian_tanggal_jam_keluar);

        $datestring = '%Y-%m-%d';

        $ardian_tanggal_masuk = mdate($datestring, $ardian_tanggal_masuk_unix);
        $ardian_tanggal_keluar = mdate($datestring, $ardian_tanggal_keluar_unix);

        $differenceFormat = '%a';

        $datetime1 = date_create($ardian_tanggal_masuk);
        $datetime2 = date_create($ardian_tanggal_keluar);

        $interval = date_diff($datetime1, $datetime2);

        $ardian_selisih_tanggal = $interval->format($differenceFormat);

        if ($ardian_jenis_kendaraan == "Mobil") {
            if ($ardian_selisih_tanggal < 1) {
                if ($selisih_waktu_jam <= 2) {
                    $biaya = 3000;
                } elseif ($selisih_waktu_jam > 2 and $selisih_waktu_jam <= 3) {
                    $biaya = 4000;
                } elseif ($selisih_waktu_jam > 3 and $selisih_waktu_jam <= 4) {
                    $biaya = 5000;
                } elseif ($selisih_waktu_jam > 4 and $selisih_waktu_jam <= 5) {
                    $biaya = 6000;
                } elseif ($selisih_waktu_jam > 5 and $selisih_waktu_jam <= 6) {
                    $biaya = 7000;
                } elseif ($selisih_waktu_jam > 6 and $selisih_waktu_jam <= 7) {
                    $biaya = 8000;
                } elseif ($selisih_waktu_jam > 7 and $selisih_waktu_jam <= 8) {
                    $biaya = 9000;
                } elseif ($selisih_waktu_jam >= 9) {
                    $biaya = 10000;
                }
            } elseif ($ardian_selisih_tanggal >= 1) {
                $biaya = $ardian_selisih_tanggal * 10000;
            }
        } else if ($ardian_jenis_kendaraan == "Motor") {
            if ($ardian_selisih_tanggal < 1) {
                if ($selisih_waktu_jam <= 2) {
                    $biaya = 1500;
                } elseif ($selisih_waktu_jam > 2 and $selisih_waktu_jam <= 3) {
                    $biaya = 2000;
                } elseif ($selisih_waktu_jam > 3 and $selisih_waktu_jam <= 4) {
                    $biaya = 2500;
                } elseif ($selisih_waktu_jam > 4 and $selisih_waktu_jam <= 5) {
                    $biaya = 3000;
                } elseif ($selisih_waktu_jam > 5 and $selisih_waktu_jam <= 6) {
                    $biaya = 3500;
                } elseif ($selisih_waktu_jam > 6 and $selisih_waktu_jam <= 7) {
                    $biaya = 4000;
                } elseif ($selisih_waktu_jam > 7 and $selisih_waktu_jam <= 8) {
                    $biaya = 4500;
                } elseif ($selisih_waktu_jam >= 9) {
                    $biaya = 5000;
                }
            } elseif ($ardian_selisih_tanggal >= 1) {
                $biaya = $ardian_selisih_tanggal * 5000;
            }
        }

        return $biaya;
    }

    public function ardianKendaraanKeluar()
    {
        $ardian_id_kendaraan = $this->input->post('id_kendaraan');
        $ardian_update['tanggal_jam_keluar'] = $this->input->post('tanggal_jam_keluar');
        $ardian_update['biaya'] = $this->input->post('biaya');

        $this->db->where('id_kendaraan', $ardian_id_kendaraan);
        return $this->db->update('kendaraan', $ardian_update);
    }
}
