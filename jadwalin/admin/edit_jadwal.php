<?php
// PASTIKAN session_start() dilakukan di awal
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Include the action file to handle data fetching and updates
include '../koneksi/koneksi.php';

// Set admin profile variables (dummy data, adjust as needed)
$nama = "Admin RT";
$inisial = "A";
// Ensure variable used in template is available
$nama_admin = $nama;

// --- LOGIKA UTAMA (FETCH DAN UPDATE) DIMULAI DI SINI ---

$id_jadwal = isset($_GET['id']) ? (int) $_GET['id'] : 0;
$data_jadwal = null;
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
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ambil data dari formulir
    $new_tanggal = mysqli_real_escape_string($koneksi, $_POST['tanggal']);
    $new_acara = mysqli_real_escape_string($koneksi, $_POST['acara']);
    $new_keterangan = mysqli_real_escape_string($koneksi, $_POST['keterangan']);
    $new_lokasi = mysqli_real_escape_string($koneksi, $_POST['lokasi']);

    // Proses update ke database
    $update_query = "UPDATE jadwal SET tanggal='$new_tanggal', acara='$new_acara', keterangan='$new_keterangan', lokasi='$new_lokasi' WHERE id=$id_jadwal";

    if (mysqli_query($koneksi, $update_query)) {
        // UPDATE BERHASIL! Simpan pesan sukses di session dan REDIRECT.
        $_SESSION['notif_message'] = "Jadwal untuk '{$new_acara}' berhasil diperbarui!";
        $_SESSION['notif_class'] = "bg-green-100 border-green-500 text-green-700";

        // Redirect untuk memuat ulang halaman dengan data baru
        header("Location: edit_jadwal.php?id=" . $id_jadwal);
        exit(); // Hentikan eksekusi kode selanjutnya
    } else {
        // Error saat update
        $notif_message = "Error: Gagal memperbarui jadwal. " . mysqli_error($koneksi);
        $notif_class = "bg-red-100 border-red-500 text-red-700";
    }
}
// --- AKHIR LOGIKA UPDATE DATA ---


// --- LOGIKA FETCH DATA DARI DATABASE (untuk menampilkan formulir) ---
if ($id_jadwal > 0) {
    // Perbaikan: Gunakan "jadwal" sesuai query asli Anda
    $query = "SELECT * FROM jadwal WHERE id = $id_jadwal";
    $result = mysqli_query($koneksi, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $data_jadwal = mysqli_fetch_assoc($result);
    } else {
        // Jika data tidak ditemukan
        $notif_message = "Data jadwal dengan ID #{$id_jadwal} tidak ditemukan di database.";
        $notif_class = "bg-red-100 border-red-500 text-red-700";
    }
} else {
    // Jika ID tidak valid (0 atau tidak ada)
    $notif_message = "Error: ID Jadwal tidak valid.";
    $notif_class = "bg-red-100 border-red-500 text-red-700";
}
// --- AKHIR FETCH DATA ---


// Definisikan $id untuk digunakan di tag <h2> dan <form>
$id = $id_jadwal;
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Jadwal Kegiatan - Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }

        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-thumb {
            background-color: #9ca3af;
            border-radius: 4px;
        }

        ::-webkit-scrollbar-track {
            background-color: #f3f4f6;
        }
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

    <div class="w-64 min-h-screen bg-blue-600 p-6 shadow-2xl fixed flex flex-col justify-between">
        <div>
            <h1 class="text-3xl font-poppins text-white mb-10 tracking-wider">Admin Panel
            </h1>
            <ul class="space-y-3">
                <li><a href="../index/admin.php"
                        class="flex items-center gap-3 py-3 px-4 rounded-xl text-white font-medium hover:bg-blue-700 transition duration-200"><i
                            data-feather="home" class="w-5 h-5"></i> Dashboard</a></li>
                <li><a href="../admin/jadwal_kegiatan.php"
                        class="flex items-center gap-3 py-3 px-4 rounded-xl bg-blue-700 text-white font-semibold shadow-inner transition duration-200"><i
                            data-feather="calendar" class="w-5 h-5"></i> Kelola Jadwal</a></li>
                <li><a href="../admin/pengumuman.php"
                        class="flex items-center gap-3 py-3 px-4 rounded-xl text-white font-medium hover:bg-blue-700 transition duration-200"><i
                            data-feather="bell" class="w-5 h-5"></i> Kelola Pengumuman</a></li>
                <li><a href="../admin/manajement_warga.php"
                        class="flex items-center gap-3 py-3 px-4 rounded-xl text-white font-medium hover:bg-blue-700 transition duration-200"><i
                            data-feather="users" class="w-5 h-5"></i> Kelola Warga</a></li>
            </ul>
        </div>
        <a href="../aksi/logout.php"
            class="flex items-center gap-3 py-3 px-4 rounded-xl bg-blue-400 text-white font-semibold hover:bg-red-500 transition duration-200 justify-center shadow-lg">
            <i data-feather="log-out" class="w-5 h-5"></i> Logout
        </a>
    </div>

    <div class="ml-64 w-full flex flex-col p-8">

        <header
            class="bg-white shadow-md p-4 flex justify-between items-center sticky top-0 z-10 w-full mb-8 rounded-xl">
            <div class="flex items-center gap-2 text-xl font-semibold text-gray-700">
                <span class="text-blue-600"><i data-feather="edit" class="w-6 h-6"></i></span>
                Edit Jadwal Kegiatan
            </div>

            <div class="flex items-center gap-3 group p-1 rounded-full cursor-pointer">
                <span class="text-sm font-medium text-gray-700"><?= $nama_admin ?></span>
                <div
                    class="w-10 h-10 bg-indigo-500 text-white rounded-full flex items-center justify-center font-bold text-lg shadow-md">
                    <?= $inisial ?>
                </div>
            </div>
        </header>


        <div class="w-full max-w-xl mx-auto bg-white rounded-xl shadow-2xl p-8 border border-gray-100">

            <h2 class="text-2xl font-bold text-gray-800 mb-6 border-b pb-4">Formulir Edit Jadwal #<?= $id ?></h2>

            <?php if (!empty($notif_message)): ?>
                <div class="p-4 mb-6 border-l-4 rounded-md font-medium <?= $notif_class ?>">
                    <?= $notif_message ?>
                </div>
            <?php endif; ?>

            <?php if ($data_jadwal): ?>
                <form method="post" action="edit_jadwal.php?id=<?= $id ?>" class="space-y-6">
                    <div class="mb-4">
                        <label for="tanggal" class="block text-sm font-medium text-gray-700 mb-1">Tanggal & Waktu</label>
                        <input type="date" id="tanggal" name="tanggal"
                            value="<?= htmlspecialchars($data_jadwal['tanggal']) ?>" required
                            class="w-full border border-gray-300 p-3 rounded-lg focus:ring-blue-500 focus:border-blue-500 transition duration-200 shadow-sm">
                    </div>

                    <div>
                        <label for="acara" class="block text-sm font-medium text-gray-700 mb-1">Nama Acara /
                            Kegiatan</label>
                        <input type="text" id="acara" name="acara" value="<?= htmlspecialchars($data_jadwal['acara']) ?>"
                            required
                            class="w-full border border-gray-300 p-3 rounded-lg focus:ring-blue-500 focus:border-blue-500 transition duration-200 shadow-sm">
                    </div>

                    <div>
                        <label for="lokasi" class="block text-sm font-medium text-gray-700 mb-1">Lokasi</label>
                        <input type="text" id="lokasi" name="lokasi" value="<?= htmlspecialchars($data_jadwal['lokasi']) ?>"
                            required
                            class="w-full border border-gray-300 p-3 rounded-lg focus:ring-blue-500 focus:border-blue-500 transition duration-200 shadow-sm">
                    </div>

                    <div>
                        <label for="keterangan" class="block text-sm font-medium text-gray-700 mb-1">Keterangan Detail
                            (Opsional)</label>
                        <textarea id="keterangan" name="keterangan" rows="4"
                            class="w-full border border-gray-300 p-3 rounded-lg focus:ring-blue-500 focus:border-blue-500 transition duration-200 shadow-sm"><?= htmlspecialchars($data_jadwal['keterangan']) ?></textarea>
                    </div>

                    <div class="pt-4 flex justify-between gap-4">
                        <a href="../admin/jadwal_kegiatan.php"
                            class="w-1/3 bg-gray-400 text-white px-6 py-3 rounded-xl font-semibold hover:bg-gray-500 transition duration-200 shadow-md flex items-center justify-center gap-2">
                            <i data-feather="arrow-left" class="w-5 h-5"></i> Kembali
                        </a>
                        <button type="submit"
                            class="w-2/3 bg-blue-600 text-white px-6 py-3 rounded-xl font-semibold hover:bg-blue-700 transition duration-200 shadow-lg flex items-center justify-center gap-2">
                            <i data-feather="save" class="w-5 h-5"></i>
                            Simpan Perubahan
                        </button>
                    </div>
                </form>
            <?php else: ?>
                <p class="text-center text-red-500 font-medium py-10">Data jadwal dengan ID #<?= $id ?> tidak ditemukan atau
                    tidak valid.</p>
                <div class="pt-4 flex justify-center">
                    <a href="../admin/jadwal_kegiatan.php"
                        class="bg-gray-400 text-white px-6 py-3 rounded-xl font-semibold hover:bg-gray-500 transition duration-200 shadow-md flex items-center justify-center gap-2">
                        Kembali ke Daftar Jadwal
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