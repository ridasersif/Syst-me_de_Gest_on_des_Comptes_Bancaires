<?php
require_once 'Account.php';

class CurrentAccount extends Account {
    private $overdraft;

    public function __construct($pdo, $name, $balance, $overdraft) {
        parent::__construct($pdo, $name, $balance, 'current');
        $this->overdraft = $overdraft;
    }

    public function createAccount() {
        try {
            parent::createAccount();
            $stmt = $this->pdo->prepare('INSERT INTO current (account_id, overdraft_limit) VALUES (:account_id, :overdraft_limit)');
            $stmt->execute([
                ':account_id' => $this->pdo->lastInsertId(),
                ':overdraft_limit' => $this->overdraft
            ]);
            ?>
            <div>
           
            </div>
            <?php
           
        } catch (PDOException $e) {
            echo "Error: overdraft " . $e->getMessage();
        }
    }
}
?>
