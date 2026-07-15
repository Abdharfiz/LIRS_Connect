<?php
 
// The current page can be determined from the filename or passed as a parameter

// Get current page for active state
$current_page = basename($_SERVER['PHP_SELF'], '.php');
?>
<aside class="sidebar">
  <div class="sidebar-brand">
    <div class="brand-icon">TT</div>
    <div class="brand-text">
      <div class="b-name">LIRS Connect</div>
      <div class="b-sub">TaxTrack</div>
    </div>
  </div>
  <div class="sidebar-section-label">Menu</div>
  <a href="taxpayer-dashboard.php" class="nav-item <?php echo $current_page === 'taxpayer-dashboard' ? 'active' : ''; ?>">
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
  <a href="submit-complaint.php" class="nav-item <?php echo $current_page === 'submit-complaint' ? 'active' : ''; ?>">
    <svg
      class="nav-icon"
      viewBox="0 0 20 20"
      fill="none"
      stroke="currentColor"
      stroke-width="1.6"
    >
      <rect x="3" y="3" width="14" height="14" rx="2" />
      <path d="M10 7v6M7 10h6" />
    </svg>
    Submit Complaint
  </a>
  <a href="my-complaints.php" class="nav-item <?php echo $current_page === 'my-complaints' ? 'active' : ''; ?>">
    <svg
      class="nav-icon"
      viewBox="0 0 20 20"
      fill="none"
      stroke="currentColor"
      stroke-width="1.6"
    >
      <path d="M4 4h12M4 8h8M4 12h10M4 16h6" />
    </svg>
    My Complaints
  </a>
  <a href="notifications.php" class="nav-item <?php echo $current_page === 'notifications' ? 'active' : ''; ?>">
    <svg
      class="nav-icon"
      viewBox="0 0 20 20"
      fill="none"
      stroke="currentColor"
      stroke-width="1.6"
    >
      <path d="M10 2a6 6 0 0 0-6 6c0 5-2 6-2 6h16s-2-1-2-6a6 6 0 0 0-6-6z" />
      <path d="M11.7 17a2 2 0 0 1-3.4 0" />
    </svg>
    Notifications
    <span class="nav-badge" id="notif-badge" style="display: none">0</span>
  </a>
  <a href="profile.php" class="nav-item <?php echo $current_page === 'profile' ? 'active' : ''; ?>">
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
      <div class="taxpayer-av" id="sidebar-av">AY</div>
      <div class="taxpayer-info">
        <div class="t-name" id="sidebar-name">User</div>
        <div class="t-tin" id="sidebar-tin">TIN: --</div>
      </div>
    </div>
    <a href="login.php" class="logout-btn" id="logout-btn">
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
      Loggg Out
    </a>
  </div>
</aside>
