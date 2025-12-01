<?php
// Pastikan file koneksi ke database telah di-include
include '../koneksi/koneksi.php';

// --- Logika Fetching Data Database Nyata ---
$nama = "Warga Kita";
$alamat = "Alamat tidak tersedia";
$pengumuman_data = [];
$kegiatan_data = [];

// Pastikan variabel $koneksi telah didefinisikan dari file koneksi.php dan sukses terhubung
if ($koneksi) {
    // Ganti dengan ID pengguna yang sedang login
    $user_id_dummy = 1;

    // 1. Ambil Data Pengguna yang Sedang Login
    // Note: Ganti $user_id_dummy dengan variabel sesi user ID yang sebenarnya
    $user_query = "SELECT nama, alamat FROM warga WHERE id = '$user_id_dummy'";
    $user_result = mysqli_query($koneksi, $user_query);
    if ($user_result && $user_data = mysqli_fetch_assoc($user_result)) {
        $nama_warga = htmlspecialchars($user_data['nama']);
        $alamat = htmlspecialchars($user_data['alamat']);
    } else {
        $nama_warga = "Pengguna Tidak Dikenal";
        $alamat = "RT/RW belum terdaftar";
    }

    // 2. Fetch Pengumuman Terbaru (Max 3)
    $pengumuman_query = "SELECT judul, tanggal_publikasi, LEFT(keterangan, 150) AS ringkasan
                         FROM pengumuman
                         ORDER BY tanggal_publikasi DESC
                         LIMIT 3";
    $pengumuman_result = mysqli_query($koneksi, $pengumuman_query);
    if ($pengumuman_result) {
        while ($row = mysqli_fetch_assoc($pengumuman_result)) {
            $pengumuman_data[] = $row;
        }
    }

    // 3. Fetch Jadwal Kegiatan Mendatang (Max 3, Tanggal Hari Ini atau Setelahnya)
    $kegiatan_query = "SELECT acara, tanggal, lokasi
                       FROM jadwal
                       WHERE tanggal >= CURDATE()
                       ORDER BY tanggal ASC
                       LIMIT 3";
    $kegiatan_result = mysqli_query($koneksi, $kegiatan_query);
    if ($kegiatan_result) {
        while ($row = mysqli_fetch_assoc($kegiatan_result)) {
            $kegiatan_data[] = $row;
        }
    }

} else {
    // Fallback jika koneksi database gagal
    $alamat = "Koneksi database gagal. Menampilkan data dummy.";

    // Data Dummy (untuk memastikan tampilan tidak kosong)
    $pengumuman_data = [
        ['judul' => 'Contoh: Rapat Rutin Bulanan', 'tanggal_publikasi' => '2025-11-20', 'ringkasan' => 'Silakan baca pengumuman lengkap di halaman pengumuman.'],
        ['judul' => 'Contoh: Iuran Keamanan Wajib', 'tanggal_publikasi' => '2025-11-15', 'ringkasan' => 'Batas akhir pembayaran iuran bulanan adalah tanggal 30.'],
    ];
    $kegiatan_data = [
        ['acara' => 'Contoh: Kerja Bakti', 'tanggal' => '2025-12-05', 'waktu' => '07:00:00', 'lokasi' => 'Balai Warga'],
    ];
}

$inisial = strtoupper(substr($nama_warga, 0, 1));

// --- AKHIR LOGIKA DATA ---
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Warga - WargaKita</title>
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

<body class="bg-gray-50 flex min-h-screen">

    <!-- Sidebar -->
    <div class="w-64 min-h-screen bg-blue-600 p-6 shadow-2xl fixed flex flex-col justify-between">
        <!-- Logo and Main Navigation -->
        <div>
            <h1 class="text-3xl font-poppins text-white mb-10 tracking-wider">WargaKita
            </h1>
            <ul class="space-y-3">
                <!-- Dashboard Link - Set as ACTIVE -->
                <li>
                    <a href="../public/dashboard_user.php"
                        class="flex items-center gap-3 py-3 px-4 rounded-xl bg-blue-700 text-white font-semibold shadow-inner transition duration-200">
                        <i data-feather="home" class="w-5 h-5"></i>
                        Dashboard
                    </a>
                </li>
                <!-- Jadwal Kegiatan Link -->
                <li>
                    <a href="../public/jadwal_user.php"
                        class="flex items-center gap-3 py-3 px-4 rounded-xl text-white font-medium hover:bg-blue-700 transition duration-200">
                        <i data-feather="calendar" class="w-5 h-5"></i>
                        Jadwal Kegiatan
                    </a>
                </li>
                <!-- Pengumuman Link -->
                <li>
                    <a href="../public/pengumuman_user.php"
                        class="flex items-center gap-3 py-3 px-4 rounded-xl text-white font-medium hover:bg-blue-700 transition duration-200">
                        <i data-feather="bell" class="w-5 h-5"></i>
                        Pengumuman
                    </a>
                </li>
                <!-- Pengaturan Link -->
                <li>
                    <a href="../public/pengaturan_user.php"
                        class="flex items-center gap-3 py-3 px-4 rounded-xl text-white font-medium hover:bg-blue-700 transition duration-200">
                        <i data-feather="settings" class="w-5 h-5"></i>
                        Pengaturan
                    </a>
                </li>
                 <li>
                    <a href="../profil/profil_user.php"
                        class="flex items-center gap-3 py-3 px-4 rounded-xl bg-blue-700 text-white font-semibold shadow-inner transition duration-200">
                        <i data-feather="user" class="w-5 h-5"></i>
                        Profil Saya
                    </a>
                </li>
            </ul>
        </div>

        <!-- Logout Link -->
        <a href="../aksi/logout.php"
            class="flex items-center gap-3 py-3 px-4 rounded-xl bg-blue-400 text-white font-semibold hover:bg-red-500 transition duration-200 justify-center shadow-lg">
            <i data-feather="log-out" class="w-5 h-5"></i>
            Logout
        </a>
    </div>

    <!-- Content Area -->
    <div class="ml-64 w-full flex flex-col">

        <!-- Top Header Bar -->
        <header
            class="bg-white shadow-md p-4 flex justify-between items-center sticky top-0 z-10 w-full rounded-xl mb-8">
            <div class="flex items-center gap-2 text-xl font-semibold text-gray-700">
                <span class="text-blue-600">
                    <i data-feather="grid" class="w-6 h-6"></i>
                </span>
                Dashboard Warga
            </div>

            <!-- User Profile Clickable Link -->
            <a href="../profil/profil_user.php"
                class="flex items-center gap-3 group hover:bg-gray-100 p-1 rounded-full transition duration-200 cursor-pointer">
                <span class="text-sm font-medium text-gray-700 group-hover:text-gray-900 transition duration-200">
                    <?= $nama_warga ?>
                </span>
                <div
                    class="w-10 h-10 bg-green-500 text-white rounded-full flex items-center justify-center font-bold text-lg shadow-md">
                    <?= $inisial ?>
                </div>
            </a>
        </header>

        <!-- Main Content -->
        <div class="p-8 pt-0 flex-grow space-y-8">

            <!-- Welcome Card -->
            <div class="bg-white p-8 rounded-2xl shadow-xl border-l-4 border-green-500">
                <h2 class="text-3xl font-bold text-gray-800 mb-2">Halo, <?= $nama_warga ?>!</h2>
                <p class="text-gray-600">Selamat datang kembali di portal WargaKita. Mari kita jaga kebersamaan
                    lingkungan RT 05.</p>
                <div class="mt-4 pt-4 border-t border-gray-100 flex items-center gap-2 text-sm text-gray-500">
                    <i data-feather="map-pin" class="w-4 h-4 text-green-500"></i>
                    Lokasi Anda: <?= $alamat ?>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">

                <!-- Section: Berita & Pengumuman Terbaru (Card) -->
                <div class="bg-white p-6 rounded-2xl shadow-xl border-t-4 border-yellow-500">
                    <div class="flex justify-between items-center mb-4 border-b pb-3">
                        <h3 class="text-xl font-bold text-gray-700 flex items-center gap-2">
                            <i data-feather="rss" class="w-5 h-5 text-yellow-600"></i>
                            Berita & Pengumuman Terbaru
                        </h3>
                        <a href="../public/pengumuman_user.php"
                            class="text-sm text-blue-600 hover:text-blue-800 font-medium transition duration-200">Lihat
                            Semua &rarr;</a>
                    </div>

                    <div class="space-y-4 max-h-96 overflow-y-auto">
                        <?php if (count($pengumuman_data) > 0): ?>
                            <?php foreach ($pengumuman_data as $p): ?>
                                <div
                                    class="p-4 bg-yellow-50 rounded-lg border border-yellow-200 shadow-sm hover:shadow-md transition duration-200">
                                    <h4 class="text-lg font-semibold text-yellow-800 mb-1"><?= htmlspecialchars($p['judul']) ?>
                                    </h4>
                                    <p class="text-xs text-gray-500 mb-2 flex items-center gap-1">
                                        <i data-feather="clock" class="w-3 h-3"></i>
                                        Diterbitkan: <?= date("d F Y", strtotime($p['tanggal_publikasi'])) ?>
                                    </p>
                                    <p class="text-gray-700 text-sm line-clamp-2"><?= htmlspecialchars($p['ringkasan']) ?>...
                                    </p>
                                </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <p class="text-gray-500 italic text-center py-4">Belum ada pengumuman terbaru saat ini.</p>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- Section: Jadwal Kegiatan Mendatang (Card) -->
                <div class="bg-white p-6 rounded-2xl shadow-xl border-t-4 border-blue-500">
                    <div class="flex justify-between items-center mb-4 border-b pb-3">
                        <h3 class="text-xl font-bold text-gray-700 flex items-center gap-2">
                            <i data-feather="calendar" class="w-5 h-5 text-blue-600"></i>
                            Jadwal Kegiatan Mendatang
                        </h3>
                        <a href="../public/jadwal_user.php"
                            class="text-sm text-blue-600 hover:text-blue-800 font-medium transition duration-200">Lihat
                            Semua &rarr;</a>
                    </div>

                    <div class="space-y-4 max-h-96 overflow-y-auto">
                        <?php if (count($kegiatan_data) > 0): ?>
                            <?php foreach ($kegiatan_data as $k): ?>
                                <div
                                    class="p-4 bg-blue-50 rounded-lg border border-blue-200 shadow-sm hover:shadow-md transition duration-200">
                                    <h4 class="text-lg font-semibold text-blue-800 mb-1"><?= htmlspecialchars($k['acara']) ?>
                                    </h4>
                                    <div class="grid grid-cols-1 gap-2 text-sm text-gray-600">
                                        <p class="flex items-center gap-1">
                                            <i data-feather="calendar" class="w-4 h-4 text-gray-500"></i>
                                            <?= date("d F Y", strtotime($k['tanggal'])) ?>
                                        </p>
                                        <p class="flex items-center gap-1">
                                            <i data-feather="map-pin" class="w-4 h-4 text-gray-500"></i>
                                            Lokasi: <?= htmlspecialchars($k['lokasi']) ?>
                                        </p>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <p class="text-gray-500 italic text-center py-4">Tidak ada jadwal kegiatan mendatang yang
                                tercatat.</p>
                        <?php endif; ?>
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