<?php
// Catatan: Asumsi file koneksi.php dan logika otentikasi admin sudah ada
// include '../koneksi/koneksi.php'; 
// include '../autentikasi/cek_admin.php';

// --- SIMULASI DATA APLIKASI (untuk tampilan) ---
$nama_admin = "Pak RT Fajar";
$inisial = "F";

// --- LOGIKA FETCH DATA DARI DATABASE (SIMULASI) ---
$id_jadwal = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$data_jadwal = null;
$notif_message = "";
$notif_class = "";

// SIMULASI data dari database untuk ID tertentu
if ($id_jadwal === 1) {
    $data_jadwal = [
        'id' => 1,
        'tanggal' => '2025-12-31',
        'acara' => 'Malam Tahun Baru Komunitas',
        'keterangan' => 'Acara makan-makan, hiburan musik, dan kembang api.',
        'lokasi' => 'Lapangan Utama RW 05',
    ];
} elseif ($id_jadwal === 0) {
    // Jika tidak ada ID, anggap ini halaman error atau pengalihan
    $notif_message = "Error: ID Jadwal tidak ditemukan.";
    $notif_class = "bg-red-100 border-red-500 text-red-700";
} 
// --- AKHIR SIMULASI FETCH DATA ---


// --- LOGIKA UPDATE DATA (SIMULASI POST) ---
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ambil data dari formulir
    $new_tanggal = $_POST['tanggal'];
    $new_acara = $_POST['acara'];
    $new_keterangan = $_POST['keterangan'];
    $new_lokasi = $_POST['lokasi'];

    // Lakukan validasi dan proses update ke database nyata di sini

    // SIMULASI UPDATE BERHASIL
    $notif_message = "Jadwal untuk '{$new_acara}' berhasil diperbarui!";
    $notif_class = "bg-green-100 border-green-500 text-green-700";
    
    // Perbarui data yang ditampilkan di formulir setelah sukses
    $data_jadwal = [
        'id' => $id_jadwal,
        'tanggal' => $new_tanggal,
        'acara' => $new_acara,
        'keterangan' => $new_keterangan,
        'lokasi' => $new_lokasi,
    ];
}
// --- AKHIR LOGIKA UPDATE DATA ---
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Jadwal Kegiatan - Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body { font-family: 'Inter', sans-serif; }
        ::-webkit-scrollbar { width: 8px; }
        ::-webkit-scrollbar-thumb { background-color: #9ca3af; border-radius: 4px; }
        ::-webkit-scrollbar-track { background-color: #f3f4f6; }
    </style>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'primary-blue': '#1e40af', 
                        'light-blue': '#eff6ff',   
                        'blue-600': '#2563eb', 
                        'blue-700': '#1d4ed8',
                        'blue-400': '#60a5fa',
                    }
                }
            }
        }
    </script>
</head>

<body class="bg-gray-50 min-h-screen flex">
    
    <!-- Sidebar (Asumsi Panel Admin) -->
    <div class="w-64 min-h-screen bg-blue-600 p-6 shadow-2xl fixed flex flex-col justify-between">
        <div>
            <h1 class="text-3xl font-poppins text-white mb-10 tracking-wider">Admin Panel
            </h1>
            <ul class="space-y-3">
                <li><a href="dashboard_admin.php" class="flex items-center gap-3 py-3 px-4 rounded-xl text-white font-medium hover:bg-blue-700 transition duration-200"><i data-feather="home" class="w-5 h-5"></i> Dashboard</a></li>
                <!-- Jadwal Link - Ditandai sebagai aktif karena sedang mengedit jadwal -->
                <li><a href="list_jadwal_admin.php" class="flex items-center gap-3 py-3 px-4 rounded-xl bg-blue-700 text-white font-semibold shadow-inner transition duration-200"><i data-feather="calendar" class="w-5 h-5"></i> Kelola Jadwal</a></li>
                <li><a href="list_pengumuman_admin.php" class="flex items-center gap-3 py-3 px-4 rounded-xl text-white font-medium hover:bg-blue-700 transition duration-200"><i data-feather="bell" class="w-5 h-5"></i> Kelola Pengumuman</a></li>
                <li><a href="list_warga_admin.php" class="flex items-center gap-3 py-3 px-4 rounded-xl text-white font-medium hover:bg-blue-700 transition duration-200"><i data-feather="users" class="w-5 h-5"></i> Kelola Warga</a></li>
            </ul>
        </div>
        <a href="../aksi/logout.php" class="flex items-center gap-3 py-3 px-4 rounded-xl bg-blue-400 text-white font-semibold hover:bg-red-500 transition duration-200 justify-center shadow-lg">
            <i data-feather="log-out" class="w-5 h-5"></i> Logout
        </a>
    </div>

    <!-- Content Area -->
    <div class="ml-64 w-full flex flex-col p-8">
        
        <!-- Top Header Bar -->
        <header class="bg-white shadow-md p-4 flex justify-between items-center sticky top-0 z-10 w-full mb-8 rounded-xl">
            <div class="flex items-center gap-2 text-xl font-semibold text-gray-700">
                <span class="text-blue-600"><i data-feather="edit" class="w-6 h-6"></i></span>
                Edit Jadwal Kegiatan
            </div>
            
            <!-- Admin Profile Display -->
            <div class="flex items-center gap-3 group p-1 rounded-full cursor-pointer">
                <span class="text-sm font-medium text-gray-700"><?= $nama_admin ?></span>
                <div class="w-10 h-10 bg-indigo-500 text-white rounded-full flex items-center justify-center font-bold text-lg shadow-md">
                    <?= $inisial ?>
                </div>
            </div>
        </header>

        <!-- Kontainer Utama Edit Formulir -->
        <div class="w-full max-w-xl mx-auto bg-white rounded-xl shadow-2xl p-8 border border-gray-100">
            
            <h2 class="text-2xl font-bold text-gray-800 mb-6 border-b pb-4">Formulir Edit Jadwal #<?= $id_jadwal ?></h2>

            <!-- Pesan Notifikasi (Sukses/Error) -->
            <?php if (!empty($notif_message)): ?>
                <div class="p-4 mb-6 border-l-4 rounded-md font-medium <?= $notif_class ?>">
                    <?= $notif_message ?>
                </div>
            <?php endif; ?>

            <?php if ($data_jadwal): ?>
                <form method="POST" class="space-y-6">
                    <!-- ID Tersembunyi -->
                    <input type="hidden" name="id" value="<?= htmlspecialchars($id_jadwal) ?>">
                    
                    <!-- Input Tanggal -->
                    <div>
                        <label for="tanggal" class="block text-sm font-medium text-gray-700 mb-1">Tanggal & Waktu</label>
                        <input type="date" id="tanggal" name="tanggal" value="<?= htmlspecialchars($data_jadwal['tanggal']) ?>" required
                            class="w-full border border-gray-300 p-3 rounded-lg focus:ring-blue-500 focus:border-blue-500 transition duration-200 shadow-sm">
                    </div>

                    <!-- Input Acara -->
                    <div>
                        <label for="acara" class="block text-sm font-medium text-gray-700 mb-1">Nama Acara / Kegiatan</label>
                        <input type="text" id="acara" name="acara" value="<?= htmlspecialchars($data_jadwal['acara']) ?>" required
                            class="w-full border border-gray-300 p-3 rounded-lg focus:ring-blue-500 focus:border-blue-500 transition duration-200 shadow-sm">
                    </div>

                    <!-- Input Lokasi -->
                    <div>
                        <label for="lokasi" class="block text-sm font-medium text-gray-700 mb-1">Lokasi</label>
                        <input type="text" id="lokasi" name="lokasi" value="<?= htmlspecialchars($data_jadwal['lokasi']) ?>" required
                            class="w-full border border-gray-300 p-3 rounded-lg focus:ring-blue-500 focus:border-blue-500 transition duration-200 shadow-sm">
                    </div>

                    <!-- Input Keterangan -->
                    <div>
                        <label for="keterangan" class="block text-sm font-medium text-gray-700 mb-1">Keterangan Detail (Opsional)</label>
                        <textarea id="keterangan" name="keterangan" rows="4"
                            class="w-full border border-gray-300 p-3 rounded-lg focus:ring-blue-500 focus:border-blue-500 transition duration-200 shadow-sm"><?= htmlspecialchars($data_jadwal['keterangan']) ?></textarea>
                    </div>

                    <!-- Tombol Simpan -->
                    <div class="pt-4 flex justify-between gap-4">
                        <a href="list_jadwal_admin.php" 
                           class="w-1/3 bg-gray-400 text-white px-6 py-3 rounded-xl font-semibold hover:bg-gray-500 transition duration-200 shadow-md flex items-center justify-center gap-2">
                            Batal
                        </a>
                        <button type="submit"
                            class="w-2/3 bg-green-600 text-white px-6 py-3 rounded-xl font-semibold hover:bg-green-700 transition duration-200 shadow-lg flex items-center justify-center gap-2">
                            <i data-feather="save" class="w-5 h-5"></i>
                            Simpan Perubahan
                        </button>
                    </div>
                </form>
            <?php elseif ($id_jadwal > 0): ?>
                <p class="text-center text-red-500 font-medium py-10">Data jadwal dengan ID #<?= $id_jadwal ?> tidak ditemukan di database.</p>
            <?php endif; ?>

        </div>
        
    </div>
    
    <!-- Script untuk memuat Feather Icons -->
    <script src="https://unpkg.com/feather-icons"></script>
    <script>
        feather.replace();
    </script>
</body>
</html>