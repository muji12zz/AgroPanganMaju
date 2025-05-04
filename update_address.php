<?php
session_start();
include 'db_connect.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $order_id = $_POST['order_id'] ?? null;
    $new_address = $_POST['address'] ?? null;
    $user_id = $_SESSION['user_id'];

    if (!$order_id || !$new_address) {
        $_SESSION['notif'] = ['type' => 'error', 'message' => 'Invalid request.'];
        header("Location: order_detail.php?id=" . $order_id);
        exit();
    }

    // Verify order belongs to user and status is 'Menunggu Pembayaran'
    $order_check = $conn->prepare("SELECT status, address_updated FROM orders WHERE id = ? AND user_id = ?");
    $order_check->bind_param("ii", $order_id, $user_id);
    $order_check->execute();
    $result = $order_check->get_result();

    if ($result->num_rows === 0) {
        $_SESSION['notif'] = ['type' => 'error', 'message' => 'Order not found or you do not have permission.'];
        header("Location: order_detail.php?id=" . $order_id);
        exit();
    }

    $order = $result->fetch_assoc();
    if ($order['status'] !== 'Menunggu Pembayaran') {
        $_SESSION['notif'] = ['type' => 'error', 'message' => "Address can only be updated when order status is 'Menunggu Pembayaran'."];
        header("Location: order_detail.php?id=" . $order_id);
        exit();
    }

    if ($order['address_updated']) {
        $_SESSION['notif'] = ['type' => 'error', 'message' => "Address can only be updated once."];
        header("Location: order_detail.php?id=" . $order_id);
        exit();
    }

    // Update address and mark address_updated as true
    $update_stmt = $conn->prepare("UPDATE orders SET address = ?, address_updated = 1 WHERE id = ? AND user_id = ?");
    $update_stmt->bind_param("sii", $new_address, $order_id, $user_id);
    if ($update_stmt->execute()) {
        $_SESSION['notif'] = ['type' => 'success', 'message' => 'Address updated successfully.'];
        header("Location: order_detail.php?id=" . $order_id);
        exit();
    } else {
        $_SESSION['notif'] = ['type' => 'error', 'message' => 'Failed to update address.'];
        header("Location: order_detail.php?id=" . $order_id);
        exit();
    }
} else {
    $_SESSION['notif'] = ['type' => 'error', 'message' => 'Invalid request method.'];
    header("Location: my_orders.php");
    exit();
}
?>
