document.addEventListener("DOMContentLoaded", function () {


  
var spinner = function () {
    setTimeout(function () {
        var spinnerElement = document.getElementById("spinner");
        if (spinnerElement) {
            spinnerElement.classList.remove("show");
        }
    }, 1);
};
spinner();

  // Initialize tooltips for nav links with a title attribute
  var tooltipTriggerList = [].slice.call(
    document.querySelectorAll(".sb-sidenav .nav-link[title]")
  );
  var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
    return new bootstrap.Tooltip(tooltipTriggerEl, {
      placement: "right",
      trigger: "hover",
      container: "body", 
    });
  });


  function updateTooltips() {
    var isMinimized = document.body.classList.contains("sb-sidenav-toggled");
    tooltipList.forEach(function (tooltip) {
      if (isMinimized) {
        tooltip.enable();
      } else {
        tooltip.disable();
        tooltip.hide(); 
      }
    });
  }

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
  if (breadcrumbItem) {
    const now = new Date();
    const timeAndDate = `Date: ${now.toLocaleDateString()} <br>Time: ${now.toLocaleTimeString()}`;
    breadcrumbItem.innerHTML = timeAndDate;
  }
}
  updateDateTime();
  setInterval(updateDateTime, 1000);


  $(function() {
      $("#example1").DataTable({
        "responsive": true,
        "lengthChange": false,
        "autoWidth": false,
        "buttons": ["copy", "csv", "excel", "pdf", "print"]
      }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    });


  if ($("#admin-login").length > 0) {
        $("#admin-login").validate({
            rules: {
                username: {
                    required: true,
                    minlength: 8
                },
                password: {
                    required: true,
                    minlength: 8
                },
                cpassword: {
                    required: true,
                    equalTo: "#password"
                },
                email: {
                    required: true,
                    email: true
                }
            },
            messages: {
                username: {
                    required: "Please enter a username",
                    minlength: "Your username must be at least 8 characters long"
                },
                password: {
                    required: "Please enter a password",
                    minlength: "Your password must be at least 8 characters long"
                },
                cpassword: {
                    required: "Please confirm your password",
                    equalTo: "Passwords do not match"
                },
                email: {
                    required: "Please enter a valid email address",
                    email: "Please enter a valid email address"
                }
            },
            highlight: function (element) {
                $(element).addClass('is-invalid').removeClass('is-valid');
            },
            unhighlight: function (element) {
                $(element).addClass('is-valid').removeClass('is-invalid');
            },
            errorPlacement: function (error, element) {
                error.insertAfter(element);
            },
            submitHandler: function (form) {
                form.submit();
            }
        });
    }
        $(document).ready(function () {
      $('#compose-textarea').summernote({
        placeholder: 'Write your message here...',
        tabsize: 2,
        height: 300,
        toolbar: [
          ['style', ['bold', 'italic', 'underline', 'clear']],
          ['font', ['strikethrough', 'superscript', 'subscript']],
          ['fontsize', ['fontsize']],
          ['color', ['color']],
          ['para', ['ul', 'ol', 'paragraph']],
          ['height', ['height']],
        ]
      });
    });


    const toggleButton = $('.checkbox-toggle'); // The "Check All" button
    const checkboxes = $('input[type="checkbox"][name="selected[]"]'); // All checkboxes
    const icon = toggleButton.find('i'); // The icon inside the button
    let allChecked = false; // Track the toggle state

    // Toggle button click event
    toggleButton.on('click', function () {
        allChecked = !allChecked; // Toggle state

        // Update all checkboxes
        checkboxes.prop('checked', allChecked);

        // Update the icon
        icon
            .toggleClass('fa-square', !allChecked) // Show square icon if unchecking all
            .toggleClass('fa-square-check', allChecked); // Show check-square icon if checking all
    });

    // Update button icon dynamically when individual checkboxes change
    checkboxes.on('change', function () {
        const totalChecked = checkboxes.filter(':checked').length;
        allChecked = (totalChecked === checkboxes.length); // Update toggle state

        icon
            .toggleClass('fa-square', !allChecked) // Show square if not all are checked
            .toggleClass('fa-square-check', allChecked); // Show check-square if all are checked
    });
    

        setTimeout(() => {
            $('#alert-success').fadeOut();
            $('#alert-error').fadeOut();
        }, 3000);
        

});


