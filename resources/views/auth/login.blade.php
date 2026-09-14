<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Masuk Akun - RS Graha Medika</title>
  <meta name="description" content="Masuk ke portal pasien RS Graha Medika untuk mengelola reservasi dan jadwal konsultasi dokter Anda.">
  
  <!-- CSS Stylesheet -->
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
  
  <!-- FontAwesome Icons CDN -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body style="background: linear-gradient(135deg, hsl(224, 85%, 96%) 0%, hsl(210, 30%, 96%) 100%); min-height: 100vh; display: flex; align-items: center; justify-content: center; padding: 2rem 0;">

  <div class="container" style="max-width: 480px; padding: 0 1rem;">
    
    <!-- Login Card -->
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
        <h2 style="font-size: 1.5rem; color: var(--secondary-dark); margin-top: 0.5rem;">Masuk ke Portal RSGM</h2>
        <p style="font-size: 0.85rem; color: var(--text-light); margin-top: 0.25rem;">Masukkan email & kata sandi Anda</p>
      </div>

      <!-- Success Redirect Alert (e.g. from doctor register pending) -->
      @if(session('success'))
        <div style="background-color: var(--success-light); border-left: 4px solid var(--success); padding: 1rem; border-radius: var(--radius-sm); margin-bottom: 1.5rem; color: var(--success-dark); font-size: 0.85rem;">
          <i class="fa-solid fa-circle-check" style="margin-right: 0.5rem; color: var(--success);"></i>
          {{ session('success') }}
        </div>
      @endif
      @if(session('error'))
        <div style="background-color: var(--danger-light); border-left: 4px solid var(--danger); padding: 1rem; border-radius: var(--radius-sm); margin-bottom: 1.5rem; color: var(--danger); font-size: 0.85rem;">
          <i class="fa-solid fa-circle-exclamation" style="margin-right: 0.5rem; color: var(--danger);"></i>
          {{ session('error') }}
        </div>
      @endif

      <!-- Laravel Validation Errors -->
      @if($errors->any())
        <div style="background-color: var(--danger-light); border-left: 4px solid var(--danger); padding: 1rem; border-radius: var(--radius-sm); margin-bottom: 1.5rem; color: var(--danger); font-size: 0.85rem;">
          <i class="fa-solid fa-circle-exclamation" style="margin-right: 0.5rem; color: var(--danger);"></i>
          <span>{{ $errors->first() }}</span>
        </div>
      @endif

      <form id="loginForm" method="POST" action="{{ route('login') }}">
        @csrf
        <!-- Email -->
        <div class="form-group" style="margin-bottom: 1.25rem;">
          <label for="email">Alamat Email</label>
          <div style="position: relative;">
            <input type="email" id="email" name="email" class="input-style" placeholder="Tulis alamat email Anda..." value="{{ old('email') }}" required style="padding-left: 2.5rem;">
            <i class="fa-regular fa-envelope" style="position: absolute; left: 1rem; top: 50%; transform: translateY(-50%); color: var(--text-light);"></i>
          </div>
        </div>

        <!-- Password -->
        <div class="form-group" style="margin-bottom: 1.5rem;">
          <label for="password">Kata Sandi</label>
          <div style="position: relative;">
            <input type="password" id="password" name="password" class="input-style" placeholder="Tulis kata sandi Anda..." required style="padding-left: 2.5rem;">
            <i class="fa-solid fa-lock" style="position: absolute; left: 1rem; top: 50%; transform: translateY(-50%); color: var(--text-light);"></i>
          </div>
        </div>

        <!-- Remember Me Checkbox -->
        <div class="form-group" style="margin-bottom: 1.5rem; flex-direction: row; align-items: center; gap: 0.5rem;">
          <input type="checkbox" id="remember_me" name="remember" style="width: 16px; height: 16px; cursor: pointer;">
          <label for="remember_me" style="font-size: 0.85rem; font-weight: 500; color: var(--text-medium); margin-bottom: 0; cursor: pointer;">Ingat Saya</label>
        </div>

        <!-- Submit Button -->
        <button type="submit" class="btn btn-primary" style="width: 100%; font-size: 1rem; padding: 0.85rem; margin-bottom: 1.5rem;">
          Masuk Sekarang <i class="fa-solid fa-right-to-bracket"></i>
        </button>

        <!-- Redirect to register -->
        <p style="font-size: 0.9rem; text-align: center; color: var(--text-medium); margin-bottom: 0.5rem;">
          Belum terdaftar sebagai pasien? <a href="{{ route('register') }}" style="color: var(--primary); font-weight: 700;">Daftar Akun Baru</a>
        </p>
        <p style="font-size: 0.85rem; text-align: center; color: var(--text-light); margin-bottom: 0;">
          Anda seorang dokter? <a href="{{ route('doctor.register') }}" style="color: var(--accent); font-weight: 700;">Registrasi Dokter</a>
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
