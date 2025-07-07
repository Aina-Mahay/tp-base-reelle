SELECT e.first_name,
    d.dept_name,
    e.last_name
FROM employees e
    JOIN dept_manager dm ON e.emp_no = dm.emp_no
    JOIN departments d ON d.dept_no = dm.dept_no


SELECT e.first_name,
    e.last_name,
    de.dept_no
FROM employees e
    JOIN dept_emp de ON de.emp_no = e.emp_no
WHERE de.dept_no = '%s'

SELECT * FROM v_nb_emp_dep 