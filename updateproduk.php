<?php
session_start();
include 'koneksi.php';

// Ambil id produk dari parameter URL
$produk_id = isset($_GET['produk_id']) ? $_GET['produk_id'] : '';

// Fetch data produk berdasarkan id
$query_produk = "SELECT * FROM produk WHERE produk_id = $produk_id";
$result_produk = mysqli_query($conn, $query_produk);

// Inisialisasi variabel data_produk
$data_produk = array();

// Check if the query was successful
if ($result_produk) {
    // Fetch associative array
    $data_produk = mysqli_fetch_assoc($result_produk);

    // Free result set
    mysqli_free_result($result_produk);
} else {
    // Handle the error if the query fails
    echo "Error: " . mysqli_error($conn);
}

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="images/kucing.png" type="image/png" rel="shortcut icon" />
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11">
    </link>
</head>

<body>
    <div class="pemesanan-produk">
        <center>
            <h1>UPDATE PRODUK</h1>
        </center>
        <form class="form-group" id="order-form" method="post" action="controller/updateproduk_controller.php">

            <input type="hidden" name="produk_id" value="<?php echo $data_produk['produk_id']; ?>">
            <label for="nama_produk">Nama Produk</label>
            <input id="nama_produk" type="text" name="nama_produk" placeholder="Nama Produk" required
                value="<?php echo $data_produk['name']; ?>">
            <label for="harga">Harga Produk:</label>
            <input type="text" id="harga" name="harga" required value="<?php echo $data_produk['harga']; ?>">
            <label for="kategori_produk">Kategori produk</label>
            <select id="kategori_produk" name="kategori_produk" required>
                <option value="0">- Pilih Kategori -</option>

                <?php
                // Fetch kategori data from the database
                $query_kategori = "SELECT kategori_id, name FROM kategori";
                $result_kategori = mysqli_query($conn, $query_kategori);

                // Check if the query was successful
                if ($result_kategori) {
                    // Fetch associative array
                    while ($row_kategori = mysqli_fetch_assoc($result_kategori)) {
                        // Jika kategori saat ini sama dengan kategori produk yang akan diperbarui, tandai sebagai selected
                        $selected = ($row_kategori['kategori_id'] == $data_produk['kategori_id']) ? 'selected' : '';

                        echo '<option value="' . $row_kategori['kategori_id'] . '" ' . $selected . '>' . $row_kategori['name'] . '</option>';
                    }

                    // Free result set
                    mysqli_free_result($result_kategori);
                } else {
                    // Handle the error if the query fails
                    echo "Error: " . mysqli_error($conn);
                }
                ?>
            </select>

            <button id="kirim" type="submit" class="btn-primary">Update Produk</button>
        </form>
    </div>
    <!-- ... -->
</body>

</html>