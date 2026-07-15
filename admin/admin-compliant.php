<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>LIRS Connect | All Complaints</title>
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
          <div class="topbar-title">All Complaints</div>
          <div class="topbar-sub">LIRS Connect · Admin Console</div>
        </div>
      </header>

      <div class="content">
        <div class="page-banner">
          <div class="page-banner-text">
            <div class="pb-eyebrow">LIRS Connect · Case Management</div>
            <h2>All Complaints</h2>
            <p>Every complaint submitted across all taxpayers, in one place.</p>
          </div>
          <div class="page-banner-icon">
            <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.4">
              <path d="M4 4h12M4 8h8M4 12h10M4 16h6" />
            </svg>
          </div>
        </div>

        <!-- Summary Strip -->
        <div
          style="
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 12px;
            margin-bottom: 24px;
          "
        >
          <div
            style="
              background: var(--white);
              border: 1px solid var(--border);
              border-radius: 10px;
              padding: 16px;
            "
          >
            <div style="font-size: 22px; font-weight: 700" id="count-all">0</div>
            <div style="font-size: 11.5px; color: var(--text-muted)">Total</div>
          </div>
          <div
            style="
              background: var(--white);
              border: 1px solid var(--border);
              border-radius: 10px;
              padding: 16px;
            "
          >
            <div style="font-size: 22px; font-weight: 700" id="count-new">0</div>
            <div style="font-size: 11.5px; color: var(--text-muted)">New</div>
          </div>
          <div
            style="
              background: var(--white);
              border: 1px solid var(--border);
              border-radius: 10px;
              padding: 16px;
            "
          >
            <div style="font-size: 22px; font-weight: 700" id="count-open">0</div>
            <div style="font-size: 11.5px; color: var(--text-muted)">Open</div>
          </div>
          <div
            style="
              background: var(--white);
              border: 1px solid var(--border);
              border-radius: 10px;
              padding: 16px;
            "
          >
            <div style="font-size: 22px; font-weight: 700" id="count-closed">0</div>
            <div style="font-size: 11.5px; color: var(--text-muted)">Closed</div>
          </div>
        </div>

        <!-- Filter Bar -->
        <div style="display: flex; align-items: center; gap: 10px; margin-bottom: 16px">
          <div style="flex: 1; position: relative">
            <svg
              style="position: absolute; left: 12px; top: 50%; transform: translateY(-50%)"
              width="14"
              height="14"
              viewBox="0 0 20 20"
              fill="none"
              stroke="#6b7a72"
              stroke-width="1.8"
            >
              <circle cx="9" cy="9" r="6" />
              <path d="M15 15l3 3" />
            </svg>
            <input
              class="form-input"
              style="padding-left: 34px"
              type="text"
              id="search-input"
              placeholder="Search by ID, taxpayer name, or TIN..."
            />
          </div>
          <select class="form-select" style="width: 160px" id="status-filter">
            <option value="">All Statuses</option>
            <option value="New">New</option>
            <option value="Open">Open</option>
            <option value="Closed">Closed</option>
          </select>
        </div>

        <div class="panel">
          <div class="panel-head">
            <div class="panel-title">All Complaints</div>
            <span class="badge review" id="showing-label">Showing 0</span>
          </div>
          <div class="table-wrap">
            <table>
              <thead>
                <tr>
                  <th>Complaint ID</th>
                  <th>Taxpayer</th>
                  <th>PayID</th>

                  <th>Category</th>
                  <th>Priority</th>
                  <th>Assigned To</th>
                  <th>Status</th>
                  <th>Date Filed</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody id="complaints-tbody"></tbody>
            </table>
          </div>
          <div
            id="empty-state"
            style="display: none; padding: 40px; text-align: center; color: var(--text-muted)"
          >
            <div style="margin-bottom: 10px; display: flex; justify-content: center">
              <svg viewBox="0 0 20 20" fill="none" stroke="var(--text-muted)" stroke-width="1.4" width="32" height="32">
                <circle cx="9" cy="9" r="6" />
                <path d="M15 15l3 3" />
              </svg>
            </div>
            <div style="font-size: 14px; font-weight: 600; margin-bottom: 4px">No complaints found</div>
            <div style="font-size: 12.5px">Try adjusting your search or filter.</div>
          </div>
        </div>
      </div>
    </div>

    <div class="toast" id="toast"></div>

    <script src="../admin-common.js"></script>
    <script>
      adminInit();

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

      function statusBadgeClass(group) {
        if (group === "New") return "pending";
        if (group === "Open") return "review";
        if (group === "Closed") return "resolved";
        return "pending";
      }

      var searchDebounce;
      document.getElementById("search-input").addEventListener("input", function () {
        clearTimeout(searchDebounce);
        searchDebounce = setTimeout(loadComplaints, 300);
      });
      document.getElementById("status-filter").addEventListener("change", loadComplaints);

      function loadComplaints() {
        var search = document.getElementById("search-input").value.trim();
        var group = document.getElementById("status-filter").value;

        var params = new URLSearchParams();
        params.set("per_page", "50");
        if (search) params.set("search", search);
        if (group) params.set("group", group);

        fetch("../api/admin/get-admincompliants.php?" + params.toString(), { credentials: "same-origin" })
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
              showToast(result.data.message || "Could not load complaints.");
              return;
            }
            renderCounts(result.data.data.counts);
            renderComplaints(result.data.data.complaints);
          })
          .catch(function () {
            showToast("Could not reach the server. Is the backend running?");
          });
      }

      function renderCounts(counts) {
        document.getElementById("count-all").textContent = counts.all;
        document.getElementById("count-new").textContent = counts.new;
        document.getElementById("count-open").textContent = counts.open;
        document.getElementById("count-closed").textContent = counts.closed;
      }

      function renderComplaints(complaints) {
        var tbody = document.getElementById("complaints-tbody");
        tbody.innerHTML = "";

        document.getElementById("showing-label").textContent = "Showing " + complaints.length;

        if (!complaints.length) {
          document.getElementById("empty-state").style.display = "";
          return;
        }
        document.getElementById("empty-state").style.display = "none";

        complaints.forEach(function (c) {
          var row = document.createElement("tr");
          row.innerHTML =
            '<td><span class="cid"></span></td>' +
            "<td></td><td></td><td></td><td></td><td></td>" +
            '<td><span class="badge"></span></td>' +
            "<td></td>" +
            '<td><button class="act-btn view">View</button></td>';

          row.children[0].querySelector(".cid").textContent = c.reference_id;
          row.children[1].textContent = c.taxpayer_name;
          row.children[2].textContent = c.taxpayer_tin || "--";


          row.children[3].textContent = c.category;
          row.children[4].textContent = c.priority;
          row.children[5].textContent = c.assigned_to || "Unassigned";
          var badge = row.children[6].querySelector(".badge");
          badge.textContent = c.status_group;
          badge.classList.add(statusBadgeClass(c.status_group));
          row.children[7].textContent = formatDate(c.created_at);
          row.children[8].querySelector("button").addEventListener("click", function () {
            window.location.href = "admincompliants-details.php?id=" + c.id;
          });

          tbody.appendChild(row);
        });
      }

      loadComplaints();
    </script>
  </body>
</html>