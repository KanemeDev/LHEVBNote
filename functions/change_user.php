<?php
include("db.php");

if ($conn->connect_error) {
    die("Connexion échouée : " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!empty($_POST['username']) && !empty($_POST['categorie'])) {
        $username = $conn->real_escape_string($_POST['username']);
        $categorie = $conn->real_escape_string($_POST['categorie']);

        $sql = "UPDATE users SET categorie = '$categorie' WHERE username = '$username'";

        if ($conn->query($sql) === TRUE) {
            header("Location: " . $_SERVER['HTTP_REFERER']);
            exit();
        } else {
            echo "Erreur : " . $conn->error;
            header("Location: " . $_SERVER['HTTP_REFERER']);
            exit();
        }
    } else {
        header("Location: " . $_SERVER['HTTP_REFERER']);
        exit();
    }
}

$conn->close();
?>