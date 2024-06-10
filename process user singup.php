<?php
session_start();

// Retrieve data from session
$firstName = $_SESSION['first-name'];
$lastName = $_SESSION['last-name'];
$email = $_SESSION['email'];
$password = $_SESSION['password'];

// Insert data into the user's table in your database
// Here you would use your database connection and insert query
// For example:

$sql = "INSERT INTO user (name, email , password) VALUES ('$firstName','$email' , '$password')";
$result=mysqli_query($conn,$sql);


// Clear session data
session_unset();
session_destroy();

// Redirect to a thank you page or wherever you want
header('Location: thank_you.php');
exit();
?>
