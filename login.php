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

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE username = :username";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['username' => $username]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        echo "Login successful!";
    } else {
        echo "Invalid username or password!";
    }
}
?>

<form method="post" action="">
    <label for="username">Username:</label><br>
    <input type="text" id="username" name="username"><br>

    <label for="password">Password:</label><br>
    <input type="password" id="password" name="password"><br>

    <input type="submit" name="login" value="Login">
</form>