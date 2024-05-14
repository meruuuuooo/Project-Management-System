<?php
include '../config/db_connection.php';

if (isset($_POST['project_ids'])) {
    $project_ids = $_POST['project_ids'];
    $taskCount = array();

    foreach ($project_ids as $project_id) {
        $sql = "SELECT COUNT(*) as taskCount FROM tbl_tasks WHERE project_id = '$project_id'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $taskCount[$project_id] = $row['taskCount'];
            }
        }
    }

    echo json_encode($taskCount);
}


