<div class="container">
    <div class="card shadow">
        <h6 class="card-header font-weight-bold text-success">Laporan Chart Parkir</h6>
        <div class="card-body">
            <div class="panel panel-success">
                <link rel="stylesheet" href="<?= base_url('assets/vendor/morris/morris.css'); ?>">

                <div id="graph"></div>
                <script src="<?= base_url('assets/vendor/jquery/jquery.min.js'); ?>"></script>
                <script src="<?= base_url('assets/vendor/morris/raphael-min.js'); ?>"></script>
                <script src="<?= base_url('assets/vendor/morris/morris.min.js'); ?>"></script>
                <script>
                    Morris.Bar({
                        barGap: 2,
                        barSizeRatio: 0.30,
                        element: 'graph',
                        data: <?= $data; ?>,
                        xkey: 'jenis_kendaraan',
                        ykeys: ['total'],
                        labels: ['Total Kendaraan']
                    });
                </script>
            </div>
        </div>
    </div>
</div>
</div>