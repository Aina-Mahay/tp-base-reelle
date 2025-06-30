<?php
require("../inc/function.php");

// Récupérer les paramètres de recherche depuis l'URL
$dep = isset($_GET['departement']) ? $_GET['departement'] : '';
$nom = isset($_GET['nom_employe']) ? $_GET['nom_employe'] : '';
$min = isset($_GET['age_min']) ? $_GET['age_min'] : 0;
$max = isset($_GET['age_max']) ? $_GET['age_max'] : 100;
$limit = 20;

// Appeler la fonction rechercher
$resultat = rechercher($dep, $nom, $min, $max, $limit);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Résultats de la recherche</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.css">
    <script src="../assets/js/bootstrap.js"></script>
</head>
<body>
    <div class="container mt-4">
        <h1>Résultats de la recherche</h1>
        <?php if (!empty($resultat)) { ?>
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Prénom</th>
                        <th>Nom</th>
                        <th>Date de naissance</th>
                        <th>Département</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($resultat as $index => $employe) { ?>
                        <tr>
                            <td><?= $index + 1 ?></td>
                            <td><?= htmlspecialchars($employe['first_name']) ?></td>
                            <td><?= htmlspecialchars($employe['last_name']) ?></td>
                            <td><?= htmlspecialchars($employe['birth_date']) ?></td>
                            <td><?= htmlspecialchars($employe['dept_name']) ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        <?php } else { ?>
            <p>Aucun résultat trouvé.</p>
        <?php } ?>
    </div>
</body>
</html>