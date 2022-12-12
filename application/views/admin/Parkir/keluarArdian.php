<div class="container-fluid">

    <!-- Page Heading -->
    <div class="card">
        <div class="card-header">
            <center>
                <p class="text-success font-weight-bold">Parkir Keluar</p>
            </center>
        </div>
        <div class="card-body">
            <div class="login-form">
                <h2 class="text-center">Masukkan Nomor Polisi</h2>
                <?= form_open('ParkirArdian/ardianParkirKeluar'); ?>
                <div class="form-group">
                    <label for="jenis_kendaraan">Jenis Kendaraan</label>
                    <select class="form-control" name="jenis_kendaraan" id="jenis_kendaraan">
                        <option value="Mobil">Mobil</option>
                        <option value="Motor">Motor</option>
                    </select></div>
                <div class="form-group">
                    <label for="nomor_polisi">No Polisi</label>
                    <input type="text" name="nomor_polisi" class="form-control" id="nomor_polisi">
                    <small class="form-text text-danger"><?= form_error('nomor_polisi'); ?></small></div>
                <?php
                $ardian_time = time();
                $ardian_sekarang = now();
                $ardian_tanggal_jam_masuk = unix_to_human($ardian_sekarang, TRUE, 'eu');
                echo form_hidden('tanggal_jam_masuk', $ardian_tanggal_jam_masuk);
                ?>
                <div class="col text-center">
                    <button type="submit" name="tambah" class="btn btn-success">Cari</button></div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>