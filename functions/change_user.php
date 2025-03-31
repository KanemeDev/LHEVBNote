<?php
include("db.php");

if ($conn->connect_error) {
    die("Connexion échouée : " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!empty($_POST['username']) && !empty($_POST['categorie'])) {
        $username = $conn->real_escape_string($_POST['username']);
        $categorie = $conn->real_escape_string($_POST['categorie']);

        $checkUserSql = "SELECT * FROM users WHERE username = '$username'";
        $result = $conn->query($checkUserSql);

        if ($result->num_rows > 0) {
            $sql = "UPDATE users SET categorie = '$categorie' WHERE username = '$username'";

            if ($conn->query($sql) === TRUE) {
                echo '<script>alert("Utilisateur Modifié !");window.location.href = "' . $_SERVER['HTTP_REFERER'] . '";</script>';
                exit();
            } else {
                echo '<script>alert("Erreur lors de la mise à jour : ' . $conn->error . '");window.location.href = "' . $_SERVER['HTTP_REFERER'] . '";</script>';
                exit();
            }
        } else {
            echo '<script>alert("Utilisateur non trouvé !");window.location.href = "' . $_SERVER['HTTP_REFERER'] . '";</script>';
            exit();
        }
    } else {
        echo '<script>alert("Veuillez remplir tous les champs.");window.location.href = "' . $_SERVER['HTTP_REFERER'] . '";</script>';
        exit();
    }
}

$conn->close();
?>