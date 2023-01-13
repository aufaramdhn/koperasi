<?php
require "../../apps/koneksi.php";

// Chart
$chart = mysqli_query($koneksi, "SELECT MONTHNAME(tgl_simpan) as monthname, SUM(jumlah_simpan) as jumlah FROM tbl_simpan GROUP BY monthname ORDER BY tgl_simpan");

foreach ($chart as $data) {
    $month[] = $data['monthname'];
    $jumlah[] = $data['jumlah'];
}


?>
<div class="w-100">
    <div class="p-5 card">
        <canvas id="myChart"></canvas>
    </div>
</div>
<script>
    const labels = <?= json_encode($month) ?>;
    const data = {
        labels: labels,
        datasets: [{
            label: 'Saldo Simpanan',
            data: <?= json_encode($jumlah) ?>,
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(255, 159, 64, 0.2)',
                'rgba(255, 205, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(201, 203, 207, 0.2)'
            ],
            borderColor: [
                'rgb(255, 99, 132)',
                'rgb(255, 159, 64)',
                'rgb(255, 205, 86)',
                'rgb(75, 192, 192)',
                'rgb(54, 162, 235)',
                'rgb(153, 102, 255)',
                'rgb(201, 203, 207)'
            ],
            borderWidth: 1
        }]
    };
    const config = {
        type: 'bar',
        data: data,
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        },
    };

    const myChart = new Chart(
        document.getElementById('myChart'),
        config
    );
</script>