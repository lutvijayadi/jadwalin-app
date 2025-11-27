<?php
// Pastikan file koneksi tetap disertakan di setiap halaman
include '../koneksi/koneksi.php';

// Logika untuk mengambil data atau menyimpan pengaturan akan ditempatkan di sini
// Misalnya, mengambil data profil admin yang sedang login
// $query_admin = mysqli_query($koneksi, "SELECT * FROM admin WHERE id_admin='...'");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Pengaturan Sistem</title>
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
                <!-- Pengaturan Link - Set as ACTIVE -->
                <li>
                    <a href="../pengaturan/pengaturan.php"
                        class="flex items-center gap-3 py-3 px-4 rounded-xl bg-blue-700 text-white font-semibold shadow-inner transition duration-200">
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
                <span class="text-green-600">
                    <i data-feather="settings" class="w-6 h-6"></i>
                </span>
                Pengaturan Sistem
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

            <h2 class="text-3xl font-bold mb-8 text-gray-800">KONFIGURASI AKUN & APLIKASI</h2>

            <div class="max-w-4xl space-y-8">

                <!-- Section 1: Pengaturan Profil Admin -->
                <div class="bg-white p-6 rounded-2xl shadow-xl border-t-4 border-green-500">
                    <h3 class="text-2xl font-bold text-gray-800 mb-4 pb-2 border-b">Profil Akun Anda</h3>

                    <form action="#" method="POST" class="space-y-4">
                        <div>
                            <label for="nama_admin" class="block text-sm font-medium text-gray-700 mb-1">Nama
                                Lengkap</label>
                            <input type="text" id="nama_admin" name="nama_admin" value="Nama Admin Default"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-green-500 focus:border-green-500 shadow-sm"
                                required>
                        </div>
                        <div>
                            <label for="email_admin" class="block text-sm font-medium text-gray-700 mb-1">Email
                                (Username)</label>
                            <input type="email" id="email_admin" name="email_admin" value="admin@rt.id"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg bg-gray-100 cursor-not-allowed"
                                disabled>
                            <p class="text-xs text-gray-500 mt-1">Email tidak dapat diubah.</p>
                        </div>
                        <button type="submit"
                            class="mt-4 px-6 py-2 bg-green-600 text-white font-semibold rounded-xl hover:bg-green-700 transition duration-200 shadow-md">
                            Simpan Perubahan Profil
                        </button>
                    </form>
                </div>

                <!-- Section 2: Pengaturan Keamanan -->
                <div class="bg-white p-6 rounded-2xl shadow-xl border-t-4 border-blue-500">
                    <h3 class="text-2xl font-bold text-gray-800 mb-4 pb-2 border-b">Keamanan & Kata Sandi</h3>

                    <form action="#" method="POST" class="space-y-4">
                        <div>
                            <label for="password_lama" class="block text-sm font-medium text-gray-700 mb-1">Kata Sandi
                                Lama</label>
                            <input type="password" id="password_lama" name="password_lama"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 shadow-sm"
                                required>
                        </div>
                        <div>
                            <label for="password_baru" class="block text-sm font-medium text-gray-700 mb-1">Kata Sandi
                                Baru</label>
                            <input type="password" id="password_baru" name="password_baru"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 shadow-sm"
                                required>
                        </div>
                        <div>
                            <label for="konfirmasi_baru" class="block text-sm font-medium text-gray-700 mb-1">Konfirmasi
                                Kata Sandi Baru</label>
                            <input type="password" id="konfirmasi_baru" name="konfirmasi_baru"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 shadow-sm"
                                required>
                        </div>
                        <button type="submit"
                            class="mt-4 px-6 py-2 bg-blue-600 text-white font-semibold rounded-xl hover:bg-blue-700 transition duration-200 shadow-md">
                            Ubah Kata Sandi
                        </button>
                    </form>
                </div>

                <!-- Section 3: Pengaturan Aplikasi -->
                <div class="bg-white p-6 rounded-2xl shadow-xl border-t-4 border-yellow-500">
                    <h3 class="text-2xl font-bold text-gray-800 mb-4 pb-2 border-b">Preferensi Aplikasi</h3>

                    <div class="space-y-4">
                        <div class="flex items-center justify-between p-3 border rounded-lg">
                            <label for="notifikasi" class="text-base font-medium text-gray-700">Aktifkan Notifikasi
                                Pengumuman</label>
                            <input type="checkbox" id="notifikasi" name="notifikasi" checked
                                class="w-5 h-5 text-green-600 border-gray-300 rounded focus:ring-green-500">
                        </div>
                        <div class="flex items-center justify-between p-3 border rounded-lg">
                            <label for="mode_gelap" class="text-base font-medium text-gray-700">Mode Tampilan
                                Gelap</label>
                            <input type="checkbox" id="mode_gelap" name="mode_gelap"
                                class="w-5 h-5 text-green-600 border-gray-300 rounded focus:ring-green-500">
                        </div>
                        <button
                            class="mt-4 px-6 py-2 bg-yellow-600 text-white font-semibold rounded-xl hover:bg-yellow-700 transition duration-200 shadow-md">
                            Simpan Preferensi
                        </button>
                    </div>
                </div>

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