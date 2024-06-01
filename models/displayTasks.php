<?php


// Check if project_id is set in the URL
if (isset($_GET['project_id'])) {
  include '../config/db_connection.php';
  // Sanitize project_id to prevent SQL injection
  $project_id = mysqli_real_escape_string($conn, $_GET['project_id']);


  // Proceed only if $_SESSION['user_id'] is set
  if ($project_id !== null) {
    $sql = "SELECT * FROM tbl_tasks WHERE project_id = '$project_id'";

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
            <div class="btn-group">
              <button type="button" class="btn btn-primary" onclick="updateTask(this.value)" value="<?php echo $row['task_id']; ?>">Update</button>
              <button type="button" class="btn btn-danger" onclick="deleteTask(this.value)" value="<?php echo $row['task_id']; ?>">Delete</button>
            </div>
          </td>
        </tr>
      <?php
      }
    } else {
      ?>
      <tr>
        <td colspan="6" class="text-center text-danger">No Tasks Found</td>
      </tr>
<?php
    }
  }
}

?>