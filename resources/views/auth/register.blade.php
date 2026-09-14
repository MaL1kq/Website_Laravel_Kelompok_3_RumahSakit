<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Pendaftaran Pasien Baru - RS Graha Medika</title>
  <meta name="description" content="Daftarkan akun pasien baru untuk menikmati layanan pemesanan antrean dokter secara mandiri dan cepat di RS Graha Medika.">
  
  <!-- CSS Stylesheet -->
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
  
  <!-- FontAwesome Icons CDN -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body style="background: linear-gradient(135deg, hsl(224, 85%, 96%) 0%, hsl(210, 30%, 96%) 100%); min-height: 100vh; display: flex; align-items: center; justify-content: center; padding: 2rem 0;">

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
        <h2 style="font-size: 1.5rem; color: var(--secondary-dark); margin-top: 0.5rem;">Pendaftaran Akun Pasien</h2>
        <p style="font-size: 0.85rem; color: var(--text-light); margin-top: 0.25rem;">Isi formulir pendaftaran di bawah ini untuk membuat akun baru</p>
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

      <form method="POST" action="{{ route('register') }}">
        @csrf
        
        <!-- Full Name -->
        <div class="form-group" style="margin-bottom: 1.25rem;">
          <label for="name">Nama Lengkap Pasien (Sesuai KTP)</label>
          <div style="position: relative;">
            <input type="text" id="name" name="name" class="input-style" placeholder="Tulis nama lengkap Anda..." value="{{ old('name') }}" required style="padding-left: 2.5rem;">
            <i class="fa-regular fa-user" style="position: absolute; left: 1rem; top: 50%; transform: translateY(-50%); color: var(--text-light);"></i>
          </div>
        </div>

        <!-- NIK and Date of Birth in a Grid -->
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem; margin-bottom: 1.25rem;">
          <div class="form-group">
            <label for="nik">Nomor NIK KTP (16 Digit)</label>
            <div style="position: relative;">
              <input type="text" id="nik" name="nik" class="input-style" placeholder="Tulis NIK..." value="{{ old('nik') }}" required pattern="[0-9]{16}" title="NIK harus berupa 16 digit angka" style="padding-left: 2.5rem;">
              <i class="fa-regular fa-id-card" style="position: absolute; left: 1rem; top: 50%; transform: translateY(-50%); color: var(--text-light);"></i>
            </div>
          </div>
          <div class="form-group">
            <label for="dob">Tanggal Lahir</label>
            <input type="date" id="dob" name="dob" class="input-style" value="{{ old('dob') }}" required>
          </div>
        </div>

        <!-- WhatsApp Phone and Email in a Grid -->
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem; margin-bottom: 1.25rem;">
          <div class="form-group">
            <label for="phone">Nomor WhatsApp Aktif</label>
            <div style="position: relative;">
              <input type="tel" id="phone" name="phone" class="input-style" placeholder="Contoh: 0812345..." value="{{ old('phone') }}" required style="padding-left: 2.5rem;">
              <i class="fa-brands fa-whatsapp" style="position: absolute; left: 1rem; top: 50%; transform: translateY(-50%); color: var(--text-light);"></i>
            </div>
          </div>
          <div class="form-group">
            <label for="email">Alamat Email</label>
            <div style="position: relative;">
              <input type="email" id="email" name="email" class="input-style" placeholder="email@contoh.com" value="{{ old('email') }}" required style="padding-left: 2.5rem;">
              <i class="fa-regular fa-envelope" style="position: absolute; left: 1rem; top: 50%; transform: translateY(-50%); color: var(--text-light);"></i>
            </div>
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
          Daftar Akun Baru <i class="fa-solid fa-user-plus"></i>
        </button>

        <!-- Redirect to login -->
        <p style="font-size: 0.9rem; text-align: center; color: var(--text-medium); margin-bottom: 0;">
          Sudah memiliki akun? <a href="{{ route('login') }}" style="color: var(--primary); font-weight: 700;">Masuk ke Portal</a>
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
