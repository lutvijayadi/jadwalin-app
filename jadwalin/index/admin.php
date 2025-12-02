<?php

include '../koneksi/koneksi.php';

// Query for chart data: count events per month for the current year
$current_year = date('Y');
$query_chart = mysqli_query($koneksi, "SELECT MONTH(tanggal) as bulan, COUNT(*) as jumlah FROM jadwal WHERE YEAR(tanggal) = $current_year GROUP BY MONTH(tanggal) ORDER BY bulan");
$labels = [];
$dataPoints = [];
$months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
for ($i = 1; $i <= 12; $i++) {
    $labels[] = $months[$i - 1];
    $dataPoints[] = 0;
}
while ($row = mysqli_fetch_assoc($query_chart)) {
    $dataPoints[$row['bulan'] - 1] = (int) $row['jumlah'];
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Dashboard Jadwalin Warga</title>
    <script src="https://cdn.tailwindcss.com"></script>
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
                <!-- Dashboard Link - Set as ACTIVE -->
                <li>
                    <a href="../index/admin.php"
                        class="flex items-center gap-3 py-3 px-4 rounded-xl bg-blue-700 text-white font-semibold shadow-inner transition duration-200">
                        <!-- Menggunakan Feather Icon: home -->
                        <i data-feather="home" class="w-5 h-5"></i>
                        Dashboard
                    </a>
                </li>
                <!-- Manajemen Warga Link -->
                <li>
                    <a href="../admin/manajement_warga.php"
                        class="flex items-center gap-3 py-3 px-4 rounded-xl text-white font-medium hover:bg-blue-700 transition duration-200">
                        <!-- Menggunakan Feather Icon: users -->
                        <i data-feather="users" class="w-5 h-5"></i>
                        Manajemen Warga
                    </a>
                </li>
                <!-- Jadwal Kegiatan -->
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
                        <!-- Menggunakan Feather Icon: bell -->
                        <i data-feather="bell" class="w-5 h-5"></i>
                        Pengumuman
                    </a>
                </li>
                <!-- Laporan & Analitik Link -->
                <li>
                    <a href="../admin/laporan&analitik.php"
                        class="flex items-center gap-3 py-3 px-4 rounded-xl text-white font-medium hover:bg-blue-700 transition duration-200">
                        <!-- Menggunakan Feather Icon: bar-chart-2 -->
                        <i data-feather="bar-chart-2" class="w-5 h-5"></i>
                        Laporan & Analitik
                    </a>
                </li>
                <!-- Pengaturan Link -->
                <li>
                    <a href="../pengaturan/pengaturan.php"
                        class="flex items-center gap-3 py-3 px-4 rounded-xl text-white font-medium hover:bg-blue-700 transition duration-200">
                        <!-- Menggunakan Feather Icon: settings -->
                        <i data-feather="settings" class="w-5 h-5"></i>
                        Pengaturan
                    </a>
                </li>
            </ul>
        </div>

         

        <!-- Logout Link (Moved to bottom of sidebar) -->
        <a href="../aksi/logout.php"
            class="flex items-center gap-3 py-3 px-4 rounded-xl bg-indigo-400 text-white font-semibold hover:bg-red-500 transition duration-200 justify-center shadow-lg">
            <!-- Menggunakan Feather Icon: log-out -->
            <i data-feather="log-out" class="w-5 h-5"></i>
            Logout
        </a>
    </div>
        

    <!-- Content Area -->
    <div class="ml-64 w-full flex flex-col">

        <!-- Top Header Bar -->
        <header class="bg-white shadow-md p-4 flex justify-between items-center sticky top-0 z-10">
            <div class="flex items-center gap-2 text-xl font-semibold text-gray-700">
                <span class="text-blue-600">
                    <i data-feather="home" class="w-6 h-6"></i>
                </span>
                Dashboard Utama
            </div>
            <div class="flex items-center gap-3">
                <a href="../index/propil.php" class="text-sm font-medium text-gray-500">Admin</a>
                <div
                    class="w-10 h-10 bg-blue-500 text-white rounded-full flex items-center justify-center font-bold text-lg">
                    A
                </div>
            </div>
        </header>


        <!-- (Dashboard Layout) -->
        <div class="p-8 flex-grow">
            <h2 class="text-2xl font-bold mb-4 text-gray-800">RINGKASAN</h2>
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
                <!-- Card 1: Total Warga Terdaftar -->
                <div
                    class="bg-white p-6 rounded-xl shadow-lg border-l-4 border-blue-500 transform hover:scale-105 transition duration-300">
                    <p class="text-sm font-medium text-gray-500">Total Warga Terdaftar</p>
                    <h3 class="text-4xl font-extrabold text-blue-800 mt-1">
                        <?php
                        //hitung query
                        $data = mysqli_query($koneksi, "SELECT * FROM warga ORDER BY id DESC");
                        $total_jadwal = mysqli_num_rows($data);
                        echo number_format($total_jadwal);
                        ?>
                    </h3>
                    <p class="text-xs text-gray-400 mt-2">Data valid RT 01 - 05</p>
                </div>
                <!-- Card 2: Kegiatan Mendatang -->
                <div
                    class="bg-white p-6 rounded-xl shadow-lg border-l-4 border-yellow-500 transform hover:scale-105 transition duration-300">
                    <p class="text-sm font-medium text-gray-500">Kegiatan Mendatang</p>
                    <h3 class="text-4xl font-extrabold text-yellow-700 mt-1">
                        <?php
                        // Hitung total kegiatan mendatang 
                        $query_mendatang = mysqli_query($koneksi, "SELECT COUNT(*) as total FROM jadwal WHERE tanggal > CURDATE()");
                        $row_mendatang = mysqli_fetch_assoc($query_mendatang);
                        echo number_format($row_mendatang['total']);
                        ?>
                    </h3>
                    <p class="text-xs text-gray-400 mt-2">Harap diperhatikan</p>
                </div>
                <!-- Card 3: Pengumuman Aktif -->
                <div
                    class="bg-white p-6 rounded-xl shadow-lg border-l-4 border-green-500 transform hover:scale-105 transition duration-300">
                    <p class="text-sm font-medium text-gray-500">Pengumuman Aktif</p>
                    <h3 class="text-4xl font-extrabold text-green-700 mt-1">5</h3>
                    <p class="text-xs text-gray-400 mt-2">Sedang tayang</p>
                </div>
                <!-- Card 4: Total Laporan Masuk -->
                <div
                    class="bg-white p-6 rounded-xl shadow-lg border-l-4 border-purple-500 transform hover:scale-105 transition duration-300">
                    <p class="text-sm font-medium text-gray-500">Total Laporan Masuk</p>
                    <h3 class="text-4xl font-extrabold text-purple-700 mt-1">78</h3>
                    <p class="text-xs text-gray-400 mt-2">Perlu ditindaklanjuti</p>
                </div>
            </div>

            <!-- AKTIVITAS & JADWAL TERKINI -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
                <!-- Column 1: Aktivitas Chart -->
                <div class="bg-white p-6 rounded-xl shadow-lg">
                    <h3 class="text-xl font-semibold mb-4 text-gray-800">Aktivitas Bulanan</h3>
                    <canvas id="activityChart"></canvas>
                </div>

                <!-- Column 2: Jadwal Kegiatan & Pengumuman Terbaru -->
                <div class="space-y-6">
                    <!-- Jadwal Kegiatan Terbaru Placeholder -->
                    <div class="bg-white p-6 rounded-xl shadow-lg">
                        <h3 class="text-xl font-semibold mb-4 text-gray-800 flex justify-between items-center">
                            Jadwal Kegiatan Terbaru
                            <a href="index.php" class="text-blue-500 text-sm font-medium hover:text-blue-700">Lihat
                                Detail</a>
                        </h3>
                        <ul class="space-y-4">
                            <li class="flex items-center gap-3 border-b pb-2 last:border-b-0">
                                <div class="w-2 h-2 rounded-full bg-green-500"></div>
                                <div>
                                    <p class="font-medium text-gray-700">Kerja Bakti RT 01</p>
                                    <p class="text-xs text-gray-500">20 Oktober - 08:00 WIB</p>
                                </div>
                            </li>
                            <li class="flex items-center gap-3 border-b pb-2 last:border-b-0">
                                <div class="w-2 h-2 rounded-full bg-yellow-500"></div>
                                <div>
                                    <p class="font-medium text-gray-700">Senam Pagi Warga</p>
                                    <p class="text-xs text-gray-500">22 Oktober - 06:00 WIB</p>
                                </div>
                            </li>
                            <li class="flex items-center gap-3 border-b pb-2 last:border-b-0">
                                <div class="w-2 h-2 rounded-full bg-blue-500"></div>
                                <div>
                                    <p class="font-medium text-gray-700">Penyuluhan Kesehatan</p>
                                    <p class="text-xs text-gray-500">25 Oktober - 19:30 WIB</p>
                                </div>
                            </li>
                        </ul>
                    </div>

                    <!-- Pengumuman Terkini Placeholder -->
                    <div class="bg-white p-6 rounded-xl shadow-lg">
                        <h3 class="text-xl font-semibold mb-4 text-gray-800 flex justify-between items-center">
                            Pengumuman Terkini
                            <a href="pengumuman.php" class="text-blue-500 text-sm font-medium hover:text-blue-700">Lihat
                                Detail</a>
                        </h3>
                        <ul class="space-y-4">
                            <li class="flex items-center gap-3 border-b pb-2 last:border-b-0">
                                <div class="w-2 h-2 rounded-full bg-red-500"></div>
                                <div>
                                    <p class="font-medium text-gray-700">Pembayaran Iuran RT</p>
                                    <p class="text-xs text-gray-500">Oleh Admin - 1 Hari Lalu</p>
                                </div>
                            </li>
                            <li class="flex items-center gap-3 border-b pb-2 last:border-b-0">
                                <div class="w-2 h-2 rounded-full bg-green-500"></div>
                                <div>
                                    <p class="font-medium text-gray-700">Sistem Jadwal Terbaru</p>
                                    <p class="text-xs text-gray-500">Oleh Admin - 5 Jam Lalu</p>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- MANAJEMEN WARGA (Digantikan oleh Kelola Jadwal yang Anda miliki, agar logika PHP tetap ada) -->
            <h2 class="text-2xl font-bold mb-4 text-gray-800">KELOLA JADWAL (Modul Utama File Ini)</h2>
            <div class="flex flex-col sm:flex-row justify-between items-center mb-4 gap-4">
                <div class="relative w-full sm:w-1/3">
                    <input type="text" placeholder=" Cari acara..."
                        class="pl-10 pr-4 py-2 border border-gray-300 rounded-lg w-full focus:ring-2 focus:ring-blue-500 focus:outline-none shadow-sm transition" />
                    <!-- Menggunakan Feather Icon: search -->
                    <i data-feather="search"
                        class="w-5 h-5 text-gray-400 absolute left-3 top-1/2 transform -translate-y-1/2"></i>
                </div>

                <a href="../admin/tambah_jadwal.php"
                    class="px-6 py-2 bg-blue-600 text-white font-semibold rounded-xl hover:bg-indigo-300 flex items-center gap-2 shadow-lg transition transform hover:scale-105">
                    <!-- Menggunakan Feather Icon: plus -->
                    <i data-feather="plus" class="w-5 h-5"></i>
                    Tambah Jadwal
                </a>
            </div>

            <!-- Table Card (Mempertahankan Logic PHP Anda) -->
            <div class="bg-white shadow-2xl rounded-2xl overflow-hidden">
                <table class="w-full text-left border-collapse">
                    <thead class="bg-gradient-to-r from-blue-600 to-indigo-500 text-white shadow-inner">
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
                        // LOGIC PHP DARI KODE ASLI ANDA
                        $data = mysqli_query($koneksi, "SELECT * FROM jadwal ORDER BY id DESC");
                        if (mysqli_num_rows($data) > 0) {
                            while ($d = mysqli_fetch_assoc($data)) {
                                ?>
                                <tr class="border-b last:border-b-0 hover:bg-blue-50 transition duration-150 ease-in-out">
                                    <td class="p-4 text-gray-600 font-mono"><?= $d['id'] ?></td>
                                    <td class="p-4 text-gray-700 font-medium"><?= $d['tanggal'] ?></td>
                                    <td class="p-4 font-bold text-black-800"><?= $d['acara'] ?></td>
                                    <td class="p-4 text-gray-700 font-medium "><?= $d['keterangan'] ?></td>
                                    <td class="p-4 text-gray-700"><?= $d['lokasi'] ?></td>
                                    <td class="p-4 flex gap-3 justify-center items-center">
                                        <a href="edit.php?id=<?= $d['id'] ?>"
                                            class="p-2 bg-indigo-600 text-white rounded-lg hover:bg-yellow-600 transition shadow-md text-sm transform hover:scale-105">
                                            <i data-feather="edit" class="w-4 h-4"></i>
                                        </a>
                                        <a href="../aksi/aksi_hapus.php?id=<?= $d['id']; ?>"
                                            onclick="return confirm('Yakin ingin menghapus pengumuman: <?= $d['acara']; ?>?')"
                                            class="p-2 bg-red-500 text-white rounded-lg hover:bg-red-500 transition shadow-md text-sm transform hover:scale-105">
                                            <i data-feather="trash-2" class="w-4 h-4"></i>
                                        </a>
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

    <!-- Script untuk memuat Feather Icons dari CDN yang diminta dan menjalankannya -->

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://unpkg.com/feather-icons"></script>
    <script src="print.js"></script>
    <script>
        feather.replace();

        // Chart.js script
        const ctx = document.getElementById('activityChart').getContext('2d');
        const activityChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: <?php echo json_encode($labels); ?>,
                datasets: [{
                    label: 'Jumlah Acara',
                    data: <?php echo json_encode($dataPoints); ?>,
                    backgroundColor: 'rgba(59, 130, 246, 0.7)', // biru dari Tailwind
                    borderRadius: 4,
                    maxBarThickness: 30
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1
                        }
                    }
                },
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        callbacks: {
                            label: function (context) {
                                return context.parsed.y + ' acara';
                            }
                        }
                    }
                }
            }
        });
    </script>


</body>

</html>