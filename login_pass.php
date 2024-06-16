<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In</title>
    <link rel="stylesheet" href="styles.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
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
                <div class="password-group <?php echo !empty($error) ? 'invalid' : ''; ?>">
                    <input type="password" id="password" name="password" placeholder=" " required autofocus>
                    <label for="password">Password</label>
                    <span id="toggle-password" class="input-icon fa fa-eye"></span>
                </div>
                <?php if (!empty($error)) : ?>
                    <p class="error"><?php echo $error; ?></p>
                <?php endif; ?>
                <a href="reset_password.php">Forgot password?</a>
                <button type="submit">Next</button>
            </form>
            <div class="footer">
                <div class="dropdown">
                    <p>Create Account</p>
                    <div class="dropdown-content">
                        <a href="signup_user_name.php">Create User Account</a>
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
    <script>
        $(document).ready(function() {
            $('#toggle-password').click(function() {
                let passwordField = $('#password');
                let passwordFieldType = passwordField.attr('type');
                if (passwordFieldType == 'password') {
                    passwordField.attr('type', 'text');
                    $(this).removeClass('fa-eye').addClass('fa-eye-slash');
                } else {
                    passwordField.attr('type', 'password');
                    $(this).removeClass('fa-eye-slash').addClass('fa-eye');
                }
            });
        });
    </script>

</body>

</html>
