<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Game Store Login</title>
    <link rel="stylesheet" href="css/loginStyles.css">
</head>
<body>

    <header class="navbar">
        <a href="index.php"><h1>Game Store</h1></a>
        <div class="navbar-right">
            <button class="btn">Login</button>
            <button class="btn">Register</button>
        </div>
    </header>

    <main class="container">
        <div class="login-form">
            <h2>Login</h2>
            <form action="login.php" method="POST">
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password" required>
                </div>
                <button type="submit" class="btnSubmit">Login</button>
            </form>
            <p>Don't have an account? <a href="register.php">Register here</a></p>
        </div>
    </main>

    <footer class="footer">
        <p>&copy; 2024 Game Store - Group 4. All rights reserved.</p>
    </footer>

</body>
</html>
