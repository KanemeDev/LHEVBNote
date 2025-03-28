<?php 
$team = "M18M";
$entraineur = "Tiemoko Samaké";
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LHEVB - <?php echo $team?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/index.css">
    <link rel="icon" type="image/x-icon" href="../img/favicon.ico">
</head>
<body>
    <div class="d-flex flex-column align-items-center text-center">
        <a href="../"><img src="../img/logo.png" style="width:110px;"></a>
        <h1>LHEVB - APPEL | <?php echo $team; ?></h1>
    </div>
    <section>
        <div class="container">
            <div class="row flex-column flex-md-row align-items-center">
                <div class="bg-dark rounded text-light col-12 col-md-8 border">
                <?php 
                    include('../functions/db.php');
                    $sql = "SELECT id, username, categorie, absences, entrainement FROM users WHERE categorie = '$team'";
                    $result = $conn->query($sql);

                    if ($result && $result->num_rows > 0) {
                        echo '<form class="text-center p-2" method="POST" action="../functions/update_absence.php">';
                        while ($row = $result->fetch_assoc()) {
                            echo '<div class="d-flex mx-auto align-items-center py-3 border-bottom">';
                            echo '  <span class="px-4 fw-bold ">' . htmlspecialchars($row["username"]) . ' | ' . htmlspecialchars($row["categorie"]) .'</span>';
                            echo '  <div class="d-flex align-items-center ms-auto fw-bold">';
                            echo '      <span class="px-4 fw-bold text-danger ">'. htmlspecialchars($row["absences"]) . '/' .htmlspecialchars($row["entrainement"]) .'</span>';
                            echo '      <input class="form-check-input presence-checkbox" type="checkbox" name="absence[' . $row["id"] . ']" value="1">';
                            echo '      <span class="ms-3">Absent</span>';
                            echo '  </div>';
                            echo '  <div class="ms-1 ms-md-5">';
                            echo '      <button type="submit" name="remove_absence" value="' . $row["id"] . '" class="btn btn-danger">Retard</button>';
                            echo '  </div>';
                            echo '</div>';
                        }
                        echo '  <button type="submit" class="btn btn-success mt-2">Valider</button>';
                        echo '  <input type="hidden" name="team" value="' . htmlspecialchars($team) . '">';
                        echo '</form>';
                    } else {
                        echo "Aucun utilisateur trouvé pour la catégorie.";
                    }

                    $conn->close();
                ?>


                </div>
                <input type="hidden" name="team" value="<?php echo $team; ?>">
                <!-- Zone d'informations complémentaires -->
                <div class="col-12 col-md-4 bg-blue rounded text-center mt-3 mt-md-0 border p-2">
                    <h2 class="text-light"><?php echo $team; ?></h2>
                    <h2 class="text-light"><?php echo $entraineur; ?></h2>
                    <h2 class="text-warning"><?php echo "Entraineur"; ?></h2>
                    <h2 class="text-light" id="present-count">0 : Présents</h2>
                    <h2 class="text-light" id="absent-count">0 : Absents</h2>
                    <a href="../admin/admin.php" class="btn btn-danger">Admin</a>
                </div>
            </div>
        </div>
    </section>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const checkboxes = document.querySelectorAll(".presence-checkbox");
            const presentCount = document.getElementById("present-count");
            const absentCount = document.getElementById("absent-count");

            function updateCount() {
                const checkedCount = document.querySelectorAll(".presence-checkbox:checked").length;
                const total = checkboxes.length;
                presentCount.textContent = (total - checkedCount) + " : Présents";
                absentCount.textContent = checkedCount + " : Absents";
            }

            checkboxes.forEach(checkbox => {
                checkbox.addEventListener("change", updateCount);
            });

            updateCount();
        });
    </script>
</body>
</html>
