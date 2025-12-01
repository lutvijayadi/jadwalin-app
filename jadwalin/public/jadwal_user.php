<?php
// Catatan: Pastikan file koneksi.php berada di lokasi yang benar
include '../koneksi/koneksi.php'; // Mengaktifkan koneksi database nyata

// ambil keyword pencarian (jika ada)
$keyword = isset($_GET['cari']) ? $_GET['cari'] : "";

// Pastikan koneksi ke database valid sebelum menjalankan query
if (!$koneksi) {
    // Jika koneksi gagal (dalam kasus nyata)
    $result = false;
    $error_message = "Koneksi database gagal: " . mysqli_connect_error();
} else {
    // Amankan keyword dari potensi SQL Injection
    $safe_keyword = mysqli_real_escape_string($koneksi, $keyword);
    
    // Query untuk mencari data jadwal
    // PENTING: Selalu direkomendasikan menggunakan Prepared Statement untuk keamanan maksimum.
    $query = "SELECT * FROM jadwal 
              WHERE tanggal LIKE '%$safe_keyword%' 
              OR acara LIKE '%$safe_keyword%' 
              OR keterangan LIKE '%$safe_keyword%' 
              OR lokasi LIKE '%$safe_keyword%' 
              ORDER BY tanggal ASC"; // Mengurutkan berdasarkan tanggal

    $result = mysqli_query($koneksi, $query);

    if (!$result) {
        $error_message = "Error saat menjalankan query: " . mysqli_error($koneksi);
    } else {
        $error_message = "";
    }
}

// Data pengguna dummy untuk Sidebar (tidak terkait database, dipertahankan)
$nama_warga = "Budi Santoso";
$inisial = "B";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jadwal Kegiatan Warga</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
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

<body class="bg-gray-50 min-h-screen flex">
    
    <!-- Sidebar -->
    <div class="w-64 min-h-screen bg-blue-600 p-6 shadow-2xl fixed flex flex-col justify-between">
        <!-- Logo and Main Navigation -->
        <div>
            <h1 class="text-3xl font-poppins text-white mb-10 tracking-wider">WargaKita
            </h1>
            <ul class="space-y-3">
                <!-- Dashboard Link -->
                <li>
                    <a href="../public/dashboard_user.php"
                        class="flex items-center gap-3 py-3 px-4 rounded-xl text-white font-medium hover:bg-blue-700 transition duration-200">
                        <i data-feather="home" class="w-5 h-5"></i>
                        Dashboard
                    </a>
                </li>
                <!-- Jadwal Kegiatan Link - Set as ACTIVE -->
                <li>
                    <a href="../public/jadwal_user.php"
                        class="flex items-center gap-3 py-3 px-4 rounded-xl bg-blue-700 text-white font-semibold shadow-inner transition duration-200">
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
                    <a href="../pengaturan/pengaturan_user.php"
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
    <div class="ml-64 w-full flex flex-col p-8">
        
        <!-- Top Header Bar -->
        <header class="bg-white shadow-md p-4 flex justify-between items-center sticky top-0 z-10 w-full mb-8 rounded-xl">
            <div class="flex items-center gap-2 text-xl font-semibold text-gray-700">
                <span class="text-blue-600">
                    <i data-feather="calendar" class="w-6 h-6"></i>
                </span>
                Jadwal Kegiatan Warga
            </div>
            
            <!-- User Profile Clickable Link (Dummy) -->
            <a href="../profil/profil_user.php" class="flex items-center gap-3 group hover:bg-gray-100 p-1 rounded-full transition duration-200 cursor-pointer">
                <span class="text-sm font-medium text-gray-700 group-hover:text-gray-900 transition duration-200">
                    <?= $nama_warga ?>
                </span>
                <div
                    class="w-10 h-10 bg-green-500 text-white rounded-full flex items-center justify-center font-bold text-lg shadow-md">
                    <?= $inisial ?>
                </div>
            </a>
            <!-- End User Profile Clickable Link -->
        </header>

        <!-- Form Pencarian -->
        <form method="get" class="flex mb-8 max-w-4xl mx-auto w-full">
            <input type="text" name="cari" value="<?= htmlspecialchars($keyword) ?>" placeholder="Cari tanggal / acara / lokasi..."
                class="flex-grow border border-gray-300 p-3 rounded-l-xl focus:ring-blue-500 focus:border-blue-500 transition duration-200 shadow-inner">
            <button type="submit" class="bg-blue-600 text-white px-6 py-3 rounded-r-xl font-semibold hover:bg-blue-700 transition duration-200 shadow-md flex items-center gap-2">
                <i data-feather="search" class="w-5 h-5"></i> Cari
            </button>
        </form>

        <!-- Tabel Jadwal -->
        <div class="overflow-x-auto bg-white rounded-2xl shadow-xl p-6 border border-gray-100">
            <?php if (!empty($error_message)): ?>
                <div class="p-4 bg-red-100 text-red-700 rounded-lg font-medium mb-4"><?= $error_message ?></div>
            <?php endif; ?>

            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-blue-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider rounded-tl-xl">id</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Tanggal</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Acara</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Keterangan</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider rounded-tr-xl">Lokasi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    <?php 
                    // Cek jika query berhasil dan ada baris data
                    if ($result && mysqli_num_rows($result) > 0): 
                        while ($row = mysqli_fetch_assoc($result)): ?>
                            <tr class="hover:bg-blue-50/50 transition duration-150">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 text-center"><?= htmlspecialchars($row['id']); ?></td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600"><?= date("d F Y", strtotime($row['tanggal'])); ?></td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-blue-600"><?= htmlspecialchars($row['acara']); ?></td>
                                <td class="px-6 py-4 text-sm text-gray-600 max-w-xs"><?= htmlspecialchars($row['keterangan']); ?></td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600"><?= htmlspecialchars($row['lokasi']); ?></td>
                            </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5" class="text-center py-6 text-base text-gray-500 italic">
                                <?php if (!empty($error_message)): ?>
                                    Error: <?= $error_message ?>
                                <?php else: ?>
                                    Tidak ada jadwal kegiatan yang ditemukan.
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
        
    </div>
    
    <!-- Script untuk memuat Feather Icons -->
    <script src="https://unpkg.com/feather-icons"></script>
    <script>
        feather.replace();
    </script>
</body>

</html>