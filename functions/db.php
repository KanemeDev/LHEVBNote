<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "lhevb";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connexion échouée : " . $conn->connect_error);
}
?>