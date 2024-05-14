<?php

if (isset($_POST['type'])) {
  $type = $_POST['type'];
  $code = $_POST['code'];

  if ($type == 'region') {
    getProvince($code);
  } else if ($type == 'province') {
    getMunCity($code);
  } else if ($type == 'citymun') {
    getBrgy($code);
  }
}


function getProvince($regCode)
{
  include "../config/db_connection.php";

  $sql = "SELECT * FROM ph_province WHERE regCode = '$regCode'";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
?>
      <option value="<?= $row['provCode'] ?>"><?= $row['provDesc'] ?></option>
    <?php
    }
  } else {
    echo "0 results";
  }

  $conn->close();
}

function getMunCity($provCode)
{
  include "../config/db_connection.php";

  $sql = "SELECT * FROM ph_citymun WHERE provCode = '$provCode'";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
    ?>
      <option value="<?= $row['citymunCode'] ?>"><?= $row['citymunDesc'] ?></optiondi>
    <?php
    }
  } else {
    echo "0 results";
  }
  $conn->close();
}

function getBrgy($citymunCode)
{
  include "../config/db_connection.php";

  $sql = "SELECT * FROM ph_brgy WHERE citymunCode = '$citymunCode'";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
    ?>
      <option value="<?= $row['brgyCode'] ?>"><?= $row['brgyDesc'] ?></option>
<?php
    }
  } else {
    echo "0 results";
  }
  $conn->close();
}
