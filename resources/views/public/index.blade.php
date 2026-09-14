@extends('layouts.app-public')

@section('title', 'RS Graha Medika - Pelayanan Kesehatan Premium & Terpercaya')

@section('content')
  <!-- HERO SECTION (Mockup Anaverse Layout) -->
  <section class="hero">
    <div class="container hero-grid">
      <div class="hero-content">
        <div class="badge">
          <i class="fa-solid fa-shield-halved"></i> Kesehatan Anda, Prioritas Kami
        </div>
        <h1 class="hero-title">Pelayanan Terbaik untuk <br><span>Kesehatan Anda</span> dan Keluarga</h1>
        <p class="hero-desc">
          Kami hadir dengan layanan medis berkualitas tinggi, tim dokter spesialis berpengalaman, dan fasilitas diagnostik modern untuk memberikan perawatan terbaik dan pemulihan kesehatan optimal.
        </p>
        <div class="hero-actions">
          <a href="{{ route('layanan') }}" class="btn btn-primary">Lihat Layanan <i class="fa-solid fa-arrow-right"></i></a>
          <a href="{{ route('reservasi') }}" class="btn btn-secondary"><i class="fa-solid fa-calendar-check"></i> Buat Janji Temu</a>
        </div>
      </div>
      
      <div class="hero-image-wrapper">
        <img src="{{ asset('assets/images/hospital_building.jpg') }}" alt="RS Graha Medika Building" class="hero-image">
      </div>
    </div>
  </section>

  <!-- FLOATING STATS PANEL -->
  <section style="position: relative; z-index: 15;">
    <div class="container">
      <div class="hero-stats-panel">
        
        <div class="hero-stat-item">
          <div class="hero-stat-circle flex-center"><i class="fa-solid fa-user-doctor"></i></div>
          <div class="hero-stat-info">
            <h3>15+</h3>
            <p>Dokter Spesialis</p>
          </div>
        </div>

        <div class="hero-stat-item">
          <div class="hero-stat-circle flex-center"><i class="fa-solid fa-users"></i></div>
          <div class="hero-stat-info">
            <h3>25.000+</h3>
            <p>Pasien Terlayani</p>
          </div>
        </div>

        <div class="hero-stat-item">
          <div class="hero-stat-circle flex-center"><i class="fa-solid fa-bed-pulse"></i></div>
          <div class="hero-stat-info">
            <h3>120+</h3>
            <p>Kamar Perawatan</p>
          </div>
        </div>

        <div class="hero-stat-item">
          <div class="hero-stat-circle flex-center"><i class="fa-solid fa-star"></i></div>
          <div class="hero-stat-info">
            <h3>98%</h3>
            <p>Kepuasan Pasien</p>
          </div>
        </div>

      </div>
    </div>
  </section>

  <!-- TENTANG KAMI SECTION -->
  <section class="section-padding" style="margin-top: 1rem;">
    <div class="container about-section-grid">
      <div>
        <img src="{{ asset('assets/images/hospital_building.jpg') }}" alt="Interior Layanan RS Graha Medika" style="border-radius: var(--radius-lg); box-shadow: var(--shadow-md); border: 4px solid var(--text-white); width: 100%;">
      </div>
      <div>
        <div class="badge"><i class="fa-solid fa-circle-info"></i> Tentang Kami</div>
        <h2 class="section-title">Rumah Sakit <span>Graha Medika</span> Untuk Hidup yang Lebih Sehat</h2>
        <p>
          PT Graha Medika Nusantara mendedikasikan diri untuk menghadirkan sarana pengobatan yang aman, bermutu tinggi, dan bersahabat bagi Anda. Kami terus bersinergi membangun ekosistem kesehatan terpadu demi kenyamanan pelayanan medis pasien.
        </p>
        
        <div class="about-bullets-grid">
          
          <div class="about-bullet-item">
            <div class="about-bullet-icon flex-center"><i class="fa-solid fa-clock"></i></div>
            <div>
              <h4>Pelayanan 24 Jam</h4>
              <p>Layanan IGD, Farmasi & Laboratorium Non-stop.</p>
            </div>
          </div>

          <div class="about-bullet-item">
            <div class="about-bullet-icon flex-center"><i class="fa-solid fa-user-doctor"></i></div>
            <div>
              <h4>Tenaga Medis Ahli</h4>
              <p>Dokter spesialis dan perawat berpengalaman.</p>
            </div>
          </div>

          <div class="about-bullet-item">
            <div class="about-bullet-icon flex-center"><i class="fa-solid fa-hospital-user"></i></div>
            <div>
              <h4>Fasilitas Modern</h4>
              <p>Teknologi diagnostik & tindakan bedah terkini.</p>
            </div>
          </div>

          <div class="about-bullet-item">
            <div class="about-bullet-icon flex-center"><i class="fa-solid fa-hand-holding-heart"></i></div>
            <div>
              <h4>Perawatan Berkualitas</h4>
              <p>Mengutamakan keselamatan & kesembuhan pasien.</p>
            </div>
          </div>

        </div>
      </div>
    </div>
  </section>

  <!-- LAYANAN KAMI SECTION -->
  <section class="section-padding layanan-section">
    <div class="container">
      <div style="display: flex; justify-content: space-between; align-items: flex-end; margin-bottom: 2.5rem;">
        <div>
          <span class="badge"><i class="fa-solid fa-heart-pulse"></i> Layanan Kami</span>
          <h2 class="section-title" style="margin-bottom: 0;">Layanan Kesehatan Unggulan</h2>
        </div>
        <a href="{{ route('layanan') }}" style="color: var(--primary); font-weight: 700; display: inline-flex; align-items: center; gap: 0.5rem; font-size: 0.95rem;">
          Lihat Semua Layanan <i class="fa-solid fa-chevron-right"></i>
        </a>
      </div>

      <div class="layanan-grid">
        <!-- Card 1 -->
        <div class="layanan-card">
          <div class="layanan-icon-box flex-center"><i class="fa-solid fa-stethoscope"></i></div>
          <h3>Poli Spesialis</h3>
          <p>Konsultasi rawat jalan dokter spesialis.</p>
        </div>
        <!-- Card 2 -->
        <div class="layanan-card">
          <div class="layanan-icon-box flex-center"><i class="fa-solid fa-bed"></i></div>
          <h3>Rawat Inap</h3>
          <p>Kamar pemulihan VIP & Standard steril.</p>
        </div>
        <!-- Card 3 -->
        <div class="layanan-card">
          <div class="layanan-icon-box flex-center"><i class="fa-solid fa-truck-medical"></i></div>
          <h3>IGD 24 Jam</h3>
          <p>Pertolongan darurat gawat medis cepat.</p>
        </div>
        <!-- Card 4 -->
        <div class="layanan-card">
          <div class="layanan-icon-box flex-center"><i class="fa-solid fa-x-ray"></i></div>
          <h3>Radiologi</h3>
          <p>Pencitraan CT-Scan, X-Ray & USG 4D.</p>
        </div>
        <!-- Card 5 -->
        <div class="layanan-card">
          <div class="layanan-icon-box flex-center"><i class="fa-solid fa-microscope"></i></div>
          <h3>Laboratorium</h3>
          <p>Analisis klinis & patologi akurat.</p>
        </div>
        <!-- Card 6 -->
        <div class="layanan-card">
          <div class="layanan-icon-box flex-center"><i class="fa-solid fa-capsules"></i></div>
          <h3>Farmasi</h3>
          <p>Apotek RS penyedia obat legal 24 jam.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- TIM DOKTER SPESIALIS SECTION (MySQL Driven) -->
  <section class="section-padding">
    <div class="container">
      <div style="display: grid; grid-template-columns: 0.8fr 1.2fr; gap: 3rem; align-items: center; margin-bottom: 2rem;">
        <div>
          <span class="badge"><i class="fa-solid fa-user-doctor"></i> Dokter Kami</span>
          <h2 class="section-title" style="margin-bottom: 1rem;">Dokter Spesialis Berpengalaman</h2>
          <p style="color: var(--text-medium); font-size: 0.95rem; margin-bottom: 2rem;">
            Tim dokter spesialis kami siap memberikan konsultasi & penanganan medis terbaik secara tepat dan informatif.
          </p>
          <a href="{{ route('dokter') }}" class="btn btn-primary">Lihat Semua Dokter <i class="fa-solid fa-arrow-right"></i></a>
        </div>
        
        <!-- Doctors Carousel preview container (MySQL Driven) -->
        <div class="doctors-carousel-wrapper" style="grid-template-columns: repeat(2, 1fr); gap: 1.5rem; display: grid;">
          @foreach($doctors as $doc)
            <div class="doctor-card" style="margin-bottom: 0;">
              <div class="doctor-img-container">
                <i class="fa-solid {{ $doc->avatar_icon }}"></i>
              </div>
              <div class="doctor-card-content">
                <span class="doctor-card-spec">{{ $doc->spec_label }}</span>
                <h3 class="doctor-card-name">{{ $doc->name }}</h3>
                <div class="doctor-rating">
                  <i class="fa-solid fa-star"></i>
                  <span>{{ number_format($doc->rating, 1) }}</span>
                </div>
                <div class="doctor-card-fee">
                  <span>Tarif Konsultasi</span>
                  <strong>Rp {{ number_format($doc->fee, 0, ',', '.') }}</strong>
                </div>
                <a href="{{ route('reservasi', ['doc' => $doc->id]) }}" class="btn btn-primary btn-sm" style="margin-top: 0.5rem; text-align: center;">Pesan Jasa</a>
              </div>
            </div>
          @endforeach
        </div>
      </div>
    </div>
  </section>

  <!-- FASILITAS MODERN SECTION (Dark panel) -->
  <section class="section-padding facilities-dark-section">
    <div class="container">
      <div class="text-center">
        <span class="badge" style="background-color: rgba(255,255,255,0.05); color: var(--accent); border-color: rgba(255,255,255,0.1);"><i class="fa-solid fa-hospital"></i> Fasilitas Modern</span>
        <h2 class="section-title">Fasilitas Modern untuk Perawatan Terbaik</h2>
        <p class="section-subtitle">Didukung dengan teknologi medis modern yang steril untuk kenyamanan & keselamatan pasien.</p>
      </div>

      <div class="facilities-grid">
        
        <div class="facility-card-dark">
          <div class="facility-dark-icon flex-center"><i class="fa-solid fa-bed-pulse"></i></div>
          <h3>Ruang ICU</h3>
          <p>Pemantauan intensif pasien kritis.</p>
        </div>

        <div class="facility-card-dark">
          <div class="facility-dark-icon flex-center"><i class="fa-solid fa-house-chimney-medical"></i></div>
          <h3>Kamar VIP</h3>
          <p>Kamar rawat inap VIP berfasilitas suite.</p>
        </div>

        <div class="facility-card-dark">
          <div class="facility-dark-icon flex-center"><i class="fa-solid fa-square-h"></i></div>
          <h3>Ruang Operasi</h3>
          <p>Bedah bedah steril peralatan canggih.</p>
        </div>

        <div class="facility-card-dark">
          <div class="facility-dark-icon flex-center"><i class="fa-solid fa-microscope"></i></div>
          <h3>Laboratorium</h3>
          <p>Tes patologi klinis modern lengkap.</p>
        </div>

        <div class="facility-card-dark">
          <div class="facility-dark-icon flex-center"><i class="fa-solid fa-truck-medical"></i></div>
          <h3>Ambulans 24 Jam</h3>
          <p>Transportasi medis darurat armada cepat.</p>
        </div>

      </div>
    </div>
  </section>

  <!-- BERITA & TIPS KESEHATAN SECTION -->
  <section class="section-padding articles-section">
    <div class="container">
      <div style="display: flex; justify-content: space-between; align-items: flex-end; margin-bottom: 2.5rem;">
        <div>
          <span class="badge"><i class="fa-solid fa-newspaper"></i> Berita Medis</span>
          <h2 class="section-title" style="margin-bottom: 0;">Berita & Tips Kesehatan</h2>
        </div>
        <a href="#" style="color: var(--primary); font-weight: 700; display: inline-flex; align-items: center; gap: 0.5rem; font-size: 0.95rem;">
          Lihat Semua Berita <i class="fa-solid fa-chevron-right"></i>
        </a>
      </div>

      <div class="articles-grid">
        
        <!-- Art 1 -->
        <article class="article-card-new">
          <div class="article-img-new flex-center"><i class="fa-solid fa-heart-pulse"></i></div>
          <div class="article-body-new">
            <div class="article-meta-new"><span>30 Juli 2026</span><span>Jantung</span></div>
            <h3 class="article-title-new">Tips Menjaga Kesehatan Jantung Setiap Hari</h3>
            <p class="article-desc-new">Lakukan olahraga ringan secara rutin, hindari lemak berlebih, dan kurangi stres untuk menjaga kesehatan otot jantung Anda...</p>
            <a href="#" class="article-link-new">Baca Selengkapnya <i class="fa-solid fa-arrow-right"></i></a>
          </div>
        </article>

        <!-- Art 2 -->
        <article class="article-card-new">
          <div class="article-img-new flex-center"><i class="fa-solid fa-baby"></i></div>
          <div class="article-body-new">
            <div class="article-meta-new"><span>25 Juli 2026</span><span>Anak</span></div>
            <h3 class="article-title-new">Pentingnya Imunisasi untuk Anak Sejak Dini</h3>
            <p class="article-desc-new">Imunisasi rutin sangat krusial dalam membangun ketahanan tubuh anak terhadap ancaman infeksi penyakit berbahaya menular...</p>
            <a href="#" class="article-link-new">Baca Selengkapnya <i class="fa-solid fa-arrow-right"></i></a>
          </div>
        </article>

        <!-- Art 3 -->
        <article class="article-card-new">
          <div class="article-img-new flex-center"><i class="fa-solid fa-apple-whole"></i></div>
          <div class="article-body-new">
            <div class="article-meta-new"><span>18 Juli 2026</span><span>Nutrisi</span></div>
            <h3 class="article-title-new">Makanan Sehat untuk Gaya Hidup Seimbang</h3>
            <p class="article-desc-new">Konsumsi serat buah dan sayuran segar secara seimbang untuk menyuplai nutrisi, meningkatkan daya tahan, serta metabolisme...</p>
            <a href="#" class="article-link-new">Baca Selengkapnya <i class="fa-solid fa-arrow-right"></i></a>
          </div>
        </article>

        <!-- Art 4 -->
        <article class="article-card-new">
          <div class="article-img-new flex-center"><i class="fa-solid fa-user-shield"></i></div>
          <div class="article-body-new">
            <div class="article-meta-new"><span>10 Juli 2026</span><span>Lansia</span></div>
            <h3 class="article-title-new">Perawatan Terbaik untuk Orang Tua Tersayang</h3>
            <p class="article-desc-new">Ketahui langkah-langkah penanganan geriatri mandiri agar orang tua tetap aktif, bugar, dan bahagia menjalani masa tua...</p>
            <a href="#" class="article-link-new">Baca Selengkapnya <i class="fa-solid fa-arrow-right"></i></a>
          </div>
        </article>

      </div>
    </div>
  </section>

  <!-- CTA BANNER BUTUH BANTUAN SECTION -->
  <section class="container" style="margin-bottom: 3rem;">
    <div class="cta-banner-section">
      <div class="cta-banner-grid">
        <div class="cta-banner-content">
          <h2>Butuh Bantuan Medis Segera?</h2>
          <p>Tim gawat darurat dan ambulans IGD kami siap melayani Anda 24 jam sehari, 7 hari seminggu.</p>
        </div>
        
        <div class="cta-phone-card">
          <div class="cta-phone-icon flex-center"><i class="fa-solid fa-phone-volume"></i></div>
          <div class="cta-phone-info">
            <span>Hubungi Kami 24 Jam</span>
            <div class="cta-phone-num">(021) 5555-7777</div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection
