<?php
// PASTIKAN session_start() dilakukan di awal untuk notifikasi
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include '../koneksi/koneksi.php';

// Set admin profile variables (gunakan dummy data seperti pada file sebelumnya)
$nama_admin = "Admin RT";
$inisial = "A"; // Inisial dari "Admin RT"

// Variabel default
$id_warga = isset($_GET['id']) ? (int) $_GET['id'] : 0;
$data_warga = null;
$notif_message = "";
$notif_class = "";

// Ambil notifikasi dari session jika ada (setelah redirect sukses)
if (isset($_SESSION['notif_message'])) {
    $notif_message = $_SESSION['notif_message'];
    $notif_class = $_SESSION['notif_class'];
    unset($_SESSION['notif_message']);
    unset($_SESSION['notif_class']);
}


// --- LOGIKA UPDATE DATA ---
if ($_SERVER['REQUEST_METHOD'] === 'POST' && $id_warga > 0) {
    // Ambil data dari formulir dan bersihkan
    $new_nama = mysqli_real_escape_string($koneksi, $_POST['nama']);
    $new_alamat = mysqli_real_escape_string($koneksi, $_POST['alamat']);
    $new_no_telepon = mysqli_real_escape_string($koneksi, $_POST['no_telepon']);
    $new_status = mysqli_real_escape_string($koneksi, $_POST['status_warga']); // Pastikan nama input sesuai

    // Proses update ke database
    $update_query = "UPDATE warga SET 
                     nama='$new_nama', 
                     alamat='$new_alamat', 
                     no_telepon='$new_no_telepon', 
                     status='$new_status' 
                     WHERE id=$id_warga";
    
    if (mysqli_query($koneksi, $update_query)) {
        // UPDATE BERHASIL! Simpan pesan sukses di session dan REDIRECT.
        $_SESSION['notif_message'] = "Data warga '{$new_nama}' berhasil diperbarui!";
        $_SESSION['notif_class'] = "bg-green-100 border-green-500 text-green-700";
        
        // Redirect untuk memuat ulang halaman dengan data baru
        header("Location: edit_warga.php?id=" . $id_warga); 
        exit(); 
    } else {
        // Error saat update
        $notif_message = "Error: Gagal memperbarui data warga. " . mysqli_error($koneksi);
        $notif_class = "bg-red-100 border-red-500 text-red-700";
    }
}
// --- AKHIR LOGIKA UPDATE DATA ---


// --- LOGIKA FETCH DATA DARI DATABASE (untuk menampilkan formulir) ---
if ($id_warga > 0) {
    $query = "SELECT * FROM warga WHERE id = $id_warga"; 
    $result = mysqli_query($koneksi, $query);
    
    if ($result && mysqli_num_rows($result) > 0) {
        $data_warga = mysqli_fetch_assoc($result);
    } else {
        $notif_message = "Data warga dengan ID #{$id_warga} tidak ditemukan di database.";
        $notif_class = "bg-red-100 border-red-500 text-red-700";
    }
} else {
    $notif_message = "Error: ID Warga tidak valid.";
    $notif_class = "bg-red-100 border-red-500 text-red-700";
}
// --- AKHIR FETCH DATA ---
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Warga - Admin</title>
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
                        'blue-600': '#2563eb',
                        'blue-700': '#1d4ed8',
                        'red-600': '#dc2626',
                    }
                }
            }
        }
    </script>
</head>

<body class="bg-gray-50 min-h-screen flex">

    <div class="w-64 min-h-screen bg-blue-600 p-6 shadow-2xl fixed flex flex-col justify-between">
        <div>
            <h1 class="text-4xl font-poppins text-white mb-10 tracking-wider">WargaKita</h1>
            <ul class="space-y-3">
                <li><a href="../index/admin.php" class="flex items-center gap-3 py-3 px-4 rounded-xl text-white font-medium hover:bg-blue-700 transition duration-200"><i data-feather="home" class="w-5 h-5"></i> Dashboard</a></li>
                <li><a href="../admin/manajement_warga.php" class="flex items-center gap-3 py-3 px-4 rounded-xl bg-blue-700 text-white font-semibold shadow-inner transition duration-200"><i data-feather="users" class="w-5 h-5"></i> Manajemen Warga</a></li>
                <li><a href="../admin/jadwal_kegiatan.php" class="flex items-center gap-3 py-3 px-4 rounded-xl text-white font-medium hover:bg-blue-700 transition duration-200"><i data-feather="calendar" class="w-5 h-5"></i> Jadwal Kegiatan</a></li>
                <li><a href="../admin/pengumuman.php" class="flex items-center gap-3 py-3 px-4 rounded-xl text-white font-medium hover:bg-blue-700 transition duration-200"><i data-feather="bell" class="w-5 h-5"></i> Pengumuman</a></li>
                <li><a href="../admin/laporan&analitik.php" class="flex items-center gap-3 py-3 px-4 rounded-xl text-white font-medium hover:bg-blue-700 transition duration-200"><i data-feather="bar-chart-2" class="w-5 h-5"></i> Laporan & Analitik</a></li>
                <li><a href="../pengaturan/pengaturan.php" class="flex items-center gap-3 py-3 px-4 rounded-xl text-white font-medium hover:bg-blue-700 transition duration-200"><i data-feather="settings" class="w-5 h-5"></i> Pengaturan</a></li>
            </ul>
        </div>
        <a href="../aksi/logout.php" class="flex items-center gap-3 py-3 px-4 rounded-xl bg-indigo-400 text-white font-semibold hover:bg-red-500 transition duration-200 justify-center shadow-lg">
            <i data-feather="log-out" class="w-5 h-5"></i> Logout
        </a>
    </div>

    <div class="ml-64 w-full flex flex-col p-8">

        <header class="bg-white shadow-md p-4 flex justify-between items-center sticky top-0 z-10 w-full mb-8 rounded-xl">
            <div class="flex items-center gap-2 text-xl font-semibold text-gray-700">
                <span class="text-blue-600"><i data-feather="edit" class="w-6 h-6"></i></span>
                Edit Data Warga
            </div>
            
            <div class="flex items-center gap-3 group p-1 rounded-full cursor-pointer">
                <span class="text-sm font-medium text-gray-700"><?= $nama_admin ?></span>
                <div class="w-10 h-10 bg-blue-500 text-white rounded-full flex items-center justify-center font-bold text-lg shadow-md">
                    <?= $inisial ?>
                </div>
            </div>
        </header>

        <div class="w-full max-w-xl mx-auto bg-white rounded-xl shadow-2xl p-8 border border-gray-100">
            
            <h2 class="text-2xl font-bold text-gray-800 mb-6 border-b pb-4">Formulir Edit Data Warga #<?= $id_warga ?></h2>

            <?php if (!empty($notif_message)): ?>
                <div class="p-4 mb-6 border-l-4 rounded-md font-medium <?= $notif_class ?>">
                    <?= $notif_message ?>
                </div>
            <?php endif; ?>

            <?php if ($data_warga): ?>
                <form method="POST" action="edit_warga.php?id=<?= $id_warga ?>" class="space-y-6">
                    
                    <div>
                        <label for="nama" class="block text-sm font-medium text-gray-700 mb-1">Nama Warga</label>
                        <input type="text" id="nama" name="nama" 
                            value="<?= htmlspecialchars($data_warga['nama'] ?? '') ?>" 
                            required
                            class="w-full border border-gray-300 p-3 rounded-lg focus:ring-blue-500 focus:border-blue-500 transition duration-200 shadow-sm">
                    </div>

                    <div>
                        <label for="alamat" class="block text-sm font-medium text-gray-700 mb-1">Alamat Lengkap</label>
                        <textarea id="alamat" name="alamat" rows="3" required
                            class="w-full border border-gray-300 p-3 rounded-lg focus:ring-blue-500 focus:border-blue-500 transition duration-200 shadow-sm"><?= htmlspecialchars($data_warga['alamat'] ?? '') ?></textarea>
                    </div>

                    <div>
                        <label for="no_telepon" class="block text-sm font-medium text-gray-700 mb-1">Nomor Telepon</label>
                        <input type="text" id="no_telepon" name="no_telepon" 
                            value="<?= htmlspecialchars($data_warga['no_telepon'] ?? '') ?>" 
                            required
                            class="w-full border border-gray-300 p-3 rounded-lg focus:ring-blue-500 focus:border-blue-500 transition duration-200 shadow-sm">
                    </div>

                    <div>
                        <label for="status_warga" class="block text-sm font-medium text-gray-700 mb-1">Status Warga</label>
                        <select id="status_warga" name="status_warga" required
                            class="w-full border border-gray-300 p-3 rounded-lg focus:ring-blue-500 focus:border-blue-500 transition duration-200 shadow-sm appearance-none">
                            <option value="warga" <?= (isset($data_warga['status']) && $data_warga['status'] == 'Aktif') ? 'selected' : ''; ?>>Aktif</option>
                            <option value="warga_pendatang" <?= (isset($data_warga['status']) && $data_warga['status'] == 'Non-Aktif') ? 'selected' : ''; ?>>Non-Aktif</option>
                        </select>
                        <p class="mt-1 text-xs text-gray-500">Pilih status apakah warga masih tinggal/aktif di lingkungan.</p>
                    </div>

                    <div class="pt-4 flex justify-between gap-4">
                        <a href="../admin/manajement_warga.php" 
                           class="w-1/3 bg-gray-400 text-white px-6 py-3 rounded-xl font-semibold hover:bg-gray-500 transition duration-200 shadow-md flex items-center justify-center gap-2">
                            <i data-feather="arrow-left" class="w-5 h-5"></i>
                            Kembali
                        </a>
                        <button type="submit"
                            class="w-2/3 bg-blue-600 text-white px-6 py-3 rounded-xl font-semibold hover:bg-blue-700 transition duration-200 shadow-lg flex items-center justify-center gap-2">
                            <i data-feather="save" class="w-5 h-5"></i>
                            Simpan Perubahan
                        </button>
                    </div>
                </form>
            <?php else: ?>
                <p class="text-center text-red-500 font-medium py-10">
                    Data warga tidak ditemukan atau ID tidak valid.
                </p>
                <div class="pt-4 flex justify-center">
                    <a href="../admin/manajement_warga.php" class="bg-gray-400 text-white px-6 py-3 rounded-xl font-semibold hover:bg-gray-500 transition duration-200 shadow-md flex items-center justify-center gap-2">
                        <i data-feather="arrow-left" class="w-5 h-5"></i>
                        Kembali ke Daftar Warga
                    </a>
                </div>
            <?php endif; ?>

        </div>
        
    </div>
    
    <script src="https://unpkg.com/feather-icons"></script>
    <script>
        feather.replace();
    </script>
</body>

</html>