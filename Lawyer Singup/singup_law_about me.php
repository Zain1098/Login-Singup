<?php
include "..//conn.php";
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $_SESSION['profile-image'] = $_FILES['profile-image']['name'];
    $_SESSION['about-me'] = $_POST['about-me'];
    header("Location: profile_summary.php");
    exit();
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["profile-image"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

    // Check if image file is a actual image or fake image
    $check = getimagesize($_FILES["profile-image"]["tmp_name"]);
    if($check !== false) {
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }

    // Check file size
    if ($_FILES["profile-image"]["size"] > 500000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" 
    && $imageFileType != "gif" ) {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["profile-image"]["tmp_name"], $target_file)) {
            $_SESSION['profile-image'] = basename($_FILES["profile-image"]["name"]);
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
    
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Account</title>
    <link rel="stylesheet" href="..//styles1.css">
</head>
<body>
    <div class="container">
        <div class="left-section">
            <div class="logo">
                <a href="index.html">Law<span>firm.</span></a>
            </div>
            <h1>Create a Lawyer Account</h1>
            <p>Upload your profile image and tell us about yourself.</p>
            <p class="instructions">Please upload a professional image and write a detailed description of your life and experience as a lawyer. Include information about your education, career achievements, and personal interests.</p>
        </div>
        <div class="right-section">
            <form action="process lawyer singup.php" method="POST" enctype="multipart/form-data">
                <div class="input-group">
                    <input type="file" id="profile-image" name="profile-image" required>
                    <label for="profile-image">Profile Image</label>
                </div>
                <div class="input-group">
                    <textarea id="about-me" name="about-me" placeholder=" " rows="5" required></textarea>
                    <label for="about-me">About Me</label>
                    <small class="condition">Describe your life and experience as a lawyer. Include details about your education, career achievements, and personal interests.</small>
                </div>
                <button type="button" class="previous-button" onclick="history.back()">Previous</button>
                <button type="submit">Next</button>
            </form>
        </div>
    </div>
</body>
</html>
