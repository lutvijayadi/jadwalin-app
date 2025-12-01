<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengaturan Akun - WargaKita</title>
    <!-- Memuat Tailwind CSS dari CDN untuk styling yang cepat dan responsif -->
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Menggunakan font Inter dan styling kustom dari layout dashboard */
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
    <script>
        // Konfigurasi Tailwind untuk warna kustom
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

        // Fungsi dummy untuk menangani submit formulir
        function handleSettingsSubmit(event) {
            event.preventDefault();
            // Di sini Anda akan menambahkan logika untuk mengirim data ke backend (misalnya melalui AJAX/Fetch API)
            const form = event.target;
            const newName = form.nama.value;
            const newEmail = form.email.value;
            const newPassword = form.password.value;
            
            // Tampilkan pesan sukses sementara (sebelum integrasi backend nyata)
            const messageBox = document.getElementById('success-message');
            messageBox.classList.remove('hidden');
            messageBox.textContent = `Pengaturan berhasil disimpan untuk ${newName}.`;
            
            // Sembunyikan pesan setelah 3 detik
            setTimeout(() => {
                messageBox.classList.add('hidden');
            }, 3000);
            
            // Logika nyata: Kirim data ke server
            console.log('Data yang dikirim:', { newName, newEmail, newPassword });
        }
    </script>
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
                <!-- Pengaturan Link - Set as ACTIVE -->
                <li>
                    <a href="../pengaturan/pengaturan_user.php"
                        class="flex items-center gap-3 py-3 px-4 rounded-xl bg-blue-700 text-white font-semibold shadow-inner transition duration-200">
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
        
        <!-- Top Header Bar (Dummy User Data) -->
        <?php 
            // Hardcoding dummy data to match the visual PHP template
            $nama_warga = "Budi Santoso";
            $inisial = "B";
        ?>
        <header class="bg-white shadow-md p-4 flex justify-between items-center sticky top-0 z-10 w-full mb-8 rounded-xl">
            <div class="flex items-center gap-2 text-xl font-semibold text-gray-700">
                <span class="text-blue-600">
                    <i data-feather="settings" class="w-6 h-6"></i>
                </span>
                Pengaturan Akun
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

        <!-- Kontainer Utama Pengaturan (Kartu yang Responsif) -->
        <div class="w-full max-w-2xl mx-auto bg-white rounded-xl shadow-2xl p-8 border border-gray-100">
            
            <h2 class="text-2xl font-bold text-gray-800 mb-6 border-b pb-4">Kelola Informasi Akun</h2>

            <!-- Pesan Sukses (Hidden by default) -->
            <div id="success-message" class="hidden p-3 mb-6 bg-green-100 border-l-4 border-green-500 text-green-700 rounded-md font-medium">
                <!-- Pesan akan diisi oleh JavaScript -->
            </div>

            <form onsubmit="handleSettingsSubmit(event)" class="space-y-6">
                
                <!-- Input Nama Lengkap -->
                <div>
                    <label for="nama" class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
                    <input type="text" id="nama" name="nama" value="Budi Santoso" required
                        class="w-full border border-gray-300 p-3 rounded-lg focus:ring-blue-500 focus:border-blue-500 transition duration-200 shadow-sm">
                </div>

                <!-- Input Email (Contoh) -->
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Alamat Email</label>
                    <input type="email" id="email" name="email" value="budi.santoso@warga.com" required
                        class="w-full border border-gray-300 p-3 rounded-lg focus:ring-blue-500 focus:border-blue-500 transition duration-200 shadow-sm">
                </div>

                <hr class="border-gray-200">

                <h3 class="text-xl font-semibold text-gray-800 pt-2">Ganti Kata Sandi</h3>

                <!-- Input Kata Sandi Baru -->
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Kata Sandi Baru</label>
                    <input type="password" id="password" name="password" placeholder="Masukkan kata sandi baru (kosongkan jika tidak ingin diubah)"
                        class="w-full border border-gray-300 p-3 rounded-lg focus:ring-yellow-500 focus:border-yellow-500 transition duration-200 shadow-sm">
                    <p class="mt-1 text-xs text-gray-500">Minimal 8 karakter.</p>
                </div>

                <!-- Tombol Simpan -->
                <div class="pt-4">
                    <button type="submit"
                        class="w-full bg-blue-600 text-white px-6 py-3 rounded-xl font-semibold hover:bg-blue-700 transition duration-200 shadow-lg flex items-center justify-center gap-2">
                        <i data-feather="save" class="w-5 h-5"></i>
                        Simpan Perubahan
                    </button>
                </div>
            </form>

        </div>
        
    </div>
    
    <!-- Script untuk memuat Feather Icons -->
    <script src="https://unpkg.com/feather-icons"></script>
    <script>
        feather.replace();
    </script>
</body>
</html>