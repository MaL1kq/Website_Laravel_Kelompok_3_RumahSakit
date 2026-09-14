<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', 'RS Graha Medika - Pelayanan Kesehatan Premium & Terpercaya')</title>
  <meta name="description" content="Website Resmi RS Graha Medika. Menyediakan pelayanan kesehatan terbaik, rawat inap VIP, penunjang medis modern, dan pemesanan tiket dokter online.">
  
  <!-- CSS Stylesheet -->
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
  
  <!-- FontAwesome Icons CDN -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <script>window.isLaravel = true;</script>
  @yield('head')
</head>
<body>

  <!-- TOP BAR -->
  <div class="topbar">
    <div class="container">
      <div class="topbar-info">
        <span><i class="fa-solid fa-phone"></i> IGD 24 Jam: (021) 5555-7777</span>
        <span><i class="fa-solid fa-envelope"></i> info@grahamedika.com</span>
      </div>
      <div class="topbar-socials">
        <a href="#" aria-label="Facebook"><i class="fa-brands fa-facebook"></i></a>
        <a href="#" aria-label="Instagram"><i class="fa-brands fa-instagram"></i></a>
        <a href="#" aria-label="Youtube"><i class="fa-brands fa-youtube"></i></a>
      </div>
    </div>
  </div>

  <!-- HEADER & NAVIGATION -->
  <header>
    <div class="container navbar">
      <a href="{{ route('home') }}" class="logo">
        <img src="{{ asset('images/logo.png') }}" alt="Logo Graha Medika" style="height: 70px; width: auto;">
        <div class="logo-text">
          Graha Medika
          <span>Rumah Sakit</span>
        </div>
      </a>
      
      <div class="menu-toggle" id="menuToggle">
        <span></span>
        <span></span>
        <span></span>
      </div>
      
      <ul class="nav-menu" id="navMenu">
        <li><a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">Beranda</a></li>
        <li><a href="{{ route('tentang') }}" class="{{ request()->routeIs('tentang') ? 'active' : '' }}">Tentang Kami</a></li>
        <li><a href="{{ route('layanan') }}" class="{{ request()->routeIs('layanan') ? 'active' : '' }}">Layanan</a></li>
        <li><a href="{{ route('dokter') }}" class="{{ request()->routeIs('dokter') ? 'active' : '' }}">Dokter</a></li>
        <li><a href="{{ route('kontak') }}" class="{{ request()->routeIs('kontak') ? 'active' : '' }}">Hubungi Kami</a></li>
        
        @auth
          @if(Auth::user()->role === 'admin')
            <li><a href="{{ route('admin.dashboard') }}" class="btn btn-primary" style="color: white !important;">Dashboard Admin</a></li>
          @elseif(Auth::user()->role === 'doctor')
            <li><a href="{{ route('doctor.dashboard') }}" class="btn btn-primary" style="color: white !important;">Dashboard Dokter</a></li>
          @else
            <li><a href="{{ route('patient.dashboard') }}" class="btn btn-secondary">Dashboard Pasien</a></li>
            <li><a href="{{ route('reservasi') }}" class="btn btn-primary" style="color: white !important;">Daftar Online</a></li>
          @endif
          <li>
            <form method="POST" action="{{ route('logout') }}" id="logoutForm" style="display: none;">
              @csrf
            </form>
            <a href="#" onclick="event.preventDefault(); document.getElementById('logoutForm').submit();" class="nav-link">Keluar</a>
          </li>
        @else
          <li><a href="{{ route('login') }}" class="nav-link">Masuk</a></li>
          <li><a href="{{ route('register') }}" class="btn btn-secondary">Daftar Pasien</a></li>
          <li><a href="{{ route('doctor.register') }}" class="btn btn-primary" style="color: white !important;">Daftar Dokter</a></li>
        @endauth
      </ul>
    </div>
  </header>

  <!-- Content Slot -->
  <div class="container" style="margin-top: 1.5rem; margin-bottom: -1.5rem; z-index: 100; position: relative;">
    @if(session('error'))
      <div style="background-color: var(--danger-light); border-left: 4px solid var(--danger); padding: 1rem; border-radius: var(--radius-sm); color: var(--danger); font-size: 0.9rem; margin-bottom: 1rem;">
        <i class="fa-solid fa-circle-exclamation" style="margin-right: 0.5rem;"></i>
        {{ session('error') }}
      </div>
    @endif
    @if(session('success'))
      <div style="background-color: var(--success-light); border-left: 4px solid var(--success); padding: 1rem; border-radius: var(--radius-sm); color: var(--success-dark); font-size: 0.9rem; margin-bottom: 1rem;">
        <i class="fa-solid fa-circle-check" style="margin-right: 0.5rem; color: var(--success);"></i>
        {{ session('success') }}
      </div>
    @endif
    @if(session('info'))
      <div style="background-color: var(--primary-alpha); border-left: 4px solid var(--primary); padding: 1rem; border-radius: var(--radius-sm); color: var(--primary); font-size: 0.9rem; margin-bottom: 1rem;">
        <i class="fa-solid fa-circle-info" style="margin-right: 0.5rem;"></i>
        {{ session('info') }}
      </div>
    @endif
  </div>

  @yield('content')

  <!-- FOOTER -->
  <footer>
    <div class="container footer-grid">
      <!-- Col 1 -->
      <div class="footer-col footer-about">
        <a href="{{ route('home') }}" class="logo" style="margin-bottom: 1.5rem;">
          <img src="{{ asset('images/logo.png') }}" alt="Logo Graha Medika" style="height: 70px; width: auto; filter: brightness(0) invert(1);">
          <div class="logo-text" style="color: white;">
            Graha Medika
            <span style="color: rgba(255,255,255,0.6);">Rumah Sakit</span>
          </div>
        </a>
        <p>
          RS Graha Medika berkomitmen memberikan pelayanan kesehatan premium, berkelas, dan humanis dengan dukungan teknologi medis terkini serta jajaran dokter spesialis berpengalaman.
        </p>
        <div class="footer-socials" style="margin-top: 1.5rem; display: flex; gap: 1rem;">
          <a href="#" class="flex-center" style="width: 36px; height: 36px; border-radius: 50%; background: rgba(255,255,255,0.08); color: white;"><i class="fa-brands fa-facebook-f"></i></a>
          <a href="#" class="flex-center" style="width: 36px; height: 36px; border-radius: 50%; background: rgba(255,255,255,0.08); color: white;"><i class="fa-brands fa-instagram"></i></a>
          <a href="#" class="flex-center" style="width: 36px; height: 36px; border-radius: 50%; background: rgba(255,255,255,0.08); color: white;"><i class="fa-brands fa-youtube"></i></a>
        </div>
      </div>

      <!-- Col 2 -->
      <div class="footer-col">
        <h3>Link Pintar</h3>
        <ul class="footer-links">
          <li><a href="{{ route('home') }}">Beranda</a></li>
          <li><a href="{{ route('tentang') }}">Tentang Kami</a></li>
          <li><a href="{{ route('layanan') }}">Layanan Unggulan</a></li>
          <li><a href="{{ route('dokter') }}">Cari Dokter Spesialis</a></li>
          <li><a href="{{ route('reservasi') }}">Pendaftaran Online</a></li>
        </ul>
      </div>

      <!-- Col 3 -->
      <div class="footer-col">
        <h3>Layanan Unggulan</h3>
        <ul class="footer-links">
          <li><a href="{{ route('layanan') }}">Instalasi Gawat Darurat</a></li>
          <li><a href="{{ route('layanan') }}">Poliklinik Spesialis</a></li>
          <li><a href="{{ route('layanan') }}">Kamar Rawat Inap VIP</a></li>
          <li><a href="{{ route('layanan') }}">Laboratorium 24 Jam</a></li>
          <li><a href="{{ route('layanan') }}">Rehabilitasi Medis</a></li>
        </ul>
      </div>

      <!-- Col 4 -->
      <div class="footer-col">
        <h3>Hubungi Kami</h3>
        <ul class="footer-contact">
          <li>
            <i class="fa-solid fa-location-dot"></i>
            <span>Jl. Graha Medika No. 88, Kav. 12-14, Jakarta Barat, DKI Jakarta, 11620</span>
          </li>
          <li>
            <i class="fa-solid fa-phone"></i>
            <span>Call Center: (021) 5555-7777<br>IGD 24 Jam: (021) 8888-9999</span>
          </li>
          <li>
            <i class="fa-solid fa-envelope"></i>
            <span>info@grahamedika.com<br>marketing@grahamedika.com</span>
          </li>
        </ul>
      </div>
    </div>

    <!-- Footer Bottom -->
    <div class="container footer-bottom">
      <p>&copy; 2026 Rumah Sakit Graha Medika. Hak Cipta Dilindungi Undang-Undang.</p>
      <div class="footer-bottom-links">
        <a href="#">Kebijakan Privasi</a>
        <a href="#">Syarat & Ketentuan</a>
        <a href="#">Peta Situs</a>
      </div>
    </div>
  </footer>

  <!-- JavaScript -->
  <script src="{{ asset('js/app.js') }}"></script>
  @yield('scripts')
</body>
</html>
