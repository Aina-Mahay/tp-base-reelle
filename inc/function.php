<?php
require("connexion.php");

function recuperer_departements()
{
    $query = "SELECT * FROM departments";
    $result = mysqli_query(dbconnect(), $query);
    $dept = [];

    while ($ligne = mysqli_fetch_assoc($result)) {
        $dept[] = $ligne;
    }
    return $dept;
}

function recuperer_manager_par_departement()
{
    $query = "SELECT * FROM v_dept_manager";
    $result = mysqli_query(dbconnect(), $query);
    $departements = [];

    while ($ligne = mysqli_fetch_assoc($result)) {
        $departements[$ligne['dept_name']][] = [
            'first_name' => $ligne['first_name'],
            'last_name' => $ligne['last_name']
        ];
    }
    return $departements;
}
function recuperer_employes($dept_no)
{
    $query = "SELECT * FROM v_dept_emp_curr WHERE dept_no = '%s' LIMIT 100";
    $query = sprintf($query,  $dept_no);
    $result = mysqli_query(dbconnect(), $query);
    $employes = [];

    while ($ligne = mysqli_fetch_assoc($result)) {
        $employes[] = $ligne;
    }
    return $employes;
}

function recuperer_employe($emp_no)
{
    $query = "SELECT * FROM v_dept_emp_curr WHERE emp_no = $emp_no";
    $result = mysqli_query(dbconnect(), $query);
    $employe = mysqli_fetch_assoc($result);
    return $employe;
}
function recuperer_depetsalaire($emp_no)
{
    $query = "SELECT d.dept_name, s.salary, s.from_date, s.to_date
              FROM employees e 
              JOIN dept_emp de ON de.emp_no = e.emp_no 
              JOIN departments d ON d.dept_no = de.dept_no
              JOIN salaries s ON s.emp_no = e.emp_no 
              WHERE e.emp_no = $emp_no";
    $result = mysqli_query(dbconnect(), $query);
    $dept_salaries = [];

    while ($ligne = mysqli_fetch_assoc($result)) {
        $dept_name = $ligne['dept_name'];
        $salary = $ligne['salary'];
        $from_date = $ligne['from_date'];
        $to_date = $ligne['to_date'];

        $dept_salaries[$dept_name][] = [
            'salary' => $salary,
            'from_date' => $from_date,
            'to_date' => $to_date
        ];
    }

    return $dept_salaries;
}
function recuperer_historique_postes($emp_no)
{
    $query = "SELECT t.title, t.from_date, t.to_date
              FROM titles t
              WHERE t.emp_no = $emp_no";
    $result = mysqli_query(dbconnect(), $query);
    $postes = [];

    while ($ligne = mysqli_fetch_assoc($result)) {
        $postes[] = [
            'title' => $ligne['title'],
            'from_date' => $ligne['from_date'],
            'to_date' => $ligne['to_date']
        ];
    }

    return $postes;
}
function rechercher($dep, $nom, $min, $max, $limit)
{
    $query = "
    SELECT * FROM v_dept_emp_curr
    WHERE 1=1";

    if (!empty($dep) && $dep !== "tous") {
        $query .= " AND dept_no LIKE '%" . $dep . "%'";
    }
    if (!empty($nom)) {
        $query .= " AND first_name LIKE '%" . $nom . "%'";
    }
    if (!empty($min)) {
        $query .= " AND TIMESTAMPDIFF(YEAR, birth_date, CURDATE()) >= " . intval($min);
    }
    if (!empty($max)) {
        $query .= " AND TIMESTAMPDIFF(YEAR, birth_date, CURDATE()) <= " . intval($max);
    }

    $query .= " LIMIT " . intval($limit) . ", 20";
    $result = mysqli_query(dbconnect(), $query);
    $valiny = [];

    while ($row = mysqli_fetch_assoc($result)) {
        $valiny[] = $row;
    }

    return $valiny;
}
function get_total_pages($dep, $nom, $min, $max) {
    $query = "
    SELECT COUNT(*) AS total
    FROM employees e
    JOIN dept_emp de ON e.emp_no = de.emp_no
    JOIN departments d ON d.dept_no = de.dept_no
    WHERE 1=1";

    if (!empty($dep) && $dep !== "tous") {
        $query .= " AND d.dept_no LIKE '%" . mysqli_real_escape_string(dbconnect(), $dep) . "%'";
    }
    if (!empty($nom)) {
        $query .= " AND e.first_name LIKE '%" . mysqli_real_escape_string(dbconnect(), $nom) . "%'";
    }
    if (!empty($min)) {
        $query .= " AND TIMESTAMPDIFF(YEAR, e.birth_date, CURDATE()) >= " . intval($min);
    }
    if (!empty($max)) {
        $query .= " AND TIMESTAMPDIFF(YEAR, e.birth_date, CURDATE()) <= " . intval($max);
    }

    $result = mysqli_query(dbconnect(), $query);
    $row = mysqli_fetch_assoc($result);

    return ceil($row['total'] / 20);
}
function recuperer_nb_employes_par_departement() {
    $query = "SELECT dept_name, nb FROM v_nb_emp_dep v1";
    $result = mysqli_query(dbconnect(), $query);
    $nb_emp = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $nb_emp[$row['dept_name']] = $row['nb'];
    }
    return $nb_emp;
}
function recuperer_postes() {
    $query = "SELECT DISTINCT title FROM titles";
    $result = mysqli_query(dbconnect(), $query);
    $postes = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $postes[] = $row['title'];
    }
    return $postes;
}

 ?>
