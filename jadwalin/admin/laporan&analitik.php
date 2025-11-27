<?php
include '../koneksi/koneksi.php';
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Laporan & Analitik</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Script untuk Chart.js (simulasi visualisasi data) -->
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

    <!-- Sidebar -->
    <div class="w-64 min-h-screen bg-blue-600 p-6 shadow-2xl fixed flex flex-col justify-between">
        <!-- Logo and Main Navigation -->
        <div>
            <h1 class="text-4xl font-poppins text-white mb-10 tracking-wider">WargaKita</h1>
            <ul class="space-y-3">
                <!-- Dashboard Link -->
                <li>
                    <a href="../index/admin.php"
                        class="flex items-center gap-3 py-3 px-4 rounded-xl text-white font-medium hover:bg-blue-700 transition duration-200">
                        <i data-feather="home" class="w-5 h-5"></i>
                        Dashboard
                    </a>
                </li>
                <!-- Manajemen Warga Link -->
                <li>
                    <a href="../admin/manajement_warga.php"
                        class="flex items-center gap-3 py-3 px-4 rounded-xl text-white font-medium hover:bg-blue-700 transition duration-200">
                        <i data-feather="users" class="w-5 h-5"></i>
                        Manajemen Warga
                    </a>
                </li>
                <!-- Jadwal Kegiatan Link -->
                <li>
                    <a href="../admin/jadwal_kegiatan.php"
                        class="flex items-center gap-3 py-3 px-4 rounded-xl text-white font-medium hover:bg-blue-700 transition duration-200">
                        <i data-feather="calendar" class="w-5 h-5"></i>
                        Jadwal Kegiatan
                    </a>
                </li>
                <!-- Pengumuman Link -->
                <li>
                    <a href="../admin/pengumuman.php"
                        class="flex items-center gap-3 py-3 px-4 rounded-xl text-white font-medium hover:bg-blue-700 transition duration-200">
                        <i data-feather="bell" class="w-5 h-5"></i>
                        Pengumuman
                    </a>
                </li>
                <!-- Laporan & Analitik Link - Set as ACTIVE -->
                <li>
                    <a href="../admin/laporan&analitik.php"
                        class="flex items-center gap-3 py-3 px-4 rounded-xl bg-blue-700 text-white font-semibold shadow-inner transition duration-200">
                        <i data-feather="bar-chart-2" class="w-5 h-5"></i>
                        Laporan & Analitik
                    </a>
                </li>
                <!-- Pengaturan Link -->
                <li>
                    <a href="../pengaturan/pengaturan.php"
                        class="flex items-center gap-3 py-3 px-4 rounded-xl text-white font-medium hover:bg-blue-700 transition duration-200">
                        <i data-feather="settings" class="w-5 h-5"></i>
                        Pengaturan
                    </a>
                </li>
            </ul>
        </div>

        <!-- Logout Link (Moved to bottom of sidebar) -->
        <a href="../aksi/logout.php"
            class="flex items-center gap-3 py-3 px-4 rounded-xl bg-indigo-400 text-white font-semibold hover:bg-red-500 transition duration-200 justify-center shadow-lg">
            <i data-feather="log-out" class="w-5 h-5"></i>
            Logout
        </a>
    </div>

    <!-- Content Area -->
    <div class="ml-64 w-full flex flex-col">

        <!-- Top Header Bar -->
        <header class="bg-white shadow-md p-4 flex justify-between items-center sticky top-0 z-10">
            <div class="flex items-center gap-2 text-xl font-semibold text-gray-700">
                <span class="text-green-600">
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


        <!-- Main Content -->
        <div class="p-8 flex-grow">

            <h2 class="text-3xl font-bold mb-8 text-gray-800">RINGKASAN ANALITIK KEGIATAN WARGA</h2>

            <!-- Filter Section (DINAMIS) -->
            <div
                class="flex flex-wrap items-center gap-4 mb-6 p-4 bg-white rounded-xl shadow-lg border border-green-100">
                <span class="font-medium text-gray-700">Tampilkan Data Warga:</span>
                <select
                    class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:outline-none shadow-sm">
                    <!-- Data diambil dari COUNT(*) di atas -->
                    <option>Semua (<?= $total_warga ?> Warga)</option>
                    <option>100 Warga Terakhir</option>
                    <option>500 Warga Terakhir</option>
                    <!-- Data diambil dari COUNT(*) WHERE status='Kepala Keluarga' -->
                    <option>Hanya Kepala Keluarga (<?= $total_kk ?>)</option>
                </select>
                <button
                    class="px-5 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 font-semibold transition shadow-md">
                    Lihat Laporan Detail
                </button>
            </div>

            <!-- Summary Cards / KPI -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
                <!-- Kartu 1: Total Warga (DINAMIS) -->
                <div
                    class="bg-white p-6 rounded-2xl shadow-xl border-t-4 border-green-500 transition duration-300 hover:shadow-2xl">
                    <div class="flex items-center justify-between">
                        <span class="text-sm font-medium text-gray-500">Total Warga Terdaftar</span>
                        <i data-feather="users" class="w-6 h-6 text-green-500"></i>
                    </div>
                    <div class="mt-1">
                        <!-- Nilai diambil dari COUNT(*) di atas -->
                        <?php
                        // 1. Mendapatkan total jumlah seluruh warga
                        $q_total_warga = mysqli_query($koneksi, "SELECT COUNT(*) AS total FROM warga");
                        if ($q_total_warga) {
                            $d_total_warga = mysqli_fetch_assoc($q_total_warga);
                            $total_warga = number_format($d_total_warga['total'], 0, ',', '.');
                            $raw_total_warga = $d_total_warga['total'];
                        } else {
                            $total_warga = '0';
                            $raw_total_warga = 0;
                        }
                        ?>
                        <span class="text-4xl font-extrabold text-gray-800"><?= $total_warga ?></span>
                    </div>
                    <p class="text-xs text-gray-400 mt-2">+5 Warga Baru Bulan Ini</p>
                </div>

                <!-- Kartu 2: Kegiatan Selesai -->
                <div
                    class="bg-white p-6 rounded-2xl shadow-xl border-t-4 border-yellow-500 transition duration-300 hover:shadow-2xl">
                    <div class="flex items-center justify-between">
                        <span class="text-sm font-medium text-gray-500">Kegiatan Selesai (YTD)</span>
                        <i data-feather="check-circle" class="w-6 h-6 text-yellow-500"></i>
                    </div>
                    <div class="mt-1">
                        <?php
                        // 1. Mendapatkan total jumlah seluruh warga
                        $q_kegiatan_selesai = mysqli_query($koneksi, "SELECT COUNT(*) AS total FROM jadwal");
                        if ($q_kegiatan_selesai) {
                            $d_kegiatan_selesai = mysqli_fetch_assoc($q_kegiatan_selesai);
                            $kegiatan_selesai = number_format($d_kegiatan_selesai['total'], 0, ',', '.');
                            $raw_kegiatan_selesai = $d_kegiatan_selesai['total'];
                        } else {
                            $kegiatan_selesai = '0';
                            $raw_kegiatan_selesai = 0;
                        }
                        ?>
                        <span class="text-4xl font-extrabold text-gray-800"><?= $kegiatan_selesai ?></span>
                    </div>
                    <p class="text-xs text-gray-400 mt-2">Target 100 Kegiatan Tahun Ini</p>
                </div>

                <!-- Kartu 3: Partisipasi Rata-rata -->
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

                <!-- Kartu 4: Pengumuman Dibuat -->
                <div
                    class="bg-white p-6 rounded-2xl shadow-xl border-t-4 border-orange-500 transition duration-300 hover:shadow-2xl">
                    <div class="flex items-center justify-between">
                        <span class="text-sm font-medium text-gray-500">Pengumuman Dibuat</span>
                        <i data-feather="message-square" class="w-6 h-6 text-orange-500"></i>
                    </div>
                    <div class="mt-1">
                        <span class="text-4xl font-extrabold text-gray-800">24</span>
                    </div>
                    <p class="text-xs text-gray-400 mt-2">Dibuat 4 Pengumuman Bulan Ini</p>
                </div>
            </div>

            <!-- Charts Section -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Grafik 1: Tren Kegiatan Bulanan (Bar Chart) -->
                <div class="lg:col-span-2 bg-white p-6 rounded-2xl shadow-xl">
                    <h3 class="text-xl font-bold text-gray-800 mb-4 border-b pb-2">Tren Kegiatan vs Partisipasi (6
                        Bulan)</h3>
                    <canvas id="barChart" class="w-full h-80"></canvas>
                </div>

                <!-- Grafik 2: Distribusi Status Warga (Doughnut Chart) -->
                <div class="bg-white p-6 rounded-2xl shadow-xl">
                    <h3 class="text-xl font-bold text-gray-800 mb-4 border-b pb-2">Distribusi Status Warga</h3>
                    <div class="flex justify-center h-80">
                        <canvas id="doughnutChart" class="max-w-full"></canvas>
                    </div>
                </div>
            </div>

            <!-- Area Laporan Detail (Simulasi Tabel) -->
            <div class="mt-8 bg-white shadow-2xl rounded-2xl overflow-hidden">
                <h3 class="p-6 text-xl font-bold text-gray-800 bg-gray-50 border-b">Laporan Partisipasi Kegiatan
                    Terakhir</h3>
                <table class="w-full text-left border-collapse">
                    <thead class="bg-gradient-to-r from-green-700 to-green-500 text-white shadow-inner">
                        <tr>
                            <th class="p-4 text-sm font-bold uppercase tracking-wider">Kegiatan</th>
                            <th class="p-4 text-sm font-bold uppercase tracking-wider">Tanggal</th>
                            <th class="p-4 text-sm font-bold uppercase tracking-wider text-center">Partisipasi (Orang)
                            </th>
                            <th class="p-4 text-sm font-bold uppercase tracking-wider text-center">Persentase</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="border-b last:border-b-0 hover:bg-green-50 transition duration-150 ease-in-out">
                            <td class="p-4 font-extrabold text-gray-800">Kerja Bakti RT 01</td>
                            <td class="p-4 text-gray-700">2025-10-25</td>
                            <td class="p-4 text-center font-bold text-green-600">45</td>
                            <td class="p-4 text-center text-sm font-medium">85%</td>
                        </tr>
                        <tr class="border-b last:border-b-0 hover:bg-green-50 transition duration-150 ease-in-out">
                            <td class="p-4 font-extrabold text-gray-800">Rapat Bulanan RT</td>
                            <td class="p-4 text-gray-700">2025-10-10</td>
                            <td class="p-4 text-center font-bold text-green-600">30</td>
                            <td class="p-4 text-center text-sm font-medium">70%</td>
                        </tr>
                        <tr class="border-b last:border-b-0 hover:bg-green-50 transition duration-150 ease-in-out">
                            <td class="p-4 font-extrabold text-gray-800">Senam Pagi Warga</td>
                            <td class="p-4 text-gray-700">2025-10-05</td>
                            <td class="p-4 text-center font-bold text-green-600">120</td>
                            <td class="p-4 text-center text-sm font-medium">95%</td>
                        </tr>
                    </tbody>
                </table>
            </div>

        </div>
    </div>

    <!-- Script untuk memuat Feather Icons dan inisialisasi Charts -->
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

        // Data Simulasi untuk Doughnut Chart (Distribusi Status Warga)
        const doughnutCtx = document.getElementById('doughnutChart').getContext('2d');
        new Chart(doughnutCtx, {
            type: 'doughnut',
            data: {
                labels: ['Kepala Keluarga', 'Anggota Keluarga', 'Warga Pendatang'],
                datasets: [{
                    data: [<?php echo $raw_total_kk; ?>, <?php echo $raw_total_anggota; ?>, <?php echo $raw_total_pendatang; ?>],
                    backgroundColor: [
                        'rgba(22, 163, 74, 0.9)',  // Green
                        'rgba(59, 130, 246, 0.9)', // Blue
                        'rgba(249, 115, 22, 0.9)'  // Orange
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
                                    // Angka ini sekarang statis di JS, tapi idealnya diambil dari $raw_total_warga 
                                    // dan dihitung proporsinya di PHP sebelum diteruskan ke JS.
                                    label += new Intl.NumberFormat('id-ID').format(context.parsed) + ' Orang';
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