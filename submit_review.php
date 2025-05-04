<?php
include 'db_connect.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $order_id = $_POST['order_id'];
    $user_id = $_POST['user_id'];
    $product_id = $_POST['product_id'];
    $rating = $_POST['rating'];
    $review = mysqli_real_escape_string($conn, $_POST['review']);

    $query = "INSERT INTO reviews (order_id, user_id, product_id, rating, review) 
              VALUES ('$order_id', '$user_id', '$product_id', '$rating', '$review')";

    if (mysqli_query($conn, $query)) {
        echo "<script>alert('Ulasan berhasil dikirim!'); window.location='order_detail.php?id=$order_id';</script>";
    } else {
        echo "Gagal menyimpan ulasan: " . mysqli_error($conn);
    }
}
?>
