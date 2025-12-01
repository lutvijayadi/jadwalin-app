<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pemberitahuan Penting</title>
    <!-- Memuat Tailwind CSS dari CDN untuk styling yang cepat dan responsif -->
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Menggunakan font Inter untuk tampilan modern dan mudah dibaca */
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f3f4f6; /* Latar belakang abu-abu muda */
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
<body class="min-h-screen flex items-center justify-center p-4">

    <!-- Kontainer Utama Pengumuman (Kartu yang Responsif) -->
    <div class="w-full max-w-4xl bg-white rounded-xl shadow-2xl overflow-hidden transform transition-all duration-300 hover:shadow-3xl">

        <!-- Header Pengumuman -->
        <header class="bg-primary-blue text-white p-6 md:p-8 flex justify-between items-center">
            <h1 class="text-2xl md:text-3xl font-extrabold tracking-tight">
                PEMBERITAHUAN RESMI
            </h1>
            <!-- Ikon Megafon (menggantikan ikon pihak ketiga seperti Font Awesome) -->
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

</body>
</html>