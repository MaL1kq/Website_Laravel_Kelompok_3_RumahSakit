/* ==========================================================================
   RS GRAHA MEDIKA - GLOBAL LOGIC (JAVASCRIPT)
   ========================================================================== */

document.addEventListener('DOMContentLoaded', () => {
  
  // 0. DYNAMIC HEADER NAVIGATION
  const adjustHeaderNavigation = () => {
    const navMenuEl = document.getElementById('navMenu');
    if (!navMenuEl) return;

    if (!window.Database) return;

    const session = window.Database.getSession();
    
    // Identify current page by url path
    const currentPath = window.location.pathname.split('/').pop() || 'index.html';
    
    let menuHtml = `
      <li><a href="index.html" class="nav-link ${currentPath === 'index.html' ? 'active' : ''}">Beranda</a></li>
      <li><a href="tentang.html" class="nav-link ${currentPath === 'tentang.html' ? 'active' : ''}">Tentang Kami</a></li>
      <li><a href="layanan.html" class="nav-link ${currentPath === 'layanan.html' ? 'active' : ''}">Layanan</a></li>
      <li><a href="dokter.html" class="nav-link ${currentPath === 'dokter.html' ? 'active' : ''}">Dokter</a></li>
      <li><a href="kontak.html" class="nav-link ${currentPath === 'kontak.html' ? 'active' : ''}">Hubungi Kami</a></li>
    `;

    if (session) {
      if (session.role === 'admin') {
        menuHtml += `
          <li><a href="admin-dashboard.html" class="nav-link ${currentPath === 'admin-dashboard.html' ? 'active' : ''}">Admin Panel</a></li>
          <li class="nav-btn"><a href="#" id="logoutBtnHeaderDynamic" class="btn btn-secondary" style="padding: 0.5rem 1.25rem; font-size: 0.85rem;">Keluar</a></li>
        `;
      } else {
        menuHtml += `
          <li><a href="patient-dashboard.html" class="nav-link ${currentPath === 'patient-dashboard.html' ? 'active' : ''}">Dashboard</a></li>
          <li class="nav-btn"><a href="#" id="logoutBtnHeaderDynamic" class="btn btn-secondary" style="padding: 0.5rem 1.25rem; font-size: 0.85rem;">Keluar</a></li>
        `;
      }
    } else {
      menuHtml += `
        <li><a href="login.html" class="nav-link ${currentPath === 'login.html' ? 'active' : ''}">Masuk</a></li>
        <li class="nav-btn"><a href="reservasi.html" class="btn btn-primary">Daftar Online</a></li>
      `;
    }

    navMenuEl.innerHTML = menuHtml;

    // Attach logout event
    const logoutBtn = document.getElementById('logoutBtnHeaderDynamic');
    if (logoutBtn) {
      logoutBtn.addEventListener('click', (e) => {
        e.preventDefault();
        if (confirm("Apakah Anda yakin ingin keluar dari akun?")) {
          window.Database.logout();
          window.location.href = 'index.html';
        }
      });
    }
  };

  adjustHeaderNavigation();

  // 1. HEADER SCROLL EFFECT
  const header = document.querySelector('header');
  if (header) {
    window.addEventListener('scroll', () => {
      if (window.scrollY > 50) {
        header.classList.add('scrolled');
      } else {
        header.classList.remove('scrolled');
      }
    });
  }

  // 2. MOBILE MENU TOGGLE
  const menuToggle = document.getElementById('menuToggle');
  const navMenu = document.getElementById('navMenu');
  
  if (menuToggle && navMenu) {
    menuToggle.addEventListener('click', () => {
      menuToggle.classList.toggle('active');
      navMenu.classList.toggle('active');
    });
  }

  // 3. MODAL LOGIC (OPEN & CLOSE)
  const modalOverlays = document.querySelectorAll('.modal-overlay');
  const modalCloseButtons = document.querySelectorAll('.modal-close-btn');

  window.openModal = function(modalId) {
    const modal = document.getElementById(modalId);
    if (modal) {
      modal.classList.add('active');
      document.body.style.overflow = 'hidden';
    }
  };

  window.closeModal = function(modalId) {
    const modal = document.getElementById(modalId);
    if (modal) {
      modal.classList.remove('active');
      document.body.style.overflow = '';
    }
  };

  modalCloseButtons.forEach(btn => {
    btn.addEventListener('click', (e) => {
      const overlay = e.target.closest('.modal-overlay');
      if (overlay) {
        closeModal(overlay.id);
      }
    });
  });

  modalOverlays.forEach(overlay => {
    overlay.addEventListener('click', (e) => {
      if (e.target === overlay) {
        closeModal(overlay.id);
      }
    });
  });

  document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape') {
      const activeModal = document.querySelector('.modal-overlay.active');
      if (activeModal) {
        closeModal(activeModal.id);
      }
    }
  });

  const rawDoctors = window.INITIAL_DOCTORS || (window.Database ? window.Database.getDoctors() : []);
  const doctorsData = rawDoctors.map(doc => ({
    id: doc.id,
    name: doc.name,
    spec: doc.spec,
    specLabel: doc.spec_label || doc.specLabel,
    avatarIcon: doc.avatar_icon || doc.avatarIcon,
    fee: doc.fee,
    rating: doc.rating,
    schedule: doc.schedule,
    briefDays: doc.brief_days || doc.briefDays
  }));

  // Helper to render doctor cards (Anaverse Style)
  function createDoctorCardHTML(doc) {
    return `
      <div class="doctor-card">
        <div class="doctor-img-container">
          <i class="fa-solid ${doc.avatarIcon}"></i>
        </div>
        <div class="doctor-card-content">
          <span class="doctor-card-spec">${doc.specLabel}</span>
          <h3 class="doctor-card-name">${doc.name}</h3>
          <div class="doctor-rating">
            <i class="fa-solid fa-star"></i> <span>${doc.rating.toFixed(1)}</span> (Rating)
          </div>
          <div class="doctor-card-footer">
            <div class="doctor-fee-info">
              <span>Biaya Konsultasi</span>
              <div class="doctor-fee-price">Rp ${doc.fee.toLocaleString('id-ID')}</div>
            </div>
            <button class="btn btn-primary" style="font-size: 0.8rem; padding: 0.5rem 1.25rem;" onclick="location.href=(window.isLaravel ? '/reservasi' : 'reservasi.html') + '?doc=${doc.id}'">
              Buat Janji
            </button>
          </div>
        </div>
      </div>
    `;
  }

  // 5. CARI & FILTER DOKTER (For dokter.html)
  const searchInput = document.getElementById('searchDoctorName');
  const polyclinicFilter = document.getElementById('filterPolyclinic');
  const doctorsGridContainer = document.getElementById('doctorsGrid');

  function renderDoctors(filteredDoctors) {
    if (!doctorsGridContainer) return;
    
    doctorsGridContainer.innerHTML = '';
    
    if (filteredDoctors.length === 0) {
      doctorsGridContainer.innerHTML = `
        <div style="grid-column: 1 / -1; padding: 4rem 0; text-align: center;">
          <i class="fa-solid fa-user-slash" style="font-size: 3.5rem; color: var(--text-light); margin-bottom: 1.25rem;"></i>
          <p style="color: var(--text-medium); font-size: 1.05rem;">Dokter yang Anda cari tidak ditemukan. Coba ketik nama lain atau ganti filter poliklinik.</p>
        </div>
      `;
      return;
    }

    filteredDoctors.forEach(doc => {
      doctorsGridContainer.innerHTML += createDoctorCardHTML(doc);
    });
  }

  if (doctorsGridContainer) {
    renderDoctors(doctorsData);

    const filterHandler = () => {
      const searchValue = searchInput ? searchInput.value.toLowerCase().trim() : '';
      const filterValue = polyclinicFilter ? polyclinicFilter.value : 'all';
      
      const filtered = doctorsData.filter(doc => {
        const matchesSearch = doc.name.toLowerCase().includes(searchValue);
        const matchesPoly = (filterValue === 'all' || doc.spec === filterValue);
        return matchesSearch && matchesPoly;
      });
      
      renderDoctors(filtered);
    };

    if (searchInput) searchInput.addEventListener('input', filterHandler);
    if (polyclinicFilter) polyclinicFilter.addEventListener('change', filterHandler);
  }

  // 5.1 RENDER PREVIEW DOCTORS (For index.html doctors section)
  const indexDoctorsCarousel = document.getElementById('indexDoctorsCarousel');
  if (indexDoctorsCarousel) {
    indexDoctorsCarousel.innerHTML = '';
    // Display first 4 doctors as a preview
    const previewDocs = doctorsData.slice(0, 4);
    previewDocs.forEach(doc => {
      indexDoctorsCarousel.innerHTML += createDoctorCardHTML(doc);
    });
  }

  // 6. ONLINE RESERVATION & SIMULATED PAYMENTS PROCESS (For reservasi.html)
  const bookingForm = document.getElementById('bookingForm');
  if (bookingForm) {
    const session = window.session || (window.Database ? window.Database.getSession() : null);
    
    // Auth Check
    if (!session || session.role !== 'patient') {
      alert("Untuk melakukan pendaftaran antrean online, Anda harus masuk/mendaftar akun terlebih dahulu.");
      window.location.href = window.isLaravel ? '/login?redirect=/reservasi' : 'login.html?redirect=reservasi.html';
      return;
    }

    // Auto Fill Patient Details
    document.getElementById('patientName').value = session.name;
    document.getElementById('patientName').setAttribute('readonly', 'readonly');
    document.getElementById('patientNik').value = session.nik;
    document.getElementById('patientNik').setAttribute('readonly', 'readonly');
    document.getElementById('patientDob').value = session.dob;
    document.getElementById('patientDob').setAttribute('readonly', 'readonly');
    document.getElementById('patientPhone').value = session.phone;
    document.getElementById('patientPhone').setAttribute('readonly', 'readonly');

    const formSteps = document.querySelectorAll('.form-section');
    const stepIndicators = document.querySelectorAll('.step-indicator');
    const btnNext1 = document.getElementById('btnNext1');
    const btnNext2 = document.getElementById('btnNext2');
    const btnPrev2 = document.getElementById('btnPrev2');
    const btnPrev3 = document.getElementById('btnPrev3');
    
    const inputPoliklinik = document.getElementById('bookingPolyclinic');
    const inputDokter = document.getElementById('bookingDoctor');
    const inputTanggal = document.getElementById('bookingDate');
    const inputJam = document.getElementById('bookingTime');
    
    const insuranceRadios = document.querySelectorAll('input[name="payment_type"]');
    const bpjsFieldGroup = document.getElementById('bpjsFieldGroup');
    const insuranceCards = document.querySelectorAll('.insurance-select .custom-radio');
    
    // Checkout Invoice Elements
    const checkoutInvoicePanel = document.getElementById('checkoutInvoicePanel');
    const invoiceDocName = document.getElementById('invoiceDocName');
    const invoiceDocFee = document.getElementById('invoiceDocFee');
    const invoiceAdminFee = document.getElementById('invoiceAdminFee');
    const invoiceTotal = document.getElementById('invoiceTotal');
    const paymentGatewaySelector = document.getElementById('paymentGatewaySelector');

    // Simulated Gateway Selector
    const paymentRadioButtons = document.querySelectorAll('input[name="payment_gateway"]');
    const gatewayCards = document.querySelectorAll('.payment-methods-grid .payment-method-card');

    paymentRadioButtons.forEach(radio => {
      radio.addEventListener('change', (e) => {
        gatewayCards.forEach(c => c.classList.remove('selected'));
        e.target.closest('.payment-method-card').classList.add('selected');
      });
    });

    // Helper to calculate invoice values
    const updateInvoice = () => {
      const docId = inputDokter.value;
      const selectedInsurance = document.querySelector('input[name="payment_type"]:checked').value;
      
      if (!docId) {
        checkoutInvoicePanel.style.display = 'none';
        return;
      }
      
      const doc = doctorsData.find(d => d.id === docId || d.id == docId);
      if (!doc) return;
      
      checkoutInvoicePanel.style.display = 'block';
      invoiceDocName.textContent = doc.name + " (" + doc.specLabel + ")";
      
      if (selectedInsurance === 'BPJS') {
        invoiceDocFee.textContent = "Rp 0 (BPJS)";
        invoiceAdminFee.textContent = "Rp 0";
        invoiceTotal.textContent = "Rp 0 (Ditanggung BPJS)";
        paymentGatewaySelector.style.display = 'none';
      } else {
        const adminFee = 15000;
        const total = doc.fee + adminFee;
        
        invoiceDocFee.textContent = "Rp " + doc.fee.toLocaleString('id-ID');
        invoiceAdminFee.textContent = "Rp " + adminFee.toLocaleString('id-ID');
        invoiceTotal.textContent = "Rp " + total.toLocaleString('id-ID');
        paymentGatewaySelector.style.display = 'block';
      }
    };

    // BPJS/Mandiri Radio change handler
    insuranceRadios.forEach(radio => {
      radio.addEventListener('change', (e) => {
        insuranceCards.forEach(card => card.classList.remove('selected'));
        e.target.closest('.custom-radio').classList.add('selected');
        
        if (e.target.value === 'BPJS') {
          bpjsFieldGroup.style.display = 'block';
          document.getElementById('bpjsNumber').setAttribute('required', 'required');
        } else {
          bpjsFieldGroup.style.display = 'none';
          document.getElementById('bpjsNumber').removeAttribute('required');
        }
        updateInvoice();
      });
    });

    // Poliklinik dropdown change handler
    inputPoliklinik.addEventListener('change', () => {
      const inputPoliklinikLabel = document.getElementById('bookingPolyclinicLabel');
      if (inputPoliklinikLabel && inputPoliklinik.selectedIndex > 0) {
        inputPoliklinikLabel.value = inputPoliklinik.options[inputPoliklinik.selectedIndex].text;
      }
      const selectedPoly = inputPoliklinik.value;
      inputDokter.innerHTML = '<option value="">-- Pilih Dokter Spesialis --</option>';
      inputJam.innerHTML = '<option value="">-- Pilih Jam Praktek --</option>';
      inputDokter.disabled = !selectedPoly;
      inputTanggal.disabled = true;
      inputJam.disabled = true;
      checkoutInvoicePanel.style.display = 'none';
      
      if (selectedPoly) {
        const polyDocs = doctorsData.filter(d => d.spec === selectedPoly);
        polyDocs.forEach(doc => {
          const opt = document.createElement('option');
          opt.value = doc.id;
          opt.textContent = doc.name + " (Rp " + doc.fee.toLocaleString('id-ID') + ")";
          inputDokter.appendChild(opt);
        });
      }
    });

    // Doctor dropdown change handler
    inputDokter.addEventListener('change', () => {
      const selectedDocId = inputDokter.value;
      inputTanggal.disabled = !selectedDocId;
      inputJam.innerHTML = '<option value="">-- Pilih Jam Praktek --</option>';
      inputJam.disabled = true;
      
      const practiceDaysInfo = document.getElementById('doctorPracticeDaysInfo');
      const selectedDoc = doctorsData.find(d => d.id === selectedDocId || d.id == selectedDocId);
      if (selectedDoc && practiceDaysInfo) {
        practiceDaysInfo.textContent = `Jadwal Praktek Dokter: ${selectedDoc.briefDays || selectedDoc.brief_days}`;
        practiceDaysInfo.style.display = 'block';
      } else if (practiceDaysInfo) {
        practiceDaysInfo.style.display = 'none';
      }
      
      if (selectedDocId) {
        const tomorrow = new Date();
        tomorrow.setDate(tomorrow.getDate() + 1);
        const yyyy = tomorrow.getFullYear();
        let mm = tomorrow.getMonth() + 1;
        let dd = tomorrow.getDate();
        if (dd < 10) dd = '0' + dd;
        if (mm < 10) mm = '0' + mm;
        
        inputTanggal.min = `${yyyy}-${mm}-${dd}`;
        
        const maxDate = new Date();
        maxDate.setMonth(maxDate.getMonth() + 1);
        const maxY = maxDate.getFullYear();
        let maxM = maxDate.getMonth() + 1;
        let maxD = maxDate.getDate();
        if (maxD < 10) maxD = '0' + maxD;
        if (maxM < 10) maxM = '0' + maxM;
        
        inputTanggal.max = `${maxY}-${maxM}-${maxD}`;
        updateInvoice();
      } else {
        checkoutInvoicePanel.style.display = 'none';
      }
    });

    // Date change handler
    inputTanggal.addEventListener('change', () => {
      const selectedDateVal = inputTanggal.value;
      const docId = inputDokter.value;
      inputJam.innerHTML = '<option value="">-- Pilih Jam Praktek --</option>';
      inputJam.disabled = true;
      
      if (selectedDateVal && docId) {
        const dateObj = new Date(selectedDateVal);
        const dayNames = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
        const selectedDayName = dayNames[dateObj.getDay()];
        
        const doc = doctorsData.find(d => d.id === docId || d.id == docId);
        const daySchedule = doc ? doc.schedule.find(s => s.day === selectedDayName) : null;
        
        if (daySchedule) {
          inputJam.disabled = false;
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
            
            inputJam.appendChild(opt1);
            inputJam.appendChild(opt2);
          }
        } else {
          alert(`Maaf, ${doc.name} tidak memiliki jadwal praktek pada hari ${selectedDayName}. Silakan pilih hari/tanggal praktek dokter yang sesuai (${doc.briefDays}).`);
          inputTanggal.value = '';
        }
      }
    });

    // Form Step Controller
    const showStep = (stepIndex) => {
      formSteps.forEach((step, idx) => {
        if (idx === stepIndex) {
          step.classList.add('active');
        } else {
          step.classList.remove('active');
        }
      });

      stepIndicators.forEach((ind, idx) => {
        if (idx <= stepIndex) {
          ind.classList.add('active');
          if (idx < stepIndex) ind.classList.add('completed');
          else ind.classList.remove('completed');
        } else {
          ind.classList.remove('active');
          ind.classList.remove('completed');
        }
      });
    };

    btnNext1.addEventListener('click', () => {
      if (!inputPoliklinik.value) {
        alert('Silakan pilih Poliklinik terlebih dahulu.');
        return;
      }
      if (!inputDokter.value) {
        alert('Silakan pilih Dokter Spesialis.');
        return;
      }
      showStep(1);
    });

    btnNext2.addEventListener('click', () => {
      if (!inputTanggal.value) {
        alert('Silakan pilih Tanggal Kunjungan.');
        return;
      }
      if (!inputJam.value) {
        alert('Silakan pilih Jam Praktek Dokter.');
        return;
      }
      showStep(2);
    });

    btnPrev2.addEventListener('click', () => {
      showStep(0);
    });

    btnPrev3.addEventListener('click', () => {
      showStep(1);
    });

    // Pre-populate if doc param in query
    const urlParams = new URLSearchParams(window.location.search);
    const docParam = urlParams.get('doc');
    if (docParam) {
      const selectedDoc = doctorsData.find(d => d.id === docParam || d.id == docParam);
      if (selectedDoc) {
        inputPoliklinik.value = selectedDoc.spec;
        const changeEvent = new Event('change');
        inputPoliklinik.dispatchEvent(changeEvent);
        
        inputDokter.value = selectedDoc.id;
        inputDokter.dispatchEvent(changeEvent);
      }
    }

    // Submit Booking & Simulated Payment Gateway
    let isSimulatedPaid = false;
    bookingForm.addEventListener('submit', (e) => {
      // Check if we are running in Laravel mode
      const isLaravel = bookingForm.getAttribute('action') !== null;
      
      const paymentType = document.querySelector('input[name="payment_type"]:checked').value;
      
      if (isLaravel) {
        if (paymentType === 'Mandiri' && !isSimulatedPaid) {
          e.preventDefault();
          openModal('paymentLoadingModal');
          setTimeout(() => {
            isSimulatedPaid = true;
            bookingForm.submit();
          }, 2200);
        }
        // If BPJS or already simulated, let it submit normally to Laravel
        return;
      }
      
      // Standard static/localStorage implementation fallback
      e.preventDefault();
      const bpjsNumber = document.getElementById('bpjsNumber').value.trim();
      const doc = doctorsData.find(d => d.id === inputDokter.value || d.id == inputDokter.value);
      
      let adminFee = 0;
      let docFee = 0;
      let totalFee = 0;
      let paymentStatus = 'Covered by BPJS';
      
      if (paymentType === 'Mandiri') {
        adminFee = 15000;
        docFee = doc.fee;
        totalFee = docFee + adminFee;
        paymentStatus = 'Paid'; // Will mark as paid after loading simulator
      }

      const bookingData = {
        patientId: session.id,
        patientName: session.name,
        patientNik: session.nik,
        patientDob: session.dob,
        patientPhone: session.phone,
        polyclinic: inputPoliklinik.value,
        polyclinicLabel: doc.specLabel,
        doctorId: doc.id,
        doctorName: doc.name,
        date: inputTanggal.value,
        time: inputJam.value,
        paymentType: paymentType,
        bpjsNumber: paymentType === 'BPJS' ? bpjsNumber : '',
        docFee: docFee,
        adminFee: adminFee,
        totalFee: totalFee,
        paymentStatus: paymentType === 'BPJS' ? 'Covered by BPJS' : 'Pending Payment'
      };

      // Trigger checkout gateway process
      if (paymentType === 'Mandiri') {
        // Show simulated loading payment modal
        openModal('paymentLoadingModal');
        
        setTimeout(() => {
          // Complete payment and generate booking record
          bookingData.paymentStatus = 'Paid';
          executeBookingCreation(bookingData);
        }, 2200);
      } else {
        // Immediately execute for BPJS patients
        executeBookingCreation(bookingData);
      }
    });

    function executeBookingCreation(bookingData) {
      try {
        const newBooking = window.Database.createBooking(bookingData);
        
        // Hide payment loading if it was open
        closeModal('paymentLoadingModal');
        
        // Populate E-Ticket fields
        document.getElementById('ticketCode').textContent = newBooking.bookingCode;
        document.getElementById('ticketPatientName').textContent = newBooking.patientName;
        document.getElementById('ticketNik').textContent = newBooking.patientNik;
        document.getElementById('ticketPolyclinic').textContent = newBooking.polyclinicLabel;
        document.getElementById('ticketDoctor').textContent = newBooking.doctorName;
        
        const dateParts = newBooking.date.split('-');
        const monthsIndo = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
        const dateFormatted = `${dateParts[2]} ${monthsIndo[parseInt(dateParts[1]) - 1]} ${dateParts[0]}`;
        
        document.getElementById('ticketDate').textContent = dateFormatted;
        document.getElementById('ticketTime').textContent = newBooking.time + ' WIB';
        
        // Display fee status on ticket
        if (newBooking.paymentType === 'BPJS') {
          document.getElementById('ticketPayment').textContent = `BPJS (${newBooking.bpjsNumber})`;
          document.getElementById('ticketStatusBadge').textContent = 'COVERED BY BPJS';
          document.getElementById('ticketStatusBadge').style.backgroundColor = 'var(--primary)';
        } else {
          document.getElementById('ticketPayment').textContent = `Umum (Lunas - Rp ${newBooking.totalFee.toLocaleString('id-ID')})`;
          document.getElementById('ticketStatusBadge').textContent = 'LUNAS (PAID)';
          document.getElementById('ticketStatusBadge').style.backgroundColor = 'var(--primary)';
        }
        
        document.getElementById('ticketQueueNum').textContent = newBooking.queueNum;
        
        // Open E-Ticket Modal
        openModal('bookingTicketModal');

        // Setup dashboard redirect upon closing
        const ticketModal = document.getElementById('bookingTicketModal');
        if (ticketModal) {
          const closeBtn = ticketModal.querySelector('.modal-close-btn');
          if (closeBtn) {
            closeBtn.addEventListener('click', () => {
              window.location.href = window.isLaravel ? '/patient/dashboard' : 'patient-dashboard.html';
            });
          }
          const selesaiBtn = ticketModal.querySelector('.modal-body button.btn-primary');
          if (selesaiBtn) {
            selesaiBtn.setAttribute('onclick', "closeModal('bookingTicketModal'); window.location.href='" + (window.isLaravel ? "/patient/dashboard" : "patient-dashboard.html") + "';");
          }
        }
      } catch(err) {
        closeModal('paymentLoadingModal');
        alert(err.message);
      }
    }
  }

  // Print ticket action
  window.printTicket = function() {
    window.print();
  };

  // 7. CONTACT MESSAGES SIMULATION
  const contactForm = document.getElementById('contactForm');
  if (contactForm) {
    contactForm.addEventListener('submit', (e) => {
      e.preventDefault();
      alert('Terima kasih! Pesan Anda telah berhasil terkirim ke RS Graha Medika. Layanan Pengaduan/Humas kami akan segera menghubungi Anda melalui email atau nomor telepon yang dicantumkan.');
      contactForm.reset();
    });
  }
});
