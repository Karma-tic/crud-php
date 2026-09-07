<?php
require 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $mobile = trim($_POST['mobile']);
    $status = trim($_POST['status']);
    $password = trim($_POST['password']);

    if (!empty($name) && !empty($email) && !empty($password)) {
        $stmt = $pdo->prepare("INSERT INTO users (name, email, mobile, status, password) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$name, $email, $mobile, $status, $password]);
        
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
    <title>Add User</title>
    <style>body { font-family: sans-serif; margin: 20px; }</style>
</head>
<body>
    <h2>Add New User</h2>
    <?php if(isset($error)) echo "<p style='color:red;'>$error</p>"; ?>
    <form method="POST">
        <label>Name:</label><br>
        <input type="text" name="name" required><br><br>
        
        <label>Email:</label><br>
        <input type="email" name="email" required><br><br>

        <label>Mobile Number:</label><br>
        <input type="text" name="mobile" required><br><br>

        <label>Status:</label><br>
        <select name="status">
            <option value="Active">Active</option>
            <option value="Inactive">Inactive</option>
        </select><br><br>

        <label>Password:</label><br>
        <input type="password" name="password" required><br><br>
        
        <button type="submit">Save User</button>
        <a href="index.php">Cancel</a>
    </form>
</body>
</html>
