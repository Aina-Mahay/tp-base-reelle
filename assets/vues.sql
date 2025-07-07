CREATE OR REPLACE view v_nb_emp_dep as
SELECT COUNT(v1.emp_no) nb, d.dept_name, d.dept_no
FROM v_dept_emp_curr as v1
    JOIN departments as d ON d.dept_no = v1.dept_no
GROUP BY v1.dept_no

CREATE OR REPLACE view v_dept_manager as
SELECT e.birth_date,
    e.first_name,
    e.last_name,
    e.gender,
    e.hire_date,
    d.dept_name,
    e.emp_no,
    de.to_date
FROM employees e
    JOIN dept_manager de ON de.emp_no = e.emp_no
    JOIN departments d ON d.dept_no = de.dept_no
WHERE de.to_date = "9999-01-01"

CREATE OR REPLACE view v_dept_emp_curr as
SELECT *
FROM v_dept_emp
WHERE to_date = "9999-01-01"

CREATE OR REPLACE view v_dept_emp as
SELECT e.birth_date,
    e.first_name,
    e.last_name,
    e.gender,
    e.hire_date,
    d.dept_name,
    e.emp_no,
    de.to_date,
    de.dept_no
FROM employees e
    JOIN dept_emp de ON de.emp_no = e.emp_no
    JOIN departments d ON d.dept_no = de.dept_no