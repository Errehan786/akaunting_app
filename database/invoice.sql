CREATE TABLE invoices (
    id INT AUTO_INCREMENT PRIMARY KEY,
    sender_id INT,
    receiver_id INT,
    amount DECIMAL(10, 2) NULL,
    paid BOOLEAN DEFAULT 0
);