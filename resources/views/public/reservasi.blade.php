@extends('layouts.app-public')

@section('title', 'Pendaftaran Online & Reservasi Dokter - RS Graha Medika')

@section('content')
  <!-- PAGE HEADER BANNER -->
  <section class="hero" style="padding: 4rem 0 3rem 0; text-align: center;">
    <div class="container" style="z-index: 2; position: relative;">
      <span class="badge">Pendaftaran Pasien</span>
      <h1 class="hero-title" style="font-size: 2.75rem; margin-bottom: 0.5rem;">Reservasi Dokter Online</h1>
      <p style="max-width: 600px; margin: 0 auto; color: var(--text-medium);">
        Daftar kunjungan dokter secara mandiri untuk menghindari antrean pendaftaran manual. Ikuti 3 langkah mudah di bawah ini.
      </p>
    </div>
    <div class="hero-bg-shapes">
      <div class="shape shape-2" style="bottom: -100px; left: 0;"></div>
    </div>
  </section>

  <!-- RESERVATION WIZARD SECTION -->
  <section class="section-padding" style="padding-top: 2rem;">
    <div class="container">
      
      <!-- Validation Errors Alert -->
      @if($errors->any())
        <div style="background-color: var(--danger-light); border-left: 4px solid var(--danger); padding: 1.25rem; border-radius: var(--radius-sm); margin-bottom: 2rem; color: var(--danger); font-size: 0.9rem;">
          <i class="fa-solid fa-circle-exclamation" style="margin-right: 0.5rem;"></i>
          <strong>Terjadi kesalahan:</strong>
          <ul style="margin: 0.5rem 0 0 1.25rem; padding: 0;">
            @foreach($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif

      <div class="reservation-layout">
        
        <!-- Left: Form Card -->
        <div class="reservation-card">
          <!-- Step Indicators Bar -->
          <div class="form-step-nav">
            <div class="step-indicator active">1</div>
            <div class="step-indicator">2</div>
            <div class="step-indicator">3</div>
          </div>
          
          <form id="bookingForm" method="POST" action="{{ route('bookings.store') }}">
            @csrf
            
            <!-- STEP 1: Poliklinik & Dokter -->
            <div class="form-section active" id="step1">
              <h3 style="font-size: 1.5rem; margin-bottom: 1.5rem; border-bottom: 2px solid var(--border-color); padding-bottom: 0.5rem; color: var(--secondary);">
                Langkah 1: Spesialisasi & Dokter
              </h3>
              
              <div class="form-group" style="margin-bottom: 1.5rem;">
                <label for="bookingPolyclinic">Pilih Poliklinik</label>
                <input type="hidden" name="polyclinic_label" id="bookingPolyclinicLabel" value="{{ old('polyclinic_label') }}">
                <select id="bookingPolyclinic" name="polyclinic" class="input-style" required>
                  <option value="">-- Pilih Poliklinik --</option>
                  <option value="anak" {{ old('polyclinic') == 'anak' ? 'selected' : '' }}>Spesialis Anak (Pediatri)</option>
                  <option value="kandungan" {{ old('polyclinic') == 'kandungan' ? 'selected' : '' }}>Spesialis Kandungan & Kebidanan (OBGYN)</option>
                  <option value="dalam" {{ old('polyclinic') == 'dalam' ? 'selected' : '' }}>Spesialis Penyakit Dalam</option>
                  <option value="jantung" {{ old('polyclinic') == 'jantung' ? 'selected' : '' }}>Spesialis Jantung & Pembuluh Darah</option>
                  <option value="bedah" {{ old('polyclinic') == 'bedah' ? 'selected' : '' }}>Spesialis Bedah Umum</option>
                  <option value="gigi" {{ old('polyclinic') == 'gigi' ? 'selected' : '' }}>Dokter Gigi & Mulut</option>
                </select>
              </div>
              
              <div class="form-group" style="margin-bottom: 1.5rem;">
                <label for="bookingDoctor">Pilih Dokter Spesialis</label>
                <select id="bookingDoctor" name="doctor_id" class="input-style" disabled required>
                  <option value="">-- Pilih Dokter Spesialis --</option>
                </select>
                <small style="color: var(--text-light);">* Dokter akan muncul setelah Anda memilih Poliklinik.</small>
              </div>
              
              <div class="form-nav-buttons" style="justify-content: flex-end;">
                <button type="button" id="btnNext1" class="btn btn-primary">Lanjutkan <i class="fa-solid fa-arrow-right"></i></button>
              </div>
            </div>

            <!-- STEP 2: Tanggal & Jam -->
            <div class="form-section" id="step2">
              <h3 style="font-size: 1.5rem; margin-bottom: 1.5rem; border-bottom: 2px solid var(--border-color); padding-bottom: 0.5rem; color: var(--secondary);">
                Langkah 2: Hari & Jam Praktek
              </h3>
              
              <div class="form-group" style="margin-bottom: 1.5rem;">
                <label for="bookingDate">Tanggal Kunjungan</label>
                <input type="date" id="bookingDate" name="date" class="input-style" value="{{ old('date') }}" disabled required>
                <div id="doctorPracticeDaysInfo" style="font-size: 0.85rem; color: var(--primary); font-weight: 600; margin-top: 0.5rem; display: none;"></div>
                <small style="color: var(--text-light);">* Hari kunjungan harus sesuai dengan jadwal praktek dokter pilihan Anda.</small>
              </div>
              
              <div class="form-group" style="margin-bottom: 1.5rem;">
                <label for="bookingTime">Jam Kunjungan (Estimasi)</label>
                <select id="bookingTime" name="time" class="input-style" disabled required>
                  <option value="">-- Pilih Jam Praktek --</option>
                </select>
              </div>
              
              <div class="form-nav-buttons">
                <button type="button" id="btnPrev2" class="btn btn-secondary"><i class="fa-solid fa-arrow-left"></i> Sebelumnya</button>
                <button type="button" id="btnNext2" class="btn btn-primary">Lanjutkan <i class="fa-solid fa-arrow-right"></i></button>
              </div>
            </div>

            <!-- STEP 3: Informasi Pasien & Jaminan -->
            <div class="form-section" id="step3">
              <h3 style="font-size: 1.5rem; margin-bottom: 1.5rem; border-bottom: 2px solid var(--border-color); padding-bottom: 0.5rem; color: var(--secondary);">
                Langkah 3: Identitas & Jaminan Pasien
              </h3>
              
              <!-- Payment/Insurance Type -->
              <div class="form-group" style="margin-bottom: 1.5rem;">
                <label>Pilihan Jaminan / Pembayaran</label>
                <div class="insurance-select">
                  
                  <label class="custom-radio selected">
                    <input type="radio" name="payment_type" value="Mandiri" checked>
                    <span class="radio-btn-circle"></span>
                    <div class="radio-content">
                      <h4>Umum / Mandiri</h4>
                      <p>Pembayaran pribadi tunai/debit atau asuransi swasta</p>
                    </div>
                  </label>
                  
                  <label class="custom-radio">
                    <input type="radio" name="payment_type" value="BPJS">
                    <span class="radio-btn-circle"></span>
                    <div class="radio-content">
                      <h4>BPJS Kesehatan</h4>
                      <p>Jaminan sosial BPJS dengan syarat surat rujukan faskes 1</p>
                    </div>
                  </label>
                  
                </div>
              </div>

              <!-- BPJS Card Number Input (Hidden by default) -->
              <div class="form-group" id="bpjsFieldGroup" style="margin-bottom: 1.5rem; display: none;">
                <label for="bpjsNumber">Nomor Kartu BPJS Kesehatan Pasien</label>
                <input type="text" id="bpjsNumber" name="bpjs_number" class="input-style" placeholder="Tulis 13 digit nomor kartu BPJS..." value="{{ old('bpjs_number') }}">
              </div>

              <!-- Patient Basic Info (Pre-filled from Auth, Read-only) -->
              <div class="contact-form-grid" style="margin-bottom: 1.5rem; display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem;">
                <div class="form-group">
                  <label for="patientName">Nama Lengkap Pasien (Sesuai KTP)</label>
                  <input type="text" id="patientName" class="input-style" value="{{ Auth::user()->name }}" readonly style="background-color: var(--bg-secondary); cursor: not-allowed;">
                </div>
                <div class="form-group">
                  <label for="patientNik">Nomor NIK KTP Pasien</label>
                  <input type="text" id="patientNik" class="input-style" value="{{ Auth::user()->nik }}" readonly style="background-color: var(--bg-secondary); cursor: not-allowed;">
                </div>
              </div>

              <div class="contact-form-grid" style="margin-bottom: 1.5rem; display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem;">
                <div class="form-group">
                  <label for="patientDob">Tanggal Lahir Pasien</label>
                  <input type="date" id="patientDob" class="input-style" value="{{ Auth::user()->dob ? Auth::user()->dob->format('Y-m-d') : '' }}" readonly style="background-color: var(--bg-secondary); cursor: not-allowed;">
                </div>
                <div class="form-group">
                  <label for="patientPhone">Nomor WhatsApp Aktif</label>
                  <input type="tel" id="patientPhone" class="input-style" value="{{ Auth::user()->phone }}" readonly style="background-color: var(--bg-secondary); cursor: not-allowed;">
                </div>
              </div>

              <!-- CHECKOUT INVOICE PANEL (Simulated Payment Flow) -->
              <div class="checkout-invoice" id="checkoutInvoicePanel" style="display: none; margin-bottom: 1.5rem;">
                <div class="invoice-header">
                  <h4><i class="fa-solid fa-receipt"></i> Rincian Biaya Layanan</h4>
                  <span style="font-size: 0.75rem; text-transform: uppercase; font-weight: 700; color: var(--text-light);">Metode: Mandiri</span>
                </div>
                
                <div class="invoice-row">
                  <span>Jasa Konsultasi Medis (<span id="invoiceDocName">-</span>)</span>
                  <strong id="invoiceDocFee">Rp 0</strong>
                </div>
                
                <div class="invoice-row">
                  <span>Biaya Administrasi & Operasional</span>
                  <strong id="invoiceAdminFee">Rp 0</strong>
                </div>
                
                <div class="invoice-row total">
                  <span>Total Pembayaran</span>
                  <strong id="invoiceTotal">Rp 0</strong>
                </div>

                <!-- Payment Gateway Options Selector (only shown if Mandiri is chosen) -->
                <div id="paymentGatewaySelector" style="margin-top: 1.5rem; display: none;">
                  <label style="font-size: 0.85rem; font-weight: 600; color: var(--secondary); display: block; margin-bottom: 0.75rem;">
                    Pilih Metode Pembayaran Simulasi
                  </label>
                  
                  <div class="payment-methods-grid" style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 1rem;">
                    
                    <label class="payment-method-card selected">
                      <input type="radio" name="payment_gateway" value="VA" checked>
                      <i class="fa-solid fa-building-columns"></i>
                      <span>Virtual Account</span>
                    </label>
                    
                    <label class="payment-method-card">
                      <input type="radio" name="payment_gateway" value="EWALLET">
                      <i class="fa-solid fa-wallet"></i>
                      <span>E-Wallet (OVO/Dana)</span>
                    </label>
                    
                    <label class="payment-method-card">
                      <input type="radio" name="payment_gateway" value="CARD">
                      <i class="fa-solid fa-credit-card"></i>
                      <span>Kartu Kredit</span>
                    </label>
                    
                  </div>
                </div>
              </div>

              <!-- Terms & Confirmation -->
              <div class="form-group" style="margin-bottom: 2rem; flex-direction: row; align-items: flex-start; gap: 0.75rem;">
                <input type="checkbox" id="termsCheck" required style="margin-top: 0.3rem; width: 18px; height: 18px; cursor: pointer;">
                <label for="termsCheck" style="font-size: 0.85rem; font-weight: 500; color: var(--text-medium); line-height: 1.4; cursor: pointer;">
                  Saya menyatakan bahwa data pasien di atas diisi dengan benar. Saya bersedia datang di counter pendaftaran RS Graha Medika minimal 30 menit sebelum jadwal pelayanan praktek dokter untuk melakukan verifikasi ulang berkas.
                </label>
              </div>

              <div class="form-nav-buttons">
                <button type="button" id="btnPrev3" class="btn btn-secondary"><i class="fa-solid fa-arrow-left"></i> Sebelumnya</button>
                <button type="submit" class="btn btn-primary"><i class="fa-solid fa-circle-check"></i> Selesaikan Pendaftaran</button>
              </div>
            </div>

          </form>
        </div>
        
        <!-- Right: Info Sidebar -->
        <div class="reservation-info-sidebar">
          <h3>Panduan Pendaftaran</h3>
          
          <div class="sidebar-step">
            <div class="step-num">1</div>
            <div class="step-content">
              <h4>Pilih Poli & Dokter</h4>
              <p>Tentukan spesialisasi poliklinik dan dokter medis pilihan Anda terlebih dahulu.</p>
            </div>
          </div>

          <div class="sidebar-step">
            <div class="step-num">2</div>
            <div class="step-content">
              <h4>Tentukan Jadwal</h4>
              <p>Pilih tanggal dan estimasi jam praktek dokter yang tersedia sesuai kalender.</p>
            </div>
          </div>

          <div class="sidebar-step">
            <div class="step-num">3</div>
            <div class="step-content">
              <h4>Jaminan & Selesai</h4>
              <p>Pilih metode pembayaran (Umum / BPJS), lakukan simulasi transaksi, dan simpan tiket antrean Anda.</p>
            </div>
          </div>
          
          <div style="margin-top: 2rem; padding-top: 1.5rem; border-top: 1px solid var(--border-color); font-size: 0.8rem; color: var(--text-light);">
            <i class="fa-solid fa-circle-info" style="color: var(--primary); margin-right: 0.25rem;"></i>
            Butuh bantuan teknis pendaftaran online? Hubungi Customer Service kami di (021) 5555-7777.
          </div>
        </div>

      </div>

    </div>
  </section>

  <!-- SIMULATED PAYMENT GATEWAY MODAL -->
  <div class="modal-overlay" id="paymentLoadingModal">
    <div class="modal-box" style="max-width: 450px;">
      <div class="modal-body text-center simulated-gateway-modal" style="padding: 2.5rem; text-align: center;">
        <div class="spinner-ring" style="margin: 0 auto 1.5rem auto; width: 48px; height: 48px; border: 4px solid var(--primary-alpha); border-top-color: var(--primary); border-radius: 50%; animation: spin 1s linear infinite;"></div>
        <h4 style="font-size: 1.35rem; margin-bottom: 0.5rem; color: var(--secondary);">Memproses Transaksi...</h4>
        <p style="font-size: 0.85rem; color: var(--text-light); max-width: 320px; margin: 0 auto;">
          Menghubungkan ke secure gateway bank. Mohon tidak menutup halaman ini selama proses verifikasi pembayaran berlangsung.
        </p>
      </div>
    </div>
  </div>

  <style>
    @keyframes spin {
      to { transform: rotate(360deg); }
    }
  </style>
@endsection

@section('scripts')
<script>
  // Expose MySQL doctors list to app.js for wizard step validation and dropdown rendering
  window.INITIAL_DOCTORS = @json($doctors);
  
  // Set up mock session values in window context so app.js can populate checkout steps cleanly
  window.session = {
    id: "{{ Auth::id() }}",
    name: "{{ Auth::user()->name }}",
    nik: "{{ Auth::user()->nik }}",
    dob: "{{ Auth::user()->dob ? Auth::user()->dob->format('Y-m-d') : '' }}",
    phone: "{{ Auth::user()->phone }}",
    role: "patient"
  };
</script>
@endsection
