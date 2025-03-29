<?php
$team = '';

include('../functions/db.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!empty($_POST["team"])) {
        $team = $conn->real_escape_string($_POST["team"]);
    }

    if (isset($_POST["remove_training"]) && !empty($team)) {
        $sql = "UPDATE users SET entrainement = GREATEST(entrainement - 1, 0) WHERE categorie = '$team'";
        $conn->query($sql);
    }

    if (isset($_POST["reset_stats"]) && !empty($team)) {
        $sql = "UPDATE users SET absences = 0, entrainement = 0 WHERE categorie = '$team'";
        $conn->query($sql);
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LHEVB - ADMIN</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/main.css">
    <link rel="icon" type="image/x-icon" href="../img/favicon.ico">
</head>
<body>
    <div class="container d-flex flex-column align-items-center justify-content-center min-vh-100 text-center">
        <a href="admin.php"><img src="../img/logo.png" class="mb-4" style="width:110px;"></a>
        <form action="" method="post">
            <div class="p-2">
                <label for="categorie" class="form-label text-light">Administration Catégorie</label>
                <select name="team" id="categorie" class="form-select">
                    <option value="">Sélectionner une catégorie</option>
                    <option value="PNM" <?= ($team == 'PNM') ? 'selected' : '' ?>>PNM</option>
                    <option value="PNF" <?= ($team == 'PNF') ? 'selected' : '' ?>>PNF</option>
                    <option value="R1M" <?= ($team == 'R1M') ? 'selected' : '' ?>>R1M</option>
                    <option value="R1F" <?= ($team == 'R1F') ? 'selected' : '' ?>>R1F</option>
                    <option value="M18M" <?= ($team == 'M18M') ? 'selected' : '' ?>>M18M</option>
                    <option value="M18F" <?= ($team == 'M18F') ? 'selected' : '' ?>>M18F</option>
                    <option value="M15M" <?= ($team == 'M15M') ? 'selected' : '' ?>>M15M</option>
                    <option value="M15F" <?= ($team == 'M15F') ? 'selected' : '' ?>>M15F</option>
                    <option value="M13M" <?= ($team == 'M13M') ? 'selected' : '' ?>>M13M</option>
                    <option value="M13F" <?= ($team == 'M13F') ? 'selected' : '' ?>>M13F</option>
                </select>
            </div>
            <button type="submit" class="btn btn-success">Afficher</button>
        </form>
        <form action="" method="post" class="mt-3">
            <input type="hidden" name="team" value="<?= htmlspecialchars($team) ?>">
            <button type="submit" name="remove_training" class="btn text-light btn-warning w-100 mb-2">Retirer un entraînement</button>
            <button type="submit" name="reset_stats" class="btn text-light btn-danger w-100">Reset absences/entraînements</button>
        </form>

        <section>
            <div class="container">
                <div class="row flex-column flex-md-row align-items-center p-3">
                    <div class="bg-dark rounded text-light col border">
                        <?php
                        include('../functions/db.php');

                        if (!empty($team)) {
                            $sql = "SELECT id, username, categorie, absences, entrainement FROM users WHERE categorie = '$team'";
                            $result = $conn->query($sql);
                            
                            if ($result && $result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    $absences = (int)$row["absences"];
                                    $entrainements = (int)$row["entrainement"];
                                    $percentage = $entrainements > 0 ? round(($absences / $entrainements) * 100, 2) : 0;
                                    
                                    echo '<div class="d-flex mx-auto align-items-center py-3 border-bottom">';
                                    echo '  <span class="px-4 fw-bold">' . htmlspecialchars($row["username"]) . ' | ' . htmlspecialchars($row["categorie"]) . '</span>';
                                    echo '  <div class="d-flex align-items-center ms-auto fw-bold">';
                                    echo '      <span class="d-flex align-items-center ms-auto fw-bold text-warning">'.'(' . $percentage . '%)</span>';
                                    echo '      <span class="px-4 fw-bold text-danger">'. htmlspecialchars($absences) . '/' .htmlspecialchars($entrainements) .'</span>';
                                    echo '  </div>';
                                    echo '</div>';
                                }
                            } else {
                                echo "Aucun utilisateur trouvé pour cette catégorie.";
                            }
                        } else {
                            echo "Veuillez sélectionner une catégorie.";
                        }

                        $conn->close();
                        ?>
                    </div>
                </div>
            </div>
        </section>
    </div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
