<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengumuman - WargaKita</title>
    <!-- Memuat Tailwind CSS dari CDN untuk styling yang cepat dan responsif -->
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Menggunakan font Inter dan styling kustom dari layout jadwal */
        body {
            font-family: 'Inter', sans-serif;
        }
        /* Custom scrollbar for better aesthetics, matching the template */
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
                        'primary-blue': '#1e40af', /* Warna biru utama untuk elemen penting */
                        'light-blue': '#eff6ff',   /* Warna biru muda untuk highlight */
                        'blue-600': '#2563eb', // Konsisten dengan sidebar
                        'blue-700': '#1d4ed8',
                        'blue-400': '#60a5fa',
                    }
                }
            }
        }

        /**
         * Fungsi JavaScript untuk menampilkan tanggal publikasi hari ini secara otomatis.
         */
        document.addEventListener('DOMContentLoaded', () => {
            const dateElement = document.getElementById('current-date');
            // Menggunakan format bahasa Indonesia
            const options = { year: 'numeric', month: 'long', day: 'numeric' };
            dateElement.textContent = new Date().toLocaleDateString('id-ID', options);
        });
    </script>
</head>
<body class="bg-gray-50 min-h-screen flex">
    
    <!-- Sidebar - Mengadopsi style dari jadwal_kegiatan_user.php -->
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
                <!-- Pengumuman Link - Set as ACTIVE -->
                <li>
                    <a href="../public/pengumuman_user.php"
                        class="flex items-center gap-3 py-3 px-4 rounded-xl bg-blue-700 text-white font-semibold shadow-inner transition duration-200">
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

    <!-- Content Area - Disesuaikan dengan tata letak jadwal user -->
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
                    <i data-feather="bell" class="w-6 h-6"></i>
                </span>
                Pemberitahuan Resmi
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

        <!-- Kontainer Utama Pengumuman (Kartu yang Responsif) - Diletakkan di tengah -->
        <div class="w-full max-w-4xl mx-auto bg-white rounded-xl shadow-2xl overflow-hidden mb-8">

            <!-- Header Pengumuman -->
            <header class="bg-primary-blue text-white p-6 md:p-8 flex justify-between items-center">
                <h1 class="text-2xl md:text-3xl font-extrabold tracking-tight">
                    PEMBERITAHUAN RESMI
                </h1>
                <!-- Ikon Megafon (Lucide) -->
                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-megaphone-off"><path d="M12.5 16H9a3 3 0 0 0-3-3V5a3 3 0 0 0-3-3v0a3 3 0 0 0 3 3v8a3 3 0 0 0 3 3z"/><path d="M16 9h1a3 3 0 0 1 3 3v0a3 3 0 0 1-3 3h-1"/><path d="M21 16.5l-3.5-3.5"/><path d="m2 2 20 20"/></svg>
            </header>

            <!-- Isi Pengumuman -->
            <div class="p-6 md:p-8 space-y-6">

                <!-- Detail Tanggal Publikasi -->
                <div class="border-b pb-4">
                    <p class="text-sm font-medium text-gray-500">Tanggal Publikasi:</p>
                    <p id="current-date" class="text-md font-semibold text-primary-blue"></p>
                </div>

                <!-- Judul Pengumuman (Ganti dengan Judul Admin Anda) -->
                <h2 class="text-3xl font-bold text-gray-800">
                    Penting: Pemeliharaan Sistem Terjadwal untuk Peningkatan Kinerja
                </h2>

                <!-- Konten Utama Pengumuman (Ganti dengan Isi Admin Anda) -->
                <div class="text-gray-700 leading-relaxed space-y-4">
                    <p>
                        Kepada seluruh pengguna yang terhormat,
                    </p>
                    <p>
                        Kami ingin menginformasikan bahwa tim teknis kami akan melakukan pemeliharaan infrastruktur sistem secara terencana. Kegiatan ini bertujuan untuk mengoptimalkan performa, meningkatkan stabilitas, dan memperkuat keamanan layanan kita.
                    </p>
                    
                    <!-- Detail Waktu dan Dampak dalam Kotak Highlight -->
                    <div class="bg-light-blue border-l-4 border-primary-blue p-4 rounded-lg shadow-inner">
                        <p class="font-bold text-primary-blue mb-2">Rincian Pemeliharaan:</p>
                        <ul class="list-disc list-inside ml-4 space-y-1 text-sm">
                            <li><strong>Waktu Mulai:</strong> Sabtu, 30 November 2025, Pukul 00:00 WIB</li>
                            <li><strong>Waktu Selesai:</strong> Sabtu, 30 November 2025, Pukul 04:00 WIB</li>
                            <li><strong>Dampak:</strong> Layanan aplikasi/sistem tidak akan dapat diakses (downtime total) selama periode waktu tersebut.</li>
                        </ul>
                    </div>

                    <p>
                        Kami menyarankan Anda untuk menyelesaikan semua transaksi atau pekerjaan penting sebelum waktu pemeliharaan dimulai. Harap maklum atas ketidaknyamanan yang mungkin timbul akibat dari kegiatan ini.
                    </p>
                    <p>
                        Kami berkomitmen untuk menyelesaikan proses ini secepat mungkin. Terima kasih atas pengertian dan kerja sama Anda.
                    </p>
                </div>
                <!-- Akhir Konten Utama -->

                <!-- Penutup / Tanda Tangan -->
                <div class="pt-6 border-t">
                    <p class="text-gray-600 font-semibold">Hormat kami,</p>
                    <p class="text-primary-blue font-bold text-lg">Tim Administrasi Sistem</p>
                    <p class="text-xs text-gray-400 mt-1">Jika ada pertanyaan mendesak, silakan hubungi pusat bantuan kami.</p>
                </div>

            </div>
        </div>

    </div>
    
    <!-- Script untuk memuat Feather Icons -->
    <script src="https://unpkg.com/feather-icons"></script>
    <script>
        feather.replace();
    </script>
</body>
</html>