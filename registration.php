<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $users_file = 'users.json';
    if (!file_exists($users_file)) {
        file_put_contents($users_file, json_encode([]));
    }
    
    $users_data = json_decode(file_get_contents($users_file), true);
    $users_data[] = ['username' => $username, 'email' => $email, 'password' => $password];
    file_put_contents($users_file, json_encode($users_data));

    header('Location: index.php');
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Registration</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .register-form {
            width: 300px;
        }

        .register-form label,
        .register-form input,
        .register-form button {
            display: block;
            width: 100%;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>
    <div class="register-form">
        <h2>Register</h2>
        <form method="POST" action="registration.php">
            <label>Username:</label>
            <input type="text" name="username" required>

            <label>Email:</label>
            <input type="email" name="email" required>

            <label>Password:</label>
            <input type="password" name="password" required>

            <button type="submit">Register</button>
        </form>
    </div>
</body>
</html>