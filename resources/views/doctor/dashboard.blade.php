@extends('layouts.app-public')

@section('title', 'Dashboard Dokter - RS Graha Medika')

@section('content')
  <!-- DASHBOARD WRAPPER -->
  <div class="container" style="margin-top: 3rem; margin-bottom: 4rem;">
    
    <!-- Success Alert -->
    @if(session('success'))
      <div style="background-color: var(--success-light); border-left: 4px solid var(--success); padding: 1rem; border-radius: var(--radius-sm); margin-bottom: 2rem; color: var(--success-dark); font-size: 0.9rem;">
        <i class="fa-solid fa-circle-check" style="margin-right: 0.5rem; color: var(--success);"></i>
        {{ session('success') }}
      </div>
    @endif
    @if(session('error'))
      <div style="background-color: var(--danger-light); border-left: 4px solid var(--danger); padding: 1rem; border-radius: var(--radius-sm); margin-bottom: 2rem; color: var(--danger); font-size: 0.9rem;">
        <i class="fa-solid fa-circle-exclamation" style="margin-right: 0.5rem; color: var(--danger);"></i>
        {{ session('error') }}
      </div>
    @endif

    <div class="reservation-layout" style="display: grid; grid-template-columns: 0.3fr 0.7fr; gap: 2.5rem; align-items: start;">
      
      <!-- Left Sidebar: Doctor Profile Details -->
      <aside class="reservation-info-sidebar" style="background-color: var(--bg-primary); border: 1px solid var(--border-color); padding: 2rem;">
        <div style="display: flex; flex-direction: column; align-items: center; text-align: center; margin-bottom: 1.5rem;">
          <div style="width: 70px; height: 70px; border-radius: 50%; background-color: var(--primary-alpha); color: var(--primary); font-size: 2rem; display: flex; align-items: center; justify-content: center; margin-bottom: 1rem;">
            <i class="fa-solid {{ Auth::user()->avatar_icon ?? 'fa-user-user' }}"></i>
          </div>
          <h3 style="font-size: 1.15rem; margin-bottom: 0.25rem; color: var(--secondary-dark);">{{ Auth::user()->name }}</h3>
          <span style="font-size: 0.85rem; background-color: var(--primary-alpha); color: var(--primary); padding: 0.2rem 0.60rem; border-radius: 50px; font-weight: 600; display: inline-block; margin-bottom: 0.5rem;">
            {{ Auth::user()->spec_label }}
          </span>
          <span style="font-size: 0.8rem; color: var(--text-light); display: block;">{{ Auth::user()->email }}</span>
        </div>

        <div style="margin-top: 1.5rem; font-size: 0.85rem; border-top: 1px dashed var(--border-color); padding-top: 1.5rem;">
          <div style="margin-bottom: 0.75rem;">
            <span style="display:block; color: var(--text-light); font-weight: 500;">Tarif Konsultasi:</span>
            <strong style="color: var(--secondary);">Rp {{ number_format(Auth::user()->fee, 0, ',', '.') }}</strong>
          </div>
          <div style="margin-bottom: 0.75rem;">
            <span style="display:block; color: var(--text-light); font-weight: 500;">No. WhatsApp:</span>
            <strong style="color: var(--secondary);">{{ Auth::user()->phone }}</strong>
          </div>
          <div>
            <span style="display:block; color: var(--text-light); font-weight: 500;">Hari Praktek:</span>
            <strong style="color: var(--primary);">{{ Auth::user()->brief_days }}</strong>
          </div>
        </div>

        <ul class="db-menu-list" style="margin-top: 2rem; border-top: 1px solid var(--border-color); padding-top: 1.5rem; list-style: none; padding-left: 0;">
          <li style="margin-bottom: 0.5rem;">
            <a href="{{ route('doctor.dashboard') }}" style="display: flex; align-items: center; gap: 0.75rem; padding: 0.75rem 1rem; border-radius: var(--radius-sm); font-weight: 600; background-color: var(--primary-alpha); color: var(--primary);">
              <i class="fa-solid fa-clipboard-list"></i> Antrean Pasien
            </a>
          </li>
          <li>
            <form method="POST" action="{{ route('logout') }}" id="logoutForm" style="display: none;">
              @csrf
            </form>
            <a href="#" onclick="event.preventDefault(); document.getElementById('logoutForm').submit();" style="display: flex; align-items: center; gap: 0.75rem; padding: 0.75rem 1rem; border-radius: var(--radius-sm); font-weight: 600; color: var(--danger); transition: var(--transition);">
              <i class="fa-solid fa-right-from-bracket"></i> Keluar Akun
            </a>
          </li>
        </ul>
      </aside>

      <!-- Right Main Content: Queues List -->
      <main class="reservation-card" style="padding: 2.5rem;">
        <h2 style="font-size: 1.75rem; margin-bottom: 0.5rem; color: var(--secondary-dark);">Portal Dashboard Dokter</h2>
        <p style="color: var(--text-medium); font-size: 0.95rem; margin-bottom: 2rem;">Berikut adalah daftar pasien yang terdaftar di poliklinik Anda.</p>

        <!-- Stats grid -->
        <div class="db-stats-grid" style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem; margin-bottom: 2rem;">
          <div style="border: 1px solid var(--border-color); background-color: var(--bg-secondary); border-radius: var(--radius-sm); padding: 1.5rem; display: flex; align-items: center; gap: 1.25rem;">
            <div class="flex-center" style="width: 50px; height: 50px; border-radius: 50%; background-color: var(--primary); color: var(--text-white); font-size: 1.25rem; display: flex; justify-content: center; align-items: center;"><i class="fa-solid fa-users"></i></div>
            <div>
              <span style="display: block; font-size: 0.8rem; color: var(--text-light); font-weight: 600;">Total Seluruh Pasien</span>
              <strong style="font-size: 1.75rem; color: var(--secondary); line-height: 1;">{{ count($bookings) }}</strong>
            </div>
          </div>
          <div style="border: 1px solid var(--border-color); background-color: var(--bg-secondary); border-radius: var(--radius-sm); padding: 1.5rem; display: flex; align-items: center; gap: 1.25rem;">
            <div class="flex-center" style="width: 50px; height: 50px; border-radius: 50%; background-color: var(--accent); color: var(--text-white); font-size: 1.25rem; display: flex; justify-content: center; align-items: center;"><i class="fa-solid fa-spinner"></i></div>
            <div>
              <span style="display: block; font-size: 0.8rem; color: var(--text-light); font-weight: 600;">Menunggu Diperiksa</span>
              <strong style="font-size: 1.75rem; color: var(--secondary); line-height: 1;">{{ count($bookings->whereIn('status', ['Pending', 'Approved'])) }}</strong>
            </div>
          </div>
        </div>

        <h3 style="font-size: 1.25rem; margin-bottom: 1rem; color: var(--secondary); border-left: 4px solid var(--primary); padding-left: 0.5rem;">Daftar Antrean Pemeriksaan Pasien</h3>
        
        <!-- Bookings Table -->
        <div style="overflow-x: auto; width: 100%;">
          @if(count($bookings) > 0)
            <table class="bkg-table">
              <thead>
                <tr>
                  <th>Kode Booking</th>
                  <th>Nama Pasien</th>
                  <th>Tanggal & Jam</th>
                  <th>Antrean</th>
                  <th>Status</th>
                  <th>Aksi / Tindakan</th>
                </tr>
              </thead>
              <tbody>
                @foreach($bookings as $b)
                  <tr>
                    <td><strong style="color: var(--primary);">{{ $b->booking_code }}</strong></td>
                    <td>
                      <div style="font-weight: 600; color: var(--secondary);">{{ $b->patient->name }}</div>
                      <div style="font-size: 0.8rem; color: var(--text-light);">NIK: {{ $b->patient->nik }}</div>
                    </td>
                    <td>
                      <div>{{ $b->date->format('d M Y') }}</div>
                      <div style="font-size: 0.8rem; color: var(--text-light);">{{ $b->time }} WIB</div>
                    </td>
                    <td><strong style="font-size: 1.1rem; color: var(--primary);">{{ $b->queue_num }}</strong></td>
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
                    <td>
                      @if($b->status === 'Pending' || $b->status === 'Approved')
                        <div style="display: flex; gap: 0.5rem;">
                          <form action="{{ route('doctor.bookings.complete', $b->id) }}" method="POST" onsubmit="return confirm('Tandai pemeriksaan pasien ini sudah selesai?')">
                            @csrf
                            <button type="submit" class="btn btn-primary btn-table-action" style="padding: 0.4rem 0.8rem; font-size: 0.8rem;"><i class="fa-solid fa-circle-check"></i> Selesai</button>
                          </form>
                          
                          <form action="{{ route('doctor.bookings.cancel', $b->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin membatalkan antrean pasien ini?')">
                            @csrf
                            <button type="submit" class="btn btn-danger btn-table-action" style="padding: 0.4rem 0.8rem; font-size: 0.8rem; background-color: var(--danger); color: white;"><i class="fa-solid fa-ban"></i> Batalkan</button>
                          </form>
                        </div>
                      @else
                        <span style="color: var(--text-light); font-size: 0.8rem; font-style: italic;">No Action</span>
                      @endif
                    </td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          @else
            <!-- Empty state -->
            <div style="text-align: center; padding: 4rem 2rem;">
              <i class="fa-solid fa-users-slash" style="font-size: 4rem; color: var(--text-light); margin-bottom: 1.5rem;"></i>
              <h4 style="font-size: 1.25rem; color: var(--secondary); margin-bottom: 0.5rem;">Belum Ada Antrean Pasien</h4>
              <p style="max-width: 400px; margin: 0 auto; font-size: 0.9rem;">Saat ini belum ada pasien yang mendaftar atau dijadwalkan pada poliklinik Anda.</p>
            </div>
          @endif
        </div>
      </main>

    </div>
  </div>
@endsection
