<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1.0" />
    <title>LIRS Connect | Admin Dashboard</title>
    <link
      href="https://fonts.googleapis.com/css2?family=DM+Serif+Display:ital@0;1&family=DM+Sans:wght@400;500;600;700&display=swap"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="app.css" />
  </head>
  <body>
    <!-- SIDEBAR -->    <?php include 'includes/sidebar.php'; ?>

    <!-- MAIN -->
    <div class="main">
      <!-- TOPBAR -->
      <header class="topbar">
        <div class="topbar-left">
          <h1 id="page-title">Dashboard</h1>
          <p>Sunday, 28 June 2026 &mdash; Lagos Internal Revenue Service</p>
        </div>
        <div class="topbar-right">
          <button class="btn btn-ghost">
            <svg
              viewBox="0 0 20 20"
              fill="none"
              stroke="currentColor"
              stroke-width="1.8"
            >
              <path d="M10 13V3M6.5 6.5 10 3l3.5 3.5M4 17h12" />
            </svg>
            Export
          </button>
          <div class="notif-btn" onclick="showTab('notifications', null)">
            <svg
              viewBox="0 0 20 20"
              fill="none"
              stroke="currentColor"
              stroke-width="1.6"
            >
              <path
                d="M10 2a6 6 0 0 0-6 6c0 5-2 6-2 6h16s-2-1-2-6a6 6 0 0 0-6-6z"
              />
              <path d="M11.7 17a2 2 0 0 1-3.4 0" />
            </svg>
            <div class="notif-dot"></div>
          </div>
        </div>
      </header>

      <div class="content">
        <!-- ══════════════ DASHBOARD TAB ══════════════ -->
        <div class="tab-page active" id="tab-dashboard">
          <div class="kpi-grid">
            <div class="kpi-card c-green">
              <div class="kpi-icon">
                <svg
                  viewBox="0 0 20 20"
                  fill="none"
                  stroke="currentColor"
                  stroke-width="1.5"
                >
                  <rect x="4" y="2" width="12" height="16" rx="1.5" />
                  <path d="M7 6h6M7 9h6M7 12h4" />
                </svg>
              </div>
              <div class="kpi-value">1,284</div>
              <div class="kpi-label">Total Complaints</div>
              <div class="kpi-delta delta-up">▲ 8.4% this month</div>
            </div>
            <div class="kpi-card c-amber">
              <div class="kpi-icon">
                <svg
                  viewBox="0 0 20 20"
                  fill="none"
                  stroke="currentColor"
                  stroke-width="1.5"
                >
                  <circle cx="10" cy="10" r="7.5" />
                  <path d="M10 6v4l3 2" />
                </svg>
              </div>
              <div class="kpi-value">342</div>
              <div class="kpi-label">Open / Pending</div>
              <div class="kpi-delta delta-down">▼ 12 from yesterday</div>
            </div>
            <div class="kpi-card c-green">
              <div class="kpi-icon">
                <svg
                  viewBox="0 0 20 20"
                  fill="none"
                  stroke="currentColor"
                  stroke-width="1.5"
                >
                  <circle cx="10" cy="10" r="7.5" />
                  <path d="m6.5 10 2.5 2.5 4.5-4.5" />
                </svg>
              </div>
              <div class="kpi-value">879</div>
              <div class="kpi-label">Resolved</div>
              <div class="kpi-delta delta-up">▲ 68.5% resolution rate</div>
            </div>
            <div class="kpi-card c-red">
              <div class="kpi-icon">
                <svg
                  viewBox="0 0 20 20"
                  fill="none"
                  stroke="currentColor"
                  stroke-width="1.5"
                >
                  <path d="M10 3.5 18 16.5H2Z" stroke-linejoin="round" />
                  <path d="M10 8v4M10 14h.01" />
                </svg>
              </div>
              <div class="kpi-value">63</div>
              <div class="kpi-label">Urgent / Escalated</div>
              <div class="kpi-delta delta-down">▼ 5 resolved today</div>
            </div>
          </div>

          <div class="bottom-grid">
            <div class="panel">
              <div class="panel-header">
                <div>
                  <div class="panel-title">Recent Complaints</div>
                  <div class="panel-sub">
                    Latest submissions across all categories
                  </div>
                </div>
                <div class="search-bar">
                  <svg
                    viewBox="0 0 20 20"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="1.8"
                  >
                    <circle cx="9" cy="9" r="6" />
                    <path d="M15 15l3 3" />
                  </svg>
                  <input placeholder="Search…" />
                </div>
              </div>
              <div class="table-wrap">
                <table>
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Taxpayer</th>
                      <th>Category</th>
                      <th>Priority</th>
                      <th>Status</th>
                      <th>Date</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td><span class="cid">#LIRS-2026-1091</span></td>
                      <td>Chukwuemeka Obi</td>
                      <td>VAT Dispute</td>
                      <td><span class="pdot p-high"></span>High</td>
                      <td><span class="badge badge-urgent">Escalated</span></td>
                      <td>28 Jun 2026</td>
                    </tr>
                    <tr>
                      <td><span class="cid">#LIRS-2026-1090</span></td>
                      <td>Funmilayo Adebayo</td>
                      <td>TIN Registration</td>
                      <td><span class="pdot p-medium"></span>Medium</td>
                      <td><span class="badge badge-open">Open</span></td>
                      <td>27 Jun 2026</td>
                    </tr>
                    <tr>
                      <td><span class="cid">#LIRS-2026-1089</span></td>
                      <td>Musa Garba</td>
                      <td>Refund Processing</td>
                      <td><span class="pdot p-high"></span>High</td>
                      <td>
                        <span class="badge badge-pending">In Review</span>
                      </td>
                      <td>27 Jun 2026</td>
                    </tr>
                    <tr>
                      <td><span class="cid">#LIRS-2026-1088</span></td>
                      <td>Ngozi Eze-Williams</td>
                      <td>PAYE Assessment</td>
                      <td><span class="pdot p-low"></span>Low</td>
                      <td>
                        <span class="badge badge-resolved">Resolved</span>
                      </td>
                      <td>26 Jun 2026</td>
                    </tr>
                    <tr>
                      <td><span class="cid">#LIRS-2026-1087</span></td>
                      <td>Ibrahim Suleiman</td>
                      <td>CIT Filing Error</td>
                      <td><span class="pdot p-medium"></span>Medium</td>
                      <td><span class="badge badge-open">Open</span></td>
                      <td>26 Jun 2026</td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
            <div class="right-col">
              <div class="panel">
                <div class="panel-header">
                  <div>
                    <div class="panel-title">Status Breakdown</div>
                    <div class="panel-sub">All complaints · June 2026</div>
                  </div>
                </div>
                <div class="donut-wrap">
                  <svg class="donut-svg" viewBox="0 0 36 36">
                    <circle
                      cx="18"
                      cy="18"
                      r="15.9"
                      fill="none"
                      stroke="#D1FAE5"
                      stroke-width="4"
                    />
                    <circle
                      cx="18"
                      cy="18"
                      r="15.9"
                      fill="none"
                      stroke="#059669"
                      stroke-width="4"
                      stroke-dasharray="68.5 31.5"
                      stroke-dashoffset="25"
                      stroke-linecap="round"
                    />
                    <circle
                      cx="18"
                      cy="18"
                      r="15.9"
                      fill="none"
                      stroke="#D97706"
                      stroke-width="4"
                      stroke-dasharray="17 83"
                      stroke-dashoffset="-43.5"
                      stroke-linecap="round"
                    />
                    <circle
                      cx="18"
                      cy="18"
                      r="15.9"
                      fill="none"
                      stroke="#DC2626"
                      stroke-width="4"
                      stroke-dasharray="5 95"
                      stroke-dashoffset="-60.5"
                      stroke-linecap="round"
                    />
                    <circle
                      cx="18"
                      cy="18"
                      r="15.9"
                      fill="none"
                      stroke="#1D4ED8"
                      stroke-width="4"
                      stroke-dasharray="9.5 90.5"
                      stroke-dashoffset="-65.5"
                      stroke-linecap="round"
                    />
                    <text
                      x="18"
                      y="16.5"
                      text-anchor="middle"
                      font-size="5"
                      fill="#0F2419"
                      font-weight="700"
                    >
                      1,284
                    </text>
                    <text
                      x="18"
                      y="21"
                      text-anchor="middle"
                      font-size="2.6"
                      fill="#6B7A72"
                    >
                      total
                    </text>
                  </svg>
                </div>
                <div class="donut-legend">
                  <div class="legend-row">
                    <span class="legend-left"
                      ><span
                        class="legend-dot"
                        style="background: var(--green-dark)"
                      ></span
                      >Resolved</span
                    ><span class="legend-val">879</span>
                  </div>
                  <div class="legend-row">
                    <span class="legend-left"
                      ><span
                        class="legend-dot"
                        style="background: var(--amber)"
                      ></span
                      >Open</span
                    ><span class="legend-val">218</span>
                  </div>
                  <div class="legend-row">
                    <span class="legend-left"
                      ><span
                        class="legend-dot"
                        style="background: var(--blue)"
                      ></span
                      >In Review</span
                    ><span class="legend-val">124</span>
                  </div>
                  <div class="legend-row">
                    <span class="legend-left"
                      ><span
                        class="legend-dot"
                        style="background: var(--red)"
                      ></span
                      >Escalated</span
                    ><span class="legend-val">63</span>
                  </div>
                </div>
              </div>
              <div class="panel">
                <div class="panel-header">
                  <div>
                    <div class="panel-title">Recent Activity</div>
                    <div class="panel-sub">System events · last 24 hours</div>
                  </div>
                </div>
                <div class="activity-item">
                  <span class="a-dot" style="background: var(--green)"></span>
                  <div>
                    <div class="activity-text">
                      <strong>#LIRS-2026-1084</strong> resolved by Officer Taiwo
                    </div>
                    <div class="activity-time">10:42 AM</div>
                  </div>
                </div>
                <div class="activity-item">
                  <span class="a-dot" style="background: var(--red)"></span>
                  <div>
                    <div class="activity-text">
                      <strong>#LIRS-2026-1091</strong> escalated for director
                      review
                    </div>
                    <div class="activity-time">09:15 AM</div>
                  </div>
                </div>
                <div class="activity-item">
                  <span class="a-dot" style="background: var(--blue)"></span>
                  <div>
                    <div class="activity-text">
                      New complaint filed by <strong>Musa Garba</strong>
                    </div>
                    <div class="activity-time">08:50 AM</div>
                  </div>
                </div>
                <div class="activity-item">
                  <span class="a-dot" style="background: var(--amber)"></span>
                  <div>
                    <div class="activity-text">
                      Monthly report exported by <strong>Amaka Adeyemi</strong>
                    </div>
                    <div class="activity-time">08:03 AM</div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- ══════════════ ALL COMPLAINTS TAB ══════════════ -->
        <div class="tab-page" id="tab-complaints">
          <div class="panel">
            <div class="panel-header">
              <div>
                <div class="panel-title">All Complaints</div>
                <div class="panel-sub">1,284 total records</div>
              </div>
              <div style="display: flex; gap: 10px">
                <div class="search-bar">
                  <svg
                    viewBox="0 0 20 20"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="1.8"
                  >
                    <circle cx="9" cy="9" r="6" />
                    <path d="M15 15l3 3" />
                  </svg>
                  <input placeholder="Search by ID, name, category…" />
                </div>
                <button class="btn btn-ghost btn-sm">
                  <svg
                    viewBox="0 0 20 20"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="1.6"
                  >
                    <path d="M3 4h14l-5.5 6.5V16l-3 1.5v-7L3 4z" />
                  </svg>
                  Filter
                </button>
                <button class="btn btn-primary btn-sm">
                  <svg
                    viewBox="0 0 20 20"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="1.8"
                  >
                    <circle cx="10" cy="10" r="7.5" />
                    <path d="M10 6.5v7M6.5 10h7" />
                  </svg>
                  New
                </button>
              </div>
            </div>
            <div class="filter-row">
              <div class="filter-chip active" onclick="setChip(this)">
                All (1,284)
              </div>
              <div class="filter-chip" onclick="setChip(this)">Open (218)</div>
              <div class="filter-chip" onclick="setChip(this)">
                In Review (124)
              </div>
              <div class="filter-chip" onclick="setChip(this)">
                Resolved (879)
              </div>
              <div class="filter-chip" onclick="setChip(this)">
                Escalated (63)
              </div>
            </div>
            <div class="table-wrap">
              <table>
                <thead>
                  <tr>
                    <th>Complaint ID</th>
                    <th>Taxpayer</th>
                    <th>TIN</th>
                    <th>Category</th>
                    <th>Priority</th>
                    <th>Assigned To</th>
                    <th>Status</th>
                    <th>Date Filed</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td><span class="cid">#LIRS-2026-1091</span></td>
                    <td>Chukwuemeka Obi</td>
                    <td>1234567-0001</td>
                    <td>VAT Dispute</td>
                    <td><span class="pdot p-high"></span>High</td>
                    <td>Officer Bello</td>
                    <td><span class="badge badge-urgent">Escalated</span></td>
                    <td>28 Jun 2026</td>
                    <td><button class="btn btn-ghost btn-sm">View</button></td>
                  </tr>
                  <tr>
                    <td><span class="cid">#LIRS-2026-1090</span></td>
                    <td>Funmilayo Adebayo</td>
                    <td>9876543-0002</td>
                    <td>TIN Registration</td>
                    <td><span class="pdot p-medium"></span>Medium</td>
                    <td>Officer Taiwo</td>
                    <td><span class="badge badge-open">Open</span></td>
                    <td>27 Jun 2026</td>
                    <td><button class="btn btn-ghost btn-sm">View</button></td>
                  </tr>
                  <tr>
                    <td><span class="cid">#LIRS-2026-1089</span></td>
                    <td>Musa Garba</td>
                    <td>5647382-0003</td>
                    <td>Refund Processing</td>
                    <td><span class="pdot p-high"></span>High</td>
                    <td>Officer Kemi</td>
                    <td><span class="badge badge-pending">In Review</span></td>
                    <td>27 Jun 2026</td>
                    <td><button class="btn btn-ghost btn-sm">View</button></td>
                  </tr>
                  <tr>
                    <td><span class="cid">#LIRS-2026-1088</span></td>
                    <td>Ngozi Eze-Williams</td>
                    <td>1122334-0004</td>
                    <td>PAYE Assessment</td>
                    <td><span class="pdot p-low"></span>Low</td>
                    <td>Officer Bello</td>
                    <td><span class="badge badge-resolved">Resolved</span></td>
                    <td>26 Jun 2026</td>
                    <td><button class="btn btn-ghost btn-sm">View</button></td>
                  </tr>
                  <tr>
                    <td><span class="cid">#LIRS-2026-1087</span></td>
                    <td>Ibrahim Suleiman</td>
                    <td>9988776-0005</td>
                    <td>CIT Filing Error</td>
                    <td><span class="pdot p-medium"></span>Medium</td>
                    <td>Unassigned</td>
                    <td><span class="badge badge-open">Open</span></td>
                    <td>26 Jun 2026</td>
                    <td><button class="btn btn-ghost btn-sm">View</button></td>
                  </tr>
                  <tr>
                    <td><span class="cid">#LIRS-2026-1086</span></td>
                    <td>Adaeze Nwosu</td>
                    <td>6655443-0006</td>
                    <td>Penalty Appeal</td>
                    <td><span class="pdot p-low"></span>Low</td>
                    <td>Officer Taiwo</td>
                    <td><span class="badge badge-resolved">Resolved</span></td>
                    <td>25 Jun 2026</td>
                    <td><button class="btn btn-ghost btn-sm">View</button></td>
                  </tr>
                  <tr>
                    <td><span class="cid">#LIRS-2026-1085</span></td>
                    <td>Emeka Okafor</td>
                    <td>3344556-0007</td>
                    <td>WHT Deduction</td>
                    <td><span class="pdot p-high"></span>High</td>
                    <td>Officer Kemi</td>
                    <td><span class="badge badge-urgent">Escalated</span></td>
                    <td>24 Jun 2026</td>
                    <td><button class="btn btn-ghost btn-sm">View</button></td>
                  </tr>
                  <tr>
                    <td><span class="cid">#LIRS-2026-1084</span></td>
                    <td>Hauwa Musa</td>
                    <td>7788990-0008</td>
                    <td>Stamp Duty</td>
                    <td><span class="pdot p-low"></span>Low</td>
                    <td>Officer Bello</td>
                    <td><span class="badge badge-resolved">Resolved</span></td>
                    <td>23 Jun 2026</td>
                    <td><button class="btn btn-ghost btn-sm">View</button></td>
                  </tr>
                </tbody>
              </table>
            </div>
            <div
              style="
                display: flex;
                align-items: center;
                justify-content: space-between;
                padding: 14px 22px;
                border-top: 1.5px solid var(--border);
                background: var(--off-white);
              "
            >
              <span style="font-size: 13px; color: var(--text-muted)"
                >Showing 1–8 of 1,284</span
              >
              <div style="display: flex; gap: 8px">
                <button class="btn btn-ghost btn-sm">← Prev</button>
                <button class="btn btn-primary btn-sm">Next →</button>
              </div>
            </div>
          </div>
        </div>

        <!-- ══════════════ NOTIFICATIONS TAB ══════════════ -->
        <div class="tab-page" id="tab-notifications">
          <div class="panel">
            <div class="panel-header">
              <div>
                <div class="panel-title">Notifications</div>
                <div class="panel-sub">5 unread alerts</div>
              </div>
              <button class="btn btn-ghost btn-sm">Mark all read</button>
            </div>
            <div class="notif-list">
              <div class="notif-item unread">
                <div class="notif-icon-wrap ni-red">
                  <svg
                    viewBox="0 0 20 20"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="1.6"
                  >
                    <path d="M10 3.5 18 16.5H2Z" stroke-linejoin="round" />
                    <path d="M10 8v4M10 14h.01" />
                  </svg>
                </div>
                <div class="notif-body">
                  <div class="notif-title">
                    Complaint #LIRS-2026-1091 Escalated
                  </div>
                  <div class="notif-desc">
                    VAT Dispute filed by Chukwuemeka Obi has been escalated and
                    requires director review.
                  </div>
                  <div class="notif-time">Today · 09:15 AM</div>
                </div>
                <div class="unread-dot"></div>
              </div>
              <div class="notif-item unread">
                <div class="notif-icon-wrap ni-amber">
                  <svg
                    viewBox="0 0 20 20"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="1.6"
                  >
                    <circle cx="10" cy="10" r="7.5" />
                    <path d="M10 6v4l3 2" />
                  </svg>
                </div>
                <div class="notif-body">
                  <div class="notif-title">SLA Breach Warning</div>
                  <div class="notif-desc">
                    3 complaints are approaching their 72-hour resolution
                    deadline. Immediate attention required.
                  </div>
                  <div class="notif-time">Today · 08:30 AM</div>
                </div>
                <div class="unread-dot"></div>
              </div>
              <div class="notif-item unread">
                <div class="notif-icon-wrap ni-green">
                  <svg
                    viewBox="0 0 20 20"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="1.6"
                  >
                    <circle cx="10" cy="10" r="7.5" />
                    <path d="m6.5 10 2.5 2.5 4.5-4.5" />
                  </svg>
                </div>
                <div class="notif-body">
                  <div class="notif-title">
                    Complaint #LIRS-2026-1084 Resolved
                  </div>
                  <div class="notif-desc">
                    Officer Taiwo successfully resolved the PAYE Assessment
                    complaint for Hauwa Musa.
                  </div>
                  <div class="notif-time">Today · 10:42 AM</div>
                </div>
                <div class="unread-dot"></div>
              </div>
              <div class="notif-item unread">
                <div class="notif-icon-wrap ni-blue">
                  <svg
                    viewBox="0 0 20 20"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="1.6"
                  >
                    <circle cx="10" cy="7" r="3.5" />
                    <path d="M3 17c0-3.3 3.1-6 7-6s7 2.7 7 6" />
                  </svg>
                </div>
                <div class="notif-body">
                  <div class="notif-title">New Taxpayer Registered</div>
                  <div class="notif-desc">
                    Musa Garba (TIN: 5647382-0003) has been registered and filed
                    their first complaint.
                  </div>
                  <div class="notif-time">Today · 08:50 AM</div>
                </div>
                <div class="unread-dot"></div>
              </div>
              <div class="notif-item unread">
                <div class="notif-icon-wrap ni-amber">
                  <svg
                    viewBox="0 0 20 20"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="1.6"
                  >
                    <path
                      d="M3 5.5A1.5 1.5 0 0 1 4.5 4h3l2 2h6A1.5 1.5 0 0 1 17 7.5v7A1.5 1.5 0 0 1 15.5 16h-11A1.5 1.5 0 0 1 3 14.5v-9z"
                    />
                  </svg>
                </div>
                <div class="notif-body">
                  <div class="notif-title">Monthly Report Ready</div>
                  <div class="notif-desc">
                    The June 2026 complaints summary report has been generated
                    and is ready for download.
                  </div>
                  <div class="notif-time">Today · 08:03 AM</div>
                </div>
                <div class="unread-dot"></div>
              </div>
              <div class="notif-item">
                <div class="notif-icon-wrap ni-green">
                  <svg
                    viewBox="0 0 20 20"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="1.6"
                  >
                    <path d="M3 13l4.5-5 3 3L17 5" />
                    <path d="M13 5h4v4" />
                  </svg>
                </div>
                <div class="notif-body">
                  <div class="notif-title">Weekly Stats Summary</div>
                  <div class="notif-desc">
                    This week: 142 new complaints filed, 98 resolved, resolution
                    rate up 4.2% vs last week.
                  </div>
                  <div class="notif-time">Yesterday · 06:00 PM</div>
                </div>
              </div>
              <div class="notif-item">
                <div class="notif-icon-wrap ni-red">
                  <svg
                    viewBox="0 0 20 20"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="1.6"
                  >
                    <circle cx="10" cy="10" r="2.6" />
                    <path
                      d="M10 2.5v2M10 15.5v2M17.5 10h-2M4.5 10h-2M15.1 4.9l-1.4 1.4M6.3 13.7l-1.4 1.4M15.1 15.1l-1.4-1.4M6.3 6.3 4.9 4.9"
                    />
                  </svg>
                </div>
                <div class="notif-body">
                  <div class="notif-title">System Maintenance Scheduled</div>
                  <div class="notif-desc">
                    Scheduled downtime: Sunday 29 June, 2:00 AM – 4:00 AM.
                    Please save all active work.
                  </div>
                  <div class="notif-time">Yesterday · 02:00 PM</div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- ══════════════ TAXPAYERS TAB ══════════════ -->
        <div class="tab-page" id="tab-taxpayers">
          <div class="panel">
            <div class="panel-header">
              <div>
                <div class="panel-title">Registered Taxpayers</div>
                <div class="panel-sub">1,042 registered accounts</div>
              </div>
              <div style="display: flex; gap: 10px">
                <div class="search-bar">
                  <svg
                    viewBox="0 0 20 20"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="1.8"
                  >
                    <circle cx="9" cy="9" r="6" />
                    <path d="M15 15l3 3" />
                  </svg>
                  <input placeholder="Search by name or TIN…" />
                </div>
                <button class="btn btn-primary btn-sm">
                  <svg
                    viewBox="0 0 20 20"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="1.8"
                  >
                    <circle cx="10" cy="10" r="7.5" />
                    <path d="M10 6.5v7M6.5 10h7" />
                  </svg>
                  Add Taxpayer
                </button>
              </div>
            </div>
            <div class="taxpayer-card">
              <div class="tp-card">
                <div class="tp-avatar">CO</div>
                <div class="tp-name">Chukwuemeka Obi</div>
                <div class="tp-tin">TIN: 1234567-0001</div>
                <div class="tp-stat">
                  <div class="tp-stat-item">
                    <div class="tp-stat-val">4</div>
                    <div class="tp-stat-lbl">Complaints</div>
                  </div>
                  <div class="tp-stat-item">
                    <div class="tp-stat-val">1</div>
                    <div class="tp-stat-lbl">Open</div>
                  </div>
                  <div class="tp-stat-item">
                    <div class="tp-stat-val" style="color: var(--amber)">3</div>
                    <div class="tp-stat-lbl">Resolved</div>
                  </div>
                </div>
              </div>
              <div class="tp-card">
                <div class="tp-avatar">FA</div>
                <div class="tp-name">Funmilayo Adebayo</div>
                <div class="tp-tin">TIN: 9876543-0002</div>
                <div class="tp-stat">
                  <div class="tp-stat-item">
                    <div class="tp-stat-val">2</div>
                    <div class="tp-stat-lbl">Complaints</div>
                  </div>
                  <div class="tp-stat-item">
                    <div class="tp-stat-val">1</div>
                    <div class="tp-stat-lbl">Open</div>
                  </div>
                  <div class="tp-stat-item">
                    <div class="tp-stat-val" style="color: var(--amber)">1</div>
                    <div class="tp-stat-lbl">Resolved</div>
                  </div>
                </div>
              </div>
              <div class="tp-card">
                <div class="tp-avatar">MG</div>
                <div class="tp-name">Musa Garba</div>
                <div class="tp-tin">TIN: 5647382-0003</div>
                <div class="tp-stat">
                  <div class="tp-stat-item">
                    <div class="tp-stat-val">1</div>
                    <div class="tp-stat-lbl">Complaints</div>
                  </div>
                  <div class="tp-stat-item">
                    <div class="tp-stat-val">1</div>
                    <div class="tp-stat-lbl">Open</div>
                  </div>
                  <div class="tp-stat-item">
                    <div class="tp-stat-val" style="color: var(--amber)">0</div>
                    <div class="tp-stat-lbl">Resolved</div>
                  </div>
                </div>
              </div>
              <div class="tp-card">
                <div class="tp-avatar">NE</div>
                <div class="tp-name">Ngozi Eze-Williams</div>
                <div class="tp-tin">TIN: 1122334-0004</div>
                <div class="tp-stat">
                  <div class="tp-stat-item">
                    <div class="tp-stat-val">3</div>
                    <div class="tp-stat-lbl">Complaints</div>
                  </div>
                  <div class="tp-stat-item">
                    <div class="tp-stat-val">0</div>
                    <div class="tp-stat-lbl">Open</div>
                  </div>
                  <div class="tp-stat-item">
                    <div class="tp-stat-val" style="color: var(--amber)">3</div>
                    <div class="tp-stat-lbl">Resolved</div>
                  </div>
                </div>
              </div>
              <div class="tp-card">
                <div class="tp-avatar">IS</div>
                <div class="tp-name">Ibrahim Suleiman</div>
                <div class="tp-tin">TIN: 9988776-0005</div>
                <div class="tp-stat">
                  <div class="tp-stat-item">
                    <div class="tp-stat-val">2</div>
                    <div class="tp-stat-lbl">Complaints</div>
                  </div>
                  <div class="tp-stat-item">
                    <div class="tp-stat-val">1</div>
                    <div class="tp-stat-lbl">Open</div>
                  </div>
                  <div class="tp-stat-item">
                    <div class="tp-stat-val" style="color: var(--amber)">1</div>
                    <div class="tp-stat-lbl">Resolved</div>
                  </div>
                </div>
              </div>
              <div class="tp-card">
                <div class="tp-avatar">AN</div>
                <div class="tp-name">Adaeze Nwosu</div>
                <div class="tp-tin">TIN: 6655443-0006</div>
                <div class="tp-stat">
                  <div class="tp-stat-item">
                    <div class="tp-stat-val">1</div>
                    <div class="tp-stat-lbl">Complaints</div>
                  </div>
                  <div class="tp-stat-item">
                    <div class="tp-stat-val">0</div>
                    <div class="tp-stat-lbl">Open</div>
                  </div>
                  <div class="tp-stat-item">
                    <div class="tp-stat-val" style="color: var(--amber)">1</div>
                    <div class="tp-stat-lbl">Resolved</div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- ══════════════ CATEGORIES TAB ══════════════ -->
        <div class="tab-page" id="tab-categories">
          <div class="panel">
            <div class="panel-header">
              <div>
                <div class="panel-title">Complaint Categories</div>
                <div class="panel-sub">8 active categories</div>
              </div>
              <button class="btn btn-primary btn-sm">
                <svg
                  viewBox="0 0 20 20"
                  fill="none"
                  stroke="currentColor"
                  stroke-width="1.8"
                >
                  <circle cx="10" cy="10" r="7.5" />
                  <path d="M10 6.5v7M6.5 10h7" />
                </svg>
                Add Category
              </button>
            </div>
            <div class="cat-grid">
              <div class="cat-card">
                <div class="cat-icon">
                  <svg
                    viewBox="0 0 20 20"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="1.5"
                  >
                    <rect x="4" y="2" width="12" height="16" rx="1.5" />
                    <path d="M7 6h6M7 9h6M7 12h4" />
                  </svg>
                </div>
                <div class="cat-name">VAT Dispute</div>
                <div class="cat-count">287</div>
                <div class="cat-bar-bg">
                  <div class="cat-bar-fill" style="width: 87%"></div>
                </div>
              </div>
              <div class="cat-card">
                <div class="cat-icon">
                  <svg
                    viewBox="0 0 20 20"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="1.5"
                  >
                    <rect x="2.5" y="5.5" width="15" height="9" rx="1.8" />
                    <circle cx="10" cy="10" r="2.2" />
                  </svg>
                </div>
                <div class="cat-name">PAYE Assessment</div>
                <div class="cat-count">241</div>
                <div class="cat-bar-bg">
                  <div class="cat-bar-fill" style="width: 74%"></div>
                </div>
              </div>
              <div class="cat-card">
                <div class="cat-icon">
                  <svg
                    viewBox="0 0 20 20"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="1.5"
                  >
                    <path d="M4 10a6 6 0 0 1 10-4.5M16 10a6 6 0 0 1-10 4.5" />
                    <path d="M13 3v3h-3M7 17v-3h3" />
                  </svg>
                </div>
                <div class="cat-name">Refund Processing</div>
                <div class="cat-count">198</div>
                <div class="cat-bar-bg">
                  <div class="cat-bar-fill" style="width: 61%"></div>
                </div>
              </div>
              <div class="cat-card">
                <div class="cat-icon">
                  <svg
                    viewBox="0 0 20 20"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="1.5"
                  >
                    <rect x="4" y="3" width="12" height="14" rx="1" />
                    <path
                      d="M7 6h1.5M11.5 6H13M7 9h1.5M11.5 9H13M7 12h1.5M11.5 12H13"
                    />
                  </svg>
                </div>
                <div class="cat-name">CIT Filing Error</div>
                <div class="cat-count">176</div>
                <div class="cat-bar-bg">
                  <div class="cat-bar-fill" style="width: 54%"></div>
                </div>
              </div>
              <div class="cat-card">
                <div class="cat-icon">
                  <svg
                    viewBox="0 0 20 20"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="1.5"
                  >
                    <rect x="2" y="4" width="16" height="12" rx="2" />
                    <circle cx="7" cy="10" r="1.8" />
                    <path
                      d="M11 8.5h5M11 11.5h5M4.5 14.5c.5-1.6 1.7-2.3 2.5-2.3s2 .7 2.5 2.3"
                    />
                  </svg>
                </div>
                <div class="cat-name">TIN Registration</div>
                <div class="cat-count">143</div>
                <div class="cat-bar-bg">
                  <div class="cat-bar-fill" style="width: 44%"></div>
                </div>
              </div>
              <div class="cat-card">
                <div class="cat-icon">
                  <svg
                    viewBox="0 0 20 20"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="1.5"
                  >
                    <path
                      d="M10 2v16M4 6h12M6 6l-3 6a3 3 0 0 0 6 0zM14 6l-3 6a3 3 0 0 0 6 0z"
                    />
                  </svg>
                </div>
                <div class="cat-name">Penalty Appeal</div>
                <div class="cat-count">112</div>
                <div class="cat-bar-bg">
                  <div class="cat-bar-fill" style="width: 34%"></div>
                </div>
              </div>
              <div class="cat-card">
                <div class="cat-icon">
                  <svg
                    viewBox="0 0 20 20"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="1.5"
                  >
                    <rect x="4.5" y="9" width="11" height="8" rx="1.5" />
                    <path d="M6.5 9V6.5a3.5 3.5 0 0 1 7 0V9" />
                  </svg>
                </div>
                <div class="cat-name">WHT Deduction</div>
                <div class="cat-count">87</div>
                <div class="cat-bar-bg">
                  <div class="cat-bar-fill" style="width: 27%"></div>
                </div>
              </div>
              <div class="cat-card">
                <div class="cat-icon">
                  <svg
                    viewBox="0 0 20 20"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="1.5"
                  >
                    <path d="M5 3h10v14l-5-3-5 3V3z" />
                  </svg>
                </div>
                <div class="cat-name">Stamp Duty</div>
                <div class="cat-count">40</div>
                <div class="cat-bar-bg">
                  <div class="cat-bar-fill" style="width: 12%"></div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- ══════════════ REPORTS TAB ══════════════ -->
        <div class="tab-page" id="tab-reports">
          <div class="kpi-grid" style="grid-template-columns: repeat(3, 1fr)">
            <div class="kpi-card c-green">
              <div class="kpi-icon">
                <svg
                  viewBox="0 0 20 20"
                  fill="none"
                  stroke="currentColor"
                  stroke-width="1.5"
                >
                  <path d="M3 13l4.5-5 3 3L17 5" />
                  <path d="M13 5h4v4" />
                </svg>
              </div>
              <div class="kpi-value">12</div>
              <div class="kpi-label">Reports Generated</div>
              <div class="kpi-delta delta-up">▲ This month</div>
            </div>
            <div class="kpi-card c-amber">
              <div class="kpi-icon">
                <svg
                  viewBox="0 0 20 20"
                  fill="none"
                  stroke="currentColor"
                  stroke-width="1.5"
                >
                  <path d="M10 3v10M6.5 9.5 10 13l3.5-3.5M4 16h12" />
                </svg>
              </div>
              <div class="kpi-value">48</div>
              <div class="kpi-label">Total Downloads</div>
              <div class="kpi-delta delta-up">▲ All time</div>
            </div>
            <div class="kpi-card c-blue">
              <div class="kpi-icon">
                <svg
                  viewBox="0 0 20 20"
                  fill="none"
                  stroke="currentColor"
                  stroke-width="1.5"
                >
                  <rect x="3" y="4.5" width="14" height="12" rx="1.5" />
                  <path d="M3 8h14M7 3v3M13 3v3" />
                </svg>
              </div>
              <div class="kpi-value">4</div>
              <div class="kpi-label">Scheduled Reports</div>
              <div class="kpi-delta" style="color: var(--blue)">
                ● Auto-generated
              </div>
            </div>
          </div>
          <div class="panel">
            <div class="panel-header">
              <div>
                <div class="panel-title">All Reports</div>
                <div class="panel-sub">
                  Downloadable complaint analytics and summaries
                </div>
              </div>
              <button class="btn btn-primary btn-sm">
                <svg
                  viewBox="0 0 20 20"
                  fill="none"
                  stroke="currentColor"
                  stroke-width="1.8"
                >
                  <circle cx="10" cy="10" r="7.5" />
                  <path d="M10 6.5v7M6.5 10h7" />
                </svg>
                Generate Report
              </button>
            </div>
            <div class="report-list">
              <div class="report-item">
                <div class="report-left">
                  <div class="report-icon">
                    <svg
                      viewBox="0 0 20 20"
                      fill="none"
                      stroke="currentColor"
                      stroke-width="1.5"
                    >
                      <path d="M4 16V9M10 16V4M16 16v-6" />
                    </svg>
                  </div>
                  <div>
                    <div class="report-name">June 2026 Monthly Summary</div>
                    <div class="report-meta">
                      Generated 28 Jun 2026 · 1,284 complaints · PDF
                    </div>
                  </div>
                </div>
                <button class="btn btn-ghost btn-sm">
                  <svg
                    viewBox="0 0 20 20"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="1.8"
                  >
                    <path d="M10 3v10M6.5 9.5 10 13l3.5-3.5M4 16h12" />
                  </svg>
                  Download
                </button>
              </div>
              <div class="report-item">
                <div class="report-left">
                  <div class="report-icon">
                    <svg
                      viewBox="0 0 20 20"
                      fill="none"
                      stroke="currentColor"
                      stroke-width="1.5"
                    >
                      <path d="M3 13l4.5-5 3 3L17 5" />
                      <path d="M13 5h4v4" />
                    </svg>
                  </div>
                  <div>
                    <div class="report-name">Q2 2026 Quarterly Report</div>
                    <div class="report-meta">
                      Generated 01 Jul 2026 · 3,841 complaints · XLSX
                    </div>
                  </div>
                </div>
                <button class="btn btn-ghost btn-sm">
                  <svg
                    viewBox="0 0 20 20"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="1.8"
                  >
                    <path d="M10 3v10M6.5 9.5 10 13l3.5-3.5M4 16h12" />
                  </svg>
                  Download
                </button>
              </div>
              <div class="report-item">
                <div class="report-left">
                  <div class="report-icon">
                    <svg
                      viewBox="0 0 20 20"
                      fill="none"
                      stroke="currentColor"
                      stroke-width="1.5"
                    >
                      <path d="M10 3.5 18 16.5H2Z" stroke-linejoin="round" />
                      <path d="M10 8v4M10 14h.01" />
                    </svg>
                  </div>
                  <div>
                    <div class="report-name">
                      Escalated Complaints – June 2026
                    </div>
                    <div class="report-meta">
                      Generated 25 Jun 2026 · 63 escalated cases · PDF
                    </div>
                  </div>
                </div>
                <button class="btn btn-ghost btn-sm">
                  <svg
                    viewBox="0 0 20 20"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="1.8"
                  >
                    <path d="M10 3v10M6.5 9.5 10 13l3.5-3.5M4 16h12" />
                  </svg>
                  Download
                </button>
              </div>
              <div class="report-item">
                <div class="report-left">
                  <div class="report-icon">
                    <svg
                      viewBox="0 0 20 20"
                      fill="none"
                      stroke="currentColor"
                      stroke-width="1.5"
                    >
                      <rect x="4" y="2" width="12" height="16" rx="1.5" />
                      <path d="M7 6h6M7 9h6M7 12h4" />
                    </svg>
                  </div>
                  <div>
                    <div class="report-name">VAT Dispute Analysis</div>
                    <div class="report-meta">
                      Generated 20 Jun 2026 · 287 cases · PDF
                    </div>
                  </div>
                </div>
                <button class="btn btn-ghost btn-sm">
                  <svg
                    viewBox="0 0 20 20"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="1.8"
                  >
                    <path d="M10 3v10M6.5 9.5 10 13l3.5-3.5M4 16h12" />
                  </svg>
                  Download
                </button>
              </div>
              <div class="report-item">
                <div class="report-left">
                  <div class="report-icon">
                    <svg
                      viewBox="0 0 20 20"
                      fill="none"
                      stroke="currentColor"
                      stroke-width="1.5"
                    >
                      <circle cx="7" cy="7" r="2.5" />
                      <path d="M2.5 16c0-2.5 2-4.5 4.5-4.5s4.5 2 4.5 4.5" />
                      <circle cx="14.5" cy="7.5" r="2" />
                      <path d="M12.8 11.6c2 .3 3.7 2 3.7 4.4" />
                    </svg>
                  </div>
                  <div>
                    <div class="report-name">Officer Performance Report</div>
                    <div class="report-meta">
                      Generated 15 Jun 2026 · 6 officers · PDF
                    </div>
                  </div>
                </div>
                <button class="btn btn-ghost btn-sm">
                  <svg
                    viewBox="0 0 20 20"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="1.8"
                  >
                    <path d="M10 3v10M6.5 9.5 10 13l3.5-3.5M4 16h12" />
                  </svg>
                  Download
                </button>
              </div>
              <div class="report-item">
                <div class="report-left">
                  <div class="report-icon">
                    <svg
                      viewBox="0 0 20 20"
                      fill="none"
                      stroke="currentColor"
                      stroke-width="1.5"
                    >
                      <circle cx="10" cy="10" r="7.5" />
                      <path d="m6.5 10 2.5 2.5 4.5-4.5" />
                    </svg>
                  </div>
                  <div>
                    <div class="report-name">
                      Resolution Rate Trend – H1 2026
                    </div>
                    <div class="report-meta">
                      Generated 01 Jun 2026 · 6-month trend · XLSX
                    </div>
                  </div>
                </div>
                <button class="btn btn-ghost btn-sm">
                  <svg
                    viewBox="0 0 20 20"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="1.8"
                  >
                    <path d="M10 3v10M6.5 9.5 10 13l3.5-3.5M4 16h12" />
                  </svg>
                  Download
                </button>
              </div>
            </div>
          </div>
        </div>

        <!-- ══════════════ SETTINGS TAB ══════════════ -->
        <div class="tab-page" id="tab-settings">
          <div class="panel">
            <div class="settings-grid">
              <div class="settings-nav">
                <div
                  class="settings-nav-item active"
                  onclick="setSettingsNav(this, 's-profile')"
                >
                  <svg
                    viewBox="0 0 20 20"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="1.6"
                  >
                    <circle cx="10" cy="7" r="3.5" />
                    <path d="M3 17c0-3.3 3.1-6 7-6s7 2.7 7 6" />
                  </svg>
                  Profile
                </div>
                <div
                  class="settings-nav-item"
                  onclick="setSettingsNav(this, 's-security')"
                >
                  <svg
                    viewBox="0 0 20 20"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="1.6"
                  >
                    <rect x="4.5" y="9" width="11" height="8" rx="1.5" />
                    <path d="M6.5 9V6.5a3.5 3.5 0 0 1 7 0V9" />
                  </svg>
                  Security
                </div>
                <div
                  class="settings-nav-item"
                  onclick="setSettingsNav(this, 's-system')"
                >
                  <svg
                    viewBox="0 0 20 20"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="1.6"
                  >
                    <circle cx="10" cy="10" r="2.6" />
                    <path
                      d="M10 2.5v2M10 15.5v2M17.5 10h-2M4.5 10h-2M15.1 4.9l-1.4 1.4M6.3 13.7l-1.4 1.4M15.1 15.1l-1.4-1.4M6.3 6.3 4.9 4.9"
                    />
                  </svg>
                  System
                </div>
              </div>
              <div class="settings-body">
                <!-- Profile -->
                <div id="s-profile">
                  <div class="settings-section">
                    <h3>Profile Information</h3>
                    <div class="form-row">
                      <div class="form-group">
                        <label>First Name</label
                        ><input type="text" value="Amaka" />
                      </div>
                      <div class="form-group">
                        <label>Last Name</label
                        ><input type="text" value="Adeyemi" />
                      </div>
                    </div>
                    <div class="form-row">
                      <div class="form-group">
                        <label>Email Address</label
                        ><input type="email" value="a.adeyemi@lirs.gov.ng" />
                      </div>
                      <div class="form-group">
                        <label>Phone Number</label
                        ><input type="text" value="+234 801 234 5678" />
                      </div>
                    </div>
                    <div class="form-row">
                      <div class="form-group">
                        <label>Role</label
                        ><select>
                          <option>Super Admin</option>
                          <option>Admin</option>
                          <option>Officer</option>
                        </select>
                      </div>
                      <div class="form-group">
                        <label>Department</label
                        ><input type="text" value="Taxpayer Services" />
                      </div>
                    </div>
                    <div class="form-row">
                      <div class="form-group full">
                        <label>Office Address</label
                        ><textarea>
Lagos Internal Revenue Service, Block 4, Adeyemi Bero Close, Alausa, Ikeja, Lagos.</textarea
                        >
                      </div>
                    </div>
                    <button class="btn btn-primary">Save Changes</button>
                  </div>
                </div>

                <!-- Security -->
                <div id="s-security" style="display: none">
                  <div class="settings-section">
                    <h3>Change Password</h3>
                    <div class="form-row">
                      <div class="form-group full">
                        <label>Current Password</label
                        ><input type="text" placeholder="••••••••" />
                      </div>
                    </div>
                    <div class="form-row">
                      <div class="form-group">
                        <label>New Password</label
                        ><input type="text" placeholder="••••••••" />
                      </div>
                      <div class="form-group">
                        <label>Confirm New Password</label
                        ><input type="text" placeholder="••••••••" />
                      </div>
                    </div>
                    <button class="btn btn-primary">Update Password</button>
                  </div>
                </div>

                <!-- System -->
                <div id="s-system" style="display: none">
                  <div class="settings-section">
                    <h3>System Configuration</h3>
                    <div class="form-row">
                      <div class="form-group">
                        <label>SLA Response Time (hours)</label
                        ><input type="text" value="72" />
                      </div>
                      <div class="form-group">
                        <label>Default Priority</label
                        ><select>
                          <option>Medium</option>
                          <option>Low</option>
                          <option>High</option>
                        </select>
                      </div>
                    </div>
                    <div class="form-row">
                      <div class="form-group full">
                        <label>System Footer Text</label
                        ><input
                          type="text"
                          value="Lagos Internal Revenue Service — LIRS Connect Admin Console"
                        />
                      </div>
                    </div>
                    <div class="toggle-row">
                      <div class="toggle-info">
                        <strong>Maintenance Mode</strong
                        ><span
                          >Temporarily disable public complaint submission</span
                        >
                      </div>
                      <div
                        class="toggle"
                        onclick="this.classList.toggle('on')"
                      ></div>
                    </div>
                    <div class="toggle-row" style="margin-top: 10px">
                      <div class="toggle-info">
                        <strong>Auto-assign Complaints</strong
                        ><span
                          >Round-robin assignment to available officers</span
                        >
                      </div>
                      <div
                        class="toggle on"
                        onclick="this.classList.toggle('on')"
                      ></div>
                    </div>
                    <div style="margin-top: 20px">
                      <button class="btn btn-primary">
                        Save System Settings
                      </button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- /main -->

    <script>
      // Guard: confirm there's a real admin session on the server before
      // showing this page. Anyone not logged in as admin gets bounced.
      (function checkSession() {
        fetch("api/session.php", { credentials: "same-origin" })
          .then((res) => res.json())
          .then((result) => {
            const isAdminRole =
              result.data &&
              result.data.loggedIn &&
              (result.data.role === "super_admin" ||
                result.data.role === "officer");
            if (!isAdminRole) {
              window.location.href = "login.php";
              return;
            }
            sessionStorage.setItem("adminName", result.data.name);
            sessionStorage.setItem("adminEmail", result.data.email);
            document.getElementById("admin-name").textContent =
              result.data.name;
            document.getElementById("admin-avatar").textContent = initials(
              result.data.name,
            );
            document.querySelector(".admin-role").textContent =
              result.data.role === "super_admin" ? "Super Admin" : "Officer";
          })
          .catch(() => {
            console.warn("Could not verify session with the backend.");
          });
      })();

      var adminName = sessionStorage.getItem("adminName") || "Amaka Adeyemi";
      function initials(n) {
        return n
          .split(" ")
          .map(function (w) {
            return w[0];
          })
          .join("")
          .toUpperCase()
          .slice(0, 2);
      }
      document.getElementById("admin-name").textContent = adminName;
      document.getElementById("admin-avatar").textContent = initials(adminName);

      document
        .getElementById("logout-btn")
        .addEventListener("click", function (e) {
          e.preventDefault();
          fetch("api/logout.php", {
            method: "POST",
            credentials: "same-origin",
          });
          sessionStorage.clear();
          window.location.href = "index.php";
        });

      const titles = {
        dashboard: "Dashboard",
        complaints: "All Complaints",
        notifications: "Notifications",
        taxpayers: "Taxpayers",
        categories: "Categories",
        reports: "Reports",
        settings: "Settings",
        auditlog: "Audit Log",
      };

      function showTab(name, navEl) {
        document
          .querySelectorAll(".tab-page")
          .forEach((p) => p.classList.remove("active"));
        document.getElementById("tab-" + name).classList.add("active");
        document
          .querySelectorAll(".nav-item")
          .forEach((n) => n.classList.remove("active"));
        if (navEl) navEl.classList.add("active");
        else {
          document.querySelectorAll(".nav-item").forEach((n) => {
            if (
              n.textContent
                .trim()
                .toLowerCase()
                .startsWith(
                  name
                    .replace(/([A-Z])/g, " $1")
                    .trim()
                    .toLowerCase(),
                )
            )
              n.classList.add("active");
          });
        }
        document.getElementById("page-title").textContent =
          titles[name] || name;
      }

      function setChip(el) {
        el.closest(".filter-row")
          .querySelectorAll(".filter-chip")
          .forEach((c) => c.classList.remove("active"));
        el.classList.add("active");
      }

      function setSettingsNav(el, sectionId) {
        el.closest(".settings-nav")
          .querySelectorAll(".settings-nav-item")
          .forEach((i) => i.classList.remove("active"));
        el.classList.add("active");
        ["s-profile", "s-security", "s-system"].forEach((id) => {
          document.getElementById(id).style.display =
            id === sectionId ? "block" : "none";
        });
      }
    </script>
  </body>
</html>



