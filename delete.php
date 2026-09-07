<?php
require 'db.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    // Delete the user
    $stmt = $pdo->prepare("DELETE FROM users WHERE id = ?");
    $stmt->execute([$id]);
}

// Redirect back to index
header("Location: index.php");
exit;
?>
