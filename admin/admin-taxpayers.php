<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>LIRS Connect | Taxpayers</title>
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
          <div class="topbar-title">Taxpayers</div>
          <div class="topbar-sub">LIRS Connect · Admin Console</div>
        </div>
      </header>

      <div class="content">
        <div class="page-banner">
          <div class="page-banner-text">
            <div class="pb-eyebrow">LIRS Connect · Taxpayer Management</div>
            <h2>Registered Taxpayers</h2>
            <p>Every taxpayer registered on the platform, in one place.</p>
          </div>
          <div class="page-banner-icon">
            <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.4">
              <circle cx="10" cy="7" r="3.5" />
              <path d="M3 17c0-3.3 3.1-6 7-6s7 2.7 7 6" />
            </svg>
          </div>
        </div>

        <!-- Summary Strip -->
        <div
          style="
            display: grid;
            grid-template-columns: repeat(3, 1fr);
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
            <div style="font-size: 11.5px; color: var(--text-muted)">Total Taxpayers</div>
          </div>
          <div
            style="
              background: var(--white);
              border: 1px solid var(--border);
              border-radius: 10px;
              padding: 16px;
            "
          >
            <div style="font-size: 22px; font-weight: 700" id="count-active">0</div>
            <div style="font-size: 11.5px; color: var(--text-muted)">Active</div>
          </div>
          <div
            style="
              background: var(--white);
              border: 1px solid var(--border);
              border-radius: 10px;
              padding: 16px;
            "
          >
            <div style="font-size: 22px; font-weight: 700" id="count-inactive">0</div>
            <div style="font-size: 11.5px; color: var(--text-muted)">Inactive</div>
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
              placeholder="Search by name, TIN, email, or phone..."
            />
          </div>
          <select class="form-select" style="width: 160px" id="status-filter">
            <option value="">All Statuses</option>
            <option value="active">Active</option>
            <option value="deactivated">Inactive</option>
          </select>
        </div>

        <div class="panel">
          <div class="panel-head">
            <div class="panel-title">All Taxpayers</div>
            <span class="badge review" id="showing-label">Showing 0</span>
          </div>
          <div class="table-wrap">
            <table>
              <thead>
                <tr>
                  <th>Name</th>
                  <th>TIN</th>
                  <th>Email</th>
                  <th>Phone</th>
                  <th>Registered</th>
                  <th>Complaints</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody id="taxpayers-tbody"></tbody>
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
            <div style="font-size: 14px; font-weight: 600; margin-bottom: 4px">No taxpayers found</div>
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

      function statusBadgeClass(status) {
        return status === "Active" ? "resolved" : "danger";
      }

      var searchDebounce;
      document.getElementById("search-input").addEventListener("input", function () {
        clearTimeout(searchDebounce);
        searchDebounce = setTimeout(loadTaxpayers, 300);
      });
      document.getElementById("status-filter").addEventListener("change", loadTaxpayers);

      function loadTaxpayers() {
        var search = document.getElementById("search-input").value.trim();
        var status = document.getElementById("status-filter").value;

        var params = new URLSearchParams();
        params.set("per_page", "50");
        if (search) params.set("search", search);
        if (status) params.set("status", status);

        fetch("../api/admin/get-admintaxpayers.php?" + params.toString(), { credentials: "same-origin" })
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
              showToast(result.data.message || "Could not load taxpayers.");
              return;
            }
            renderCounts(result.data.data.counts);
            renderTaxpayers(result.data.data.taxpayers);
          })
          .catch(function () {
            showToast("Could not reach the server. Is the backend running?");
          });
      }

      function renderCounts(counts) {
        document.getElementById("count-all").textContent = counts.all;
        document.getElementById("count-active").textContent = counts.active;
        document.getElementById("count-inactive").textContent = counts.inactive;
      }

      function renderTaxpayers(taxpayers) {
        var tbody = document.getElementById("taxpayers-tbody");
        tbody.innerHTML = "";

        document.getElementById("showing-label").textContent = "Showing " + taxpayers.length;

        if (!taxpayers.length) {
          document.getElementById("empty-state").style.display = "";
          return;
        }
        document.getElementById("empty-state").style.display = "none";

        taxpayers.forEach(function (t) {
          var row = document.createElement("tr");
          row.style.cursor = "pointer";
          row.innerHTML =
            "<td></td><td></td><td></td><td></td><td></td><td></td>" +
            '<td><span class="badge"></span></td>' +
            '<td><button class="act-btn view">View</button></td>';

          row.children[0].textContent = t.name;
          row.children[1].textContent = t.tin || "--";
          row.children[2].textContent = t.email;
          row.children[3].textContent = t.phone || "--";
          row.children[4].textContent = t.created_at_label;
          row.children[5].textContent = t.complaints_count;
          var badge = row.children[6].querySelector(".badge");
          badge.textContent = t.status;
          badge.classList.add(statusBadgeClass(t.status));

          function goToDetail() {
            window.location.href = "admin-taxpayer-detail.php?id=" + t.id;
          }
          row.children[7].querySelector("button").addEventListener("click", function (e) {
            e.stopPropagation();
            goToDetail();
          });
          row.addEventListener("click", goToDetail);

          tbody.appendChild(row);
        });
      }

      loadTaxpayers();
    </script>
  </body>
</html>
