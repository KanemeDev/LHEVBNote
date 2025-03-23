<?php
include("db.php");

if ($conn->connect_error) {
    die("Connexion échouée : " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!empty($_POST['username']) && !empty($_POST['categorie'])) {
        $username = $conn->real_escape_string($_POST['username']);
        $categorie = $conn->real_escape_string($_POST['categorie']);

        $sql = "INSERT INTO users (username, categorie) VALUES ('$username', '$categorie')";

        if ($conn->query($sql) === TRUE) {
            header("Location: " . $_SERVER['HTTP_REFERER']);
            exit();
        } else {
            echo "Erreur : " . $conn->error;
        }
    } else {
        echo "Veuillez remplir tous les champs.";
    }
}

$conn->close();
?>
