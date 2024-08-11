<?php
// insert_loan.php
require_once 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $member_id = $_POST['member_id'];
    $loan_amount = $_POST['loan_amount'];
    $interest_rate = $_POST['interest_rate'];
    $loan_date = $_POST['loan_date'];
    $repayment_date = $_POST['repayment_date'];
    $status = $_POST['status'];

    $sql = "INSERT INTO loans (member_id, loan_amount, interest_rate, loan_date, repayment_date, status) 
            VALUES (:member_id, :loan_amount, :interest_rate, :loan_date, :repayment_date, :status)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        'member_id' => $member_id,
        'loan_amount' => $loan_amount,
        'interest_rate' => $interest_rate,
        'loan_date' => $loan_date,
        'repayment_date' => $repayment_date,
        'status' => $status,
    ]);

    header('Location: manage_loans.php');
    exit;
}
?>
