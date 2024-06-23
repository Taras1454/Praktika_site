<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

$host = '127.0.0.1'; 
$db = 'ft_site'; 
$user = 'root'; 
$pass = ''; 

$dsn = "mysql:host=$host;dbname=$db;charset=utf8";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    echo json_encode(['error' => $e->getMessage()]);
    exit;
}

$sql = "SELECT 
            tt.id_club,
            tt.points,
            tt.wins,
            tt.loses,
            tt.draws,
            tt.goals,
            c.name_team AS club_name,
            c.logo AS club_logo
        FROM 
            turnir_table tt
        JOIN 
            clubs c ON tt.id_club = c.id";

$stmt = $pdo->query($sql);
$data = $stmt->fetchAll();

echo json_encode($data);
