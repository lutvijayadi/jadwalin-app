<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Saya - WargaKita</title>
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
        /* Kelas untuk foto profil default/placeholder */
        .profile-placeholder {
            background-color: #3b82f6; /* blue-500 */
            color: white;
            font-size: 3rem;
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

        // Fungsi dummy untuk menangani upload foto
        function handlePhotoChange(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = (e) => {
                    const profileImage = document.getElementById('profile-image');
                    profileImage.src = e.target.result;
                    profileImage.classList.remove('hidden');
                    document.getElementById('profile-initial').classList.add('hidden');
                    
                    // Tampilkan pesan sukses sementara
                    const messageBox = document.getElementById('photo-message');
                    messageBox.classList.remove('hidden');
                    messageBox.classList.remove('bg-red-100', 'border-red-500', 'text-red-700');
                    messageBox.classList.add('bg-green-100', 'border-green-500', 'text-green-700');
                    messageBox.textContent = 'Foto berhasil diunggah (simulasi).';

                    setTimeout(() => {
                        messageBox.classList.add('hidden');
                    }, 3000);
                };
                reader.readAsDataURL(file);
            }
        }
        
        // Fungsi dummy untuk menangani submit formulir detail profil
        function handleProfileSubmit(event) {
            event.preventDefault();
            const form = event.target;
            const newName = form.nama_lengkap.value;
            
            // Tampilkan pesan sukses sementara
            const messageBox = document.getElementById('detail-message');
            messageBox.classList.remove('hidden');
            messageBox.classList.remove('bg-red-100', 'border-red-500', 'text-red-700');
            messageBox.classList.add('bg-green-100', 'border-green-500', 'text-green-700');
            messageBox.textContent = `Detail profil berhasil diperbarui untuk ${newName}.`;
            
            // Sembunyikan pesan setelah 3 detik
            setTimeout(() => {
                messageBox.classList.add('hidden');
            }, 3000);
            
            console.log('Detail profil dikirim:', newName);
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
                <!-- Pengaturan Link (tetap non-aktif, karena ini halaman Profil) -->
                <li>
                    <a href="../pengaturan/pengaturan_user.php"
                        class="flex items-center gap-3 py-3 px-4 rounded-xl text-white font-medium hover:bg-blue-700 transition duration-200">
                        <i data-feather="settings" class="w-5 h-5"></i>
                        Pengaturan
                    </a>
                </li>
                <!-- Profil Link - Set as ACTIVE -->
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
            $foto_profil_url = ""; // Kosongkan untuk menggunakan placeholder
        ?>
        <header class="bg-white shadow-md p-4 flex justify-between items-center sticky top-0 z-10 w-full mb-8 rounded-xl">
            <div class="flex items-center gap-2 text-xl font-semibold text-gray-700">
                <span class="text-blue-600">
                    <i data-feather="user" class="w-6 h-6"></i>
                </span>
                Profil Pengguna
            </div>
            
            <!-- User Profile Display (Same as before) -->
            <div class="flex items-center gap-3 group p-1 rounded-full cursor-pointer">
                <span class="text-sm font-medium text-gray-700">
                    <?= $nama_warga ?>
                </span>
                <div
                    class="w-10 h-10 bg-green-500 text-white rounded-full flex items-center justify-center font-bold text-lg shadow-md">
                    <?= $inisial ?>
                </div>
            </div>
        </header>

        <!-- Kontainer Utama Profil (Kartu yang Responsif) -->
        <div class="w-full max-w-4xl mx-auto bg-white rounded-xl shadow-2xl p-8 border border-gray-100">
            
            <h2 class="text-2xl font-bold text-gray-800 mb-8 border-b pb-4">Informasi Profil</h2>

            <div class="flex flex-col md:flex-row gap-8">
                
                <!-- Kolom Kiri: Foto Profil dan Upload -->
                <div class="md:w-1/3 flex flex-col items-center border-b md:border-b-0 md:border-r pb-6 md:pb-0 md:pr-8">
                    <div class="relative w-40 h-40 mb-4">
                        <!-- Foto Profil: Tampilkan Gambar atau Inisial/Placeholder -->
                        <?php if (!empty($foto_profil_url)): ?>
                            <img id="profile-image" src="<?= $foto_profil_url ?>" alt="Foto Profil" 
                                class="w-40 h-40 object-cover rounded-full border-4 border-white shadow-lg">
                            <div id="profile-initial" class="hidden w-40 h-40 rounded-full flex items-center justify-center profile-placeholder border-4 border-white shadow-lg">
                                <?= $inisial ?>
                            </div>
                        <?php else: ?>
                            <!-- Placeholder jika tidak ada foto -->
                            <img id="profile-image" src="" alt="Foto Profil" class="hidden w-40 h-40 object-cover rounded-full border-4 border-white shadow-lg">
                            <div id="profile-initial" class="w-40 h-40 rounded-full flex items-center justify-center profile-placeholder border-4 border-white shadow-lg">
                                <?= $inisial ?>
                            </div>
                        <?php endif; ?>
                        
                        <!-- Tombol Edit Foto Overlay (Simulasi) -->
                        <label for="photo-upload" class="absolute bottom-0 right-0 p-2 bg-blue-600 hover:bg-blue-700 text-white rounded-full cursor-pointer shadow-md transition duration-200">
                            <i data-feather="camera" class="w-5 h-5"></i>
                            <input type="file" id="photo-upload" accept="image/*" onchange="handlePhotoChange(event)" class="hidden">
                        </label>
                    </div>

                    <p class="text-center font-semibold text-lg text-gray-800 mb-1"><?= $nama_warga ?></p>
                    <p class="text-sm text-gray-500">Warga Biasa</p>
                    
                    <!-- Pesan Notifikasi Foto -->
                    <div id="photo-message" class="hidden mt-4 w-full text-center p-2 text-sm rounded-md font-medium border-l-4">
                        <!-- Pesan akan diisi oleh JavaScript -->
                    </div>
                </div>

                <!-- Kolom Kanan: Detail Profil (Formulir) -->
                <div class="md:w-2/3">
                    <h3 class="text-xl font-semibold text-gray-800 mb-4">Detail Informasi Pribadi</h3>

                    <!-- Pesan Notifikasi Detail Profil -->
                    <div id="detail-message" class="hidden p-3 mb-6 bg-green-100 border-l-4 border-green-500 text-green-700 rounded-md font-medium">
                        <!-- Pesan akan diisi oleh JavaScript -->
                    </div>

                    <form onsubmit="handleProfileSubmit(event)" class="space-y-4">
                        
                        <!-- Input Nama Lengkap -->
                        <div>
                            <label for="nama_lengkap" class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
                            <input type="text" id="nama_lengkap" name="nama_lengkap" value="Budi Santoso" required
                                class="w-full border border-gray-300 p-3 rounded-lg focus:ring-blue-500 focus:border-blue-500 transition duration-200 shadow-sm">
                        </div>

                        <!-- Input Email (Contoh) -->
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Alamat Email</label>
                            <input type="email" id="email" name="email" value="budi.santoso@warga.com" required
                                class="w-full border border-gray-300 p-3 rounded-lg bg-gray-50 cursor-not-allowed" readonly>
                            <p class="mt-1 text-xs text-gray-500">Email tidak dapat diubah di sini. Gunakan halaman Pengaturan jika tersedia.</p>
                        </div>
                        
                        <!-- Input Nomor HP (Contoh) -->
                        <div>
                            <label for="nomor_hp" class="block text-sm font-medium text-gray-700 mb-1">Nomor Telepon</label>
                            <input type="text" id="nomor_hp" name="nomor_hp" value="0812-3456-7890" 
                                class="w-full border border-gray-300 p-3 rounded-lg focus:ring-blue-500 focus:border-blue-500 transition duration-200 shadow-sm">
                        </div>

                        <!-- Tombol Simpan -->
                        <div class="pt-4">
                            <button type="submit"
                                class="w-full bg-blue-600 text-white px-6 py-3 rounded-xl font-semibold hover:bg-blue-700 transition duration-200 shadow-lg flex items-center justify-center gap-2">
                                <i data-feather="edit-3" class="w-5 h-5"></i>
                                Perbarui Detail Profil
                            </button>
                        </div>
                    </form>
                </div>
                <!-- Akhir Kolom Detail Profil -->
            </div>
            <!-- Akhir Kontainer Flex -->

        </div>
        
    </div>
    
    <!-- Script untuk memuat Feather Icons -->
    <script src="https://unpkg.com/feather-icons"></script>
    <script>
        feather.replace();
    </script>
</body>
</html>