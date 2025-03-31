<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LHEVB - ADMIN</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/main.css">
    <link rel="icon" type="image/x-icon" href="../img/favicon.ico">
</head>
<body>
    <div class="container d-flex flex-column align-items-center justify-content-center min-vh-100 text-center">
        <a href="admin.php">
            <img src="../img/logo.png" class="mb-4" style="width:110px;">
        </a>
        <h1 class="mb-3 text-light">Ajouter un Joueur</h1>
        <form action="../functions/change_user.php" method="post" class="w-100 w-md-50 p-3">
            <div class="mb-3">
                <label for="username" class="text-light form-label">Nom du Joueur :</label>
                <input type="text" name="username" id="username" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="categorie" class="text-light form-label">Catégorie</label>
                <select name="categorie" id="categorie" class="form-select">
                    <option value="">Sélectionner une catégorie</option>
                    <option value="PNM">PNM</option>
                    <option value="PNF">PNF</option>
                    <option value="R1M">R1M</option>
                    <option value="R1F">R1F</option>
                    <option value="M18M">M18M</option>
                    <option value="M18F">M18F</option>
                    <option value="M15M">M15M</option>
                    <option value="M15F">M15F</option>
                    <option value="M13M">M13M</option>
                    <option value="M13F">M13F</option>
                </select>
            </div>
            <button type="submit" id="btn" class="btn btn-primary w-100">Ajouter</button>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>