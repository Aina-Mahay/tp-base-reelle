<?php
require("../inc/function.php");

// Récupérer les paramètres de recherche depuis l'URL
$dep = isset($_POST['departement']) ? $_POST['departement'] : '';
$nom = isset($_POST['nom_employe']) ? $_POST['nom_employe'] : '';
$min = isset($_POST['age_min']) ? $_POST['age_min'] : 0;
$max = isset($_POST['age_max']) ? $_POST['age_max'] : 100;
$limit = 20;

$total_pages = get_total_pages($dep, $nom, $min, $max);
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
                        <tr onclick="window.location.href='fiches.php?employes=<?= $employe['emp_no'] ?>'" style="cursor: pointer;">
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

        <!-- Pagination -->
        <div class="mt-3">
            <nav>
                <ul class="pagination">
                    <?php for ($i = 0; $i < $total_pages; $i++) { ?>
                        <li class="page-item <?= $i == $page ? 'active' : '' ?>">
                            <a class="page-link" href="resultats.php?page=<?= $i ?>&departement=<?= urlencode($dep) ?>&nom_employe=<?= urlencode($nom) ?>&age_min=<?= $min ?>&age_max=<?= $max ?>">
                                <?= $i + 1 ?>
                            </a>
                        </li>
                    <?php } ?>
                </ul>
            </nav>
        </div>
    </div>
</body>

</html>