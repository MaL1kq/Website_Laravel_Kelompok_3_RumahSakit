@extends('layouts.app-public')

@section('title', 'Dashboard Admin - RS Graha Medika')

@section('content')
  <!-- ADMIN DASHBOARD CONTENT -->
  <div class="container" style="margin-top: 3rem; margin-bottom: 4rem;">
    
    <!-- Success Alert -->
    @if(session('success'))
      <div style="background-color: var(--success-light); border-left: 4px solid var(--success); padding: 1rem; border-radius: var(--radius-sm); margin-bottom: 2rem; color: var(--success-dark); font-size: 0.9rem;">
        <i class="fa-solid fa-circle-check" style="margin-right: 0.5rem; color: var(--success);"></i>
        {{ session('success') }}
      </div>
    @endif
    @if($errors->any())
      <div style="background-color: var(--danger-light); border-left: 4px solid var(--danger); padding: 1rem; border-radius: var(--radius-sm); margin-bottom: 2rem; color: var(--danger); font-size: 0.9rem;">
        <i class="fa-solid fa-circle-exclamation" style="margin-right: 0.5rem; color: var(--danger);"></i>
        <strong>Gagal menyimpan data:</strong>
        <ul style="margin: 0.5rem 0 0 1rem; padding: 0;">
          @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <div class="reservation-layout" style="display: grid; grid-template-columns: 0.25fr 0.75fr; gap: 2.5rem; align-items: start;">
      
      <!-- Left Sidebar: Admin Controls -->
      <aside class="reservation-info-sidebar" style="background-color: var(--bg-primary); border: 1px solid var(--border-color); padding: 2rem;">
        <div style="display: flex; flex-direction: column; align-items: center; text-align: center; margin-bottom: 1.5rem;">
          <div class="flex-center" style="width: 70px; height: 70px; border-radius: 50%; background-color: var(--secondary-light); color: white; font-size: 2rem; display: flex; align-items: center; justify-content: center; margin-bottom: 1rem;">
            <i class="fa-solid fa-user-gear"></i>
          </div>
          <h3 style="font-size: 1.15rem; margin-bottom: 0.25rem; color: var(--secondary-dark);">{{ Auth::user()->name }}</h3>
          <span style="font-size: 0.8rem; color: var(--text-light);">{{ Auth::user()->email }}</span>
        </div>

        <ul class="db-menu-list" style="list-style: none; padding-left: 0; margin-top: 2rem; border-top: 1px solid var(--border-color); padding-top: 1.5rem;">
          <li style="margin-bottom: 0.5rem;">
            <div id="menuQueues" class="db-menu-item active" style="display: flex; align-items: center; gap: 0.75rem; padding: 0.75rem 1rem; border-radius: var(--radius-sm); font-weight: 600; cursor: pointer; transition: var(--transition);">
              <i class="fa-solid fa-list-ol"></i> Antrean Pasien
            </div>
          </li>
          <li style="margin-bottom: 0.5rem;">
            <div id="menuDoctors" class="db-menu-item" style="display: flex; align-items: center; gap: 0.75rem; padding: 0.75rem 1rem; border-radius: var(--radius-sm); font-weight: 600; cursor: pointer; transition: var(--transition);">
              <i class="fa-solid fa-user-doctor"></i> Manajemen Dokter
            </div>
          </li>
          <li>
            <form method="POST" action="{{ route('logout') }}" id="logoutForm" style="display: none;">
              @csrf
            </form>
            <a href="#" onclick="event.preventDefault(); document.getElementById('logoutForm').submit();" style="display: flex; align-items: center; gap: 0.75rem; padding: 0.75rem 1rem; border-radius: var(--radius-sm); font-weight: 600; color: var(--danger); transition: var(--transition);">
              <i class="fa-solid fa-right-from-bracket"></i> Keluar Sistem
            </a>
          </li>
        </ul>
      </aside>

      <!-- Right Main Content Panels -->
      <main class="reservation-card" style="padding: 2.5rem;">
        
        <!-- STATS COUNTER GRID -->
        <div class="db-stats-grid" style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 1.25rem; margin-bottom: 2rem;">
          <!-- Stat 1: Total Omset (IDR) -->
          <div style="border: 1px solid var(--border-color); background-color: var(--bg-secondary); border-radius: var(--radius-sm); padding: 1.25rem; display: flex; align-items: center; gap: 1rem;">
            <div class="flex-center" style="width: 44px; height: 44px; border-radius: 50%; background-color: #059669; color: white; font-size: 1.1rem; display: flex; justify-content: center; align-items: center;"><i class="fa-solid fa-money-bill-wave"></i></div>
            <div>
              <span style="display: block; font-size: 0.75rem; color: var(--text-light); font-weight: 600;">Total Omset</span>
              <strong style="font-size: 1.05rem; color: var(--secondary); font-weight: 800; display: block;">Rp {{ number_format($totalOmset, 0, ',', '.') }}</strong>
            </div>
          </div>
          <!-- Stat 2: Pending Queues -->
          <div style="border: 1px solid var(--border-color); background-color: var(--bg-secondary); border-radius: var(--radius-sm); padding: 1.25rem; display: flex; align-items: center; gap: 1rem;">
            <div class="flex-center" style="width: 44px; height: 44px; border-radius: 50%; background-color: var(--accent); color: white; font-size: 1.1rem; display: flex; justify-content: center; align-items: center;"><i class="fa-solid fa-hourglass-half"></i></div>
            <div>
              <span style="display: block; font-size: 0.75rem; color: var(--text-light); font-weight: 600;">Menunggu</span>
              <strong style="font-size: 1.25rem; color: var(--secondary);">{{ count($bookings->where('status', 'Pending')) }}</strong>
            </div>
          </div>
          <!-- Stat 3: Approved Queues -->
          <div style="border: 1px solid var(--border-color); background-color: var(--bg-secondary); border-radius: var(--radius-sm); padding: 1.25rem; display: flex; align-items: center; gap: 1rem;">
            <div class="flex-center" style="width: 44px; height: 44px; border-radius: 50%; background-color: var(--primary); color: white; font-size: 1.1rem; display: flex; justify-content: center; align-items: center;"><i class="fa-solid fa-circle-check"></i></div>
            <div>
              <span style="display: block; font-size: 0.75rem; color: var(--text-light); font-weight: 600;">Disetujui</span>
              <strong style="font-size: 1.25rem; color: var(--secondary);">{{ count($bookings->where('status', 'Approved')) }}</strong>
            </div>
          </div>
          <!-- Stat 4: Total Doctors -->
          <div style="border: 1px solid var(--border-color); background-color: var(--bg-secondary); border-radius: var(--radius-sm); padding: 1.25rem; display: flex; align-items: center; gap: 1rem;">
            <div class="flex-center" style="width: 44px; height: 44px; border-radius: 50%; background-color: var(--secondary-dark); color: white; font-size: 1.1rem; display: flex; justify-content: center; align-items: center;"><i class="fa-solid fa-user-doctor"></i></div>
            <div>
              <span style="display: block; font-size: 0.75rem; color: var(--text-light); font-weight: 600;">Tim Dokter</span>
              <strong style="font-size: 1.25rem; color: var(--secondary);">{{ $activeDoctorsCount }}</strong>
            </div>
          </div>
        </div>

        <!-- PANEL 1: ANTREAN PASIEN -->
        <div id="panelQueues" class="dashboard-panel active">
          <h2 style="font-size: 1.5rem; margin-bottom: 0.5rem; color: var(--secondary-dark);">Daftar Antrean Pasien</h2>
          <p style="color: var(--text-medium); font-size: 0.85rem; margin-bottom: 1.5rem;">Pantau daftar antrean janji temu pasien rawat jalan secara real-time.</p>
          
          <div style="overflow-x: auto; width: 100%;">
            @if(count($bookings) > 0)
              <table class="bkg-table" style="width: 100%;">
                <thead>
                  <tr>
                    <th>Kode / Tgl Daftar</th>
                    <th>Pasien</th>
                    <th>Poliklinik & Dokter</th>
                    <th>Jadwal Berobat</th>
                    <th>Pembayaran</th>
                    <th>Status</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($bookings as $b)
                    <tr>
                      <td>
                        <strong style="color: var(--primary); display: block;">{{ $b->booking_code }}</strong>
                        <span style="font-size: 0.75rem; color: var(--text-light);">{{ $b->created_at->format('d/m/Y H:i') }}</span>
                      </td>
                      <td>
                        <div style="font-weight: 600; color: var(--secondary);">{{ $b->patient->name }}</div>
                        <div style="font-size: 0.8rem; color: var(--text-light);">NIK: {{ $b->patient->nik }}</div>
                      </td>
                      <td>
                        <div style="font-weight: 600;">{{ $b->polyclinic_label }}</div>
                        <div style="font-size: 0.8rem; color: var(--text-light);">{{ $b->doctor->name }}</div>
                      </td>
                      <td>
                        <div>{{ $b->date->format('d M Y') }}</div>
                        <div style="font-size: 0.8rem; color: var(--text-light);">{{ $b->time }} WIB</div>
                      </td>
                      <td>
                        @if($b->payment_type === 'BPJS')
                          <span style="font-size: 0.8rem; color: var(--text-medium);">BPJS (Covered)</span>
                        @else
                          <strong style="font-size: 0.85rem; color: #059669;">Rp {{ number_format($b->total_fee, 0, ',', '.') }}</strong>
                          <span style="display: block; font-size: 0.75rem; color: var(--text-light);">Lunas (Mandiri)</span>
                        @endif
                      </td>
                      <td>
                        @if($b->status === 'Pending')
                          <span style="background-color: #fef3c7; color: #d97706; padding: 0.25rem 0.5rem; border-radius: var(--radius-sm); font-size: 0.75rem; font-weight: 600;">PENDING</span>
                        @elseif($b->status === 'Approved')
                          <span style="background-color: #d1fae5; color: #059669; padding: 0.25rem 0.5rem; border-radius: var(--radius-sm); font-size: 0.75rem; font-weight: 600;">APPROVED</span>
                        @elseif($b->status === 'Completed')
                          <span style="background-color: var(--primary-alpha); color: var(--primary); padding: 0.25rem 0.5rem; border-radius: var(--radius-sm); font-size: 0.75rem; font-weight: 600;">COMPLETED</span>
                        @else
                          <span style="background-color: var(--danger-light); color: var(--danger); padding: 0.25rem 0.5rem; border-radius: var(--radius-sm); font-size: 0.75rem; font-weight: 600;">CANCELED</span>
                        @endif
                      </td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            @else
              <div style="text-align: center; padding: 4rem 2rem;">
                <i class="fa-solid fa-list-ol" style="font-size: 3rem; color: var(--text-light); margin-bottom: 1rem;"></i>
                <p>Belum ada data pendaftaran antrean berobat yang tercatat.</p>
              </div>
            @endif
          </div>
        </div>

        <!-- PANEL 2: MANAJEMEN DOKTER -->
        <div id="panelDoctors" class="dashboard-panel">
          
          <!-- Pending Dokter Approval List -->
          @if(count($pendingDoctors) > 0)
            <div style="background-color: #fffbeb; border: 1px solid #fef3c7; border-radius: var(--radius-md); padding: 1.5rem; margin-bottom: 2rem;">
              <h3 style="font-size: 1.15rem; color: #b45309; margin-bottom: 0.75rem;"><i class="fa-solid fa-triangle-exclamation"></i> Menunggu Verifikasi Akun Dokter Baru ({{ count($pendingDoctors) }})</h3>
              <div style="overflow-x: auto;">
                <table class="bkg-table" style="background: transparent;">
                  <thead>
                    <tr>
                      <th>Nama Dokter</th>
                      <th>Poliklinik</th>
                      <th>Hari Kerja</th>
                      <th>Tarif</th>
                      <th>Verifikasi</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($pendingDoctors as $doctor)
                      <tr>
                        <td><strong>{{ $doctor->name }}</strong><br><span style="font-size: 0.8rem; color: var(--text-light);">{{ $doctor->email }}</span></td>
                        <td><span style="background-color: var(--primary-alpha); color: var(--primary); padding: 0.2rem 0.5rem; border-radius: 50px; font-size: 0.75rem; font-weight: 600;">{{ $doctor->spec_label }}</span></td>
                        <td>{{ $doctor->brief_days }}</td>
                        <td>Rp {{ number_format($doctor->fee, 0, ',', '.') }}</td>
                        <td>
                          <form action="{{ route('admin.doctors.verify', $doctor->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-primary btn-sm" style="font-size: 0.8rem; padding: 0.4rem 0.8rem;"><i class="fa-solid fa-user-check"></i> Setujui & Aktifkan</button>
                          </form>
                        </td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          @endif

          <div style="display: grid; grid-template-columns: 1.25fr 0.75fr; gap: 2rem; align-items: flex-start;">
            
            <!-- Left: Doctor Directory List -->
            <div>
              <h2 style="font-size: 1.5rem; margin-bottom: 0.5rem; color: var(--secondary-dark);">Daftar Tim Medis Aktif</h2>
              <p style="color: var(--text-medium); font-size: 0.85rem; margin-bottom: 1.5rem;">Daftar tim dokter spesialis yang aktif memberikan pelayanan konsultasi.</p>

              <table class="bkg-table">
                <thead>
                  <tr>
                    <th>Dokter</th>
                    <th>Poliklinik</th>
                    <th>Hari Praktek</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($activeDoctors as $doctor)
                    <tr>
                      <td>
                        <strong style="color: var(--secondary);">{{ $doctor->name }}</strong>
                        <div style="font-size: 0.75rem; color: var(--text-light);">{{ $doctor->email }} | Rp {{ number_format($doctor->fee, 0, ',', '.') }}</div>
                      </td>
                      <td>{{ $doctor->spec_label }}</td>
                      <td style="font-size: 0.8rem; color: var(--text-medium);">{{ $doctor->brief_days }}</td>
                      <td>
                        <form action="{{ route('admin.doctors.destroy', $doctor->id) }}" method="POST" onsubmit="return confirm('Hapus dokter {{ $doctor->name }} dari database? Semua jadwal & antrean dokter ini juga akan terhapus.')">
                          @csrf
                          @method('DELETE')
                          <button type="submit" class="btn btn-danger btn-table-action" style="padding: 0.35rem 0.7rem; font-size: 0.75rem; background-color: var(--danger); color: white;"><i class="fa-solid fa-user-slash"></i> Hapus</button>
                        </form>
                      </td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>

            <!-- Right: Add Doctor Form -->
            <div style="background-color: var(--bg-secondary); border: 1px solid var(--border-color); border-radius: var(--radius-md); padding: 2rem;">
              <h3 style="font-size: 1.2rem; margin-bottom: 1.25rem; color: var(--secondary);">Tambah Dokter Baru</h3>
              
              <form method="POST" action="{{ route('admin.doctors.store') }}">
                @csrf
                <div class="form-group" style="margin-bottom: 1rem;">
                  <label for="newDocName">Nama Dokter (Lengkap + Gelar)</label>
                  <input type="text" id="newDocName" name="name" class="input-style" placeholder="Contoh: dr. Adrian Sp.A" value="{{ old('name') }}" required>
                </div>

                <div class="form-group" style="margin-bottom: 1rem;">
                  <label for="newDocEmail">Email Akun Dokter</label>
                  <input type="email" id="newDocEmail" name="email" class="input-style" placeholder="email@grahamedika.com" value="{{ old('email') }}" required>
                </div>

                <div class="form-group" style="margin-bottom: 1rem;">
                  <label for="newDocPassword">Kata Sandi Akun</label>
                  <input type="password" id="newDocPassword" name="password" class="input-style" placeholder="Minimal 6 karakter..." required>
                </div>

                <div class="form-group" style="margin-bottom: 1rem;">
                  <label for="newDocSpec">Poliklinik</label>
                  <select id="newDocSpec" name="spec" class="input-style" required>
                    <option value="">-- Pilih Poliklinik --</option>
                    <option value="anak" {{ old('spec') == 'anak' ? 'selected' : '' }}>Spesialis Anak (Pediatri)</option>
                    <option value="kandungan" {{ old('spec') == 'kandungan' ? 'selected' : '' }}>Spesialis Kandungan & Kebidanan (OBGYN)</option>
                    <option value="dalam" {{ old('spec') == 'dalam' ? 'selected' : '' }}>Spesialis Penyakit Dalam</option>
                    <option value="jantung" {{ old('spec') == 'jantung' ? 'selected' : '' }}>Spesialis Jantung & Pembuluh Darah</option>
                    <option value="bedah" {{ old('spec') == 'bedah' ? 'selected' : '' }}>Spesialis Bedah Umum</option>
                    <option value="gigi" {{ old('spec') == 'gigi' ? 'selected' : '' }}>Dokter Gigi & Mulut</option>
                  </select>
                </div>

                <div class="form-group" style="margin-bottom: 1rem;">
                  <label for="newDocFee">Tarif Konsultasi (Rp)</label>
                  <input type="number" id="newDocFee" name="fee" class="input-style" placeholder="Contoh: 150000" min="50000" step="5000" value="{{ old('fee', 150000) }}" required>
                </div>

                <div class="form-group" style="margin-bottom: 1rem;">
                  <label>Hari Praktek Kerja (Pilih Minimal 1)</label>
                  <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 0.5rem; padding: 0.5rem; background: var(--bg-primary); border: 2px solid var(--border-color); border-radius: 12px;">
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

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; margin-bottom: 1.5rem;">
                  <div class="form-group">
                    <label>Mulai Praktek</label>
                    <input type="text" name="working_hours_start" class="input-style" value="{{ old('working_hours_start', '08:00') }}" placeholder="08:00" required>
                  </div>
                  <div class="form-group">
                    <label>Selesai Praktek</label>
                    <input type="text" name="working_hours_end" class="input-style" value="{{ old('working_hours_end', '12:00') }}" placeholder="12:00" required>
                  </div>
                </div>

                <button type="submit" class="btn btn-primary" style="width: 100%; font-size: 0.9rem; padding: 0.65rem;">
                  <i class="fa-solid fa-user-plus"></i> Simpan Tim Medis
                </button>
              </form>
            </div>

          </div>
        </div>

      </main>

    </div>
  </div>

  <style>
    /* Styling to hide/show panels in Blade via JS toggle */
    .dashboard-panel {
      display: none;
    }
    .dashboard-panel.active {
      display: block;
    }
    .db-menu-item {
      color: var(--text-medium);
    }
    .db-menu-item.active {
      background-color: var(--primary-alpha) !important;
      color: var(--primary) !important;
    }
  </style>
@endsection

@section('scripts')
<script>
  document.addEventListener('DOMContentLoaded', () => {
    const menuQueues = document.getElementById('menuQueues');
    const menuDoctors = document.getElementById('menuDoctors');
    const panelQueues = document.getElementById('panelQueues');
    const panelDoctors = document.getElementById('panelDoctors');

    // Handle initial state on form validation error reload
    @if($errors->any() || session('active_panel') === 'doctors')
      menuDoctors.classList.add('active');
      menuQueues.classList.remove('active');
      panelDoctors.classList.add('active');
      panelQueues.classList.remove('active');
    @endif

    menuQueues.addEventListener('click', () => {
      menuQueues.classList.add('active');
      menuDoctors.classList.remove('active');
      panelQueues.classList.add('active');
      panelDoctors.classList.remove('active');
    });

    menuDoctors.addEventListener('click', () => {
      menuDoctors.classList.add('active');
      menuQueues.classList.remove('active');
      panelDoctors.classList.add('active');
      panelQueues.classList.remove('active');
    });
  });
</script>
@endsection
