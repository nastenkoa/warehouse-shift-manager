CREATE TABLE users (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    login TEXT UNIQUE NOT NULL,
    password TEXT NOT NULL
);

CREATE TABLE employees (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    name TEXT NOT NULL
);

CREATE TABLE departments (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    department_name TEXT NOT NULL
);

CREATE TABLE data (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    user_id INTEGER NOT NULL,
    employee_id INTEGER NOT NULL,
    department_from_id INTEGER NOT NULL,
    department_to_id INTEGER NOT NULL,
    time TEXT NOT NULL,
    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (employee_id) REFERENCES employees(id),
    FOREIGN KEY (department_from_id) REFERENCES departments(id),
    FOREIGN KEY (department_to_id) REFERENCES departments(id)
);