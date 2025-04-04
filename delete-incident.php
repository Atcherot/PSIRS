<?php
// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

$servername = "localhost";  // Database server
$username = "publ_PSIRS";         // Database username
$password = "M1IOl+7Az3ArG5ld";             // Database password
$dbname = "publ_incident_reporting_system";  // Database name
$socket = '/run/mysqld/mysqld.sock';

// Create connection
$conn = new mysqli($servername, $username, $password,$dbname, null, $socket);

// Check connection
if ($conn->connect_error) {
    die(json_encode(['success' => false, 'message' => 'Database connection failed']));
}

// Check if ID is provided
if (isset($_GET['id'])) {
    $id = intval($_GET['id']); // Sanitize the input

    // Prepare the delete query
    $sql = "DELETE FROM incident_reports WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to delete report.']);
    }

    $stmt->close();
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request.']);
}

// Close the connection
$conn->close();
?>
