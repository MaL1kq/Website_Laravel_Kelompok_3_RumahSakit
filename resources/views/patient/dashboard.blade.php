@extends('layouts.app-public')

@section('title', 'Dashboard Pasien - RS Graha Medika')

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
      
      <!-- Left Sidebar: Profile Details -->
      <aside class="reservation-info-sidebar" style="background-color: var(--bg-primary); border: 1px solid var(--border-color); padding: 2rem;">
        <div style="display: flex; flex-direction: column; align-items: center; text-align: center; margin-bottom: 1.5rem;">
          <div style="width: 70px; height: 70px; border-radius: 50%; background-color: var(--primary-alpha); color: var(--primary); font-size: 2rem; display: flex; align-items: center; justify-content: center; margin-bottom: 1rem;">
            <i class="fa-solid fa-user-injured"></i>
          </div>
          <h3 style="font-size: 1.15rem; margin-bottom: 0.25rem; color: var(--secondary-dark);">{{ Auth::user()->name }}</h3>
          <span style="font-size: 0.8rem; color: var(--text-light);">{{ Auth::user()->email }}</span>
        </div>

        <div style="margin-top: 1.5rem; font-size: 0.85rem; border-top: 1px dashed var(--border-color); padding-top: 1.5rem;">
          <div style="margin-bottom: 0.75rem;">
            <span style="display:block; color: var(--text-light); font-weight: 500;">Nomor NIK KTP:</span>
            <strong style="color: var(--secondary);">{{ Auth::user()->nik }}</strong>
          </div>
          <div style="margin-bottom: 0.75rem;">
            <span style="display:block; color: var(--text-light); font-weight: 500;">No. WhatsApp:</span>
            <strong style="color: var(--secondary);">{{ Auth::user()->phone }}</strong>
          </div>
          <div>
            <span style="display:block; color: var(--text-light); font-weight: 500;">Tanggal Lahir:</span>
            <strong style="color: var(--secondary);">{{ Auth::user()->dob ? Auth::user()->dob->format('d M Y') : '-' }}</strong>
          </div>
        </div>

        <ul class="db-menu-list" style="margin-top: 2rem; border-top: 1px solid var(--border-color); padding-top: 1.5rem; list-style: none; padding-left: 0;">
          <li style="margin-bottom: 0.5rem;">
            <a href="{{ route('patient.dashboard') }}" style="display: flex; align-items: center; gap: 0.75rem; padding: 0.75rem 1rem; border-radius: var(--radius-sm); font-weight: 600; background-color: var(--primary-alpha); color: var(--primary);">
              <i class="fa-solid fa-house-medical"></i> Dashboard
            </a>
          </li>
          <li style="margin-bottom: 0.5rem;">
            <a href="{{ route('reservasi') }}" style="display: flex; align-items: center; gap: 0.75rem; padding: 0.75rem 1rem; border-radius: var(--radius-sm); font-weight: 600; color: var(--text-medium); transition: var(--transition);">
              <i class="fa-solid fa-calendar-check"></i> Buat Reservasi
            </a>
          </li>
          <li>
            <a href="#" onclick="event.preventDefault(); document.getElementById('logoutForm').submit();" style="display: flex; align-items: center; gap: 0.75rem; padding: 0.75rem 1rem; border-radius: var(--radius-sm); font-weight: 600; color: var(--danger); transition: var(--transition);">
              <i class="fa-solid fa-right-from-bracket"></i> Keluar Akun
            </a>
          </li>
        </ul>
      </aside>

      <!-- Right Main Content: Bookings CRUD -->
      <main class="reservation-card" style="padding: 2.5rem;">
        <h2 style="font-size: 1.75rem; margin-bottom: 0.5rem; color: var(--secondary-dark);">Portal Layanan Pasien</h2>
        <p style="color: var(--text-medium); font-size: 0.95rem; margin-bottom: 2rem;">Selamat datang kembali! Di sini Anda dapat melacak status antrean berobat Anda secara real-time.</p>

        <!-- Stats grid -->
        <div class="db-stats-grid" style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem; margin-bottom: 2rem;">
          <div style="border: 1px solid var(--border-color); background-color: var(--bg-secondary); border-radius: var(--radius-sm); padding: 1.5rem; display: flex; align-items: center; gap: 1.25rem;">
            <div class="flex-center" style="width: 50px; height: 50px; border-radius: 50%; background-color: var(--primary); color: var(--text-white); font-size: 1.25rem; display: flex; justify-content: center; align-items: center;"><i class="fa-solid fa-ticket"></i></div>
            <div>
              <span style="display: block; font-size: 0.8rem; color: var(--text-light); font-weight: 600;">Total Reservasi Anda</span>
              <strong style="font-size: 1.75rem; color: var(--secondary); line-height: 1;">{{ count($bookings) }}</strong>
            </div>
          </div>
          <div style="border: 1px solid var(--border-color); background-color: var(--bg-secondary); border-radius: var(--radius-sm); padding: 1.5rem; display: flex; align-items: center; gap: 1.25rem;">
            <div class="flex-center" style="width: 50px; height: 50px; border-radius: 50%; background-color: var(--accent); color: var(--text-white); font-size: 1.25rem; display: flex; justify-content: center; align-items: center;"><i class="fa-solid fa-clock-rotate-left"></i></div>
            <div>
              <span style="display: block; font-size: 0.8rem; color: var(--text-light); font-weight: 600;">Antrean Aktif</span>
              <strong style="font-size: 1.75rem; color: var(--secondary); line-height: 1;">{{ count($bookings->whereIn('status', ['Pending', 'Approved'])) }}</strong>
            </div>
          </div>
        </div>

        <h3 style="font-size: 1.25rem; margin-bottom: 1rem; color: var(--secondary); border-left: 4px solid var(--primary); padding-left: 0.5rem;">Daftar Reservasi Pemeriksaan Dokter</h3>
        
        <!-- Bookings Table -->
        <div style="overflow-x: auto; width: 100%;">
          @if(count($bookings) > 0)
            <table class="bkg-table">
              <thead>
                <tr>
                  <th>Kode Booking</th>
                  <th>Poliklinik & Dokter</th>
                  <th>Tanggal & Jam</th>
                  <th>Antrean</th>
                  <th>Status</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                @foreach($bookings as $b)
                  <tr>
                    <td><strong style="color: var(--primary);">{{ $b->booking_code }}</strong></td>
                    <td>
                      <div style="font-weight: 600; color: var(--secondary);">{{ $b->polyclinic_label }}</div>
                      <div style="font-size: 0.8rem; color: var(--text-light);">{{ $b->doctor->name }}</div>
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
                      <div class="bkg-actions-group" style="display: flex; gap: 0.5rem;">
                        <button class="btn btn-secondary btn-table-action" style="padding: 0.4rem 0.8rem; font-size: 0.8rem;" onclick="openTicketModal({{ json_encode([
                          'booking_code' => $b->booking_code,
                          'patient_name' => Auth::user()->name,
                          'patient_nik' => Auth::user()->nik,
                          'polyclinic_label' => $b->polyclinic_label,
                          'doctor_name' => $b->doctor->name,
                          'date_formatted' => $b->date->format('d F Y'),
                          'time' => $b->time,
                          'queue_num' => $b->queue_num,
                          'payment_type' => $b->payment_type,
                          'bpjs_number' => $b->bpjs_number,
                          'total_fee' => number_format($b->total_fee, 0, ',', '.')
                        ]) }})"><i class="fa-solid fa-ticket"></i> Tiket</button>
                        
                        @if($b->status === 'Pending' || $b->status === 'Approved')
                          <button class="btn btn-primary btn-table-action" style="padding: 0.4rem 0.8rem; font-size: 0.8rem;" onclick="openRescheduleModal({{ $b->id }}, '{{ $b->doctor->name }}', '{{ $b->doctor->brief_days }}', '{{ json_encode($b->doctor->schedule) }}')"><i class="fa-regular fa-calendar"></i> Reschedule</button>
                          
                          <form action="{{ route('bookings.cancel', $b->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin membatalkan antrean berobat ini?')">
                            @csrf
                            <button type="submit" class="btn btn-danger btn-table-action" style="padding: 0.4rem 0.8rem; font-size: 0.8rem; background-color: var(--danger); color: white;"><i class="fa-solid fa-trash"></i> Batalkan</button>
                          </form>
                        @endif
                      </div>
                    </td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          @else
            <!-- Empty state -->
            <div style="text-align: center; padding: 4rem 2rem;">
              <i class="fa-solid fa-calendar-xmark" style="font-size: 4rem; color: var(--text-light); margin-bottom: 1.5rem;"></i>
              <h4 style="font-size: 1.25rem; color: var(--secondary); margin-bottom: 0.5rem;">Belum Ada Reservasi Aktif</h4>
              <p style="max-width: 400px; margin: 0 auto 1.5rem auto; font-size: 0.9rem;">Anda belum pernah melakukan registrasi antrean dokter secara online.</p>
              <a href="{{ route('reservasi') }}" class="btn btn-primary">Daftar Konsultasi Sekarang</a>
            </div>
          @endif
        </div>
      </main>

    </div>
  </div>

  <!-- MODAL: RESCHEDULE BOOKING -->
  <div class="modal-overlay" id="rescheduleModal">
    <div class="modal-box">
      <button class="modal-close-btn flex-center" aria-label="Tutup" onclick="closeModal('rescheduleModal')"><i class="fa-solid fa-xmark"></i></button>
      <div class="modal-header">
        <h3><i class="fa-regular fa-calendar-days"></i> Reschedule Janji Temu</h3>
      </div>
      <div class="modal-body">
        <form id="rescheduleForm" method="POST" action="">
          @csrf
          <div style="background-color: var(--primary-alpha); padding: 1rem; border-radius: var(--radius-sm); font-size: 0.85rem; border-left: 4px solid var(--primary); margin-bottom: 1.5rem;">
            <span>Dokter yang Dipilih:</span>
            <strong id="rescheduleDocName" style="display: block; font-size: 1rem; color: var(--secondary);">-</strong>
            <span id="rescheduleDocBrief" style="display: block; font-size: 0.75rem; color: var(--text-medium);">-</span>
          </div>

          <div class="form-group" style="margin-bottom: 1.25rem;">
            <label for="rescheduleDate">Pilih Tanggal Baru</label>
            <input type="date" id="rescheduleDate" name="date" class="input-style" required>
          </div>

          <div class="form-group" style="margin-bottom: 2rem;">
            <label for="rescheduleTime">Pilih Jam Baru</label>
            <select id="rescheduleTime" name="time" class="input-style" required disabled>
              <option value="">-- Pilih Jam Praktek --</option>
            </select>
          </div>

          <div style="display: flex; gap: 1rem; justify-content: flex-end;">
            <button type="button" class="btn btn-secondary" onclick="closeModal('rescheduleModal')">Batal</button>
            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- MODAL: E-TICKET RECEIPT -->
  <div class="modal-overlay" id="bookingTicketModal">
    <div class="modal-box" style="max-width: 650px;">
      <button class="modal-close-btn flex-center" aria-label="Tutup tiket" onclick="closeModal('bookingTicketModal')"><i class="fa-solid fa-xmark"></i></button>
      <div class="modal-header">
        <h3><i class="fa-solid fa-ticket"></i> Bukti Reservasi Online</h3>
      </div>
      <div class="modal-body" style="padding: 1.5rem;">
        <p style="font-size: 0.9rem; text-align: center; color: var(--text-medium); margin-bottom: 1.5rem;">
          Harap tunjukkan berkas E-Tiket ini saat melakukan registrasi ulang di Anjungan Pendaftaran Mandiri (APM) Rumah Sakit.
        </p>

        <!-- Ticket Card Frame -->
        <div class="ticket-container">
          <div class="ticket-header">
            <div class="ticket-header-logo">
              <img src="{{ asset('images/logo.png') }}" alt="Logo" style="height: 24px; width: auto;"> RS Graha Medika
            </div>
            <span id="ticketStatusBadge" class="ticket-status">CONFIRMED</span>
          </div>

          <div class="ticket-body">
            <div class="ticket-info-grid">
              <div class="ticket-info-item">
                <span>Kode Booking</span>
                <strong id="ticketCode" class="ticket-code">RSGM-XXXX-XXXX</strong>
              </div>
              <div class="ticket-info-item">
                <span>Jaminan Pasien</span>
                <strong id="ticketPayment">Umum / Mandiri</strong>
              </div>
              
              <div class="ticket-info-item" style="grid-column: 1 / -1; border-top: 1px solid var(--border-color); padding-top: 0.5rem;">
                <span>Nama Pasien</span>
                <strong id="ticketPatientName" style="font-size: 1.1rem;">-</strong>
              </div>
              
              <div class="ticket-info-item" style="grid-column: 1 / -1;">
                <span>Nomor NIK</span>
                <strong id="ticketNik">-</strong>
              </div>

              <div class="ticket-info-item" style="border-top: 1px solid var(--border-color); padding-top: 0.5rem;">
                <span>Poliklinik</span>
                <strong id="ticketPolyclinic">-</strong>
              </div>
              <div class="ticket-info-item" style="border-top: 1px solid var(--border-color); padding-top: 0.5rem;">
                <span>Dokter Spesialis</span>
                <strong id="ticketDoctor">-</strong>
              </div>

              <div class="ticket-info-item" style="border-top: 1px solid var(--border-color); padding-top: 0.5rem;">
                <span>Tanggal Kunjungan</span>
                <strong id="ticketDate">-</strong>
              </div>
              <div class="ticket-info-item" style="border-top: 1px solid var(--border-color); padding-top: 0.5rem;">
                <span>Waktu Konsultasi</span>
                <strong id="ticketTime">-</strong>
              </div>
            </div>

            <!-- QR Code Side -->
            <div class="ticket-qr-container">
              <span style="font-size: 0.7rem; color: var(--text-light); text-transform: uppercase; margin-bottom: 0.5rem; font-weight: 600;">No. Antrean APM</span>
              <div id="ticketQueueNum" style="font-family: var(--font-heading); font-size: 2.25rem; font-weight: 800; color: var(--primary); line-height: 1; margin-bottom: 0.75rem;">Q-00</div>
              
              <div class="qr-code-mockup">
                <i class="fa-solid fa-qrcode"></i>
              </div>
              <span style="font-size: 0.65rem; color: var(--text-light);">Scan di Mesin APM</span>
            </div>
          </div>

          <div class="ticket-footer">
            <span>* Bawa KTP & kartu BPJS (jika menggunakan jaminan BPJS).</span>
            <span>Tgl Cetak: {{ date('d F Y') }}</span>
          </div>
        </div>

        <div style="display: flex; gap: 1rem; margin-top: 1.5rem; justify-content: center;">
          <button class="btn btn-secondary" onclick="window.print()"><i class="fa-solid fa-print"></i> Cetak E-Tiket</button>
          <button class="btn btn-primary" onclick="closeModal('bookingTicketModal')">Tutup</button>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('scripts')
<script>
  // Reschedule Trigger
  function openRescheduleModal(bookingId, doctorName, briefDays, rawSchedule) {
    const rescheduleForm = document.getElementById('rescheduleForm');
    const rescheduleDate = document.getElementById('rescheduleDate');
    const rescheduleTime = document.getElementById('rescheduleTime');
    
    // Set Action Route URL dynamically
    rescheduleForm.action = "/bookings/" + bookingId + "/reschedule";
    
    document.getElementById('rescheduleDocName').textContent = doctorName;
    document.getElementById('rescheduleDocBrief').textContent = "Jadwal Praktek: " + briefDays;
    
    const schedule = JSON.parse(rawSchedule);
    
    // Setup date range: tomorrow to 1 month
    const tomorrow = new Date();
    tomorrow.setDate(tomorrow.getDate() + 1);
    const yyyy = tomorrow.getFullYear();
    let mm = tomorrow.getMonth() + 1;
    let dd = tomorrow.getDate();
    if (dd < 10) dd = '0' + dd;
    if (mm < 10) mm = '0' + mm;
    rescheduleDate.min = `${yyyy}-${mm}-${dd}`;
    
    const maxDate = new Date();
    maxDate.setMonth(maxDate.getMonth() + 1);
    const maxY = maxDate.getFullYear();
    let maxM = maxDate.getMonth() + 1;
    let maxD = maxDate.getDate();
    if (maxD < 10) maxD = '0' + maxD;
    if (maxM < 10) maxM = '0' + maxM;
    rescheduleDate.max = `${maxY}-${maxM}-${maxD}`;
    
    rescheduleDate.value = '';
    rescheduleTime.innerHTML = '<option value="">-- Pilih Jam Praktek --</option>';
    rescheduleTime.disabled = true;

    rescheduleDate.onchange = () => {
      const dateVal = rescheduleDate.value;
      if (dateVal) {
        const selectedDate = new Date(dateVal);
        const dayNames = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
        const selectedDayName = dayNames[selectedDate.getDay()];
        
        const daySchedule = schedule.find(s => s.day === selectedDayName);
        
        rescheduleTime.innerHTML = '<option value="">-- Pilih Jam Praktek --</option>';
        rescheduleTime.disabled = true;

        if (daySchedule) {
          rescheduleTime.disabled = false;
          const hoursRange = daySchedule.hours;
          const parts = hoursRange.split(' - ');
          const startH = parseInt(parts[0].split(':')[0]);
          const endH = parseInt(parts[1].split(':')[0]);
          
          for (let h = startH; h < endH; h++) {
            const hStr = h < 10 ? '0' + h : h;
            
            const opt1 = document.createElement('option');
            opt1.value = `${hStr}:00 - ${hStr}:30`;
            opt1.textContent = `${hStr}:00 - ${hStr}:30 WIB`;
            
            const opt2 = document.createElement('option');
            opt2.value = `${hStr}:30 - ${hStr + 1}:00`;
            opt2.textContent = `${hStr}:30 - ${hStr + 1}:00 WIB`;
            
            rescheduleTime.appendChild(opt1);
            rescheduleTime.appendChild(opt2);
          }
        } else {
          alert(`Maaf, dokter tidak memiliki jadwal praktek pada hari ${selectedDayName}. Jadwal praktek: ${briefDays}.`);
          rescheduleDate.value = '';
        }
      }
    };

    openModal('rescheduleModal');
  }

  // Populate & open ticket modal
  function openTicketModal(booking) {
    document.getElementById('ticketCode').textContent = booking.booking_code;
    document.getElementById('ticketPatientName').textContent = booking.patient_name;
    document.getElementById('ticketNik').textContent = booking.patient_nik;
    document.getElementById('ticketPolyclinic').textContent = booking.polyclinic_label;
    document.getElementById('ticketDoctor').textContent = booking.doctor_name;
    document.getElementById('ticketDate').textContent = booking.date_formatted;
    document.getElementById('ticketTime').textContent = booking.time + ' WIB';
    document.getElementById('ticketQueueNum').textContent = booking.queue_num;
    
    if (booking.payment_type === 'BPJS') {
      document.getElementById('ticketPayment').textContent = `BPJS (${booking.bpjs_number})`;
      document.getElementById('ticketStatusBadge').textContent = 'COVERED BY BPJS';
    } else {
      document.getElementById('ticketPayment').textContent = `Umum (Lunas - Rp ${booking.total_fee})`;
      document.getElementById('ticketStatusBadge').textContent = 'LUNAS (PAID)';
    }

    openModal('bookingTicketModal');
  }

  // Auto trigger ticket if redirected after booking creation
  @if(session('show_ticket_id'))
    @php
      $newB = $bookings->firstWhere('id', session('show_ticket_id'));
    @endphp
    @if($newB)
      document.addEventListener('DOMContentLoaded', () => {
        openTicketModal({
          booking_code: "{{ $newB->booking_code }}",
          patient_name: "{{ Auth::user()->name }}",
          patient_nik: "{{ Auth::user()->nik }}",
          polyclinic_label: "{{ $newB->polyclinic_label }}",
          doctor_name: "{{ $newB->doctor->name }}",
          date_formatted: "{{ $newB->date->format('d F Y') }}",
          time: "{{ $newB->time }}",
          queue_num: "{{ $newB->queue_num }}",
          payment_type: "{{ $newB->payment_type }}",
          bpjs_number: "{{ $newB->bpjs_number }}",
          total_fee: "{{ number_format($newB->total_fee, 0, ',', '.') }}"
        });
      });
    @endif
  @endif
</script>
@endsection
