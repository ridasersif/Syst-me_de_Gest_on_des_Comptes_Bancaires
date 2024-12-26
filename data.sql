CREATE TABLE neobank;
USE neobank;

CREATE TABLE accounts(
	account_id int AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(200) not null,
     account_type ENUM('savings', 'current', 'business') NOT NULL,
    account_type ENUM()
);
CREATE TABLE savings(
    account_id int PRIMARY KEY,
    interest DECIMAL(5,2),
    FOREIGN KEY (account_id) REFERENCES accounts(account_id) ON DELETE CASCADE   
);
CREATE TABLE  current(
    account_id int PRIMARY KEY,
     overdraft_limit DECIMAL(10, 2) NOT NULL,
    FOREIGN KEY (account_id) REFERENCES accounts(account_id) ON DELETE CASCADE   
);