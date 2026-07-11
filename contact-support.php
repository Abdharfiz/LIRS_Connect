<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>LIRS Connect | Contact Support</title>
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
          <div class="topbar-title">Contact Support</div>
          <div class="topbar-sub">LIRS Connect · Taxpayer Portal</div>
        </div>
      </header>

      <div class="content">
        <div class="page-banner">
          <div class="page-banner-text">
            <div class="pb-eyebrow">LIRS Connect · Help &amp; Support</div>
            <h2>Talk to an LIRS Officer</h2>
            <p>
              Reach the Lagos Internal Revenue Service directly for anything
              that isn't a formal complaint — general enquiries, guidance, or
              help using this portal.
            </p>
          </div>
          <div class="page-banner-icon">
            <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.4">
              <path d="M6.8 3.5c.5 0 1 .3 1.2.8l.7 1.7a1.3 1.3 0 0 1-.3 1.4l-.9.9c.6 1.5 1.8 2.7 3.3 3.3l.9-.9a1.3 1.3 0 0 1 1.4-.3l1.7.7c.5.2.8.7.8 1.2v1.5c0 .8-.7 1.5-1.5 1.4-5.4-.6-9.7-4.9-10.3-10.3-.1-.8.6-1.5 1.4-1.5h1.5z" />
            </svg>
          </div>
        </div>

        <div class="support-grid">
          <div class="support-card">
            <div class="support-icon">
              <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.5">
                <path d="M6.8 3.5c.5 0 1 .3 1.2.8l.7 1.7a1.3 1.3 0 0 1-.3 1.4l-.9.9c.6 1.5 1.8 2.7 3.3 3.3l.9-.9a1.3 1.3 0 0 1 1.4-.3l1.7.7c.5.2.8.7.8 1.2v1.5c0 .8-.7 1.5-1.5 1.4-5.4-.6-9.7-4.9-10.3-10.3-.1-.8.6-1.5 1.4-1.5h1.5z" />
              </svg>
            </div>
            <div class="support-title">Call the Contact Centre</div>
            <div class="support-desc">
              Mon–Fri, 8:00 AM – 5:00 PM for general enquiries and guidance.
            </div>
            <div class="support-value">0700 CALL LIRS (0700 2255 5477)</div>
          </div>
          <div class="support-card">
            <div class="support-icon">
              <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.5">
                <rect x="2" y="4" width="16" height="12" rx="2" />
                <path d="m2.5 5 7.5 6 7.5-6" />
              </svg>
            </div>
            <div class="support-title">Email Us</div>
            <div class="support-desc">
              We typically respond to email enquiries within 2 working days.
            </div>
            <div class="support-value">support@lirs.gov.ng</div>
          </div>
          <div class="support-card">
            <div class="support-icon">
              <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.5">
                <path d="M10 2a6 6 0 0 0-6 6c0 5-2 6-2 6h16s-2-1-2-6a6 6 0 0 0-6-6z" />
                <path d="M11.7 17a2 2 0 0 1-3.4 0" />
              </svg>
            </div>
            <div class="support-title">Formal Complaint</div>
            <div class="support-desc">
              Have a specific tax issue? File it as a tracked complaint
              instead.
            </div>
            <a
              href="submit-complaint.php"
              class="support-value"
              style="text-decoration: none"
              >Submit a complaint →</a
            >
          </div>
        </div>

        <div class="two-col">
          <div class="panel">
            <div class="panel-head">
              <div class="panel-title">Send a Message</div>
            </div>
            <div class="panel-body">
              <form
                onsubmit="handleSupportSubmit(event)"
                style="display: flex; flex-direction: column; gap: 14px"
              >
                <div class="form-grid">
                  <div class="form-group">
                    <label class="form-label">Full Name *</label>
                    <input
                      class="form-input"
                      id="sup-name"
                      type="text"
                      value=""
                    />
                  </div>
                  <div class="form-group">
                    <label class="form-label">Email Address *</label>
                    <input
                      class="form-input"
                      id="sup-email"
                      type="email"
                      value=""
                    />
                  </div>
                  <div class="form-group full">
                    <label class="form-label">Topic</label>
                    <select class="form-select" id="sup-topic">
                      <option>General Enquiry</option>
                      <option>Portal / Login Issue</option>
                      <option>Guidance on a Tax Process</option>
                      <option>Other</option>
                    </select>
                  </div>
                  <div class="form-group full">
                    <label class="form-label">Message *</label>
                    <textarea
                      class="form-input"
                      id="sup-message"
                      rows="5"
                      placeholder="How can we help?"
                      style="resize: vertical"
                    ></textarea>
                  </div>
                </div>
                <div class="form-actions">
                  <button class="btn-primary" type="submit">
                    <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.8" width="14" height="14">
                      <path d="M3 10l14-7-7 14V10H3z" />
                    </svg>
                    Send Message
                  </button>
                </div>
              </form>
            </div>
          </div>

          <div>
            <div class="panel">
              <div class="panel-head">
                <div class="panel-title">LIRS Offices</div>
              </div>
              <div class="office-item">
                <div class="office-name">Head Office — Alausa</div>
                <div class="office-addr">
                  Block 4, Adeyemi Bero Close, Alausa, Ikeja, Lagos.
                </div>
                <div class="office-hours">Open Mon–Fri · 8:00 AM – 4:00 PM</div>
              </div>
              <div class="office-item">
                <div class="office-name">Island Tax Office</div>
                <div class="office-addr">
                  12 Odunlami Street, Lagos Island, Lagos.
                </div>
                <div class="office-hours">Open Mon–Fri · 8:00 AM – 4:00 PM</div>
              </div>
              <div class="office-item">
                <div class="office-name">Mainland Tax Office</div>
                <div class="office-addr">
                  4 Town Planning Way, Ilupeju, Lagos.
                </div>
                <div class="office-hours">Open Mon–Fri · 8:00 AM – 4:00 PM</div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="toast" id="toast"></div>

    <script>
      fetch("api/get-profile.php", { credentials: "same-origin" })
        .then(function (res) { return res.json(); })
        .then(function (result) {
          var profile = result.data && result.data.profile ? result.data.profile : null;
          if (profile) {
            document.getElementById("sup-name").value = profile.first_name + " " + profile.last_name;
            document.getElementById("sup-email").value = profile.email;
          }
        })
        .catch(function () {
          // Leave fields blank if profile lookup fails — not critical here.
        });

      var userName = sessionStorage.getItem("userName") || "User";
      var userEmail =
        sessionStorage.getItem("userEmail") || "abdulhafeez@example.com";

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
      document.getElementById("sup-name").value = userName;
      document.getElementById("sup-email").value = userEmail;

      document
        .getElementById("logout-btn")
        .addEventListener("click", function (e) {
          e.preventDefault();
          sessionStorage.clear();
          showToast("Logged out");
          setTimeout(function () {
            window.location.href = "index.php";
          }, 1000);
        });

      function handleSupportSubmit(e) {
        e.preventDefault();
        var name = document.getElementById("sup-name").value.trim();
        var email = document.getElementById("sup-email").value.trim();
        var topic = document.getElementById("sup-topic").value;
        var message = document.getElementById("sup-message").value.trim();

        if (!message) {
          showToast("Please enter a message before sending.");
          return;
        }

        fetch("api/submit-support.php", {
          method: "POST",
          headers: { "Content-Type": "application/json" },
          credentials: "same-origin",
          body: JSON.stringify({ name: name, email: email, topic: topic, message: message }),
        })
          .then(function (res) { return res.json(); })
          .then(function (result) {
            if (result.success) {
              document.getElementById("sup-message").value = "";
              showToast(result.message);
            } else {
              showToast(result.message || "Could not send message.");
            }
          })
          .catch(function () {
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
    </script>
  </body>
</html>