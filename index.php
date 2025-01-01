<?php
require_once 'connect.php';
require_once './src/Account.php';
require_once './src/SavingsAccount.php';
require_once './src/CurrentAccount.php';
require_once './src/BusinessAccount.php';

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $balance = $_POST['balance'];
    $account_type = $_POST['account_type'];
    if ($account_type == 'savings') {
        $interest = $_POST['interest'];
        $savingsAccount = new SavingsAccount($pdo, $name, $balance, $interest);
        $savingsAccount->createAccount(); 
    } elseif ($account_type == 'current') {
        $Overdraft = $_POST['Overdraft'];
        $currentAccount = new CurrentAccount($pdo, $name, $balance, $Overdraft);
        $currentAccount->createAccount();
    } elseif ($account_type == 'business') {
        $transaction = $_POST['transaction'];
        $businessAccount = new BusinessAccount($pdo, $name, $balance, $transaction);
        $businessAccount->createAccount();
    }
  
    $account = new Account($pdo, $name, $balance, $account_type); 
    $accounts = $account->getAllAccounts(); 

}
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Manage Accounts</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
  </head>
  <body>
    <div class="container mt-4">
      <h2>Create Account</h2>
      <form method="POST">
        <div class="mb-3">
          <label for="name" class="form-label">Name</label>
          <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="mb-3">
          <label for="balance" class="form-label">Balance</label>
          <input type="number" class="form-control" name="balance" id="balance" required>
        </div>
        <div class="mb-3">
          <label for="account_type" class="form-label">Account Type</label>
          <select class="form-control" name="account_type" id="account_type" required>
            <option value="">Select Account Type</option>
            <option value="savings">Savings</option>
            <option value="current">Current</option>
            <option value="business">Business</option>
          </select>
        </div>
        <div class="mb-3" id="savings_fields" style="display: none;">
          <label for="interest" class="form-label">Interest (%)</label>
          <input type="number" class="form-control" name="interest" id="interest" step="0.01">
        </div>
        <div class="mb-3" id="current_fields" style="display: none;">
          <label for="Overdraft" class="form-label">Overdraft Limit</label>
          <input type="number" class="form-control" name="Overdraft" id="Overdraft" step="0.01">
        </div>
        <div class="mb-3" id="business_fields" style="display: none;">
          <label for="transaction" class="form-label">Transaction Limit</label>
          <input type="number" class="form-control" name="transaction" id="transaction" step="0.01">
        </div>
        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
      </form>
      <hr>

      <h2>Accounts </h2>
      <table class="table table-striped">
        <thead>
          <tr>
            <th>#</th>
            <th>Name</th>
            <th>Balance</th>
            <th>Account Type</th>
            <th>Edit</th> 
            <th>Delete</th>
          </tr>
        </thead>
        <tbody>
          <?php
          foreach($accounts as $account){
            echo "  
             <tr>
                <td>" . htmlspecialchars($account['account_id']) . "</td>
                <td>" . htmlspecialchars($account['name']) . "</td>
                <td>" . htmlspecialchars($account['balance']) . "</td>
                <td>" . htmlspecialchars($account['account_type']) . "</td>
                <td>  <a href='edit.php?id=" . htmlspecialchars($account['account_id']) . "' class='btn btn-warning'>Edit</a> </td>
                <td>   <a href='delete.php?id=" . htmlspecialchars($account['account_id']) . "' class='btn btn-danger'>Delete</a> </td>
                 
             </tr>
            
                 ";
          }
          ?>
        
        </tbody>
      </table>
    </div>
    <script src="main.js?v=1.4"></script>
  </body>
</html>
