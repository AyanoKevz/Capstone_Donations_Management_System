document.addEventListener("DOMContentLoaded", function () {

var spinnerElement = document.getElementById("spinner");

    if (spinnerElement) {
        window.addEventListener("beforeunload", function () {
            spinnerElement.classList.add("show");
        });

        window.addEventListener("load", function () {
            spinnerElement.classList.remove("show");
        });
    }

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


 $(function () {
    if ($("#example1").length) {
        $("#example1").DataTable({
            responsive: true,
            lengthChange: false,
            autoWidth: false,
            buttons: ["copy", "csv", "excel", "pdf", "print"],
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    }
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

    const toggleButton = $('.checkbox-toggle'); 
    const checkboxes = $('input[type="checkbox"][name="selected[]"]'); 
    let allChecked = false; 

    toggleButton.on('click', function () {
    allChecked = !allChecked; 
    checkboxes.prop('checked', allChecked);
    });

    setTimeout(() => {
        $('#alert-success').fadeOut();
        $('#alert-error').fadeOut();
          $('#alert-info').fadeOut();
    }, 3000);
    

     // Toggle visibility for the "current password" field
$('#toggle-opassword').on('click', function () {
  const oldpasswordInput = $('#oldPassword');
  const toggleIcon = $('#toggle-opassword-icon');

  // Toggle password type between 'password' and 'text'
  if (oldpasswordInput.attr('type') === 'password') {
    oldpasswordInput.attr('type', 'text'); // Show password
    toggleIcon.removeClass('fa-eye').addClass('fa-eye-slash'); // Change icon to eye-slash
  } else {
    oldpasswordInput.attr('type', 'password'); // Hide password
    toggleIcon.removeClass('fa-eye-slash').addClass('fa-eye'); // Change icon to eye
  }
});
        
        
     // Toggle visibility for the "password" field
$('#toggle-password').on('click', function () {
  const passwordInput = $('#password');
  const toggleIcon = $('#toggle-password-icon');

  // Toggle password type between 'password' and 'text'
  if (passwordInput.attr('type') === 'password') {
    passwordInput.attr('type', 'text'); // Show password
    toggleIcon.removeClass('fa-eye').addClass('fa-eye-slash'); // Change icon to eye-slash
  } else {
    passwordInput.attr('type', 'password'); // Hide password
    toggleIcon.removeClass('fa-eye-slash').addClass('fa-eye'); // Change icon to eye
  }
});

// Toggle visibility for the "confirm password" field
$('#toggle-cpassword').on('click', function () {
  const cpasswordInput = $('#cpassword');
  const toggleIcon = $('#toggle-cpassword-icon');

  // Toggle password type between 'password' and 'text'
  if (cpasswordInput.attr('type') === 'password') {
    cpasswordInput.attr('type', 'text'); // Show password
    toggleIcon.removeClass('fa-eye').addClass('fa-eye-slash'); // Change icon to eye-slash
  } else {
    cpasswordInput.attr('type', 'password'); // Hide password
    toggleIcon.removeClass('fa-eye-slash').addClass('fa-eye'); // Change icon to eye
  }
});


$("#admin_acount_form").validate({
            rules: {
                username: {
                    required: true,
                    minlength: 8
                },
                oldPassword: {
                    required: true,
                    minlength: 8
                },
                password: {
                    required: true,
                    minlength: 8
                },
                password_confirmation: {
                    required: true,
                    equalTo: "#password"
                },
            
            },
            messages: {
                username: {
                    required: "Please enter a username",
                    minlength: "Your username must be at least 8 characters long"
                },
                oldPassword: {
                    required: "Please enter your old password",
                    minlength: "Your password must be at least 8 characters long"
                },
                password: {
                    required: "Please enter a password",
                    minlength: "Your password must be at least 8 characters long"
                },
                password_confirmation: {
                    required: "Please confirm your password",
                    equalTo: "Passwords do not match"
                },
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

         $("#admin_profile_form").validate({
            rules: {
                profile_image: {
                extension: "jpg|jpeg|png"
            },
                email: {
                    required: true,
                    email: true
                }
            },
            messages: {
                profile_image: {
                    extension: "Please upload a valid image (jpg, jpeg, png)"
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

        if ($("#news_form").length > 0) {

                    $("#news_form").validate({
                rules: {
                    image_url_1: {
                        required: true,
                        extension: "jpg|jpeg|png"
                    },
                    image_url_2: {
                        required: true,
                        extension: "jpg|jpeg|png"
                    },
                    subtitle: {
                        required: true,
                        maxlength: 15
                    },
                    title: {
                        required: true,
                        maxlength: 25
                    }
                
                },
                messages: {
                    image_url_1: {
                        required: "Please upload an image",
                        extension: "Please upload a valid image (jpg, jpeg, png)"
                    },
                    image_url_2: {
                        required: "Please upload an image",
                        extension: "Please upload a valid image (jpg, jpeg, png)"
                    },
                    subtitle: {
                        required: "Please enter a subtitle",
                        maxlength: "Subtitle must be less than 15 characters"
                    },
                    title: {
                        required: "Please enter a title",
                        maxlength: "Title must be less than 25 characters"
                    },
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

if ($("#news_form_update").length > 0) {

                    $("#news_form_update").validate({
                rules: {
                    image_url_1: {
                        extension: "jpg|jpeg|png"
                    },
                    image_url_2: {
                        extension: "jpg|jpeg|png"
                    },
                    subtitle: {
                        required: true,
                        maxlength: 15
                    },
                    title: {
                        required: true,
                        maxlength: 25
                    }
                
                },
                messages: {
                    image_url_1: {
                        extension: "Please upload a valid image (jpg, jpeg, png)"
                    },
                    image_url_2: {
                        extension: "Please upload a valid image (jpg, jpeg, png)"
                    },
                    subtitle: {
                        required: "Please enter a subtitle",
                        maxlength: "Subtitle must be less than 15 characters"
                    },
                    title: {
                        required: "Please enter a title",
                        maxlength: "Title must be less than 25 characters"
                    },
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


$('#file-input').change(function (event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function (e) {
                $('#imagePreview').attr('src', e.target.result);
            };
            reader.readAsDataURL(file);
        }
    });

    $('#image1').change(function (event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function (e) {
                $('#imagePreviewOne').attr('src', e.target.result);
            };
            reader.readAsDataURL(file);
        }
    });

     $('#image2').change(function (event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function (e) {
                $('#imagePreviewTwo').attr('src', e.target.result);
            };
            reader.readAsDataURL(file);
        }
    });

     $('#toggle-password-section').click(function () {
            $('#password-section').toggle();
        });

    
        
});


