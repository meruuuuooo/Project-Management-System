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
      $("#up_projectManager").val(project.project_manager);
      $("#up_descriptions").val(project.description);
      $("#up_startDate").val(project.start_date);
      $("#up_endDate").val(project.end_date);
      $("#up_projectBudget").val(project.budget);
      $("#up_projectClient").val(project.client);
      $("#up_projectPriority").val(project.priority);
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
        $("#updateModal").modal("hide");
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
  getIDs();
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
//     error: function (jqXHR, textStatus, errorThrown) {
//       console.error("Error: " + textStatus, errorThrown);
//       alert("An error occurred while searching for tasks.");
//     }
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
        $("#updateTaskModal").modal("hide");
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
  var newPassword = document.getElementById("info_new_pass").value;

  // Regular expressions to match password format
  var lengthRegex = /.{8,}/; // At least 8 characters
  var alphaRegex = /[a-zA-Z]/; // Alphabetic characters
  var numericRegex = /[0-9]/; // Numerical characters

  var isLengthValid = lengthRegex.test(newPassword);
  var isAlphaValid = alphaRegex.test(newPassword);
  var isNumericValid = numericRegex.test(newPassword);

  document.getElementById("info_new_pass").classList.remove("invalid-password");

  if (!isLengthValid) {
    document.getElementById("info_new_pass").classList.add("invalid-password");
  } else if (!isAlphaValid) {
    document.getElementById("info_new_pass").classList.add("invalid-password");
  } else if (!isNumericValid) {
    document.getElementById("info_new_pass").classList.add("invalid-password");
  }
}

function checkRetPassFrmt() {
  var Password = document.getElementById("info_ret_pass").value;

  // Regular expressions to match password format
  var lengthRegex = /.{8,}/; // At least 8 characters
  var alphaRegex = /[a-zA-Z]/; // Alphabetic characters
  var numericRegex = /[0-9]/; // Numerical characters

  var isLengthValid = lengthRegex.test(Password);
  var isAlphaValid = alphaRegex.test(Password);
  var isNumericValid = numericRegex.test(Password);

  document.getElementById("info_ret_pass").classList.remove("invalid-password");

  if (!isLengthValid) {
    document.getElementById("info_ret_pass").classList.add("invalid-password");
  } else if (!isAlphaValid) {
    document.getElementById("info_ret_pass").classList.add("invalid-password");
  } else if (!isNumericValid) {
    document.getElementById("info_ret_pass").classList.add("invalid-password");
  }
}

function savePass() {
  var oldPassword = document.getElementById("info_old_pass").value;
  var newPassword = document.getElementById("info_new_pass").value;
  var retryPassword = document.getElementById("info_ret_pass").value;

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


  $.ajax({
    url: "../models/resetPassword.php", 
    type: "POST", 
    data: {
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
  getUserDetails();
});

function getUserDetails() {
  $.ajax({
    url: "../models/getUserDetails.php",
    type: "GET", 
    success: function (response) {
      var userDetails = JSON.parse(response);
      console.log(userDetails);
      if (userDetails && !userDetails.error) {
        $("#info_lname").val(userDetails.last_name);
        $("#info_fname").val(userDetails.first_name);
        $("#info_mname").val(userDetails.middle_name);
        $("#info_sname").val(userDetails.name_extension);
        $("#info_sex").val(userDetails.sex);
        $("#info_birthday").val(userDetails.birthday);
        $("#info_civilstatus").val(userDetails.civil_status);
        $("#info_religion").val(userDetails.religion);
        $("#info_placeofbirth").val(userDetails.place_of_birth);
        $("#in_region").val(userDetails.region);
        $("#in_province").val(userDetails.province);
        $("#in_city").val(userDetails.municipality_city);
        $("#in_barangay").val(userDetails.barangay);
        $("#in_strt").val(userDetails.building_street_subdivision);
        $("#info_mobile").val(userDetails.contact_number);
        $("#info_email").val(userDetails.email);
      } else {
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
  $.ajax({
    url: "../models/getLogs.php",
    method: "GET",
    success: function (response) {
      var logs = JSON.parse(response);

      if (Array.isArray(logs)) {
        $("#logsTable tbody").empty();

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

$("#myLogsModal").on("show.bs.modal", function () {
  showLogs();
});

$(document).ready(function () {
  $("#signupForm").submit(function (event) {
    event.preventDefault();
    signup();
  });
});

function login() {
  let formData = new FormData(document.getElementById("loginForm"));

  $.ajax({
    url: "../models/login.php",
    type: "POST",
    data: formData,
    processData: false,
    contentType: false,
    dataType: "json",
    success: function(response) {
      if (response.hasOwnProperty("success")) {
        sessionStorage.setItem("welcomeMessage", "Welcome to Project Management");
        window.location.href = "/sites/dashboard.php";
      } else if (response.hasOwnProperty("error")) {
        Swal.fire({
          icon: "error",
          title: "Error",
          text: response.error,
        }).then(() => {
          location.reload();
        });
      }
    },
    error: function(xhr, status, error) {
      Swal.fire({
        icon: "error",
        title: "Error",
        text: "An unexpected error occurred.",
      });
    }
  });
}

document.addEventListener("DOMContentLoaded", function() {
  const welcomeMessage = sessionStorage.getItem("welcomeMessage");
  if (welcomeMessage) {
    $('#welcomeModal').modal('show');
    sessionStorage.removeItem("welcomeMessage");
  }
});


function signup() {
  let formData = new FormData(document.getElementById("signupForm"));

  $.ajax({
    url: "../models/signup.php",
    type: "POST",
    data: formData,
    processData: false, 
    contentType: false, 
    dataType: "json",
    success: function (response) {
      if (response.hasOwnProperty("success")) {
        Swal.fire({
          icon: "success",
          title: "Success",
          text: response.success,
        }).then(() => {
          window.location.href = "/sites/login.php";
        });
      } else if (response.hasOwnProperty("error")) {
        Swal.fire({
          icon: "error",
          title: "Error",
          text: response.error,
        }).then(() => {
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

$(document).ready(function() {
  fetchDashboardData();

  function fetchDashboardData() {
    $.ajax({
      url: "../models/getDashboardData.php",
      type: "GET",
      dataType: "json",
      success: function(response) {
        $('#totalProjects').text(response.totalProjects);
        $('#totalTasks').text(response.totalTasks);
        $('#completedTasks').text(response.completedTasks);
        $('#pendingTasks').text(response.pendingTasks);
        $('#inprogress').text(response.inprogress);
      },
      error: function(xhr, status, error) {
        console.error("Error fetching dashboard data:", status, error);
      }
    });
  }
});

