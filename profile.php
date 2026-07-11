<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>TaxTrack – My Profile</title>
    <link
      href="https://fonts.googleapis.com/css2?family=DM+Serif+Display:ital@0;1&family=DM+Sans:wght@400;500;600;700&display=swap"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="app.css" />
  </head>
  <body>    <?php include 'includes/sidebar.php'; ?>

    <div class="main">
      <header class="topbar">
        <div>
          <div class="topbar-title">My Profile</div>
          <div class="topbar-sub">LIRS Connect · Taxpayer Portal</div>
        </div>
        <div class="topbar-right">
          <div
            class="icon-btn"
            onclick="window.location.href = 'notifications.php'"
          >
            <div class="notif-dot"></div>
            <svg
              width="16"
              height="16"
              viewBox="0 0 20 20"
              fill="none"
              stroke="#6b7a72"
              stroke-width="1.7"
            >
              <path
                d="M10 2a6 6 0 0 0-6 6c0 5-2 6-2 6h16s-2-1-2-6a6 6 0 0 0-6-6z"
              />
              <path d="M11.7 17a2 2 0 0 1-3.4 0" />
            </svg>
          </div>
        </div>
      </header>

      <div class="content">
        <div class="page-banner">
          <div class="page-banner-text">
            <div class="pb-eyebrow">LIRS Connect · Account</div>
            <h2>My Profile</h2>
            <p>
              View and update your taxpayer information. Keep your details
              current for accurate processing.
            </p>
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
                <div class="profile-av" id="profile-av">AY</div>
                <div class="profile-name" id="profile-name">
                  User
                </div>
                <div class="profile-tin" id="profile-tin">TIN: --</div>
                <div class="profile-status-row">
                  <span class="badge resolved">
                    <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="2.2" width="11" height="11" style="margin-right: 3px">
                      <path d="m4.5 10 3.5 3.5 7.5-7.5" />
                    </svg>
                    Verified
                  </span>
                </div>
              </div>
              <div class="profile-fields">
                <div class="profile-row">
                  <span class="p-label">Email Address</span>
                  <span class="p-value" id="view-email"
                    >abdulhafeez@example.com</span
                  >
                </div>
                <div class="profile-divider"></div>
                <div class="profile-row">
                  <span class="p-label">Phone Number</span>
                  <span class="p-value" id="view-phone">--</span>
                </div>
                <div class="profile-divider"></div>
                <div class="profile-row">
                  <span class="p-label">LGA</span>
                  <span class="p-value" id="view-lga">--</span>
                </div>
                <div class="profile-divider"></div>
                <div class="profile-row">
                  <span class="p-label">Account Created</span>
                  <span class="p-value" id="view-created">--</span>
                </div>
              </div>
              <button class="btn-update" onclick="openEdit()">
                <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.6" width="14" height="14">
                  <path d="M13.5 3.5l3 3L6 17H3v-3L13.5 3.5z" />
                </svg>
                Edit Profile
              </button>
            </div>
          </div>
          <!-- Right: Edit form + Activity -->
          <div style="display: flex; flex-direction: column; gap: 16px">
            <!-- View mode summary -->
            <div class="panel" id="edit-panel" style="display: none">
              <div class="panel-head">
                <div class="panel-title">Edit Personal Information</div>
                <button
                  class="btn-ghost"
                  style="font-size: 12px; padding: 6px 12px"
                  onclick="closeEdit()"
                >
                  Cancel
                </button>
              </div>
              <div class="panel-body">
                <div class="form-grid">
                  <div class="form-group">
                    <label class="form-label">First Name *</label>
                    <input
                      class="form-input"
                      id="edit-fname"
                      type="text"
                      value="Abdulhafeez"
                    />
                  </div>
                  <div class="form-group">
                    <label class="form-label">Last Name *</label>
                    <input
                      class="form-input"
                      id="edit-lname"
                      type="text"
                      value="Yusuf"
                    />
                  </div>
                  <div class="form-group full">
                    <label class="form-label">Email Address *</label>
                    <input
                      class="form-input"
                      id="edit-email"
                      type="email"
                      value="abdulhafeez@example.com"
                    />
                  </div>
                  <div class="form-group">
                    <label class="form-label">Phone Number</label>
                    <input
                      class="form-input"
                      id="edit-phone"
                      type="tel"
                      value="+234 801 234 5678"
                    />
                  </div>
                  <div class="form-group">
                    <label class="form-label">LGA</label>
                    <select class="form-select" id="edit-lga">
                      <option selected>Ikeja</option>
                      <option>Lagos Island</option>
                      <option>Eti-Osa</option>
                      <option>Alimosho</option>
                      <option>Surulere</option>
                      <option>Kosofe</option>
                      <option>Mushin</option>
                      <option>Agege</option>
                      <option>Apapa</option>
                    </select>
                  </div>
                  <div class="form-group full">
                    <label class="form-label">Residential Address</label>
                    <input
                      class="form-input"
                      id="edit-address"
                      type="text"
                      placeholder="e.g. 12 Obafemi Awolowo Road, Ikeja"
                    />
                  </div>
                </div>
                <div class="form-actions" style="margin-top: 20px">
                  <button class="btn-ghost" onclick="closeEdit()">
                    Cancel
                  </button>
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
                <div class="panel-title">Account Security</div>
              </div>
              <div
                class="panel-body"
                style="
                  display: flex;
                  align-items: center;
                  justify-content: space-between;
                  gap: 16px;
                "
              >
                <div>
                  <div style="font-size: 13px; font-weight: 600">
                    Deactivate Account
                  </div>
                  <div
                    style="font-size: 12px; color: var(--text-muted); margin-top: 2px"
                  >
                    Temporarily disable your taxpayer portal access.
                  </div>
                </div>
                <button
                  class="btn-ghost"
                  style="
                    font-size: 12px;
                    padding: 8px 14px;
                    color: var(--red);
                    border-color: var(--red-light);
                  "
                  onclick="confirmDeactivate()"
                >
                  Deactivate
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="toast" id="toast"></div>

    <script>
      var currentProfile = null;

      function initials(n) {
        return (n || "")
          .split(" ")
          .map(function (w) {
            return w[0];
          })
          .join("")
          .toUpperCase()
          .slice(0, 2);
      }

      function loadProfile() {
        fetch("api/get-profile.php", { credentials: "same-origin" })
          .then(function (res) {
            return res.json().then(function (data) {
              return { status: res.status, data: data };
            });
          })
          .then(function (result) {
            if (result.status === 401) {
              window.location.href = "login.html";
              return;
            }
            if (!result.data.success) {
              showToast(result.data.message || "Could not load profile.");
              return;
            }
            currentProfile = result.data.data.profile;
            renderProfile(currentProfile);
          })
          .catch(function () {
            showToast("Could not reach the server. Is the backend running?");
          });
      }

      function renderProfile(p) {
        var fullName = p.first_name + " " + p.last_name;
        var ini = initials(fullName);

        document.getElementById("sidebar-av").textContent = ini;
        document.getElementById("sidebar-name").textContent = fullName;
        document.getElementById("profile-av").textContent = ini;
        document.getElementById("profile-name").textContent = fullName;
        document.getElementById("profile-tin").textContent = "TIN: " + (p.tin || "--");

        document.getElementById("view-email").textContent = p.email;
        document.getElementById("view-phone").textContent = p.phone || "--";
        document.getElementById("view-lga").textContent = p.lga || "--";
        document.getElementById("view-created").textContent = p.created_at;

        // Pre-fill the edit form too, so opening it doesn't show stale
        // placeholder values from the static HTML.
        document.getElementById("edit-fname").value = p.first_name;
        document.getElementById("edit-lname").value = p.last_name;
        document.getElementById("edit-email").value = p.email;
        document.getElementById("edit-phone").value = p.phone || "";
        document.getElementById("edit-address").value = p.address || "";
        var lgaSelect = document.getElementById("edit-lga");
        if (p.lga) {
          for (var i = 0; i < lgaSelect.options.length; i++) {
            if (lgaSelect.options[i].value === p.lga || lgaSelect.options[i].text === p.lga) {
              lgaSelect.selectedIndex = i;
              break;
            }
          }
        }

        sessionStorage.setItem("userName", fullName);
        sessionStorage.setItem("userEmail", p.email);
      }

      loadProfile();

      document
        .getElementById("logout-btn")
        .addEventListener("click", function (e) {
          e.preventDefault();
          fetch("api/logout.php", { method: "POST", credentials: "same-origin" });
          sessionStorage.clear();
          showToast("Logged out");
          setTimeout(function () {
            window.location.href = "index.php";
          }, 1000);
        });

      function openEdit() {
        document.getElementById("edit-panel").style.display = "";
        document
          .getElementById("edit-panel")
          .scrollIntoView({ behavior: "smooth", block: "start" });
      }

      function closeEdit() {
        document.getElementById("edit-panel").style.display = "none";
      }

      function saveProfile() {
        var fname = document.getElementById("edit-fname").value.trim();
        var lname = document.getElementById("edit-lname").value.trim();
        var email = document.getElementById("edit-email").value.trim();
        var phone = document.getElementById("edit-phone").value.trim();
        var lga = document.getElementById("edit-lga").value;
        var address = document.getElementById("edit-address").value.trim();

        if (!fname || !lname || !email) {
          showToast("Please fill all required fields.");
          return;
        }

        var saveBtn = document.querySelector('.btn-primary[onclick="saveProfile()"]');

        fetch("api/get-profile.php", {
          method: "POST",
          headers: { "Content-Type": "application/json" },
          credentials: "same-origin",
          body: JSON.stringify({
            first_name: fname,
            last_name: lname,
            email: email,
            phone: phone,
            lga: lga,
            address: address,
          }),
        })
          .then(function (res) {
            return res.json();
          })
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

      function confirmDeactivate() {
        if (
          confirm(
            "Are you sure you want to deactivate your account? This action cannot be undone.",
          )
        ) {
          showToast("Account deactivation isn't available yet — contact LIRS support.");
        }
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
    </script>
  </body>
</html>