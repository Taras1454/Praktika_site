<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "ft_site";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Запит для отримання даних чемпіонату з об'єднанням клубів
$sql = "SELECT logo,name_team FROM clubs";

$result = $conn->query($sql);

$tableData = array();
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $tableData[] = $row;
    }
}

echo json_encode($tableData);

$conn->close();
?>
