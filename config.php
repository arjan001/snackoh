
<?php // Database connection
$host = "localhost"; // Change if necessary
$user = "root"; // Change to your DB username
$pass = ""; // Change to your DB password
$dbname = "bakery"; // Change to your database name

$conn = new mysqli($host, $user, $pass, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


?>