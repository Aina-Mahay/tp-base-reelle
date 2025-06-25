<?php 
require("../inc/function.php");
$emp_no = $_GET['employes'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fiche Employé</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.css">
    <script src="../assets/js/bootstrap.js"></script>
</head>
<body>
    <?php 
    $emp = recuperer_employe($emp_no);
    $dept_salaries = recuperer_depetsalaire($emp_no);
    $postes = recuperer_historique_postes($emp_no);
    ?>
    <div class="card">
        <div class="card-body">
            <h4 class="card-title"><?= $emp['first_name'] ?> <?= $emp['last_name'] ?></h4>
            <p class="card-text">Nom : <?= $emp['first_name'] ?> <?= $emp['last_name'] ?></p>
            <p class="card-text">Date de naissance : <?= $emp['birth_date'] ?></p>
            <p class="card-text">Genre : <?= $emp['gender'] ?></p>
            <p class="card-text">Date d'embauche : <?= $emp['hire_date'] ?></p>
        </div>
    </div>
    <div class="mt-4">
        <h5>Historique des postes :</h5>
        <ul>
            <?php foreach ($postes as $poste) { ?>
                <li><?= $poste['title'] ?> (de <?= $poste['from_date'] ?> à <?= $poste['to_date'] ?>)</li>
            <?php } ?>
        </ul>
    </div>

    <div class="mt-4">
        <h5>Historique des salaires :</h5>
        <?php foreach ($dept_salaries as $dept_name => $salaries) { ?>
            <h6><?= $dept_name ?></h6>
            <ul>
                <?php foreach ($salaries as $salary) { ?>
                    <li><?= $salary['salary'] ?> € (de <?= $salary['from_date'] ?> à <?= $salary['to_date'] ?>)</li>
                <?php } ?>
            </ul>
        <?php } ?>
    </div>

    
</body>
</html>