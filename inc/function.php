<?

use LDAP\Result;

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
function recuperer_employes($dept_no)
{
    $query = "SELECT e.first_name, e.last_name, e.emp_no
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

function recuperer_employe($emp_no)
{
    $query = "SELECT e.birth_date, e.first_name, e.last_name, e.gender, e.hire_date ,d.dept_name
    FROM employees e 
    JOIN dept_emp de ON de.emp_no = e.emp_no 
    JOIN departments d ON d.dept_no = de.dept_no
    WHERE e.emp_no = $emp_no";
    // $query = sprintf($emp_no, $query); 
    $result = mysqli_query(dbconnect(), $query);
    $employe = mysqli_fetch_assoc($result);
    return $employe;
}
function recuperer_depetsalaire($emp_no) {
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
function recuperer_historique_postes($emp_no) {
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