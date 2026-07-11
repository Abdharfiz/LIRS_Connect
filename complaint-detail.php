<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>LIRS Connect | Complaint Detail</title>
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
          <div class="topbar-title" id="topbar-title">Complaint Detail</div>
          <div class="topbar-sub">LIRS Connect · Taxpayer Portal</div>
        </div>
      </header>

      <div class="content">
        <a href="my-complaints.php" class="back-link">
          <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.8">
            <path d="M12 4 6 10l6 6" />
          </svg>
          Back to My Complaints
        </a>

        <div id="detail-view">
          <div class="page-banner">
            <div class="page-banner-text">
              <div class="pb-eyebrow" id="pb-cid">LIRS Connect · Loading...</div>
              <h2 id="pb-subject">Loading complaint...</h2>
              <p id="pb-meta">Filed on --</p>
            </div>
            <div class="page-banner-icon">
              <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.4">
                <rect x="4" y="2" width="12" height="16" rx="1.5" />
                <path d="M7 6h6M7 9h6M7 12h4" />
              </svg>
            </div>
          </div>

          <div class="two-col">
            <div style="display: flex; flex-direction: column; gap: 16px">
              <div class="panel">
                <div class="panel-head">
                  <div class="panel-title">Complaint Description</div>
                  <span class="badge" id="status-badge">Pending</span>
                </div>
                <div class="desc-box" id="desc-box">—</div>
              </div>

              <div class="panel">
                <div class="panel-head">
                  <div class="panel-title">Status Timeline</div>
                </div>
                <div class="timeline" id="timeline"></div>
              </div>

              <div class="panel" id="response-panel" style="display: none">
                <div class="panel-head">
                  <div class="panel-title">Response from LIRS Officer</div>
                </div>
                <div class="response-item" style="cursor: default">
                  <div class="resp-meta">
                    <span class="resp-cid" id="resp-officer">Officer</span>
                    <span class="resp-date" id="resp-date">--</span>
                  </div>
                  <div class="resp-preview" id="resp-body">—</div>
                </div>
              </div>
            </div>

            <div>
              <div class="panel">
                <div class="panel-head">
                  <div class="panel-title">Complaint Details</div>
                </div>
                <div class="detail-meta-grid">
                  <div class="detail-meta-item">
                    <div class="m-label">Complaint ID</div>
                    <div class="m-value" id="m-cid">--</div>
                  </div>
                  <div class="detail-meta-item">
                    <div class="m-label">Category</div>
                    <div class="m-value" id="m-category">--</div>
                  </div>
                  <div class="detail-meta-item">
                    <div class="m-label">Date Filed</div>
                    <div class="m-value" id="m-date">--</div>
                  </div>
                  <div class="detail-meta-item">
                    <div class="m-label">Status</div>
                    <div class="m-value" id="m-status">--</div>
                  </div>
                
                  <div class="detail-meta-item">
                    <div class="m-label">TIN on File</div>
                    <div class="m-value" id="m-tin">--</div>
                  </div>
                </div>
              </div>
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
              <div style="font-size: 15px; font-weight: 700; margin-bottom: 6px; color: var(--text-dark)" id="not-found-title">
                Complaint not found
              </div>
              <div style="font-size: 13px" id="not-found-text">
                We couldn't find a complaint matching that ID.
              </div>
              <div style="margin-top: 18px">
                <a href="my-complaints.php" class="btn-primary" style="display: inline-flex">
                  Back to My Complaints
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="toast" id="toast"></div>

    <script>
      function init() {
        loadProfile();

        var params = new URLSearchParams(window.location.search);
        var id = params.get("id");

        if (!id) {
          showNotFound("Complaint not found", "No complaint ID was provided in the link.");
          return;
        }

        // Fetch complaint details from API
        fetch("api/get-complaint-detail.php?id=" + encodeURIComponent(id), {
          credentials: "same-origin"
        })
          .then(function(res) {
            return res.json().then(function(data) {
              return { status: res.status, data: data };
            });
          })
          .then(function(result) {
            var data = result.data;
            var payload = data.data || {};
            if (data.success && payload.complaint) {
              renderComplaint(payload.complaint, payload.responses || []);
              return;
            }

            if (result.status === 404) {
              showNotFound(
                "Complaint not found",
                "We couldn't find a complaint matching that ID."
              );
              return;
            }

            if (result.status === 401) {
              // Session expired / not logged in — send them to log back in
              // rather than leaving them stuck on a page that can't load.
              window.location.href = "login.php";
              return;
            }

            // Any other failure (500, etc.) — show a real error state
            // instead of leaving the page stuck on "Loading complaint...".
            showNotFound(
              "Something went wrong",
              data.message || "We couldn't load this complaint right now. Please try again."
            );
          })
          .catch(function(err) {
            console.error("Fetch error:", err);
            showNotFound(
              "Connection problem",
              "Couldn't reach the server. Check your connection and try again."
            );
          });
      }

      function showNotFound(title, text) {
        document.getElementById("detail-view").style.display = "none";
        document.getElementById("not-found-title").textContent = title;
        document.getElementById("not-found-text").textContent = text;
        document.getElementById("not-found").style.display = "";
      }

      function loadProfile() {
        fetch("api/get-profile.php", { credentials: "same-origin" })
          .then(function (res) {
            return res.json();
          })
          .then(function (data) {
            var profile = data.data && data.data.profile ? data.data.profile : null;
            if (profile && profile.tin) {
              document.getElementById("m-tin").textContent = profile.tin;
            }
          })
          .catch(function () {
            // Leave the placeholder if profile lookup fails.
          });
      }

      function renderComplaint(c, responses) {
        // Update header
        document.getElementById("topbar-title").textContent = c.reference_id + " · " + c.subject;
        document.getElementById("pb-cid").textContent = "LIRS Connect · " + c.reference_id;
        document.getElementById("pb-subject").textContent = c.subject;
        
        var dateStr = formatDate(c.created_at);
        document.getElementById("pb-meta").textContent = c.category + " · Filed " + dateStr;

        // Update status badge
        var badge = document.getElementById("status-badge");
        badge.textContent = c.status;
        badge.className = "badge " + statusClass(c.status);

        // Update description
        document.getElementById("desc-box").textContent = c.description;

        // Update metadata
        document.getElementById("m-cid").textContent = c.reference_id;
        document.getElementById("m-category").textContent = c.category;
        document.getElementById("m-date").textContent = dateStr;
        document.getElementById("m-status").textContent = c.status;


        // Timeline
        var tl = document.getElementById("timeline");
        tl.innerHTML = "";
        
        // Create timeline steps
        var timelineSteps = [
          { title: "Complaint submitted", time: dateStr, done: true }
        ];
        
        if (c.status === "Under Review") {
          timelineSteps.push({ title: "Assigned for review", time: "In progress", done: false });
        } else if (c.status === "Resolved") {
          timelineSteps.push({ title: "Assigned for review", time: "Completed", done: true });
         
        } else if (c.status === "Rejected") {
          timelineSteps.push({ title: "Complaint reviewed", time: "Completed", done: true });
          timelineSteps.push({ title: "Complaint rejected", time: "—", done: true });
        }
        
        timelineSteps.forEach(function (step) {
          var item = document.createElement("div");
          item.className = "timeline-item" + (step.done ? "" : " pending");
          item.innerHTML =
            '<div class="timeline-rail"><div class="timeline-dot"></div><div class="timeline-line"></div></div>' +
            '<div class="timeline-body"><div class="timeline-title">' +
            step.title +
            '</div><div class="timeline-time">' +
            step.time +
            "</div></div>";
          tl.appendChild(item);
        });

        // Show response if available
        if (responses && responses.length > 0) {
          document.getElementById("response-panel").style.display = "";
          var resp = responses[0];
          document.getElementById("resp-officer").textContent = resp.admin_name || "LIRS Officer";
          document.getElementById("resp-date").textContent = formatDate(resp.created_at);
          document.getElementById("resp-body").textContent = resp.message;
        }
      }

      function formatDate(dateStr) {
        var d = new Date(dateStr);
        var day = String(d.getDate()).padStart(2, '0');
        var month = String(d.getMonth() + 1).padStart(2, '0');
        var year = d.getFullYear();
        return day + '/' + month + '/' + year;
      }

      function statusClass(status) {
        var normalized = (status || "").toLowerCase();
        if (normalized === "new" || normalized === "pending") return "pending";
        if (normalized === "under review") return "review";
        if (normalized === "resolved") return "resolved";
        if (normalized === "rejected") return "rejected";
        if (normalized === "closed") return "closed";
        return "pending";
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

      init();
    </script>
  </body>
</html>