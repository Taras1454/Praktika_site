<?php
header("Access-Control-Allow-Origin: http://localhost:5173");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type");

$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "ft_site";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$data = json_decode(file_get_contents("php://input"), true);

if (isset($data['email']) && isset($data['password'])) {
    $email = $data['email'];
    $password = $data['password'];

    $stmt = $conn->prepare("SELECT name, email FROM users WHERE email = ? AND password = ?");
    $stmt->bind_param("ss", $email, $password);
    $stmt->execute();
    $stmt->bind_result($username, $email);

    if ($stmt->fetch()) {
        echo json_encode(["success" => true, "username" => $username, "email" => $email]);
    } else {
        echo json_encode(["success" => false, "message" => "Неправильний email або пароль"]);
    }

    $stmt->close();
} else {
    echo json_encode(["success" => false, "message" => "Невірні дані"]);
}

$conn->close();
?>
