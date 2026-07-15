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
    <link rel="stylesheet" href="../app.css" />
  </head>
  <body>
    <!-- SIDEBAR -->    <?php include '../includes/admin-sidebar.php'; ?>

    <!-- MAIN -->
    <div class="main">
      <!-- TOPBAR -->
      <header class="topbar">
        <div class="topbar-left">
          <h1 id="page-title">DDDDDDashboard</h1>
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
              <div class="kpi-value" id="kpi-total">0</div>
              <div class="kpi-label">Total Complaints</div>
              <div class="kpi-delta" id="kpi-total-sub">&nbsp;</div>
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
              <div class="kpi-value" id="kpi-open">0</div>
              <div class="kpi-label">New / In Progress</div>
              <div class="kpi-delta" id="kpi-open-sub">&nbsp;</div>
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
              <div class="kpi-value" id="kpi-resolved">0</div>
              <div class="kpi-label">Resolved</div>
              <div class="kpi-delta delta-up" id="kpi-resolved-sub">&nbsp;</div>
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
              <div class="kpi-value" id="kpi-highpriority">0</div>
              <div class="kpi-label">High Priority</div>
              <div class="kpi-delta" id="kpi-highpriority-sub">&nbsp;</div>
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
                <tbody id="recent-complaints-tbody"></tbody>
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
                      id="donut-resolved"
                      cx="18"
                      cy="18"
                      r="15.9"
                      fill="none"
                      stroke="#059669"
                      stroke-width="4"
                      stroke-dasharray="0 100"
                      stroke-dashoffset="25"
                      stroke-linecap="round"
                    />
                    <circle
                      id="donut-inprogress"
                      cx="18"
                      cy="18"
                      r="15.9"
                      fill="none"
                      stroke="#D97706"
                      stroke-width="4"
                      stroke-dasharray="0 100"
                      stroke-dashoffset="25"
                      stroke-linecap="round"
                    />
                    <circle
                      id="donut-new"
                      cx="18"
                      cy="18"
                      r="15.9"
                      fill="none"
                      stroke="#1D4ED8"
                      stroke-width="4"
                      stroke-dasharray="0 100"
                      stroke-dashoffset="25"
                      stroke-linecap="round"
                    />
                    <circle
                      id="donut-closedrejected"
                      cx="18"
                      cy="18"
                      r="15.9"
                      fill="none"
                      stroke="#DC2626"
                      stroke-width="4"
                      stroke-dasharray="0 100"
                      stroke-dashoffset="25"
                      stroke-linecap="round"
                    />
                    <text
                      x="18"
                      y="16.5"
                      text-anchor="middle"
                      font-size="5"
                      fill="#0F2419"
                      font-weight="700"
                      id="donut-total-text"
                    >
                      0
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
                    ><span class="legend-val" id="legend-resolved">0</span>
                  </div>
                  <div class="legend-row">
                    <span class="legend-left"
                      ><span
                        class="legend-dot"
                        style="background: var(--amber)"
                      ></span
                      >In Progress</span
                    ><span class="legend-val" id="legend-inprogress">0</span>
                  </div>
                  <div class="legend-row">
                    <span class="legend-left"
                      ><span
                        class="legend-dot"
                        style="background: var(--blue)"
                      ></span
                      >New</span
                    ><span class="legend-val" id="legend-new">0</span>
                  </div>
                  <div class="legend-row">
                    <span class="legend-left"
                      ><span
                        class="legend-dot"
                        style="background: var(--red)"
                      ></span
                      >Closed / Rejected</span
                    ><span class="legend-val" id="legend-closedrejected">0</span>
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
                <div id="recent-activity-list"></div>
                <div id="recent-activity-empty" style="display: none; padding: 24px 22px; text-align: center; color: var(--text-muted); font-size: 13px">
                  No recent activity yet.
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- ══════════════ ALL COMPLAINTS TAB ══════════════ -->
        <div class="tab-page" id="tab-complaints">
          <div class="panel">
            <div style="padding: 60px 40px; text-align: center; color: var(--text-muted)">
              <div style="display: flex; justify-content: center; margin-bottom: 14px">
                <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.4" width="36" height="36">
                  <path d="M4 4h12M4 8h8M4 12h10M4 16h6" />
                </svg>
              </div>
              <div style="font-size: 15px; font-weight: 700; margin-bottom: 6px; color: var(--text)">
                Full complaint management moved
              </div>
              <div style="font-size: 13px; margin-bottom: 18px">
                Search, filter, claim, and respond to complaints on the dedicated All Complaints page.
              </div>
              <a href="admincomplaint.php" class="btn btn-primary" style="display: inline-flex">
                Go to All Complaints →
              </a>
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

    <script src="../admin-common.js"></script>
    <script>
      adminInit();
      loadDashboardStats();

      function initials(n) {
        return adminInitials(n);
      }

      function formatTime12h(dateStr) {
        return dateStr || "--";
      }

      function statusBadgeClass(rawStatus) {
        if (rawStatus === "resolved") return "resolved";
        if (rawStatus === "rejected") return "danger";
        if (rawStatus === "closed") return "info";
        if (rawStatus === "in_progress") return "review";
        return "pending"; // new
      }

      // Sets the dasharray/dashoffset for one donut ring segment.
      // circumference for r=15.9 is ~99.9, treated as 100 for simplicity
      // (matches the original markup's percentage-as-length convention).
      function setDonutSegment(id, percent, offsetSoFar) {
        var el = document.getElementById(id);
        el.setAttribute("stroke-dasharray", percent + " " + (100 - percent));
        el.setAttribute("stroke-dashoffset", (25 - offsetSoFar).toString());
      }

      function loadDashboardStats() {
        fetch("../api/admin/get-dashboardstats.php", { credentials: "same-origin" })
          .then(function (res) {
            return res.json().then(function (data) {
              return { status: res.status, data: data };
            });
          })
          .then(function (result) {
            if (result.status === 401) {
              window.location.href = "../login.php";
              return;
            }
            if (!result.data.success) {
              console.warn(result.data.message);
              return;
            }
            var d = result.data.data;
            renderKpis(d.kpis);
            renderDonut(d.kpis);
            renderRecentComplaints(d.recent_complaints);
            renderRecentActivity(d.recent_activity);
          })
          .catch(function (err) {
            console.warn("Could not load dashboard stats:", err);
          });
      }

      function renderKpis(k) {
        document.getElementById("kpi-total").textContent = k.total.toLocaleString();
        document.getElementById("kpi-open").textContent = (k.new + k.in_progress).toLocaleString();
        document.getElementById("kpi-resolved").textContent = k.resolved.toLocaleString();
        document.getElementById("kpi-highpriority").textContent = k.high_priority.toLocaleString();

        document.getElementById("kpi-total-sub").textContent = k.new + " new this list";
        document.getElementById("kpi-open-sub").textContent = k.new + " new · " + k.in_progress + " in progress";
        document.getElementById("kpi-resolved-sub").textContent = k.resolution_rate + "% resolution rate";
        document.getElementById("kpi-highpriority-sub").textContent = "Needs attention first";
      }

      function renderDonut(k) {
        var total = k.total || 1; // avoid divide-by-zero
        var resolvedPct = Math.round((k.resolved / total) * 100);
        var inProgressPct = Math.round((k.in_progress / total) * 100);
        var newPct = Math.round((k.new / total) * 100);
        var closedRejectedPct = Math.max(0, 100 - resolvedPct - inProgressPct - newPct);

        var running = 0;
        setDonutSegment("donut-resolved", resolvedPct, running);
        running += resolvedPct;
        setDonutSegment("donut-inprogress", inProgressPct, running);
        running += inProgressPct;
        setDonutSegment("donut-new", newPct, running);
        running += newPct;
        setDonutSegment("donut-closedrejected", closedRejectedPct, running);

        document.getElementById("donut-total-text").textContent = k.total.toLocaleString();
        document.getElementById("legend-resolved").textContent = k.resolved;
        document.getElementById("legend-inprogress").textContent = k.in_progress;
        document.getElementById("legend-new").textContent = k.new;
        document.getElementById("legend-closedrejected").textContent = k.closed + k.rejected;
      }

      function renderRecentComplaints(list) {
        var tbody = document.getElementById("recent-complaints-tbody");
        tbody.innerHTML = "";

        if (!list.length) {
          tbody.innerHTML = '<tr><td colspan="6" style="text-align:center;color:var(--text-muted);padding:24px">No complaints yet.</td></tr>';
          return;
        }

        list.forEach(function (c) {
          var row = document.createElement("tr");
          row.style.cursor = "pointer";
          row.innerHTML =
            '<td><span class="cid"></span></td>' +
            "<td></td><td></td><td></td>" +
            '<td><span class="badge"></span></td>' +
            "<td></td>";
          row.children[0].querySelector(".cid").textContent = c.reference_id;
          row.children[1].textContent = c.taxpayer_name;
          row.children[2].textContent = c.category;
          row.children[3].textContent = c.priority;
          var badge = row.children[4].querySelector(".badge");
          badge.textContent = c.status;
          badge.classList.add(statusBadgeClass(c.status_raw));
          row.children[5].textContent = c.created_at_label;
          row.addEventListener("click", function () {
            window.location.href = "admincomplaints-details.php?id=" + c.id;
          });
          tbody.appendChild(row);
        });
      }

      function renderRecentActivity(list) {
        var container = document.getElementById("recent-activity-list");
        container.innerHTML = "";

        if (!list.length) {
          document.getElementById("recent-activity-empty").style.display = "";
          return;
        }
        document.getElementById("recent-activity-empty").style.display = "none";

        var colorVar = {
          green: "var(--green)",
          red: "var(--red)",
          blue: "var(--blue)",
          amber: "var(--amber)",
        };

        list.forEach(function (a) {
          var div = document.createElement("div");
          div.className = "activity-item";
          div.innerHTML =
            '<span class="a-dot" style="background: ' + (colorVar[a.color] || "var(--blue)") + '"></span>' +
            '<div><div class="activity-text"></div><div class="activity-time"></div></div>';
          div.querySelector(".activity-text").textContent = a.text;
          div.querySelector(".activity-time").textContent = a.time;
          container.appendChild(div);
        });
      }

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