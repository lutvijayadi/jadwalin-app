<?php
include '../koneksi/koneksi.php';

// 1. Mendapatkan total jumlah seluruh warga
$q_total_warga = mysqli_query($koneksi, "SELECT COUNT(*) AS total FROM warga");
$d_total_warga = $q_total_warga ? mysqli_fetch_assoc($q_total_warga) : ['total' => 0];
$raw_total_warga = (int)$d_total_warga['total'];
$total_warga = number_format($raw_total_warga, 0, ',', '.');

// 2. Mendapatkan total warga berdasarkan status (Asumsi: 'Kepala Keluarga', 'Anggota Keluarga', 'Warga Pendatang')
$q_total_kk = mysqli_query($koneksi, "SELECT COUNT(*) AS total FROM warga WHERE status='Kepala Keluarga'");
$d_total_kk = $q_total_kk ? mysqli_fetch_assoc($q_total_kk) : ['total' => 0];
$raw_total_kk = (int)$d_total_kk['total'];
$total_kk = number_format($raw_total_kk, 0, ',', '.');

$q_total_anggota = mysqli_query($koneksi, "SELECT COUNT(*) AS total FROM warga WHERE status='Anggota Keluarga'");
$d_total_anggota = $q_total_anggota ? mysqli_fetch_assoc($q_total_anggota) : ['total' => 0];
$raw_total_anggota = (int)$d_total_anggota['total'];

$q_total_pendatang = mysqli_query($koneksi, "SELECT COUNT(*) AS total FROM warga WHERE status='Warga Pendatang'");
$d_total_pendatang = $q_total_pendatang ? mysqli_fetch_assoc($q_total_pendatang) : ['total' => 0];
$raw_total_pendatang = (int)$d_total_pendatang['total'];


// 3. Mendapatkan total kegiatan (dari tabel jadwal)
$q_kegiatan_selesai = mysqli_query($koneksi, "SELECT COUNT(*) AS total FROM jadwal");
$d_kegiatan_selesai = $q_kegiatan_selesai ? mysqli_fetch_assoc($q_kegiatan_selesai) : ['total' => 0];
$kegiatan_selesai = number_format((int)$d_kegiatan_selesai['total'], 0, ',', '.');
$raw_kegiatan_selesai = (int)$d_kegiatan_selesai['total'];


// 4. Mendapatkan total pengumuman (Asumsi: tabel 'pengumuman' punya kolom 'tanggal_dibuat')
$q_total_pengumuman = mysqli_query($koneksi, "SELECT COUNT(*) AS total FROM pengumuman");
$d_total_pengumuman = $q_total_pengumuman ? mysqli_fetch_assoc($q_total_pengumuman) : ['total' => 0];
$total_pengumuman = number_format((int)$d_total_pengumuman['total'], 0, ',', '.');

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Laporan & Analitik</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.3/dist/chart.umd.min.js"></script>
    <style>
        /* Custom font and base styles */
        body {
            font-family: 'Inter', sans-serif;
        }

        /* Custom scrollbar for better aesthetics */
        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-thumb {
            background-color: #9ca3af;
            /* gray-400 */
            border-radius: 4px;
        }

        ::-webkit-scrollbar-track {
            background-color: #f3f4f6;
            /* gray-100 */
        }
    </style>
</head>

<body class="bg-white-50 flex min-h-screen">

    <div class="w-64 min-h-screen bg-blue-600 p-6 shadow-2xl fixed flex flex-col justify-between">
        <div>
            <h1 class="text-4xl font-poppins text-white mb-10 tracking-wider">WargaKita</h1>
            <ul class="space-y-3">
                <li>
                    <a href="../index/admin.php"
                        class="flex items-center gap-3 py-3 px-4 rounded-xl text-white font-medium hover:bg-blue-700 transition duration-200">
                        <i data-feather="home" class="w-5 h-5"></i>
                        Dashboard
                    </a>
                </li>
                <li>
                    <a href="../admin/manajement_warga.php"
                        class="flex items-center gap-3 py-3 px-4 rounded-xl text-white font-medium hover:bg-blue-700 transition duration-200">
                        <i data-feather="users" class="w-5 h-5"></i>
                        Manajemen Warga
                    </a>
                </li>
                <li>
                    <a href="../admin/jadwal_kegiatan.php"
                        class="flex items-center gap-3 py-3 px-4 rounded-xl text-white font-medium hover:bg-blue-700 transition duration-200">
                        <i data-feather="calendar" class="w-5 h-5"></i>
                        Jadwal Kegiatan
                    </a>
                </li>
                <li>
                    <a href="../admin/pengumuman.php"
                        class="flex items-center gap-3 py-3 px-4 rounded-xl text-white font-medium hover:bg-blue-700 transition duration-200">
                        <i data-feather="bell" class="w-5 h-5"></i>
                        Pengumuman
                    </a>
                </li>
                <li>
                    <a href="../admin/laporan&analitik.php"
                        class="flex items-center gap-3 py-3 px-4 rounded-xl bg-blue-700 text-white font-semibold shadow-inner transition duration-200">
                        <i data-feather="bar-chart-2" class="w-5 h-5"></i>
                        Laporan & Analitik
                    </a>
                </li>
                <li>
                    <a href="../pengaturan/pengaturan.php"
                        class="flex items-center gap-3 py-3 px-4 rounded-xl text-white font-medium hover:bg-blue-700 transition duration-200">
                        <i data-feather="settings" class="w-5 h-5"></i>
                        Pengaturan
                    </a>
                </li>
            </ul>
        </div>

        <a href="../aksi/logout.php"
            class="flex items-center gap-3 py-3 px-4 rounded-xl bg-indigo-400 text-white font-semibold hover:bg-red-500 transition duration-200 justify-center shadow-lg">
            <i data-feather="log-out" class="w-5 h-5"></i>
            Logout
        </a>
    </div>

    <div class="ml-64 w-full flex flex-col">

        <header class="bg-white shadow-md p-4 flex justify-between items-center sticky top-0 z-10">
            <div class="flex items-center gap-2 text-xl font-semibold text-gray-700">
                <span class="text-blue-600">
                    <i data-feather="bar-chart-2" class="w-6 h-6"></i>
                </span>
                Laporan & Analitik
            </div>
            <div class="flex items-center gap-3">
                <span class="text-sm font-medium text-gray-500">Admin</span>
                <div
                    class="w-10 h-10 bg-blue-500 text-white rounded-full flex items-center justify-center font-bold text-lg">
                    A
                </div>
            </div>
        </header>


        <div class="p-8 flex-grow">

            <h2 class="text-3xl font-bold mb-8 text-gray-800">RINGKASAN ANALITIK KEGIATAN WARGA</h2>

            <div
                class="flex flex-wrap items-center gap-4 mb-6 p-4 bg-white rounded-xl shadow-lg border border-green-100">
                <span class="font-medium text-gray-700">Tampilkan Data Warga:</span>
                <select
                    class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:outline-none shadow-sm">
                    <option>Semua (<?= $total_warga ?> Warga)</option>
                    <option>100 Warga Terakhir</option>
                    <option>500 Warga Terakhir</option>
                    <option>Hanya Kepala Keluarga (<?= $total_kk ?>)</option>
                </select>
                <button
                    class="px-5 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 font-semibold transition shadow-md">
                    Lihat Laporan Detail
                </button>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
                <div
                    class="bg-white p-6 rounded-2xl shadow-xl border-t-4 border-blue-500 transition duration-300 hover:shadow-2xl">
                    <div class="flex items-center justify-between">
                        <span class="text-sm font-medium text-gray-500">Total Warga Terdaftar</span>
                        <i data-feather="users" class="w-6 h-6 text-green-500"></i>
                    </div>
                    <div class="mt-1">
                        <span class="text-4xl font-extrabold text-gray-800"><?= $total_warga ?></span>
                    </div>
                    <p class="text-xs text-gray-400 mt-2">Data Real-time dari Database</p>
                </div>

                <div
                    class="bg-white p-6 rounded-2xl shadow-xl border-t-4 border-blue-500 transition duration-300 hover:shadow-2xl">
                    <div class="flex items-center justify-between">
                        <span class="text-sm font-medium text-gray-500">Total Kegiatan Terdaftar</span>
                        <i data-feather="check-circle" class="w-6 h-6 text-black-500"></i>
                    </div>
                    <div class="mt-1">
                        <span class="text-4xl font-extrabold text-gray-800"><?= $kegiatan_selesai ?></span>
                    </div>
                    <p class="text-xs text-gray-400 mt-2">Diambil dari Tabel Jadwal</p>
                </div>

                <div
                    class="bg-white p-6 rounded-2xl shadow-xl border-t-4 border-blue-500 transition duration-300 hover:shadow-2xl">
                    <div class="flex items-center justify-between">
                        <span class="text-sm font-medium text-gray-500">Rata-rata Partisipasi</span>
                        <i data-feather="trending-up" class="w-6 h-6 text-blue-500"></i>
                    </div>
                    <div class="mt-1">
                        <span class="text-4xl font-extrabold text-gray-800">85%</span>
                    </div>
                    <p class="text-xs text-gray-400 mt-2">Tertinggi pada Acara Festival</p>
                </div>

                <div
                    class="bg-white p-6 rounded-2xl shadow-xl border-t-4 border-blue-500 transition duration-300 hover:shadow-2xl">
                    <div class="flex items-center justify-between">
                        <span class="text-sm font-medium text-gray-500">Total Pengumuman</span>
                        <i data-feather="message-square" class="w-6 h-6 text-blue-500"></i>
                    </div>
                    <div class="mt-1">
                        <span class="text-4xl font-extrabold text-gray-800">
                            <?= $total_pengumuman ?>
                        </span>
                    </div>
                    <p class="text-xs text-gray-400 mt-2">Total Pengumuman Tersimpan</p>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <div class="lg:col-span-2 bg-white p-6 rounded-2xl shadow-xl">
                    <h3 class="text-xl font-bold text-gray-800 mb-4 border-b pb-2">Tren Kegiatan vs Partisipasi (6
                        Bulan) (Simulasi)</h3>
                    <canvas id="barChart" class="w-full h-80"></canvas>
                </div>

                <div class="bg-white p-6 rounded-2xl shadow-xl">
                    <h3 class="text-xl font-bold text-gray-800 mb-4 border-b pb-2">Distribusi Status Warga (Real)</h3>
                    <div class="h-80 flex items-center justify-center">
                        <canvas id="doughnutChart" class="max-w-full"></canvas>
                    </div>

                </div>
            </div>

            <div class="mt-8 bg-white shadow-2xl rounded-2xl overflow-hidden">
                <h3 class="p-6 text-xl font-bold text-gray-800 bg-gray-50 border-b">DAFTAR SEMUA JADWAL KEGIATAN
                </h3>
                <table class="w-full text-left border-collapse">
                    <thead class="bg-gradient-to-r from-blue-700 to-blue-500 text-white shadow-inner">
                        <tr>
                            <th class="p-4 text-sm font-bold uppercase tracking-wider">ID</th>
                            <th class="p-4 text-sm font-bold uppercase tracking-wider">Tanggal</th>
                            <th class="p-4 text-sm font-bold uppercase tracking-wider">Acara</th>
                            <th class="p-4 text-sm font-bold uppercase tracking-wider">Keterangan</th>
                            <th class="p-4 text-sm font-bold uppercase tracking-wider">Lokasi</th>
                            <th class="p-4 text-sm font-bold uppercase tracking-wider text-center">Opsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Mengambil data dari tabel 'jadwal'
                        $data_jadwal = mysqli_query($koneksi, "SELECT * FROM jadwal ORDER BY id DESC LIMIT 5"); // Batasi 5 untuk laporan ringkas
                        if (mysqli_num_rows($data_jadwal) > 0) {
                            while ($d = mysqli_fetch_assoc($data_jadwal)) {
                                ?>
                                <tr class="border-b last:border-b-0 hover:bg-blue-50 transition duration-150 ease-in-out">
                                    <td class="p-4 text-gray-600 font-mono"><?= $d['id'] ?></td>
                                    <td class="p-4 text-gray-700 font-medium"><?= $d['tanggal'] ?></td>
                                    <td class="p-4 font-extrabold text-blue-800"><?= $d['acara'] ?></td>
                                    <td class="p-4 text-gray-500 text-sm max-w-xs truncate"><?= $d['keterangan'] ?></td>
                                    <td class="p-4 text-gray-700"><?= $d['lokasi'] ?></td>
                                    <td class="p-4 flex gap-3 justify-center items-center">
                                        <button
                                            class="p-2 bg-blue-500 text-white rounded-lg hover:bg-blue-300 transition shadow-md text-sm transform hover:scale-105"
                                            title="Lihat Detail">
                                            <i data-feather="eye" class="w-4 h-4"></i>
                                        </button>
                                    </td>
                                </tr>
                            <?php }
                        } else { ?>
                            <tr>
                                <td colspan="6" class="p-8 text-center text-gray-500 italic">Belum ada jadwal kegiatan yang
                                    ditambahkan.</td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>

        </div>
    </div>

    <script src="https://unpkg.com/feather-icons"></script>
    <script>
        feather.replace();

        // Data Simulasi untuk Bar Chart (Tren Kegiatan)
        const barCtx = document.getElementById('barChart').getContext('2d');
        new Chart(barCtx, {
            type: 'bar',
            data: {
                labels: ['Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt'],
                datasets: [{
                    label: 'Jumlah Kegiatan',
                    data: [5, 7, 6, 8, 5, 9],
                    backgroundColor: 'rgba(22, 163, 74, 0.8)', // Green-700
                    borderColor: 'rgba(22, 163, 74, 1)',
                    borderWidth: 1,
                    borderRadius: 4
                },
                {
                    label: 'Rata-rata Partisipasi (%)',
                    data: [70, 75, 80, 85, 88, 92],
                    type: 'line', // Membuatnya menjadi Line Chart
                    borderColor: 'rgba(249, 115, 22, 1)', // Orange-500
                    backgroundColor: 'rgba(249, 115, 22, 0.2)',
                    fill: false,
                    yAxisID: 'y1' // Menggunakan axis sekunder
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        title: { display: true, text: 'Jumlah Kegiatan' }
                    },
                    y1: {
                        type: 'linear', // Tipe linear
                        position: 'right', // Posisi di sebelah kanan
                        min: 50,
                        max: 100,
                        grid: { drawOnChartArea: false }, // Jangan tampilkan grid untuk axis ini
                        title: { display: true, text: 'Partisipasi (%)' }
                    }
                },
                plugins: {
                    legend: { position: 'top' },
                    title: { display: false }
                }
            }
        });

        // Data Real/Dinamis untuk Doughnut Chart (Distribusi Status Warga)
        const doughnutCtx = document.getElementById('doughnutChart').getContext('2d');
        new Chart(doughnutCtx, {
            type: 'doughnut',
            data: {
                labels: ['Kepala Keluarga', 'Anggota Keluarga', 'Warga Pendatang'],
                datasets: [{
                    data: [<?php echo $raw_total_kk; ?>, <?php echo $raw_total_anggota; ?>, <?php echo $raw_total_pendatang; ?>],
                    backgroundColor: [
                        'rgba(7, 96, 155, 0.9)',  // Green
                        'rgba(59, 130, 246, 0.9)', // Blue
                        'rgba(128, 119, 113, 0.9)'  // Orange
                    ],
                    hoverOffset: 4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { position: 'bottom' },
                    tooltip: {
                        callbacks: {
                            label: function (context) {
                                let label = context.label || '';
                                if (label) {
                                    label += ': ';
                                }
                                if (context.parsed !== null) {
                                    // Hitung persentase dari total warga
                                    const totalWarga = <?php echo $raw_total_warga; ?>;
                                    const value = context.parsed;
                                    const percentage = totalWarga > 0 ? ((value / totalWarga) * 100).toFixed(1) : 0;
                                    label += new Intl.NumberFormat('id-ID').format(value) + ' Orang (' + percentage + '%)';
                                }
                                return label;
                            }
                        }
                    }
                }
            }
        });
    </script>

</body>

</html>