<?php
$host = 'sql201.infinityfree.com'; 
$db_name = 'if0_37726260_moda_urbana_db'; 
$username = 'if0_37726260'; 
$password = 'FtezpWVnDq'; 

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db_name;charset=utf8mb4", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>
