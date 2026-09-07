<?php
require 'db.php';

if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit;
}

$id = $_GET['id'];
$stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
$stmt->execute([$id]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$user) {
    die("User not found.");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $mobile = trim($_POST['mobile']);
    $status = trim($_POST['status']);
    $password = trim($_POST['password']);

    if (!empty($name) && !empty($email) && !empty($password)) {
        $stmt = $pdo->prepare("UPDATE users SET name = ?, email = ?, mobile = ?, status = ?, password = ? WHERE id = ?");
        $stmt->execute([$name, $email, $mobile, $status, $password, $id]);
        
        header("Location: index.php");
        exit;
    } else {
        $error = "Please fill in all required fields.";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit User</title>
    <style>body { font-family: sans-serif; margin: 20px; }</style>
</head>
<body>
    <h2>Edit User</h2>
    <?php if(isset($error)) echo "<p style='color:red;'>$error</p>"; ?>
    <form method="POST">
        <label>Name:</label><br>
        <input type="text" name="name" value="<?= htmlspecialchars($user['name']) ?>" required><br><br>
        
        <label>Email:</label><br>
        <input type="email" name="email" value="<?= htmlspecialchars($user['email']) ?>" required><br><br>

        <label>Mobile Number:</label><br>
        <input type="text" name="mobile" value="<?= htmlspecialchars($user['mobile']) ?>" required><br><br>

        <label>Status:</label><br>
        <select name="status">
            <option value="Active" <?= $user['status'] == 'Active' ? 'selected' : '' ?>>Active</option>
            <option value="Inactive" <?= $user['status'] == 'Inactive' ? 'selected' : '' ?>>Inactive</option>
        </select><br><br>

        <label>Password:</label><br>
        <input type="password" name="password" value="<?= htmlspecialchars($user['password']) ?>" required><br><br>
        
        <button type="submit">Update User</button>
        <a href="index.php">Cancel</a>
    </form>
</body>
</html>
