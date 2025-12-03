<?php
include '../koneksi/koneksi.php';
// Catatan: Asumsi terdapat tabel 'pengumuman' dengan kolom: id, judul, isi, tanggal_publikasi.

// Fungsi untuk mendapatkan semua data pengumuman
$data_pengumuman = mysqli_query($koneksi, "SELECT * FROM pengumuman ORDER BY tanggal_publikasi DESC");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Kelola Pengumuman</title>
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
                <!-- Pengumuman Link - Set as ACTIVE -->
                <li>
                    <a href="../admin/pengumuman.php"
                        class="flex items-center gap-3 py-3 px-4 rounded-xl bg-blue-700 text-white font-semibold shadow-inner transition duration-200">
                        <i data-feather="bell" class="w-5 h-5"></i>
                        Pengumuman
                    </a>
                </li>
                <!-- Laporan & Analitik Link -->
                <li>
                    <a href="../admin/laporan&analitik.php"
                        class="flex items-center gap-3 py-3 px-4 rounded-xl text-white font-medium hover:bg-blue-700 transition duration-200">
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
                <span class="text-blue-600">
                    <i data-feather="bell" class="w-6 h-6"></i>
                </span>
                Kelola Pengumuman
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

            <h2 class="text-3xl font-bold mb-6 text-gray-800">DAFTAR SEMUA PENGUMUMAN</h2>

            <!-- Search and Add Bar -->
            <div class="flex flex-col sm:flex-row justify-between items-center mb-6 gap-4">
                <div class="relative w-full sm:w-1/3">
                    <input type="text" placeholder=" Cari judul pengumuman..."
                        class="pl-10 pr-4 py-2 border border-gray-300 rounded-lg w-full focus:ring-2 focus:ring-orange-500 focus:outline-none shadow-sm transition" />
                    <i data-feather="search"
                        class="w-5 h-5 text-gray-400 absolute left-3 top-1/2 transform -translate-y-1/2"></i>
                </div>

                <!-- Link untuk tambah pengumuman -->
                <a href="../admin/tambah_pengumuman.php"
                    class="px-6 py-2 bg-blue-600 text-white font-semibold rounded-xl hover:bg-indigo-300 flex items-center gap-2 shadow-lg transition transform hover:scale-105">
                    <i data-feather="plus" class="w-5 h-5"></i>
                    Buat Pengumuman Baru
                </a>
            </div>

            <!-- Table Card -->
            <div class="bg-white shadow-2xl rounded-2xl overflow-hidden">
                <table class="w-full text-left border-collapse">
                    <thead class="bg-gradient-to-r from-blue-600 to-indigo-400 text-white shadow-inner">
                        <tr>
                            <th class="p-4 text-sm font-bold uppercase tracking-wider w-16">id</th>
                            <th class="p-4 text-sm font-bold uppercase tracking-wider w-1/4">Judul</th>
                            <th class="p-4 text-sm font-bold uppercase tracking-wider">keterangan</th>
                            <th class="p-4 text-sm font-bold uppercase tracking-wider w-32">Tanggal</th>
                            <th class="p-4 text-sm font-bold uppercase tracking-wider text-center w-28">Opsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // LOGIC PHP UNTUK MENAMPILKAN DATA PENGUMUMAN
                        if (mysqli_num_rows($data_pengumuman) > 0) {
                            while ($d = mysqli_fetch_assoc($data_pengumuman)) {
                                ?>
                                <tr class="border-b last:border-b-0 hover:bg-blue-50 transition duration-150 ease-in-out">
                                    <td class="p-4 text-blue-600 font-mono"><?= $d['id'] ?></td>
                                    <td class="p-4 font-medium text-gray-800"><?= $d['judul'] ?></td>
                                    <td class="p-4 text-gray-700 font-medium"><?= $d['keterangan'] ?></td>
                                    <td class="p-4 text-black-700 text-sm"><?= $d['tanggal_publikasi'] ?></td>
                                    <td class="p-4 flex gap-3 justify-center items-center">
                                        <a href="edit_pengumuman.php?id=<?= $d['id'] ?>"
                                            class="p-2 bg-blue-600 text-white rounded-lg hover:bg-blue-300 transition shadow-md text-sm transform hover:scale-105"
                                            title="Edit Pengumuman">
                                            <i data-feather="edit" class="w-4 h-4"></i>
                                        </a>
                                        <a href="../aksi/aksi_hapus_pengumuman.php?id=<?= $d['id']; ?>"
                                            onclick="return confirm('Yakin ingin menghapus pengumuman: <?= $d['judul']; ?>?')"
                                            class="p-2 bg-red-500 text-white rounded-lg hover:bg-red-300 transition shadow-md text-sm transform hover:scale-105"
                                            title="Hapus Pengumuman">
                                            <i data-feather="trash-2" class="w-4 h-4"></i>
                                        </a>
                                    </td>
                                </tr>
                            <?php }
                        } else { ?>
                            <tr>
                                <td colspan="5" class="p-8 text-center text-indigo-500 italic">Belum ada pengumuman yang
                                    dipublikasikan.</td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Script untuk memuat Feather Icons -->
    <script src="https://unpkg.com/feather-icons"></script>
    <script>
        feather.replace();
    </script>

</body>

</html>