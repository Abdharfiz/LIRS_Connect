<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>LIRS Connect | Admin Profile</title>
    <link
      href="https://fonts.googleapis.com/css2?family=DM+Serif+Display:ital@0;1&family=DM+Sans:wght@400;500;600;700&display=swap"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="../app.css" />
  </head>
  <body>
    <?php include '../includes/admin-sidebar.php'; ?>

    <div class="main">
      <header class="topbar">
        <div>
          <div class="topbar-title">My Profile</div>
          <div class="topbar-sub">LIRS Connect · Admin Console</div>
        </div>
      </header>

      <div class="content">
        <div class="page-banner">
          <div class="page-banner-text">
            <div class="pb-eyebrow">LIRS Connect · Account</div>
            <h2>My Profile</h2>
            <p>View and update your admin account information.</p>
          </div>
          <div class="page-banner-icon">
            <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.4">
              <circle cx="10" cy="7" r="3.5" />
              <path d="M3 17c0-3.3 3.1-6 7-6s7 2.7 7 6" />
            </svg>
          </div>
        </div>

        <div class="profile-layout">
          <!-- Left: Profile Card -->
          <div style="display: flex; flex-direction: column; gap: 16px">
            <div class="profile-card">
              <div class="profile-top">
                <div class="profile-av" id="view-av">A</div>
                <div class="profile-name" id="view-name">Admin</div>
                <div class="profile-tin" id="view-role">--</div>
              </div>
              <div class="profile-fields">
                <div class="profile-row">
                  <span class="p-label">Email Address</span>
                  <span class="p-value" id="view-email">--</span>
                </div>
                <div class="profile-divider"></div>
                <div class="profile-row">
                  <span class="p-label">Admin Since</span>
                  <span class="p-value" id="view-since">--</span>
                </div>
              </div>
              <button class="btn-update" onclick="openEdit()">
                <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.6" width="14" height="14">
                  <path d="M13.5 3.5l3 3L6 17H3v-3L13.5 3.5z" />
                </svg>
                Edit Profile
              </button>
            </div>

            <div class="panel">
              <div class="panel-head">
                <div class="panel-title">My Workload</div>
              </div>
              <div class="panel-body" style="display: flex; justify-content: space-around; text-align: center">
                <div>
                  <div style="font-size: 22px; font-weight: 700" id="stat-active">0</div>
                  <div style="font-size: 11.5px; color: var(--text-muted)">Active</div>
                </div>
                <div>
                  <div style="font-size: 22px; font-weight: 700" id="stat-closed">0</div>
                  <div style="font-size: 11.5px; color: var(--text-muted)">Closed</div>
                </div>
                <div>
                  <div style="font-size: 22px; font-weight: 700" id="stat-total">0</div>
                  <div style="font-size: 11.5px; color: var(--text-muted)">Total Assigned</div>
                </div>
              </div>
            </div>
          </div>

          <!-- Right: Edit form + Security -->
          <div style="display: flex; flex-direction: column; gap: 16px">
            <div class="panel" id="edit-panel" style="display: none">
              <div class="panel-head">
                <div class="panel-title">Edit Profile Information</div>
                <button class="btn-ghost" style="font-size: 12px; padding: 6px 12px" onclick="closeEdit()">Cancel</button>
              </div>
              <div class="panel-body">
                <div class="form-grid">
                  <div class="form-group full">
                    <label class="form-label">Full Name *</label>
                    <input class="form-input" id="edit-name" type="text" />
                  </div>
                  <div class="form-group full">
                    <label class="form-label">Email Address *</label>
                    <input class="form-input" id="edit-email" type="email" />
                  </div>
                </div>
                <div class="form-actions" style="margin-top: 20px">
                  <button class="btn-ghost" onclick="closeEdit()">Cancel</button>
                  <button class="btn-primary" onclick="saveProfile()">
                    <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.6" width="14" height="14">
                      <rect x="3" y="3" width="14" height="14" rx="1.5" />
                      <path d="M6 3v4h6V3M6 13h8" />
                    </svg>
                    Save Changes
                  </button>
                </div>
              </div>
            </div>

            <div class="panel">
              <div class="panel-head">
                <div class="panel-title">Change Password</div>
              </div>
              <div class="panel-body">
                <div class="form-grid">
                  <div class="form-group full">
                    <label class="form-label">Current Password</label>
                    <input class="form-input" id="pw-current" type="password" />
                  </div>
                  <div class="form-group">
                    <label class="form-label">New Password</label>
                    <input class="form-input" id="pw-new" type="password" />
                  </div>
                  <div class="form-group">
                    <label class="form-label">Confirm New Password</label>
                    <input class="form-input" id="pw-confirm" type="password" />
                  </div>
                </div>
                <div class="form-actions" style="margin-top: 20px">
                  <button class="btn-primary" onclick="changePassword()">Update Password</button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="toast" id="toast"></div>

    <script src="../admin-common.js"></script>
    <script>
      adminInit();

      var currentProfile = null;

      function loadProfile() {
        fetch("../api/admin/profile.php", { credentials: "same-origin" })
          .then(function (res) { return res.json(); })
          .then(function (result) {
            if (!result.success) {
              showToast(result.message || "Could not load profile.");
              return;
            }
            currentProfile = result.data.profile;
            renderProfile(currentProfile, result.data.stats);
          })
          .catch(function () {
            showToast("Could not reach the server. Is the backend running?");
          });
      }

      function renderProfile(p, stats) {
        document.getElementById("view-av").textContent = adminInitials(p.name);
        document.getElementById("view-name").textContent = p.name;
        document.getElementById("view-role").textContent = p.role === "super_admin" ? "Super Admin" : "Officer";
        document.getElementById("view-email").textContent = p.email;
        document.getElementById("view-since").textContent = p.created_at;

        document.getElementById("edit-name").value = p.name;
        document.getElementById("edit-email").value = p.email;

        if (stats) {
          document.getElementById("stat-active").textContent = stats.active;
          document.getElementById("stat-closed").textContent = stats.closed;
          document.getElementById("stat-total").textContent = stats.total;
        }
      }

      function openEdit() {
        document.getElementById("edit-panel").style.display = "";
        document.getElementById("edit-panel").scrollIntoView({ behavior: "smooth", block: "start" });
      }

      function closeEdit() {
        document.getElementById("edit-panel").style.display = "none";
      }

      function saveProfile() {
        var name = document.getElementById("edit-name").value.trim();
        var email = document.getElementById("edit-email").value.trim();

        if (!name || !email) {
          showToast("Please fill all required fields.");
          return;
        }

        fetch("../api/admin/profile.php", {
          method: "POST",
          headers: { "Content-Type": "application/json" },
          credentials: "same-origin",
          body: JSON.stringify({ action: "update-info", name: name, email: email }),
        })
          .then(function (res) { return res.json(); })
          .then(function (result) {
            if (result.success) {
              showToast("Profile updated successfully!");
              closeEdit();
              loadProfile();
            } else {
              showToast(result.message || "Failed to update profile.");
            }
          })
          .catch(function () {
            showToast("Could not reach the server. Please try again.");
          });
      }

      function changePassword() {
        var current = document.getElementById("pw-current").value;
        var newPw = document.getElementById("pw-new").value;
        var confirm = document.getElementById("pw-confirm").value;

        if (!current || !newPw) {
          showToast("Please fill in all password fields.");
          return;
        }

        fetch("../api/admin/profile.php", {
          method: "POST",
          headers: { "Content-Type": "application/json" },
          credentials: "same-origin",
          body: JSON.stringify({
            action: "change-password",
            current_password: current,
            new_password: newPw,
            confirm_password: confirm,
          }),
        })
          .then(function (res) { return res.json(); })
          .then(function (result) {
            if (result.success) {
              document.getElementById("pw-current").value = "";
              document.getElementById("pw-new").value = "";
              document.getElementById("pw-confirm").value = "";
              showToast("Password changed successfully!");
            } else {
              showToast(result.message || "Failed to change password.");
            }
          })
          .catch(function () {
            showToast("Could not reach the server. Please try again.");
          });
      }

      var toastTimer;
      function showToast(msg) {
        var t = document.getElementById("toast");
        t.textContent = msg;
        t.classList.add("show");
        clearTimeout(toastTimer);
        toastTimer = setTimeout(function () {
          t.classList.remove("show");
        }, 2800);
      }

      loadProfile();
    </script>
  </body>
</html>