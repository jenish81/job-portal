<?php
session_start();
if (isset($_COOKIE['username'])) {
    $saved_username = $_COOKIE['username'];
} else {
    $saved_username = '';
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $remember_me = isset($_POST['remember_me']) ? true : false;

    $users_file = 'users.json';
    if (file_exists($users_file)) {
        $users_data = json_decode(file_get_contents($users_file), true);

        foreach ($users_data as $user) {
            if ($user['username'] === $username && password_verify($password, $user['password'])) {
                $_SESSION['username'] = $username;

                if ($remember_me) {
                    setcookie('username', $username, time() + (7 * 24 * 60 * 60)); 
                } else {
                    setcookie('username', '', time() - 3600);
                }

                header('Location: portal.php');
                exit();
            }
        }
        $error_message = "Invalid username or password"; 
    } else {
        $error_message = "Users database not found.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .login-form {
            width: 300px;
        }

        .login-form label,
        .login-form input,
        .login-form button {
            display: block;
            width: 100%;
            margin-bottom: 15px;
        }

        .login-form input[type="checkbox"] {
            width: auto;
            display: inline-block;
        }
    </style>
</head>
<body>
    <div class="login-form">
        <h2>Login</h2>
        <form method="POST" action="index.php">
            <label for="username">Username:</label>
            <input type="text" name="username" id="username" value="<?php echo htmlspecialchars($saved_username); ?>" required>

            <label for="password">Password:</label>
            <input type="password" name="password" id="password" required>

            <label>
                <input type="checkbox" name="remember_me" <?php if (!empty($saved_username)) echo 'checked'; ?>> Remember Me
            </label>

            <button type="submit">Login</button>
        </form>

        <?php if (isset($error_message)): ?>
            <p style="color: red;"><?php echo $error_message; ?></p>
        <?php endif; ?>

        <p><a href="registration.php">Sign up</a></p>
    </div>
</body>
</html>