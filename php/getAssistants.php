<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

$host = '127.0.0.1';
$db = 'ft_site';
$user = 'root';
$pass = '';

$dsn = "mysql:host=$host;dbname=$db;charset=utf8";
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    echo json_encode(['error' => $e->getMessage()]);
    exit;
}

$sql = "SELECT 
            asst.name,
            asst.assists,
            asst.position,
            asst.national AS national_image,
            asst.photo AS player_photo,
            c.logo AS club_logo
        FROM 
            assistants asst
        JOIN 
            clubs c ON asst.id_team = c.id";

$stmt = $pdo->query($sql);
$data = $stmt->fetchAll();

echo json_encode($data);
?>
