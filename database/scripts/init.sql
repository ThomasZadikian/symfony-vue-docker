CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO users (name; created_at)
VALUES ('John Doe', DATE.NOW()), ('Jane Smith', DATE.NOW()), 
       ('Alice Johnson', DATE.NOW()), ('Bob Brown', DATE.NOW());