<?php
// File: update_order_status.php

// Sertakan file koneksi.php
include '../koneksi.php';

// Inisialisasi variabel respons
$response = array('status' => '', 'message' => '');

// Memeriksa apakah request method adalah POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Menerima data order_id dari body
    $order_id = $_POST['order_id'];

    // Melakukan query untuk memperbarui status pesanan
    $sql = "UPDATE `order` SET `status` = '3' WHERE `order`.`order_id` = '$order_id'";

    if ($conn->query($sql) === TRUE) {
        $response['status'] = 'success';
        $response['message'] = 'Status pesanan berhasil diperbarui.';
    } else {
        $response['status'] = 'error';
        $response['message'] = "Error: " . $sql . "<br>" . $conn->error;
    }
} else {
    $response['status'] = 'error';
    $response['message'] = 'Metode request tidak valid.';
}

// Menutup koneksi
$conn->close();

// Mengirim respons dalam format JSON
header('Content-Type: application/json');
echo json_encode($response);
?>