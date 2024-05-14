function displayProvince(regCode) {
  console.log(regCode);
  $.ajax({
    url: "../models/ph_address.php",
    type: "POST",
    data: {
      type: "region",
      code: regCode,
    },
    success: function (response) {
      $("#info_prov").html(response);
    },
  });
}

function displayMunCity(provCode) {
  $.ajax({
    url: "../models/ph_address.php",
    type: "POST",
    data: {
      type: "province",
      code: provCode,
    },
    success: function (response) {
      $("#info_munc").html(response);
    },
  });
}

function displayBrgy(citymunCode) {
  $.ajax({
    url: "../models/ph_address.php",
    type: "POST",
    data: {
      type: "citymun",
      code: citymunCode,
    },
    success: function (response) {
      $("#info_brgy").html(response);
    },
  })
}
