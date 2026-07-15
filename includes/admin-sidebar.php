<?php
// Get current page for active-state highlighting, same pattern as
// includes/sidebar.php (the taxpayer sidebar).
$current_page = basename($_SERVER['PHP_SELF'], '.php');
?>
<aside class="sidebar">
  <div class="sidebar-brand">
    <div class="brand-icon">TT</div>
    <div class="brand-text">
      <div class="b-name">LIRS Connect</div>
      <div class="b-sub">Admin Console</div>
    </div>
  </div>
  <div class="sidebar-section-label">Menu</div>
  <a href="admin-dashboard.php" class="nav-item <?php echo $current_page === 'admin-dashboard' ? 'active' : ''; ?>">
    <svg
      class="nav-icon"
      viewBox="0 0 20 20"
      fill="none"
      stroke="currentColor"
      stroke-width="1.6"
    >
      <rect x="2" y="2" width="7" height="7" rx="1.5" />
      <rect x="11" y="2" width="7" height="7" rx="1.5" />
      <rect x="2" y="11" width="7" height="7" rx="1.5" />
      <rect x="11" y="11" width="7" height="7" rx="1.5" />
    </svg>
    Dashboard
  </a>
  <a href="admin-compliant.php" class="nav-item <?php echo in_array($current_page, ['admincomplaint', 'admincomplaints-details']) ? 'active' : ''; ?>">
    <svg
      class="nav-icon"
      viewBox="0 0 20 20"
      fill="none"
      stroke="currentColor"
      stroke-width="1.6"
    >
      <path d="M4 4h12M4 8h8M4 12h10M4 16h6" />
    </svg>
    All Complaints
    <span class="nav-badge" id="new-complaints-badge" style="display: none">0</span>
  </a>
  <a href="admin-profile.php" class="nav-item <?php echo $current_page === 'admin-profile' ? 'active' : ''; ?>">
    <svg
      class="nav-icon"
      viewBox="0 0 20 20"
      fill="none"
      stroke="currentColor"
      stroke-width="1.6"
    >
      <circle cx="10" cy="7" r="3.5" />
      <path d="M3 17c0-3.3 3.1-6 7-6s7 2.7 7 6" />
    </svg>
    Profile
  </a>
  <div class="sidebar-footer">
    <div class="taxpayer-mini">
      <div class="taxpayer-av" id="admin-av">A</div>
      <div class="taxpayer-info">
        <div class="t-name" id="admin-name">Admin</div>
        <div class="t-tin" id="admin-role">--</div>
      </div>
    </div>
    <a href="../api/login.php" class="logout-btn" id="logout-btn">
      <svg
        width="14"
        height="14"
        viewBox="0 0 20 20"
        fill="none"
        stroke="currentColor"
        stroke-width="1.8"
      >
        <path d="M13 15l5-5-5-5M18 10H7" />
        <path d="M7 3H4a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h3" />
      </svg>
      Log Out
    </a>
  </div>
</aside>