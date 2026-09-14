@extends('layouts.app-public')

@section('title', 'Layanan Medis - RS Graha Medika')

@section('content')
  <!-- PAGE HEADER BANNER -->
  <section class="hero" style="padding: 4rem 0 3rem 0; text-align: center;">
    <div class="container" style="z-index: 2; position: relative;">
      <span class="badge">Fasilitas & Layanan</span>
      <h1 class="hero-title" style="font-size: 2.75rem; margin-bottom: 0.5rem;">Layanan Medis</h1>
      <p style="max-width: 600px; margin: 0 auto; color: var(--text-medium);">
        RS Graha Medika menyediakan layanan kesehatan yang komprehensif, ditunjang peralatan diagnostik modern dan dokter spesialis berpengalaman.
      </p>
    </div>
    <div class="hero-bg-shapes">
      <div class="shape shape-2" style="bottom: -150px; left: 0;"></div>
    </div>
  </section>

  <!-- DETAIL LAYANAN UNGGULAN -->
  <section class="section-padding">
    <div class="container" style="display: flex; flex-direction: column; gap: 4rem;">
      
      <!-- Layanan 1 -->
      <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 3rem; align-items: center;">
        <div>
          <span class="badge">Layanan Utama</span>
          <h2 class="section-title" style="text-align: left; margin-bottom: 1rem;">Instalasi Gawat Darurat (IGD) 24 Jam</h2>
          <p>
            Layanan penanganan darurat gawat medis cepat siap melayani 24 jam sehari, 7 hari seminggu. Tim dokter dan perawat triage kami terlatih menangani berbagai kasus trauma, gangguan kardiovaskular, pernapasan, dan kedaruratan anak secara cepat.
          </p>
          <ul style="padding-left: 1.25rem; margin-bottom: 1.5rem;">
            <li style="margin-bottom: 0.5rem;">Armada Ambulans dengan peralatan resusitasi lengkap.</li>
            <li style="margin-bottom: 0.5rem;">Dokter jaga bersertifikasi ATLS/ACLS standby di tempat.</li>
            <li style="margin-bottom: 0.5rem;">Akses langsung ke ruang tindakan bedah steril darurat.</li>
          </ul>
        </div>
        <div>
          <div style="background-color: var(--bg-secondary); border-radius: var(--radius-lg); padding: 3rem; border: 1px solid var(--border-color); text-align: center;">
            <i class="fa-solid fa-truck-medical" style="font-size: 4rem; color: var(--primary); margin-bottom: 1.5rem;"></i>
            <h3 style="font-size: 1.25rem; margin-bottom: 0.5rem;">Call Center IGD</h3>
            <p style="font-weight: 700; font-size: 1.5rem; color: var(--danger); margin-bottom: 0;">(021) 8888-9999</p>
          </div>
        </div>
      </div>

      <!-- Layanan 2 -->
      <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 3rem; align-items: center;">
        <div style="order: 2;">
          <span class="badge">Rawat Jalan</span>
          <h2 class="section-title" style="text-align: left; margin-bottom: 1rem;">Poliklinik Spesialis Terpadu</h2>
          <p>
            Menyediakan konsultasi medis rawat jalan dengan jadwal praktek yang teratur dari puluhan dokter spesialis berpengalaman. Memiliki sistem pendaftaran online (APM) terpadu untuk efisiensi antrean pasien.
          </p>
          <ul style="padding-left: 1.25rem; margin-bottom: 1.5rem;">
            <li style="margin-bottom: 0.5rem;">Poli Anak (Pediatri) & Poli Kandungan (Obgyn).</li>
            <li style="margin-bottom: 0.5rem;">Poli Penyakit Dalam & Poli Jantung (Kardiologi).</li>
            <li style="margin-bottom: 0.5rem;">Poli Bedah Umum & Poliklinik Gigi Spesialis.</li>
          </ul>
          <a href="{{ route('reservasi') }}" class="btn btn-primary">Daftar Antrean Online</a>
        </div>
        <div style="order: 1;">
          <div style="background-color: var(--bg-secondary); border-radius: var(--radius-lg); padding: 3rem; border: 1px solid var(--border-color); text-align: center;">
            <i class="fa-solid fa-user-doctor" style="font-size: 4rem; color: var(--primary); margin-bottom: 1.5rem;"></i>
            <h3 style="font-size: 1.25rem; margin-bottom: 0.5rem;">Poliklinik Buka</h3>
            <p style="font-size: 1rem; color: var(--text-medium);">Senin s/d Sabtu<br>08:00 - 20:00 WIB</p>
          </div>
        </div>
      </div>

      <!-- Layanan 3 -->
      <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 3rem; align-items: center;">
        <div>
          <span class="badge">Rawat Inap</span>
          <h2 class="section-title" style="text-align: left; margin-bottom: 1rem;">Kamar Rawat Inap VIP & Standard</h2>
          <p>
            Kamar pemulihan rawat inap didesain dengan tingkat higienis yang tinggi, sirkulasi udara steril, dan suasana tenang untuk menunjang penyembuhan pasien secara optimal.
          </p>
          <ul style="padding-left: 1.25rem; margin-bottom: 1.5rem;">
            <li style="margin-bottom: 0.5rem;">Kamar VIP Suite (Sofa, TV, Kulkas, Kamar Mandi Dalam).</li>
            <li style="margin-bottom: 0.5rem;">Kamar Kelas 1, 2, dan 3 yang bersih dan steril.</li>
            <li style="margin-bottom: 0.5rem;">Pemantauan tim dokter visite & perawat 24 jam non-stop.</li>
          </ul>
        </div>
        <div>
          <div style="background-color: var(--bg-secondary); border-radius: var(--radius-lg); padding: 3rem; border: 1px solid var(--border-color); text-align: center;">
            <i class="fa-solid fa-bed" style="font-size: 4rem; color: var(--primary); margin-bottom: 1.5rem;"></i>
            <h3 style="font-size: 1.25rem; margin-bottom: 0.5rem;">Ketersediaan Bed</h3>
            <p style="font-size: 1rem; color: var(--text-medium);">Total 120+ Bed Perawatan<br>VIP, Kelas 1, 2, dan Kelas 3</p>
          </div>
        </div>
      </div>

    </div>
  </section>
@endsection
