<?php
// manage_contributions.php
require_once 'config.php';
session_start();

// Check if user is logged in
if (!isset($_SESSION['username'])) {
    header('Location: loginform.php');
    exit;
}

// Fetch contributions from the database
$sql = "SELECT c.id, m.username as member_name, c.amount, c.contribution_date 
        FROM contributions c 
        JOIN members m ON c.member_id = m.id";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$contributions = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Fetch members for the dropdown
$sql = "SELECT id, username FROM members";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$members = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Contributions</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2>Manage Contributions</h2>
    <a href="admindashboard.php" class="btn btn-primary mb-3">Back to Dashboard</a>
    <table class="table table-bordered">
        <thead>
        <tr>
            <th>ID</th>
            <th>Member</th>
            <th>Amount</th>
            <th>Date</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($contributions as $contribution): ?>
            <tr>
                <td><?php echo htmlspecialchars($contribution['id']); ?></td>
                <td><?php echo htmlspecialchars($contribution['member_name']); ?></td>
                <td><?php echo htmlspecialchars($contribution['amount']); ?></td>
                <td><?php echo htmlspecialchars($contribution['contribution_date']); ?></td>
                <td>
                    <a href="edit_contribution.php?id=<?php echo $contribution['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                    <a href="delete_contribution.php?id=<?php echo $contribution['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this contribution?');">Delete</a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>

    <h3>Add New Contribution</h3>
    <form action="insert_contribution.php" method="POST">
        <div class="form-group">
            <label for="member_id">Member</label>
            <select id="member_id" name="member_id" class="form-control" required>
                <?php foreach ($members as $member): ?>
                    <option value="<?php echo $member['id']; ?>"><?php echo htmlspecialchars($member['username']); ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group">
            <label for="amount">Amount</label>
            <input type="number" id="amount" name="amount" class="form-control" required>
        </div>
        <div class="form-group">
    <label for="contribution_date">Date</label>
    <input type="date" id="contribution_date" name="contribution_date" class="form-control" readonly>
</div>

        <button type="submit" class="btn btn-success">Add Contribution</button>
    </form>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
