<?php
// Pastikan file koneksi ke database telah di-include
// Sesuaikan path jika lokasi file koneksi berbeda
// Contoh: include '../koneksi/koneksi.php';

// Logika PHP untuk Top Header Bar (Dummy data)
$nama_admin = "Admin RT";
$inisial = "A"; 
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Tambah Pengumuman Baru</title>
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
            background-color: #9ca3af; /* gray-400 */
            border-radius: 4px;
        }
        ::-webkit-scrollbar-track {
            background-color: #f3f4f6; /* gray-100 */
        }
    </style>
</head>

<body class="bg-gray-50 flex min-h-screen">

    <!-- Sidebar -->
    <div class="w-64 min-h-screen bg-blue-600 p-6 shadow-2xl fixed flex flex-col justify-between">
        <!-- Logo and Main Navigation -->
        <div>
            <h1 class="text-3xl font-poppins text-white mb-10 tracking-wider">WargaKita
            </h1>
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

        <!-- Logout Link -->
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
                    <i data-feather="message-circle" class="w-6 h-6"></i>
                </span>
                Buat Pengumuman Baru
            </div>
            
            <!-- Admin Profile Clickable Link -->
            <a href="profil.php" class="flex items-center gap-3 group hover:bg-gray-100 p-1 rounded-full transition duration-200 cursor-pointer">
                <span class="text-sm font-medium text-gray-700 group-hover:text-gray-900 transition duration-200">
                    Admin
                </span>
                <div
                    class="w-10 h-10 bg-blue-500 text-white rounded-full flex items-center justify-center font-bold text-lg shadow-md">
                    <?= $inisial ?>
                </div>
            </a>
            <!-- End Admin Profile Clickable Link -->

        </header>

        <!-- Main Content (Form Tambah Pengumuman) -->
        <div class="p-8 flex-grow">

            <?php 
            // Tampilkan notifikasi jika ada pesan dari aksi_tambah_pengumuman.php
            if(isset($_GET['pesan'])){
                $pesan = $_GET['pesan'];
                if($pesan == "gagal"){
                    $error_detail = isset($_GET['error']) ? htmlspecialchars($_GET['error']) : "Terjadi kesalahan saat menyimpan data.";
                    echo '<div class="mb-4 p-4 bg-red-100 text-red-700 rounded-lg shadow-md border-l-4 border-red-500 font-medium" role="alert">
                            <strong>Gagal!</strong> ' . $error_detail . '
                          </div>';
                } elseif($pesan == "sukses_tambah"){
                     echo '<div class="mb-4 p-4 bg-green-100 text-green-700 rounded-lg shadow-md border-l-4 border-green-500 font-medium" role="alert">
                            <strong>Berhasil!</strong> Pengumuman telah diterbitkan.
                          </div>';
                }
            }
            ?>

            <div class="bg-white p-8 rounded-2xl shadow-xl border-t-4 border-blue-600 max-w-5xl mx-auto">
                <h2 class="text-2xl font-bold mb-6 text-gray-800 border-b pb-3">Formulir Pengumuman</h2>
                
                <!-- Form action menunjuk ke file aksi_tambah_pengumuman.php -->
                <form action="../aksi/aksi_tambah.php" method="POST" class="space-y-6">
                    
                    <!-- Judul (Kolom: judul) -->
                    <div>
                        <label for="id" class="block text-base font-semibold text-gray-700 mb-2">id<span class="text-red-500">*</span></label>
                        <input type="number" id="id" name="id" required
                            class="w-full px-5 py-3 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 shadow-sm placeholder-gray-400"
                            placeholder="Contoh: Pemberitahuan Iuran Kebersihan Bulan Ini">
                    </div>
                    <div>
                        <label for="judul" class="block text-base font-semibold text-gray-700 mb-2">Judul Pengumuman <span class="text-red-500">*</span></label>
                        <input type="text" id="judul" name="judul" required
                            class="w-full px-5 py-3 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 shadow-sm placeholder-gray-400"
                            placeholder="Contoh: Pemberitahuan Iuran Kebersihan Bulan Ini">
                    </div>

                    <!-- Keterangan/Isi (Kolom: keterangan) -->
                    <div>
                        <label for="keterangan" class="block text-base font-semibold text-gray-700 mb-2">Isi/Keterangan Lengkap <span class="text-red-500">*</span></label>
                        <textarea id="keterangan" name="keterangan" rows="6" required
                            class="w-full px-5 py-3 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 shadow-sm placeholder-gray-400"
                            placeholder="Tuliskan isi pengumuman secara detail di sini."></textarea>
                    </div>

                    <!-- Tanggal Publikasi (Kolom: tanggal_publikasi) -->
                    <div>
                        <label for="tanggal_publikasi" class="block text-base font-semibold text-gray-700 mb-2">Tanggal Publikasi <span class="text-red-500">*</span></label>
                        <input type="date" id="tanggal_publikasi" name="tanggal_publikasi" value="<?= date('Y-m-d') ?>" required
                            class="w-full px-5 py-3 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 shadow-sm bg-white">
                    </div>

                    <!-- Tombol Aksi -->
                    <div class="flex justify-end pt-4 border-t mt-6">
                        <button type="submit"
                            class="flex items-center gap-2 px-8 py-3 bg-blue-600 text-white font-bold text-lg rounded-xl hover:bg-indigo-300 transition duration-200 shadow-lg transform hover:scale-[1.02]">
                            <i data-feather="send" class="w-5 h-5"></i>
                            Terbitkan Pengumuman
                        </button>
                    </div>

                </form>
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