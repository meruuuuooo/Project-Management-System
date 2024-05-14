function deleteProject(project_id) {
  Swal.fire({
    title: "Are you sure?",
    text: "All tasks associated with this project will be deleted as well! You won't be able to revert this",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Yes, delete it!",
  }).then((result) => {
    if (result.isConfirmed) {
      $.ajax({
        url: "../models/deleteProject.php",
        type: "POST",
        data: {
          project_id: project_id,
        },
        success: function (response) {
          Swal.fire({
            icon: "success",
            title: "Success",
            text: "Project Deleted successfully!",
          }).then(() => {
            location.reload();
          });
        },
        error: function (xhr, status, error) {
          // Display error message
          Swal.fire({
            icon: "error",
            title: "Oops...",
            text: "Error deleting project. Please try again.",
          }).then(() => {
            // Reload the page after displaying error message
            location.reload();
          });
        },
      });
    }
  });
}

function updateProject(project_id) {
  $("#updateModal").modal("show");

  $.ajax({
    url: "../models/getProjectDetails.php",
    type: "POST",
    data: { project_id: project_id },
    success: function (response) {
      var project = JSON.parse(response);
      $("#up_title").val(project.name);
      $("#up_descriptions").val(project.description);
      $("#up_startDate").val(project.start_date);
      $("#up_endDate").val(project.end_date);
      $("#up_status").val(project.status);
    },
  });

  $("#updateForm").off("submit");

  $("#updateForm").submit(function (e) {
    e.preventDefault();
    var formData = $(this).serialize();
    Swal.fire({
      title: "Are you sure?",
      text: "This action will update the information. Are you sure you want to proceed?",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Yes, update it!",
    }).then((result) => {
      if (result.isConfirmed) {
        $.ajax({
          url: "../models/updateProject.php",
          type: "POST",
          data: {
            project_id: project_id,
            formData: formData,
          },
          success: function (response) {
            Swal.fire({
              icon: "success",
              title: "Success",
              text: "Project updated successfully!",
            }).then(() => {
              location.reload();
            });
          },
          error: function (xhr, status, error) {
            Swal.fire({
              icon: "error",
              title: "Oops...",
              text: "Error updating project. Please try again.",
            }).then(() => {
              location.reload();
            });
          },
        });
      }
    });
  });
}

function searchProject(searchValue) {
  console.log(searchValue);
  $.ajax({
    url: "../models/searchProject.php",
    type: "POST",
    data: { searchValue: searchValue },
    success: function (response) {
      $("#projectTable").html(response);
    },
  });
}

// function searchTask(searchValue) {
//   $.ajax({
//     url: "../models/searchTask.php",
//     type: "POST",
//     data: { searchValue: searchValue },
//     success: function (response) {
//       $("#taskTable").html(response);
//     },
//   });
// }

function deleteTask(task_id) {
  Swal.fire({
    title: "Are you sure?",
    text: "You won't be able to revert this! All task details will be deleted as well.",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Yes, delete it!",
  }).then((result) => {
    if (result.isConfirmed) {
      $.ajax({
        url: "../models/deleteTask.php",
        type: "POST",
        data: { task_id: task_id },
        success: function (response) {
          Swal.fire({
            icon: "success",
            title: "Success",
            text: "Task Deleted successfully!",
          }).then(() => {
            location.reload();
          });
        },
        error: function (xhr, status, error) {
          Swal.fire({
            icon: "error",
            title: "Oops...",
            text: "Error deleting task. Please try again.",
          }).then(() => {
            location.reload();
          });
        },
      });
    }
  });
}

function updateTask(task_id) {
  console.log(task_id);

  $("#updateTaskModal").modal("show");

  $.ajax({
    url: "../models/getTaskDetails.php",
    type: "POST",
    data: {
      task_id: task_id,
    },
    success: function (response) {
      var task = JSON.parse(response);
      $("#task_title").val(task.name);
      $("#task_descriptions").val(task.description);
      $("#task_startDate").val(task.start_date);
      $("#task_endDate").val(task.end_date);
      $("#task_status").val(task.status);
    },
  });

  $("#updateTaskForm").off("submit");

  $("#updateTaskForm").submit(function (e) {
    e.preventDefault();
    var formTaskData = $(this).serialize();

    Swal.fire({
      title: "Are you sure?",
      text: "This action will update the information. Are you sure you want to proceed?",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Yes, update it!",
    }).then((result) => {
      if (result.isConfirmed) {
        $.ajax({
          url: "../models/updateTask.php",
          type: "POST",
          data: {
            task_id: task_id,
            formTaskData: formTaskData,
          },
          success: function (response) {
            Swal.fire({
              icon: "success",
              title: "Success",
              text: "Project updated successfully!",
            }).then(() => {
              location.reload();
            });
          },
          error: function (xhr, status, error) {
            Swal.fire({
              icon: "error",
              title: "Oops...",
              text: "Error updating project. Please try again.",
            }).then(() => {
              location.reload();
            });
          },
        });
      }
    });
  });
}

function checkPassFrmt() {
  // Get the value of the new password input field
  var newPassword = document.getElementById("info_new_pass").value;

  // Regular expressions to match password format
  var lengthRegex = /.{8,}/; // At least 8 characters
  var alphaRegex = /[a-zA-Z]/; // Alphabetic characters
  var numericRegex = /[0-9]/; // Numerical characters

  // Check if the new password matches the format
  var isLengthValid = lengthRegex.test(newPassword);
  var isAlphaValid = alphaRegex.test(newPassword);
  var isNumericValid = numericRegex.test(newPassword);

  document.getElementById("info_new_pass").classList.remove("invalid-password");

  // Display appropriate message based on password format
  if (!isLengthValid) {
    document.getElementById("info_new_pass").classList.add("invalid-password");
  } else if (!isAlphaValid) {
    document.getElementById("info_new_pass").classList.add("invalid-password");
  } else if (!isNumericValid) {
    document.getElementById("info_new_pass").classList.add("invalid-password");
  }
}

function checkRetPassFrmt() {
  // Get the value of the new password input field
  var Password = document.getElementById("info_ret_pass").value;

  // Regular expressions to match password format
  var lengthRegex = /.{8,}/; // At least 8 characters
  var alphaRegex = /[a-zA-Z]/; // Alphabetic characters
  var numericRegex = /[0-9]/; // Numerical characters

  // Check if the new password matches the format
  var isLengthValid = lengthRegex.test(Password);
  var isAlphaValid = alphaRegex.test(Password);
  var isNumericValid = numericRegex.test(Password);

  document.getElementById("info_ret_pass").classList.remove("invalid-password");

  // Display appropriate message based on password format
  if (!isLengthValid) {
    document.getElementById("info_ret_pass").classList.add("invalid-password");
  } else if (!isAlphaValid) {
    document.getElementById("info_ret_pass").classList.add("invalid-password");
  } else if (!isNumericValid) {
    document.getElementById("info_ret_pass").classList.add("invalid-password");
  }
}

function savePass() {
  // Get the values of the old password, new password, and retry password input fields
  var oldPassword = document.getElementById("info_old_pass").value;
  var newPassword = document.getElementById("info_new_pass").value;
  var retryPassword = document.getElementById("info_ret_pass").value;

  // Check if the new password matches the retry password
  if (newPassword !== retryPassword) {
    Swal.fire({
      icon: "error",
      title: "Oops...",
      text: "New password and retry password do not match.",
    });
    return;
  }

  if (oldPassword === "" || newPassword === "" || retryPassword === "") {
    Swal.fire({
      icon: "error",
      title: "Oops...",
      text: "Please fill out all fields.",
    });
    return;
  }

  // You can add additional validation here if needed

  // Send an AJAX request to a server-side script to handle password saving
  $.ajax({
    url: "../models/resetPassword.php", // Specify the URL of the server-side script
    type: "POST", // Specify the HTTP method (POST in this case)
    data: {
      // Pass the data to the server-side script
      oldPassword: oldPassword,
      newPassword: newPassword,
    },
    success: function (response) {
      Swal.fire({
        icon: "success",
        title: "Success",
        text: "Password saved successfully!",
      }).then(() => {
        location.reload();
      });
    },
    error: function (xhr, status, error) {
      Swal.fire({
        icon: "error",
        title: "Oops...",
        text: "Error saving password. Please try again later.",
      }).then(() => {
        location.reload();
      });
    },
  });
}

$(document).ready(function () {
  // Call the function to fetch user details when the document is ready
  getUserDetails();
});

// Define a function to fetch user details from the server
function getUserDetails() {
  $.ajax({
    url: "../models/getUserDetails.php", // Specify the URL of the server-side script
    type: "GET", // Use GET method to retrieve data
    success: function (response) {
      // Define a function to handle the success response
      // Parse the JSON response
      var userDetails = JSON.parse(response);
      console.log(userDetails);

      // Check if the response contains user details
      if (userDetails && !userDetails.error) {
        // Update the input fields with user details
        $("#info_lname").val(userDetails.last_name);
        $("#info_fname").val(userDetails.first_name);
        $("#info_mname").val(userDetails.middle_name);
        $("#info_sname").val(userDetails.name_extension);
        $("#info_sex").val(userDetails.sex);
        $("#info_birthday").val(userDetails.birthday);
        $("#info_civilstatus").val(userDetails.civil_status);
        $("#info_religion").val(userDetails.religion);
        $("#info_placeofbirth").val(userDetails.place_of_birth);
        $("#info_reg").val(userDetails.region);
        $("#info_prov").val(userDetails.province);
        $("#info_munc").val(userDetails.municipality_city);
        $("#info_brgy").val(userDetails.barangay);
        $("#info_strt").val(userDetails.building_street_subdivision);
        $("#info_mobile").val(userDetails.contact_number);
        $("#info_email").val(userDetails.email);
      } else {
        // Handle the case where user details are not found or an error occurs
        console.error("Error fetching user details:", userDetails.error);
      }
    },
    error: function (xhr, status, error) {
      console.error("Error fetching user details:", error);
    },
  });

  $("#updateInfoForm").off("submit");

  $("#updateInfoForm").submit(function (e) {
    e.preventDefault();
    var formData = $(this).serialize();
    console.log(formData);
    $.ajax({
      url: "../models/updateUserDetails.php",
      type: "POST",
      data: {
        formData: formData,
      },
      success: function (response) {
        Swal.fire({
          icon: "success",
          title: "Success",
          text: "User information updated successfully!",
        }).then(() => {
          location.reload();
        });
      },
      error: function (xhr, status, error) {
        Swal.fire({
          icon: "error",
          title: "Oops...",
          text: "Error updating user information. Please try again.",
        }).then(() => {
          location.reload();
        });
      },
    });
  });
}

function showLogs() {
  // Make an AJAX request to fetch log data
  $.ajax({
    url: "../models/getLogs.php",
    method: "GET",
    success: function (response) {
      // Parse the JSON response
      var logs = JSON.parse(response);

      // Check if logs is an array
      if (Array.isArray(logs)) {
        // Clear existing table rows
        $("#logsTable tbody").empty();

        // Populate the table with log data
        logs.forEach(function (log) {
          $("#logsTable tbody").append(
            "<tr>" +
              "<td>" +
              log.log_id +
              "</td>" +
              "<td>" +
              log.user_id +
              "</td>" +
              "<td>" +
              log.action +
              "</td>" +
              "<td>" +
              log.detail +
              "</td>" +
              '<td class="text-success" >' +
              log.timestamp +
              "</td>" +
              "</tr>"
          );
        });
      } else {
        $("#logsTable tbody").append(
          "<tr>" +
            '<td colspan="5" class="text-center">' +
            "No Logs Found" +
            "</td>" +
            "</tr>"
        );
      }
    },
    error: function (xhr, status, error) {
      // Handle errors
      console.error(error);
    },
  });
}

// Attach event listener to modal show event
$("#myLogsModal").on("show.bs.modal", function () {
  // Call the function to show logs when the modal is shown
  showLogs();
});

$(document).ready(function () {
  // Add an event listener to the form submission
  $("#signupForm").submit(function (event) {
    // Prevent the default form submission behavior
    event.preventDefault();
    // Call the signup function when the form is submitted
    signup();
  });
});

function signup() {
  // Create FormData object and append form data
  var formData = new FormData(document.getElementById("signupForm"));

  // Send an AJAX request
  $.ajax({
    url: "../models/signup.php",
    type: "POST",
    data: formData,
    processData: false, // Prevent jQuery from processing the data
    contentType: false, // Prevent jQuery from setting the content type
    dataType: "json",
    success: function (response) {
      if (response.hasOwnProperty("success")) {
        // If the response contains a success message
        Swal.fire({
          icon: "success",
          title: "Success",
          text: response.success, // Show the success message from the response
        }).then(() => {
          // Redirect to the login page after showing the success message
          window.location.href = "/sites/login.php";
        });
      } else if (response.hasOwnProperty("error")) {
        // If the response contains an error message
        Swal.fire({
          icon: "error",
          title: "Error",
          text: response.error, // Show the error message from the response
        }).then(() => {
          // Reload the page after showing the error message
          location.reload();
        });
      }
    },
    error: function (xhr, status, error) {
      // Handle AJAX errors
      console.error(error);
    },
  });
}

$(document).ready(function () {
  getIDs();
});

function getIDs() {
  $.ajax({
    url: "../models/getAllProjectsID.php",
    type: "GET",
    success: function (response) {
      var project_ids = JSON.parse(response);
      console.log(project_ids);
      getTaskCount(project_ids);
    },
  });
}

function getTaskCount(project_ids) {
  $.ajax({
    url: "../models/getTaskCount.php",
    type: "POST",
    data: { project_ids: project_ids },
    success: function (response) {
      var taskCount = JSON.parse(response);
      console.log(taskCount);

      project_ids.forEach(function (project_id) {
        var count = taskCount[project_id];
        $("#taskCount_" + project_id).text(count);
      });
    },
  });
}
