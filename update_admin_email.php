<?php
// Simple script to update admin email

$db = new PDO('sqlite:database/database.sqlite');
$stmt = $db->prepare("UPDATE users SET email = 'repairmaxsample@gmail.com' WHERE role = 'admin'");
if ($stmt->execute()) {
    echo "Admin email updated successfully to repairmaxsample@gmail.com\n";
} else {
    echo "Failed to update admin email\n";
}
