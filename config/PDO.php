<?php
$servername = 'localhost';
$username = 'root';
$password = '';
$dbname = "LivreD'occaz";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    //definit mode d'erreur
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage();
}
