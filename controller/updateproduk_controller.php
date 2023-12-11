<?php
session_start();
include '../koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Pastikan bahwa form telah dikirim dengan benar
    if (isset($_POST['produk_id'], $_POST['nama_produk'], $_POST['harga'], $_POST['kategori_produk'])) {
        // Ambil data dari formulir
        $produk_id = $_POST['produk_id'];
        $nama_produk = $_POST['nama_produk'];
        $harga = $_POST['harga'];
        $kategori_produk = $_POST['kategori_produk'];

        // Lakukan validasi data jika diperlukan

        // Update data produk di database
        $query = "UPDATE produk SET name = '$nama_produk', harga = '$harga', kategori_id = '$kategori_produk' WHERE produk_id = '$produk_id'";

        if (mysqli_query($conn, $query)) {
            // Redirect ke halaman lain setelah pembaruan berhasil
            header('Location: ../daftarproduk.php');
            exit();
        } else {
            // Handle kesalahan jika query gagal
            echo "Error updating record: " . mysqli_error($conn);
        }
    } else {
        // Handle kesalahan jika data yang dibutuhkan tidak ditemukan dalam $_POST
        echo "Invalid data submitted";
    }
} else {
    // Handle kesalahan jika metode HTTP bukan POST
    echo "Invalid request method";
}
?>