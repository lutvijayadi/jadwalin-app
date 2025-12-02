<?php
// Catatan: Pastikan file koneksi.php berada di lokasi yang benar
include '../../koneksi/koneksi.php';

// Ambil keyword pencarian (jika ada) dari URL
$keyword = isset($_GET['cari']) ? $_GET['cari'] : "";

$data_jadwal = [];
$error_message = "";

// Pastikan koneksi ke database valid sebelum menjalankan query
if (!$koneksi) {
    $error_message = "Koneksi database gagal: " . mysqli_connect_error();
} else {
    // Amankan keyword dari potensi SQL Injection
    $safe_keyword = mysqli_real_escape_string($koneksi, $keyword);
    
    // Query untuk mencari data jadwal
    $query = "SELECT * FROM pengumuman 
              WHERE tanggal LIKE '%$safe_keyword%' 
              OR acara LIKE '%$safe_keyword%' 
              OR keterangan LIKE '%$safe_keyword%' 
              OR lokasi LIKE '%$safe_keyword%' 
              ORDER BY tanggal ASC";

    $result = mysqli_query($koneksi, $query);

    if (!$result) {
        $error_message = "Error saat menjalankan query: " . mysqli_error($koneksi);
    } else {
       
        while ($row = mysqli_fetch_assoc($result)) {
            $data_jadwal[] = $row;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Jadwal Kegiatan</title>
    <!-- Styling minimal untuk cetak -->
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            color: #333;
        }
        .container {
            width: 100%;
            max-width: 900px;
            margin: 0 auto;
        }
        h1 {
            text-align: center;
            margin-bottom: 30px;
            color: #2563eb;
            border-bottom: 2px solid #ccc;
            padding-bottom: 10px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
            font-size: 12px;
        }
        th {
            background-color: #f2f2f2;
            color: #444;
            font-weight: bold;
        }
        .text-center {
            text-align: center;
        }
        .small-text {
            font-size: 10px;
        }
        
        /* CSS Khusus untuk media cetak */
        @media print {
            body {
                font-size: 12pt;
                padding: 0;
                margin: 0;
            }
            .no-print {
                display: none;
            }
            /* Memaksa elemen cetak agar tampil rapi */
            .container {
                width: 100%;
                margin: 0;
            }
        }
    </style>
</head>
<body onload="window.print()">
    <div class="container">
        <h1>DAFTAR PENGUMUMAN</h1>
        <?php if (!empty($keyword)): ?>
            <p class="no-print">Menampilkan hasil pencarian untuk: "<?php echo htmlspecialchars($keyword); ?>"</p>
        <?php endif; ?>

        <?php if (!empty($error_message)): ?>
            <p style="color: red;"><?php echo $error_message; ?></p>
        <?php elseif (empty($data_jadwal)): ?>
            <p class="text-center">Tidak ada jadwal kegiatan yang ditemukan.</p>
        <?php else: ?>
            <table>
                <thead>
                    <tr>
                        <th class="text-center">No.</th>
                        <th>Tanggal</th>
                        <th>Acara</th>
                        <th>Keterangan</th>
                        <th>Lokasi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $no = 1;
                    foreach ($data_jadwal as $row): 
                    ?>
                        <tr>
                            <td class="text-center"><?php echo $no++; ?></td>
                            <td><?php echo date("d F Y", strtotime($row['tanggal'])); ?></td>
                            <td><?php echo htmlspecialchars($row['acara']); ?></td>
                            <td class="small-text"><?php echo htmlspecialchars($row['keterangan']); ?></td>
                            <td><?php echo htmlspecialchars($row['lokasi']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>
</body>
</html>