<?php

// Start the session if not already started
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}

include '../config/db_connection.php';

// Check if $_SESSION['user_id'] is set before accessing it
$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;

// Check if searchValue is set
$searchValue = isset($_POST['searchValue']) ? $_POST['searchValue'] : '';

// Proceed only if $_SESSION['user_id'] is set
if ($user_id !== null) {
  $sql = "SELECT * FROM tbl_projects WHERE manager_id = '$user_id'";

  // Add search criteria if searchValue is provided
  if (!empty($searchValue)) {
    $searchValue = mysqli_real_escape_string($conn, $searchValue); // Escape special characters to prevent SQL injection
    $sql .= " AND name LIKE '%$searchValue%'";
  }

  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {

?>
      <tr>
        <td><?php echo $row['name']; ?></td>
        <td><?php echo $row['description']; ?></td>
        <td><?php echo $row['start_date']; ?></td>
        <td><?php echo $row['end_date']; ?></td>
        <td><?php echo $row['status']; ?></td>
        <td class="text-center">
          <a href="../sites/task.php?project_id=<?php echo $row['project_id']; ?>">
            <button type="button" class="btn btn-primary position-relative">
              View
              <span class="notification-circle" id="taskCount_<?php echo $row['project_id']; ?>"></span>
            </button>
          </a>
        </td> 
        <td class="text-center">
          <div class="btn-group">
            <button type="button" id="btn-notif" name="updateEl" class="btn btn-primary" onclick="updateProject(this.value)" value="<?php echo $row['project_id'] ?>">
              Update
            </button>
            <button type="button" name="deleteEl" class="btn btn-danger" onclick="deleteProject(this.value)" value="<?php echo $row['project_id'] ?>">
              Delete
            </button>
          </div>
        </td>
      </tr>
    <?php
    }
  } else {
    ?>
    <tr>
      <td colspan="7" class="text-center">No Projects Found</td>
    </tr>
<?php
  }
}
