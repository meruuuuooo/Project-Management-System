<?php

session_start(); // Start the session if not already started

if (isset($_POST['formData'])) {
  include "../config/db_connection.php";

  $serializedFormData = $_POST['formData'];

  parse_str($serializedFormData, $formDataArray);

  $lastname = $formDataArray['info_lname'];
  $firstname = $formDataArray['info_fname'];
  $middlename = $formDataArray['info_mname'];
  $name_extension = $formDataArray['info_sname'];
  $sex = $formDataArray['info_sex'];
  $birthday = $formDataArray['info_birthday'];
  $civilstatus = $formDataArray['info_civilstatus'];
  $religion = $formDataArray['info_religion'];
  $placeofbirth = $formDataArray['info_placeofbirth'];
  $region = $formDataArray['info_reg'];
  $province = $formDataArray['info_prov'];
  $municipality_city = $formDataArray['info_munc'];
  $barangay = $formDataArray['info_brgy'];
  $street = $formDataArray['info_strt'];
  $contact = $formDataArray['info_mobile'];
  $email = $formDataArray['info_email'];

  $user_id = $_SESSION['user_id'];

  $emailSql = "UPDATE tbl_user_credentials SET email = '$email' WHERE user_id = '$user_id'";
  $conn->query($emailSql);


  $sqlReg = "SELECT regDesc FROM ph_region WHERE regCode = '$region'";
  $resultReg = $conn->query($sqlReg);
  $rowReg = $resultReg->fetch_assoc();
  $resRegion = $rowReg['regDesc'];

  $sqlProv = "SELECT provDesc FROM ph_province WHERE provCode = '$province'";
  $resultProv = $conn->query($sqlProv);
  $rowProv = $resultProv->fetch_assoc();
  $resProvince = $rowProv['provDesc'];

  $sqlMunc = "SELECT citymunDesc FROM ph_citymun WHERE citymunCode = '$municipality_city'";
  $resultMunc = $conn->query($sqlMunc);
  $rowMunc = $resultMunc->fetch_assoc();
  $resMunicipality_city = $rowMunc['citymunDesc'];

  $sqlBrgy = "SELECT brgyDesc FROM ph_brgy WHERE brgyCode = '$barangay'";
  $resultBrgy = $conn->query($sqlBrgy);
  $rowBrgy = $resultBrgy->fetch_assoc();
  $resBarangay = $rowBrgy['brgyDesc'];
  

  $sql = "UPDATE tbl_user_profile SET 
          last_name = '$lastname', 
          first_name = '$firstname', 
          middle_name = '$middlename',
          name_extension = '$name_extension',
          sex = '$sex',
          birthday = '$birthday', 
          civil_status = '$civilstatus', 
          religion = '$religion', 
          place_of_birth = '$placeofbirth', 
          region = '$resRegion', 
          province = '$resProvince', 
          municipality_city = '$resMunicipality_city', 
          barangay = '$resBarangay', 
          building_street_subdivision = '$street', 
          contact_number = '$contact'
          WHERE user_id = '$user_id'";

  if ($conn->query($sql) === TRUE || $conn->query($emailSql) === TRUE) {
    echo json_encode(['success' => 'User information updated successfully']);
  } else {
    echo json_encode(['error' => 'Error updating user information']);
  }
}
