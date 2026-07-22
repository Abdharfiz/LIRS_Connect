<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>LIRS Connect | Taxpayer Detail</title>
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
          <div class="topbar-title" id="topbar-title">Taxpayer Detail</div>
          <div class="topbar-sub">LIRS Connect · Admin Console</div>
        </div>
      </header>

      <div class="content">
        <a href="admin-taxpayers.php" class="back-link">
          <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.8">
            <path d="M12 4 6 10l6 6" />
          </svg>
          Back to Taxpayers
        </a>

        <div id="detail-view">
          <div class="page-banner">
            <div class="page-banner-text">
              <div class="pb-eyebrow" id="pb-eyebrow">LIRS Connect · Loading...</div>
              <h2 id="pb-name">Loading taxpayer...</h2>
              <p id="pb-meta">Registered on --</p>
            </div>
            <div class="page-banner-icon">
              <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.4">
                <circle cx="10" cy="7" r="3.5" />
                <path d="M3 17c0-3.3 3.1-6 7-6s7 2.7 7 6" />
              </svg>
            </div>
          </div>

          <div class="two-col">
            <div style="display: flex; flex-direction: column; gap: 16px">
              <div class="panel">
                <div class="panel-head">
                  <div class="panel-title">Taxpayer Information</div>
                  <span class="badge" id="status-badge">--</span>
                </div>
                <div class="detail-meta-grid">
                  <div class="detail-meta-item" style="grid-column: 1 / -1">
                    <div class="m-label">Full Name</div>
                    <div class="m-value" id="m-name">--</div>
                  </div>
                  <div class="detail-meta-item">
                    <div class="m-label">Email</div>
                    <div class="m-value" id="m-email">--</div>
                  </div>
                  <div class="detail-meta-item">
                    <div class="m-label">Phone</div>
                    <div class="m-value" id="m-phone">--</div>
                  </div>
                  <div class="detail-meta-item">
                    <div class="m-label">TIN</div>
                    <div class="m-value" id="m-tin">--</div>
                  </div>
                  <div class="detail-meta-item">
                    <div class="m-label">PayID</div>
                    <div class="m-value" id="m-payid">--</div>
                  </div>
                  <div class="detail-meta-item" style="grid-column: 1 / -1">
                    <div class="m-label">Address</div>
                    <div class="m-value" id="m-address">--</div>
                  </div>
                  <div class="detail-meta-item">
                    <div class="m-label">Registration Date</div>
                    <div class="m-value" id="m-registered">--</div>
                  </div>
                  <div class="detail-meta-item">
                    <div class="m-label">Complaints Submitted</div>
                    <div class="m-value" id="m-count">--</div>
                  </div>
                </div>
              </div>
            </div>

            <div style="display: flex; flex-direction: column; gap: 16px">
              <div class="panel">
                <div class="panel-head">
                  <div class="panel-title">At a Glance</div>
                </div>
                <div class="detail-meta-grid">
                  <div class="detail-meta-item">
                    <div class="m-label">Account Status</div>
                    <div class="m-value" id="m-status">--</div>
                  </div>
                  <div class="detail-meta-item">
                    <div class="m-label">LGA</div>
                    <div class="m-value" id="m-lga">--</div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="panel" style="margin-top: 16px">
            <div class="panel-head">
              <div class="panel-title">Complaints History</div>
              <span class="badge review" id="complaints-count-label">0 complaints</span>
            </div>
            <div class="table-wrap">
              <table>
                <thead>
                  <tr>
                    <th>Complaint ID</th>
                    <th>Category</th>
                    <th>Title</th>
                    <th>Date Submitted</th>
                    <th>Status</th>
                    <th>Priority</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody id="complaints-tbody"></tbody>
              </table>
            </div>
            <div
              id="complaints-empty"
              style="display: none; padding: 40px; text-align: center; color: var(--text-muted)"
            >
              <div style="font-size: 14px; font-weight: 600; margin-bottom: 4px">No complaints submitted</div>
              <div style="font-size: 12.5px">This taxpayer hasn't filed any complaints yet.</div>
            </div>
          </div>
        </div>

        <div id="not-found" style="display: none">
          <div class="panel">
            <div style="padding: 60px 40px; text-align: center; color: var(--text-muted)">
              <div style="display: flex; justify-content: center; margin-bottom: 14px">
                <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.4" width="36" height="36">
                  <circle cx="9" cy="9" r="6" />
                  <path d="M15 15l3 3" />
                </svg>
              </div>
              <div style="font-size: 15px; font-weight: 700; margin-bottom: 6px" id="not-found-title">Taxpayer not found</div>
              <div style="font-size: 13px" id="not-found-text">We couldn't find a taxpayer matching that ID.</div>
              <div style="margin-top: 18px">
                <a href="admin-taxpayers.php" class="btn-primary" style="display: inline-flex">Back to Taxpayers</a>
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

      var taxpayerId = new URLSearchParams(window.location.search).get("id");

      function statusBadgeClass(rawStatus) {
        return rawStatus === "active" ? "resolved" : "danger";
      }

      function complaintStatusBadgeClass(rawStatus) {
        if (rawStatus === "resolved") return "resolved";
        if (rawStatus === "rejected") return "danger";
        if (rawStatus === "closed") return "info";
        if (rawStatus === "in_progress") return "review";
        if (rawStatus === "returned") return "danger";
        return "pending"; // new
      }

      function formatDate(dateStr) {
        if (!dateStr) return "--";
        var d = new Date(dateStr);
        var day = String(d.getDate()).padStart(2, "0");
        var month = String(d.getMonth() + 1).padStart(2, "0");
        var year = d.getFullYear();
        return day + "/" + month + "/" + year;
      }

      function showNotFound(title, text) {
        document.getElementById("detail-view").style.display = "none";
        document.getElementById("not-found-title").textContent = title;
        document.getElementById("not-found-text").textContent = text;
        document.getElementById("not-found").style.display = "";
      }

      function loadTaxpayer() {
        if (!taxpayerId) {
          showNotFound("Taxpayer not found", "No taxpayer ID was provided in the link.");
          return;
        }

        fetch("../api/admin/get-admintaxpayer-detail.php?id=" + encodeURIComponent(taxpayerId), {
          credentials: "same-origin",
        })
          .then(function (res) {
            return res.json().then(function (data) {
              return { status: res.status, data: data };
            });
          })
          .then(function (result) {
            var data = result.data;
            var payload = data.data || {};
            if (data.success && payload.taxpayer) {
              renderTaxpayer(payload.taxpayer, payload.complaints || []);
              return;
            }
            if (result.status === 404) {
              showNotFound("Taxpayer not found", "We couldn't find a taxpayer matching that ID.");
              return;
            }
            if (result.status === 401) {
              window.location.href = "../login.php";
              return;
            }
            showNotFound("Something went wrong", data.message || "We couldn't load this taxpayer right now.");
          })
          .catch(function () {
            showNotFound("Connection problem", "Couldn't reach the server. Check your connection and try again.");
          });
      }

      function renderTaxpayer(t, complaints) {
        document.getElementById("topbar-title").textContent = t.name;
        document.getElementById("pb-eyebrow").textContent = "LIRS Connect · Taxpayer Profile";
        document.getElementById("pb-name").textContent = t.name;
        document.getElementById("pb-meta").textContent = "Registered " + formatDate(t.created_at) + " · TIN " + (t.tin || "--");

        var badge = document.getElementById("status-badge");
        badge.textContent = t.status;
        badge.className = "badge " + statusBadgeClass(t.status_raw);

        document.getElementById("m-name").textContent = t.name;
        document.getElementById("m-email").textContent = t.email;
        document.getElementById("m-phone").textContent = t.phone || "--";
        document.getElementById("m-tin").textContent = t.tin || "--";
        document.getElementById("m-payid").textContent = t.pay_id || "--";
        document.getElementById("m-address").textContent = t.address || "--";
        document.getElementById("m-registered").textContent = formatDate(t.created_at);
        document.getElementById("m-count").textContent = t.complaints_count;
        document.getElementById("m-status").textContent = t.status;
        document.getElementById("m-lga").textContent = t.lga || "--";

        renderComplaints(complaints);
      }

      function renderComplaints(complaints) {
        var tbody = document.getElementById("complaints-tbody");
        tbody.innerHTML = "";

        document.getElementById("complaints-count-label").textContent =
          complaints.length + (complaints.length === 1 ? " complaint" : " complaints");

        if (!complaints.length) {
          document.getElementById("complaints-empty").style.display = "";
          return;
        }
        document.getElementById("complaints-empty").style.display = "none";

        complaints.forEach(function (c) {
          var row = document.createElement("tr");
          row.innerHTML =
            '<td><span class="cid"></span></td>' +
            "<td></td><td></td><td></td>" +
            '<td><span class="badge"></span></td>' +
            "<td></td>" +
            '<td><button class="act-btn view">View</button></td>';

          row.children[0].querySelector(".cid").textContent = c.reference_id;
          row.children[1].textContent = c.category;
          row.children[2].textContent = c.subject;
          row.children[3].textContent = formatDate(c.created_at);
          var badge = row.children[4].querySelector(".badge");
          badge.textContent = c.status;
          badge.classList.add(complaintStatusBadgeClass(c.status_raw));
          row.children[5].textContent = c.priority;
          row.children[6].querySelector("button").addEventListener("click", function () {
            window.location.href = "admincompliants-details.php?id=" + c.id;
          });

          tbody.appendChild(row);
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

      loadTaxpayer();
    </script>
  </body>
</html>
