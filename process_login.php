<?php
session_start();
include "conn.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['password']) && isset($_SESSION['email'])) {
    $email = $conn->real_escape_string($_SESSION['email']);
    $password = $conn->real_escape_string($_POST['password']);

    // Use prepared statements to prevent SQL injection
    $stmt = $conn->prepare("SELECT id FROM user WHERE email = ? AND password = ?");
    $stmt->bind_param("ss", $email, $password);
    $stmt->execute();
    $stmt->store_result();
    
    if ($stmt->num_rows > 0) {
        // Successful login
        $_SESSION['logged_in'] = true;
        header("Location: dashboard.php");
        exit();
    } else {
        // Invalid credentials
        echo "Invalid email or password.";
    }
    
    $stmt->close();
} else {
    echo "Password is required.";
}

$conn->close();
?>
