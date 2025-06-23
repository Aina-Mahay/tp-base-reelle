<?php 
require("../inc/function.php");

if (isset($_GET['dept_name'])) {
    $dept_name = $_GET['dept_name'];

    // Récupérer le numéro du département à partir de son nom
    $query = "SELECT dept_no FROM departments WHERE dept_name = '%s'";
    $query = sprintf($query, mysqli_real_escape_string(dbconnect(), $dept_name));
    $result = mysqli_query(dbconnect(), $query);
    $dept_no = mysqli_fetch_assoc($result)['dept_no'];

    // Récupérer les employés du département
    $employes = recuperer_employes($dept_no);
} else {
    echo "Aucun département sélectionné.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employés du département <?= htmlspecialchars($dept_name) ?></title>
</head>
<body>
    <h1>Employés du département <?= htmlspecialchars($dept_name) ?></h1>
    <ul>
        <?php foreach ($employes as $employe) { ?>
            <li><?= $employe['first_name'] ?> <?= $employe['last_name'] ?></li>
        <?php } ?>
    </ul>
</body>
</html>