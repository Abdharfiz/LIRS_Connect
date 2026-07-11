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
            <div class="stat-value" id="total-complaints">0</div>
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
            <div class="stat-value" id="pending-complaints">0</div>
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
            <div class="stat-value" id="review-complaints">0</div>
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
            <div class="stat-value" id="resolved-complaints">0</div>
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
                <tbody id="recent-complaints-body"></tbody>
              </table>
            </div>
            <div
              id="recent-complaints-empty"
              style="
                display: none;
                padding: 28px 20px;
                text-align: center;
                color: var(--text-muted);
                font-size: 13px;
              "
            >
              No complaints submitted yet.
            </div>
          </div>

          <div class="panel">
            <div class="panel-head">
              <div class="panel-title">Notifications</div>
              <span class="badge pending" id="notification-count">0 new</span>
            </div>
            <div id="notifications-list"></div>
            <div
              id="notifications-empty"
              style="
                display: none;
                padding: 28px 20px;
                text-align: center;
                color: var(--text-muted);
                font-size: 13px;
              "
            >
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
            <div id="responses-list"></div>
            <div
              id="responses-empty"
              style="
                display: none;
                padding: 28px 20px;
                text-align: center;
                color: var(--text-muted);
                font-size: 13px;
              "
            >
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
                  <span class="p-value" id="profile-email">--</span>
                </div>
                <div class="profile-row">
                  <span class="p-label">Phone Number</span>
                  <span class="p-value" id="profile-phone">--</span>
                </div>
                <div class="profile-row">
                  <span class="p-label">Account Status</span>
                  <span class="p-value"
                    ><span class="badge resolved" id="profile-status">
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
                      --</span
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
      // showing this page. Anyone not logged in gets bounced to login.html.
      (function checkSession() {
        fetch("api/session.php", { credentials: "same-origin" })
          .then((res) => res.json())
          .then((result) => {
            if (
              !result.data ||
              !result.data.loggedIn ||
              result.data.role !== "taxpayer"
            ) {
              window.location.href = "login.html";
              return;
            }
            sessionStorage.setItem("userName", result.data.name);
            sessionStorage.setItem("userEmail", result.data.email);
            renderUser(result.data.name, result.data.email);
          })
          .catch(() => {
            // If the backend is unreachable, don't lock the user out of a
            // page they may have a valid session for — just log it.
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

      // Render immediately from sessionStorage (fast, avoids a blank flash),
      // then checkSession() above will correct it once the server responds.
      var userName = sessionStorage.getItem("userName") || "User";
      var userEmail = sessionStorage.getItem("userEmail") || "--";
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
            window.location.href = "index.html";
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
    </script>
    <script>
      document.addEventListener("DOMContentLoaded", function () {
        loadDashboard();
      });

      function loadDashboard() {
        fetch("api/get-dashboard.php", { credentials: "same-origin" })
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
              showToast(result.data.message || "Unable to load dashboard.");
              return;
            }

            renderDashboard(result.data.data || {});
          })
          .catch(function (err) {
            console.error("Dashboard fetch error:", err);
            showToast("Unable to reach the server.");
          });
      }

      function renderDashboard(data) {
        renderUser(data.profile || {});
        renderCounts(data.counts || {});
        renderRecentComplaints(data.recent_complaints || []);
        renderNotifications(data.notifications || [], data.unread_count || 0);
        renderResponses(data.responses || []);
      }

      function renderUser(profile, emailFromSession) {
        if (typeof profile === "string") {
          profile = {
            name: profile,
            email: emailFromSession,
            tin: sessionStorage.getItem("userTin") || "--",
            phone: "--",
            status: "--",
          };
        }

        var name = profile.name || "User";
        var email = profile.email || "--";
        var phone = profile.phone || "--";
        var tin = profile.tin || "--";
        var status = profile.status || "--";
        var ini = initials(name);

        sessionStorage.setItem("userName", name);
        sessionStorage.setItem("userEmail", email);
        sessionStorage.setItem("userTin", tin);

        setText("welcome-name", name);
        setText("sidebar-name", name);
        setText("sidebar-av", ini);
        setText("sidebar-tin", "TIN: " + tin);
        setText("profile-av", ini);
        setText("profile-name", name);
        setText("profile-tin", "TIN: " + tin);
        setText("profile-email", email);
        setText("profile-phone", phone);

        var statusBadge = document.getElementById("profile-status");
        if (statusBadge) {
          statusBadge.textContent = toTitleCase(status);
          statusBadge.className =
            "badge " + (String(status).toLowerCase() === "active" ? "resolved" : "pending");
        }
      }

      function renderCounts(counts) {
        setText("total-complaints", counts.total || 0);
        setText("pending-complaints", counts.pending || 0);
        setText("review-complaints", counts.under_review || 0);
        setText("resolved-complaints", counts.resolved || 0);
      }

      function renderRecentComplaints(complaints) {
        var tbody = document.getElementById("recent-complaints-body");
        var empty = document.getElementById("recent-complaints-empty");
        tbody.innerHTML = "";

        if (!complaints.length) {
          empty.style.display = "";
          return;
        }

        empty.style.display = "none";
        complaints.forEach(function (complaint) {
          var row = document.createElement("tr");

          var idCell = document.createElement("td");
          var cid = document.createElement("span");
          cid.className = "cid";
          cid.textContent = complaint.reference_id;
          idCell.appendChild(cid);
          row.appendChild(idCell);

          appendTextCell(row, complaint.subject);
          appendTextCell(row, complaint.created_at_label || formatDate(complaint.created_at));

          var statusCell = document.createElement("td");
          var badge = document.createElement("span");
          badge.className = "badge " + statusClass(complaint.status);
          badge.textContent = complaint.status;
          statusCell.appendChild(badge);
          row.appendChild(statusCell);

          var actionCell = document.createElement("td");
          var button = document.createElement("button");
          var isResolved = complaint.status === "Resolved";
          button.className = "act-btn " + (isResolved ? "respond" : "view");
          button.textContent = isResolved ? "View Response" : "View";
          button.addEventListener("click", function () {
            window.location.href = "complaint-detail.php?id=" + encodeURIComponent(complaint.id);
          });
          actionCell.appendChild(button);
          row.appendChild(actionCell);

          tbody.appendChild(row);
        });
      }

      function renderNotifications(notifications, unreadCount) {
        var list = document.getElementById("notifications-list");
        var empty = document.getElementById("notifications-empty");
        var countText = unreadCount === 1 ? "1 new" : unreadCount + " new";
        setText("notification-count", countText);
        list.innerHTML = "";

        if (!notifications.length) {
          empty.style.display = "";
          return;
        }

        empty.style.display = "none";
        notifications.forEach(function (notification) {
          var item = document.createElement("div");
          item.className = "notif-item" + (!notification.is_read ? " unread" : "");
          item.addEventListener("click", function () {
            if (notification.complaint_id) {
              window.location.href =
                "complaint-detail.php?id=" + encodeURIComponent(notification.complaint_id);
              return;
            }
            showToast("No complaint linked to this notification.");
          });

          var dot = document.createElement("div");
          dot.className = "n-dot " + notificationDotClass(notification.type);
          item.appendChild(dot);

          var body = document.createElement("div");
          var text = document.createElement("div");
          text.className = "n-text";
          text.textContent = notification.message || notification.title || "Notification";
          var time = document.createElement("div");
          time.className = "n-time";
          time.textContent = notification.time_ago || notification.created_at_label || "";
          body.appendChild(text);
          body.appendChild(time);
          item.appendChild(body);

          list.appendChild(item);
        });
      }

      function renderResponses(responses) {
        var list = document.getElementById("responses-list");
        var empty = document.getElementById("responses-empty");
        list.innerHTML = "";

        if (!responses.length) {
          empty.style.display = "";
          return;
        }

        empty.style.display = "none";
        responses.forEach(function (response) {
          var item = document.createElement("div");
          item.className = "response-item";
          item.addEventListener("click", function () {
            window.location.href =
              "complaint-detail.php?id=" + encodeURIComponent(response.complaint_id);
          });

          var meta = document.createElement("div");
          meta.className = "resp-meta";
          var cid = document.createElement("span");
          cid.className = "resp-cid";
          cid.textContent = response.reference_id;
          var date = document.createElement("span");
          date.className = "resp-date";
          date.textContent = response.created_at_label || formatDate(response.created_at);
          meta.appendChild(cid);
          meta.appendChild(date);

          var subject = document.createElement("div");
          subject.className = "resp-subject";
          subject.textContent = response.subject + " - " + response.status;

          var preview = document.createElement("div");
          preview.className = "resp-preview";
          preview.textContent = trimText(response.message, 150);

          item.appendChild(meta);
          item.appendChild(subject);
          item.appendChild(preview);
          list.appendChild(item);
        });
      }

      function appendTextCell(row, value) {
        var cell = document.createElement("td");
        cell.textContent = value || "--";
        row.appendChild(cell);
      }

      function setText(id, value) {
        var element = document.getElementById(id);
        if (element) {
          element.textContent = value;
        }
      }

      function statusClass(status) {
        var normalized = String(status || "").toLowerCase();
        if (normalized === "new" || normalized === "pending") return "pending";
        if (normalized === "under review") return "review";
        if (normalized === "resolved") return "resolved";
        if (normalized === "rejected") return "rejected";
        if (normalized === "closed") return "closed";
        return "pending";
      }

      function notificationDotClass(type) {
        var normalized = String(type || "").toLowerCase();
        if (normalized.indexOf("response") !== -1) return "green";
        if (normalized.indexOf("status") !== -1) return "blue";
        return "amber";
      }

      function formatDate(dateStr) {
        if (!dateStr) return "--";
        var d = new Date(dateStr);
        if (Number.isNaN(d.getTime())) return "--";
        var day = String(d.getDate()).padStart(2, "0");
        var month = String(d.getMonth() + 1).padStart(2, "0");
        var year = d.getFullYear();
        return day + "/" + month + "/" + year;
      }

      function toTitleCase(value) {
        return String(value || "--").replace(/\w\S*/g, function (text) {
          return text.charAt(0).toUpperCase() + text.slice(1).toLowerCase();
        });
      }

      function trimText(value, limit) {
        var text = String(value || "");
        if (text.length <= limit) {
          return text;
        }
        return text.slice(0, limit - 3) + "...";
      }
    </script>
  </body>
</html>

