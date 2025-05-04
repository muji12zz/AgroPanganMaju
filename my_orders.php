<?php
include 'db_connect.php';
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'user') {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

$orders = mysqli_query($conn, "
    SELECT * FROM orders 
    WHERE user_id = '$user_id' 
    ORDER BY order_date DESC
");
?>

<?php include 'header.php'; ?>

<div class="bg-yellow-100 min-h-screen p-6">
    <div class="max-w-7xl mx-auto bg-white rounded-xl shadow-lg p-6 overflow-x-auto">
        <h1 class="text-orange-600 font-extrabold text-3xl mb-8 text-center">My Orders</h1>
        
        <?php if (mysqli_num_rows($orders) > 0): ?>
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-orange-600 text-white rounded-t-xl">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-sm font-semibold uppercase tracking-wider rounded-tl-xl">No</th>
                        <th scope="col" class="px-6 py-3 text-left text-sm font-semibold uppercase tracking-wider">Tanggal</th>
                        <th scope="col" class="px-6 py-3 text-left text-sm font-semibold uppercase tracking-wider">Alamat</th>
                        <th scope="col" class="px-6 py-3 text-left text-sm font-semibold uppercase tracking-wider">Metode Pembayaran</th>
                        <th scope="col" class="px-6 py-3 text-left text-sm font-semibold uppercase tracking-wider">Status</th>
                        <th scope="col" class="px-6 py-3 text-left text-sm font-semibold uppercase tracking-wider">Deskripsi Pengiriman</th>
                        <th scope="col" class="px-6 py-3 text-left text-sm font-semibold uppercase tracking-wider">Rating</th>
                        <th scope="col" class="px-6 py-3 text-left text-sm font-semibold uppercase tracking-wider rounded-tr-xl">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <?php 
                    $no = 1;
                    while ($row = mysqli_fetch_assoc($orders)): 
                        $order_id = $row['id'];
                        $cek_review = mysqli_query($conn, "SELECT * FROM reviews WHERE order_id = '$order_id' AND user_id = '$user_id'");
                    ?>
                    <tr class="hover:bg-yellow-50 transition-colors duration-200">
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900"><?php echo $no++; ?></td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700"><?php echo htmlspecialchars($row['order_date']); ?></td>
                        <td class="px-6 py-4 max-w-xs truncate text-sm text-gray-700" title="<?php echo htmlspecialchars($row['address']); ?>">
                            <?php echo htmlspecialchars($row['address']); ?>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                            <?php echo htmlspecialchars($row['payment_method'] == 'cod' ? 'COD (Bayar di Tempat)' : 'Transfer Bank'); ?>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="inline-block px-3 py-1 text-xs font-semibold rounded-full 
                                <?php 
                                echo $row['status'] == 'Menunggu Pembayaran' ? 'bg-gray-200 text-gray-800' : 
                                     ($row['status'] == 'Diproses' ? 'bg-yellow-200 text-yellow-800' : 
                                     ($row['status'] == 'Dikirim' ? 'bg-green-200 text-green-800' : 
                                     ($row['status'] == 'Selesai' ? 'bg-blue-200 text-blue-800' : 
                                     ($row['status'] == 'Dibatalkan' ? 'bg-red-200 text-red-800' : 'bg-gray-200 text-gray-800')))); 
                                ?>">
                                <?php echo htmlspecialchars($row['status']); ?>
                            </span>
                        </td>
                        <td class="px-6 py-4 max-w-xs truncate text-sm text-gray-700" title="<?php echo htmlspecialchars($row['tracking_info'] ?: 'Belum ada info'); ?>">
                            <?php echo htmlspecialchars($row['tracking_info'] ?: 'Belum ada info'); ?>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-center">
                            <?php if ($row['status'] == 'Selesai' && mysqli_num_rows($cek_review) == 0): ?>
                                <a href="order_detail.php?id=<?php echo htmlspecialchars($row['id']); ?>" class="text-orange-600 font-semibold hover:underline">Rate Order</a>
                            <?php elseif ($row['status'] == 'Selesai' && mysqli_num_rows($cek_review) > 0): ?>
                                <span class="text-green-600 font-semibold">Reviewed</span>
                            <?php else: ?>
                                <span class="text-gray-500">-</span>
                            <?php endif; ?>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-orange-600 cursor-pointer hover:underline">
                            <a href="order_detail.php?id=<?php echo htmlspecialchars($row['id']); ?>">Lihat Detail</a>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p class="text-gray-700 text-center text-lg">Belum ada pesanan.</p>
        <?php endif; ?>
    </div>
</div>

<?php include 'footer.php'; ?>
