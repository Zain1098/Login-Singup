<?php
session_start();
include '../conn.php';

// Retrieve data from session
$firstName = $_SESSION['first-name'];
$lastName = $_SESSION['last-name'];
$email = $_SESSION['email'];
$number = $_SESSION['number'];
$address = $_SESSION['address'];
$password = password_hash($_SESSION['password'], PASSWORD_DEFAULT);
$barCouncil = $_SESSION['bar_council_number'];
$since = $_SESSION['practicing_since'];
$specialist = $_SESSION['specialization'];
$description = $_SESSION['description'];
$degree = $_SESSION['degrees'];
$university = $_SESSION['universities'];
$language = $_SESSION['languages_spoken'];
$available = $_SESSION['availability'];
$aboutMe = $_SESSION['about-me'];

// Handle file upload
$image = $_FILES['profile-image']['name'];
$target_dir = "uploads/";
$target_file = $target_dir . basename($image);

// Check if the directory exists, if not create it
if (!is_dir($target_dir)) {
    mkdir($target_dir, 0777, true);
}

// Correct the path to the temporary file
if (move_uploaded_file($_FILES['profile-image']['tmp_name'], $target_file)) {
    echo "The file ". htmlspecialchars(basename($image)). " has been uploaded.";
} else {
    echo "Sorry, there was an error uploading your file.";
    exit();
}

// Prepare and bind
$stmt = $conn->prepare("INSERT INTO lawyer (`name`, `last name`, `email`, `number`, `address`, `password`, `bar council`, `since`, `specialist`, `description`, `degree`, `university`, `language`, `available`, `image`, `about me`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("ssssssssssssssss", $firstName, $lastName, $email, $number, $address, $password, $barCouncil, $since, $specialist, $description, $degree, $university, $language, $available, $image, $aboutMe);

// Execute the statement
if ($stmt->execute()) {
    echo "New record created successfully";
} else {
    echo "Error: " . $stmt->error;
}

// Close the statement and connection
$stmt->close();
$conn->close();

// Clear session data
session_unset();
session_destroy();

// Redirect to a thank you page
header('Location: thank_you.php');
exit();
?>
