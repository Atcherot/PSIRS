<?php
// Enable error reporting for debugging
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
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $firstName = $conn->real_escape_string($_POST['firstName']);
    $lastName = $conn->real_escape_string($_POST['lastName']);
    $email = $conn->real_escape_string($_POST['email']);
    $password = $conn->real_escape_string($_POST['password']);
    $role = $conn->real_escape_string($_POST['role']);

    // Check if email already exists
    $emailCheckSql = "SELECT * FROM users WHERE email = '$email'";
    $emailCheckResult = $conn->query($emailCheckSql);

    if ($emailCheckResult->num_rows > 0) {
        // Notify the user that the email already exists
        echo "<script>
                alert('Error: Email already exists. Please use a different email.');
                window.history.back(); // Go back to the previous page
              </script>";
    } else {
        // Hash the password for security
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Insert user data into the database
        $sql = "INSERT INTO users (first_name, last_name, email, password, role) 
                VALUES ('$firstName', '$lastName', '$email', '$hashedPassword', '$role')";

        if ($conn->query($sql) === TRUE) {
            echo "New user added successfully";
            header("Location: users.php"); // Redirect to users page after successful insertion
            exit();
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}

// Close the connection
$conn->close();
?>
