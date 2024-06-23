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

if (isset($data['username']) && isset($data['email']) && isset($data['password'])) {
    $username = $data['username'];
    $email = $data['email'];
    $password = $data['password'];

    $stmt = $conn->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $username, $email, $password);

    if ($stmt->execute()) {
        echo json_encode(["message" => "User registered successfully"]);
    } else {
        echo json_encode(["message" => "Error registering user"]);
    }

    $stmt->close();
} else {
    echo json_encode(["message" => "Invalid input"]);
}

$conn->close();
?>