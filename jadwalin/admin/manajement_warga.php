<?php
include '../koneksi/koneksi.php';
// Catatan: Asumsi terdapat tabel 'warga' dengan kolom: id, nama, alamat, no_telepon, status_warga.

// Fungsi untuk mendapatkan semua data warga
$data_warga = mysqli_query($koneksi, "SELECT * FROM warga ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Manajemen Warga</title>
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
                <!-- Dashboard -->
                <li>
                    <a href="../index/admin.php"
                        class="flex items-center gap-3 py-3 px-4 rounded-xl text-white font-medium hover:bg-blue-700 transition duration-200">
                        <i data-feather="home" class="w-5 h-5"></i>
                        Dashboard
                    </a>
                </li>
                <!-- Manajemen Warga Link - Set as ACTIVE -->
                <li>
                    <a href="../admin/manajement_warga.php"
                        class="flex items-center gap-3 py-3 px-4 rounded-xl bg-blue-700 text-white font-semibold shadow-inner transition duration-200">
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
                    <i data-feather="users" class="w-6 h-6"></i>
                </span>
                Manajemen Warga
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

            <h2 class="text-3xl font-bold mb-6 text-gray-800">KELOLA DATA WARGA</h2>

            <!-- Search and Add Bar -->
            <div class="flex flex-col sm:flex-row justify-between items-center mb-6 gap-4">
                <div class="relative w-full sm:w-1/3">
                    <input type="text" placeholder=" Cari nama atau alamat warga..."
                        class="pl-10 pr-4 py-2 border border-gray-300 rounded-lg w-full focus:ring-2 focus:ring-blue-500 focus:outline-none shadow-sm transition" />
                    <i data-feather="search"
                        class="w-5 h-5 text-gray-400 absolute left-3 top-1/2 transform -translate-y-1/2"></i>
                </div>

                <a href="../admin/tambah_warga.php"
                    class="px-6 py-2 bg-blue-600 text-white font-semibold rounded-xl hover:bg-white-700 flex items-center gap-2 shadow-lg transition transform hover:scale-105">
                    <i data-feather="user-plus" class="w-5 h-5"></i>
                    Tambah Warga Baru
                </a>
            </div>

            <!-- Table Card -->
            <div class="bg-white shadow-2xl rounded-2xl overflow-hidden">
                <table class="w-full text-left border-collapse">
                    <thead class="bg-gradient-to-r from-blue-600 to-indigo-500 text-white shadow-inner">
                        <tr>
                            <th class="p-4 text-sm font-bold uppercase tracking-wider">ID</th>
                            <th class="p-4 text-sm font-bold uppercase tracking-wider">Nama</th>
                            <th class="p-4 text-sm font-bold uppercase tracking-wider">Alamat</th>
                            <th class="p-4 text-sm font-bold uppercase tracking-wider">No.Tel</th>
                            <th class="p-4 text-sm font-bold uppercase tracking-wider">Status</th>
                            <th class="p-4 text-sm font-bold uppercase tracking-wider text-center">Opsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // LOGIC PHP UNTUK MENAMPILKAN DATA WARGA
                        if (mysqli_num_rows($data_warga) > 0) {
                            while ($d = mysqli_fetch_assoc($data_warga)) {
                                $status_color = match ($d['status']) {
                                    'Aktif' => 'bg-green-100 text-green-800',
                                    'Non-Aktif' => 'bg-red-100 text-red-800',
                                    default => 'bg-gray-100 text-gray-800',
                                };
                                ?>
                                <tr class="border-b last:border-b-0 hover:bg-green-50 transition duration-150 ease-in-out">
                                    <td class="p-4 text-gray-600 font-mono"><?= $d['id'] ?></td>
                                    <td class="p-4 font-bold text-gray-800"><?= $d['nama'] ?></td>
                                    <td class="p-4 text-gray-700 font-medium"><?= $d['alamat'] ?></td>
                                    <td class="p-4 text-blue-400 text-sm"><?= $d['no_telepon'] ?></td>
                                    <td class="p-4">
                                        <span
                                            class="inline-block px-3 py-1 text-xs font-semibold rounded-full <?= $status_color ?>">
                                            <?= $d['status'] ?>
                                        </span>
                                    </td>
                                    <td class="p-4 flex gap-3 justify-center items-center">
                                        <a href="edit_warga.php?id=<?= $d['id'] ?>"
                                            class="p-2 bg-yellow-500 text-white rounded-lg hover:bg-yellow-600 transition shadow-md text-sm transform hover:scale-105"
                                            title="Edit Data">
                                            <i data-feather="edit" class="w-4 h-4"></i>
                                        </a>
                                        <a href="../aksi/aksi_hapus_warga.php?id=<?= $d['id']; ?>"
                                            onclick="return confirm('Yakin ingin menghapus data warga <?= $d['nama']; ?>?')"
                                            class="p-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition shadow-md text-sm transform hover:scale-105"
                                            title="Hapus Data">
                                            <i data-feather="trash-2" class="w-4 h-4"></i>
                                        </a>
                                    </td>
                                </tr>
                            <?php }
                        } else { ?>
                            <tr>
                                <td colspan="6" class="p-8 text-center text-gray-500 italic">Belum ada data warga yang
                                    terdaftar.</td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Script untuk memuat Feather Icons dari CDN yang diminta dan menjalankannya -->
    <script src="https://unpkg.com/feather-icons"></script>
    <script>
        feather.replace();
    </script>

</body>

</html>