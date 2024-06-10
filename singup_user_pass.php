<?php
include "conn.php";
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirm-password'];

    // Check if passwords match
    if ($password === $confirmPassword) {
        $_SESSION['password'] = $password;
        $firstName = $_SESSION['first-name'];
        $lastName = $_SESSION['last-name'];
        $email = $_SESSION['email'];

        // Insert data into the database
        $sql = "INSERT INTO user (name, email, password) VALUES ('$firstName', '$email', '$password')";
        if (mysqli_query($conn, $sql)) {
            // Clear session data and redirect
            session_unset();
            session_destroy();
            header("Location: thank_you.php");
            exit();
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    } else {
        $error = "Passwords do not match.";
        $error_class = "error";
        $input_error_class = "input-error";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Account</title>
    <link rel="stylesheet" href="styles1.css">
</head>
<body>
    <div class="container">
        <div class="left-section">
            <div class="logo">
                <a href="index.html">Law<span>firm.</span></a>
            </div>
            <h1>Create a User Account</h1>
            <p>Enter your Password</p>
        </div>
        <div class="right-section">
            <form action="" method="POST">
                <div class="input-group <?php echo isset($input_error_class) ? $input_error_class : ''; ?>">
                    <input type="password" id="password" name="password" placeholder=" " required autofocus <?php echo isset($input_error_class) ? 'style="border: 1px solid red;"' : ''; ?>>
                    <label for="password">Password</label>
                    <small class="condition">Use Strong Password</small>
                </div>
                <div class="input-group <?php echo isset($input_error_class) ? $input_error_class : ''; ?>">
                    <input type="password" id="confirm-password" name="confirm-password" placeholder=" " required <?php echo isset($input_error_class) ? 'style="border: 1px solid red;"' : ''; ?>>
                    <label for="confirm-password">Confirm Password</label>
                </div>
                <button type="button" class="previous-button" onclick="history.back()">Previous</button>
                <button type="submit">Finish</button>
                <?php if (isset($error)) echo "<p class='$error_class'>$error</p>"; ?>
            </form>
        </div>
    </div>
</body>
</html>
