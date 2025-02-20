<?= $this->extend('layouts/main') ?>

<?= $this->section('title') ?>Dashboard Hibah Buku<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="row">
    <div class="col-4">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Total Penghibah</h4>
            </div>
            <div class="card-body">
                <h5><?= $totalPenghibah ?> Penghibah</h5>
            </div>
        </div>
    </div>

    <div class="col-4">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Total Jumlah Judul Buku</h4>
            </div>
            <div class="card-body">
                <h5><?= $totalJudul ?> Judul Buku</h5>
            </div>
        </div>
    </div>

    <div class="col-4">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Total Jumlah Buku</h4>
            </div>
            <div class="card-body">
                <h5><?= $totalBuku['quantity'] ?> Buku</h5>
            </div>
        </div>
    </div>

    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Grafik Jumlah Buku per Bulan</h4>
            </div>
            <div class="card-body">
                <canvas id="bukuPerBulanChart"></canvas>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    var bukuPerBulanData = <?= json_encode($bukuPerBulan) ?>;
    console.log(bukuPerBulanData);

    var bulan = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];

    var months = bulan;
    var totalBuku = new Array(12).fill(0);

    bukuPerBulanData.forEach(function(item) {
        totalBuku[item.month - 1] = item.total_buku;
    });

    var ctx = document.getElementById('bukuPerBulanChart').getContext('2d');

    var bukuPerBulanChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: months,
            datasets: [{
                label: 'Jumlah Buku per Bulan',
                data: totalBuku,
                borderColor: '#42a5f5',
                fill: false
            }]
        },
        options: {
            responsive: true,
            scales: {
                x: {
                    title: {
                        display: true,
                        text: 'Bulan'
                    }
                },
                y: {
                    title: {
                        display: true,
                        text: 'Jumlah Buku'
                    },
                    beginAtZero: true
                }
            }
        }
    });
</script>
<?= $this->endSection() ?>