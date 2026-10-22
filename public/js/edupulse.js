/**
 * EduPulse Pro | Coaching & Tuition Class Management SaaS
 * Complete Front-end Controller & CRUD Engine
 */

// Storage Key
const STORAGE_KEY = 'edupulse_tuition_db_v1';

// Initial realistic seed dataset for coaching institutes
const SEED_DATA = {
  settings: {
    instName: "Apex Academy & Tuition Classes",
    tagline: "Excellence in Board & Competitive Coaching",
    phone: "+91 98765 43210",
    email: "admin@apexacademy.edu.in",
    address: "2nd Floor, Shivalik Complex, Near City Bus Stop, Jamnagar, Gujarat",
    receiptPrefix: "APX-2026-",
    currency: "₹",
    session: "2026-2027"
  },
  batches: [
    {
      id: "BATCH-1",
      name: "10th Boards Elite (Morning)",
      subject: "Science & Mathematics",
      teacher: "Prof. Hani Pandya",
      timings: "Mon-Sat 07:00 AM - 09:00 AM",
      capacity: 35
    },
    {
      id: "BATCH-2",
      name: "12th Science Physics Batch A",
      subject: "Physics (JEE / Boards)",
      teacher: "Dr. S. K. Mehta",
      timings: "Mon-Fri 05:00 PM - 06:30 PM",
      capacity: 30
    },
    {
      id: "BATCH-3",
      name: "12th Commerce Achievers",
      subject: "Accountancy & Statistics",
      teacher: "Prof. R. V. Dave",
      timings: "Mon-Sat 04:00 PM - 05:30 PM",
      capacity: 30
    },
    {
      id: "BATCH-4",
      name: "Diploma Sem 5 Tech Hub",
      subject: "Full-Stack Web & Python",
      teacher: "Er. Aniket Joshi",
      timings: "Tue-Thu-Sat 06:30 PM - 08:30 PM",
      capacity: 25
    }
  ],
  students: [
    {
      id: "STU-101",
      rollNo: "APX-101",
      name: "Rahul Sharma",
      grade: "10th Boards",
      batchId: "BATCH-1",
      phone: "9876501234",
      parentPhone: "9876509999",
      totalFee: 24000,
      paidFee: 24000,
      enrollDate: "2026-06-15",
      status: "Active",
      attendanceRate: 98,
      notes: "Top performer in Science mock tests."
    },
    {
      id: "STU-102",
      rollNo: "APX-102",
      name: "Priya V. Dave",
      grade: "12th Science",
      batchId: "BATCH-2",
      phone: "9825123456",
      parentPhone: "9825199999",
      totalFee: 32000,
      paidFee: 20000,
      enrollDate: "2026-06-20",
      status: "Active",
      attendanceRate: 94,
      notes: "Second installment due next week."
    },
    {
      id: "STU-103",
      rollNo: "APX-103",
      name: "Karan M. Patel",
      grade: "Diploma Sem 5",
      batchId: "BATCH-4",
      phone: "9426812345",
      parentPhone: "9426899999",
      totalFee: 18000,
      paidFee: 18000,
      enrollDate: "2026-07-01",
      status: "Active",
      attendanceRate: 96,
      notes: "Working on Laravel & GUI project."
    },
    {
      id: "STU-104",
      rollNo: "APX-104",
      name: "Sneha G. Jadeja",
      grade: "12th Commerce",
      batchId: "BATCH-3",
      phone: "9909212345",
      parentPhone: "9909299999",
      totalFee: 22000,
      paidFee: 11000,
      enrollDate: "2026-06-22",
      status: "Active",
      attendanceRate: 91,
      notes: "High outstanding fee dues."
    },
    {
      id: "STU-105",
      rollNo: "APX-105",
      name: "Aman R. Qureshi",
      grade: "10th Boards",
      batchId: "BATCH-1",
      phone: "9898712345",
      parentPhone: "9898799999",
      totalFee: 24000,
      paidFee: 14000,
      enrollDate: "2026-07-05",
      status: "Active",
      attendanceRate: 88,
      notes: "Follow-up required for pending ₹10,000."
    },
    {
      id: "STU-106",
      rollNo: "APX-106",
      name: "Diya H. Shah",
      grade: "12th Science",
      batchId: "BATCH-2",
      phone: "9712312345",
      parentPhone: "9712399999",
      totalFee: 32000,
      paidFee: 32000,
      enrollDate: "2026-06-18",
      status: "Active",
      attendanceRate: 100,
      notes: "Full fees paid in advance."
    },
    {
      id: "STU-107",
      rollNo: "APX-107",
      name: "Harshil N. Trivedi",
      grade: "Diploma Sem 5",
      batchId: "BATCH-4",
      phone: "9824412345",
      parentPhone: "9824499999",
      totalFee: 18000,
      paidFee: 9000,
      enrollDate: "2026-07-10",
      status: "Active",
      attendanceRate: 92,
      notes: "Installment pending."
    },
    {
      id: "STU-108",
      rollNo: "APX-108",
      name: "Bhavya K. Mehta",
      grade: "12th Commerce",
      batchId: "BATCH-3",
      phone: "9408812345",
      parentPhone: "9408899999",
      totalFee: 22000,
      paidFee: 22000,
      enrollDate: "2026-06-25",
      status: "Active",
      attendanceRate: 95,
      notes: "Regular student."
    }
  ],
  attendance: {}
};

// Global State
let appData = null;
let revenueChartInstance = null;
let batchDistChartInstance = null;

// Initialize System
document.addEventListener('DOMContentLoaded', () => {
  loadAppData();
  setupNavigation();
  setupSidebarToggle();
  populateDropdowns();
  renderAllViews();
  initializeCharts();

  // Set today's date in attendance input
  const today = new Date().toISOString().split('T')[0];
  const attDateInput = document.getElementById('attendanceDateInput');
  if (attDateInput) attDateInput.value = today;
  
  const enrollInput = document.getElementById('studentEnrollDateInput');
  if (enrollInput) enrollInput.value = today;

  const feeDateInput = document.getElementById('feePayDateInput');
  if (feeDateInput) feeDateInput.value = today;
});

// Load state from localStorage or seed
function loadAppData() {
  const stored = localStorage.getItem(STORAGE_KEY);
  if (stored) {
    try {
      appData = JSON.parse(stored);
    } catch (e) {
      console.error("Failed to parse storage, re-seeding", e);
      appData = JSON.parse(JSON.stringify(SEED_DATA));
      saveAppData();
    }
  } else {
    appData = JSON.parse(JSON.stringify(SEED_DATA));
    saveAppData();
  }
}

function saveAppData() {
  localStorage.setItem(STORAGE_KEY, JSON.stringify(appData));
}

// Show Toast Message
function showToast(message, type = 'primary') {
  const toastEl = document.getElementById('liveToast');
  const toastMsg = document.getElementById('toastMessage');
  const toastIcon = document.getElementById('toastIcon');

  if (!toastEl) return;
  toastEl.className = `toast align-items-center text-white border-0 shadow-lg ${
    type === 'success' ? 'bg-success' : type === 'danger' ? 'bg-danger' : type === 'warning' ? 'bg-warning text-dark' : 'bg-primary'
  }`;

  toastMsg.textContent = message;
  toastIcon.className = `bi ${
    type === 'success' ? 'bi-check-circle-fill' : type === 'danger' ? 'bi-x-circle-fill' : 'bi-info-circle-fill'
  } fs-5`;

  const toast = new bootstrap.Toast(toastEl, { delay: 3500 });
  toast.show();
}

// Navigation Tab Switcher
function setupNavigation() {
  const navLinks = document.querySelectorAll('.sidebar-nav .nav-item');
  navLinks.forEach(link => {
    link.addEventListener('click', (e) => {
      e.preventDefault();
      const tabId = link.getAttribute('data-tab');
      if (tabId) switchTab(tabId);
    });
  });
}

function switchTab(tabId) {
  // Update sidebar active link
  document.querySelectorAll('.sidebar-nav .nav-item').forEach(link => {
    link.classList.toggle('active', link.getAttribute('data-tab') === tabId);
  });

  // Toggle content tab
  document.querySelectorAll('.content-tab').forEach(tab => {
    tab.classList.toggle('active', tab.id === `tab-${tabId}`);
  });

  // Re-render specific tab contents
  if (tabId === 'dashboard') {
    renderDashboardStats();
    if (revenueChartInstance) revenueChartInstance.update();
  } else if (tabId === 'students') {
    renderStudentsTable();
  } else if (tabId === 'batches') {
    renderBatches();
  } else if (tabId === 'attendance') {
    renderAttendanceSheet();
  } else if (tabId === 'fees') {
    renderFeesTable();
  } else if (tabId === 'reports') {
    renderReports();
  }

  // Close mobile sidebar if open
  const sidebar = document.getElementById('appSidebar');
  if (sidebar && window.innerWidth < 992) {
    sidebar.classList.remove('show');
  }
}

// Sidebar toggle for mobile
function setupSidebarToggle() {
  const toggleBtn = document.getElementById('toggleSidebarBtn');
  const closeBtn = document.getElementById('closeSidebarBtn');
  const sidebar = document.getElementById('appSidebar');

  if (toggleBtn && sidebar) {
    toggleBtn.addEventListener('click', () => sidebar.classList.add('show'));
  }
  if (closeBtn && sidebar) {
    closeBtn.addEventListener('click', () => sidebar.classList.remove('show'));
  }
}

// Populate Select Dropdowns
function populateDropdowns() {
  const studentBatchSelect = document.getElementById('studentBatchInput');
  const filterBatchSelect = document.getElementById('studentBatchFilter');
  const attBatchSelect = document.getElementById('attendanceBatchSelect');

  const batchOptions = appData.batches.map(b => `<option value="${b.id}">${b.name}</option>`).join('');
  
  if (studentBatchSelect) studentBatchSelect.innerHTML = batchOptions;
  if (filterBatchSelect) filterBatchSelect.innerHTML = `<option value="ALL">All Batches</option>` + batchOptions;
  if (attBatchSelect) attBatchSelect.innerHTML = batchOptions;

  // Header & Sidebar branding update
  document.getElementById('sidebarInstName').textContent = appData.settings.instName;
  document.getElementById('studentCountBadge').textContent = appData.students.length;
  document.getElementById('batchCountBadge').textContent = appData.batches.length;

  // Settings form fields
  if (document.getElementById('settingInstName')) {
    document.getElementById('settingInstName').value = appData.settings.instName;
    document.getElementById('settingInstTagline').value = appData.settings.tagline;
    document.getElementById('settingInstPhone').value = appData.settings.phone;
    document.getElementById('settingInstEmail').value = appData.settings.email;
    document.getElementById('settingInstAddress').value = appData.settings.address;
    document.getElementById('settingReceiptPrefix').value = appData.settings.receiptPrefix;
    document.getElementById('settingCurrency').value = appData.settings.currency;
    document.getElementById('settingSession').value = appData.settings.session;
  }
}

// Master Render All Views
function renderAllViews() {
  populateDropdowns();
  renderDashboardStats();
  renderStudentsTable();
  renderBatches();
  renderAttendanceSheet();
  renderFeesTable();
  renderReports();
}

// ==========================================================================
// TAB 1: DASHBOARD
// ==========================================================================
function renderDashboardStats() {
  const totalStudents = appData.students.length;
  const totalBilled = appData.students.reduce((acc, s) => acc + (Number(s.totalFee) || 0), 0);
  const totalPaid = appData.students.reduce((acc, s) => acc + (Number(s.paidFee) || 0), 0);
  const totalDue = totalBilled - totalPaid;

  const pendingStudents = appData.students.filter(s => (s.totalFee - s.paidFee) > 0);

  document.getElementById('kpiTotalStudents').textContent = totalStudents;
  document.getElementById('kpiCollectedFees').textContent = `₹${totalPaid.toLocaleString('en-IN')}`;
  document.getElementById('kpiPendingFees').textContent = `₹${totalDue.toLocaleString('en-IN')}`;
  document.getElementById('kpiPendingCount').textContent = `${pendingStudents.length} accounts pending`;

  const collectionRate = totalBilled > 0 ? Math.round((totalPaid / totalBilled) * 100) : 0;
  document.getElementById('kpiCollectionRate').textContent = `${collectionRate}% collection efficiency`;

  // Recent Admissions Table (Last 5)
  const recentTable = document.getElementById('recentStudentsTableBody');
  if (recentTable) {
    const recent = [...appData.students].reverse().slice(0, 5);
    recentTable.innerHTML = recent.map(s => {
      const batch = appData.batches.find(b => b.id === s.batchId);
      const isPaid = (s.totalFee - s.paidFee) <= 0;
      const due = s.totalFee - s.paidFee;
      return `
        <tr>
          <td>
            <div class="d-flex align-items-center gap-2">
              <div class="student-avatar" style="width:32px; height:32px; font-size:0.75rem;">${getInitials(s.name)}</div>
              <div>
                <strong class="d-block text-dark">${s.name}</strong>
                <small class="text-muted">${s.rollNo}</small>
              </div>
            </div>
          </td>
          <td>
            <span class="fw-semibold text-dark">${s.grade}</span><br>
            <small class="text-muted">${batch ? batch.name : 'Unassigned'}</small>
          </td>
          <td><small class="text-muted">${s.enrollDate || 'N/A'}</small></td>
          <td>
            <span class="badge-status ${isPaid ? 'badge-paid' : 'badge-partial'}">
              ${isPaid ? 'Paid' : `Due: ₹${due.toLocaleString('en-IN')}`}
            </span>
          </td>
        </tr>
      `;
    }).join('');
  }

  // Urgent Dues List
  const duesList = document.getElementById('urgentDuesList');
  if (duesList) {
    const sortedDues = [...pendingStudents].sort((a, b) => (b.totalFee - b.paidFee) - (a.totalFee - a.paidFee)).slice(0, 4);
    if (sortedDues.length === 0) {
      duesList.innerHTML = `<div class="p-3 text-center text-success"><i class="bi bi-check-circle fs-3 d-block mb-1"></i>All fees fully cleared!</div>`;
    } else {
      duesList.innerHTML = sortedDues.map(s => {
        const due = s.totalFee - s.paidFee;
        const msg = encodeURIComponent(`Dear Parent, this is a friendly reminder from Apex Academy regarding the pending tuition fee installment of ₹${due} for ${s.name} (${s.rollNo}). Kindly clear at your earliest convenience.`);
        return `
          <div class="dues-item">
            <div>
              <div class="fw-bold text-dark">${s.name} <span class="badge bg-light text-muted border">${s.rollNo}</span></div>
              <small class="text-muted">${s.grade} • Parent: ${s.parentPhone}</small>
            </div>
            <div class="text-end">
              <div class="fw-bold text-danger">₹${due.toLocaleString('en-IN')}</div>
              <div class="mt-1 d-flex gap-1 justify-content-end">
                <a href="https://wa.me/91${s.parentPhone}?text=${msg}" target="_blank" class="btn btn-sm btn-outline-success py-0 px-2" title="Send WhatsApp Reminder">
                  <i class="bi bi-whatsapp"></i>
                </a>
                <button class="btn btn-sm btn-outline-primary py-0 px-2" onclick="quickCollectFee('${s.id}')">Collect</button>
              </div>
            </div>
          </div>
        `;
      }).join('');
    }
  }
}

// Chart.js initialization
function initializeCharts() {
  const revCtx = document.getElementById('revenueChart');
  if (revCtx) {
    revenueChartInstance = new Chart(revCtx, {
      type: 'bar',
      data: {
        labels: ['June', 'July', 'August', 'September', 'October', 'November'],
        datasets: [
          {
            label: 'Fees Collected (₹)',
            data: [45000, 72000, 68000, 84000, 95000, 62000],
            backgroundColor: '#4f46e5',
            borderRadius: 6
          },
          {
            label: 'Projected Target (₹)',
            data: [50000, 75000, 75000, 85000, 100000, 75000],
            type: 'line',
            borderColor: '#10b981',
            borderWidth: 2,
            tension: 0.3,
            pointBackgroundColor: '#10b981'
          }
        ]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
          legend: { position: 'top', labels: { font: { family: 'Inter', size: 12 } } }
        },
        scales: {
          y: { grid: { color: '#f1f5f9' }, ticks: { callback: v => '₹' + v.toLocaleString() } },
          x: { grid: { display: false } }
        }
      }
    });
  }

  const distCtx = document.getElementById('batchDistributionChart');
  if (distCtx) {
    const counts = appData.batches.map(b => appData.students.filter(s => s.batchId === b.id).length);
    const labels = appData.batches.map(b => b.name.split('(')[0].trim());

    batchDistChartInstance = new Chart(distCtx, {
      type: 'doughnut',
      data: {
        labels: labels,
        datasets: [{
          data: counts.map(c => c || 1),
          backgroundColor: ['#4f46e5', '#0ea5e9', '#10b981', '#f59e0b', '#ec4899'],
          borderWidth: 0
        }]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
          legend: { position: 'bottom', labels: { boxWidth: 12, font: { family: 'Inter', size: 11 } } }
        },
        cutout: '68%'
      }
    });
  }
}

// ==========================================================================
// TAB 2: STUDENT MANAGEMENT (CRUD)
// ==========================================================================
function renderStudentsTable(filterQuery = '', filterBatch = 'ALL', filterGrade = 'ALL', filterStatus = 'ALL') {
  const tableBody = document.getElementById('studentsFullTableBody');
  const emptyState = document.getElementById('studentsEmptyState');
  if (!tableBody) return;

  const query = filterQuery.toLowerCase().trim();

  const filtered = appData.students.filter(s => {
    const matchesSearch = s.name.toLowerCase().includes(query) ||
                          s.rollNo.toLowerCase().includes(query) ||
                          s.phone.includes(query) ||
                          s.parentPhone.includes(query);
    const matchesBatch = filterBatch === 'ALL' || s.batchId === filterBatch;
    const matchesGrade = filterGrade === 'ALL' || s.grade === filterGrade;
    const matchesStatus = filterStatus === 'ALL' || s.status === filterStatus;
    return matchesSearch && matchesBatch && matchesGrade && matchesStatus;
  });

  if (filtered.length === 0) {
    tableBody.innerHTML = '';
    emptyState.classList.remove('d-none');
    return;
  }
  emptyState.classList.add('d-none');

  tableBody.innerHTML = filtered.map(s => {
    const batch = appData.batches.find(b => b.id === s.batchId);
    const due = (s.totalFee || 0) - (s.paidFee || 0);
    const isPaid = due <= 0;
    const payRate = s.totalFee > 0 ? Math.round((s.paidFee / s.totalFee) * 100) : 100;

    return `
      <tr>
        <td><strong class="text-primary font-monospace">${s.rollNo}</strong></td>
        <td>
          <div class="student-meta-cell">
            <div class="student-avatar">${getInitials(s.name)}</div>
            <div>
              <span class="student-name-text">${s.name}</span>
              <span class="student-roll-sub">Enrolled: ${s.enrollDate || '2026-06'}</span>
            </div>
          </div>
        </td>
        <td>
          <div class="fw-semibold text-dark">${s.grade}</div>
          <small class="text-muted"><i class="bi bi-collection me-1"></i>${batch ? batch.name : 'Not set'}</small>
        </td>
        <td>
          <div class="small"><i class="bi bi-phone text-muted me-1"></i>${s.phone}</div>
          <div class="small"><i class="bi bi-whatsapp text-success me-1"></i>${s.parentPhone}</div>
        </td>
        <td style="min-width: 140px;">
          <div class="d-flex justify-content-between small mb-1">
            <span class="${isPaid ? 'text-success fw-bold' : 'text-danger fw-bold'}">
              ${isPaid ? 'Fully Paid' : `Due: ₹${due.toLocaleString('en-IN')}`}
            </span>
            <span class="text-muted">${payRate}%</span>
          </div>
          <div class="progress" style="height: 6px;">
            <div class="progress-bar ${isPaid ? 'bg-success' : 'bg-warning'}" style="width: ${payRate}%"></div>
          </div>
        </td>
        <td>
          <span class="badge bg-light text-dark border">
            <i class="bi bi-calendar-check text-primary me-1"></i>${s.attendanceRate || 95}%
          </span>
        </td>
        <td>
          <span class="badge-status ${s.status === 'Active' ? 'badge-active' : 'badge-leave'}">
            ${s.status}
          </span>
        </td>
        <td class="text-end">
          <div class="btn-group btn-group-sm">
            <button class="btn btn-outline-secondary" title="Edit Student" onclick="editStudent('${s.id}')">
              <i class="bi bi-pencil-square"></i>
            </button>
            <button class="btn btn-outline-success" title="Collect Fee" onclick="quickCollectFee('${s.id}')">
              <i class="bi bi-wallet2"></i>
            </button>
            <button class="btn btn-outline-danger" title="Delete Student" onclick="deleteStudent('${s.id}')">
              <i class="bi bi-trash"></i>
            </button>
          </div>
        </td>
      </tr>
    `;
  }).join('');
}

function filterStudentsTable() {
  const query = document.getElementById('studentSearchFilter').value;
  const batch = document.getElementById('studentBatchFilter').value;
  const grade = document.getElementById('studentGradeFilter').value;
  const status = document.getElementById('studentStatusFilter').value;
  renderStudentsTable(query, batch, grade, status);
}

// Global search input handling
const globalSearch = document.getElementById('globalSearchInput');
if (globalSearch) {
  globalSearch.addEventListener('input', (e) => {
    switchTab('students');
    const studentSearch = document.getElementById('studentSearchFilter');
    if (studentSearch) {
      studentSearch.value = e.target.value;
      filterStudentsTable();
    }
  });
}

// Student Modal Management (Add / Edit)
function openAddStudentModal() {
  document.getElementById('studentForm').reset();
  document.getElementById('studentIdHidden').value = '';
  document.getElementById('studentModalTitle').innerHTML = '<i class="bi bi-person-plus-fill me-2"></i>New Student Admission';
  document.getElementById('studentSaveBtn').textContent = 'Confirm & Enroll Student';

  // Auto-generate next roll number
  const nextNum = appData.students.length + 101;
  document.getElementById('studentRollInput').value = `${appData.settings.receiptPrefix || 'APX-'}${nextNum}`;
  document.getElementById('studentEnrollDateInput').value = new Date().toISOString().split('T')[0];

  const modal = new bootstrap.Modal(document.getElementById('studentModal'));
  modal.show();
}

function editStudent(studentId) {
  const student = appData.students.find(s => s.id === studentId);
  if (!student) return;

  document.getElementById('studentIdHidden').value = student.id;
  document.getElementById('studentModalTitle').innerHTML = '<i class="bi bi-pencil-square me-2"></i>Update Student Details';
  document.getElementById('studentSaveBtn').textContent = 'Update Changes';

  document.getElementById('studentNameInput').value = student.name;
  document.getElementById('studentRollInput').value = student.rollNo;
  document.getElementById('studentGradeInput').value = student.grade;
  document.getElementById('studentBatchInput').value = student.batchId;
  document.getElementById('studentPhoneInput').value = student.phone;
  document.getElementById('studentParentPhoneInput').value = student.parentPhone;
  document.getElementById('studentTotalFeeInput').value = student.totalFee;
  document.getElementById('studentPaidFeeInput').value = student.paidFee;
  document.getElementById('studentEnrollDateInput').value = student.enrollDate || '';
  document.getElementById('studentStatusSelect').value = student.status || 'Active';
  document.getElementById('studentNotesInput').value = student.notes || '';

  const modal = new bootstrap.Modal(document.getElementById('studentModal'));
  modal.show();
}

function handleStudentFormSubmit(e) {
  e.preventDefault();
  const hiddenId = document.getElementById('studentIdHidden').value;

  const studentData = {
    id: hiddenId || `STU-${Date.now().toString().slice(-5)}`,
    rollNo: document.getElementById('studentRollInput').value.trim() || `APX-${Date.now().toString().slice(-3)}`,
    name: document.getElementById('studentNameInput').value.trim(),
    grade: document.getElementById('studentGradeInput').value,
    batchId: document.getElementById('studentBatchInput').value,
    phone: document.getElementById('studentPhoneInput').value.trim(),
    parentPhone: document.getElementById('studentParentPhoneInput').value.trim(),
    totalFee: parseFloat(document.getElementById('studentTotalFeeInput').value) || 0,
    paidFee: parseFloat(document.getElementById('studentPaidFeeInput').value) || 0,
    enrollDate: document.getElementById('studentEnrollDateInput').value,
    status: document.getElementById('studentStatusSelect').value,
    attendanceRate: 95,
    notes: document.getElementById('studentNotesInput').value.trim()
  };

  if (hiddenId) {
    const idx = appData.students.findIndex(s => s.id === hiddenId);
    if (idx !== -1) {
      studentData.attendanceRate = appData.students[idx].attendanceRate || 95;
      appData.students[idx] = studentData;
      showToast(`Student record for "${studentData.name}" updated successfully!`, 'success');
    }
  } else {
    appData.students.unshift(studentData);
    showToast(`New student "${studentData.name}" admitted successfully!`, 'success');
  }

  saveAppData();
  renderAllViews();

  bootstrap.Modal.getInstance(document.getElementById('studentModal')).hide();
}

function deleteStudent(studentId) {
  const student = appData.students.find(s => s.id === studentId);
  if (!student) return;

  if (confirm(`Are you sure you want to remove student "${student.name}" (${student.rollNo})? This cannot be undone.`)) {
    appData.students = appData.students.filter(s => s.id !== studentId);
    saveAppData();
    renderAllViews();
    showToast(`Student record removed.`, 'warning');
  }
}

// ==========================================================================
// TAB 3: BATCHES & COURSES (CRUD)
// ==========================================================================
function renderBatches() {
  const grid = document.getElementById('batchesGridContainer');
  if (!grid) return;

  grid.innerHTML = appData.batches.map(b => {
    const enrolled = appData.students.filter(s => s.batchId === b.id).length;
    const capacityPercent = Math.min(100, Math.round((enrolled / b.capacity) * 100));

    return `
      <div class="col-md-6 col-xl-3">
        <div class="batch-card">
          <span class="batch-subject-badge">${b.subject}</span>
          <h4 class="batch-title">${b.name}</h4>

          <div class="batch-meta-item">
            <i class="bi bi-person-badge"></i>
            <span>${b.teacher}</span>
          </div>
          <div class="batch-meta-item">
            <i class="bi bi-clock"></i>
            <span>${b.timings}</span>
          </div>

          <div class="mt-4 pt-3 border-top">
            <div class="d-flex justify-content-between align-items-center mb-1 small">
              <span class="fw-semibold text-muted">Enrollment</span>
              <strong class="text-primary">${enrolled} / ${b.capacity} Students</strong>
            </div>
            <div class="progress" style="height: 6px;">
              <div class="progress-bar ${capacityPercent > 90 ? 'bg-danger' : 'bg-primary'}" style="width: ${capacityPercent}%"></div>
            </div>
          </div>

          <div class="mt-3 pt-2 d-flex justify-content-between">
            <button class="btn btn-sm btn-outline-primary" onclick="viewBatchStudents('${b.id}')"><i class="bi bi-people me-1"></i> Students</button>
            <div class="btn-group btn-group-sm">
              <button class="btn btn-outline-secondary" onclick="editBatch('${b.id}')"><i class="bi bi-pencil"></i></button>
              <button class="btn btn-outline-danger" onclick="deleteBatch('${b.id}')"><i class="bi bi-trash"></i></button>
            </div>
          </div>
        </div>
      </div>
    `;
  }).join('');
}

function openAddBatchModal() {
  document.getElementById('batchForm').reset();
  document.getElementById('batchIdHidden').value = '';
  document.getElementById('batchModalTitle').innerHTML = '<i class="bi bi-diagram-3-fill me-2"></i>Create New Batch';
  const modal = new bootstrap.Modal(document.getElementById('batchModal'));
  modal.show();
}

function editBatch(batchId) {
  const batch = appData.batches.find(b => b.id === batchId);
  if (!batch) return;

  document.getElementById('batchIdHidden').value = batch.id;
  document.getElementById('batchModalTitle').innerHTML = '<i class="bi bi-pencil me-2"></i>Edit Batch Details';
  document.getElementById('batchNameInput').value = batch.name;
  document.getElementById('batchSubjectInput').value = batch.subject;
  document.getElementById('batchTeacherInput').value = batch.teacher;
  document.getElementById('batchTimingInput').value = batch.timings;
  document.getElementById('batchCapacityInput').value = batch.capacity;

  const modal = new bootstrap.Modal(document.getElementById('batchModal'));
  modal.show();
}

function handleBatchFormSubmit(e) {
  e.preventDefault();
  const hiddenId = document.getElementById('batchIdHidden').value;

  const batchData = {
    id: hiddenId || `BATCH-${Date.now().toString().slice(-4)}`,
    name: document.getElementById('batchNameInput').value.trim(),
    subject: document.getElementById('batchSubjectInput').value.trim(),
    teacher: document.getElementById('batchTeacherInput').value.trim(),
    timings: document.getElementById('batchTimingInput').value.trim(),
    capacity: parseInt(document.getElementById('batchCapacityInput').value) || 30
  };

  if (hiddenId) {
    const idx = appData.batches.findIndex(b => b.id === hiddenId);
    if (idx !== -1) {
      appData.batches[idx] = batchData;
      showToast(`Batch "${batchData.name}" updated.`, 'success');
    }
  } else {
    appData.batches.push(batchData);
    showToast(`New batch "${batchData.name}" created!`, 'success');
  }

  saveAppData();
  renderAllViews();
  bootstrap.Modal.getInstance(document.getElementById('batchModal')).hide();
}

function deleteBatch(batchId) {
  const enrolled = appData.students.filter(s => s.batchId === batchId).length;
  if (enrolled > 0) {
    alert(`Cannot delete this batch because ${enrolled} active students are assigned to it. Reassign students first.`);
    return;
  }

  if (confirm(`Are you sure you want to remove this batch?`)) {
    appData.batches = appData.batches.filter(b => b.id !== batchId);
    saveAppData();
    renderAllViews();
    showToast(`Batch deleted successfully.`, 'warning');
  }
}

function viewBatchStudents(batchId) {
  switchTab('students');
  const batchFilter = document.getElementById('studentBatchFilter');
  if (batchFilter) {
    batchFilter.value = batchId;
    filterStudentsTable();
  }
}

// ==========================================================================
// TAB 4: DAILY ATTENDANCE REGISTER
// ==========================================================================
function renderAttendanceSheet() {
  const batchSelect = document.getElementById('attendanceBatchSelect');
  const dateInput = document.getElementById('attendanceDateInput');
  const sheetBody = document.getElementById('attendanceSheetBody');

  if (!batchSelect || !sheetBody) return;

  const selectedBatchId = batchSelect.value;
  const selectedDate = dateInput ? dateInput.value : new Date().toISOString().split('T')[0];

  const students = appData.students.filter(s => s.batchId === selectedBatchId);

  if (students.length === 0) {
    sheetBody.innerHTML = `<tr><td colspan="5" class="text-center py-4 text-muted"><i class="bi bi-person-x display-6 d-block mb-2"></i>No students enrolled in this batch yet.</td></tr>`;
    updateAttendanceCounters(0, 0);
    return;
  }

  // Load saved attendance for this batch + date if exists
  const recordKey = `${selectedBatchId}_${selectedDate}`;
  const savedRecord = (appData.attendance && appData.attendance[recordKey]) || {};

  sheetBody.innerHTML = students.map((s, index) => {
    const curStatus = savedRecord[s.id] || 'Present';

    return `
      <tr data-student-id="${s.id}">
        <td><span class="badge bg-light text-dark border font-monospace">${s.rollNo}</span></td>
        <td>
          <div class="fw-bold text-dark">${s.name}</div>
          <small class="text-muted">${s.grade}</small>
        </td>
        <td><small class="text-muted"><i class="bi bi-telephone me-1"></i>${s.parentPhone}</small></td>
        <td>
          <div class="btn-group btn-group-sm att-btn-group" role="group">
            <input type="radio" class="btn-check" name="att_${s.id}" id="att_${s.id}_P" value="Present" ${curStatus === 'Present' ? 'checked' : ''} onchange="updateAttendanceCounters()">
            <label class="btn btn-outline-success" for="att_${s.id}_P">Present</label>

            <input type="radio" class="btn-check" name="att_${s.id}" id="att_${s.id}_A" value="Absent" ${curStatus === 'Absent' ? 'checked' : ''} onchange="updateAttendanceCounters()">
            <label class="btn btn-outline-danger" for="att_${s.id}_A">Absent</label>

            <input type="radio" class="btn-check" name="att_${s.id}" id="att_${s.id}_L" value="Late" ${curStatus === 'Late' ? 'checked' : ''} onchange="updateAttendanceCounters()">
            <label class="btn btn-outline-warning" for="att_${s.id}_L">Late</label>
          </div>
        </td>
        <td>
          <input type="text" class="form-control form-control-sm" placeholder="Optional notes (e.g. sick leave)">
        </td>
      </tr>
    `;
  }).join('');

  updateAttendanceCounters();
}

function updateAttendanceCounters() {
  const rows = document.querySelectorAll('#attendanceSheetBody tr[data-student-id]');
  let present = 0;
  let absent = 0;

  rows.forEach(r => {
    const checked = r.querySelector('input[type="radio"]:checked');
    if (checked && (checked.value === 'Present' || checked.value === 'Late')) present++;
    else absent++;
  });

  const total = rows.length;
  const rate = total > 0 ? Math.round((present / total) * 100) : 0;

  document.getElementById('attPresentCount').textContent = present;
  document.getElementById('attAbsentCount').textContent = absent;
  document.getElementById('attRatePercent').textContent = `${rate}%`;
}

function markAllAttendance(status) {
  const radios = document.querySelectorAll(`#attendanceSheetBody input[type="radio"][value="${status}"]`);
  radios.forEach(r => r.checked = true);
  updateAttendanceCounters();
  showToast(`Marked all students as ${status}. Click 'Save Register' to persist.`, 'info');
}

function saveAttendanceRecords() {
  const batchSelect = document.getElementById('attendanceBatchSelect');
  const dateInput = document.getElementById('attendanceDateInput');
  if (!batchSelect || !dateInput) return;

  const key = `${batchSelect.value}_${dateInput.value}`;
  if (!appData.attendance) appData.attendance = {};

  const record = {};
  const rows = document.querySelectorAll('#attendanceSheetBody tr[data-student-id]');
  rows.forEach(r => {
    const sId = r.getAttribute('data-student-id');
    const checked = r.querySelector('input[type="radio"]:checked');
    if (checked) record[sId] = checked.value;
  });

  appData.attendance[key] = record;
  saveAppData();
  showToast(`Attendance register for ${dateInput.value} saved successfully!`, 'success');
}

// ==========================================================================
// TAB 5: FEES & INVOICING (CRUD + RECEIPT GENERATOR)
// ==========================================================================
function renderFeesTable(filterQuery = '', filterStatus = 'ALL') {
  const tbody = document.getElementById('feesTableBody');
  if (!tbody) return;

  const totalBilled = appData.students.reduce((acc, s) => acc + (Number(s.totalFee) || 0), 0);
  const totalReceived = appData.students.reduce((acc, s) => acc + (Number(s.paidFee) || 0), 0);
  const totalRemaining = totalBilled - totalReceived;

  document.getElementById('feeTotalBilled').textContent = `₹${totalBilled.toLocaleString('en-IN')}`;
  document.getElementById('feeTotalReceived').textContent = `₹${totalReceived.toLocaleString('en-IN')}`;
  document.getElementById('feeTotalRemaining').textContent = `₹${totalRemaining.toLocaleString('en-IN')}`;

  const query = filterQuery.toLowerCase().trim();

  const filtered = appData.students.filter(s => {
    const matchesSearch = s.name.toLowerCase().includes(query) || s.rollNo.toLowerCase().includes(query);
    const due = s.totalFee - s.paidFee;
    let matchesStatus = true;
    if (filterStatus === 'PAID') matchesStatus = due <= 0;
    else if (filterStatus === 'PARTIAL') matchesStatus = due > 0 && s.paidFee > 0;
    else if (filterStatus === 'UNPAID') matchesStatus = s.paidFee === 0 || due >= 10000;

    return matchesSearch && matchesStatus;
  });

  tbody.innerHTML = filtered.map(s => {
    const due = s.totalFee - s.paidFee;
    const isPaid = due <= 0;
    const isPartial = due > 0 && s.paidFee > 0;
    const batch = appData.batches.find(b => b.id === s.batchId);

    return `
      <tr>
        <td><strong class="font-monospace text-primary">${s.rollNo}</strong></td>
        <td>
          <div class="fw-bold text-dark">${s.name}</div>
          <small class="text-muted"><i class="bi bi-telephone me-1"></i>${s.parentPhone}</small>
        </td>
        <td>
          <div class="small fw-semibold">${s.grade}</div>
          <small class="text-muted">${batch ? batch.name : 'N/A'}</small>
        </td>
        <td class="fw-bold">₹${s.totalFee.toLocaleString('en-IN')}</td>
        <td class="text-success fw-bold">₹${s.paidFee.toLocaleString('en-IN')}</td>
        <td class="fw-bold ${isPaid ? 'text-muted' : 'text-danger'}">₹${due.toLocaleString('en-IN')}</td>
        <td>
          <span class="badge-status ${isPaid ? 'badge-paid' : isPartial ? 'badge-partial' : 'badge-unpaid'}">
            ${isPaid ? 'Paid in Full' : isPartial ? 'Partial Due' : 'High Overdue'}
          </span>
        </td>
        <td class="text-end">
          <div class="btn-group btn-group-sm">
            <button class="btn btn-primary" onclick="quickCollectFee('${s.id}')"><i class="bi bi-wallet2 me-1"></i> Pay</button>
            <button class="btn btn-outline-secondary" onclick="viewReceipt('${s.id}')" title="Print Fee Receipt"><i class="bi bi-printer"></i></button>
          </div>
        </td>
      </tr>
    `;
  }).join('');
}

function filterFeesTable() {
  const query = document.getElementById('feeSearchFilter').value;
  const status = document.getElementById('feeStatusFilter').value;
  renderFeesTable(query, status);
}

function quickCollectFee(studentId) {
  const student = appData.students.find(s => s.id === studentId);
  if (!student) return;

  const due = student.totalFee - student.paidFee;

  document.getElementById('feeStudentIdHidden').value = student.id;
  document.getElementById('feeModalStudentName').textContent = student.name;
  document.getElementById('feeModalStudentInfo').textContent = `${student.grade} • Roll: ${student.rollNo}`;
  document.getElementById('feeModalPendingAmount').textContent = `₹${due.toLocaleString('en-IN')}`;
  document.getElementById('feePayAmountInput').value = due > 0 ? due : '';
  document.getElementById('feePayDateInput').value = new Date().toISOString().split('T')[0];

  const modal = new bootstrap.Modal(document.getElementById('feePaymentModal'));
  modal.show();
}

function openCollectFeeModal() {
  if (appData.students.length === 0) {
    alert("No students registered yet. Add a student first.");
    return;
  }
  // Pick first student with dues or first student
  const target = appData.students.find(s => (s.totalFee - s.paidFee) > 0) || appData.students[0];
  quickCollectFee(target.id);
}

function handleFeePaymentSubmit(e) {
  e.preventDefault();
  const sId = document.getElementById('feeStudentIdHidden').value;
  const amount = parseFloat(document.getElementById('feePayAmountInput').value) || 0;
  const mode = document.getElementById('feePayModeInput').value;
  const ref = document.getElementById('feePayRefInput').value;

  const student = appData.students.find(s => s.id === sId);
  if (!student) return;

  student.paidFee = (student.paidFee || 0) + amount;
  if (student.paidFee > student.totalFee) student.paidFee = student.totalFee;

  saveAppData();
  renderAllViews();

  bootstrap.Modal.getInstance(document.getElementById('feePaymentModal')).hide();
  showToast(`Recorded payment of ₹${amount.toLocaleString('en-IN')} for ${student.name}`, 'success');

  // Trigger receipt view immediately
  viewReceipt(student.id, amount, mode, ref);
}

function viewReceipt(studentId, payAmount = null, payMode = 'Cash at Counter', payRef = '') {
  const student = appData.students.find(s => s.id === studentId);
  if (!student) return;

  const batch = appData.batches.find(b => b.id === student.batchId);
  const remaining = student.totalFee - student.paidFee;
  const receiptNo = `${appData.settings.receiptPrefix || 'APX-2026-'}${student.rollNo.replace(/[^0-9]/g, '') || '001'}`;

  // Populate receipt elements
  document.getElementById('recInstName').textContent = appData.settings.instName;
  document.getElementById('recInstTagline').textContent = appData.settings.tagline;
  document.getElementById('recInstAddress').textContent = appData.settings.address;
  document.getElementById('recInstPhone').textContent = appData.settings.phone;

  document.getElementById('recNo').textContent = receiptNo;
  document.getElementById('recDate').textContent = new Date().toLocaleDateString('en-IN', { day: '2-digit', month: 'short', year: 'numeric' });

  document.getElementById('recStudentName').textContent = student.name;
  document.getElementById('recRoll').textContent = student.rollNo;
  document.getElementById('recGrade').textContent = student.grade;
  document.getElementById('recBatch').textContent = batch ? batch.name : 'N/A';
  document.getElementById('recMode').textContent = payMode;
  document.getElementById('recRef').textContent = payRef || 'VERIFIED-ONLINE';

  document.getElementById('recAmount').textContent = payAmount ? `₹${payAmount.toLocaleString('en-IN')}` : `₹${student.paidFee.toLocaleString('en-IN')}`;
  document.getElementById('recTotalFee').textContent = `₹${student.totalFee.toLocaleString('en-IN')}`;
  document.getElementById('recTotalPaid').textContent = `₹${student.paidFee.toLocaleString('en-IN')}`;
  document.getElementById('recRemainingDue').textContent = `₹${remaining.toLocaleString('en-IN')}`;

  const modal = new bootstrap.Modal(document.getElementById('receiptModal'));
  modal.show();
}

function printReceiptArea() {
  window.print();
}

// ==========================================================================
// TAB 6: REPORTS & EXPORT
// ==========================================================================
function renderReports() {
  const reportTbody = document.getElementById('reportsBatchSummaryBody');
  if (!reportTbody) return;

  reportTbody.innerHTML = appData.batches.map(b => {
    const students = appData.students.filter(s => s.batchId === b.id);
    const totalFee = students.reduce((a, s) => a + (Number(s.totalFee) || 0), 0);
    const paidFee = students.reduce((a, s) => a + (Number(s.paidFee) || 0), 0);
    const recovery = totalFee > 0 ? Math.round((paidFee / totalFee) * 100) : 0;

    return `
      <tr>
        <td><strong>${b.name}</strong></td>
        <td>${students.length}</td>
        <td>₹${totalFee.toLocaleString('en-IN')}</td>
        <td class="text-success fw-semibold">₹${paidFee.toLocaleString('en-IN')}</td>
        <td>
          <div class="d-flex align-items-center gap-2">
            <span class="small fw-bold">${recovery}%</span>
            <div class="progress flex-grow-1" style="height: 6px;">
              <div class="progress-bar ${recovery > 80 ? 'bg-success' : 'bg-warning'}" style="width: ${recovery}%"></div>
            </div>
          </div>
        </td>
      </tr>
    `;
  }).join('');
}

// Export students to real CSV
function exportStudentsToCSV() {
  if (appData.students.length === 0) {
    alert("No student records to export.");
    return;
  }

  const headers = ["Roll No", "Full Name", "Standard", "Batch", "Student Contact", "Parent Contact", "Total Fee", "Paid Fee", "Due Balance", "Status", "Enrollment Date"];
  
  const rows = appData.students.map(s => {
    const batch = appData.batches.find(b => b.id === s.batchId);
    const due = s.totalFee - s.paidFee;
    return [
      `"${s.rollNo}"`,
      `"${s.name}"`,
      `"${s.grade}"`,
      `"${batch ? batch.name : ''}"`,
      `"${s.phone}"`,
      `"${s.parentPhone}"`,
      s.totalFee,
      s.paidFee,
      due,
      `"${s.status}"`,
      `"${s.enrollDate || ''}"`
    ].join(',');
  });

  const csvContent = "data:text/csv;charset=utf-8," + [headers.join(','), ...rows].join('\n');
  const encodedUri = encodeURI(csvContent);
  const link = document.createElement("a");
  link.setAttribute("href", encodedUri);
  link.setAttribute("download", `Tuition_Students_Ledger_${new Date().toISOString().split('T')[0]}.csv`);
  document.body.appendChild(link);
  link.click();
  document.body.removeChild(link);

  showToast("Downloaded Students & Fee Ledger CSV successfully!", "success");
}

// ==========================================================================
// TAB 7: SETTINGS & BACKUP
// ==========================================================================
function saveInstituteSettings() {
  appData.settings = {
    instName: document.getElementById('settingInstName').value.trim() || 'Apex Academy',
    tagline: document.getElementById('settingInstTagline').value.trim(),
    phone: document.getElementById('settingInstPhone').value.trim(),
    email: document.getElementById('settingInstEmail').value.trim(),
    address: document.getElementById('settingInstAddress').value.trim(),
    receiptPrefix: document.getElementById('settingReceiptPrefix').value.trim(),
    currency: document.getElementById('settingCurrency').value.trim() || '₹',
    session: document.getElementById('settingSession').value.trim()
  };

  saveAppData();
  populateDropdowns();
  showToast("Institute branding and settings saved successfully!", "success");
}

function exportDataJSON() {
  const dataStr = "data:text/json;charset=utf-8," + encodeURIComponent(JSON.stringify(appData, null, 2));
  const link = document.createElement('a');
  link.setAttribute("href", dataStr);
  link.setAttribute("download", `EduPulse_Tuition_Backup_${new Date().toISOString().split('T')[0]}.json`);
  document.body.appendChild(link);
  link.click();
  document.body.removeChild(link);
  showToast("Full institute database backup downloaded as JSON.", "success");
}

function resetToSampleData() {
  if (confirm("Reset everything back to pristine coaching demo data for client pitch? All custom records will be replaced with sample tuition data.")) {
    appData = JSON.parse(JSON.stringify(SEED_DATA));
    saveAppData();
    renderAllViews();
    showToast("Restored clean demo dataset for presentations!", "info");
  }
}

function clearAllData() {
  if (confirm("WARNING: Are you sure you want to wipe all records?")) {
    appData = {
      settings: SEED_DATA.settings,
      batches: [],
      students: [],
      attendance: {}
    };
    saveAppData();
    renderAllViews();
    showToast("All records have been cleared.", "danger");
  }
}

function showPitchModal() {
  const modal = new bootstrap.Modal(document.getElementById('pitchModal'));
  modal.show();
}

function getInitials(name) {
  if (!name) return 'ST';
  const parts = name.split(' ');
  return parts.length > 1 ? (parts[0][0] + parts[1][0]).toUpperCase() : parts[0].slice(0, 2).toUpperCase();
}
