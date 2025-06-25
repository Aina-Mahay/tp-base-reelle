<?php 
require("../inc/function.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">  
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Departements</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.css">
    <script src="../assets/js/bootstrap.js"></script>
</head>
<body>
    <?php 
    $result = recuperer_manager_par_departement();
    foreach ($result as $dept_name => $managers) { ?>
        <h3>
            <?= $dept_name ?> 
            <a href="employes.php?dept_name=<?= $dept_name ?>">employés</a>
        </h3>
        <ul class="list-group">
            <?php foreach ($managers as $manager) { ?>
                <li class="list-group-item"><?= $manager["first_name"] ?> <?= $manager["last_name"] ?></li>
            <?php } ?>
        </ul>
    <?php } ?>
</body>
</html>