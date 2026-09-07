<?php
require 'db.php';

// Check if ID is provided
if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit;
}

$id = $_GET['id'];

// Fetch user data
$stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
$stmt->execute([$id]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$user) {
    die("User not found.");
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST['name']);
    $city = trim($_POST['city']);
    $salary = floatval($_POST['salary']);

    if (!empty($name) && !empty($city) && $salary >= 0) {
        $stmt = $pdo->prepare("UPDATE users SET name = ?, city = ?, salary = ? WHERE id = ?");
        $stmt->execute([$name, $city, $salary, $id]);
        
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
    <title>Edit User</title>
    <style>body { font-family: sans-serif; margin: 20px; }</style>
</head>
<body>
    <h2>Edit User</h2>
    <?php if(isset($error)) echo "<p style='color:red;'>$error</p>"; ?>
    <form method="POST">
        <label>Name:</label><br>
        <input type="text" name="name" value="<?= htmlspecialchars($user['name']) ?>" required><br><br>
        
        <label>City:</label><br>
        <input type="text" name="city" value="<?= htmlspecialchars($user['city']) ?>" required><br><br>
        
        <label>Salary:</label><br>
        <input type="number" step="0.01" name="salary" value="<?= htmlspecialchars($user['salary']) ?>" required><br><br>
        
        <button type="submit">Update User</button>
        <a href="index.php">Cancel</a>
    </form>
</body>
</html>
