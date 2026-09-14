@extends('layouts.app-public')

@section('title', 'Tentang Kami - RS Graha Medika')

@section('content')
  <!-- PAGE HEADER BANNER -->
  <section class="hero" style="padding: 4rem 0 3rem 0; text-align: center;">
    <div class="container" style="z-index: 2; position: relative;">
      <span class="badge">Profil Rumah Sakit</span>
      <h1 class="hero-title" style="font-size: 2.75rem; margin-bottom: 0.5rem;">Tentang Kami</h1>
      <p style="max-width: 600px; margin: 0 auto; color: var(--text-medium);">
        Kenali lebih dekat visi, misi, nilai, dan sejarah perjalanan RS Graha Medika dalam mengabdi pada kesehatan bangsa.
      </p>
    </div>
    <div class="hero-bg-shapes">
      <div class="shape shape-1" style="top: -150px; right: 0;"></div>
    </div>
  </section>

  <!-- SEJARAH SINGKAT -->
  <section class="section-padding">
    <div class="container about-grid" style="display: grid; grid-template-columns: 1.2fr 0.8fr; gap: 3rem; align-items: center;">
      <div>
        <span class="badge">Sejarah Perjalanan</span>
        <h2 class="section-title" style="text-align: left; margin-bottom: 1.5rem;">Mengabdi Sejak 2016</h2>
        <p>
          RS Graha Medika didirikan pada tahun 2016 di bawah naungan PT Graha Medika Nusantara. Bermula dari sebuah Klinik Spesialis Rawat Jalan, tingginya kepercayaan masyarakat mendorong kami untuk berkembang menjadi Rumah Sakit Umum tipe C pada tahun 2019.
        </p>
        <p>
          Dalam kurun waktu yang relatif singkat, kami terus melakukan ekspansi fisik gedung dan penambahan kapasitas tempat tidur rawat inap serta peningkatan sarana diagnostik modern demi mengakomodasi kebutuhan pelayanan medis yang komprehensif.
        </p>
        <p>
          Kini, dengan dukungan puluhan dokter spesialis terbaik dan ratusan tenaga perawat profesional, kami siap melayani ribuan pasien rawat jalan dan rawat inap setiap bulannya dengan standar mutu internasional yang telah terakreditasi Paripurna oleh KARS.
        </p>
      </div>
      <div>
        <div style="background-color: var(--bg-secondary); border-radius: var(--radius-lg); overflow: hidden; border: 1px solid var(--border-color); display: flex; flex-direction: column; height: 100%;">
          <div style="padding: 2.5rem; text-align: center; flex-grow: 1; display: flex; flex-direction: column; justify-content: center;">
            <i class="fa-solid fa-hospital" style="font-size: 4rem; color: var(--primary); margin-bottom: 1.5rem;"></i>
            <h3 style="font-size: 1.5rem; margin-bottom: 1rem;">Komitmen Mutu & Keselamatan</h3>
            <p style="font-size: 0.95rem;">
              Kami meyakini bahwa mutu pelayanan yang prima berakar dari kedisiplinan dan rasa tanggung jawab yang tinggi terhadap keselamatan pasien (Patient Safety). Oleh sebab itu, seluruh staf kami rutin menjalani pelatihan berkelanjutan.
            </p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- VISI MISI -->
  <section class="section-padding" style="background-color: var(--bg-secondary);">
    <div class="container">
      <div class="text-center">
        <span class="badge">Haluan Organisasi</span>
        <h2 class="section-title">Visi & Misi</h2>
        <p class="section-subtitle">Arah langkah kami untuk memberikan pelayanan kesehatan berkualitas tertinggi.</p>
      </div>

      <div class="vm-grid">
        <!-- Visi -->
        <div class="vm-box">
          <h3><i class="fa-solid fa-eye"></i> Visi Kami</h3>
          <p style="font-size: 1.1rem; line-height: 1.7; color: var(--secondary-light); font-weight: 500;">
            "Menjadi rumah sakit pilihan utama masyarakat yang unggul dalam pelayanan, terpercaya dalam mutu, dan bersahabat dalam pelayanan di wilayah DKI Jakarta dan sekitarnya."
          </p>
        </div>

        <!-- Misi -->
        <div class="vm-box">
          <h3><i class="fa-solid fa-bullseye"></i> Misi Kami</h3>
          <ul style="text-align: left; padding-left: 1.25rem;">
            <li style="margin-bottom: 0.75rem;">Menyelenggarakan pelayanan medis yang komprehensif, aman, bermutu tinggi, dan berorientasi pada keselamatan pasien.</li>
            <li style="margin-bottom: 0.75rem;">Mengembangkan sarana prasarana serta teknologi kedokteran terkini secara berkelanjutan.</li>
            <li style="margin-bottom: 0.75rem;">Menciptakan lingkungan kerja yang kondusif, dinamis, serta mengutamakan kerja sama tim yang harmonis.</li>
            <li style="margin-bottom: 0.75rem;">Meningkatkan kompetensi dan profesionalisme sumber daya manusia melalui pendidikan dan pelatihan berkelanjutan.</li>
          </ul>
        </div>
      </div>
    </div>
  </section>

  <!-- VALUE "CARE" SECTION -->
  <section class="section-padding">
    <div class="container">
      <div class="text-center">
        <span class="badge">Budaya Kerja</span>
        <h2 class="section-title">Nilai Utama Kami: CARE</h2>
        <p class="section-subtitle">Nilai-nilai dasar yang diinternalisasi oleh seluruh civitas RS Graha Medika.</p>
      </div>

      <div class="values-grid">
        <!-- C -->
        <div class="value-card">
          <div class="value-letter">C</div>
          <h3>Compassion</h3>
          <p>Melayani pasien dengan ketulusan hati, kehangatan, rasa empati, dan penuh kasih sayang demi kenyamanan kesembuhan.</p>
        </div>

        <!-- A -->
        <div class="value-card">
          <div class="value-letter">A</div>
          <h3>Accuracy</h3>
          <p>Mengutamakan ketepatan dan ketelitian tinggi dalam mendiagnosis serta menentukan tindakan terapi medis pasien.</p>
        </div>

        <!-- R -->
        <div class="value-card">
          <div class="value-letter">R</div>
          <h3>Respect</h3>
          <p>Menghormati hak-hak pasien serta memperlakukan setiap individu secara adil tanpa membeda-bedakan status sosial.</p>
        </div>

        <!-- E -->
        <div class="value-card">
          <div class="value-letter">E</div>
          <h3>Excellence</h3>
          <p>Bertekad memberikan hasil kinerja terbaik dengan menjunjung tinggi profesionalisme serta integritas profesi.</p>
        </div>
      </div>
    </div>
  </section>
@endsection
