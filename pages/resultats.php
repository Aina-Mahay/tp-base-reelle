<?php
require("../inc/function.php");

$dep = isset($_GET['departement']) ? $_GET['departement'] : '';
$nom = isset($_GET['nom_employe']) ? $_GET['nom_employe'] : '';
$min = isset($_GET['age_min']) ? $_GET['age_min'] : 0;
$max = isset($_GET['age_max']) ? $_GET['age_max'] : 200;
$page = isset($_GET['page']) ? intval($_GET['page']) : 0;
$offset = $page * 20;

$resultat = rechercher($dep, $nom, $min, $max, $offset);
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
                            <td><?= $index + 1 + $offset ?></td>
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

        <!-- Liens de pagination -->
        <div class="mt-3">
            <?php if ($page > 0) { ?>
                <a href="resultats.php?page=<?= $page - 1 ?>&departement=<?= urlencode($dep) ?>&nom_employe=<?= urlencode($nom) ?>&age_min=<?= $min ?>&age_max=<?= $max ?>" class="btn btn-secondary">Précédent</a>
            <?php } ?>
            <a href="resultats.php?page=<?= $page + 1 ?>&departement=<?= urlencode($dep) ?>&nom_employe=<?= urlencode($nom) ?>&age_min=<?= $min ?>&age_max=<?= $max ?>" class="btn btn-primary">Suivant</a>
        </div>
    </div>
</body>

</html>