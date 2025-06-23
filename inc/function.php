<?
require("connexion.php");

function recuperer_departements(){
    $query = "SELECT * FROM departments";
    $result = mysqli_query(dbconnect(),$query);
    $dept = [];

    while ($ligne = mysqli_fetch_assoc($result)) {
        $dept[] = $ligne;
    }
    return $dept;
}

function recuperer_manager_par_departement() {
    $query = "SELECT d.dept_name, e.first_name, e.last_name 
              FROM employees e 
              JOIN dept_manager dm ON e.emp_no = dm.emp_no 
              JOIN departments d ON d.dept_no = dm.dept_no 
              ORDER BY d.dept_name, e.last_name";
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
function recuperer_employes($dept_no) {
    $query = "SELECT e.first_name, e.last_name 
              FROM employees e 
              JOIN dept_emp de ON de.emp_no = e.emp_no 
              WHERE de.dept_no = '%s'
              LIMIT 100";
    $query = sprintf($query,  $dept_no);
    $result = mysqli_query(dbconnect(), $query);
    $employes = [];

    while ($ligne = mysqli_fetch_assoc($result)) {
        $employes[] = $ligne;
    }
    return $employes;
}