<?php
include '../config/db_connection.php';

session_start();

function getAllProjectIds($conn) {
    $user_id = $_SESSION['user_id'];
    $projectIds = array();

    $sql = "SELECT project_id FROM tbl_projects WHERE manager_id = '$user_id'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $projectIds[] = $row['project_id'];
        }
    }

    return $projectIds;
}

$allProjectIds = getAllProjectIds($conn);

echo json_encode($allProjectIds);

$conn->close();
?>
