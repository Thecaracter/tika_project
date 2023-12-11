<?php
include '../koneksi.php';

class ProdukController
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function saveProduk($nama_produk, $harga, $kategori_produk)
    {
        $nama_produk = mysqli_real_escape_string($this->conn, $nama_produk);
        $harga = mysqli_real_escape_string($this->conn, $harga);
        $kategori_produk = mysqli_real_escape_string($this->conn, $kategori_produk);

        $insertQuery = "INSERT INTO produk (name, harga, kategori_id) VALUES ('$nama_produk', '$harga', '$kategori_produk')";

        if (mysqli_query($this->conn, $insertQuery)) {
            return true;
        } else {
            // Handle the error if the query fails
            echo "Error: " . mysqli_error($this->conn);
            return false;
        }
    }
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $produkController = new ProdukController($conn);

    $nama_produk = $_POST['nama_produk'];
    $harga = $_POST['harga'];
    $kategori_produk = $_POST['kategori_produk'];

    // Validate data if needed

    // Save data using the ProdukController class
    if ($produkController->saveProduk($nama_produk, $harga, $kategori_produk)) {
        // Set a session notification
        $_SESSION['notification'] = [
            'title' => 'Success',
            'text' => 'Produk berhasil disimpan!',
            'type' => 'success',
        ];

        // Redirect to daftarproduk.php upon success
        header("Location: ../daftarproduk.php");
        exit();
    } else {
        // Set a session notification for failure
        $_SESSION['notification'] = [
            'title' => 'Oops!',
            'text' => 'Terjadi kesalahan saat menambahkan data produk',
            'type' => 'error',
        ];

        // Jika penyimpanan gagal
        echo json_encode(array('status' => 'failed'));
    }
}
?>