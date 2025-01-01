
<?php
require_once 'Account.php';

class SavingsAccount extends Account {
    private $interest;

    public function __construct($pdo, $name, $balance, $interest) {
        parent::__construct($pdo, $name, $balance, 'savings');
        $this->interest = $interest; 
    }
    public function calculateInterest() {
        return $this->balance * ($this->interest / 100);
    }
    public function createAccount() {
        try {
            parent::createAccount();
            $stmt = $this->pdo->prepare('INSERT INTO savings (account_id, interest) VALUES (:account_id, :interest)');
            $stmt->execute([
                ':account_id' => $this->pdo->lastInsertId(), 
                ':interest' => $this->interest
            ]);
        } catch (PDOException $e) {
            echo "Error interest: " . $e->getMessage();
        }
    }
}
?>
