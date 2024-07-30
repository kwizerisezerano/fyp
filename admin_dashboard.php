<?php
session_start();
require_once 'config.php';

// Check if the user is logged in and is an admin
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}

// Fetch members, contributions, loans, penalties, profits, and dividends for display
$members = $pdo->query("SELECT * FROM members")->fetchAll();
$contributions = $pdo->query("SELECT * FROM contributions")->fetchAll();
$loans = $pdo->query("SELECT * FROM loans")->fetchAll();
$penalties = $pdo->query("SELECT * FROM penalties")->fetchAll();
$profits = $pdo->query("SELECT * FROM profits")->fetchAll();
$dividends = $pdo->query("SELECT * FROM dividends")->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h1>Admin Dashboard</h1>
        <h2>Members</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Phone Number</th>
                    <th>Type</th>
                    <th>Address</th>
                    <th>Join Date</th>
                    <th>Username</th>
                    <th>Role</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($members as $member): ?>
                <tr>
                    <td><?= htmlspecialchars($member['id']) ?></td>
                    <td><?= htmlspecialchars($member['first_name']) ?></td>
                    <td><?= htmlspecialchars($member['last_name']) ?></td>
                    <td><?= htmlspecialchars($member['phone_number']) ?></td>
                    <td><?= htmlspecialchars($member['type']) ?></td>
                    <td><?= htmlspecialchars($member['address']) ?></td>
                    <td><?= htmlspecialchars($member['join_date']) ?></td>
                    <td><?= htmlspecialchars($member['username']) ?></td>
                    <td><?= htmlspecialchars($member['role']) ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <h2>Contributions</h2>
        <table class="table table-bordered">
            <!-- Similar structure for displaying contributions -->
        </table>

        <h2>Loans</h2>
        <table class="table table-bordered">
            <!-- Similar structure for displaying loans -->
        </table>

        <h2>Penalties</h2>
        <table class="table table-bordered">
            <!-- Similar structure for displaying penalties -->
        </table>

        <h2>Profits</h2>
        <table class="table table-bordered">
            <!-- Similar structure for displaying profits -->
        </table>

        <h2>Dividends</h2>
        <table class="table table-bordered">
            <!-- Similar structure for displaying dividends -->
        </table>
    </div>
</body>
</html>
