<?php
include('db.php');

date_default_timezone_set('Europe/Paris');
$date = date('Y-m-d');

if (isset($_POST['absence'])) {
    foreach ($_POST['absence'] as $userId => $absence) {
        // Vérifier si l'absence est marquée
        if ($absence == 1) {
            $sql = "UPDATE users SET absences = absences + 1 WHERE id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $userId);
            $stmt->execute();

            $sql = "SELECT username FROM users WHERE id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $userId);
            $stmt->execute();
            $result = $stmt->get_result();
            if ($row = $result->fetch_assoc()) {
                $name = $row['username'];

                $sql = "INSERT INTO date (name, date) VALUES (?, ?)";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("ss", $name, $date);
                $stmt->execute();
            }
        }
    }
}

if (isset($_POST['remove_absence'])) {
    $userId = $_POST['remove_absence'];

    $sql = "UPDATE users SET absences = GREATEST(absences - 1, 0) WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $userId);
    $stmt->execute();
}

if (isset($_POST['team']) && !isset($_POST['remove_absence'])) {
    $team = $_POST['team'];

    $sql = "UPDATE users SET entrainement = entrainement + 1 WHERE categorie = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $team);
    if ($stmt->execute()) {
        echo "Les entraînements ont été ajoutés avec succès à chaque joueur de la catégorie." ;
    } else {
        echo "Erreur lors de la mise à jour des entraînements : " . $conn->error;
    }
} else {
    echo "Aucune catégorie (team) spécifiée.";
}

header("Location: " . $_SERVER['HTTP_REFERER']);
exit();

$conn->close();
?>
