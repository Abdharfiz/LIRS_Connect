<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>TaxTrack – Notifications</title>
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
          <div class="topbar-title">Notifications</div>
          <div class="topbar-sub">LIRS Connect · Taxpayer Portal</div>
        </div>
        <div class="topbar-right">
          <button
            class="btn-ghost"
            style="font-size: 12px; padding: 8px 14px"
            onclick="markAllRead()"
          >
            <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="2" width="12" height="12" style="margin-right: 4px">
              <path d="m4.5 10 3.5 3.5 7.5-7.5" />
            </svg>
            Mark all read
          </button>
          <div class="icon-btn" onclick="window.location.href = 'profile.php'">
            <svg
              width="16"
              height="16"
              viewBox="0 0 20 20"
              fill="none"
              stroke="#6b7a72"
              stroke-width="1.7"
            >
              <circle cx="10" cy="7" r="3.5" />
              <path d="M3 17c0-3.3 3.1-6 7-6s7 2.7 7 6" />
            </svg>
          </div>
        </div>
      </header>

      <div class="content">
        <div class="page-banner">
          <div class="page-banner-text">
            <div class="pb-eyebrow">LIRS Connect · Alerts</div>
            <h2>Your Notifications</h2>
            <p>
              Stay updated on your complaint status, responses, and important
              LIRS announcements.
            </p>
          </div>
          <div class="page-banner-icon">
            <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.4">
              <path d="M10 2a6 6 0 0 0-6 6c0 5-2 6-2 6h16s-2-1-2-6a6 6 0 0 0-6-6z" />
              <path d="M11.7 17a2 2 0 0 1-3.4 0" />
            </svg>
          </div>
        </div>

        <div
          style="
            display: grid;
            grid-template-columns: 1fr 280px;
            gap: 20px;
            align-items: start;
          "
        >
          <div style="display: flex; flex-direction: column; gap: 16px">
            <!-- Unread -->
            <div>
              <div class="section-header">
                <div class="section-title">
                  Unread
                  <span
                    id="unread-count"
                    style="color: var(--text-muted); font-weight: 500"
                    >2</span
                  >
                </div>
              </div>
              <div class="panel" id="unread-panel">
                <div id="unread-list"></div>
                <div id="unread-empty" style="display: none; padding: 30px; text-align: center; color: var(--text-muted); font-size: 13px">
                  No unread notifications.
                </div>
              </div>
            </div>

            <!-- Earlier -->
            <div>
              <div class="section-header">
                <div class="section-title">Earlier</div>
              </div>
              <div class="panel">
                <div id="earlier-list"></div>
                <div id="earlier-empty" style="display: none; padding: 30px; text-align: center; color: var(--text-muted); font-size: 13px">
                  Nothing else to show.
                </div>
              </div>
            </div>
          </div>

          <!-- Sidebar -->
          <div style="display: flex; flex-direction: column; gap: 16px">
            <div class="panel">
              <div class="panel-head">
                <div class="panel-title">Notification Summary</div>
              </div>
              <div
                class="panel-body"
                style="display: flex; flex-direction: column; gap: 12px"
              >
                <div
                  style="
                    display: flex;
                    justify-content: space-between;
                    align-items: center;
                  "
                >
                  <span style="font-size: 13px; color: var(--text-muted)"
                    >Unread</span
                  >
                  <span class="badge new" id="summary-unread">0</span>
                </div>
                <div
                  style="
                    display: flex;
                    justify-content: space-between;
                    align-items: center;
                  "
                >
                  <span style="font-size: 13px; color: var(--text-muted)"
                    >Total</span
                  >
                  <span style="font-size: 13px; font-weight: 600" id="summary-total">0</span>
                </div>
              </div>
            </div>

            <div class="panel">
              <div class="panel-head">
                <div class="panel-title">Preferences</div>
              </div>
              <div
                class="panel-body"
                style="display: flex; flex-direction: column; gap: 14px"
              >
                <div
                  style="
                    display: flex;
                    justify-content: space-between;
                    align-items: center;
                  "
                >
                  <span style="font-size: 13px">Status updates</span>
                  <label
                    style="
                      position: relative;
                      display: inline-block;
                      width: 36px;
                      height: 20px;
                      cursor: pointer;
                    "
                  >
                    <input
                      type="checkbox"
                      checked
                      style="opacity: 0; width: 0; height: 0"
                      id="pref-status"
                    />
                    <span
                      id="toggle-status"
                      style="
                        position: absolute;
                        inset: 0;
                        background: var(--green);
                        border-radius: 20px;
                        transition: background 0.2s;
                      "
                    ></span>
                    <span
                      id="knob-status"
                      style="
                        position: absolute;
                        left: 3px;
                        top: 3px;
                        width: 14px;
                        height: 14px;
                        background: white;
                        border-radius: 50%;
                        transition: left 0.2s;
                        left: 19px;
                      "
                    ></span>
                  </label>
                </div>
                <div
                  style="
                    display: flex;
                    justify-content: space-between;
                    align-items: center;
                  "
                >
                  <span style="font-size: 13px">LIRS Announcements</span>
                  <label
                    style="
                      position: relative;
                      display: inline-block;
                      width: 36px;
                      height: 20px;
                      cursor: pointer;
                    "
                  >
                    <input
                      type="checkbox"
                      checked
                      style="opacity: 0; width: 0; height: 0"
                      id="pref-announce"
                    />
                    <span
                      id="toggle-announce"
                      style="
                        position: absolute;
                        inset: 0;
                        background: var(--green);
                        border-radius: 20px;
                      "
                    ></span>
                    <span
                      id="knob-announce"
                      style="
                        position: absolute;
                        top: 3px;
                        width: 14px;
                        height: 14px;
                        background: white;
                        border-radius: 50%;
                        left: 19px;
                      "
                    ></span>
                  </label>
                </div>
                <div
                  style="
                    display: flex;
                    justify-content: space-between;
                    align-items: center;
                  "
                >
                  <span style="font-size: 13px">Email alerts</span>
                  <label
                    style="
                      position: relative;
                      display: inline-block;
                      width: 36px;
                      height: 20px;
                      cursor: pointer;
                    "
                  >
                    <input
                      type="checkbox"
                      style="opacity: 0; width: 0; height: 0"
                      id="pref-email"
                    />
                    <span
                      id="toggle-email"
                      style="
                        position: absolute;
                        inset: 0;
                        background: var(--border);
                        border-radius: 20px;
                      "
                    ></span>
                    <span
                      id="knob-email"
                      style="
                        position: absolute;
                        top: 3px;
                        width: 14px;
                        height: 14px;
                        background: white;
                        border-radius: 50%;
                        left: 3px;
                      "
                    ></span>
                  </label>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="toast" id="toast"></div>

    <script>
      var userName = sessionStorage.getItem("userName") || "User";
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
      document.getElementById("sidebar-av").textContent = initials(userName);
      document.getElementById("sidebar-name").textContent = userName;

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

      // Loose visual grouping only — the backend doesn't have distinct
      // "announcement" types yet, so anything complaint-related gets the
      // same two icon styles based on whether it mentions resolution.
      function iconClassFor(type) {
        if (type === "complaint_assigned") return "nb";
        if (type && type.indexOf("resolved") !== -1) return "ng";
        return "nb";
      }

      function badgeFor(n) {
        if (n.type === "complaint_submitted") return { cls: "pending", label: "Pending" };
        if (n.type === "complaint_assigned") return { cls: "review", label: "Status Update" };
        return { cls: "pending", label: "Notice" };
      }

      function buildNotifItem(n) {
        var div = document.createElement("div");
        div.className = "notif-item" + (n.is_read ? "" : " unread");
        div.id = "notif-" + n.id;
        var href = n.complaint_id ? "complaint-detail.php?id=" + n.complaint_id : null;
        div.onclick = function () {
          readNotif(n.id, href);
        };

        var badge = badgeFor(n);
        var iconCls = iconClassFor(n.type);

        div.innerHTML =
          (n.is_read ? '<div style="width: 8px"></div>' : '<div class="unread-pill" id="pill-' + n.id + '"></div>') +
          '<div class="notif-icon-wrap ' + iconCls + '">' +
          '<svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.6"><circle cx="9" cy="9" r="6" /><path d="M15 15l3 3" /></svg>' +
          "</div>" +
          '<div class="notif-body">' +
          '<div class="notif-title"></div>' +
          '<div class="notif-desc"></div>' +
          '<div class="notif-meta"><span class="badge ' + badge.cls + '">' + badge.label + '</span><span class="notif-time"></span></div>' +
          "</div>";

        div.querySelector(".notif-title").textContent = n.title;
        div.querySelector(".notif-desc").textContent = n.message;
        div.querySelector(".notif-time").textContent = n.time_ago || n.created_at;

        return div;
      }

      var allNotifications = [];

      function loadNotifications() {
        fetch("api/get-notifications.php", { credentials: "same-origin" })
          .then(function (res) {
            return res.json().then(function (data) {
              return { status: res.status, data: data };
            });
          })
          .then(function (result) {
            if (result.status === 401) {
              window.location.href = "login.php";
              return;
            }
            if (!result.data.success) {
              showToast(result.data.message || "Could not load notifications.");
              return;
            }
            allNotifications = result.data.data.notifications || [];
            renderNotifications();
          })
          .catch(function () {
            showToast("Could not reach the server. Is the backend running?");
          });
      }

      function renderNotifications() {
        var unreadList = document.getElementById("unread-list");
        var earlierList = document.getElementById("earlier-list");
        unreadList.innerHTML = "";
        earlierList.innerHTML = "";

        var unread = allNotifications.filter(function (n) { return !n.is_read; });
        var earlier = allNotifications.filter(function (n) { return n.is_read; });

        unread.forEach(function (n) { unreadList.appendChild(buildNotifItem(n)); });
        earlier.forEach(function (n) { earlierList.appendChild(buildNotifItem(n)); });

        document.getElementById("unread-empty").style.display = unread.length ? "none" : "";
        document.getElementById("earlier-empty").style.display = earlier.length ? "none" : "";

        document.getElementById("unread-count").textContent = unread.length;
        document.getElementById("summary-unread").textContent = unread.length;
        document.getElementById("summary-total").textContent = allNotifications.length;

        var navBadge = document.getElementById("notif-badge");
        navBadge.textContent = unread.length;
        navBadge.style.display = unread.length ? "" : "none";
      }

      loadNotifications();

      function readNotif(id, href) {
        var wasUnread = allNotifications.some(function (n) { return n.id === id && !n.is_read; });

        if (wasUnread) {
          fetch("api/get-notifications.php", {
            method: "POST",
            headers: { "Content-Type": "application/json" },
            credentials: "same-origin",
            body: JSON.stringify({ action: "mark-read", notification_id: id }),
          }).catch(function () {
            /* non-critical — worst case it stays marked unread until reload */
          });

          allNotifications = allNotifications.map(function (n) {
            if (n.id === id) n.is_read = true;
            return n;
          });
          renderNotifications();
        }

        if (href) {
          setTimeout(function () {
            window.location.href = href;
          }, 150);
        }
      }

      function markAllRead() {
        fetch("api/get-notifications.php", {
          method: "POST",
          headers: { "Content-Type": "application/json" },
          credentials: "same-origin",
          body: JSON.stringify({ action: "mark-all-read" }),
        })
          .then(function (res) { return res.json(); })
          .then(function (result) {
            if (result.success) {
              allNotifications = allNotifications.map(function (n) {
                n.is_read = true;
                return n;
              });
              renderNotifications();
              showToast("All notifications marked as read.");
            } else {
              showToast(result.message || "Couldn't mark notifications as read.");
            }
          })
          .catch(function () {
            showToast("Could not reach the server. Please try again.");
          });
      }

      // Toggle switches — these are visual-only for now; there's no
      // preferences table in the backend yet to actually persist them.
      ["status", "announce", "email"].forEach(function (key) {
        var el = document.getElementById("pref-" + key);
        el.addEventListener("change", function () {
          var tog = document.getElementById("toggle-" + key);
          var knob = document.getElementById("knob-" + key);
          tog.style.background = el.checked ? "var(--green)" : "var(--border)";
          knob.style.left = el.checked ? "19px" : "3px";
          showToast(el.checked ? "Enabled" : "Disabled");
        });
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
  </body>
</html>