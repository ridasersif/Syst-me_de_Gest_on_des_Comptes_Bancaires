<?php
require_once 'Account.php';

class BusinessAccount extends Account {
    private $transaction;

    public function __construct($pdo, $name, $balance, $transaction) {
        parent::__construct($pdo, $name, $balance, 'business');
        $this->transaction = $transaction;
    }

    public function createAccount() {
        try {
            parent::createAccount();
            $stmt = $this->pdo->prepare('INSERT INTO business (account_id, transaction_fee) VALUES (:account_id, :transaction_fee)');
            $stmt->execute([
                ':account_id' => $this->pdo->lastInsertId(),
                ':transaction_fee' => $this->transaction
            ]);
            echo "Business account created successfully!";
        } catch (PDOException $e) {
            echo "Error: transaction " . $e->getMessage();
        }
    }
}
?>
