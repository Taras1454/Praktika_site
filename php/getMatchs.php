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
            m.tour,
            m.home_team_goals,
            m.away_team_goals,
            m.date,
            hc.name_team AS home_team_name,
            hc.logo AS home_team_logo,
            ac.name_team AS away_team_name,
            ac.logo AS away_team_logo
        FROM 
            matchs m
        JOIN 
            clubs hc ON m.home_team_id = hc.id
        JOIN 
            clubs ac ON m.away_team_id = ac.id
        ORDER BY 
            m.tour, m.date";

$stmt = $pdo->query($sql);
$data = $stmt->fetchAll();

echo json_encode($data);
?>
