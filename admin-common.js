// Shared across every admin page. Include with:
//   <script src="admin-common.js"></script>
// AFTER the sidebar include, since it looks up sidebar element IDs.

function adminInitials(n) {
  return (n || "")
    .split(" ")
    .map(function (w) {
      return w[0];
    })
    .join("")
    .toUpperCase()
    .slice(0, 2);
}

// Confirms there's a real admin/officer session before showing the page.
// Anyone not logged in as admin gets bounced to login.php.
function adminCheckSession(onReady) {
  fetch("../api/session.php", { credentials: "same-origin" })
    .then(function (res) {
      return res.json();
    })
    .then(function (result) {
      var isAdminRole =
        result.data &&
        result.data.loggedIn &&
        (result.data.role === "super_admin" ||
          result.data.role === "officer" ||
          result.data.role === "admin");

      if (!isAdminRole) {
        window.location.href = "../login.php";
        return;
      }

      sessionStorage.setItem("adminName", result.data.name);
      sessionStorage.setItem("adminEmail", result.data.email);
      sessionStorage.setItem("adminRole", result.data.role);

      var nameEl = document.getElementById("admin-name");
      var avEl = document.getElementById("admin-av");
      var roleEl = document.getElementById("admin-role");
      if (nameEl) nameEl.textContent = result.data.name;
      if (avEl) avEl.textContent = adminInitials(result.data.name);
      if (roleEl)
        roleEl.textContent =
          result.data.role === "super_admin" ? "Super Admin" : "Officer";

      if (typeof onReady === "function") onReady(result.data);
    })
    .catch(function () {
      console.warn("Could not verify session with the backend.");
    });
}

function adminWireLogout() {
  var btn = document.getElementById("logout-btn");
  if (!btn) return;
  btn.addEventListener("click", function (e) {
    e.preventDefault();
    fetch("../api/logout.php", { method: "POST", credentials: "same-origin" });
    sessionStorage.clear();
    window.location.href = "../index.php";
  });
}

// Populates the "All Complaints" sidebar badge with the live count of
// New (unclaimed) complaints, so admins see at a glance if anything's
// waiting to be picked up.
function adminLoadBadge() {
  var badge = document.getElementById("new-complaints-badge");
  if (!badge) return;
  fetch("../api/admin/get-admincompliants.php?group=New&per_page=1", {
    credentials: "same-origin",
  })
    .then(function (res) {
      return res.json();
    })
    .then(function (result) {
      if (!result.success) return;
      var count = result.data.counts ? result.data.counts.new : 0;
      badge.textContent = count;
      badge.style.display = count > 0 ? "" : "none";
    })
    .catch(function () {
      /* non-critical */
    });
}

function adminInit() {
  adminCheckSession();
  adminWireLogout();
  adminLoadBadge();
}
