<?php
require_once 'models/db.php';

session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $db = new Db();
    $conn = $db->getConnection();

    $stmt = $conn->prepare("SELECT * FROM user WHERE email = ?");
    $stmt->bind_param('s', $email);
    $stmt->execute();

    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        if (password_verify($password, $user['password'])) {
            $_SESSION['user'] = [
                'id' => $user['id'],
                'username' => $user['username'],
                'email' => $user['email'],
                'role' => $user['role']
            ];
            header("Location: index.php");
            exit();
        } else {
            $error = "Invalid credentials.";
        }
    } else {
        $error = "User not found.";
    }
}
?>

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
        <button class="btn" onclick="window.location.href='login.php';">Login</button>
        <button class="btn" onclick="window.location.href='register.php';">Register</button>
    </div>
</header>

<main class="container">
    <div class="login-form">
        <h2>Login</h2>
        <?php if (isset($error)): ?>
            <p class="error"><?php echo $error; ?></p>
        <?php endif; ?>
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