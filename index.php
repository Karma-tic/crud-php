<?php
require 'db.php';

// Fetch all users
$stmt = $pdo->query("SELECT * FROM users ORDER BY created_at DESC");
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html>
<head>
    <title>PHP CRUD - Users</title>
    <style>
        body { font-family: sans-serif; margin: 20px; }
        table { border-collapse: collapse; width: 600px; margin-top: 15px; }
        th, td { border: 1px solid #ddd; padding: 10px; text-align: left; }
        th { background-color: #f4f4f4; }
        a { text-decoration: none; color: blue; }
        .btn { padding: 8px 12px; background: #28a745; color: white; border-radius: 4px; display: inline-block; }
    </style>
</head>
<body>
    <h2>User Management</h2>
    <a href="create.php" class="btn">+ Add New User</a>
    
    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>City</th>
            <th>Salary</th>
            <th>Actions</th>
        </tr>
        <?php if(count($users) > 0): ?>
            <?php foreach ($users as $user): ?>
            <tr>
                <td><?= $user['id'] ?></td>
                <td><?= htmlspecialchars($user['name']) ?></td>
                <td><?= htmlspecialchars($user['city']) ?></td>
                <td>$<?= number_format($user['salary'], 2) ?></td>
                <td>
                    <a href="update.php?id=<?= $user['id'] ?>">Edit</a> | 
                    <a href="delete.php?id=<?= $user['id'] ?>" onclick="return confirm('Are you sure you want to delete this user?');">Delete</a>
                </td>
            </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr><td colspan="5">No users found.</td></tr>
        <?php endif; ?>
    </table>
</body>
</html>
