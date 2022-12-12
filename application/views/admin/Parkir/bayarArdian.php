<div class="container">
    <div class="login-form1">
        <h1 class="text-center mb-3">Proses Kendaraan Keluar</h1>
        <h3 class="text-center">
            <?php
            echo strtoupper($ardian_no_polisi_tanpa_spasi);
            ?>
        </h3>
        <?php
        $ardian_query = $this->ParkirArdian_model->ardianKendaraanCari($ardian_no_polisi_tanpa_spasi);

        foreach ($ardian_query->result() as $row) {
            $ardian_jenis_kendaraan = $row->jenis_kendaraan;
            $ardian_tanggal_jam_masuk = $row->tanggal_jam_masuk;
            $ardian_id_kendaraan = $row->id_kendaraan;
        }
        ?>
        <h2 class="text-center"><b>Jenis Kendaraan: </b></h2>
        <h3 class="text-center">
            <?php
            if ($ardian_jenis_kendaraan == "Mobil") {
                echo "Mobil";
            } elseif ($ardian_jenis_kendaraan == "Motor") {
                echo "Motor";
            }
            ?></h3>
        <h2 class="text-center"><b>Tanggal Masuk: </b></h2>
        <h3 class="text-center"><?php echo $ardian_tanggal_jam_masuk; ?></h3>
        <h2 class="text-center"><b>Tanggal Keluar: </b></h2>
        <h3 class="text-center"><?php
                                $datestring = '%Y-%m-%d %h:%i:00';
                                $ardian_time = time();
                                $ardian_sekarang = now();
                                $ardian_tanggal_jam_keluar = unix_to_human($ardian_sekarang, TRUE, 'eu');
                                echo $ardian_tanggal_jam_keluar; ?></h3>
        <h2 class="text-center"><b>Biaya:</b></h2>
        <h3 class="text-center">
            <?php echo "Rp. " .
                $ardian_biaya = $this->ParkirArdian_model->ardianParkirBiaya($ardian_jenis_kendaraan, $ardian_tanggal_jam_masuk, $ardian_tanggal_jam_keluar)
                . ",-"; ?>
        </h3>
        <h3>
            <?php
            echo form_open('ParkirArdian/ardianParkirKeluarProses');
            echo form_hidden('id_kendaraan', $ardian_id_kendaraan);
            echo form_hidden('tanggal_jam_keluar', $ardian_tanggal_jam_keluar);
            echo form_hidden('biaya', $ardian_biaya);
            ?>
            <div class="col text-center">
                <button type="submit" name="tambah" class="btn btn-success">Bayar</button></div>
            <?php
            form_close();
            ?>
        </h3>
    </div>
</div>