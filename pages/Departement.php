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
<?php
$postes = recuperer_postes();
?>
<div class="container mt-4">
    <h4>Liste des titres de postes :</h4>
    <ul class="list-inline">
        <?php foreach ($postes as $poste) { ?>
            <li class="list-inline-item badge bg-info text-dark mb-2">
                <a href="poste.php?titre=<?= $poste ?>" class="text-dark text-decoration-none"><?= $poste ?></a>
            </li>
        <?php } ?>
    </ul>
</div>
</body>

<body>

    <form action="resultats.php" method="GET" class="container mt-4">
        <div class="row g-3">
            <div class="col-md-4">
                <label for="departement" class="form-label">Département</label>
                <select class="form-select" name="departement" id="departement">
                    <?php
                    $departements = recuperer_departements();
                    foreach ($departements as $departement) { ?>
                        <option value="tous">tous</option>
                        <option value="<?= $departement['dept_no'] ?>"><?= $departement['dept_name'] ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="col-md-4">
                <label for="nom_employe" class="form-label">Nom de l'employé</label>
                <input class="form-control" type="text" name="nom_employe" id="nom_employe" placeholder="Nom de l'employé">
            </div>
            <div class="col-md-2">
                <label for="age_min" class="form-label">Âge minimum</label>
                <input class="form-control" type="number" name="age_min" id="age_min" placeholder="Âge min">
            </div>
            <div class="col-md-2">
                <label for="age_max" class="form-label">Âge maximum</label>
                <input class="form-control" type="number" name="age_max" id="age_max" placeholder="Âge max">
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-md-12 text-end">
                <button type="submit" class="btn btn-primary">Rechercher</button>
            </div>
        </div>
    </form>




    <?php
    $nb_emp = recuperer_nb_employes_par_departement();
    $result = recuperer_manager_par_departement();
    foreach ($result as $dept_name => $managers) { ?>
        <h3>
            <?= $dept_name ?>
            <span class="badge bg-secondary">
                <?= isset($nb_emp[$dept_name]) ? $nb_emp[$dept_name] . ' employés' : '0 employé' ?>
            </span>
            <a href="employes.php?dept_name=<?= urlencode($dept_name) ?>">employés</a>
        </h3>
        <ul class="list-group">
            <?php foreach ($managers as $manager) { ?>
                <li class="list-group-item"><?= $manager["first_name"] ?> <?= $manager["last_name"] ?></li>
            <?php } ?>
        </ul>
    <?php } ?>
</body>

</html>