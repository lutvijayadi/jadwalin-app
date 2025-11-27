<?php

include '../koneksi/koneksi.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Edit Jadwal</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 p-6">

    <h2 class="text-xl font-bold mb-4"> Edit Jadwal Warga</h2>

    <form action="../aksi/aksi_edit.php" method="post" class="space-y-4 bg-white p-6 rounded shadow max-w-lg">

        <!-- hidden tanggal lama -->
        <input type="hidden" name="id" value="<?= $data['id']; ?>">

        <div>
            <label class="block mb-1 font-semibold">Tanggal</label>
            <input type="date" name="tanggal" value="<?= $data['tanggal']; ?>" class="border p-2 w-full" required>
        </div>

        <div>
            <label class="block mb-1 font-semibold">Acara</label>
            <input type="text" name="acara" value="<?= $data['acara']; ?>" class="border p-2 w-full" required>
        </div>

        <div>
            <label class="block mb-1 font-semibold">keterangan</label>
            <textarea name="keterangan" class="border p-2 w-full" required><?= $data['keterangan']; ?></textarea>
        </div>
        <div>
            <label class="block mb-1 font-semibold">Lokasi</label>
            <textarea name="lokasi" class="border p-2 w-full" required><?= $data['lokasi']; ?></textarea>
        </div>

        <!-- <div>
            <label class="block mb-1 font-semibold">Keterangan</label>
            <input type="text" name="keterangan" value="<?= $data['keterangan']; ?>" class="border p-2 w-full" required>
        </div> -->

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Update</button>
        <a href="index.php" class="bg-gray-500 text-white px-4 py-2 rounded">Batal</a>
    </form>

</body>

</html>