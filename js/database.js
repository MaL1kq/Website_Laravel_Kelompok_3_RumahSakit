/* ==========================================================================
   RS GRAHA MEDIKA - LOCALSTORAGE DATABASE ENGINE
   ========================================================================== */

const DB_KEYS = {
  USERS: 'rsgm_users',
  BOOKINGS: 'rsgm_bookings',
  DOCTORS: 'rsgm_doctors',
  SESSION: 'rsgm_session'
};

// Default Admin Account
const DEFAULT_ADMIN = {
  username: 'admin',
  email: 'admin@grahamedika.com',
  password: 'admin123',
  name: 'Administrator RSGM',
  role: 'admin'
};

// Initial Doctors Seeding Data
const INITIAL_DOCTORS = [
  {
    id: "doc-1",
    name: "dr. Adrian Sp.A",
    email: "adrian@grahamedika.com", password: "dokter123", role: "doctor", phone: "081234567891", email: "rian@grahamedika.com", password: "dokter123", role: "doctor", phone: "081234567892", spec: "anak", specLabel: "Spesialis Anak (Pediatri)",
    avatarIcon: "fa-baby-carriage",
    fee: 150000,
    rating: 4.9,
    schedule: [
      { day: "Senin", hours: "08:00 - 12:00" },
      { day: "Rabu", hours: "08:00 - 12:00" },
      { day: "Jumat", hours: "08:00 - 12:00" }
    ],
    briefDays: "Senin, Rabu, Jumat"
  },
  {
    id: "doc-2",
    name: "dr. Rian Sp.A",
    spec: "anak",
    specLabel: "Spesialis Anak (Pediatri)",
    avatarIcon: "fa-child",
    fee: 140000,
    rating: 4.8,
    schedule: [
      { day: "Selasa", hours: "13:00 - 16:00" },
      { day: "Kamis", hours: "13:00 - 16:00" },
      { day: "Sabtu", hours: "09:00 - 12:00" }
    ],
    briefDays: "Selasa, Kamis, Sabtu"
  },
  {
    id: "doc-3",
    name: "dr. Sarah Sp.OG",
    email: "sarah@grahamedika.com", password: "dokter123", role: "doctor", phone: "081234567893", email: "kartika@grahamedika.com", password: "dokter123", role: "doctor", phone: "081234567894", spec: "kandungan", specLabel: "Spesialis Kandungan & Kebidanan",
    avatarIcon: "fa-person-pregnant",
    fee: 180000,
    rating: 4.9,
    schedule: [
      { day: "Senin", hours: "14:00 - 18:00" },
      { day: "Selasa", hours: "14:00 - 18:00" },
      { day: "Kamis", hours: "14:00 - 18:00" }
    ],
    briefDays: "Senin, Selasa, Kamis"
  },
  {
    id: "doc-4",
    name: "dr. Kartika Sp.OG",
    spec: "kandungan",
    specLabel: "Spesialis Kandungan & Kebidanan",
    avatarIcon: "fa-female",
    fee: 175000,
    rating: 4.9,
    schedule: [
      { day: "Rabu", hours: "09:00 - 13:00" },
      { day: "Jumat", hours: "09:00 - 13:00" },
      { day: "Sabtu", hours: "13:00 - 16:00" }
    ],
    briefDays: "Rabu, Jumat, Sabtu"
  },
  {
    id: "doc-5",
    name: "dr. Budi Sp.PD",
    email: "budi.spec@grahamedika.com", password: "dokter123", role: "doctor", phone: "081234567895", spec: "dalam", specLabel: "Spesialis Penyakit Dalam",
    avatarIcon: "fa-stethoscope",
    fee: 160000,
    rating: 4.8,
    schedule: [
      { day: "Senin", hours: "09:00 - 13:00" },
      { day: "Selasa", hours: "09:00 - 13:00" },
      { day: "Rabu", hours: "13:00 - 17:00" },
      { day: "Jumat", hours: "13:00 - 17:00" }
    ],
    briefDays: "Senin s/d Jumat"
  },
  {
    id: "doc-6",
    name: "dr. Haryono Sp.JP",
    email: "haryono@grahamedika.com", password: "dokter123", role: "doctor", phone: "081234567896", spec: "jantung", specLabel: "Spesialis Jantung & Pembuluh Darah",
    avatarIcon: "fa-heart-pulse",
    fee: 250000,
    rating: 4.9,
    schedule: [
      { day: "Selasa", hours: "08:00 - 11:00" },
      { day: "Kamis", hours: "08:00 - 11:00" }
    ],
    briefDays: "Selasa & Kamis"
  },
  {
    id: "doc-7",
    name: "dr. Wijaya Sp.B",
    email: "wijaya@grahamedika.com", password: "dokter123", role: "doctor", phone: "081234567897", spec: "bedah", specLabel: "Spesialis Bedah Umum",
    avatarIcon: "fa-scalpel",
    fee: 220000,
    rating: 4.8,
    schedule: [
      { day: "Senin", hours: "13:00 - 16:00" },
      { day: "Rabu", hours: "13:00 - 16:00" },
      { day: "Kamis", hours: "09:00 - 12:00" }
    ],
    briefDays: "Senin, Rabu, Kamis"
  },
  {
    id: "doc-8",
    name: "drg. Shinta",
    email: "shinta@grahamedika.com", password: "dokter123", role: "doctor", phone: "081234567898", spec: "gigi", specLabel: "Dokter Gigi & Mulut",
    avatarIcon: "fa-tooth",
    fee: 130000,
    rating: 4.9,
    schedule: [
      { day: "Senin", hours: "09:00 - 12:00" },
      { day: "Selasa", hours: "14:00 - 17:00" },
      { day: "Rabu", hours: "09:00 - 12:00" },
      { day: "Kamis", hours: "14:00 - 17:00" },
      { day: "Jumat", hours: "09:00 - 12:00" }
    ],
    briefDays: "Senin s/d Jumat"
  }
];

// Initialize Database Storage
function initDatabase() {
  let existingDocs = [];
  try {
    existingDocs = JSON.parse(localStorage.getItem(DB_KEYS.DOCTORS)) || [];
  } catch (e) {}

  // Re-seed if database is empty or existing doctors don't have fee property (migration)
  const needsReseed = existingDocs.length === 0 || !existingDocs[0].hasOwnProperty('fee');

  if (needsReseed) {
    localStorage.setItem(DB_KEYS.DOCTORS, JSON.stringify(INITIAL_DOCTORS));
  }
  let users = [];
  try {
    users = JSON.parse(localStorage.getItem(DB_KEYS.USERS)) || [];
  } catch (e) {}

  const hasBudi = users.some(u => u.email === 'budi@gmail.com');
  if (!hasBudi) {
    const defaultPatient = {
      id: 'usr-default-patient',
      name: 'Budi Santoso',
      nik: '3172010203040005',
      dob: '1990-05-15',
      phone: '081234567890',
      email: 'budi@gmail.com',
      password: 'budi123',
      role: 'patient'
    };
    users.push(defaultPatient);
    localStorage.setItem(DB_KEYS.USERS, JSON.stringify(users));
  }
  if (!localStorage.getItem(DB_KEYS.BOOKINGS)) {
    localStorage.setItem(DB_KEYS.BOOKINGS, JSON.stringify([]));
  }
}

// Call initialization
initDatabase();

// DATABASE API METHODS
const Database = {
  // --- DOCTORS ---
  getDoctors() {
    return JSON.parse(localStorage.getItem(DB_KEYS.DOCTORS)) || [];
  },
  
  
  registerDoctor(data) {
    let doctors = this.getDoctors();
    if (doctors.some(d => d.email === data.email)) {
      throw new Error("Alamat email dokter sudah terdaftar.");
    }
    const labels = {
      anak: "Spesialis Anak (Pediatri)",
      kandungan: "Spesialis Kandungan & Kebidanan",
      dalam: "Spesialis Penyakit Dalam",
      jantung: "Spesialis Jantung & Pembuluh Darah",
      bedah: "Spesialis Bedah Umum",
      gigi: "Dokter Gigi & Mulut"
    };
    const icons = {
      anak: "fa-child",
      kandungan: "fa-person-pregnant",
      dalam: "fa-stethoscope",
      jantung: "fa-heart-pulse",
      bedah: "fa-scalpel",
      gigi: "fa-tooth"
    };
    const schedule = data.workingDays.map(day => ({
      day: day,
      hours: `${data.hoursStart} - ${data.hoursEnd}`
    }));
    let brief = data.workingDays.join(', ');
    if (data.workingDays.length === 5 && !data.workingDays.includes('Sabtu') && !data.workingDays.includes('Minggu')) {
      brief = "Senin s/d Jumat";
    }
    const newDoc = {
      id: "doc-" + Date.now(),
      name: data.name,
      email: data.email,
      password: data.password || "dokter123",
      role: "doctor",
      phone: data.phone,
      spec: data.spec,
      specLabel: labels[data.spec] || "Spesialis Medis",
      avatarIcon: icons[data.spec] || "fa-user-doctor",
      fee: parseInt(data.fee) || 150000,
      rating: 4.8,
      schedule: schedule,
      briefDays: brief
    };
    doctors.push(newDoc);
    localStorage.setItem(DB_KEYS.DOCTORS, JSON.stringify(doctors));
    return newDoc;
  },

  addDoctor(name, spec, scheduleDays, fee = 100000) {
    const doctors = this.getDoctors();
    const id = 'doc-' + Date.now();
    
    // Construct schedule objects based on days selected
    const schedule = scheduleDays.map(day => ({
      day: day,
      hours: "09:00 - 12:00" // default time block
    }));

    const labels = {
      anak: "Spesialis Anak (Pediatri)",
      kandungan: "Spesialis Kandungan & Kebidanan",
      dalam: "Spesialis Penyakit Dalam",
      jantung: "Spesialis Jantung & Pembuluh Darah",
      bedah: "Spesialis Bedah Umum",
      gigi: "Dokter Gigi & Mulut"
    };

    const icons = {
      anak: "fa-baby-carriage",
      kandungan: "fa-person-pregnant",
      dalam: "fa-stethoscope",
      jantung: "fa-heart-pulse",
      bedah: "fa-scalpel",
      gigi: "fa-tooth"
    };

    const newDoc = {
      id,
      name,
      spec,
      specLabel: labels[spec] || "Dokter Umum",
      avatarIcon: icons[spec] || "fa-user-doctor",
      fee: parseInt(fee),
      rating: 4.8, // Default rating for new doctor
      schedule,
      briefDays: scheduleDays.join(', ')
    };

    doctors.push(newDoc);
    localStorage.setItem(DB_KEYS.DOCTORS, JSON.stringify(doctors));
    return newDoc;
  },

  deleteDoctor(id) {
    let doctors = this.getDoctors();
    doctors = doctors.filter(d => d.id !== id);
    localStorage.setItem(DB_KEYS.DOCTORS, JSON.stringify(doctors));
  },

  // --- AUTHENTICATION ---
  getUsers() {
    return JSON.parse(localStorage.getItem(DB_KEYS.USERS)) || [];
  },

  registerUser(name, nik, dob, phone, email, password) {
    const users = this.getUsers();
    
    // Check if email already exists
    if (users.find(u => u.email === email)) {
      throw new Error("Email ini sudah terdaftar.");
    }
    // Check NIK
    if (users.find(u => u.nik === nik)) {
      throw new Error("NIK ini sudah terdaftar.");
    }

    const newUser = {
      id: 'usr-' + Date.now(),
      name,
      nik,
      dob,
      phone,
      email,
      password, // In real apps we hash this, in demo localstorage raw text is okay
      role: 'patient'
    };

    users.push(newUser);
    localStorage.setItem(DB_KEYS.USERS, JSON.stringify(users));
    return newUser;
  },

  login(email, password) {
    // Check Admin first
    if (email === DEFAULT_ADMIN.username || email === DEFAULT_ADMIN.email) {
      if (password === DEFAULT_ADMIN.password) {
        const session = {
          name: DEFAULT_ADMIN.name,
          email: DEFAULT_ADMIN.email,
          role: 'admin'
        };
        localStorage.setItem(DB_KEYS.SESSION, JSON.stringify(session));
        return session;
      } else {
        throw new Error("Kata sandi admin salah.");
      }
    }

    // 2. Check Doctors
    const doctors = this.getDoctors();
    const doc = doctors.find(d => d.email === email && d.password === password);
    if (doc) {
      const session = {
        id: doc.id,
        name: doc.name,
        email: doc.email,
        phone: doc.phone || "081234567890",
        spec: doc.spec,
        specLabel: doc.specLabel,
        avatarIcon: doc.avatarIcon,
        fee: doc.fee,
        briefDays: doc.briefDays,
        role: "doctor"
      };
      localStorage.setItem(DB_KEYS.SESSION, JSON.stringify(session));
      return session;
    }

    // 3. Check normal patients
    const users = this.getUsers();
    const user = users.find(u => u.email === email && u.password === password);
    
    if (!user) {
      throw new Error("Email atau Kata sandi tidak cocok.");
    }

    const session = {
      id: user.id,
      name: user.name,
      nik: user.nik,
      dob: user.dob,
      phone: user.phone,
      email: user.email,
      role: 'patient'
    };
    
    localStorage.setItem(DB_KEYS.SESSION, JSON.stringify(session));
    return session;
  },

  logout() {
    localStorage.removeItem(DB_KEYS.SESSION);
  },

  getSession() {
    return JSON.parse(localStorage.getItem(DB_KEYS.SESSION)) || null;
  },

  // --- BOOKINGS (CRUD) ---
  getBookings() {
    return JSON.parse(localStorage.getItem(DB_KEYS.BOOKINGS)) || [];
  },

  getUserBookings(userId) {
    const bookings = this.getBookings();
    return bookings.filter(b => b.patientId === userId);
  },

  createBooking(bookingData) {
    const bookings = this.getBookings();
    const id = 'bkg-' + Date.now();
    const randNum = Math.floor(1000 + Math.random() * 9000);
    const bookingCode = `RSGM-${new Date().getFullYear()}-${randNum}`;
    const queueNum = 'Q-' + Math.floor(10 + Math.random() * 40);

    const newBooking = {
      id,
      bookingCode,
      queueNum,
      status: 'Pending', // default status
      createdAt: new Date().toISOString(),
      ...bookingData
    };

    bookings.push(newBooking);
    localStorage.setItem(DB_KEYS.BOOKINGS, JSON.stringify(bookings));
    return newBooking;
  },

  rescheduleBooking(bookingId, date, time) {
    const bookings = this.getBookings();
    const bookingIndex = bookings.findIndex(b => b.id === bookingId);
    
    if (bookingIndex === -1) {
      throw new Error("Reservasi tidak ditemukan.");
    }

    bookings[bookingIndex].date = date;
    bookings[bookingIndex].time = time;
    bookings[bookingIndex].status = 'Pending'; // Reset to pending for approval
    localStorage.setItem(DB_KEYS.BOOKINGS, JSON.stringify(bookings));
    return bookings[bookingIndex];
  },

  cancelBooking(bookingId) {
    const bookings = this.getBookings();
    const bookingIndex = bookings.findIndex(b => b.id === bookingId);
    
    if (bookingIndex === -1) {
      throw new Error("Reservasi tidak ditemukan.");
    }

    bookings[bookingIndex].status = 'Canceled';
    localStorage.setItem(DB_KEYS.BOOKINGS, JSON.stringify(bookings));
    return bookings[bookingIndex];
  },

  updateBookingStatus(bookingId, status) {
    const bookings = this.getBookings();
    const bookingIndex = bookings.findIndex(b => b.id === bookingId);
    
    if (bookingIndex === -1) {
      throw new Error("Reservasi tidak ditemukan.");
    }

    bookings[bookingIndex].status = status;
    localStorage.setItem(DB_KEYS.BOOKINGS, JSON.stringify(bookings));
    return bookings[bookingIndex];
  }
};

// Export to window scope so other scripts can access
window.Database = Database;
