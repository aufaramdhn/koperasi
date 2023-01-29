<?php

// Chart
$chart_pinjaman = mysqli_query($koneksi, "SELECT MONTHNAME(tgl_pinjam) as monthname, SUM(jumlah_pinjam) as jumlah FROM tbl_pinjam GROUP BY monthname ORDER BY tgl_pinjam");

foreach ($chart_pinjaman as $data_pinjaman) {
    $month_pinjaman[] = $data_pinjaman['monthname'];
    $jumlah_pinjaman[] = $data_pinjaman['jumlah'];
}


?>
<div class="w-100">
    <div class="p-2 card">
        <canvas id="chartPinjaman"></canvas>
    </div>
</div>
<script>
    const labelsPinjaman = <?= json_encode($month_pinjaman) ?>;
    const dataPinjaman = {
        labels: labelsPinjaman,
        datasets: [{
            label: 'Saldo Pinjaman',
            data: <?= json_encode($jumlah_pinjaman) ?>,
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
    const configPinjaman = {
        type: 'bar',
        data: dataPinjaman,
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        },
    };

    const chartPinjaman = new Chart(
        document.getElementById('chartPinjaman'),
        configPinjaman
    );
</script>