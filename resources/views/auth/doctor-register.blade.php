<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Registrasi Dokter Baru - RS Graha Medika</title>
  <meta name="description" content="Gabung sebagai bagian dari tim dokter spesialis profesional RS Graha Medika. Daftarkan jadwal dan poliklinik Anda secara mandiri.">
  
  <!-- CSS Stylesheet -->
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
  
  <!-- FontAwesome Icons CDN -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body style="background: linear-gradient(135deg, hsl(195, 85%, 96%) 0%, hsl(210, 30%, 96%) 100%); min-height: 100vh; display: flex; align-items: center; justify-content: center; padding: 2rem 0;">

  <div class="container" style="max-width: 600px; padding: 0 1rem;">
    
    <!-- Register Card -->
    <div style="background-color: var(--bg-primary); border-radius: var(--radius-lg); padding: 3rem 2.5rem; box-shadow: var(--shadow-lg); border: 1px solid var(--border-color); width: 100%;">
      
      <!-- Logo -->
      <div style="display: flex; flex-direction: column; align-items: center; margin-bottom: 2.5rem; text-align: center;">
        <a href="{{ route('home') }}" class="logo" style="margin-bottom: 0.75rem;">
          <img src="{{ asset('images/logo.png') }}" alt="Logo Graha Medika" style="height: 70px; width: auto;">
          <div class="logo-text">
            Graha Medika
            <span>Rumah Sakit</span>
          </div>
        </a>
        <h2 style="font-size: 1.5rem; color: var(--secondary-dark); margin-top: 0.5rem;">Registrasi Akun Dokter</h2>
        <p style="font-size: 0.85rem; color: var(--text-light); margin-top: 0.25rem;">Daftarkan diri Anda untuk menjadi bagian dari Tim Medis RSGM</p>
      </div>

      <!-- Laravel Validation Errors -->
      @if($errors->any())
        <div style="background-color: var(--danger-light); border-left: 4px solid var(--danger); padding: 1rem; border-radius: var(--radius-sm); margin-bottom: 1.5rem; color: var(--danger); font-size: 0.85rem;">
          <i class="fa-solid fa-circle-exclamation" style="margin-right: 0.5rem;"></i>
          <strong>Gagal Mendaftar:</strong>
          <ul style="margin: 0.25rem 0 0 1rem; padding: 0;">
            @foreach($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif

      <form method="POST" action="{{ route('doctor.register') }}">
        @csrf
        
        <!-- Full Name -->
        <div class="form-group" style="margin-bottom: 1.25rem;">
          <label for="name">Nama Lengkap Dokter (Lengkap dengan Gelar Spesialis)</label>
          <div style="position: relative;">
            <input type="text" id="name" name="name" class="input-style" placeholder="Contoh: dr. Adrian Sp.A" value="{{ old('name') }}" required style="padding-left: 2.5rem;">
            <i class="fa-solid fa-user-doctor" style="position: absolute; left: 1rem; top: 50%; transform: translateY(-50%); color: var(--text-light);"></i>
          </div>
        </div>

        <!-- Email & WhatsApp Phone -->
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem; margin-bottom: 1.25rem;">
          <div class="form-group">
            <label for="email">Alamat Email Resmi</label>
            <div style="position: relative;">
              <input type="email" id="email" name="email" class="input-style" placeholder="email@grahamedika.com" value="{{ old('email') }}" required style="padding-left: 2.5rem;">
              <i class="fa-regular fa-envelope" style="position: absolute; left: 1rem; top: 50%; transform: translateY(-50%); color: var(--text-light);"></i>
            </div>
          </div>
          <div class="form-group">
            <label for="phone">Nomor WhatsApp Aktif</label>
            <div style="position: relative;">
              <input type="tel" id="phone" name="phone" class="input-style" placeholder="Contoh: 0812345..." value="{{ old('phone') }}" required style="padding-left: 2.5rem;">
              <i class="fa-brands fa-whatsapp" style="position: absolute; left: 1rem; top: 50%; transform: translateY(-50%); color: var(--text-light);"></i>
            </div>
          </div>
        </div>

        <!-- Polyclinic & Consultation Fee -->
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem; margin-bottom: 1.25rem;">
          <div class="form-group">
            <label for="spec">Pilih Poliklinik Spesialisasi</label>
            <select id="spec" name="spec" class="input-style" required>
              <option value="">-- Pilih Poliklinik --</option>
              <option value="anak" {{ old('spec') == 'anak' ? 'selected' : '' }}>Spesialis Anak (Pediatri)</option>
              <option value="kandungan" {{ old('spec') == 'kandungan' ? 'selected' : '' }}>Spesialis Kandungan & Kebidanan (OBGYN)</option>
              <option value="dalam" {{ old('spec') == 'dalam' ? 'selected' : '' }}>Spesialis Penyakit Dalam</option>
              <option value="jantung" {{ old('spec') == 'jantung' ? 'selected' : '' }}>Spesialis Jantung & Pembuluh Darah</option>
              <option value="bedah" {{ old('spec') == 'bedah' ? 'selected' : '' }}>Spesialis Bedah Umum</option>
              <option value="gigi" {{ old('spec') == 'gigi' ? 'selected' : '' }}>Dokter Gigi & Mulut</option>
            </select>
          </div>
          <div class="form-group">
            <label for="fee">Tarif Konsultasi Medis (Rp)</label>
            <input type="number" id="fee" name="fee" class="input-style" placeholder="Contoh: 150000" min="50000" step="5000" value="{{ old('fee', 150000) }}" required>
          </div>
        </div>

        <!-- Working Days Schedule (Checkboxes) -->
        <div class="form-group" style="margin-bottom: 1.25rem;">
          <label>Pilih Hari Kerja Praktek (Pilih Minimal 1)</label>
          <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 0.75rem; padding: 0.75rem; background: var(--bg-secondary); border: 2px solid var(--border-color); border-radius: 12px;">
            @php
              $days = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
            @endphp
            @foreach($days as $day)
              <label style="font-size: 0.85rem; font-weight: 500; color: var(--text-dark); display: flex; align-items: center; gap: 0.5rem; cursor: pointer;">
                <input type="checkbox" name="working_days[]" value="{{ $day }}" style="width:16px; height:16px; cursor: pointer;" {{ is_array(old('working_days')) && in_array($day, old('working_days')) ? 'checked' : '' }}> {{ $day }}
              </label>
            @endforeach
          </div>
        </div>

        <!-- Working Hours Range -->
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem; margin-bottom: 1.25rem;">
          <div class="form-group">
            <label>Mulai Praktek (Jam)</label>
            <input type="text" name="working_hours_start" class="input-style" value="{{ old('working_hours_start', '08:00') }}" placeholder="Contoh: 08:00" required>
          </div>
          <div class="form-group">
            <label>Selesai Praktek (Jam)</label>
            <input type="text" name="working_hours_end" class="input-style" value="{{ old('working_hours_end', '12:00') }}" placeholder="Contoh: 12:00" required>
          </div>
        </div>

        <!-- Password and Confirm Password in a Grid -->
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem; margin-bottom: 1.5rem;">
          <div class="form-group">
            <label for="password">Kata Sandi (Min 6 Karakter)</label>
            <div style="position: relative;">
              <input type="password" id="password" name="password" class="input-style" placeholder="Buat kata sandi..." required minlength="6" style="padding-left: 2.5rem;">
              <i class="fa-solid fa-lock" style="position: absolute; left: 1rem; top: 50%; transform: translateY(-50%); color: var(--text-light);"></i>
            </div>
          </div>
          <div class="form-group">
            <label for="password_confirmation">Konfirmasi Kata Sandi</label>
            <div style="position: relative;">
              <input type="password" id="password_confirmation" name="password_confirmation" class="input-style" placeholder="Tulis ulang..." required minlength="6" style="padding-left: 2.5rem;">
              <i class="fa-solid fa-check" style="position: absolute; left: 1rem; top: 50%; transform: translateY(-50%); color: var(--text-light);"></i>
            </div>
          </div>
        </div>

        <!-- Submit Button -->
        <button type="submit" class="btn btn-primary" style="width: 100%; font-size: 1rem; padding: 0.85rem; margin-bottom: 1.5rem;">
          Daftar Registrasi Dokter <i class="fa-solid fa-user-check"></i>
        </button>

        <!-- Redirect to login -->
        <p style="font-size: 0.9rem; text-align: center; color: var(--text-medium); margin-bottom: 0;">
          Sudah memiliki akun dokter? <a href="{{ route('login') }}" style="color: var(--primary); font-weight: 700;">Masuk Portal</a>
        </p>
      </form>

    </div>

    <!-- Back link -->
    <div style="text-align: center; margin-top: 1.5rem;">
      <a href="{{ route('home') }}" style="font-size: 0.9rem; color: var(--secondary-light); font-weight: 600;"><i class="fa-solid fa-arrow-left"></i> Kembali ke Beranda</a>
    </div>

  </div>
</body>
</html>
