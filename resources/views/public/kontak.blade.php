@extends('layouts.app-public')

@section('title', 'Hubungi Kami - RS Graha Medika')

@section('content')
  <!-- PAGE HEADER BANNER -->
  <section class="hero" style="padding: 4rem 0 3rem 0; text-align: center;">
    <div class="container" style="z-index: 2; position: relative;">
      <span class="badge">Hubungi CS</span>
      <h1 class="hero-title" style="font-size: 2.75rem; margin-bottom: 0.5rem;">Hubungi Kami</h1>
      <p style="max-width: 600px; margin: 0 auto; color: var(--text-medium);">
        Tim Customer Service kami siap melayani berbagai pertanyaan, kritik, saran, serta pendaftaran konsultasi Anda.
      </p>
    </div>
    <div class="hero-bg-shapes">
      <div class="shape shape-1" style="top: -150px; right: 0;"></div>
    </div>
  </section>

  <!-- CONTACT GRID SECTION -->
  <section class="section-padding">
    <div class="container" style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 3rem; align-items: start;">
      
      <!-- Contact Info Cards -->
      <div style="display: flex; flex-direction: column; gap: 1.5rem;">
        <span class="badge" style="width: fit-content;">Informasi Hubung</span>
        <h2 class="section-title" style="text-align: left; margin-bottom: 1rem;">RS Graha Medika Pusat</h2>
        
        <!-- Alamat -->
        <div style="display: flex; gap: 1rem; padding: 1.5rem; background: var(--bg-secondary); border-radius: var(--radius-md); border: 1px solid var(--border-color);">
          <i class="fa-solid fa-location-dot" style="font-size: 1.5rem; color: var(--primary); margin-top: 0.25rem;"></i>
          <div>
            <h4 style="font-size: 1rem; margin-bottom: 0.25rem; color: var(--secondary);">Alamat Utama</h4>
            <p style="font-size: 0.85rem; color: var(--text-medium); margin-bottom: 0; line-height: 1.5;">
              Jl. Graha Medika No. 88, Kav. 12-14, Jakarta Barat, DKI Jakarta, 11620
            </p>
          </div>
        </div>

        <!-- Telepon -->
        <div style="display: flex; gap: 1rem; padding: 1.5rem; background: var(--bg-secondary); border-radius: var(--radius-md); border: 1px solid var(--border-color);">
          <i class="fa-solid fa-phone" style="font-size: 1.5rem; color: var(--primary); margin-top: 0.25rem;"></i>
          <div>
            <h4 style="font-size: 1rem; margin-bottom: 0.25rem; color: var(--secondary);">Telepon & Call Center</h4>
            <p style="font-size: 0.85rem; color: var(--text-medium); margin-bottom: 0; line-height: 1.5;">
              Call Center: (021) 5555-7777<br>IGD 24 Jam Hotline: (021) 8888-9999
            </p>
          </div>
        </div>

        <!-- Email -->
        <div style="display: flex; gap: 1rem; padding: 1.5rem; background: var(--bg-secondary); border-radius: var(--radius-md); border: 1px solid var(--border-color);">
          <i class="fa-solid fa-envelope" style="font-size: 1.5rem; color: var(--primary); margin-top: 0.25rem;"></i>
          <div>
            <h4 style="font-size: 1rem; margin-bottom: 0.25rem; color: var(--secondary);">Layanan Email</h4>
            <p style="font-size: 0.85rem; color: var(--text-medium); margin-bottom: 0; line-height: 1.5;">
              info@grahamedika.com<br>marketing@grahamedika.com
            </p>
          </div>
        </div>
      </div>

      <!-- Contact Message Form -->
      <div style="background-color: var(--bg-primary); border: 1px solid var(--border-color); border-radius: var(--radius-md); padding: 2.5rem; box-shadow: var(--shadow-sm);">
        <span class="badge" style="margin-bottom: 1rem;">Kirim Pesan</span>
        <h3 style="font-size: 1.35rem; margin-bottom: 1.5rem; color: var(--secondary);">Formulir Kontak</h3>
        
        <form onsubmit="event.preventDefault(); alert('Terima kasih! Pesan Anda telah terkirim dan akan ditinjau oleh tim kami.'); this.reset();">
          <div class="form-group">
            <label>Nama Lengkap Anda</label>
            <input type="text" placeholder="Tulis nama lengkap..." required class="input-style">
          </div>
          <div class="form-group">
            <label>Alamat Email Aktif</label>
            <input type="email" placeholder="email@contoh.com" required class="input-style">
          </div>
          <div class="form-group">
            <label>Perihal Pesan</label>
            <input type="text" placeholder="Tulis subjek perihal..." required class="input-style">
          </div>
          <div class="form-group">
            <label>Isi Pesan Anda</label>
            <textarea rows="4" placeholder="Tulis isi pesan Anda secara lengkap di sini..." required class="input-style"></textarea>
          </div>
          <button type="submit" class="btn btn-primary" style="width: 100%; margin-top: 1rem;">Kirim Pesan CS</button>
        </form>
      </div>

    </div>
  </section>
@endsection
