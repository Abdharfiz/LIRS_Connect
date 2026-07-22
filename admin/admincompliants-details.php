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
    <link rel="stylesheet" href="../app.css" />
  </head>
  <body>
    <?php include '../includes/admin-sidebar.php'; ?>

    <div class="main">
      <header class="topbar">
        <div>
          <div class="topbar-title" id="topbar-title">Complaint Detail</div>
          <div class="topbar-sub">LIRS Connect · Admin Console</div>
        </div>
      </header>

      <div class="content">
        <a href="admincomplaint.php" class="back-link">
          <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.8">
            <path d="M12 4 6 10l6 6" />
          </svg>
          Back to All Complaints
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
                  <span class="badge" id="status-badge">--</span>
                </div>
                <div class="desc-box" id="desc-box">—</div>
                <div id="attachment-box" style="margin-top: 12px; display:none">
                  <div class="panel-title" style="font-size: 13px; color: var(--text-muted); margin-bottom: 8px">Attachment</div>
                  <a id="attachment-link" class="btn-primary" target="_blank" rel="noopener" style="display:inline-flex; gap:8px; align-items:center">
                    <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.6" width="16" height="16">
                      <path d="M8.5 9.5 13 5a3 3 0 1 1 4.2 4.2l-6.2 6.2a4.5 4.5 0 0 1-6.4-6.4L10 2" />
                    </svg>
                    View file
                  </a>
                </div>
              </div>


              <div class="panel">
                <div class="panel-head">
                  <div class="panel-title">Responses &amp; Notes</div>
                </div>
                <div id="responses-list"></div>
                <div id="responses-empty" style="display: none; padding: 24px; text-align: center; color: var(--text-muted); font-size: 13px">
                  No responses yet.
                </div>
              </div>

              <div class="panel">
                <div class="panel-head">
                  <div class="panel-title">Add Response</div>
                </div>
                <div class="panel-body" style="display: flex; flex-direction: column; gap: 12px">
                  <textarea
                    class="form-input"
                    id="reply-message"
                    rows="4"
                    placeholder="Write a response to the taxpayer, or an internal note..."
                    style="resize: vertical"
                  ></textarea>
                  <div style="display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 10px">
                    <label style="display: flex; align-items: center; gap: 7px; font-size: 12.5px; color: var(--text-muted); cursor: pointer">
                      <input type="checkbox" id="reply-internal" style="width: 15px; height: 15px" />
                      Internal note only (not visible to taxpayer)
                    </label>
                    <div style="display: flex; align-items: center; gap: 8px">
                      <select class="form-select" id="reply-status" style="width: 170px">
                        <option value="">Keep current status</option>
                        <option value="in_progress">In Progress</option>
                        <option value="resolved">Resolved</option>
                        <option value="rejected">Rejected</option>
                        <option value="closed">Closed</option>
                      </select>
                      <button class="btn-primary" id="reply-submit" onclick="submitReply()">
                        <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.8" width="14" height="14">
                          <path d="M3 10h14M11 4l6 6-6 6" />
                        </svg>
                        Send
                      </button>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div style="display: flex; flex-direction: column; gap: 16px">
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
                    <div class="m-label">Priority</div>
                    <div class="m-value" id="m-priority">--</div>
                  </div>
                  <div class="detail-meta-item">
                    <div class="m-label">Status</div>
                    <div class="m-value" id="m-status">--</div>
                  </div>
                  <div class="detail-meta-item">
                    <div class="m-label">Assigned To</div>
                    <div class="m-value" id="m-assigned">--</div>
                  </div>
                </div>
              </div>

              <div class="panel">
                <div class="panel-head">
                  <div class="panel-title">Taxpayer</div>
                </div>
                <div class="detail-meta-grid">
                  <div class="detail-meta-item" style="grid-column: 1 / -1">
                    <div class="m-label">Name</div>
                    <div class="m-value" id="tp-name">--</div>
                  </div>
                  <div class="detail-meta-item">
                    <div class="m-label">Email</div>
                    <div class="m-value" id="tp-email">--</div>
                  </div>
                  <div class="detail-meta-item">
                    <div class="m-label">Phone</div>
                    <div class="m-value" id="tp-phone">--</div>
                  </div>
                  <div class="detail-meta-item">
                    <div class="m-label">TIN</div>
                    <div class="m-value" id="tp-tin">--</div>
                  </div>
                  <div class="detail-meta-item">
                    <div class="m-label">PayID</div>
                    <div class="m-value" id="tp-payid">--</div>
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
              <div style="font-size: 15px; font-weight: 700; margin-bottom: 6px" id="not-found-title">Complaint not found</div>
              <div style="font-size: 13px" id="not-found-text">We couldn't find a complaint matching that ID.</div>
              <div style="margin-top: 18px">
                <a href="admincomplaint.php" class="btn-primary" style="display: inline-flex">Back to All Complaints</a>
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

      var complaintId = new URLSearchParams(window.location.search).get("id");

      function statusBadgeClass(rawStatus) {
        if (rawStatus === "resolved") return "resolved";
        if (rawStatus === "rejected") return "danger";
        if (rawStatus === "closed") return "info";
        if (rawStatus === "in_progress") return "review";
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

      function loadComplaint() {
        if (!complaintId) {
          showNotFound("Complaint not found", "No complaint ID was provided in the link.");
          return;
        }

        fetch("../api/admin/get-admincompliants-detail.php?id=" + encodeURIComponent(complaintId), {
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
            if (data.success && payload.complaint) {
              renderComplaint(payload.complaint, payload.taxpayer, payload.responses || []);
              return;
            }
            if (result.status === 404) {
              showNotFound("Complaint not found", "We couldn't find a complaint matching that ID.");
              return;
            }
            if (result.status === 401) {
              window.location.href = "../login.php";
              return;
            }
            showNotFound("Something went wrong", data.message || "We couldn't load this complaint right now.");
          })
          .catch(function () {
            showNotFound("Connection problem", "Couldn't reach the server. Check your connection and try again.");
          });
      }

      function renderComplaint(c, taxpayer, responses) {
        document.getElementById("topbar-title").textContent = c.reference_id + " · " + c.subject;
        document.getElementById("pb-cid").textContent = "LIRS Connect · " + c.reference_id;
        document.getElementById("pb-subject").textContent = c.subject;
        document.getElementById("pb-meta").textContent = c.category + " · Filed " + formatDate(c.created_at);

        var badge = document.getElementById("status-badge");
        badge.textContent = c.status + (c.is_mine ? " · Assigned to you" : "");
        badge.className = "badge " + statusBadgeClass(c.status_raw);

        document.getElementById("desc-box").textContent = c.description;

        // Attachment (admin view)
        var attachmentBox = document.getElementById("attachment-box");
        var attachmentLink = document.getElementById("attachment-link");
        if (c.attachment_url) {
          attachmentBox.style.display = "";
          attachmentLink.href = c.attachment_url;
        } else {
          attachmentBox.style.display = "none";
          attachmentLink.href = "";
        }


        document.getElementById("m-cid").textContent = c.reference_id;
        document.getElementById("m-category").textContent = c.category;
        document.getElementById("m-date").textContent = formatDate(c.created_at);
        document.getElementById("m-priority").textContent = c.priority;
        document.getElementById("m-status").textContent = c.status;
        document.getElementById("m-assigned").textContent = c.assigned_to || "Unassigned";

        document.getElementById("tp-name").textContent = taxpayer.name;
        document.getElementById("tp-email").textContent = taxpayer.email;
        document.getElementById("tp-phone").textContent = taxpayer.phone || "--";
        document.getElementById("tp-tin").textContent = taxpayer.tin || "--";
        document.getElementById("tp-payid").textContent = taxpayer.pay_id || "--";

        renderResponses(responses);
      }

      function renderResponses(responses) {
        var list = document.getElementById("responses-list");
        list.innerHTML = "";

        if (!responses.length) {
          document.getElementById("responses-empty").style.display = "";
          return;
        }
        document.getElementById("responses-empty").style.display = "none";

        responses.forEach(function (r) {
          var isTaxpayer = r.sender_type === "taxpayer";
          var div = document.createElement("div");
          div.className = "response-item";
          div.style.cursor = "default";
          div.style.borderLeft = isTaxpayer
            ? "3px solid var(--blue, #1d4ed8)"
            : (r.is_internal ? "3px solid var(--amber, #d97706)" : "3px solid var(--green, #10b981)");

          div.innerHTML =
            '<div class="resp-meta"><span class="resp-cid"></span><span class="resp-date"></span></div>' +
            '<div class="resp-preview"></div>';

          var cidSpan = div.querySelector(".resp-cid");
          cidSpan.textContent = r.admin_name + (r.is_internal ? " (internal note)" : "");
          div.querySelector(".resp-date").textContent = r.created_at_label;
          div.querySelector(".resp-preview").textContent = r.message;

          list.appendChild(div);
        });
      }

      function submitReply() {
        var message = document.getElementById("reply-message").value.trim();
        var isInternal = document.getElementById("reply-internal").checked;
        var status = document.getElementById("reply-status").value;

        if (!message && !status) {
          showToast("Write a message or choose a new status first.");
          return;
        }

        var btn = document.getElementById("reply-submit");
        btn.disabled = true;

        fetch("../api/admin/respond-compliant.php", {
          method: "POST",
          headers: { "Content-Type": "application/json" },
          credentials: "same-origin",
          body: JSON.stringify({
            complaint_id: complaintId,
            message: message,
            is_internal: isInternal,
            status: status,
          }),
        })
          .then(function (res) { return res.json(); })
          .then(function (result) {
            btn.disabled = false;
            if (result.success) {
              document.getElementById("reply-message").value = "";
              document.getElementById("reply-internal").checked = false;
              document.getElementById("reply-status").value = "";
              showToast("Saved.");
              loadComplaint();
            } else {
              showToast(result.message || "Could not save response.");
            }
          })
          .catch(function () {
            btn.disabled = false;
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

      loadComplaint();
    </script>
  </body>
</html>