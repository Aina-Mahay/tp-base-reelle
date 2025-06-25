<?php
require("../inc/function.php");

if (isset($_GET['dept_name'])) {
    $dept_name = $_GET['dept_name'];
    $query = "SELECT dept_no FROM departments WHERE dept_name = '%s'";
    $query = sprintf($query, mysqli_real_escape_string(dbconnect(), $dept_name));
    $result = mysqli_query(dbconnect(), $query);
    $dept_no = mysqli_fetch_assoc($result)['dept_no'];

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
    <link rel="stylesheet" href="../assets/css/bootstrap.css">
    <script src="../assets/js/bootstrap.js"></script>

</head>

<body>
    <h1>Employés du département <?= htmlspecialchars($dept_name) ?></h1>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">First name</th>
                <th scope="col">Last name</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($employes as $employe) { ?>
                <tr onclick="window.location.href='fiches.php?employes=<?= $employe['emp_no'] ?>'" style="cursor: pointer;">
                    <td><?= $employe['first_name'] ?> </td>
                    <td><?= $employe['last_name'] ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

</body>

</html>