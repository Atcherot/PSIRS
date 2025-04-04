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
    die(json_encode(["status" => "error", "message" => "Connection failed: " . $conn->connect_error]));
}

// Check if `id` is provided via POST
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $id = intval($_POST['id']); // Sanitize input

    // Prepare and execute the delete query
    $stmt = $conn->prepare("DELETE FROM disaster_reports WHERE id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo json_encode(["status" => "success", "message" => "Record deleted successfully"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Failed to delete record"]);
    }

    $stmt->close();
} else {
    echo json_encode(["status" => "error", "message" => "Invalid request"]);
}

// Close the connection
$conn->close();
?>
