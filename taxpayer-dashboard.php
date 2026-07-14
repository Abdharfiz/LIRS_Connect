<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>TaxTrack – LIRS Connect | My Dashboard</title>
    <link
      href="https://fonts.googleapis.com/css2?family=DM+Serif+Display:ital@0;1&family=DM+Sans:wght@400;500;600;700&display=swap"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="taxpayer-dashboard.css" />
  </head>
  <body>
    <?php include 'includes/sidebar.php'; ?>

    <div class="main">
      <header class="topbar">
        <div>
          <div class="topbar-title">My Dashboard</div>
          <div class="topbar-sub">LIRS Connect · Taxpayer Portal</div>
        </div>
      </header>

      <div class="content">
        <div class="welcome-banner">
          <div class="welcome-text">
            <div class="greeting">Welcome back,</div>
            <h2 id="welcome-name">User</h2>
            <p>
              Manage your tax complaints and track their status here. Your voice
              is officially heard.
            </p>
          </div>
          <div class="welcome-actions">
            <a href="submit-complaint.php" class="btn-primary">
              Submit Complaint</a
            >
            <a href="my-complaints.php" class="btn-outline-white"
              >My Complaints</a
            >
          </div>
        </div>

        <div class="section-header">
          <div class="section-title">My Complaint Summary</div>
        </div>
        <div class="stats-grid">
          <div class="stat-card sc-green">
            <div class="stat-icon ig">
              <svg
                viewBox="0 0 20 20"
                fill="none"
                stroke="var(--green-mid)"
                stroke-width="1.5"
              >
                <rect x="4" y="2" width="12" height="16" rx="1.5" />
                <path d="M7 6h6M7 9h6M7 12h4" />
              </svg>
            </div>
            <div class="stat-value" id="stat-total">0</div>
            <div class="stat-label">Total Complaints</div>
          </div>
          <div class="stat-card sc-amber">
            <div class="stat-icon ia">
              <svg
                viewBox="0 0 20 20"
                fill="none"
                stroke="var(--amber)"
                stroke-width="1.5"
              >
                <circle cx="10" cy="10" r="7.5" />
                <path d="M10 6v4l3 2" />
              </svg>
            </div>
            <div class="stat-value" id="stat-pending">0</div>
            <div class="stat-label">Pending</div>
          </div>
          <div class="stat-card sc-blue">
            <div class="stat-icon ib">
              <svg
                viewBox="0 0 20 20"
                fill="none"
                stroke="var(--blue)"
                stroke-width="1.5"
              >
                <circle cx="9" cy="9" r="6" />
                <path d="M15 15l3 3" />
              </svg>
            </div>
            <div class="stat-value" id="stat-review">0</div>
            <div class="stat-label">Under Review</div>
          </div>
          <div class="stat-card sc-resolve">
            <div class="stat-icon ir">
              <svg
                viewBox="0 0 20 20"
                fill="none"
                stroke="var(--green-mid)"
                stroke-width="1.5"
              >
                <circle cx="10" cy="10" r="7.5" />
                <path d="m6.5 10 2.5 2.5 4.5-4.5" />
              </svg>
            </div>
            <div class="stat-value" id="stat-resolved">0</div>
            <div class="stat-label">Resolved</div>
          </div>
        </div>

        <div class="section-header">
          <div class="section-title">Quick Actions</div>
        </div>
        <div class="quick-grid">
          <a href="submit-complaint.php" class="quick-card">
            <div class="quick-icon qg">
              <svg
                viewBox="0 0 20 20"
                fill="none"
                stroke="var(--green-mid)"
                stroke-width="1.6"
              >
                <circle cx="10" cy="10" r="7.5" />
                <path d="M10 6.5v7M6.5 10h7" />
              </svg>
            </div>
            <div>
              <div class="quick-label">Submit Complaint</div>
              <div class="quick-desc">File a new complaint</div>
            </div>
          </a>
          <a href="my-complaints.php" class="quick-card">
            <div class="quick-icon qa">
              <svg
                viewBox="0 0 20 20"
                fill="none"
                stroke="var(--amber)"
                stroke-width="1.6"
              >
                <path d="M4 4h12M4 8h8M4 12h10M4 16h6" />
              </svg>
            </div>
            <div>
              <div class="quick-label">View My Complaints</div>
              <div class="quick-desc">Track all your cases</div>
            </div>
          </a>
          <a href="profile.php" class="quick-card">
            <div class="quick-icon qb">
              <svg
                viewBox="0 0 20 20"
                fill="none"
                stroke="var(--blue)"
                stroke-width="1.6"
              >
                <circle cx="10" cy="7" r="3.5" />
                <path d="M3 17c0-3.3 3.1-6 7-6s7 2.7 7 6" />
              </svg>
            </div>
            <div>
              <div class="quick-label">Update Profile</div>
              <div class="quick-desc">Edit your details</div>
            </div>
          </a>
          <a href="contact-support.php" class="quick-card">
            <div class="quick-icon qr">
              <svg
                viewBox="0 0 20 20"
                fill="none"
                stroke="var(--red)"
                stroke-width="1.6"
              >
                <path
                  d="M6.8 3.5c.5 0 1 .3 1.2.8l.7 1.7a1.3 1.3 0 0 1-.3 1.4l-.9.9c.6 1.5 1.8 2.7 3.3 3.3l.9-.9a1.3 1.3 0 0 1 1.4-.3l1.7.7c.5.2.8.7.8 1.2v1.5c0 .8-.7 1.5-1.5 1.4-5.4-.6-9.7-4.9-10.3-10.3-.1-.8.6-1.5 1.4-1.5h1.5z"
                />
              </svg>
            </div>
            <div>
              <div class="quick-label">Contact Support</div>
              <div class="quick-desc">Talk to an officer</div>
            </div>
          </a>
        </div>

        <div class="two-col">
          <div class="panel">
            <div class="panel-head">
              <div class="panel-title">Recent Complaints</div>
              <a href="my-complaints.php" class="section-link">View all →</a>
            </div>
            <div class="table-wrap">
              <table>
                <thead>
                  <tr>
                    <th>Complaint ID</th>
                    <th>Subject</th>
                    <th>Date</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody id="recent-complaints-tbody"></tbody>
              </table>
            </div>
            <div id="recent-complaints-empty" style="display: none; padding: 30px; text-align: center; color: var(--text-muted); font-size: 13px">
              You haven't submitted any complaints yet.
            </div>
          </div>

          <div class="panel">
            <div class="panel-head">
              <div class="panel-title">Notifications</div>
              <span class="badge pending" id="notif-new-badge" style="display: none">0 new</span>
            </div>
            <div id="dash-notif-list"></div>
            <div id="dash-notif-empty" style="display: none; padding: 30px; text-align: center; color: var(--text-muted); font-size: 13px">
              No notifications yet.
            </div>
          </div>
        </div>

        <div class="bottom-grid">
          <div class="panel">
            <div class="panel-head">
              <div class="panel-title">Responses from LIRS Officers</div>
              <a href="my-complaints.php" class="section-link">View all →</a>
            </div>
            <div id="dash-responses-list"></div>
            <div id="dash-responses-empty" style="display: none; padding: 24px 20px; text-align: center; color: var(--text-muted); font-size: 13px">
              No officer responses yet.
            </div>
            <div style="padding: 16px 20px">
              <a
                href="submit-complaint.php"
                class="btn-primary"
                style="width: 100%; justify-content: center"
              >
                <svg
                  viewBox="0 0 20 20"
                  fill="none"
                  stroke="currentColor"
                  stroke-width="1.8"
                  width="14"
                  height="14"
                >
                  <circle cx="10" cy="10" r="7.5" />
                  <path d="M10 6.5v7M6.5 10h7" />
                </svg>
                Submit a New Complaint
              </a>
            </div>
          </div>

          <div>
            <div class="profile-card">
              <div class="profile-top">
                <div class="profile-av" id="profile-av">AY</div>
                <div class="profile-name" id="profile-name">
                  User
                </div>
                <div class="profile-tin" id="profile-tin">TIN: --</div>
              </div>
              <div class="profile-fields">
                <div class="profile-row">
                  <span class="p-label">Email Address</span>
                  <span class="p-value" id="profile-email"
                    >--</span
                  >
                </div>
                <div class="profile-row">
                  <span class="p-label">Phone Number</span>
                  <span class="p-value" id="profile-phone">--</span>
                </div>
                <div class="profile-row">
                  <span class="p-label">Account Status</span>
                  <span class="p-value" id="profile-status-wrap"
                    ><span class="badge resolved" id="profile-status-badge">
                      <svg
                        viewBox="0 0 20 20"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2.2"
                        width="11"
                        height="11"
                        style="margin-right: 3px"
                      >
                        <path d="m4.5 10 3.5 3.5 7.5-7.5" />
                      </svg>
                      <span id="profile-status-text">Verified</span></span
                    ></span
                  >
                </div>
              </div>
              <a href="profile.php" class="btn-update">
                <svg
                  viewBox="0 0 20 20"
                  fill="none"
                  stroke="currentColor"
                  stroke-width="1.6"
                  width="14"
                  height="14"
                >
                  <circle cx="10" cy="7" r="3.5" />
                  <path d="M3 17c0-3.3 3.1-6 7-6s7 2.7 7 6" />
                </svg>
                Update Profile
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="toast" id="toast"></div>

    <script>
      // Guard: confirm there's a real taxpayer session on the server before
      // showing this page. Anyone not logged in gets bounced to login.php.
      (function checkSession() {
        fetch("api/session.php", { credentials: "same-origin" })
          .then((res) => res.json())
          .then((result) => {
            if (
              !result.data ||
              !result.data.loggedIn ||
              result.data.role !== "taxpayer"
            ) {
              window.location.href = "login.php";
              return;
            }
            sessionStorage.setItem("userName", result.data.name);
            sessionStorage.setItem("userEmail", result.data.email);
            renderUser(result.data.name, result.data.email);
          })
          .catch(() => {
            console.warn("Could not verify session with the backend.");
          });
      })();

      function initials(name) {
        return name
          .split(" ")
          .map(function (n) {
            return n[0];
          })
          .join("")
          .toUpperCase()
          .slice(0, 2);
      }

      function renderUser(name, email) {
        var ini = initials(name);
        document.getElementById("welcome-name").textContent = name;
        document.getElementById("sidebar-name").textContent = name;
        document.getElementById("sidebar-av").textContent = ini;
        document.getElementById("profile-av").textContent = ini;
        document.getElementById("profile-name").textContent = name;
        document.getElementById("profile-email").textContent = email;
      }

      var userName = sessionStorage.getItem("userName") || "User";
      var userEmail = sessionStorage.getItem("userEmail") || "user@example.com";
      renderUser(userName, userEmail);

      document
        .getElementById("logout-btn")
        .addEventListener("click", function (e) {
          e.preventDefault();
          fetch("api/logout.php", {
            method: "POST",
            credentials: "same-origin",
          });
          sessionStorage.clear();
          showToast("Logged out successfully");
          setTimeout(function () {
            window.location.href = "index.php";
          }, 1000);
        });

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

      function formatDate(dateStr) {
        var d = new Date(dateStr);
        var day = String(d.getDate()).padStart(2, "0");
        var month = String(d.getMonth() + 1).padStart(2, "0");
        var year = d.getFullYear();
        return day + "/" + month + "/" + year;
      }

      function statusBadgeClass(status) {
        var s = (status || "").toLowerCase();
        if (s === "resolved") return "resolved";
        if (s === "under review" || s === "in review") return "review";
        return "pending";
      }

      // ---- Profile card (real name/email/TIN/phone/status) ----
      function loadProfileCard() {
        fetch("api/get-profile.php", { credentials: "same-origin" })
          .then(function (res) { return res.json(); })
          .then(function (result) {
            if (!result.success) return;
            var p = result.data.profile;
            document.getElementById("profile-tin").textContent = "TIN: " + (p.tin || "--");
            document.getElementById("profile-phone").textContent = p.phone || "--";
            var isActive = p.status === "active";
            document.getElementById("profile-status-badge").className =
              "badge " + (isActive ? "resolved" : "pending");
            document.getElementById("profile-status-text").textContent =
              isActive ? "Verified" : "Inactive";
          })
          .catch(function () {
            /* leave placeholders if this fails — not critical to page load */
          });
      }

      // ---- Complaint stats + Recent Complaints table + Responses panel ----
      function loadComplaints() {
        fetch("api/get-complaints.php?per_page=50", { credentials: "same-origin" })
          .then(function (res) { return res.json(); })
          .then(function (result) {
            if (!result.success) return;
            var complaints = result.data.complaints || [];
            renderStats(complaints);
            renderRecentComplaints(complaints.slice(0, 3));
          })
          .catch(function () {
            document.getElementById("recent-complaints-empty").style.display = "";
          });
      }

      function renderStats(complaints) {
        var total = complaints.length;
        var pending = 0, review = 0, resolved = 0;
        complaints.forEach(function (c) {
          var s = (c.status || "").toLowerCase();
          if (s === "new" || s === "pending") pending++;
          else if (s === "under review" || s === "in review" || s === "escalated") review++;
          else if (s === "resolved" || s === "closed") resolved++;
        });
        document.getElementById("stat-total").textContent = total;
        document.getElementById("stat-pending").textContent = pending;
        document.getElementById("stat-review").textContent = review;
        document.getElementById("stat-resolved").textContent = resolved;
      }

      function renderRecentComplaints(complaints) {
        var tbody = document.getElementById("recent-complaints-tbody");
        tbody.innerHTML = "";

        if (!complaints.length) {
          document.getElementById("recent-complaints-empty").style.display = "";
          return;
        }
        document.getElementById("recent-complaints-empty").style.display = "none";

        complaints.forEach(function (c) {
          var row = document.createElement("tr");
          var actionText = c.status === "Resolved" ? "View Response" : "View";
          var actionClass = c.status === "Resolved" ? "respond" : "view";
          row.innerHTML =
            '<td><span class="cid"></span></td>' +
            "<td></td><td></td>" +
            '<td><span class="badge ' + statusBadgeClass(c.status) + '"></span></td>' +
            '<td><button class="act-btn ' + actionClass + '"></button></td>';
          row.children[0].querySelector(".cid").textContent = c.reference_id;
          row.children[1].textContent = c.subject;
          row.children[2].textContent = formatDate(c.created_at);
          row.children[3].querySelector(".badge").textContent = c.status;
          var btn = row.children[4].querySelector("button");
          btn.textContent = actionText;
          btn.addEventListener("click", function () {
            window.location.href = "complaint-detail.php?id=" + c.id;
          });
          tbody.appendChild(row);
        });
      }

      // ---- Notifications panel ----
      function loadNotifications() {
        fetch("api/get-notifications.php?limit=3", { credentials: "same-origin" })
          .then(function (res) { return res.json(); })
          .then(function (result) {
            if (!result.success) return;
            var notifs = result.data.notifications || [];
            var unread = result.data.unread_count || 0;

            var badge = document.getElementById("notif-new-badge");
            if (unread > 0) {
              badge.textContent = unread + " new";
              badge.style.display = "";
            }

            var list = document.getElementById("dash-notif-list");
            list.innerHTML = "";
            if (!notifs.length) {
              document.getElementById("dash-notif-empty").style.display = "";
              return;
            }
            document.getElementById("dash-notif-empty").style.display = "none";

            var dotColors = ["blue", "green", "amber"];
            notifs.forEach(function (n, i) {
              var div = document.createElement("div");
              div.className = "notif-item" + (n.is_read ? "" : " unread");
              div.innerHTML =
                '<div class="n-dot ' + dotColors[i % dotColors.length] + '"></div>' +
                "<div><div class=\"n-text\"></div><div class=\"n-time\"></div></div>";
              div.querySelector(".n-text").textContent = n.title;
              div.querySelector(".n-time").textContent = n.time_ago || n.created_at;
              if (n.complaint_id) {
                div.addEventListener("click", function () {
                  window.location.href = "complaint-detail.php?id=" + n.complaint_id;
                });
              }
              list.appendChild(div);
            });
          })
          .catch(function () {
            document.getElementById("dash-notif-empty").style.display = "";
          });
      }

      // ---- Officer responses panel (pulled from resolved/in-progress complaints) ----
      function loadResponses() {
        fetch("api/get-complaints.php?per_page=50", { credentials: "same-origin" })
          .then(function (res) { return res.json(); })
          .then(function (result) {
            if (!result.success) return;
            var complaints = (result.data.complaints || []).filter(function (c) {
              var s = (c.status || "").toLowerCase();
              return s === "resolved" || s === "under review" || s === "in review";
            }).slice(0, 2);

            var list = document.getElementById("dash-responses-list");
            list.innerHTML = "";
            if (!complaints.length) {
              document.getElementById("dash-responses-empty").style.display = "";
              return;
            }
            document.getElementById("dash-responses-empty").style.display = "none";

            complaints.forEach(function (c) {
              var div = document.createElement("div");
              div.className = "response-item";
              div.innerHTML =
                '<div class="resp-meta"><span class="resp-cid"></span><span class="resp-date"></span></div>' +
                '<div class="resp-subject"></div>';
              div.querySelector(".resp-cid").textContent = c.reference_id;
              div.querySelector(".resp-date").textContent = formatDate(c.updated_at || c.created_at);
              div.querySelector(".resp-subject").textContent = c.subject + " — " + c.status;
              div.addEventListener("click", function () {
                window.location.href = "complaint-detail.php?id=" + c.id;
              });
              list.appendChild(div);
            });
          })
          .catch(function () {
            document.getElementById("dash-responses-empty").style.display = "";
          });
      }

      loadProfileCard();
      loadComplaints();
      loadNotifications();
      loadResponses();
    </script>
  </body>
</html>