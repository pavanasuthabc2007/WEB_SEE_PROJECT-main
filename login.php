<!DOCTYPE html>
<html>
<head>
    <title>OTP Login - Smart Grocery Store</title>
    <link rel="stylesheet" href="style.css">
</head>
    <main>
        <h2> Welcome To Smart Grocery Store</h2>
    
<body class="auth-body">
<div class="auth-card">
    <h2>Login with OTP</h2>

    <form action="login_process.php" method="POST">
    <input type="text" name="username" placeholder="Enter Username" required>  
   <input type="password" name="password" placeholder="Enter Password" required>
    <button type="submit">Login</button>
</form>

    <p id="msg"></p>
</div>
    </main>
</body>
</html>
