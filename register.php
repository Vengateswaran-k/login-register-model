<?php
$host = 'localhost';
$db   = 'web';
$user = 'root';
$pass = '';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$opt = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];
$pdo = new PDO($dsn, $user, $pass, $opt);

if (isset($_POST['register'])) {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $email = $_POST['email'];

    $sql = "INSERT INTO users (username, password, email) VALUES (:username, :password, :email)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        'username' => $username,
        'password' => $password,
        'email' => $email
    ]);

    echo "Registration successful!";
}
?>

<form method="post" action="">
    <label for="username">Username:</label><br>
    <input type="text" id="username" name="username"><br>

    <label for="password">Password:</label><br>
    <input type="password" id="password" name="password"><br>

    <label for="email">Email:</label><br>
    <input type="text" id="email" name="email"><br>

    <input type="submit" name="register" value="Register">
</form>