<?php
include '../koneksi.php';
session_start();

// Pastikan sesi telah dimulai
if (!isset($_SESSION['user_data']['customerid'])) {
    echo "Error: Customer ID tidak ditemukan dalam sesi.";
    exit;
}

// Ambil data dari permintaan AJAX
$orderID = $_POST['orderID'];
$alamatPengiriman = $_POST['alamatPengiriman'];
$totalPembayaran = $_POST['totalPembayaran'];
$produkIDs = $_POST['produkIDs'];
$jumlahs = $_POST['jumlahs'];
$customerID = $_SESSION['user_data']['customerid'];
$status = 1;

// Siapkan statement SQL untuk tabel 'order'
$sqlOrder = $conn->prepare("INSERT INTO `order` (order_id, orderdate, customerid, alamat, total_bayar, status) VALUES (?, NOW(), ?, ?, ?, ?)");
$sqlOrder->bind_param("sssdi", $orderID, $customerID, $alamatPengiriman, $totalPembayaran, $status);



// Eksekusi prepared statement untuk tabel 'order'
if ($sqlOrder->execute()) {
    // Jika data berhasil disimpan ke 'order', lanjutkan untuk menyimpan ke 'detail_order'

    // Siapkan statement SQL untuk tabel 'detail_order'
    $sqlDetailOrder = $conn->prepare("INSERT INTO detail_order (orderid, produk_id, jumlah) VALUES (?, ?, ?)");

    // Iterasi melalui setiap produk untuk menyimpan ke 'detail_order'
    for ($i = 0; $i < count($produkIDs); $i++) {
        $produkID = $produkIDs[$i];
        $jumlah = $jumlahs[$i];

        // Eksekusi prepared statement untuk tabel 'detail_order'
        $sqlDetailOrder->bind_param("sii", $orderID, $produkID, $jumlah);
        $sqlDetailOrder->execute();
    }

    // Berhasil menyimpan ke kedua tabel
    echo "Pesanan berhasil disimpan!";
} else {
    // Jika ada kesalahan dalam menyimpan ke 'order'
    echo "Error: Gagal menyimpan pesanan. " . $sqlOrder->error;
}


?>