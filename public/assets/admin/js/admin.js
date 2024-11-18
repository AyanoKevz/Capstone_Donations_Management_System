document.addEventListener("DOMContentLoaded", function () {
  // Initialize tooltips for nav links with a title attribute
  var tooltipTriggerList = [].slice.call(
    document.querySelectorAll(".sb-sidenav .nav-link[title]")
  );
  var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
    return new bootstrap.Tooltip(tooltipTriggerEl, {
      placement: "right",
      trigger: "hover",
      container: "body", // Ensure the tooltip is appended to the body to avoid overflow issues
    });
  });

  // Function to update tooltip activation based on sidebar state
  function updateTooltips() {
    var isMinimized = document.body.classList.contains("sb-sidenav-toggled");
    tooltipList.forEach(function (tooltip) {
      if (isMinimized) {
        tooltip.enable();
      } else {
        tooltip.disable();
        tooltip.hide(); // Hide any visible tooltips
      }
    });
  }

  // Initial tooltip activation
  updateTooltips();

  // Toggle the sidebar
  var sidebarToggle = document.getElementById("sidebarToggle");
  if (sidebarToggle) {
    sidebarToggle.addEventListener("click", function (event) {
      event.preventDefault();
      document.body.classList.toggle("sb-sidenav-toggled");
      // Update tooltips after toggling the sidebar
      updateTooltips();
    });
  }

  function updateDateTime() {
    const breadcrumbItem = document.querySelector(".breadcrumb-item.active");
    const now = new Date();
    const timeAndDate = `Date: ${now.toLocaleDateString()} <br>Time: ${now.toLocaleTimeString()}`;
    breadcrumbItem.innerHTML = timeAndDate;
  }
  updateDateTime();
  setInterval(updateDateTime, 1000);
});
