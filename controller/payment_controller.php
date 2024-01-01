<?php
include '../koneksi.php';
require_once __DIR__ . '/../midtrans-php-master/Midtrans.php';

\Midtrans\Config::$serverKey = 'SB-Mid-server-4KL91wOs0o1dr7tkKAhATv6v';
\Midtrans\Config::$isProduction = false;
\Midtrans\Config::$isSanitized = true;
\Midtrans\Config::$is3ds = true;

if (isset($_POST['order_id'])) {
    $orderId = $_POST['order_id'];

    // Gunakan koneksi ke database dari file koneksi.php
    $query = "SELECT `order`.*, customer.username, customer.email
              FROM `order`
              INNER JOIN customer ON `order`.customerid = customer.customerid
              WHERE `order`.order_id = '$orderId'";

    $result = mysqli_query($conn, $query);

    if ($result) {
        // Ambil data dari hasil query
        $orderData = mysqli_fetch_assoc($result);

        // Kirim data sebagai respons
        // echo json_encode($orderData);

        // Buat parameter untuk Midtrans Snap menggunakan data dari database
        $params = array(
            'transaction_details' => array(
                'order_id' => 'miaw' . $orderData['order_id'],
                'gross_amount' => $orderData['total_bayar'],
            ),
            'customer_details' => array(
                'email' => $orderData['email'],
                'username' => $orderData['username'], // Kolom dari tabel customer
            ),
        );

        // Mendapatkan snapToken
        $snapToken = \Midtrans\Snap::getSnapToken($params);

        // Lakukan apa pun yang perlu dilakukan dengan snapToken, misalnya, kirim snapToken sebagai respons
        echo json_encode(array('snapToken' => $snapToken));
    } else {
        echo "Error: Failed to execute query.";
    }
} else {
    echo "Error: Order ID not received.";
}
?>