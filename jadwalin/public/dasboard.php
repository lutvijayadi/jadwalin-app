<?php
include '../koneksi/koneksi.php';

// ambil keyword pencarian (jika ada)
$keyword = isset($_GET['cari']) ? $_GET['cari'] : "";

$query = "SELECT * FROM jadwal 
          WHERE tanggal LIKE '%$keyword%' OR acara LIKE '%$keyword%' OR keterangan LIKE '%$keyword%' OR lokasi LIKE '%$keyword%' 
          ORDER BY id ASC";
$result = mysqli_query($koneksi, $query);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Jadwal Warga</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 min-h-screen">
   

    <div class="max-w-5xl mx-auto p-6">
        <!-- Header -->
        <h1 class="text-3xl font-bold mb-6 text-center text-blue-700">📅 Jadwal Kegiatan Warga</h1>

        <!-- Form Pencarian -->
        <form method="get" class="flex mb-6">
            <input type="text" name="cari" value="<?= $keyword ?>" placeholder="Cari id / tanggal / acara..."
                class="flex-grow border p-2 rounded-l">
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-r">Cari</button>
        </form>

        <!-- Tabel Jadwal -->
        <div class="overflow-x-auto">
            <table class="w-full border border-gray-300 rounded-lg bg-white shadow text-sm">
                <thead class="bg-blue-100">
                    <tr>
                        <th class="border px-4 py-2">id</th>
                        <th class="border px-4 py-2">tanggal</th>
                        <th class="border px-4 py-2">acara</th>
                        <th class="border px-4 py-2">keterangan</th>
                        <th class="border px-4 py-2">lokasi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (mysqli_num_rows($result) > 0): ?>
                        <?php while ($row = mysqli_fetch_assoc($result)): ?>
                            <tr class="hover:bg-gray-50">
                                <td class="border px-4 py-2 text-center"><?= $row['id']; ?></td>
                                <td class="border px-4 py-2"><?= date("d-m-Y", strtotime($row['tanggal'])); ?></td>
                                <td class="border px-4 py-2"><?= $row['acara']; ?></td>
                                <td class="border px-4 py-2"><?= $row['keterangan']; ?></td>
                                <td class="border px-4 py-2"><?= $row['lokasi']; ?></td>
                            </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5" class="text-center py-4 text-gray-500">Tidak ada data ditemukan</td>
                        </tr>
                    <?php endif; ?>

                     <li>
        <a href="../aksi/logout.php"
          class="flex items-center gap-2 py-2 px-4 rounded-lg bg-red-500 text-white font-semibold hover:bg-red-600 transition shadow">
          Logout
        </a>
                </tbody>
            </table>
        </div>
    </div>

</body>

</html>