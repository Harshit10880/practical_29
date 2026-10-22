<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>EduPulse Pro | Coaching & Tuition Class Management SaaS</title>
  
  <!-- Favicon icon -->
  <link rel="icon" type="image/svg+xml" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='%234f46e5'><path d='M12 2L1 7l11 5 9-4.09V17h2V7L12 2zm0 13l-7-3.18V17c0 3.31 3.13 6 7 6s7-2.69 7-6v-5.18L12 15z'/></svg>">

  <!-- Google Fonts: Inter & Plus Jakarta Sans -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Plus+Jakarta+Sans:wght@500;600;700;800&display=swap" rel="stylesheet">

  <!-- Bootstrap 5.3.3 CSS CDN -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  
  <!-- Bootstrap Icons CDN -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

  <!-- Chart.js CDN for Analytics -->
  <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>

  <!-- Custom Stylesheet -->
  <link rel="stylesheet" href="{{ asset('css/edupulse.css') }}">
</head>
<body>

  <!-- Toast Notification Container -->
  <div class="toast-container position-fixed top-0 end-0 p-3" style="z-index: 9999;">
    <div id="liveToast" class="toast align-items-center text-white bg-primary border-0 shadow-lg" role="alert" aria-live="assertive" aria-atomic="true">
      <div class="d-flex">
        <div class="toast-body d-flex align-items-center gap-2">
          <i id="toastIcon" class="bi bi-check-circle-fill fs-5"></i>
          <span id="toastMessage">Operation successful!</span>
        </div>
        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
      </div>
    </div>
  </div>

  <div class="app-layout">
    <!-- =========================================================================
         Sidebar Navigation
         ========================================================================= -->
    <aside class="app-sidebar" id="appSidebar">
      <div class="sidebar-brand">
        <div class="brand-logo-badge">
          <i class="bi bi-mortarboard-fill"></i>
        </div>
        <div class="brand-info">
          <h2 class="brand-name">EduPulse<span class="text-accent">Pro</span></h2>
          <span class="brand-tag">Academy Cloud OS</span>
        </div>
        <button class="btn btn-sm btn-link d-lg-none text-white ms-auto" id="closeSidebarBtn">
          <i class="bi bi-x-lg fs-5"></i>
        </button>
      </div>

      <!-- Institute Quick Badge -->
      <div class="institute-selector-card">
        <div class="d-flex align-items-center gap-2">
          <div class="institute-avatar">
            <i class="bi bi-building"></i>
          </div>
          <div class="institute-text">
            <span class="institute-title" id="sidebarInstName">Apex Academy</span>
            <small class="institute-subtitle" id="sidebarInstBranch">Main Branch • Live</small>
          </div>
        </div>
      </div>

      <nav class="sidebar-nav">
        <div class="nav-section-title">CORE MODULES</div>
        <a href="#dashboard" class="nav-item active" data-tab="dashboard">
          <i class="bi bi-grid-1x2-fill"></i>
          <span>Dashboard Overview</span>
        </a>
        <a href="#students" class="nav-item" data-tab="students">
          <i class="bi bi-people-fill"></i>
          <span>Student Directory</span>
          <span class="badge bg-primary-soft text-primary ms-auto" id="studentCountBadge">0</span>
        </a>
        <a href="#batches" class="nav-item" data-tab="batches">
          <i class="bi bi-diagram-3-fill"></i>
          <span>Batches & Classes</span>
          <span class="badge bg-secondary-soft text-secondary ms-auto" id="batchCountBadge">0</span>
        </a>
        <a href="#attendance" class="nav-item" data-tab="attendance">
          <i class="bi bi-calendar2-check-fill"></i>
          <span>Attendance Tracker</span>
        </a>
        <a href="#fees" class="nav-item" data-tab="fees">
          <i class="bi bi-cash-stack"></i>
          <span>Fees & Invoices</span>
          <span class="badge bg-danger-soft text-danger ms-auto" id="pendingDuesBadge">Dues</span>
        </a>

        <div class="nav-section-title mt-4">INSIGHTS & TOOLS</div>
        <a href="#reports" class="nav-item" data-tab="reports">
          <i class="bi bi-bar-chart-fill"></i>
          <span>Analytics & Reports</span>
        </a>
        <a href="#settings" class="nav-item" data-tab="settings">
          <i class="bi bi-gear-fill"></i>
          <span>Institute Settings</span>
        </a>
      </nav>

      <div class="sidebar-footer">
        <div class="user-profile-badge">
          <div class="avatar-circle">AD</div>
          <div class="user-details">
            <div class="user-name">Director Admin</div>
            <div class="user-role">Super Administrator</div>
          </div>
          <button class="btn btn-sm btn-icon text-muted" title="Pitch Demo Mode" onclick="showPitchModal()">
            <i class="bi bi-stars text-warning fs-6"></i>
          </button>
        </div>
      </div>
    </aside>

    <!-- =========================================================================
         Main Application Wrapper
         ========================================================================= -->
    <div class="app-main">
      <!-- Top Navbar -->
      <header class="app-header">
        <div class="d-flex align-items-center gap-3">
          <button class="btn btn-icon d-lg-none" id="toggleSidebarBtn">
            <i class="bi bi-list fs-4"></i>
          </button>
          <div class="header-search-wrap">
            <i class="bi bi-search search-icon"></i>
            <input type="text" id="globalSearchInput" class="form-control header-search" placeholder="Search students by name, roll no, or phone...">
          </div>
        </div>

        <div class="header-actions">
          <div class="system-status-indicator d-none d-md-flex">
            <span class="status-dot"></span>
            <span class="text-sm fw-medium text-muted">Cloud Connected</span>
          </div>

          <button class="btn btn-outline-primary btn-sm rounded-pill d-none d-sm-inline-flex align-items-center gap-2" onclick="exportStudentsToCSV()">
            <i class="bi bi-file-earmark-arrow-down"></i>
            <span>Export CSV</span>
          </button>

          <button class="btn btn-primary btn-sm rounded-pill d-inline-flex align-items-center gap-2 shadow-sm" onclick="openAddStudentModal()">
            <i class="bi bi-person-plus-fill"></i>
            <span>+ New Admission</span>
          </button>

          <div class="dropdown">
            <button class="btn btn-icon position-relative" data-bs-toggle="dropdown" aria-expanded="false">
              <i class="bi bi-bell fs-5"></i>
              <span class="position-absolute top-1 start-100 translate-middle p-1 bg-danger border border-light rounded-circle"></span>
            </button>
            <ul class="dropdown-menu dropdown-menu-end shadow border-0 p-2" style="min-width: 290px;">
              <li class="dropdown-header fw-bold text-dark">Tuition Notifications</li>
              <li><hr class="dropdown-divider"></li>
              <li class="p-2 small text-muted"><i class="bi bi-exclamation-triangle text-warning me-2"></i> 4 Students have pending fees due this week.</li>
              <li class="p-2 small text-muted"><i class="bi bi-info-circle text-primary me-2"></i> Attendance recorded for 10th Elite Batch.</li>
              <li class="p-2 small text-muted"><i class="bi bi-check2-circle text-success me-2"></i> Database auto-synchronized.</li>
            </ul>
          </div>
        </div>
      </header>

      <!-- Main Body Container -->
      <main class="app-content">

        <!-- ===================================================================
             TAB 1: DASHBOARD OVERVIEW
             =================================================================== -->
        <section id="tab-dashboard" class="content-tab active">
          <!-- Page Header -->
          <div class="d-flex flex-wrap justify-content-between align-items-center mb-4 gap-3">
            <div>
              <h1 class="page-title">Executive Dashboard</h1>
              <p class="page-subtitle">Real-time tuition operations, batch health & fee collection overview</p>
            </div>
            <div class="d-flex gap-2">
              <button class="btn btn-white border shadow-sm btn-sm" onclick="generateDemoData()"><i class="bi bi-arrow-repeat me-1"></i> Refresh Demo Data</button>
              <button class="btn btn-primary btn-sm shadow-sm" onclick="openAddBatchModal()"><i class="bi bi-plus-lg me-1"></i> Add Batch</button>
            </div>
          </div>

          <!-- KPI Cards Grid -->
          <div class="row g-3 mb-4">
            <div class="col-sm-6 col-xl-3">
              <div class="metric-card">
                <div class="d-flex align-items-center justify-content-between mb-2">
                  <span class="metric-label">Total Enrolled</span>
                  <div class="metric-icon bg-indigo-soft text-indigo">
                    <i class="bi bi-mortarboard"></i>
                  </div>
                </div>
                <div class="metric-value" id="kpiTotalStudents">0</div>
                <div class="metric-trend text-success">
                  <i class="bi bi-graph-up-arrow"></i>
                  <span>+14% new admissions this month</span>
                </div>
              </div>
            </div>

            <div class="col-sm-6 col-xl-3">
              <div class="metric-card">
                <div class="d-flex align-items-center justify-content-between mb-2">
                  <span class="metric-label">Fee Collection (MTD)</span>
                  <div class="metric-icon bg-emerald-soft text-emerald">
                    <i class="bi bi-currency-rupee"></i>
                  </div>
                </div>
                <div class="metric-value" id="kpiCollectedFees">₹0</div>
                <div class="metric-trend text-success">
                  <i class="bi bi-check2-all"></i>
                  <span id="kpiCollectionRate">82% collection efficiency</span>
                </div>
              </div>
            </div>

            <div class="col-sm-6 col-xl-3">
              <div class="metric-card">
                <div class="d-flex align-items-center justify-content-between mb-2">
                  <span class="metric-label">Pending Fees Due</span>
                  <div class="metric-icon bg-rose-soft text-rose">
                    <i class="bi bi-clock-history"></i>
                  </div>
                </div>
                <div class="metric-value text-rose" id="kpiPendingFees">₹0</div>
                <div class="metric-trend text-danger">
                  <i class="bi bi-exclamation-circle"></i>
                  <span id="kpiPendingCount">0 accounts pending</span>
                </div>
              </div>
            </div>

            <div class="col-sm-6 col-xl-3">
              <div class="metric-card">
                <div class="d-flex align-items-center justify-content-between mb-2">
                  <span class="metric-label">Avg. Attendance</span>
                  <div class="metric-icon bg-sky-soft text-sky">
                    <i class="bi bi-person-check"></i>
                  </div>
                </div>
                <div class="metric-value text-primary" id="kpiAvgAttendance">94.2%</div>
                <div class="metric-trend text-success">
                  <i class="bi bi-calendar2-range"></i>
                  <span>Active across all batches</span>
                </div>
              </div>
            </div>
          </div>

          <!-- Charts Section -->
          <div class="row g-4 mb-4">
            <div class="col-lg-8">
              <div class="content-card">
                <div class="card-header-flex">
                  <div>
                    <h3 class="card-heading">Fee Collection & Revenue Trend</h3>
                    <p class="card-subheading">Monthly tuition fee inflow vs projected targets</p>
                  </div>
                  <div class="badge bg-indigo-soft text-indigo px-3 py-2">Fiscal 2026-27</div>
                </div>
                <div class="chart-container" style="position: relative; height: 280px;">
                  <canvas id="revenueChart"></canvas>
                </div>
              </div>
            </div>

            <div class="col-lg-4">
              <div class="content-card">
                <div class="card-header-flex">
                  <div>
                    <h3 class="card-heading">Batch Distribution</h3>
                    <p class="card-subheading">Students enrolled by grade / batch</p>
                  </div>
                </div>
                <div class="chart-container" style="position: relative; height: 280px;">
                  <canvas id="batchDistributionChart"></canvas>
                </div>
              </div>
            </div>
          </div>

          <!-- Quick Action Panels: Urgent Dues & Recent Admissions -->
          <div class="row g-4">
            <div class="col-lg-7">
              <div class="content-card">
                <div class="card-header-flex">
                  <div>
                    <h3 class="card-heading">Recent Student Admissions</h3>
                    <p class="card-subheading">Latest registrations across all tuition batches</p>
                  </div>
                  <button class="btn btn-sm btn-link text-primary text-decoration-none fw-semibold" onclick="switchTab('students')">View All →</button>
                </div>
                <div class="table-responsive">
                  <table class="table custom-table align-middle">
                    <thead>
                      <tr>
                        <th>Student</th>
                        <th>Standard / Batch</th>
                        <th>Enrolled Date</th>
                        <th>Fee Status</th>
                      </tr>
                    </thead>
                    <tbody id="recentStudentsTableBody">
                      <!-- Rendered dynamically -->
                    </tbody>
                  </table>
                </div>
              </div>
            </div>

            <div class="col-lg-5">
              <div class="content-card">
                <div class="card-header-flex">
                  <div>
                    <h3 class="card-heading">Urgent Fee Dues Follow-up</h3>
                    <p class="card-subheading">Students with high outstanding balance</p>
                  </div>
                  <button class="btn btn-sm btn-link text-primary text-decoration-none fw-semibold" onclick="switchTab('fees')">All Dues →</button>
                </div>
                <div class="dues-list" id="urgentDuesList">
                  <!-- Rendered dynamically -->
                </div>
              </div>
            </div>
          </div>
        </section>

        <!-- ===================================================================
             TAB 2: STUDENT DIRECTORY (CRUD)
             =================================================================== -->
        <section id="tab-students" class="content-tab">
          <div class="d-flex flex-wrap justify-content-between align-items-center mb-4 gap-3">
            <div>
              <h1 class="page-title">Student Records & Admissions</h1>
              <p class="page-subtitle">Complete student registry with active contact, batch and fee status</p>
            </div>
            <div class="d-flex gap-2">
              <button class="btn btn-outline-secondary btn-sm" onclick="exportStudentsToCSV()"><i class="bi bi-download me-1"></i> Export Records</button>
              <button class="btn btn-primary btn-sm shadow-sm" onclick="openAddStudentModal()"><i class="bi bi-person-plus-fill me-1"></i> Add Student</button>
            </div>
          </div>

          <div class="content-card">
            <!-- Filter Toolbar -->
            <div class="row g-2 mb-3">
              <div class="col-md-5">
                <div class="input-group">
                  <span class="input-group-text bg-white border-end-0"><i class="bi bi-search text-muted"></i></span>
                  <input type="text" id="studentSearchFilter" class="form-control border-start-0" placeholder="Filter by student name, roll number, or phone..." oninput="filterStudentsTable()">
                </div>
              </div>
              <div class="col-md-3">
                <select id="studentBatchFilter" class="form-select" onchange="filterStudentsTable()">
                  <option value="ALL">All Batches</option>
                  <!-- Populated dynamically -->
                </select>
              </div>
              <div class="col-md-2">
                <select id="studentGradeFilter" class="form-select" onchange="filterStudentsTable()">
                  <option value="ALL">All Standards</option>
                  <option value="9th Standard">9th Standard</option>
                  <option value="10th Boards">10th Boards</option>
                  <option value="11th Science">11th Science</option>
                  <option value="12th Science">12th Science</option>
                  <option value="12th Commerce">12th Commerce</option>
                  <option value="Diploma Sem 5">Diploma Sem 5</option>
                </select>
              </div>
              <div class="col-md-2">
                <select id="studentStatusFilter" class="form-select" onchange="filterStudentsTable()">
                  <option value="ALL">All Status</option>
                  <option value="Active">Active</option>
                  <option value="On-Leave">On-Leave</option>
                  <option value="Completed">Completed</option>
                </select>
              </div>
            </div>

            <!-- Student Table -->
            <div class="table-responsive">
              <table class="table custom-table align-middle">
                <thead>
                  <tr>
                    <th>Roll / ID</th>
                    <th>Student Name</th>
                    <th>Standard & Batch</th>
                    <th>Contacts (Student / Parent)</th>
                    <th>Fee Status</th>
                    <th>Attendance</th>
                    <th>Status</th>
                    <th class="text-end">Actions</th>
                  </tr>
                </thead>
                <tbody id="studentsFullTableBody">
                  <!-- Populated dynamically via app.js -->
                </tbody>
              </table>
            </div>

            <!-- Empty State -->
            <div id="studentsEmptyState" class="empty-state d-none">
              <i class="bi bi-people display-4 text-muted"></i>
              <h4 class="mt-3">No students found</h4>
              <p class="text-muted">Try adjusting your filters or register a new student.</p>
              <button class="btn btn-primary btn-sm" onclick="openAddStudentModal()">+ Register Student</button>
            </div>
          </div>
        </section>

        <!-- ===================================================================
             TAB 3: BATCHES & COURSES (CRUD)
             =================================================================== -->
        <section id="tab-batches" class="content-tab">
          <div class="d-flex flex-wrap justify-content-between align-items-center mb-4 gap-3">
            <div>
              <h1 class="page-title">Batches & Subject Classes</h1>
              <p class="page-subtitle">Manage class timings, faculty allocation, classroom capacity and syllabus</p>
            </div>
            <button class="btn btn-primary btn-sm shadow-sm" onclick="openAddBatchModal()"><i class="bi bi-plus-lg me-1"></i> Create New Batch</button>
          </div>

          <!-- Batches Grid Cards -->
          <div class="row g-4" id="batchesGridContainer">
            <!-- Populated dynamically -->
          </div>
        </section>

        <!-- ===================================================================
             TAB 4: ATTENDANCE TRACKER
             =================================================================== -->
        <section id="tab-attendance" class="content-tab">
          <div class="d-flex flex-wrap justify-content-between align-items-center mb-4 gap-3">
            <div>
              <h1 class="page-title">Daily Attendance Register</h1>
              <p class="page-subtitle">Mark and track batch-wise student presence with one-click actions</p>
            </div>
            <div class="d-flex gap-2">
              <button class="btn btn-outline-success btn-sm" onclick="markAllAttendance('Present')"><i class="bi bi-check-all me-1"></i> Mark All Present</button>
              <button class="btn btn-outline-secondary btn-sm" onclick="markAllAttendance('Absent')"><i class="bi bi-x-circle me-1"></i> Mark All Absent</button>
              <button class="btn btn-primary btn-sm shadow-sm" onclick="saveAttendanceRecords()"><i class="bi bi-cloud-arrow-up-fill me-1"></i> Save Register</button>
            </div>
          </div>

          <div class="content-card">
            <!-- Batch & Date Selector Bar -->
            <div class="row g-3 align-items-center mb-4 p-3 bg-light rounded-3">
              <div class="col-md-4">
                <label class="form-label fw-semibold small text-muted">Select Batch</label>
                <select id="attendanceBatchSelect" class="form-select" onchange="renderAttendanceSheet()">
                  <!-- Dynamically populated -->
                </select>
              </div>
              <div class="col-md-4">
                <label class="form-label fw-semibold small text-muted">Attendance Date</label>
                <input type="date" id="attendanceDateInput" class="form-control" onchange="renderAttendanceSheet()">
              </div>
              <div class="col-md-4">
                <div class="attendance-summary-badge p-2 bg-white rounded border d-flex justify-content-around text-center">
                  <div>
                    <span class="d-block small text-muted">Present</span>
                    <strong class="text-success fs-6" id="attPresentCount">0</strong>
                  </div>
                  <div class="border-start"></div>
                  <div>
                    <span class="d-block small text-muted">Absent</span>
                    <strong class="text-danger fs-6" id="attAbsentCount">0</strong>
                  </div>
                  <div class="border-start"></div>
                  <div>
                    <span class="d-block small text-muted">Rate</span>
                    <strong class="text-primary fs-6" id="attRatePercent">0%</strong>
                  </div>
                </div>
              </div>
            </div>

            <!-- Attendance Register Table -->
            <div class="table-responsive">
              <table class="table custom-table align-middle">
                <thead>
                  <tr>
                    <th style="width: 100px;">Roll No</th>
                    <th>Student Name</th>
                    <th>Parent Phone</th>
                    <th>Status Action</th>
                    <th>Current Note / Reason</th>
                  </tr>
                </thead>
                <tbody id="attendanceSheetBody">
                  <!-- Rendered dynamically -->
                </tbody>
              </table>
            </div>
          </div>
        </section>

        <!-- ===================================================================
             TAB 5: FEES & INVOICING (CRUD + RECEIPT)
             =================================================================== -->
        <section id="tab-fees" class="content-tab">
          <div class="d-flex flex-wrap justify-content-between align-items-center mb-4 gap-3">
            <div>
              <h1 class="page-title">Tuition Fee Ledger & Billing</h1>
              <p class="page-subtitle">Track payments, installment schedules, overdue accounts & generate receipts</p>
            </div>
            <button class="btn btn-primary btn-sm shadow-sm" onclick="openCollectFeeModal()"><i class="bi bi-wallet2 me-1"></i> Record Payment</button>
          </div>

          <!-- Fee Summary Cards -->
          <div class="row g-3 mb-4">
            <div class="col-md-4">
              <div class="fee-stat-card border-indigo">
                <span class="text-muted small fw-semibold">TOTAL COMMITTED REVENUE</span>
                <h3 class="fs-4 fw-bold mt-1 text-dark" id="feeTotalBilled">₹0</h3>
                <small class="text-muted">Total fees of all enrolled students</small>
              </div>
            </div>
            <div class="col-md-4">
              <div class="fee-stat-card border-emerald">
                <span class="text-muted small fw-semibold">TOTAL COLLECTED (PAID)</span>
                <h3 class="fs-4 fw-bold mt-1 text-success" id="feeTotalReceived">₹0</h3>
                <small class="text-success"><i class="bi bi-check-circle me-1"></i> Cash / UPI in institute account</small>
              </div>
            </div>
            <div class="col-md-4">
              <div class="fee-stat-card border-rose">
                <span class="text-muted small fw-semibold">TOTAL OUTSTANDING DUES</span>
                <h3 class="fs-4 fw-bold mt-1 text-danger" id="feeTotalRemaining">₹0</h3>
                <small class="text-danger"><i class="bi bi-clock me-1"></i> Pending collection from parents</small>
              </div>
            </div>
          </div>

          <div class="content-card">
            <!-- Filter Toolbar -->
            <div class="row g-2 mb-3">
              <div class="col-md-6">
                <div class="input-group">
                  <span class="input-group-text bg-white border-end-0"><i class="bi bi-search text-muted"></i></span>
                  <input type="text" id="feeSearchFilter" class="form-control border-start-0" placeholder="Search by student name or roll number..." oninput="filterFeesTable()">
                </div>
              </div>
              <div class="col-md-3">
                <select id="feeStatusFilter" class="form-select" onchange="filterFeesTable()">
                  <option value="ALL">All Payment Statuses</option>
                  <option value="PAID">Fully Paid</option>
                  <option value="PARTIAL">Partially Paid</option>
                  <option value="UNPAID">Unpaid / High Overdue</option>
                </select>
              </div>
              <div class="col-md-3 text-end">
                <button class="btn btn-outline-secondary w-100" onclick="exportStudentsToCSV()"><i class="bi bi-file-earmark-spreadsheet me-1"></i> Export Ledger CSV</button>
              </div>
            </div>

            <!-- Ledger Table -->
            <div class="table-responsive">
              <table class="table custom-table align-middle">
                <thead>
                  <tr>
                    <th>Invoice / Roll</th>
                    <th>Student Name</th>
                    <th>Standard / Batch</th>
                    <th>Total Fee</th>
                    <th>Paid Amount</th>
                    <th>Due Balance</th>
                    <th>Status</th>
                    <th class="text-end">Actions</th>
                  </tr>
                </thead>
                <tbody id="feesTableBody">
                  <!-- Rendered dynamically -->
                </tbody>
              </table>
            </div>
          </div>
        </section>

        <!-- ===================================================================
             TAB 6: ANALYTICS & REPORTS
             =================================================================== -->
        <section id="tab-reports" class="content-tab">
          <div class="d-flex flex-wrap justify-content-between align-items-center mb-4 gap-3">
            <div>
              <h1 class="page-title">Executive Reports & Data Auditing</h1>
              <p class="page-subtitle">In-depth batch performance, revenue insights and compliance reports</p>
            </div>
            <div class="d-flex gap-2">
              <button class="btn btn-outline-dark btn-sm" onclick="window.print()"><i class="bi bi-printer me-1"></i> Print Report</button>
              <button class="btn btn-primary btn-sm shadow-sm" onclick="exportStudentsToCSV()"><i class="bi bi-download me-1"></i> Export All Data</button>
            </div>
          </div>

          <div class="row g-4 mb-4">
            <div class="col-md-6">
              <div class="content-card">
                <h3 class="card-heading mb-3">Batch-Wise Financial Performance</h3>
                <div class="table-responsive">
                  <table class="table table-sm custom-table">
                    <thead>
                      <tr>
                        <th>Batch</th>
                        <th>Students</th>
                        <th>Total Fee</th>
                        <th>Collected</th>
                        <th>Recovery %</th>
                      </tr>
                    </thead>
                    <tbody id="reportsBatchSummaryBody">
                      <!-- Rendered dynamically -->
                    </tbody>
                  </table>
                </div>
              </div>
            </div>

            <div class="col-md-6">
              <div class="content-card">
                <h3 class="card-heading mb-3">Tuition Class Standard Health Index</h3>
                <div class="p-3 bg-light rounded-3 mb-3">
                  <div class="d-flex justify-content-between mb-1">
                    <span class="small fw-semibold">Board Exam Batches (10th & 12th) Attendance</span>
                    <span class="small fw-bold text-success">96%</span>
                  </div>
                  <div class="progress" style="height: 8px;">
                    <div class="progress-bar bg-success" style="width: 96%"></div>
                  </div>
                </div>

                <div class="p-3 bg-light rounded-3 mb-3">
                  <div class="d-flex justify-content-between mb-1">
                    <span class="small fw-semibold">Fee Recovery On-Time Ratio</span>
                    <span class="small fw-bold text-primary">84%</span>
                  </div>
                  <div class="progress" style="height: 8px;">
                    <div class="progress-bar bg-primary" style="width: 84%"></div>
                  </div>
                </div>

                <div class="p-3 bg-light rounded-3">
                  <div class="d-flex justify-content-between mb-1">
                    <span class="small fw-semibold">Classroom Capacity Utilization</span>
                    <span class="small fw-bold text-warning">78%</span>
                  </div>
                  <div class="progress" style="height: 8px;">
                    <div class="progress-bar bg-warning" style="width: 78%"></div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>

        <!-- ===================================================================
             TAB 7: SETTINGS & INSTITUTE BRANDING
             =================================================================== -->
        <section id="tab-settings" class="content-tab">
          <div class="d-flex flex-wrap justify-content-between align-items-center mb-4 gap-3">
            <div>
              <h1 class="page-title">Institute Branding & System Settings</h1>
              <p class="page-subtitle">Configure your tuition center name, receipt header, currency and backup data</p>
            </div>
            <button class="btn btn-primary btn-sm shadow-sm" onclick="saveInstituteSettings()"><i class="bi bi-save me-1"></i> Save Changes</button>
          </div>

          <div class="row g-4">
            <div class="col-lg-8">
              <div class="content-card">
                <h3 class="card-heading mb-3">Tuition / Coaching Center Profile</h3>
                <form id="settingsForm">
                  <div class="row g-3">
                    <div class="col-md-6">
                      <label class="form-label fw-semibold">Institute / Tuition Name</label>
                      <input type="text" id="settingInstName" class="form-control" value="Apex Academy & Tuition Classes">
                    </div>
                    <div class="col-md-6">
                      <label class="form-label fw-semibold">Tagline / Motto</label>
                      <input type="text" id="settingInstTagline" class="form-control" value="Excellence in Board & Competitive Coaching">
                    </div>
                    <div class="col-md-6">
                      <label class="form-label fw-semibold">Primary Contact / Phone</label>
                      <input type="text" id="settingInstPhone" class="form-control" value="+91 98765 43210">
                    </div>
                    <div class="col-md-6">
                      <label class="form-label fw-semibold">Official Email</label>
                      <input type="email" id="settingInstEmail" class="form-control" value="admin@apexacademy.edu.in">
                    </div>
                    <div class="col-12">
                      <label class="form-label fw-semibold">Address / Campus Location</label>
                      <input type="text" id="settingInstAddress" class="form-control" value="2nd Floor, Shivalik Complex, Near City Bus Stop, Jamnagar, Gujarat">
                    </div>
                    <div class="col-md-4">
                      <label class="form-label fw-semibold">Receipt Prefix</label>
                      <input type="text" id="settingReceiptPrefix" class="form-control" value="APX-2026-">
                    </div>
                    <div class="col-md-4">
                      <label class="form-label fw-semibold">Currency Symbol</label>
                      <input type="text" id="settingCurrency" class="form-control" value="₹">
                    </div>
                    <div class="col-md-4">
                      <label class="form-label fw-semibold">Academic Session</label>
                      <input type="text" id="settingSession" class="form-control" value="2026-2027">
                    </div>
                  </div>
                </form>
              </div>
            </div>

            <div class="col-lg-4">
              <div class="content-card">
                <h3 class="card-heading mb-3">Data Management & Backup</h3>
                <p class="small text-muted mb-3">All your changes are saved locally in real-time. You can also export full JSON database backups or reset to pristine demo data for client pitches.</p>
                <div class="d-grid gap-2">
                  <button class="btn btn-outline-primary" onclick="exportDataJSON()"><i class="bi bi-file-earmark-code me-2"></i> Download JSON Backup</button>
                  <button class="btn btn-outline-warning" onclick="resetToSampleData()"><i class="bi bi-arrow-counterclockwise me-2"></i> Reset Demo Institute Data</button>
                  <button class="btn btn-outline-danger" onclick="clearAllData()"><i class="bi bi-trash3 me-2"></i> Wipe All Records</button>
                </div>
              </div>
            </div>
          </div>
        </section>

      </main>
    </div>
  </div>

  <!-- =========================================================================
       MODALS SECTION (CRUD Operations)
       ========================================================================= -->

  <!-- 1. Add / Edit Student Modal -->
  <div class="modal fade" id="studentModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content border-0 shadow-lg">
        <div class="modal-header bg-primary text-white">
          <h5 class="modal-title fw-bold" id="studentModalTitle"><i class="bi bi-person-plus-fill me-2"></i>New Student Admission</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form id="studentForm" onsubmit="handleStudentFormSubmit(event)">
          <input type="hidden" id="studentIdHidden">
          <div class="modal-body p-4">
            <div class="row g-3">
              <div class="col-md-6">
                <label class="form-label fw-semibold">Student Full Name <span class="text-danger">*</span></label>
                <input type="text" id="studentNameInput" class="form-control" placeholder="e.g. Rahul Sharma" required>
              </div>
              <div class="col-md-6">
                <label class="form-label fw-semibold">Roll / Admission Number</label>
                <input type="text" id="studentRollInput" class="form-control" placeholder="Auto-generated if empty">
              </div>
              <div class="col-md-6">
                <label class="form-label fw-semibold">Standard / Grade <span class="text-danger">*</span></label>
                <select id="studentGradeInput" class="form-select" required>
                  <option value="">Select Standard...</option>
                  <option value="9th Standard">9th Standard</option>
                  <option value="10th Boards">10th Boards</option>
                  <option value="11th Science">11th Science</option>
                  <option value="12th Science">12th Science</option>
                  <option value="12th Commerce">12th Commerce</option>
                  <option value="Diploma Sem 5">Diploma Sem 5 (IT/CE)</option>
                </select>
              </div>
              <div class="col-md-6">
                <label class="form-label fw-semibold">Batch Assigned <span class="text-danger">*</span></label>
                <select id="studentBatchInput" class="form-select" required>
                  <!-- Populated dynamically -->
                </select>
              </div>
              <div class="col-md-6">
                <label class="form-label fw-semibold">Student Contact / WhatsApp <span class="text-danger">*</span></label>
                <input type="tel" id="studentPhoneInput" class="form-control" placeholder="10-digit mobile number" required>
              </div>
              <div class="col-md-6">
                <label class="form-label fw-semibold">Parent / Guardian Contact <span class="text-danger">*</span></label>
                <input type="tel" id="studentParentPhoneInput" class="form-control" placeholder="Parent mobile number" required>
              </div>
              <div class="col-md-6">
                <label class="form-label fw-semibold">Total Agreed Tuition Fee (₹) <span class="text-danger">*</span></label>
                <input type="number" id="studentTotalFeeInput" class="form-control" placeholder="e.g. 25000" min="0" required>
              </div>
              <div class="col-md-6">
                <label class="form-label fw-semibold">Initial Payment Received (₹)</label>
                <input type="number" id="studentPaidFeeInput" class="form-control" placeholder="e.g. 10000" min="0" value="0">
              </div>
              <div class="col-md-6">
                <label class="form-label fw-semibold">Enrollment Date</label>
                <input type="date" id="studentEnrollDateInput" class="form-control">
              </div>
              <div class="col-md-6">
                <label class="form-label fw-semibold">Academic Status</label>
                <select id="studentStatusSelect" class="form-select">
                  <option value="Active">Active</option>
                  <option value="On-Leave">On-Leave</option>
                  <option value="Completed">Completed</option>
                </select>
              </div>
              <div class="col-12">
                <label class="form-label fw-semibold">Remarks / Previous School / Notes</label>
                <textarea id="studentNotesInput" class="form-control" rows="2" placeholder="e.g. Needs extra focus in Physics & Math"></textarea>
              </div>
            </div>
          </div>
          <div class="modal-footer bg-light">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-primary" id="studentSaveBtn">Save Record</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- 2. Add / Edit Batch Modal -->
  <div class="modal fade" id="batchModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content border-0 shadow-lg">
        <div class="modal-header bg-primary text-white">
          <h5 class="modal-title fw-bold" id="batchModalTitle"><i class="bi bi-diagram-3-fill me-2"></i>Create New Batch</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form id="batchForm" onsubmit="handleBatchFormSubmit(event)">
          <input type="hidden" id="batchIdHidden">
          <div class="modal-body p-4">
            <div class="mb-3">
              <label class="form-label fw-semibold">Batch Name / Code <span class="text-danger">*</span></label>
              <input type="text" id="batchNameInput" class="form-control" placeholder="e.g. 10th Boards Elite (Morning)" required>
            </div>
            <div class="mb-3">
              <label class="form-label fw-semibold">Subject / Stream <span class="text-danger">*</span></label>
              <input type="text" id="batchSubjectInput" class="form-control" placeholder="e.g. Science & Maths / Physics" required>
            </div>
            <div class="mb-3">
              <label class="form-label fw-semibold">Faculty / Lead Teacher</label>
              <input type="text" id="batchTeacherInput" class="form-control" placeholder="e.g. Prof. Hani Pandya / Dr. Mehta" required>
            </div>
            <div class="row g-2 mb-3">
              <div class="col-md-7">
                <label class="form-label fw-semibold">Schedule / Timings</label>
                <input type="text" id="batchTimingInput" class="form-control" placeholder="e.g. Mon-Fri 05:00 PM - 06:30 PM" required>
              </div>
              <div class="col-md-5">
                <label class="form-label fw-semibold">Max Capacity</label>
                <input type="number" id="batchCapacityInput" class="form-control" value="30" min="1" required>
              </div>
            </div>
          </div>
          <div class="modal-footer bg-light">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-primary">Save Batch</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- 3. Record Fee Payment Modal -->
  <div class="modal fade" id="feePaymentModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content border-0 shadow-lg">
        <div class="modal-header bg-success text-white">
          <h5 class="modal-title fw-bold"><i class="bi bi-wallet2 me-2"></i>Collect Tuition Fee</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form id="feePaymentForm" onsubmit="handleFeePaymentSubmit(event)">
          <input type="hidden" id="feeStudentIdHidden">
          <div class="modal-body p-4">
            <div class="p-3 bg-light rounded-3 mb-3">
              <div class="d-flex justify-content-between align-items-center">
                <div>
                  <h6 class="fw-bold mb-0" id="feeModalStudentName">Student Name</h6>
                  <small class="text-muted" id="feeModalStudentInfo">10th Boards • Roll: APX-101</small>
                </div>
                <div class="text-end">
                  <span class="small text-muted d-block">Pending Due</span>
                  <span class="fs-5 fw-bold text-danger" id="feeModalPendingAmount">₹0</span>
                </div>
              </div>
            </div>

            <div class="mb-3">
              <label class="form-label fw-semibold">Amount to Pay Now (₹) <span class="text-danger">*</span></label>
              <input type="number" id="feePayAmountInput" class="form-control form-control-lg" min="1" required>
            </div>
            <div class="row g-2 mb-3">
              <div class="col-md-6">
                <label class="form-label fw-semibold">Payment Mode</label>
                <select id="feePayModeInput" class="form-select">
                  <option value="UPI / QR Code">UPI / QR Code (PhonePe/GPay)</option>
                  <option value="Cash">Cash at Counter</option>
                  <option value="Bank NEFT / IMPS">Bank NEFT / IMPS</option>
                  <option value="Cheque">Bank Cheque</option>
                </select>
              </div>
              <div class="col-md-6">
                <label class="form-label fw-semibold">Payment Date</label>
                <input type="date" id="feePayDateInput" class="form-control">
              </div>
            </div>
            <div class="mb-3">
              <label class="form-label fw-semibold">Transaction Reference / Receipt Note</label>
              <input type="text" id="feePayRefInput" class="form-control" placeholder="e.g. UPI Ref #48290123 / Cash Slip">
            </div>
          </div>
          <div class="modal-footer bg-light">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-success fw-semibold"><i class="bi bi-printer me-1"></i> Confirm & Print Receipt</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- 4. Printable Tuition Fee Receipt Modal -->
  <div class="modal fade" id="receiptModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content border-0 shadow-lg">
        <div class="modal-header border-0 pb-0">
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body p-4 pt-1" id="printableReceiptArea">
          <!-- Receipt Template -->
          <div class="receipt-box p-4 border rounded-3 bg-white">
            <div class="text-center pb-3 border-bottom mb-3">
              <div class="receipt-brand-logo mb-1">
                <i class="bi bi-mortarboard-fill text-primary fs-2"></i>
              </div>
              <h4 class="fw-bold mb-0 text-dark" id="recInstName">Apex Academy & Tuition Classes</h4>
              <p class="small text-muted mb-1" id="recInstTagline">Excellence in Board & Competitive Coaching</p>
              <small class="text-muted d-block" id="recInstAddress">2nd Floor, Shivalik Complex, Jamnagar, Gujarat</small>
              <small class="text-muted d-block">Phone: <span id="recInstPhone">+91 98765 43210</span></small>
            </div>

            <div class="d-flex justify-content-between align-items-center mb-3">
              <div>
                <span class="badge bg-light text-dark border">OFFICIAL FEE RECEIPT</span>
              </div>
              <div class="text-end small">
                <strong>Receipt No:</strong> <span id="recNo" class="text-primary fw-bold">APX-2026-001</span><br>
                <strong>Date:</strong> <span id="recDate">22 Oct 2026</span>
              </div>
            </div>

            <div class="receipt-info-grid mb-3 p-3 bg-light rounded">
              <div class="row g-2 small">
                <div class="col-6"><strong>Student Name:</strong> <span id="recStudentName">Rahul Sharma</span></div>
                <div class="col-6"><strong>Roll / ID:</strong> <span id="recRoll">APX-101</span></div>
                <div class="col-6"><strong>Standard:</strong> <span id="recGrade">10th Boards</span></div>
                <div class="col-6"><strong>Batch:</strong> <span id="recBatch">10th Elite</span></div>
                <div class="col-6"><strong>Payment Mode:</strong> <span id="recMode">UPI</span></div>
                <div class="col-6"><strong>Ref No:</strong> <span id="recRef">#48290123</span></div>
              </div>
            </div>

            <table class="table table-bordered table-sm small mb-3">
              <thead class="table-light">
                <tr>
                  <th>Particulars / Description</th>
                  <th class="text-end">Amount</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>Tuition & Coaching Fee Installment</td>
                  <td class="text-end fw-bold" id="recAmount">₹5,000</td>
                </tr>
                <tr>
                  <td class="text-muted">Total Fee Agreed: <span id="recTotalFee">₹25,000</span></td>
                  <td class="text-end text-muted">Paid to date: <span id="recTotalPaid">₹15,000</span></td>
                </tr>
                <tr class="table-warning">
                  <td><strong>Remaining Balance Due:</strong></td>
                  <td class="text-end fw-bold text-danger" id="recRemainingDue">₹10,000</td>
                </tr>
              </tbody>
            </table>

            <div class="d-flex justify-content-between align-items-end pt-3 border-top mt-4">
              <div class="text-muted small">
                <em>* Computer generated receipt</em>
              </div>
              <div class="text-center">
                <div class="stamp-box border border-dashed rounded p-1 mb-1 text-primary fw-bold small" style="transform: rotate(-3deg);">
                  APEX ACADEMY<br>PAID & VERIFIED
                </div>
                <span class="small fw-semibold text-muted">Authorized Signatory</span>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer bg-light">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary" onclick="printReceiptArea()"><i class="bi bi-printer me-1"></i> Print / Download PDF</button>
        </div>
      </div>
    </div>
  </div>

  <!-- 5. Pitch & Client Demo Mode Modal -->
  <div class="modal fade" id="pitchModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content border-0 shadow-lg">
        <div class="modal-header bg-dark text-white">
          <h5 class="modal-title fw-bold"><i class="bi bi-stars text-warning me-2"></i>Software Pitch & Client Demo Guide</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body p-4">
          <p class="lead fs-6 text-dark fw-semibold">How to pitch this software to coaching institutes, tuition classes & academies:</p>
          <ul class="list-group list-group-flush small mb-3">
            <li class="list-group-item d-flex gap-2">
              <i class="bi bi-check-circle-fill text-success fs-5"></i>
              <div><strong>Zero Server Setup Needed:</strong> Runs immediately in any browser on PC, tablet, or mobile. Data stays permanently saved in local browser storage or can be synced.</div>
            </li>
            <li class="list-group-item d-flex gap-2">
              <i class="bi bi-check-circle-fill text-success fs-5"></i>
              <div><strong>Solves Unpaid Fees & Follow-ups:</strong> Highlights pending fees instantly with one-click WhatsApp message triggers to parents.</div>
            </li>
            <li class="list-group-item d-flex gap-2">
              <i class="bi bi-check-circle-fill text-success fs-5"></i>
              <div><strong>Branded Fee Receipts:</strong> Prints professional GST/tuition receipts with the institute's logo and authorized stamp.</div>
            </li>
            <li class="list-group-item d-flex gap-2">
              <i class="bi bi-check-circle-fill text-success fs-5"></i>
              <div><strong>Batch Attendance:</strong> Eliminates physical registers; teachers can mark an entire batch of 30 students in 5 seconds.</div>
            </li>
          </ul>
        </div>
        <div class="modal-footer bg-light">
          <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Got it!</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap 5.3.3 JS Bundle CDN -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

  <!-- Application Logic -->
  <script src="{{ asset('js/edupulse.js') }}"></script>
</body>
</html>
