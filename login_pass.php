<?php
include "conn.php";

session_start();
if (!isset($_SESSION['email'])) {
    header('Location: ./index.html');
    exit();
}

$error = isset($_SESSION['error']) ? $_SESSION['error'] : '';
unset($_SESSION['error']);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        .error {
            color: red;
        }

        .input-group.invalid input {
            border-color: red;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="card">
            <div class="logo">
                <a href="index.html">Law<span>firm.</span></a>
            </div>
            <h2>Sign in to Lawfirm</h2>
            <p>Use your Account</p>
            <form action="process_login.php" method="POST">
                <div class="input-group <?php echo !empty($error) ? 'invalid' : ''; ?>"> <input type="password" id="password" name="password" placeholder=" " required autofocus>
                    <label for="password">Password</label>
                </div>
                <?php if (!empty($error)) : ?>
                    <p class="error"><?php echo $error; ?></p>
                <?php endif; ?>
                <a href="#">Forgot password?</a>
                <button type="submit">Next</button>
            </form>
            <div class="footer">
                <div class="dropdown">
                    <p>Create Account</p>
                    <div class="dropdown-content">
                        <a href="singup_user_name.php">Create User Account</a>
                        <a href="create_lawyer_account.php">Create Lawyer Account</a>
                    </div>
                </div>
            </div>
            <div class="footer-links">
                <a href="#">Help</a>
                <a href="#">Privacy</a>
                <a href="#">Terms</a>
            </div>
        </div>
    </div>
</body>

</html>