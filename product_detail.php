<?php
include 'db_connect.php';
session_start();

$product_id = $_GET['id'];
$product = mysqli_query($conn, "SELECT * FROM products WHERE id = '$product_id'");
if (mysqli_num_rows($product) == 0) {
    echo "Produk tidak ditemukan.";
    exit();
}
$data = mysqli_fetch_assoc($product);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Detail Produk</title>
</head>
<body>
<h2><?= htmlspecialchars($data['name']); ?></h2>
<?php
$avg_rating_result = mysqli_query($conn, "
    SELECT AVG(rating) AS avg_rating, COUNT(*) AS review_count 
    FROM reviews 
    WHERE product_id = '$product_id' AND is_approved = 1
");
$avg_rating_data = mysqli_fetch_assoc($avg_rating_result);
$avg_rating = round($avg_rating_data['avg_rating'], 1);
$review_count = $avg_rating_data['review_count'];
?>
<?php if ($review_count > 0): ?>
    <p><strong>Rating:</strong> 
        <span style="color: #f59e0b; font-size: 1.2em;">
            <?= str_repeat('★', floor($avg_rating)) ?>
            <?= $avg_rating - floor($avg_rating) >= 0.5 ? '½' : '' ?>
        </span>
        (<?= $avg_rating ?> / 5 from <?= $review_count ?> reviews)
    </p>
<?php else: ?>
    <p><strong>Rating:</strong> No reviews yet.</p>
<?php endif; ?>
<p><strong>Deskripsi:</strong> <?= htmlspecialchars($data['description']); ?></p>
<p><strong>Harga:</strong> Rp<?= number_format($data['price']); ?></p>

    <form method="POST" action="add_to_cart.php">
        <input type="hidden" name="product_id" value="<?= $data['id']; ?>">
        <label>Jumlah:</label>
        <input type="number" name="quantity" min="1" value="1" required>
        <button type="submit">Tambahkan ke Keranjang</button>
    </form>

    <hr>

    <h3>Ulasan Produk</h3>
    <?php
    $reviews = mysqli_query($conn, "
        SELECT r.rating, r.review, u.name 
        FROM reviews r 
        JOIN users u ON r.user_id = u.id 
        WHERE r.product_id = '$product_id' AND r.is_approved = 1
        ORDER BY r.id DESC
    ");

    if (mysqli_num_rows($reviews) > 0):
        while ($row = mysqli_fetch_assoc($reviews)):
    ?>
        <div style="border: 1px solid #ccc; padding: 10px; margin-bottom: 10px;">
            <strong><?= htmlspecialchars($row['name']); ?></strong> - 
            <span><?= str_repeat('⭐', $row['rating']); ?></span><br>
            <em><?= htmlspecialchars($row['review']); ?></em>
        </div>
    <?php 
        endwhile;
    else:
        echo "<p>Belum ada ulasan untuk produk ini.</p>";
    endif;
    ?>

    <br>
    <a href="index.php">← Kembali</a>
</body>
</html>
