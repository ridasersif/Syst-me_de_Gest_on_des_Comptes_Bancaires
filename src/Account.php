<?php
require_once 'connect.php';

class Account {
    protected $name;
    protected $balance;
    protected $type_account;
    protected $pdo;

    public function __construct($pdo, $name, $balance, $type_account) {
        $this->pdo = $pdo;
        $this->name = $name;
        $this->balance = $balance;
        $this->type_account = $type_account;
    }

    public function createAccount() {
            $stmt = $this->pdo->prepare('INSERT INTO accounts (name, balance, account_type) VALUES (:name, :balance, :account_type)');
            $stmt->execute([
                ':name' => $this->name,
                ':balance' => $this->balance,
                ':account_type' => $this->type_account
            ]);
    }
    


    public function getAllAccounts() {
            $stmt = $this->pdo->query("SELECT * FROM accounts");
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
