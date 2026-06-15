<?php
session_start();
require_once 'config/database.php';

$database = new Database();
$db = $database->getConnection();

$order_id = $_POST['order_id'];
$status = $_POST['status'] ?? 'paid';
$payment_method = $_POST['payment_method'] ?? null;

/* update status + payment method */
$stmt = $db->prepare("
UPDATE orders
SET status = ?,
    payment_method = ?
WHERE id = ?
");

$stmt->execute([
    $status,
    $payment_method,
    $order_id
]);

echo "success";