<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Login</title>
</head>
<body>
    <div class="nav">
        <div class="back">
            <a href="index.php">Back</a>
        </div>
    </div>
    <div class="forms-container">
        <div class="signin-form">
            <p>Sign-in</p>
            <form action="login.php" method="POST">
                <input type="email" name="email" placeholder="Email">
                <input type="password" name="password" placeholder="Password">
                <input type="submit" value="Sign In">
            </form>
        </div>
        <div class="create-account-form">
            <p>Create Account</p>
            <form action="signup.php" method="POST">
                <input type="text" name="username" placeholder="Username">
                <input type="email" name="email" placeholder="Email">
                <input type="password" name="password" placeholder="Password">
                <input type="submit" value="Sign Up">
            </form>
        </div>
    </div>
</body>
</html>
