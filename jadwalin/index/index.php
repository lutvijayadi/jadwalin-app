<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Jadwalin</title>

  <!-- Tailwind -->
  <script src="https://cdn.tailwindcss.com"></script>

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet" />

  <!-- Feather Icons -->
  <script src="https://unpkg.com/feather-icons"></script>

  <style>
    body {
      font-family: "Poppins", sans-serif;
    }

    /* MODIFIKASI: Styling untuk modal (mirip top up: overlay gelap, animasi fade) */
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
  </style>
</head>

<body class="bg-white-900 text-black">


  <!-- Navbar -->
  <header class="fixed top-0 left-0 right-0 bg-white/80 border-b border-gray-700 z-50">
    <div class="max-w-7xl mx-auto flex justify-between items-center px-6 py-4">
      <a href="#" class="text-2xl font-bold italic">Warga<span class="text-blue-500">kita</span></a>

      <nav class="navbar-nav hidden md:flex space-x-6 text-lg">
        <a href="#" class="hover:text-blue-500 transition">Beranda</a>
        <a href="#about" class="hover:text-blue-500 transition">Standar Layanan</a>
        <a href="#berita" class="hover:text-blue-500 transition">Berita</a>
        <a href="#contact" class="hover:text-blue-500 transition">Kontak</a>
      </nav>

      <div class="flex items-center space-x-4">
        <a href="#" class="hover:text-blue-500"><i data-feather="search"></i></a>
        <a href="#" class="hover:text-blue-500"><i data-feather="shopping-cart"></i></a>
        <button id="hamburger-menu" class="md:hidden hover:text-blue-500">
          <i data-feather="menu"></i>
        </button>
      </div>
    </div>
  </header>

  <!-- Hero -->
  <section class="relative flex items-center justify-center min-h-screen bg-cover bg-center"
    style="background-image: url('../assets/img/merdeka.jpg');">

    <div class="absolute inset-0 bg-black/50"></div>
    <main class="relative z-10 max-w-3xl px-6 text-center">
      <h1 class="text-3xl md:text-6xl font-bold text-white drop-shadow-lg">
        Selamat datang di <span class="text-blue-500">Jadwalin Warga</span>
      </h1>
      <p class="mt-2 text-lg text-gray-400">
        Jadwalin adalah aplikasi yang membantu Anda mengatur jadwal harian
        dengan mudah dan efisien.
      </p>
      <button id="openModal"
        class="inline-block mt-6 px-6 py-3 bg-blue-500 hover:bg-white hover:text-blue-500 text-white rounded-lg font-medium transition">
        Mulai Sekarang
      </button>
    </main>
  </section>

  <div id="loginModal" class="fixed inset-0 z-50 hidden flex items-center justify-center p-4">
    <!-- Overlay -->
    <div class="modal-overlay absolute inset-0" id="modalOverlay"></div>

    <!-- Modal Content -->
    <div class="relative bg-neutral-800 rounded-lg shadow-xl max-w-md w-full mx-4 modal-enter">
      <!-- Header Modal -->
      <div class="flex justify-between items-center p-6 border-b border-gray-700">
        <h2 class="text-xl font-bold text-white">Login ke Jadwalin</h2>
        <!-- Tombol Tutup -->
        <button id="closeModal" class="text-gray-400 hover:text-white text-2xl">&times;</button>
      </div>

      <!-- Form Login -->
      <form action="../aksi/aksi_login.php" method="POST" class="p-6"> <!-- Submit ke login.php seperti biasa -->
        <div class="mb-4">
          <label for="username" class="block text-sm font-medium text-gray-300 mb-2">Username</label>
          <input type="text" id="username" name="username" required
            class="w-full px-3 py-2 bg-neutral-700 border border-gray-600 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>
        <div class="mb-6">
          <label for="password" class="block text-sm font-medium text-gray-300 mb-2">Password</label>
          <input type="password" id="password" name="password" required
            class="w-full px-3 py-2 bg-neutral-700 border border-gray-600 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>
        <button type="submit"
          class="w-full bg-blue-500 hover:bg-blue-600 text-white font-medium py-2 px-4 rounded-lg transition">
          Masuk
        </button>
      </form>

      <!-- Footer Modal (opsional: link daftar) -->
      <div class="p-6 border-t border-gray-700 text-center">
        <p class="text-sm text-gray-400">Belum punya akun? <a href="#registrasi.php"
            class="text-blue-500 hover:underline">Daftar di
            sini</a></p>
      </div>
    </div>
  </div>

  <!-- Standar Layanan -->
  <!-- Standar Layanan -->
  <section id="about" class="py-20 bg-white px-6"> <!-- from bg-white-700 ke bg-white -->
    <h2 class="text-3xl font-bold text-center text-black"> <!-- from text-black-500 ke text-black -->
      Standar Layanan Warga
    </h2>
    <p class="text-center text-gray-700 max-w-2xl mx-auto mt-4"> <!-- from text-black-300 ke text-gray-700 -->
      Jadwalin adalah aplikasi yang dirancang untuk membantu Anda mengatur
      jadwal harian dengan mudah dan efisien. Dengan antarmuka sederhana dan
      intuitif, Anda dapat dengan cepat menambahkan, mengedit, dan menghapus
      jadwal sesuai kebutuhan Anda.
    </p>
    <div class="overflow-x-auto mt-10">
      <table class="min-w-full border border-blue-700 text-center bg-white rounded-lg overflow-hidden">
        <!-- from bg-white-800 ke bg-white -->
        <thead class="bg-blue-500 text-white"> <!-- dari text-black ke text-white supaya kontras -->
          <tr>
            <th class="px-4 py-3">No</th>
            <th class="px-4 py-3">Jenis Dokumen</th>
            <th class="px-4 py-3">Waktu Penyelesaian</th>
            <th class="px-4 py-3">Keterangan</th>
          </tr>
        </thead>
        <tbody class="divide-y divide-gray-300">
          <!-- dari divide-gray-700 ke divide-gray-300 supaya garis divide lebih halus -->
          <tr class="hover:bg-neutral-200">
            <!-- dari hover:bg-neutral-700 yang sangat gelap ke warna hover yang lebih terang karena latar tabel putih -->
            <td class="px-4 py-3">1</td>
            <td class="px-4 py-3">KTP</td>
            <td class="px-4 py-3">3 Hari Kerja</td>
            <td class="px-4 py-3">Jika dokumen lengkap</td>
          </tr>
          <tr class="hover:bg-neutral-200">
            <td class="px-4 py-3">2</td>
            <td class="px-4 py-3">KK</td>
            <td class="px-4 py-3">2 Hari Kerja</td>
            <td class="px-4 py-3">Jika dokumen lengkap</td>
          </tr>
          <tr class="hover:bg-neutral-200">
            <td class="px-4 py-3">3</td>
            <td class="px-4 py-3">Surat Domisili</td>
            <td class="px-4 py-3">1 Hari Kerja</td>
            <td class="px-4 py-3">Proses cepat</td>
          </tr>
          <tr class="hover:bg-neutral-200">
            <td class="px-4 py-3">4</td>
            <td class="px-4 py-3">Surat Keterangan Usaha</td>
            <td class="px-4 py-3">2 Hari Kerja</td>
            <td class="px-4 py-3">Dibutuhkan izin RT/RW</td>
          </tr>
        </tbody>
      </table>
    </div>
  </section>

  <!-- Berita Section  -->
  <section id="berita" class="py-20 bg-white px-6">
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

      <!-- Card 1 -->
      <div class="bg-white rounded-lg shadow overflow-hidden relative">
        <img src="../assets/img/rafat.jpg" alt="Pelatihan" class="w-full h-48 object-cover" />
        <div class="p-4">
          <h3 class="text-lg font-semibold mb-2">
            <a href="../berita/pelatihan.php" class="hover:underline text-gray-800">
              <!-- dari text-black-200 ke text-gray-800 -->
              PELATIHAN PENDATAAN PENDUDUK DESA PAMULIHAN SUBANG KUNINGAN
            </a>
          </h3>
          <p class="text-gray-600 text-sm">
            Desa Pamulihan, Kecamatan Subang, Kabupaten Kuningan, terus berinovasi dalam meningkatkan layanan...
          </p>
          <p class="mt-2 text-gray-500 text-xs">
            2024-11-12 16:57:33. <span class="text-orange-500">Pelatihan, Data Penduduk</span>
          </p>
        </div>
      </div>

      <!-- Card 2 -->
      <div class="bg-white rounded-lg shadow overflow-hidden relative"> <!-- dari bg-whitw (typo) jadi bg-white -->
        <img src="../assets/img/dana.jpg" alt="Dana Desa" class="w-full h-48 object-cover" />
        <div class="p-4">
          <h3 class="text-lg font-semibold mb-2">
            <a href="../berita/rincian.php" class="hover:underline text-gray-800">
              <!-- dari text-black-200 ke text-gray-800 -->
              RINCIAN PRIORITAS PENGGUNAAN DANA DESA
            </a>
          </h3>
          <p class="text-gray-600 text-sm">
            Di pemerintahan Prabowo tahun 2025, salah satunya adalah program Desa Digital...
          </p>
          <p class="mt-2 text-gray-500 text-xs">
            2024-10-08 15:44:00. <span class="text-orange-500">Berita</span>
          </p>
        </div>
      </div>

      <!-- Card 3 -->
      <div class="bg-white rounded-lg shadow overflow-hidden relative">
        <img src="../assets/img/pangkat-ASN.jpeg" alt="ID Card" class="w-full h-48 object-cover" />
        <div class="p-4">
          <h3 class="text-lg font-semibold mb-2">
            <a href="../berita/mudahnya.php" class="hover:underline text-gray-800">
              <!-- dari text-black-200 ke text-gray-800 -->
              Mudahnya membuat ID CARD Kartu Pegawai tinggal cetak saja
            </a>
          </h3>
          <p class="text-gray-600 text-sm">
            Dengan easydes kita bisa dengan mudah membuat ID CARD Kartu Pegawai tinggal cetak saja...
          </p>
          <p class="mt-2 text-gray-500 text-xs">
            2024-10-08 13:25:38. <span class="text-orange-500">Berita</span>
          </p>
        </div>
      </div>

    </div>
  </section>


  <!-- Footer dengan Informasi Perusahaan dan Peta -->
  <footer class="bg-gray-800 text-gray-300 py-12 px-6 mt-20">
    <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-3 gap-8">

      <!-- Informasi Perusahaan -->
      <div>
        <h3 class="text-xl font-bold mb-4 text-white">Informasi Perusahaan</h3>
        <p class="mb-2">Jadwalin Warga adalah platform digital yang membantu pengelolaan jadwal untuk warga dengan mudah
          dan efisien.</p>
        <p class="mb-2">Alamat: jl.Samarang kec.Samarang kab.Garut</p>
        <p class="mb-2">Telepon: (62) 83807182460</p>
        <p>Email: <a href="mailto:jadwalinwarga@gmail.com"
            class="text-blue-400 hover:underline">jadwalinwarga@gmail.com</a></p>
        <p>Jam Operasi: Senin - Jumat, 08.00 - 17.00 WIB</p>
      </div>

      <!-- Peta Lokasi -->
      <div class="md:col-span-2">
        <h3 class="text-xl font-bold mb-4 text-white">Lokasi Kami</h3>
        <div class="aspect-w-16 aspect-h-9 rounded-lg overflow-hidden shadow-lg">
          <iframe
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3303.668003778176!2d107.8403960741112!3d-7.2160827708498045!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e68ba8e1722dc49%3A0xcad8aa88ea668a6!2sSMK%20Al%20Madani%20Garut!5e1!3m2!1sid!2sid!4v1762995623771!5m2!1sid!2sid"
            width="100%" height="300" style="border:0;" allowfullscreen="" loading="lazy"
            referrerpolicy="no-referrer-when-downgrade" title="Peta Lokasi Jadwalin Warga"></iframe>
        </div>
      </div>
    </div>

    <!-- Hak Cipta -->
    <div class="mt-10 text-center text-gray-500 text-sm">
      &copy; 2024 Jadwalin Warga. All rights reserved.
    </div>
  </footer>

  <script>
    // Feather Icons
    feather.replace();

    // Modal Logic (mirip top up: klik tombol buka, klik luar/tutup tutup)
    const openModalBtn = document.getElementById('openModal');
    const closeModalBtn = document.getElementById('closeModal');
    const modal = document.getElementById('loginModal');
    const overlay = document.getElementById('modalOverlay');

    openModalBtn.addEventListener('click', () => {
      modal.classList.remove('hidden');
      document.body.style.overflow = 'hidden'; // Cegah scroll saat modal terbuka
    });

    closeModalBtn.addEventListener('click', () => {
      modal.classList.add('hidden');
      document.body.style.overflow = 'auto';
    });

    overlay.addEventListener('click', () => {
      modal.classList.add('hidden');
      document.body.style.overflow = 'auto';
    });

    // Opsional: Tutup modal dengan ESC key
    document.addEventListener('keydown', (e) => {
      if (e.key === 'Escape' && !modal.classList.contains('hidden')) {
        modal.classList.add('hidden');
        document.body.style.overflow = 'auto';
      }
    });
  </script>
</body>

</html>