<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>LIRS Connect | Submit Complaint</title>
    <link
      href="https://fonts.googleapis.com/css2?family=DM+Serif+Display:ital@0;1&family=DM+Sans:wght@400;500;600;700&display=swap"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="app.css" />
  </head>
  <body>
    <?php include 'includes/sidebar.php'; ?>

    <div class="main">
      <header class="topbar">
        <div>
          <div class="topbar-title">Submit Complaint</div>
          <div class="topbar-sub">LIRS Connect · Taxpayer Portal</div>
        </div>
      </header>

      <div class="content">
        <div class="page-banner">
          <div class="page-banner-text">
            <div class="pb-eyebrow">LIRS Connect · New Case</div>
            <h2>File a Tax Complaint</h2>
            <p>
              Submit a formal complaint to LIRS and track its progress from your
              dashboard.
            </p>
          </div>
          <div class="page-banner-icon">
            <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.4">
              <rect x="3" y="3" width="14" height="14" rx="2" />
              <path d="M10 7v6M7 10h6" />
            </svg>
          </div>
        </div>

        <div class="two-col">
          <div class="panel">
            <div class="panel-head">
              <div class="panel-title">Complaint Details</div>
            </div>
            <div class="panel-body">
              <form id="complaint-form" style="display: flex; flex-direction: column; gap: 14px">
                <div class="form-grid">
                  <div class="form-group full">
                    <label class="form-label" for="category">Category *</label>
                    <select class="form-select" id="category" name="category" required>
                      <option value="">Select category</option>
                      <option value="assessment">Incorrect Tax Assessment</option>
                      <option value="payment">Payment Verification</option>
                      <option value="refund">Refund Request</option>
                      <option value="tax_clearance">Tax Clearance Certificate</option>
                      <option value="other">Other</option>
                    </select>
                  </div>

                  <div class="form-group full">
                    <label class="form-label" for="subject">Subject *</label>
                    <input
                      class="form-input"
                      id="subject"
                      name="subject"
                      type="text"
                      maxlength="200"
                      placeholder="Briefly describe the issue"
                      required
                    />
                  </div>

                  <div class="form-group full">
                    <label class="form-label" for="description">Description *</label>
                    <textarea
                      class="form-input"
                      id="description"
                      name="description"
                      rows="7"
                      placeholder="Provide enough detail for an officer to review your complaint"
                      style="resize: vertical"
                      required
                    ></textarea>
                  </div>

                  <div class="form-group full">
                    <label class="form-label" for="attachment">Attachment</label>
                    <input
                      class="form-input"
                      id="attachment"
                      name="attachment"
                      type="file"
                      accept=".pdf,.jpg,.jpeg,.png,.doc"
                    />
                  </div>
                </div>

                <div class="form-actions">
                  <button class="btn-primary" id="submit-btn" type="submit">
                    <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.8" width="14" height="14">
                      <path d="M3 10l14-7-7 14V10H3z" />
                    </svg>
                    Submit Complaint
                  </button>
                  <a href="my-complaints.php" class="btn-outline">View My Complaints</a>
                </div>
              </form>
            </div>
          </div>

          <div>
            <div class="panel">
              <div class="panel-head">
                <div class="panel-title">Before You Submit</div>
              </div>
              <div class="office-item">
                <div class="office-name">Use a clear subject</div>
                <div class="office-addr">
                  Keep it short enough to identify the tax issue quickly.
                </div>
              </div>
              <div class="office-item">
                <div class="office-name">Add evidence when available</div>
                <div class="office-addr">
                  Upload payment receipts, assessment notices, or related
                  documents.
                </div>
              </div>
              <div class="office-item">
                <div class="office-name">Track the case after submission</div>
                <div class="office-addr">
                  Your complaint will appear in My Complaints once it is saved.
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="toast" id="toast"></div>

    <script>
      document.addEventListener("DOMContentLoaded", function () {
        loadProfile();
        bindLogout();
        document
          .getElementById("complaint-form")
          .addEventListener("submit", handleComplaintSubmit);
      });

      function loadProfile() {
        fetch("api/get-profile.php", { credentials: "same-origin" })
          .then(function (res) {
            if (res.status === 401) {
              window.location.href = "login.php";
              return null;
            }
            return res.json();
          })
          .then(function (result) {
            if (!result) return;
            var profile = result.data && result.data.profile ? result.data.profile : null;
            if (!profile) return;

            var name = profile.first_name + " " + profile.last_name;
            document.getElementById("sidebar-name").textContent = name;
            document.getElementById("sidebar-av").textContent = initials(name);
            var tin = document.getElementById("sidebar-tin");
            if (tin) {
              tin.textContent = "TIN: " + (profile.tin || "--");
            }
            sessionStorage.setItem("userName", name);
            sessionStorage.setItem("userEmail", profile.email || "");
          })
          .catch(function () {
            showToast("Could not load your profile.");
          });
      }

      function handleComplaintSubmit(e) {
        e.preventDefault();

        var form = document.getElementById("complaint-form");
        var submitBtn = document.getElementById("submit-btn");
        var subject = document.getElementById("subject").value.trim();
        var description = document.getElementById("description").value.trim();

        if (subject.length < 5) {
          showToast("Subject must be at least 5 characters.");
          return;
        }
        if (description.length < 20) {
          showToast("Description must be at least 20 characters.");
          return;
        }

        submitBtn.disabled = true;
        submitBtn.textContent = "Submitting...";

        fetch("api/submit-complaint.php", {
          method: "POST",
          credentials: "same-origin",
          body: new FormData(form),
        })
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

            if (result.data.success) {
              showToast(result.data.message || "Complaint submitted.");
              form.reset();
              setTimeout(function () {
                window.location.href = "my-complaints.php";
              }, 900);
              return;
            }

            showToast(result.data.message || "Could not submit complaint.");
          })
          .catch(function () {
            showToast("Could not reach the server. Please try again.");
          })
          .finally(function () {
            submitBtn.disabled = false;
            submitBtn.textContent = "Submit Complaint";
          });
      }

      function bindLogout() {
        var logout = document.getElementById("logout-btn");
        if (!logout) return;

        logout.addEventListener("click", function (e) {
          e.preventDefault();
          fetch("api/logout.php", {
            method: "POST",
            credentials: "same-origin",
          });
          sessionStorage.clear();
          showToast("Logged out");
          setTimeout(function () {
            window.location.href = "index.html";
          }, 1000);
        });
      }

      function initials(name) {
        return String(name || "User")
          .split(" ")
          .filter(Boolean)
          .map(function (part) {
            return part.charAt(0);
          })
          .join("")
          .toUpperCase()
          .slice(0, 2);
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
