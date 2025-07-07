<?php
require("../inc/function.php");

$titre = isset($_GET['titre']) ? $_GET['titre'] : '';

if (empty($titre)) {
    echo "Aucun titre sélectionné.";
    exit;
}

$query = "
    SELECT 
        t.title,
        COUNT(e.emp_no) AS nb_employes,
        ROUND(AVG(s.salary), 2) AS salaire_moyen
    FROM titles t
    JOIN employees e ON t.emp_no = e.emp_no
    JOIN salaries s ON s.emp_no = e.emp_no
    WHERE t.title = '" . mysqli_real_escape_string(dbconnect(), $titre) . "'
    GROUP BY t.title
";
$result = mysqli_query(dbconnect(), $query);
$data = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Statistiques pour le poste <?= htmlspecialchars($titre) ?></title>
    <link rel="stylesheet" href="../assets/css/bootstrap.css">
</head>
<body>
    <div class="container mt-4">
        <h2>Statistiques pour le poste : <?= htmlspecialchars($titre) ?></h2>
        <?php if ($data) { ?>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Titre</th>
                        <th>Nombre d'employés</th>
                        <th>Salaire moyen (€)</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><?= htmlspecialchars($data['title']) ?></td>
                        <td><?= $data['nb_employes'] ?></td>
                        <td><?= $data['salaire_moyen'] ?></td>
                    </tr>
                </tbody>
            </table>
        <?php } else { ?>
            <div class="alert alert-warning">Aucune donnée pour ce poste.</div>
        <?php } ?>
        <a href="Departement.php" class="btn btn-secondary mt-3">Retour</a>
    </div>
</body>
</html>