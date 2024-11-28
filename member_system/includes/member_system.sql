CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100),
    address VARCHAR(255),
    dob DATE,
    phone VARCHAR(20),
    email VARCHAR(100) UNIQUE,
    password VARCHAR(255),
    grade ENUM('C', 'B', 'A') DEFAULT 'C'
);
