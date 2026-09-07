<?php
require 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST['name']);
    $city = trim($_POST['city']);
    $salary = floatval($_POST['salary']);

    if (!empty($name) && !empty($city) && $salary >= 0) {
        $stmt = $pdo->prepare("INSERT INTO users (name, city, salary) VALUES (?, ?, ?)");
        $stmt->execute([$name, $city, $salary]);
        
        header("Location: index.php");
        exit;
    } else {
        $error = "Please fill in all fields correctly.";
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
        
        <label>City:</label><br>
        <input type="text" name="city" required><br><br>
        
        <label>Salary:</label><br>
        <input type="number" step="0.01" name="salary" required><br><br>
        
        <button type="submit">Save User</button>
        <a href="index.php">Cancel</a>
    </form>
</body>
</html>
