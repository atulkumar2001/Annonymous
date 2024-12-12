<?php
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET['username'], $_GET['email'], $_GET['password'])) {
        $username = $_GET['username'];
        $email = $_GET['email'];
        $password = $_GET['password'];
        $password_hash = password_hash($password, PASSWORD_BCRYPT);

        try {
            $stmt = $pdo->prepare("INSERT INTO users (username, email, password_hash) VALUES (?, ?, ?)");
            $stmt->execute([$username, $email, $password_hash]);
            // Redirect to homepage
            header("Location: index.html");
            exit;
        } catch (PDOException $e) {
            if ($e->getCode() === '23000') {
                echo "Username already exists!";
            } else {
                echo "Error: " . $e->getMessage();
            }
        }
    } else {
        echo "You are not registered!";
    }
}
?>
