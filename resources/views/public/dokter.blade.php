@extends('layouts.app-public')

@section('title', 'Cari Dokter & Jadwal Praktek - RS Graha Medika')

@section('content')
  <!-- PAGE HEADER BANNER -->
  <section class="hero" style="padding: 4rem 0 3rem 0; text-align: center;">
    <div class="container" style="z-index: 2; position: relative;">
      <span class="badge">Direktori Dokter</span>
      <h1 class="hero-title" style="font-size: 2.75rem; margin-bottom: 0.5rem;">Cari Dokter & Jadwal</h1>
      <p style="max-width: 600px; margin: 0 auto; color: var(--text-medium);">
        Temukan jadwal praktek dokter spesialis anak, kandungan, penyakit dalam, jantung, bedah, dan gigi di RS Graha Medika.
      </p>
    </div>
    <div class="hero-bg-shapes">
      <div class="shape shape-1" style="top: -150px; right: 0;"></div>
    </div>
  </section>

  <!-- DOCTOR DIRECTORY CONTAINER -->
  <section class="section-padding">
    <div class="container">
      
      <!-- Filter and Search Bar Wrapper -->
      <div class="doctor-search-wrapper" style="margin-bottom: 3rem;">
        <div class="search-form-grid" style="display: grid; grid-template-columns: 1fr 1fr; gap: 2rem;">
          <!-- Search input -->
          <div class="form-group">
            <label for="searchDoctorName">Cari Nama Dokter</label>
            <div style="position: relative;">
              <input type="text" id="searchDoctorName" class="input-style" placeholder="Tulis nama dokter, misal: dr. Adrian..." style="padding-left: 2.5rem;">
              <i class="fa-solid fa-magnifying-glass" style="position: absolute; left: 1rem; top: 50%; transform: translateY(-50%); color: var(--text-light);"></i>
            </div>
          </div>
          
          <!-- Polyclinic Filter -->
          <div class="form-group">
            <label for="filterPolyclinic">Pilih Poliklinik / Spesialisasi</label>
            <select id="filterPolyclinic" class="input-style">
              <option value="all">Semua Poliklinik</option>
              <option value="anak">Spesialis Anak (Pediatri)</option>
              <option value="kandungan">Spesialis Kandungan & Kebidanan (OBGYN)</option>
              <option value="dalam">Spesialis Penyakit Dalam</option>
              <option value="jantung">Spesialis Jantung & Pembuluh Darah</option>
              <option value="bedah">Spesialis Bedah Umum</option>
              <option value="gigi">Dokter Gigi & Mulut</option>
            </select>
          </div>
        </div>
      </div>

      <!-- Doctors Grid (Populated dynamically via app.js using INITIAL_DOCTORS) -->
      <div class="doctors-grid" id="doctorsGrid" style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 2rem;">
        <div class="doctor-card" style="grid-column: 1 / -1; text-align: center; padding: 3rem;">
          <h3 class="doctor-name">Memuat Data Dokter...</h3>
          <p style="color: var(--text-light); margin-bottom: 0;">Menghubungkan ke database medis...</p>
        </div>
      </div>

    </div>
  </section>
@endsection

@section('scripts')
<script>
  // Expose MySQL doctors to app.js for instant client-side search & filtering
  window.INITIAL_DOCTORS = @json($doctors);
</script>
@endsection
