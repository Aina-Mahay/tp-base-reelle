SELECT e.first_name, d.dept_name, e.last_name FROM employees e JOIN dept_manager dm ON e.emp_no = dm.emp_no JOIN departments d ON d.dept_no = dm.dept_no

SELECT e.first_name, e.last_name, de.dept_no FROM employees e JOIN dept_emp de ON de.emp_no = e.emp_no WHERE de.dept_no = '%s' 

CREATE OR REPLACE view v_dept_emp as 
SELECT e.birth_date, e.first_name, e.last_name, e.gender, e.hire_date ,d.dept_name ,e.emp_no ,de.to_date, de.dept_no
FROM employees e 
JOIN dept_emp de ON de.emp_no=e.emp_no
JOIN departments d ON d.dept_no=de.dept_no

CREATE OR REPLACE view v_dept_emp_curr as 
SELECT * FROM v_dept_emp WHERE to_date = "9999-01-01"

CREATE OR REPLACE view v_dept_manager as 
SELECT e.birth_date, e.first_name, e.last_name, e.gender, e.hire_date ,d.dept_name ,e.emp_no ,de.to_date
FROM employees e 
JOIN dept_manager de ON de.emp_no=e.emp_no
JOIN departments d ON d.dept_no=de.dept_no
WHERE de.to_date = "9999-01-01"