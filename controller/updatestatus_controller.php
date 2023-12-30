<?php
// Menghubungkan ke database (gunakan koneksi.php atau sesuaikan dengan kebutuhan Anda)
include '../koneksi.php';

// Menerima data order_id dari parameter GET
$order_id = isset($_GET['order_id']) ? $_GET['order_id'] : '';

if ($order_id != '') {
    // Melakukan update status order
    // $new_status = 2; // Ganti dengan nilai status baru yang diinginkan
    $order_id = mysqli_real_escape_string($conn, $order_id);

    $sql = "UPDATE `order` SET `status` = '2' WHERE `order`.`order_id` = '$order_id'";

    if ($conn->query($sql) === TRUE) {
        // Jika berhasil, alihkan ke halaman transaksi.php
        header("Location: ../transaksi.php");
        exit();
    } else {
        echo "Error updating status: " . $conn->error;
    }
} else {
    echo "Invalid order ID.";
}
?>