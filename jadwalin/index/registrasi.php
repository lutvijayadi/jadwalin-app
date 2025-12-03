<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Daftar - Jadwalin</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet" />

    <script src="https://unpkg.com/feather-icons"></script>

    <style>
        body {
            font-family: "Poppins", sans-serif;
        }

        /* Styling untuk meniru overlay modal dari index.php */
        .modal-overlay {
            background-color: rgba(194, 190, 190, 0.8);
            backdrop-filter: blur(5px);
        }

        .modal-enter {
            animation: modalFadeIn 0.3s ease-out;
        }

        @keyframes modalFadeIn {
            from {
                opacity: 0;
                transform: scale(0.9);
            }

            to {
                opacity: 1;
                transform: scale(1);
            }
        }
        
        /* Menyesuaikan warna input agar mirip foto (Putih dengan teks hitam/dark) */
        .input-dark {
            /* Meniru input putih yang digunakan di modal login pada foto */
            background-color: white; 
            border: 1px solid #e5e7eb; /* border gray-200 */
            color: black; /* Teks input berwarna hitam */
            padding-left: 0.75rem; /* px-3 */
            padding-right: 0.75rem; /* px-3 */
        }
    </style>
</head>

<body class="bg-gray-100 text-black">
    
    <div class="fixed inset-0 z-50 flex items-center justify-center p-4 modal-overlay">

        <div class="relative bg-neutral-800 rounded-lg shadow-xl max-w-md w-full mx-4 modal-enter">
            
            <div class="flex justify-between items-center p-6 border-b border-gray-700">
                <h2 class="text-xl font-bold text-white">Daftar Akun Baru Jadwalin</h2>
                <a href="../index/index.php" class="text-gray-400 hover:text-white text-2xl">×</a>
            </div>

            <?php
            // Pastikan Anda telah membuat aksi_registrasi.php dan file koneksi/koneksi.php
            if (isset($_GET['pesan'])) {
                if ($_GET['pesan'] == "gagal_username") {
                    // Warna teks merah di latar gelap
                    echo '<div class="p-4 text-red-400 bg-neutral-700 text-sm text-center">Username **sudah terdaftar**!</div>';
                } elseif ($_GET['pesan'] == "berhasil") {
                    // Warna teks hijau di latar gelap
                    echo '<div class="p-4 text-green-400 bg-neutral-700 text-sm text-center">Registrasi **berhasil**! Silakan <a href="../index/index.php" class="font-bold text-blue-500 hover:underline">Login</a>.</div>';
                } elseif ($_GET['pesan'] == "gagal_simpan") {
                    echo '<div class="p-4 text-red-400 bg-neutral-700 text-sm text-center">Registrasi **gagal**! Terjadi kesalahan pada database.</div>';
                }
            }
            ?>

            <form action="../aksi/aksi_registrasi.php" method="POST" class="p-6">
                
                <div class="mb-4">
                    <label for="nama" class="block text-sm font-medium text-gray-300 mb-2">Nama Lengkap</label>
                    <input type="text" id="nama" name="nama" required
                        class="w-full px-3 py-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 input-dark"
                        placeholder="Masukkan Nama Lengkap Anda">
                </div>
                
                <div class="mb-4">
                    <label for="username" class="block text-sm font-medium text-gray-300 mb-2">Username</label>
                    <input type="text" id="username" name="username" required
                        class="w-full px-3 py-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 input-dark"
                        placeholder="Pilih Username">
                </div>
                
                <div class="mb-4">
                    <label for="password" class="block text-sm font-medium text-gray-300 mb-2">Password</label>
                    <input type="password" id="password" name="password" required
                        class="w-full px-3 py-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 input-dark"
                        placeholder="Masukkan Password">
                </div>
                
                <div class="mb-6">
                    <label for="level" class="block text-sm font-medium text-gray-300 mb-2">Pilih Level Akun</label>
                    <select id="level" name="level" required
                        class="w-full px-3 py-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 input-dark">
                        <option value="user">User</option>
                        <option value="admin">Admin</option>
                    </select>
                </div>
                
                <button type="submit"
                    class="w-full bg-blue-500 hover:bg-blue-600 text-white font-medium py-2 px-4 rounded-lg transition">
                    Daftar Sekarang
                </button>
            </form>

            <div class="p-6 border-t border-gray-700 text-center">
                <p class="text-sm text-gray-400">Sudah punya akun? 
                    <a href="../index/index.php" class="text-blue-500 hover:underline">Login di sini</a>
                </p>
            </div>
        </div>
    </div>
</body>

</html>