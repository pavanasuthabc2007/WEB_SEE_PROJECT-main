<!DOCTYPE html>
<html>
<head>
    <title>User Registration</title>
    <link rel="stylesheet" href="style.css">
</head>

<body class="auth-body">

<div class="auth-card">

<h2>Create Account</h2>

<form action="register_process.php" method="POST">

<input type="text" name="username" placeholder="Enter Username" required>

<input type="email" name="email" placeholder="Enter Email" required>

<input type="password" name="password" placeholder="Enter Password" required>

<button type="submit">Register</button>

</form>

<br>

<a href="login.php">Already have account? Login</a>

</div>

</body>
</html>